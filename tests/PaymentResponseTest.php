<?php

namespace AdamStipak\Webpay;

use PHPUnit\Framework\TestCase;

class PaymentResponseTest extends TestCase {

  public function errorCodesProvider () {
    return [
      [
        [
          'prcode' => 0,
          'srcode' => 0,
        ],
        false,
      ],
      [
        [
          'prcode' => 97,
          'srcode' => 0,
        ],
        true,
      ],
      [
        [
          'prcode' => 12,
          'srcode' => 32,
        ],
        true,
      ],
    ];
  }

  /**
   * @dataProvider errorCodesProvider
   */
  public function testHasError ($codes, $result) {
    $response = new PaymentResponse(
      'operation',
      'ordernumber',
      'merordernum',
      $codes['prcode'],
      $codes['srcode'],
      'resultext',
      'digest',
      'digest1'
    );

    $this->assertEquals($result, $response->hasError());
  }
}
