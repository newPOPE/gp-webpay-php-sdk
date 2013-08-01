<?php

include_once 'webpay.php';

/* příklad požadavku */
$request = new WebPayRequest ();
$request->setPrivateKey ('private-key.pem', 'heslo');
$request->setWebPayUrl ('https://test.3dsecure.gpwebpay.com/rb/order.do');
$request->setResponseUrl ('http://shop.example.cpm/order.php');
$request->setMerchantNumber (1234567890);
$request->setOrderInfo (1000006 /* webpay objednávka */, 12345678 /* interní objednávka */, 90 /* cena v CZK */);
echo "<a href='{$request->requestUrl ()}'>zaplatit kartou</a>";



