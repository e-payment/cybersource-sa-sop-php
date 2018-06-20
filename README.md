CyberSource Secure Acceptance
=============================

## Configuration

To run the examples, first create a file `config.php` under directory `payment`

```php
<?php

define('MERCHANT_ID', '<MERCHANT_ID>');
define('PROFILE_ID',  '<PROFILE_ID>');
define('ACCESS_KEY',  '<ACCESS_KEY>');
define('SECRET_KEY',  '<SECRET_KEY>');

// DF TEST: 1snn5n9w, LIVE: k8vif92e 
define('DF_ORG_ID', '1snn5n9w');

///// PAYMENT URL /////

// TEST
define('PAYMENT_URL', 'https://testsecureacceptance.cybersource.com/silent/pay');

// LIVE
//define('PAYMENT_URL', 'https://secureacceptance.cybersource.com/silent/pay');

// EOF
```

## Report Query

create a file `report_config.php`

```php
<?php

date_default_timezone_set('UTC');

// TEST
define('REPORT_ENDPOINT', 'https://ebctest.cybersource.com/ebctest/Query');

// LIVE
//define('REPORT_ENDPOINT', 'https://ebc.cybersource.com/ebctest/Query');

define('MERCHANT_ID',  '<MERCHANT_ID>');

define('RPT_USERNAME', '<USERNAME>');
define('RPT_PASSWORD', '<PASSWORD>');

define('PROXY_ENABLE', false);
define('PROXY_HOST',   '127.0.0.1');
define('PROXY_PORT',   3128);
define('PROXY_AUTHEN', false);
define('PROXY_USER',   '<PROXY_USER>');
define('PROXY_PASS',   '<PROXY_PASS>');

// EOF
```

## Test
```
php -t ./ -S 0.0.0.0:8088
```

## Open Web Browser
- http://localhost:8088/payment/