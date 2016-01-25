<?php

namespace AdamStipak\Webpay;

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
