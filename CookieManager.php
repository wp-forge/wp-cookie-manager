<?php

namespace wpscholar\WordPress;

/**
 * Class CookieManager
 *
 * @package wpscholar\WordPress
 */
class CookieManager {

	/**
	 * Set a cookie
	 *
	 * @param string $name The cookie name.
	 * @param string $value The cookie value.
	 * @param int $expiration A Unix timestamp representing the expiration (use time() plus seconds until expiration).
	 */
	public static function setCookie( $name, $value, $expiration ) {
		setcookie( $name, $value, $expiration, COOKIEPATH, COOKIE_DOMAIN );
	}

	/**
	 * Check if a cookie exists
	 *
	 * @param string $name
	 *
	 * @return bool Whether or not the cookie exists.
	 */
	public static function hasCookie( $name ) {
		return isset( $_COOKIE[ $name ] );
	}

	/**
	 * Get a cookie
	 *
	 * @param string $name The cookie name.
	 * @param mixed $default The default value to return if the cookie doesn't exist (defaults to null).
	 *
	 * @return mixed Returns the value or the default if the cookie doesn't exist.
	 */
	public static function getCookie( $name, $default = null ) {
		return self::hasCookie( $name ) ? $_COOKIE[ $name ] : $default;
	}

	/**
	 * Delete a cookie
	 *
	 * @param string $name The name of the cookie to delete.
	 */
	public static function deleteCookie( $name ) {
		if ( self::hasCookie( $name ) ) {
			$value = self::getCookie( $name );
			$expiration = time() - HOUR_IN_SECONDS;
			setcookie( $name, $value, $expiration, COOKIEPATH, COOKIE_DOMAIN );
		}
	}

}