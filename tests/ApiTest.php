<?php

namespace AdamStipak\Webpay;

class ApiTest extends \PHPUnit_Framework_TestCase {

  public function testVerifyPaymentResponse() {
    $response = $this->getMockBuilder('AdamStipak\Webpay\PaymentResponse')
      ->setConstructorArgs(
        [
          'operation',
          'ordernumber',
          'merordernum',
          0,
          0,
          'resulttext',
          'digest'
        ]
      )
      ->setMethods(
        [
          'hasError'
        ]
      )
      ->getMock();

    $response->expects($this->once())
      ->method('hasError')
      ->willReturn(false);

    $signer = $this->getMockBuilder('AdamStipak\\Webpay\\Signer')
      ->disableOriginalConstructor()
      ->setMethods(
        [
          'verify'
        ]
      )
      ->getMock();

    $signer->expects($this->once())
      ->method('verify')
      ->with($response->getParams(), $response->getDigest());

    $api = new Api(123456789, 'http://foo.bar', $signer);

    $api->verifyPaymentResponse($response);
  }

  public function testInvalidDigestInVerifyPaymentResponse() {
    $this->markTestSkipped("Implement");
  }

  public function testPaymentHasErrorInVerifyPaymentResponse() {
    $this->markTestSkipped("Implement");
  }

  public function testCreatePaymentRequestUr() {
    $this->markTestSkipped("Implement"); // move test from PaymentRequestUrlTest
  }
}
