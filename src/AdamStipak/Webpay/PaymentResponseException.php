<?php

namespace AdamStipak\Webpay;

class PaymentResponseException extends Exception {

  /** @var int */
  private $prCode;

  /** @var int */
  private $srCode;

  public function __construct (int $prCode, int $srCode = 0, string $message = "", Exception $previous = null) {
    $this->prCode = $prCode;
    $this->srCode = $srCode;

    parent::__construct($message, $prCode, $previous);
  }

  /**
   * @return int
   */
  public function getPrCode (): int {
    return $this->prCode;
  }

  /**
   * @return int
   */
  public function getSrCode (): int {
    return $this->srCode;
  }
}
