<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Framework;

use Appfromlab\AFL_Exporter_For_Flamingo\Framework\Service_Provider;

defined( 'ABSPATH' ) || exit;

/**
 * @since 0.0.1
 */
class Service_Provider_Manager {

	protected $app;
	protected $service_providers = array();

	public function __construct( Application $app ) {

		$this->app = $app;
	}

	public function boot( $service_providers = array() ) {

		if ( ! empty( $service_providers ) && is_array( $service_providers ) ) {

			foreach ( $service_providers as $provider_name => $provide_class_name ) {

				$this->add( $provider_name, $provide_class_name );
			}
		}

		foreach ( $this->list() as $provider ) {
			$provider->boot();
		}
	}

	public function list() {
		return $this->service_providers;
	}

	public function get( $provider_name ) {

		if ( isset( $this->service_providers[ $provider_name ] ) ) {
			$this->service_providers[ $provider_name ];
		} else {
			return null;
		}
	}

	public function has( $provider_name ) {

		if ( isset( $this->service_providers[ $provider_name ] ) ) {
			return true;
		} else {
			return false;
		}
	}

	public function add( $provider_name, $provider_class_name ) {

		if ( ! class_exists( $provider_class_name ) && ! $this->has( $provider_name ) ) {
			return;
		}

		$provider = new $provider_class_name( $this->app );

		if ( is_a( $provider, Service_Provider::class ) ) {
			$provider->register();
			$this->service_providers[ $provider_name ] = $provider;
		}
	}

	public function plugin_loaded() {

		$service_providers = $this->list();

		if ( ! empty( $service_providers ) ) {
			foreach ( $service_providers as $provider ) {
				$provider->plugin_loaded();
			}
		}
	}

	public function register_hooks() {

		$service_providers = $this->list();

		if ( ! empty( $service_providers ) ) {
			foreach ( $service_providers as $provider ) {
				$provider->register_hooks();
			}
		}
	}

	public function init() {

		$service_providers = $this->list();

		if ( ! empty( $service_providers ) ) {
			foreach ( $service_providers as $provider ) {
				$provider->init();
			}
		}
	}

	public function admin_init() {

		$service_providers = $this->list();

		if ( ! empty( $service_providers ) ) {
			foreach ( $service_providers as $provider ) {
				$provider->admin_init();
			}
		}
	}
}
