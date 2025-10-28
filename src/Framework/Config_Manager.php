<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Framework;

defined( 'ABSPATH' ) || exit;

/**
 * @since 0.0.1
 */
class Config_Manager {

	protected $list = array();
	private $primary_folder_path;

	public function __construct() {
	}

	public function boot( $config_folder_path ) {

		$this->set_primary_folder_path( $config_folder_path );
		$this->load_from_file( 'app', $this->get_primary_folder_path() . 'app.php' );
	}

	public function set_primary_folder_path( $folder_path ) {

		$folder_path = rtrim( $folder_path, '/' );
		$folder_path = rtrim( $folder_path, '\\' );

		$this->primary_folder_path = $folder_path . DIRECTORY_SEPARATOR;
	}

	public function get_primary_folder_path() {
		return $this->primary_folder_path;
	}

	public function load_from_file( $key, $file_path ) {

		$config = new Config();
		$config->load_from_file( $file_path );

		$this->list[ $key ] = $config;
	}

	public function get( $key ) {

		if ( isset( $this->list[ $key ] ) ) {
			return $this->list[ $key ];
		} else {
			return null;
		}
	}

	public function set( $key, $value ) {

		if ( isset( $this->list[ $key ] ) ) {
			$this->list[ $key ] = $value;
		}
	}
}
