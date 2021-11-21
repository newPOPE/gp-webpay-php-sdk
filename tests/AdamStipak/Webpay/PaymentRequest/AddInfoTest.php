<?php declare(strict_types=1);

namespace AdamStipak\Webpay\PaymentRequest;

use PHPUnit\Framework\TestCase;

class AddInfoTest extends TestCase {

  public function testMinimalValidSchema () {
    $info = AddInfo::createWithMinimalConfig();

    $xml = '<?xml version="1.0"?>
<additionalInfoRequest xmlns="http://gpe.cz/gpwebpay/additionalInfo/request" version="4.0"/>
';
    $infoXml = $info->toXml();
    $document = new \DOMDocument();
    $document->loadXML($xml);
    $this->assertEquals($xml, $infoXml);
    $this->assertTrue($document->schemaValidate(__DIR__ . '/GPwebpayAdditionalInfoRequest_v.4.xsd'));
  }

  public function testMinimalInvalidSchema () {
    $this->expectException(AddInfoException::class);
    new AddInfo([]);
  }
}
