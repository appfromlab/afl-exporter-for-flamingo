<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Plugin;

use function Appfromlab\AFL_Exporter_For_Flamingo\plugin;

defined( 'ABSPATH' ) || exit;

class Plugin_Lifecycle {

	public static function plugin_loaded() {

		do_action( 'Appfromlab/AFL_Exporter_For_Flamingo/plugin_loaded_before' );

		plugin()->service_provider_manager()->plugin_loaded();
		plugin()->service_provider_manager()->register_hooks();

		do_action( 'Appfromlab/AFL_Exporter_For_Flamingo/plugin_loaded' );
	}

	public static function plugin_init() {

		Plugin_Activator::maybe_install();

		do_action( 'Appfromlab/AFL_Exporter_For_Flamingo/plugin_init_before' );

		plugin()->service_provider_manager()->init();

		do_action( 'Appfromlab/AFL_Exporter_For_Flamingo/plugin_init' );
	}

	public static function plugin_admin_init() {

		do_action( 'Appfromlab/AFL_Exporter_For_Flamingo/plugin_admin_init_before' );

		plugin()->service_provider_manager()->admin_init();

		do_action( 'Appfromlab/AFL_Exporter_For_Flamingo/plugin_admin_init' );
	}

	public static function plugin_activate() {

		Plugin_Activator::boot();

		do_action( 'Appfromlab/AFL_Exporter_For_Flamingo/plugin_activate' );
	}

	public static function plugin_deactivate() {

		Plugin_Deactivator::boot();

		do_action( 'Appfromlab/AFL_Exporter_For_Flamingo/plugin_deactivate' );
	}

	public static function plugin_uninstall() {

		Plugin_Uninstaller::boot();

		do_action( 'Appfromlab/AFL_Exporter_For_Flamingo/plugin_uninstall' );
	}
}
