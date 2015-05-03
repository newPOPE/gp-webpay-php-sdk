<?php

namespace AdamStipak\Webpay;


class PaymentRequestUrlTest extends \PHPUnit_Framework_TestCase {

  public function testCreateUrl() {
    $expectedUrl = "http://test.webpay.com/foo/csob.do?ORDERNUMBER=1234&AMOUNT=980&CURRENCY=978&DEPOSITFLAG=0&URL=http%3A%2F%2Ffoo.bar&DIGEST=d753AhbZCx1O%2B29rcW5Ng962%2F2K5F5R7KDCUlC9BZ%2BkOV4y3sjGwl%2FwLuefVhcOC3uCDkMuabDIHEPuIXLHFDDrJXZv4uAO3wzW76ue12GlwzRTVFkCtpDDl%2Bw8Trjxo3Fx0kA%2FH2nEQekuvTnhCWg7KPM9SyWSb5ijIA0Xy7Mq%2BR3%2FAoCwXh%2FIYQn7PULNfOIjnZFNMgEWXUsPORGnpn9QLL9BpO8ZofjiwOcjW6Y8XJk54O9tX6njfIaRyIpiJnYuA189Lz8WGqeUITaQzlBnBngA3nDlhHoU7dJmbb2rZrPNkiZtnn7Mh9GR86HPwU6sr%2Fdinp2cTCa5KAtL5Zg%3D%3D";

    $request = new PaymentRequest(
      1234,
      9.80,
      PaymentRequest::EUR,
      0,
      'http://foo.bar'
    );

    $api = new Api(
      1234,
      'http://test.webpay.com/foo/csob.do',
      new Signer(
        __DIR__ . '/keys/test_key.pem',
        'changeit',
        __DIR__ . '/keys/test_cert.pem'
      )
    );

    $this->assertEquals($expectedUrl, $api->createPaymentRequestUrl($request));
  }
}
