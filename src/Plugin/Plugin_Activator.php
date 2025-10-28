<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Plugin;

use Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings\Settings_Manager;
use function Appfromlab\AFL_Exporter_For_Flamingo\plugin;

defined( 'ABSPATH' ) || exit;

class Plugin_Activator {

	public function __construct() {
	}

	public static function boot() {

		self::install();
	}

	public static function is_installing() {

		return 'yes' === plugin()->get_transient( 'installing' ) ? true : false;
	}

	public static function start_installing() {

		plugin()->set_transient( 'installing', 'yes', MINUTE_IN_SECONDS * 10 );
	}

	public static function finish_installing() {

		// finally save version.
		if ( false === plugin()->get_option( 'version' ) ) {
			plugin()->add_option( 'version', plugin()->get_version(), true );
		} else {
			plugin()->update_option( 'version', plugin()->get_version() );
		}

		plugin()->delete_transient( 'installing' );
	}

	public static function should_update() {

		return plugin()->get_installed_version() !== plugin()->get_version() ? true : false;
	}

	public static function should_upgrade() {

		if ( version_compare( plugin()->get_installed_version(), plugin()->get_version(), '<' ) ) {
			return true;
		}

		return false;
	}

	public static function maybe_install() {

		if ( self::should_update() ) {
			self::install();
		}
	}

	public static function install() {

		if ( ! is_blog_installed() || self::is_installing() ) {
			return false;
		}

		self::start_installing();

		// run install sequence.
		self::create_default_settings();

		self::finish_installing();
	}

	public static function create_default_settings() {

	}

	public static function create_database_tables() {
	}
}
