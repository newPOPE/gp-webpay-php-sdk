<?php

namespace AdamStipak\Webpay;

use PHPUnit\Framework\TestCase;

class SignerTest extends TestCase {

  public function testConstructorWithInvalidPrivateKey () {
    $this->expectException(SignerException::class);
    $signer = new Signer(
      __DIR__ . '/keys/not-exists-key.pem',
      'changeit',
      __DIR__ . '/keys/test_cert.pem'
    );
  }

  public function testConstructorWithInvalidPublicKey () {
    $this->expectException(\AdamStipak\Webpay\SignerException::class);
    $signer = new Signer(
      __DIR__ . '/keys/test_key.pem',
      'changeit',
      __DIR__ . '/keys/not-exists-key.pem'
    );
  }

  public function testSign () {
    $privateKeyResource = openssl_pkey_get_private(
      file_get_contents(__DIR__ . '/keys/test_key.pem'),
      'changeit'
    );

    $params = [
      'param1' => 'foo',
      'param2' => 'bar',
    ];

    $digestText = implode('|', $params);
    openssl_sign($digestText, $expectedDigest, $privateKeyResource);
    $expectedDigest = base64_encode($expectedDigest);

    $signer = new Signer(
      __DIR__ . '/keys/test_key.pem',
      'changeit',
      __DIR__ . '/keys/test_cert.pem'
    );

    $this->assertEquals(
      $expectedDigest,
      $signer->sign($params)
    );
  }

  public function testVerify () {
    $privateKeyResource = openssl_pkey_get_private(
      file_get_contents(__DIR__ . '/keys/test_key.pem'),
      'changeit'
    );

    $params = [
      'param1' => 'foo',
      'param2' => 'bar',
    ];

    $digestText = implode('|', $params);
    openssl_sign($digestText, $expectedDigest, $privateKeyResource);
    $digest = base64_encode($expectedDigest);

    $signer = new Signer(
      __DIR__ . '/keys/test_key.pem',
      'changeit',
      __DIR__ . '/keys/test_cert.pem'
    );

    $this->assertTrue($signer->verify($params, $digest));
  }

  public function testVerifyWithInvalidDigest () {
    $this->expectException(SignerException::class);
    $params = [
      'param1' => 'foo',
      'param2' => 'bar',
    ];

    $signer = new Signer(
      __DIR__ . '/keys/test_key.pem',
      'changeit',
      __DIR__ . '/keys/test_cert.pem'
    );

    $signer->verify($params, 'invalid-digest');
  }
}
