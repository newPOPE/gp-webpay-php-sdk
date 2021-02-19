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
  public function __construct (string $merchantNumber, string $webPayUrl, Signer $signer) {
    $this->merchantNumber = $merchantNumber;
    $this->webPayUrl = $webPayUrl;
    $this->signer = $signer;
  }

  /**
   * @param PaymentRequest $request
   * @return string
   */
  public function createPaymentRequestUrl (PaymentRequest $request): string {
    // build request URL based on PaymentRequest
    $paymentUrl = $this->webPayUrl . '?' . http_build_query($this->createPaymentParam($request));

    return $paymentUrl;
  }

  /**
   * @param \AdamStipak\Webpay\PaymentRequest $request
   * @return array
   */
  public function createPaymentParam (PaymentRequest $request): array {
    // digest request
    $request->setMerchantNumber($this->merchantNumber);
    $params = $request->getParams();
    $request->setDigest($this->signer->sign($params));

    return $request->getParams();
  }

  /**
   * @param PaymentResponse $response
   * @throws Exception
   * @throws PaymentResponseException
   */
  public function verifyPaymentResponse (PaymentResponse $response) {
    // verify digest & digest1
    try {
      $responseParams = $response->getParams();
      $this->signer->verify($responseParams, $response->getDigest());

      $responseParams['MERCHANTNUMBER'] = $this->merchantNumber;

      $this->signer->verify($responseParams, $response->getDigest1());
    }
    catch (SignerException $e) {
      throw new Exception($e->getMessage(), $e->getCode(), $e);
    }

    // verify PRCODE and SRCODE
    if (false !== $response->hasError()) {
      $prcode = $response->getParams()['prcode'];
      $srcode = $response->getParams()['srcode'];
      throw new PaymentResponseException(
        $prcode,
        $srcode,
        "Response has an error. {$prcode}:{$srcode}"
      );
    }
  }
}
