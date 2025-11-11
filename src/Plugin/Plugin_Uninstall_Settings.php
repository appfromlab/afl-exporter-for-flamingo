<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Plugin;

use Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings\Settings;
use Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings\Settings_Fields;

defined( 'ABSPATH' ) || exit;

class Plugin_Uninstall_Settings extends Settings {

	public static function get_setting_prefix() {
		return 'uninstall_';
	}

	public static function get_setting_key_list() {
		return array(
			'delete_data',
		);
	}

	public static function register_settings_with_wordpress() {

		\add_settings_section(
			static::get_setting_section_id( 'settings' ),
			__( 'Uninstall Settings', 'afl-exporter-for-flamingo' ),
			static::class . '::render_section_description',
			static::get_page_slug()
		);

		\register_setting(
			static::get_setting_group_key(),
			static::get_option_key( 'delete_data' ),
			array(
				'type'              => 'boolean',
				'default'           => static::get_default_value( 'delete_data' ),
				'sanitize_callback' => 'rest_sanitize_boolean',
			)
		);

		\add_settings_field(
			static::get_option_key( 'delete_data' ),
			__( 'Delete All Plugin Data', 'afl-exporter-for-flamingo' ),
			static::class . '::render_field_delete_data',
			static::get_page_slug(),
			static::get_setting_section_id( 'settings' )
		);
	}

	public static function get_default_value( $key ) {
		$value = '';

		switch ( $key ) {
			case 'delete_data':
				$value = apply_filters( 'afl_exporter_for_flamingo/plugin_uninstall_settings/default_delete_data', false );
				break;
			default:
				$value = '';
				break;
		}

		return $value;
	}

	public static function render_section_description() {
		echo '<p>' . esc_html__( 'WARNING: Please make a backup of your WordPress.', 'afl-exporter-for-flamingo' ) . '</p>';
	}

	public static function render_field_delete_data() {

		Settings_Fields::render_field_checkbox(
			static::get_option_key( 'delete_data' ),
			static::get_setting_value( 'delete_data' ),
			__( 'Yes, delete all plugin data during plugin uninstallation.', 'afl-exporter-for-flamingo' )
		);
	}
}
