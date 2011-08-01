<?

include_once 'webpay.php';

/* příklad požadavku */
$request = new WebPayRequest ();
$request->setPrivateKey ('private-key.pem', 'heslo');
$request->setWebPayUrl ('https://test.3dsecure.gpwebpay.com/rb/order.do');
$request->setResponseUrl ('http://example.com/test.php');
$request->setMerchantNumber (2002901259);
$request->setOrderInfo (1000004 /* webpay objednávka */, 12345678 /* interní objednávka */, 66 /* cena v CZK */);
echo "<a href='{$request->requestUrl ()}'>zaplatit kartou</a>";



