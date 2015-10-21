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
          'digest',
          'digest1'
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

    $signer->expects($this->exactly(2))
      ->method('verify');

    $api = new Api(123456789, 'http://foo.bar', $signer);

    $api->verifyPaymentResponse($response);
  }

  /**
   * @expectedException \AdamStipak\Webpay\PaymentResponseException
   */
  public function testPaymentHasErrorInVerifyPaymentResponse() {
    $merchantNumber = 123456789;
    $params = [
      'OPERATION'      => 'operation',
      'ORDERNUMBER'    => 'ordernumber',
      'MERORDERNUMBER' => 'merordernum',
      'PRCODE'         => 1,
      'SRCODE'         => 2,
      'RESULTTEXT'     => 'resulttext',
    ];

    $signer = new Signer(
      __DIR__ . '/keys/test_key.pem',
      'changeit',
      __DIR__ . '/keys/test_cert.pem'
    );

    $digest = $signer->sign($params);
    $params['MERCHANTNUMBER'] = $merchantNumber;
    $digest1 = $signer->sign($params);

    $response = new PaymentResponse(
      $params['OPERATION'],
      $params['ORDERNUMBER'],
      $params['MERORDERNUMBER'],
      $params['PRCODE'],
      $params['SRCODE'],
      $params['RESULTTEXT'],
      $digest,
      $digest1
    );

    $api = new Api($merchantNumber, 'http://foo.bar', $signer);

    $api->verifyPaymentResponse($response);
  }

  public function testCreatePaymentRequestUr() {
    $this->markTestSkipped("Implement"); // move test from PaymentRequestUrlTest
  }

  public function testInvalidDigestInVerifyPaymentResponse () {
    $this->markTestSkipped("Implement");
  }
}
