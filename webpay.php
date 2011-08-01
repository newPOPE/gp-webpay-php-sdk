<?

if (!extension_loaded('openssl'))
  die ("PHP extension OpenSSL is not loaded.");

class WebPayRequest
{
  var $privateKey;
  var $webPayUrl;
  var $responseUrl;
  var $merchantNumber;
  var $webPayOrder;
  var $merchantOrder;
  var $amount;

  public function setPrivateKey ($file, $passphrase)
  {
    $fp = fopen($file, "r");
    $key = fread($fp, filesize($file));
    fclose($fp);
    if (!($this->privateKey = openssl_pkey_get_private($key, $passphrase)))
    {
      echo "'$file' is not valid PEM public key (or passphrase is incorrect).";
      die;
    }
  }

  public function setOrderInfo ($webPayOrder, $merchantOrder, $price)
  {
    $this->webPayOrder = $webPayOrder;
    $this->merchantOrder = $merchantOrder;
    $this->amount = $price * 100;
  }

  public function setWebPayUrl ($url)
  {
    $this->webPayUrl = $url;
  }


  public function setResponseUrl ($responseUrl)
  {
    $this->responseUrl = $responseUrl;
  }

  public function setMerchantNumber ($merchantNumber)
  {
    $this->merchantNumber = $merchantNumber;
  }

  public function getParams ()
  {
    $params = array ();
    $params ['MERCHANTNUMBER'] = $this->merchantNumber;
    $params ['OPERATION'] = 'CREATE_ORDER';
    $params ['ORDERNUMBER'] = $this->webPayOrder;
    $params ['AMOUNT'] = $this->amount;
    $params ['CURRENCY'] = 203;
    $params ['DEPOSITFLAG'] = 1;
    $params ['MERORDERNUM'] = $this->merchantOrder;
    $params ['URL'] = $this->responseUrl;
    
    $digestText = implode ('|', $params);
    //echo $digestText . '<br/>';
    openssl_sign ($digestText, $signature, $this->privateKey);
    $signature = base64_encode ($signature);
    $params ['DIGEST'] = $signature;

    //echo $signature . '<br/>';
    return $params;
  }

  public function requestUrl ()
  {
    $params = $this->getParams ();
    $url = $this->webPayUrl . '?' . http_build_query ($params);

    //echo $url . '<br/>';
    return $url;
  }
} // WebPayRequest


