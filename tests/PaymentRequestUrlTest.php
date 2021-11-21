<?php

namespace AdamStipak\Webpay;

use AdamStipak\Webpay\PaymentRequest\AddInfo;
use PHPUnit\Framework\TestCase;

class PaymentRequestUrlTest extends TestCase {

  public function testCreateUrl () {
    $expectedUrl = "http://test.webpay.com/foo/csob.do?MERCHANTNUMBER=1234&OPERATION=CREATE_ORDER&ORDERNUMBER=1234&AMOUNT=980&CURRENCY=978&DEPOSITFLAG=0&URL=http%3A%2F%2Ffoo.bar&ADDINFO=%3C%3Fxml+version%3D%221.0%22%3F%3E%0A%3CadditionalInfoRequest+xmlns%3D%22http%3A%2F%2Fgpe.cz%2Fgpwebpay%2FadditionalInfo%2Frequest%22+version%3D%221.0%22%2F%3E%0A&DIGEST=iPRg%2FTYUOto%2B1fN4d1jTCNeuncPMw43JNOriC8rlKH2zQMf%2FbbRq0GVf2NrCiVZMRUIuYONOl11eP1%2BwGZ4eUbba8C%2FjjXzUIqoXd2nyVH02kKKLLezrBhuRjBdYK1Z07gsk1qrNt%2B3vJjbe9Acpesfa44YqpFSm0PwBKtxsO5odzLUhxjMygvj7I1Dp9xCAsV%2BHzWWI6S5BxkAmOWH4DoHEMJMzJJIvHz4%2FSe6gC6%2B2D1aSYS56LB3qW2gRMGp9%2BigYSpvxuVu3TMgpTWPIlNRakgS4WlMzeEq2oLAr8xyRJakYa3C%2FNY9SNfeIXxE5QrRlMF7N9Qf0MT3matUAPQ%3D%3D";

    $request = new PaymentRequest(
      1234,
      9.80,
      PaymentRequest::EUR,
      0,
      'http://foo.bar',
      null,
      null,
      new AddInfo([
        '_attributes' => [
          'version' => '1.0',
        ],
      ])
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
