<?php
/**
 * Plugin Name:       AFL Exporter for Flamingo
 * Plugin URI:        https://github.com/appfromlab/afl-exporter-for-flamingo/
 * Description:       Provide hooks for the Flamingo Export class.
 * Author:            Appfromlab
 * Author URI:        https://www.appfromlab.com/
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       afl-exporter-for-flamingo
 * Domain Path:       /languages/
 * Version:           1.2.1
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Tested up to:      6.8
 * Requires Plugins:  flamingo
 *
 * Copyright (C) 2025 Appfromlab Pte Ltd
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Appfromlab\AFL_Exporter_For_Flamingo;

use Appfromlab\AFL_Exporter_For_Flamingo\Plugin\Plugin;
use Appfromlab\AFL_Exporter_For_Flamingo\Framework\Logger;

defined( 'ABSPATH' ) || exit;

// definition.
define( 'AFL_EXPORTER_FOR_FLAMINGO_VERSION', '1.2.1' );
define( 'AFL_EXPORTER_FOR_FLAMINGO_PLUGIN_FILE_PATH', __FILE__ );
define( 'AFL_EXPORTER_FOR_FLAMINGO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'AFL_EXPORTER_FOR_FLAMINGO_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'AFL_EXPORTER_FOR_FLAMINGO_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

require_once 'vendor/autoload.php';

/**
 * Get plugin instance
 *
 * @return Plugin
 */
function plugin() {
	return Plugin::instance();
}

function logger() {
	return Logger::instance();
}

/**
 * Run plugin
 *
 * @return void
 */
plugin()->boot( __FILE__ );
