<?php declare(strict_types=1);

namespace AdamStipak\Webpay\PaymentRequest;

use Nette\Schema\Elements\Structure;
use Nette\Schema\Expect;
use Nette\Schema\Processor;
use Nette\Schema\ValidationException;
use Spatie\ArrayToXml\ArrayToXml;

class AddInfo {

  /**
   * @var array
   */
  private $values;

  public function __construct (array $values) {
    $this->validate($values);
    $this->values = $values;
  }

  private function createSchema (): Structure {
    return Expect::structure([
      '_attributes' => Expect::structure([
        'version' => Expect::string()->required()->pattern('\d{1}\.\d{1}'),
      ]),
    ]);
  }

  private function validate (array $values) {
    $processor = new Processor;

    try {
      $processor->process($this->createSchema(), $values);
    }
    catch (ValidationException $e) {
      throw new AddInfoException($e->getMessage(), $e->getCode(), $e);
    }
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

  public static function createWithMinimalConfig (string $version = '4.0'): self {
    return new self ([
      '_attributes' => [
        'version' => $version,
      ],
    ]);
  }
}
