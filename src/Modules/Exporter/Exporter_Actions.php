<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Modules\Exporter;

use Appfromlab\AFL_Exporter_For_Flamingo\Modules\Exporter\Exporter_Inbound_Csv;

defined( 'ABSPATH' ) || exit;

class Exporter_Actions {

	public static function flamingo_inbound_csv_class( $csv_class ) {
		return Exporter_Inbound_Csv::class;
	}
}
