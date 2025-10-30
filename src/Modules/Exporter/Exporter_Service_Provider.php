<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Modules\Exporter;

use Appfromlab\AFL_Exporter_For_Flamingo\Framework\Service_Provider;

defined( 'ABSPATH' ) || exit;

class Exporter_Service_Provider extends Service_Provider {

	public function register_hooks() {

		if (
			class_exists( 'Flamingo_Inbound_Message' )
			&& class_exists( 'Flamingo_CSV' )
			&& class_exists( 'AFL_WC_UTM_CF7_FLAMINGO' )
			&& method_exists( 'AFL_WC_UTM_CF7_FLAMINGO', 'get_conversion_attribution' )
			&& class_exists( 'AFL_WC_UTM_SERVICE' )
			&& method_exists( 'AFL_WC_UTM_SERVICE', 'get_meta_whitelist' )
			&& class_exists( 'AFL_WC_UTM_SETTINGS' )
			&& method_exists( 'AFL_WC_UTM_SETTINGS', 'get' )
		) :

			add_filter( 'flamingo_inbound_csv_class', array( Exporter_Actions::class, 'flamingo_inbound_csv_class' ), 10, 1 );
		endif;
	}
}
