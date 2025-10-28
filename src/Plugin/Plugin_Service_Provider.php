<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Plugin;

use Appfromlab\AFL_Exporter_For_Flamingo\Framework\Service_Provider;
use Appfromlab\AFL_Exporter_For_Flamingo\Plugin\Plugin_Actions;

defined( 'ABSPATH' ) || exit;

class Plugin_Service_Provider extends Service_Provider {

	public function register_hooks() {

		// admin hooks.
		// add_action( 'admin_menu', array( Plugin_Actions::class, 'plugin_admin_menu' ) );.

		// plugins page hooks.
		add_filter( 'plugin_row_meta', array( Plugin_Actions::class, 'plugin_row_meta' ), 10, 2 );

		// add_filter( 'plugin_action_links_' . $this->app->config( 'app' )->get( 'plugin_basename' ), array( Plugin_Actions::class, 'plugin_action_links' ), 10, 1 );.
	}
}
