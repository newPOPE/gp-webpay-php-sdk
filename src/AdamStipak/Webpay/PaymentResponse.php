<?php

namespace AdamStipak\Webpay;

use Exception;

class PaymentResponse {

  /** @var array */
  private $params;

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
  public function __construct($operation, $ordernumber, $merordernum, $prcode, $srcode, $resulttext, $digest, $digest1) {
    $this->params['operation'] = $operation;
    $this->params['ordermumber'] = $ordernumber;
    if ($merordernum !== NULL) {
      $this->params['merordernum'] = $merordernum;
    }
    $this->params['prcode'] = (int)$prcode;
    $this->params['srcode'] = (int)$srcode;
    $this->params['resulttext'] = $resulttext;
    $this->digest = $digest;
    $this->digest1 = $digest1;
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

  /**
   * @return bool
   */
  public function hasError() {
    return (bool)$this->params['prcode'] || (bool)$this->params['srcode'];
  }

  /**
   * @return string
   */
  public function getDigest1() {
    return $this->digest1;
  }
}

class PaymentResponseException extends Exception {

  /** @var int */
  private $prCode;

  /** @var int */
  private $srCode;

  public function __construct ($prCode, $srCode = 0, $message = "", Exception $previous = null) {
    $this->prCode = $prCode;
    $this->srCode = $srCode;

    parent::__construct($message, $prCode, $previous);
  }

  /**
   * @return int
   */
  public function getPrCode () {
    return $this->prCode;
  }

  /**
   * @return int
   */
  public function getSrCode () {
    return $this->srCode;
  }
}
