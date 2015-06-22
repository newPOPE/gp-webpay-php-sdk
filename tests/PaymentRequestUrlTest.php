<?php

namespace AdamStipak\Webpay;


class PaymentRequestUrlTest extends \PHPUnit_Framework_TestCase {

  public function testCreateUrl() {
    $expectedUrl = "http://test.webpay.com/foo/csob.do?MERCHANTNUMBER=1234&OPERATION=CREATE_ORDER&ORDERNUMBER=1234&AMOUNT=980&CURRENCY=978&DEPOSITFLAG=0&URL=http%3A%2F%2Ffoo.bar&DIGEST=Y%2BEFNoZgv0N%2B06PkOXe7v6lg4jilLcYKhWA9NDZgh2Y51vRf0Tt5N8KbPqHsWaNXUoDZ598OJgqC5NeG7km%2FiNh29uyQvYQuXaFEjA77QVWUZz6MgrI2VZU7XObyhC%2FETJ5UruAcxgpUAwCnAnWSz374%2BPzkfuS1OHxQEK4UFEam3kns06fbyR2mloa4a6xduiRt9j%2Buy6YXGoe%2FycxrOUfUPug79XZRjF7gmUgAnIvCIUcqD%2BT2mlUmG7BtzuD2pCTyV3RV47lHhO5gLGBN1VFBDm%2BNO6zqM4WTkz9ZtJmsjbzTWX3MEmQgHiiJ9mDd%2FgWY1ipWFWz%2F7TQeZEwctg%3D%3D";

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
