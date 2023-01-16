# WordPress Cookie Manager

A WordPress library to simplify cookie management.

## What It Does

Abstracts away all the PHP cookie management and WordPress cookie constants so you can just get and set cookies.

## How to Use It

1. Add to your project via [Composer](https://getcomposer.org/):

```bash
$ composer require wp-forge/wp-cookie-manager
```

2. Make sure you have added the Composer autoloader to your project:

```php
<?php

require __DIR__ . '/vendor/autoload.php';
```

3. Start managing cookies

```php
<?php

use WP_Forge\CookieManager\CookieManager;

// Set a cookie
CookieManager::get()->cookie('myCookieName')->set('myCookieValue', time() + 86400);  // Expires one day from now

// Check if cookie exists
CookieManager::get()->cookie('myCookieName')->exists();

// Get cookie value, or default value if it doesn't exist
CookieManager::get()->cookie('myCookieName')->value('myDefaultValue');

// Delete cookie
CookieManager::get()->cookie('myCookieName')->delete();
```

## Using the Underlying Cookie Class

The `CookieManager` provides you with a global way to configure and manage working with cookies. However, if you need to
work with a cookie that needs a very different configuration, you can use the `Cookie` class directly.

Note that using the `Cookie` class directly will not use the smart defaults provided by the `CookieManager`.

```php
<?php

use WP_Forge\CookieManager\Cookie;

// Create a cookie instance
$cookie = Cookie::make('myCookieName')
  ->setDomain(COOKIE_DOMAIN)
  ->setPath(COOKIEPATH)
  ->setSecure(is_ssl())
  ->setHttpOnly(true);
  
// Set a cookie
$cookie->set('myCookieValue', time() + 86400) // Expires one day from now

// Check if cookie exists
$cookie->exists();

// Get cookie value
$cookie->value();

// Get cookie value, or default value if the cookie doesn't exist
$cookie->value('myDefaultValue');

// Delete cookie
$cookie->delete();
```

## Advanced Usage

By default, the `CookieManager` will use smart, WordPress-specific defaults. These defaults can be overridden and 
the steps to do so are outlined below.

### Customizable properties

#### Name Prefix

By default, all cookie names are prefixed with `wp-`. This can be changed by setting the `$namePrefix` property.

```php
<?php

use WP_Forge\CookieManager\CookieManager;

$cookieManager = CookieManager::get();
$cookieManager->namePrefix = 'my-prefix-'; // Set to an empty string to disable the prefix

$cookieManager->cookie('myCookieName')->exists();
```

#### Name Suffix

By default, all cookie names are suffixed with a `-` followed by the WordPress `COOKIEHASH` constant. This can be
changed by setting the`$nameSuffix` property.

```php
<?php

use WP_Forge\CookieManager\CookieManager;

$cookieManager = CookieManager::get();
$cookieManager->nameSuffix = '-my-suffix'; // Set to an empty string to disable the suffix

$cookieManager->cookie('myCookieName')->exists();
```

#### Path

By default, the cookie path is set to the WordPress `COOKIEPATH` constant. This can be changed by setting the`$path`
property.

```php
<?php

use WP_Forge\CookieManager\CookieManager;

$cookieManager = CookieManager::get();
$cookieManager->path = '/my/path';

$cookieManager->cookie('myCookieName')->exists();
```

#### Domain

By default, the cookie domain is set to the WordPress `COOKIE_DOMAIN` constant. If the `COOKIE_DOMAIN` is empty, it
falls back to the `$_SERVER['HTTP_HOST']` value (i.e. the current domain). This can be overwritten by setting
the`$domain` property.

```php
<?php

use WP_Forge\CookieManager\CookieManager;

$cookieManager = CookieManager::get();
$cookieManager->domain = '.example.com';

$cookieManager->cookie('myCookieName')->exists();
```

#### Secure

By default, the `$secure` property is set to the value returned by the `is_ssl()` WordPress function. Setting the value
to `true` will ensure that the cookie is only sent over an HTTPS connection. Setting the value to `false` will ensure
that the cookie is always sent, regardless of whether the connection is encrypted.

```php
<?php

use WP_Forge\CookieManager\CookieManager;

$cookieManager = CookieManager::get();
$cookieManager->secure = false;

$cookieManager->cookie('myCookieName')->exists();
```

#### HTTP Only

By default, the `$httpOnly` property is set to `false`, which means that the cookie will be available in all contexts.
Setting the value to `true` will ensure that the cookie is only accessible in PHP, not JavaScript. This can be useful to
help prevent identify theft via XSS attacks.

```php
<?php

use WP_Forge\CookieManager\CookieManager;

$cookieManager = CookieManager::get();
$cookieManager->httpOnly = true;

$cookieManager->cookie('myCookieName')->exists();
```
