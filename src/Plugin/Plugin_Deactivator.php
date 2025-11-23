<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Plugin;

use function Appfromlab\AFL_Exporter_For_Flamingo\plugin;

defined( 'ABSPATH' ) || exit;

class Plugin_Deactivator {

	public function __construct() {
	}

	public static function boot() {

		self::deactivate();
	}

	public static function deactivate() {

		self::delete_transients();
	}

	public static function delete_transients() {
		global $wpdb;

		$option_key = plugin()->config( 'app' )->get( 'option_key' );

		$transient_name_like         = $wpdb->esc_like( '_transient_' . $option_key . '_' ) . '%';
		$transient_timeout_name_like = $wpdb->esc_like( '_transient_timeout_' . $option_key . '_' ) . '%';

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		$wpdb->query(
			$wpdb->prepare(
				"DELETE FROM $wpdb->options WHERE option_name LIKE %s OR option_name LIKE %s",
				$transient_name_like,
				$transient_timeout_name_like
			)
		);
	}
}
