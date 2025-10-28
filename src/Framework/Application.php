<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Framework;

defined( 'ABSPATH' ) || exit;

/**
 * @since 0.0.1
 */
class Application {

	protected static $instance;

	protected $container;
	protected $service_provider_manager;
	protected $config_manager;

	protected function __construct() {

		$this->container                = new Container();
		$this->config_manager           = new Config_Manager();
		$this->service_provider_manager = new Service_Provider_Manager( $this );
	}

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function boot( $file_path, $config_folder_path = '' ) {

		if ( empty( $config_folder_path ) ) {
			$config_folder_path = trailingslashit( dirname( $file_path ) ) . 'config/';
		}

		$this->config_manager->boot( $config_folder_path );
		$this->service_provider_manager->boot( $this->config( 'app' )->get( 'providers' ) );
	}

	public function container() {

		return $this->container;
	}

	public function config_manager() {

		return $this->config_manager;
	}

	public function config( $key ) {

		return $this->config_manager->get( $key );
	}

	public function service_provider_manager() {

		return $this->service_provider_manager;
	}
}
