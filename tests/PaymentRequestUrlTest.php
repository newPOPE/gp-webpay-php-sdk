<?php

namespace AdamStipak\Webpay;

use AdamStipak\Webpay\PaymentRequest\AddInfo;
use PHPUnit\Framework\TestCase;

class PaymentRequestUrlTest extends TestCase {

  public function testCreateUrl () {
    $expectedUrl = "http://test.webpay.com/foo/csob.do?MERCHANTNUMBER=1234&OPERATION=CREATE_ORDER&ORDERNUMBER=1234&AMOUNT=980&CURRENCY=978&DEPOSITFLAG=0&URL=http%3A%2F%2Ffoo.bar&ADDINFO=%3C%3Fxml+version%3D%221.0%22%3F%3E%0A%3CadditionalInfoRequest+xmlns%3D%22http%3A%2F%2Fgpe.cz%2Fgpwebpay%2FadditionalInfo%2Frequest%22+version%3D%221.0%22%2F%3E&DIGEST=ngN7yf4PGqxblcSAHTvY3yvmcSIqMutgeZVLjWcL1f2zmv5Fb%2FgUBw1ug0vvKHyQcXIdo9o5MtospG5WDLdw%2Fz11yBInwXyCMpAGL%2B9TZ95kaFd53qkRXQiOMNU4UUUIu4vn6kP4OY4PNlcC%2FJyYuMdpVxr21TRPYiBn0lbHy7X%2FGDmCPQIluA2l3xa%2BNqhuWh%2BF72aKoqh9VKKvcd%2B4s1dcoe5wXAgyW5p%2BAtkLkC5cvmW83wsuE%2FWUJ6vhzXJq8eFpL56DwnuksaLtquWjEQs8peSI72QJ8TbpALmtfC407ZdurPDlTe%2B7g85kT5MI2xrh%2FxAMwsXDwVGQBWBrBA%3D%3D";

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
