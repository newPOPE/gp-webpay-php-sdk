<?php

namespace AdamStipak\Webpay;

use AdamStipak\Webpay\PaymentRequest\AddInfo;
use PHPUnit\Framework\TestCase;

class PaymentRequestUrlTest extends TestCase {

  public function testCreateUrl () {
    $expectedUrl = "http://test.webpay.com/foo/csob.do?MERCHANTNUMBER=1234&OPERATION=CREATE_ORDER&ORDERNUMBER=1234&AMOUNT=980&CURRENCY=978&DEPOSITFLAG=0&URL=http%3A%2F%2Ffoo.bar&PAYMETHOD=CRD&ADDINFO=%3C%3Fxml+version%3D%221.0%22%3F%3E%0A%3CadditionalInfoRequest+xmlns%3D%22http%3A%2F%2Fgpe.cz%2Fgpwebpay%2FadditionalInfo%2Frequest%22+version%3D%224.0%22%2F%3E&DIGEST=Fb0QQzkPv%2B9MAyvAhVrBjL4LjFv8oq4sQO7iSFZ7ZOgC9loqNgTLfPotUjRxcWFn3y0Dz60VAqcanmL%2FcGp2cAg%2FCqBb1OrvgpWeFECJ1tfyJ9ew7Nqhk4glu8Bs%2FiqH21xHQ0B7k1iglBIL00Xpd%2BOYnv37WHaZRm5i8rTXpGntvdWQx1Rb2SjT47Av1%2BeFz8UGtxorghCM2A0HPyc%2BcJ7qoHZJYrjFiaENBzYTQEh%2BcZaKP%2FxZMGVtEV6HGqgekJfI6oOXBHZJYJ8uMqvBE4OkBgfonbp728EopQSKOLHz7NRj7wNFM%2FNiFzTeaoof3KYq7G5PbcfImDR4LGpzbQ%3D%3D";

    $request = new PaymentRequest(
      1234,
      9.80,
      PaymentRequest::EUR,
      0,
      'http://foo.bar',
      null,
      null,
      new AddInfo(
        file_get_contents(__DIR__ . '/AdamStipak/Webpay/PaymentRequest/GPwebpayAdditionalInfoRequest_v.4.xsd'),
        AddInfo::createMinimalValues()
      )
    );

    $api = $this->createApi();

    $this->assertEquals($expectedUrl, $api->createPaymentRequestUrl($request));
  }

  public function testCreateUrlWitNotAddInfo () {
    $expectedUrl = "http://test.webpay.com/foo/csob.do?MERCHANTNUMBER=1234&OPERATION=CREATE_ORDER&ORDERNUMBER=1234&AMOUNT=980&CURRENCY=978&DEPOSITFLAG=0&URL=http%3A%2F%2Ffoo.bar&PAYMETHOD=CRD&DIGEST=AhzYS0oZggIdpDZwPMjg9pIHciCFUMSn07tU8VtIl1WDK0WNJBsJkh8mfmlQgKcBHACI04ZfNUlSt7p2dzAj7f6YqFpxPPGwH2STogh7w5pNbUqYoxN6BlrmGdZZ72%2FUciXbMBsC2fkyc7KErixoJDT1QIFn46OVYjdy%2FQi4jAfLtT%2BTCXuo3QG5h8utcsRxeuyC5CSG44x%2Fz32ttMxaxWbTn0nBLtkncPmp54yc4vRBB6qM1qoyNkRBMl9mzQbzYaQfv%2BWsBM0Cg1d5DfM75jfFN24eBLkW3qvMjgKg%2BBWfcEPcQBnV3ZwOU%2BUaZz9etXf7dBgng3Osb56ErpQ25w%3D%3D";

    $request = new PaymentRequest(
      1234,
      9.80,
      PaymentRequest::EUR,
      0,
      'http://foo.bar',
      null,
      null
    );

    $api = $this->createApi();

    $this->assertEquals($expectedUrl, $api->createPaymentRequestUrl($request));
  }

  /**
   * @return Api
   * @throws SignerException
   */
  private function createApi (): Api {
    return new Api(
      1234,
      'http://test.webpay.com/foo/csob.do',
      new Signer(
        __DIR__ . '/keys/test_key.pem',
        'changeit',
        __DIR__ . '/keys/test_cert.pem'
      )
    );
  }
}
