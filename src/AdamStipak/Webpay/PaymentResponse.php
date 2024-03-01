<?php

namespace AdamStipak\Webpay;

class PaymentResponse {

  /** @var array */
  private $params = [];

  /** @var string */
  private $digest;

  /** @var string */
  private $digest1;

  /**
   * @param string $operation
   * @param string $ordernumber
   * @param string $merordernum
   * @param int $prcode
   * @param int $srcode
   * @param string $resulttext
   * @param string $digest
   * @param string $digest1
   */
  public function __construct (string $operation, string $ordernumber, string $merordernum = null, int $prcode, int $srcode, string $resulttext = null, string $digest, string $digest1, string $md = null) {
    $this->params['operation'] = $operation;
    $this->params['ordermumber'] = $ordernumber;
    if ($merordernum !== null) {
      $this->params['merordernum'] = $merordernum;
    }
    if ($md !== null) {
      $this->params['md'] = $md;
    }
    $this->params['prcode'] = $prcode;
    $this->params['srcode'] = $srcode;
    if($resulttext !== null){
      $this->params['resulttext'] = $resulttext;
    }

    $this->digest = $digest;
    $this->digest1 = $digest1;
  }

  /**
   * @return array
   */
  public function getParams (): array {
    return $this->params;
  }

  /**
   * @return mixed
   */
  public function getDigest (): string {
    return $this->digest;
  }

  /**
   * @return bool
   */
  public function hasError (): bool {
    return (bool) $this->params['prcode'] || (bool) $this->params['srcode'];
  }

  /**
   * @return string
   */
  public function getDigest1 (): string {
    return $this->digest1;
  }
}
