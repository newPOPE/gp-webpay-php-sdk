<?php

namespace AdamStipak\Webpay;

use AdamStipak\Webpay\PaymentRequest\AddInfo;
use PHPUnit\Framework\TestCase;

class PaymentRequestUrlTest extends TestCase {

  public function testCreateUrl () {
    $expectedUrl = "http://test.webpay.com/foo/csob.do?MERCHANTNUMBER=1234&OPERATION=CREATE_ORDER&ORDERNUMBER=1234&AMOUNT=980&CURRENCY=978&DEPOSITFLAG=0&URL=http%3A%2F%2Ffoo.bar&ADDINFO=%3C%3Fxml+version%3D%221.0%22%3F%3E%0A%3CadditionalInfoRequest+xmlns%3D%22http%3A%2F%2Fgpe.cz%2Fgpwebpay%2FadditionalInfo%2Frequest%22+version%3D%224.0%22%2F%3E&DIGEST=uw238QYP2BscxGGOh4thMN58tYhlKthqkMb2rd%2BavV2xWwvrHe82kbt7xyWGFyanj5rdYhHMLZsiwVC9gHzK%2Ftg%2B0cgzbmdMaQyLmaOVwPKAoCVlrPp40MLDAFNRtwJF3Ihg%2BMNJWYhyd%2Ffx0QK1R%2BL1DlqpuiAFtn7AfzuzzLS2Y4cx8jfzm%2FnF5ZeTqfZaWPxXqoPlAs39Ph0YHCnieKlByJznvwsSrSS5L6HJEqL%2FMS%2Bg9dIDv%2FkfaszheOWEx%2Bwh2ntgiOc9W8f%2BENrI2JDaA1hvO9F7dSEeKoRf%2BLWFQUY%2BictN9W4b2SZozqttf1ovAoYNwE48qJ2bDnHNzw%3D%3D";

    $request = new PaymentRequest(
      1234,
      9.80,
      PaymentRequest::EUR,
      0,
      'http://foo.bar',
      null,
      null,
      new AddInfo(
        file_get_contents(__DIR__ . '/AdamStipak/Webpay/PaymentRequest/GPwebpayAdditionalInfoRequest_v.4.xsd'),
        AddInfo::createMinimalValues()
      )
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
