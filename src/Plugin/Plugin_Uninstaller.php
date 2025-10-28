<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Plugin;

use Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings\Settings_Manager;

use function Appfromlab\AFL_Exporter_For_Flamingo\plugin;

defined( 'ABSPATH' ) || exit;

class Plugin_Uninstaller {

	public function __construct() {
	}

	public static function boot() {
	}

	public static function uninstall() {

		if ( ! self::should_delete_data() ) {
			return;
		}

		self::delete_scheduled_hooks();
		self::delete_tables();
		self::delete_transients();
		self::delete_settings();

		plugin()->delete_option( 'version' );
	}

	public static function should_delete_data() {

		return true === Plugin_Uninstall_Settings::get_setting_value( 'delete_data' ) ? true : false;
	}

	public static function delete_settings() {

		Settings_Manager::get_instance()->delete_all_settings();
	}

	public static function delete_transients() {

		Plugin_Deactivator::delete_transients();
	}

	public static function delete_scheduled_hooks() {
	}

	public static function delete_tables() {
	}
}
