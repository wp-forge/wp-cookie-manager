<?php

namespace WP_Forge\CookieManager;

/**
 * Class CookieManager
 */
class CookieManager {

	public $namePrefix = 'wp-';
	public $nameSuffix = '-' . COOKIEHASH;
	public $path = COOKIEPATH;
	public $domain = COOKIE_DOMAIN;
	public $secure = false;
	public $httpOnly = false;

	/**
	 * Get an instance of the cookie manager.
	 *
	 * @return CookieManager The cookie manager instance.
	 */
	public static function get() {
		return new CookieManager();
	}

	/**
	 * Set up the cookie manager settings.
	 */
	public function __construct() {

		// Set to secure if HTTPS is on
		$this->secure = is_ssl();

		// If the `COOKIE_DOMAIN` constant is not set, use the current domain.
		if ( empty( $this->domain ) ) {
			$this->domain = $_SERVER['HTTP_HOST'];
		}
	}

	/**
	 * Get the cookie instance.
	 *
	 * @param string $name The cookie name.
	 *
	 * @return Cookie The cookie instance.
	 */
	public function cookie( string $name ) {
		return Cookie::make( $this->namePrefix . $name . $this->nameSuffix )
		             ->setPath( $this->path )
		             ->setDomain( $this->domain )
		             ->setSecure( $this->secure )
		             ->setHttpOnly( $this->httpOnly );
	}

}
