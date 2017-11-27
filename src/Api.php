<?php

namespace Webpay;

class Api {

  /** @var string */
  private $privateKey;

  /** @var string */
  private $privateKeyPassword;

  /** @var string */
  private $webPayUrl;

  /** @var string */
  private $merchantNumber;

  /**
   * @param $merchantNumber
   * @param $privateKey
   * @param $privateKeyPassword
   * @param $webPayUrl
   */
  public function __construct ($merchantNumber, $privateKey, $privateKeyPassword, $webPayUrl) {
    $this->merchantNumber = $merchantNumber;
    $this->privateKey = $privateKey;
    $this->privateKeyPassword = $privateKeyPassword;
    $this->webPayUrl = $webPayUrl;
  }

  /**
   * @param PaymentRequest $request
   * @return string
   */
  public function createPaymentRequestUrl (PaymentRequest $request) {
    // digest request
    // build request URL based on PaymentRequest
    // return URL
  }

  /**
   * @param PaymentResponseParams $params
   * @return PaymentResponse
   */
  public function verifyPayment (PaymentResponseParams $params) {
    // verify digest
    // verify PRCODE and SRCODE
    // if OK return PaymentResponse
    // if ERROR throw Exception
  }

  public function approveReversal (ApproveReversalRequest $request) {
    // digest request
    // call SOAP API
    // verify response DIGEST
    // verify PRCODE and SRCODE
    // if OK return ApproveReversalResponse
    // if ERROR throw Exception
  }

  public function deposit (DepositRequest $request) {
    // same flow as approveReversal
  }

  public function depositReversal (DepositReversal $request) {
    // same flow as approveReversal
  }

  public function credit (CreditRequest $request) {
    // same flow as approveReversal
  }

  public function creditReversal (CreditReversal $request) {
    // same flow as approveReversal
  }

  public function orderClose (OrderCloseRequest $request) {
    // same flow as approveReversal
  }

  public function delete (DeleteRequest $request) {
    // same flow as approveReversal
  }

  public function queryOrderState (QueryOrderStateRequest $request) {
    // same flow as approveReversal
  }

  public function batchClose (BatchCloseRequest $request) {
    // same flow as approveReversal
  }
}
