<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Plugin;

use Appfromlab\AFL_Exporter_For_Flamingo\Framework\Application;
use Appfromlab\AFL_Exporter_For_Flamingo\Plugin\Plugin_Lifecycle;

defined( 'ABSPATH' ) || exit;

class Plugin extends Application {

	protected static $instance;

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function boot( $file_path, $config_folder_path = '' ) {

		parent::boot( $file_path, $config_folder_path );

		// can only call static methods or functions.
		register_activation_hook( $file_path, array( Plugin_Lifecycle::class, 'plugin_activate' ) );
		register_deactivation_hook( $file_path, array( Plugin_Lifecycle::class, 'plugin_deactivate' ) );
		register_uninstall_hook( $file_path, array( Plugin_Lifecycle::class, 'plugin_uninstall' ) );

		// standard hooks.
		add_action( 'plugins_loaded', array( Plugin_Lifecycle::class, 'plugin_loaded' ) );
		add_action( 'init', array( Plugin_Lifecycle::class, 'plugin_init' ) );
		add_action( 'admin_init', array( Plugin_Lifecycle::class, 'plugin_admin_init' ) );
	}

	public function get_version() {
		return $this->config( 'app' )->get( 'version' );
	}

	public function get_installed_version() {
		return $this->get_option( 'version' );
	}

	public function get_option( $option_name, $default_value = false ) {

		return get_option( $this->config( 'app' )->get( 'option_key_prefix' ) . $option_name, $default_value );
	}

	public function add_option( $option_name, $option_value, $autoload = false ) {

		return add_option( $this->config( 'app' )->get( 'option_key_prefix' ) . $option_name, $option_value, '', $autoload );
	}

	public function update_option( $option_name, $option_value ) {

		return update_option( $this->config( 'app' )->get( 'option_key_prefix' ) . $option_name, $option_value );
	}

	public function delete_option( $option_name ) {

		return delete_option( $this->config( 'app' )->get( 'option_key_prefix' ) . $option_name );
	}

	public function get_transient( $transient_name ) {

		return get_transient( $this->config( 'app' )->get( 'option_key_prefix' ) . $transient_name );
	}

	public function set_transient( $transient_name, $transient_value, $expiration ) {

		return set_transient( $this->config( 'app' )->get( 'option_key_prefix' ) . $transient_name, $transient_value, $expiration );
	}

	public function delete_transient( $transient_name ) {

		return delete_transient( $this->config( 'app' )->get( 'option_key_prefix' ) . $transient_name );
	}
}
