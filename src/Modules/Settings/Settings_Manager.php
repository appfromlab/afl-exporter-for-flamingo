<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings;

class Settings_Manager {

	protected $modules_list = array();
	protected $settings     = array();

	private function __construct() {
	}

	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Load Setting Registrars from config
	 *
	 * @param array $modules_list List of setting modules.
	 * @return void
	 */
	public function load_modules( $modules_list ) {

		$this->modules_list = array();

		if ( is_array( $modules_list ) && ! empty( $modules_list ) ) {
			foreach ( $modules_list as $module_name => $module_class ) {
				$this->add_module( $module_name, $module_class );
			}
		}
	}

	public function add_module( $module_name, $module_class ) {

		if ( ! is_subclass_of( $module_class, Settings::class ) ) {
			return;
		}

		if ( in_array( $module_class, $this->modules_list, true ) ) {
			return;
		}

		$this->modules_list[ $module_name ] = $module_class;
	}

	public function get_module_list() {
		return $this->modules_list;
	}

	public function create_default_settings() {

		foreach ( self::get_module_list() as $module_class ) {

			if ( class_exists( $module_class ) && is_callable( array( $module_class, 'create_default_settings' ) ) ) {
				$module_class::create_default_settings();
			}
		}
	}

	public function delete_all_settings() {

		foreach ( self::get_module_list() as $module_class ) {

			if ( class_exists( $module_class ) && is_callable( array( $module_class, 'delete_all_settings' ) ) ) {
				$module_class::delete_all_settings();
			}
		}
	}

	public function get_all_settings() {

		$all_settings = array();

		foreach ( self::get_module_list() as $module_class ) {

			if ( class_exists( $module_class ) && is_callable( array( $module_class, 'get_setting_key_list' ) ) ) {

				$setting_keys = $module_class::get_setting_key_list();

				if ( is_array( $setting_keys ) && ! empty( $setting_keys ) ) {
					foreach ( $setting_keys as $key ) {
						$all_settings[ $module_class::get_setting_key( $key ) ] = $module_class::get_setting_value( $key );
					}
				}
			}
		}

		return $all_settings;
	}

	public function get_setting( $key ) {

		if ( empty( $this->settings ) ) {
			$this->settings = $this->get_all_settings();
		}

		if ( array_key_exists( $key, $this->settings ) ) {
			return $this->settings[ $key ];
		}

		return null;
	}

	public function register_settings_with_wordpress() {

		foreach ( self::get_module_list() as $module_class ) {

			if ( class_exists( $module_class ) && is_callable( array( $module_class, 'register_settings_with_wordpress' ) ) ) {
				$module_class::register_settings_with_wordpress();
			}
		}
	}
}
