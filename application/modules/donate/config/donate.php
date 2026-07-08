<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * PayPal Currency
 *
 * Check the available currencies in:
 * https://developer.paypal.com/docs/classic/api/currency_codes/
 *
*/
$config['paypal_currency'] = 'EUR';

/**
 *
 * PayPal Mode
 *
 * Options Available:
 *
 * sandbox = Testing the code end-to-end
 * live    = Ready for production
 *
*/
$config['paypal_mode'] = 'live';

/**
 *
 * PayPal Client ID
 *
 * Check your client id in:
 * https://developer.paypal.com/developer/applications
 *
*/
$config['paypal_userid'] = 'AbP6YBSRII4Ynr-faC_jT5tqXMmN0CYstahkQkxWqep8IDg5YiWic3Xo1jiEnV5Dy5fVbZ4HjkuErOIg';

/**
 *
 * PayPal Secret Password
 *
 * Check your secret password in:
 * https://developer.paypal.com/developer/applications
 *
*/
$config['paypal_secretpass'] = 'ENBcSYS0WQpMgAZ0WkHCvltZ8zZyrQ_GX-iwAKarOf1VJWmwrN1nNccP7HKf6rFl92dOrmjE-VAsmF2r';

/**
 *
 * PayPal Currency Symbol
 *
 * Write the symbol of currency used in paypal
 *
*/
$config['paypal_currency_symbol'] = '€';

$config['paypal_client'] = 'AbP6YBSRII4Ynr-faC_jT5tqXMmN0CYstahkQkxWqep8IDg5YiWic3Xo1jiEnV5Dy5fVbZ4HjkuErOIg';

$config['paypal_password'] = 'ENBcSYS0WQpMgAZ0WkHCvltZ8zZyrQ_GX-iwAKarOf1VJWmwrN1nNccP7HKf6rFl92dOrmjE-VAsmF2r';