<?php

namespace Webpay;

class Api {

  /** @var string */
  private $webPayUrl;

  /** @var string */
  private $merchantNumber;

  /** @var Signer */
  private $signer;

  /**
   * @param $merchantNumber
   * @param $webPayUrl
   * @param Signer $signer
   */
  public function __construct($merchantNumber, $webPayUrl, Signer $signer) {
    $this->merchantNumber = $merchantNumber;
    $this->webPayUrl = $webPayUrl;
    $this->signer = $signer;
  }

  /**
   * @param PaymentRequest $request
   * @return string
   */
  public function createPaymentRequestUrl(PaymentRequest $request) {
    // digest request
    $params = $request->getParams();
    $request->setDigest($this->signer->sign($params));

    // build request URL based on PaymentRequest
    $paymentUrl = $this->webPayUrl . '?' . http_build_query($request->getParams());

    return $paymentUrl;
  }

  /**
   * @param PaymentResponse $params
   * @return bool
   */
  public function verifyPaymentResponse(PaymentResponse $params) {
    // verify digest
    // verify PRCODE and SRCODE
    // if OK return PaymentResponse
    // if ERROR throw Exception
  }
}
