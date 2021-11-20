<?php declare(strict_types=1);

namespace AdamStipak\Webpay\PaymentRequest;

use PHPUnit\Framework\TestCase;

class AddInfoTest extends TestCase {

  public function testMinimalValidSchema () {
    $info = new AddInfo([
      '_attributes' => [
        'version' => '1.0',
      ],
    ]);

    $xml = '<?xml version="1.0"?>
<additionalInfoRequest version="1.0"/>
';
    $this->assertEquals($xml, $info->toXml());
  }

  public function testMinimalInvalidSchema () {
    $this->expectException(AddInfoException::class);
    new AddInfo([]);
  }
}
