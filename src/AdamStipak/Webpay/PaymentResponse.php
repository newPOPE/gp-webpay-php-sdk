<?php

namespace AdamStipak\Webpay;

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
	if($merordernum !== NULL)
	{
		$this->params['merordernum'] = $merordernum;
	}
    $this->params['prcode'] = (int) $prcode;
    $this->params['srcode'] = (int) $srcode;
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
