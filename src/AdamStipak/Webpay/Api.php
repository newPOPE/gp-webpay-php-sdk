<?php

namespace AdamStipak\Webpay;

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
    $request->setMerchantNumber($this->merchantNumber);
    $request->setDigest($this->signer->sign($params));

    // build request URL based on PaymentRequest
    $paymentUrl = $this->webPayUrl . '?' . http_build_query($request->getParams());

    return $paymentUrl;
  }

  /**
   * @param PaymentResponse $response
   * @throws Exception
   */
  public function verifyPaymentResponse(PaymentResponse $response) {
    // verify digest & digest1
    try {
      $responseParams = $response->getParams();
      $this->signer->verify($responseParams, $response->getDigest());

      $responseParams['MERCHANTNUMBER'] = $this->merchantNumber;
      $this->signer->verify($responseParams, $response->getDigest1());
    } catch (SignerException $e) {
      throw new Exception($e->getMessage(), $e->getCode(), $e);
    }

    // verify PRCODE and SRCODE
    if (false !== $response->hasError()) {
      throw new Exception("Response has an error.");
    }
  }
}

class Exception extends \Exception {}
