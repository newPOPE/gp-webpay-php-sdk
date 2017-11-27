<?php

namespace AdamStipak\Webpay;

class PaymentRequest {

  const EUR = 978;
  const CZK = 203;
  const GBP = 826;
  const HUF = 348;
  const PLN = 985;
  const RUB = 643;
  const USD = 840;

  /** @var array */
  private $params;

  /**
   * @param int $orderNumber
   * @param float $amount
   * @param string $currency
   * @param int $depositFlag
   * @param string $url
   */
  public function __construct ($orderNumber, $amount, $currency, $depositFlag, $url, $merOrderNumber = null) {
    $this->params['MERCHANTNUMBER'] = "";
    $this->params['OPERATION'] = 'CREATE_ORDER';
    $this->params['ORDERNUMBER'] = $orderNumber;
    $this->params['AMOUNT'] = $amount * 100;
    $this->params['CURRENCY'] = $currency;
    $this->params['DEPOSITFLAG'] = $depositFlag;

    if ($merOrderNumber) {
      $this->params['MERORDERNUM'] = $merOrderNumber;
    }

    $this->params['URL'] = $url;
  }

  /**
   * @internal
   * @param string $digest
   */
  public function setDigest ($digest) {
    $this->params['DIGEST'] = $digest;
  }

  /**
   * @return array
   */
  public function getParams () {
    foreach ($this->params as $key => $param) {
      if ($param === false) {
        $this->params[$key] = 0;
      }
    }

    return $this->params;
  }

  /**
   * @internal
   * @param $number
   */
  public function setMerchantNumber ($number) {
    $this->params['MERCHANTNUMBER'] = $number;
  }
}
