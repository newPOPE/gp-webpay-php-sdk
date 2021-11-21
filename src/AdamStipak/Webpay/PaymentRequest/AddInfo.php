<?php declare(strict_types=1);

namespace AdamStipak\Webpay\PaymentRequest;

use Spatie\ArrayToXml\ArrayToXml;

class AddInfo {

  /**
   * @var array
   */
  private $values;

  /**
   * @var string
   */
  private $schema;

  public function __construct (string $schema, array $values) {
    $this->schema = $schema;
    $this->values = $values;
    $this->validate($values);
  }

  private function validate (array $values) {
    $dom = new \DOMDocument;
    $dom->loadXML($this->toXml());

    libxml_use_internal_errors(true);
    if (!$dom->schemaValidateSource($this->schema)) {
      throw new AddInfoException("XML output cannot be validate using the schema.");
    }
    libxml_use_internal_errors(false);
  }

  public function toXml (): string {
    return trim(ArrayToXml::convert(
      $this->values, [
        'rootElementName' => 'additionalInfoRequest',
        '_attributes'     => [
          'xmlns' => "http://gpe.cz/gpwebpay/additionalInfo/request",
        ],
      ]
    ));
  }

  public static function createMinimalValues (string $version = '4.0'): array {
    return [
      '_attributes' => [
        'version' => $version,
      ],
    ];
  }
}
