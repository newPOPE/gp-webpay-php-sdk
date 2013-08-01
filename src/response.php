<?

include_once 'webpay.php';

$response = new WebPayResponse ();
$response->setPublicKey ('muzo.signing_test.pem');
$response->setResponseParams ($_GET);
$result = $response->verify ();

if ($result)
{
  echo 'Objednávka číslo ' . $response->orderMerchant () . ' byla zaplacena.';
}
else
{
  echo 'Zaplacení selhalo...';
}

