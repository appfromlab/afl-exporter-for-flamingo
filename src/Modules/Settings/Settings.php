<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings;

use function Appfromlab\AFL_Exporter_For_Flamingo\plugin;

defined( 'ABSPATH' ) || exit;

abstract class Settings {

	abstract public static function get_setting_prefix();
	abstract public static function get_setting_key_list();
	abstract public static function register_settings_with_wordpress();
	abstract public static function get_default_value( $key );

	protected static function get_page_slug() {
		return plugin()->config( 'app' )->get( 'settings' )['page_slug'];
	}

	protected static function get_setting_group_key() {
		return plugin()->config( 'app' )->get( 'settings' )['setting_group_key'];
	}

	public static function get_setting_section_id( $key ) {
		return plugin()->config( 'app' )->get( 'option_key_prefix' ) . static::get_setting_prefix() . $key;
	}

	public static function get_setting_key( $key ) {
		return static::get_setting_prefix() . $key;
	}

	public static function get_option_key( $key ) {
		return plugin()->config( 'app' )->get( 'option_key_prefix' ) . static::get_setting_prefix() . $key;
	}

	public static function get_setting_value( $key ) {
		return plugin()->get_option( self::get_setting_key( $key ), static::get_default_value( $key ) );
	}

	public static function add_setting( $key, $value, $autoload = false ) {
		return plugin()->add_option( self::get_setting_key( $key ), $value, $autoload );
	}

	public static function update_setting( $key, $value ) {
		return plugin()->update_option( self::get_setting_key( $key ), $value );
	}

	public static function delete_setting( $key ) {
		return plugin()->delete_option( self::get_setting_key( $key ) );
	}

	public static function create_default_settings() {

		foreach ( static::get_setting_key_list() as $key ) {
			self::add_setting( $key, static::get_default_value( $key ), false );
		}
	}

	public static function delete_all_settings() {

		foreach ( static::get_setting_key_list() as $key ) {
			self::delete_setting( $key );
		}
	}
}
