<?php

namespace WP_Forge\CookieManager;

/**
 * Class Cookie
 */
class Cookie {

	/**
	 * The cookie name
	 *
	 * @var string $name
	 */
	public $name;

	/**
	 * The cookie domain
	 *
	 * If set to www.example.com, the cookie will only be available for that domain and any subdomains (e.g. w2.www.example.com).
	 * If set to example.com or .example.com, the cookie will be available for the entire domain including ALL subdomains.
	 *
	 * @var string $domain
	 */
	public $domain = '';

	/**
	 * The cookie path
	 *
	 * If set to '/', the cookie will be available on all pages within the domain.
	 * If set to '/foo/', the cookie will only be available on the /foo/ page and all sub-pages.
	 *
	 * @var string $path
	 */
	public $path = '/';

	/**
	 * Whether the cookie should only be sent over HTTPS.
	 *
	 * @var bool $secure
	 */
	public $secure = false;

	/**
	 * Whether to make the cookie accessible only through the HTTP protocol.
	 * If true, the cookie won't be accessible in Javascript and can help reduce identity theft through XSS attacks.
	 *
	 * @var bool $httpOnly
	 */
	public $httpOnly = false;

	/**
	 * Make a new cookie instance.
	 *
	 * @param string $name The cookie name.
	 *
	 * @return Cookie The cookie instance.
	 */
	public static function make( $name ) {
		return new Cookie( $name );
	}

	/**
	 * Constructor
	 *
	 * @param string $name The cookie name.
	 */
	public function __construct( string $name ) {
		$this->name   = $name;
		$this->domain = $_SERVER['HTTP_HOST'];
	}

	/**
	 * Checks whether the cookie exists.
	 *
	 * @return bool Whether or not the cookie exists.
	 */
	public function exists() {
		return isset( $_COOKIE[ $this->name ] );
	}

	/**
	 * Get the cookie value.
	 *
	 * @param string $default The default value to return if the cookie doesn't exist (defaults to an empty string).
	 *
	 * @return string The cookie value or the default value if the cookie doesn't exist.
	 */
	public function value( string $default = '' ) {
		return $this->exists() ? $_COOKIE[ $this->name ] : $default;
	}

	/**
	 * Set the cookie.
	 *
	 * @param string $value      The cookie value.
	 * @param int    $expiration The expiration timestamp.
	 *
	 * @return bool Whether the cookie was set successfully.
	 */
	public function set( string $value, int $expiration = 0 ) {
		return setcookie( $this->name, $value, $expiration, $this->path, $this->domain, $this->secure, $this->httpOnly );
	}

	/**
	 * Delete the cookie.
	 *
	 * @return bool Whether the cookie was deleted.
	 */
	public function delete() {
		if ( $this->exists() ) {
			$this->set( $this->value(), time() - HOUR_IN_SECONDS );

			return true;
		}

		return false;
	}

	/**
	 * Set the cookie domain.
	 *
	 * @param string $domain The cookie domain.
	 *
	 * @return $this
	 */
	public function setDomain( string $domain ) {
		$this->domain = $domain;

		return $this;
	}

	/**
	 * Set the cookie path.
	 *
	 * @param string $path The cookie path.
	 *
	 * @return $this
	 */
	public function setPath( string $path ) {
		$this->path = $path;

		return $this;
	}

	/**
	 * Set whether the cookie should only be sent over HTTPS.
	 *
	 * @param bool $secure Whether the cookie should only be sent over HTTPS.
	 *
	 * @return $this
	 */
	public function setSecure( bool $secure ) {
		$this->secure = $secure;

		return $this;
	}

	/**
	 * Set whether the cookie should only be accessible through the HTTP protocol.
	 *
	 * @param bool $httpOnly Whether the cookie should only be accessible through the HTTP protocol.
	 *
	 * @return $this
	 */
	public function setHttpOnly( bool $httpOnly ) {
		$this->httpOnly = $httpOnly;

		return $this;
	}

}
