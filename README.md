# GP Webpay PHP SDK
[![Build Status](https://travis-ci.org/newPOPE/webpay-php.png?branch=master)](https://travis-ci.org/newPOPE/webpay-php)

Full featured PHP SDK for [GP Webpay payments](http://www.gpwebpay.cz).

### Actual code is under development now.

## Installation

The best way to install GP Webpay PHP SDK is using  [Composer](http://getcomposer.org/):

```sh
$ composer require adamstipak/webpay-php dev-master
```

## Setup

```php
$signer = new \AdamStipak\Webpay\Signer(
  $privateKeyFilepath,    // Path of private key.
  $privateKeyPassword,    // Password for private key.
  $publicKeyFilepath      // Path of public key.
);
    
$api = new \AdamStipak\Webpay\Api(
  $merchantNumber,    // Merchant number.
  $webpayUrl,         // URL of webpay.
  $signer             // instance of \AdamStipak\Webpay\Signer.
);

```

## Create payment

### Create payment url

 ```php
 use \AdamStipak\Webpay\PaymentRequest;
 
 $request = new PaymentRequest(...);
 
 $url = $api->createPaymentRequestUrl($request); // $api instance of \AdamStipak\Webpay\Api
 
 // use $url as you want. In most cases for redirecting to GP Webpay.
 
 ```
 
### Verify payment response
 
```php
use \AdamStipak\Webpay\PaymentResponse;
use \AdamStipak\Webpay\Exception;
 
$response = new PaymentResponse(...); // fill response with response parameters (from request).
 
try {
  $api->verifyPaymentResponse($response);
} 
catch (Exception $e) {
  // Digest is not correct or some error occured (PRCODE, SRCODE is not 0).
}

```
 
 
 
 