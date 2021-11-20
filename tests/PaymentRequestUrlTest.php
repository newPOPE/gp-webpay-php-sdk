<?php

namespace AdamStipak\Webpay;

use AdamStipak\Webpay\PaymentRequest\AddInfo;
use PHPUnit\Framework\TestCase;

class PaymentRequestUrlTest extends TestCase {

  public function testCreateUrl () {
    $expectedUrl = "http://test.webpay.com/foo/csob.do?MERCHANTNUMBER=1234&OPERATION=CREATE_ORDER&ORDERNUMBER=1234&AMOUNT=980&CURRENCY=978&DEPOSITFLAG=0&URL=http%3A%2F%2Ffoo.bar&ADDINFO=%3C%3Fxml+version%3D%221.0%22%3F%3E%0A%3CadditionalInfoRequest+version%3D%221.0%22%2F%3E%0A&DIGEST=H7YCPgLzG80BpCYf0R9OXWnAaSheTaLYg0syF7Hii2cPr9E046O%2Bg1rvv2fSfL%2BzS7Qjx4Srl%2BQ3Q9%2Fkiboc3mx7NjiOKAc9Ba968vJutiz7%2FwozDXiTmGX%2BgogwZTKBxBpJNj4jzmzkUNoLgWXuxDLzgubROUX%2Bx2UeR1aMs95sU2ZKJykdxbAs1EPbMUz82eKq%2BVdvRNRRKPUB7iKNHwN5iLLFbc0NNbWBGnaCPal%2B7AAI4cuycoMeMTBKgvY0fQw671fpsHJ38KkKAI%2BNzklZY2ggCfUu%2BRHMKzAMUZ37Uq%2B91vbveKv302S11JPfiHD0rtl%2BOHH5UH4pdzYUNw%3D%3D";

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
