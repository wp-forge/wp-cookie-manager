# WordPress Cookie Manager
A WordPress library to simplify cookie management.

## What It Does
Abstracts away all the PHP cookie management and WordPress cookie constants so you can just get and set cookies. 

## How to Use It

1. Add to your project via [Composer](https://getcomposer.org/):

```bash
$ composer require wpscholar/wp-cookie-management
```

2. Make sure you have added the Composer autoloader to your project:

```php
<?php

require __DIR__ . '/vendor/autoload.php';
```

3. Start managing cookies

```php
<?php

use wpscholar\WordPress\CookieManager;

// Create a cookie
$cookie = CookieManager::setCookie('mycookie', 'myvalue', time() + 86400); // Expires one day from now

// Check if cookie exists
$hasCookie = CookieManager::hasCookie('mycookie');

// Get cookie value
$value = CookieManager::getCookie('mycookie');

// Get cookie with default (fallback) value
$value = CookieManager::getCookie('mycookie', 'mydefaultvalue');

// Delete cookie
CookieManager::deleteCookie('mycookie');
```
