<?php

namespace WP_Forge\CookieManager;

/**
 * Class CookieManager
 */
class CookieManager {

	/**
	 * Set a cookie
	 *
	 * @param string $name       The cookie name.
	 * @param string $value      The cookie value.
	 * @param int    $expiration A Unix timestamp representing the expiration (use time() plus seconds until expiration). Defaults to 0, which will cause the cookie to expire at the end of the user's browsing session.
	 */
	public static function setCookie( $name, $value, $expiration = 0 ) {
		$secure = ( 'https' === parse_url( home_url(), PHP_URL_SCHEME ) );
		setcookie( $name . COOKIEHASH, $value, $expiration, COOKIEPATH, COOKIE_DOMAIN, $secure );
	}

	/**
	 * Check if a cookie exists
	 *
	 * @param string $name
	 *
	 * @return bool Whether or not the cookie exists.
	 */
	public static function hasCookie( $name ) {
		return isset( $_COOKIE[ $name . COOKIEHASH ] );
	}

	/**
	 * Get a cookie
	 *
	 * @param string $name    The cookie name.
	 * @param mixed  $default The default value to return if the cookie doesn't exist (defaults to null).
	 *
	 * @return mixed Returns the value or the default if the cookie doesn't exist.
	 */
	public static function getCookie( $name, $default = null ) {
		return self::hasCookie( $name ) ? $_COOKIE[ $name . COOKIEHASH ] : $default;
	}

	/**
	 * Delete a cookie
	 *
	 * @param string $name The name of the cookie to delete.
	 */
	public static function deleteCookie( $name ) {
		if ( self::hasCookie( $name ) ) {
			$value      = self::getCookie( $name );
			$expiration = time() - HOUR_IN_SECONDS;
			setcookie( $name, $value, $expiration, COOKIEPATH, COOKIE_DOMAIN );
		}
	}

}
