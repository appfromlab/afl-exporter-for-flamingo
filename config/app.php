<?php defined( 'ABSPATH' ) || exit;

return array(
	'name'               => 'AFL Exporter for Flamingo',
	'version'            => AFL_EXPORTER_FOR_FLAMINGO_VERSION,
	'plugin_folder_name' => 'afl-exporter-for-flamingo',
	'plugin_basename'    => 'afl-exporter-for-flamingo/afl-exporter-for-flamingo.php',
	'plugin_dir_path'    => AFL_EXPORTER_FOR_FLAMINGO_PLUGIN_DIR_PATH,
	'plugin_file_path'   => AFL_EXPORTER_FOR_FLAMINGO_PLUGIN_FILE_PATH,
	'meta_prefix'        => '_afl_eff_',
	'meta_prefix_public' => 'afl_eff_',
	'option_key'         => 'afl_eff',
	'option_key_prefix'  => 'afl_eff_',
	'plugin_links'       => array(
		'wordpress_org' => '',
		'premium'       => '',
		'documentation' => 'https://github.com/appfromlab/afl-exporter-for-flamingo/',
		'support'       => '',
	),
	'providers'          => array(
		'Plugin_Service_Provider'   => Appfromlab\AFL_Exporter_For_Flamingo\Plugin\Plugin_Service_Provider::class,
		'Exporter_Service_Provider' => Appfromlab\AFL_Exporter_For_Flamingo\Modules\Exporter\Exporter_Service_Provider::class,
	),
	'settings'           => array(
		'page_slug'         => 'afl-exporter-for-flamingo',
		'capability'        => 'manage_options',
		'setting_group_key' => 'afl_exporter_for_flamingo',
	),
	'setting_modules'    => array(),
	'admin_menu'         => array(
		'menu_slug'     => 'afl-exporter-for-flamingo',
		'menu_position' => 58,
		'capability'    => 'manage_options',
	),
);
