# GP Webpay PHP SDK
[![Build Status](https://travis-ci.org/newPOPE/webpay-php.png?branch=master)](https://travis-ci.org/newPOPE/webpay-php)

Full featured PHP SDK for [GP Webpay payments](http://www.gpwebpay.cz).

### Actual code is under development now.

## Installation

The best way to install GP Webpay PHP API is using  [Composer](http://getcomposer.org/):

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

