# Omnipay: APS (Amazon Payment Service)

**APS driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements Amazon Payment Services (APS) support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply require
`league/omnipay` and `cave/omnipay-aps` with Composer:

```
composer require league/omnipay cave/omnipay-aps
```

## Basic Usage

The following gateways are provided by this package:

* APS

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

## Example

### Purchase

The result will be a redirect to the gateway or bank.

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Amazon Payment Service');

// Send purchase request
$response = $gateway->purchase([])->send();

// Process response
if ($response->isRedirect()) {
    // Redirect to offsite payment gateway
    $response->redirect();
} else {
    // Payment failed: display message to customer
    echo $response->getMessage();
}
```

### Testing

```sh
composer test
```

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/cave/omnipay-aps/issues),
or better yet, fork the library and submit a pull request.