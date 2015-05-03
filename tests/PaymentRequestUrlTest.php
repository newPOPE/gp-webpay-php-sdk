<?php

namespace AdamStipak\Webpay;


class PaymentRequestUrlTest extends \PHPUnit_Framework_TestCase {

  public function testCreateUrl() {
    $expectedUrl = "http://test.webpay.com/foo/csob.do?ORDERNUMBER=1234&AMOUNT=980&CURRENCY=978&DEPOSITFLAG=0&URL=http%3A%2F%2Ffoo.bar&OPERATION=CREATE_ORDER&MERCHANTNUMBER=1234&DIGEST=rOl2FCS06N64rFsoCb6b8ysIDH%2BhmOSMCxmCm9d6YvVFkimYa6jRH8REIRKXxeRzIrhlohuvdvrOOtz6y6yJjVM%2FCIpkhzB%2FALSARvxbIpD%2Bhc2i%2F8JGTNM%2BEZ6mmRcNMV%2BJ9kOOAbWVXMG62Ax73UUfcVzkSLvR%2FSHhr7GmyrRkV%2F9wqvGlFcjJFnXwfoevyGSz%2B5QlQuX4JeZz8jEyft7QeqB4OXipJN1x%2F48XSo5sIEZn8onVTpWpIMKTwSqjXZBl8ZRMNwJ1mxxZJ3K6%2BpTu%2FjfRI2s5x9GBakzvfQ0cObl%2FYrXM0Lx%2FzCuyWlJHb9Fj4TyGyT4tBJvKaEVUjQ%3D%3D";

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
