<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings;

use Appfromlab\AFL_Exporter_For_Flamingo\Framework\Service_Provider;
use Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings\Settings_Manager;

defined( 'ABSPATH' ) || exit;

class Settings_Service_Provider extends Service_Provider {

	public function register() {

		Settings_Manager::get_instance()->load_modules( $this->app->config( 'app' )->get( 'setting_modules' ) );
	}

	public function register_hooks() {

		Settings_Menu::register_hooks();
	}

	public function admin_init() {

		Settings_Manager::get_instance()->register_settings_with_wordpress();
	}
}
