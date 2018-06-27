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

// PAYMENT URL
// TEST //
define('CYBS_BASE_URL', 'https://testsecureacceptance.cybersource.com/silent');
// LIVE //
//define('CYBS_BASE_URL', 'https://secureacceptance.cybersource.com/silent');

define('PAYMENT_URL', CYBS_BASE_URL . '/pay');
// define('PAYMENT_URL', '/payment/debug.php');

define('TOKEN_CREATE_URL', CYBS_BASE_URL . '/token/create');
define('TOKEN_UPDATE_URL', CYBS_BASE_URL . '/token/update');

// MERCHANT PSP
define('AGGREGATOR_ID', '<AGGREGATOR_ID>');       // String(11)
define('SALES_ORG_ID',  '<SALES_ORG_ID>');        // Integer(11)
define('MERCHANT_DESC', '<MERCHANT_DESCRIPTOR>'); // String(22)

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

### Test Card

```
  Card Type      Card Number       3-D  ECI  Notes
  -------------  ----------------  ---  ---  -------------------------------
  Visa           4000000000000002   Y    5
  Visa           4111111111111111        7
  MasterCard     5200000000000007   Y    2
  MasterCard     5555555555554444        0
  JCB            3569990010083722   Y    5    Without authentication window
  JCB            3569960010083758   Y    6    Enrolled During Shopping
  JCB            3566111111111113        -
```

## Reference

- [Secure Acceptance Silent Order POST Development Guide (PDF)](https://github.com/e-payment/cybersource-secure-acceptance/blob/master/doc/Secure_Acceptance_SOP.pdf)

### White-list IP address

All Secure Acceptance notification messaging will originate from a different range of servers and IP addresses. If you are using any Secure Acceptance services, you must add the following IP address ranges to any whitelist or filtering logic.

```
198.241.162.1 - 198.241.162.254
198.241.168.1 - 198.241.168.254
```

- [White-list IP to receive replies and posts from CyberSource](https://support.cybersource.com/s/article/What-IP-addresses-should-I-add-to-my-white-list-to-receive-replies-and-posts-from-CyberSource)