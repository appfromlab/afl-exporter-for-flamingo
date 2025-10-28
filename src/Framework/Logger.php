<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Framework;

defined( 'ABSPATH' ) || exit;

/**
 * @since 0.0.1
 */
class Logger {

	protected static $instance;

	private static $enable_log = false;

	public function __construct() {
	}

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();

			if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
				self::$instance->enable( true );
			}
		}

		return self::$instance;
	}

	public function enable( bool $status ) {

		self::$enable_log = $status;
	}

	public function write( $message ) {
		if ( true === self::$enable_log ) {
			// phpcs:disable WordPress.PHP.DevelopmentFunctions
			\error_log( \var_export( $message, true ) );
			// phpcs:enable
		}
	}
}
