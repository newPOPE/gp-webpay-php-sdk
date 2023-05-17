<?php declare(strict_types=1);

namespace AdamStipak\Webpay\PaymentRequest;

use AdamStipak\Webpay\PaymentRequest;
use PHPUnit\Framework\TestCase;

class SignParamTest extends TestCase {

  public function testDefault () {
    $request = new PaymentRequest(
      123456789,
      100.0,
      PaymentRequest::EUR,
      0,
      'http://localhost/webpay'
    );

    $signParams = $request->getSignParams();

    $expecteddSignParams = [
      "OPERATION"      => 'CREATE_ORDER',
      "ORDERNUMBER"    => 123456789,
      "AMOUNT"         => 10000.0,
      "CURRENCY"       => 978,
      "DEPOSITFLAG"    => 0,
      "URL"            => "http://localhost/webpay",
      "PAYMETHOD"      => "CRD",
      "MERCHANTNUMBER" => '',
    ];

    $this->assertEquals($expecteddSignParams, $signParams);
  }

  public function testWithLangParam () {
    $request = new PaymentRequest(
      123456789,
      100.0,
      PaymentRequest::EUR,
      0,
      'http://localhost/webpay'
    );

    $request->setParam('LANG', 'SK');
    $signParams = $request->getSignParams();

    $expecteddSignParams = [
      "OPERATION"      => 'CREATE_ORDER',
      "ORDERNUMBER"    => 123456789,
      "AMOUNT"         => 10000.0,
      "CURRENCY"       => 978,
      "DEPOSITFLAG"    => 0,
      "URL"            => "http://localhost/webpay",
      "PAYMETHOD"      => "CRD",
      "MERCHANTNUMBER" => '',
    ];

    $this->assertEquals($expecteddSignParams, $signParams);
  }

}
