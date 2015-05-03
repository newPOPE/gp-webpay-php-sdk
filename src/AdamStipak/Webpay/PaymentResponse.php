<?php

namespace AdamStipak\Webpay;

class PaymentResponse {

  /** @var array */
  private $params;

  private $digest;

  /**
   * @param string $operation
   * @param string $ordernumber
   * @param string $merordernum
   * @param int $prcode
   * @param int $srcode
   * @param string $resulttext
   * @param string $digest
   */
  public function __construct($operation, $ordernumber, $merordernum, $prcode, $srcode, $resulttext, $digest) {
    $this->params['operation'] = $operation;
    $this->params['ordermumber'] = $ordernumber;
    $this->params['merordernum'] = $merordernum;
    $this->params['prcode'] = (int) $prcode;
    $this->params['srcode'] = (int) $srcode;
    $this->params['resulttext'] = $resulttext;
    $this->digest = $digest;
  }

  /**
   * @return array
   */
  public function getParams() {
    return $this->params;
  }

  /**
   * @return mixed
   */
  public function getDigest() {
    return $this->digest;
  }

  public function hasError() {
    return (bool)$this->params['prcode'] || (bool)$this->params['srcode'];
  }
}
