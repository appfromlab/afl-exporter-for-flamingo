<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Modules\Exporter;

use Appfromlab\AFL_Exporter_For_Flamingo\Framework\Service_Provider;

defined( 'ABSPATH' ) || exit;

class Exporter_Service_Provider extends Service_Provider {

	public function register_hooks() {

		if (
			class_exists( 'Flamingo_Inbound_Message' )
			&& class_exists( 'Flamingo_CSV' )
		) :

			add_filter( 'flamingo_inbound_csv_class', array( Exporter_Actions::class, 'flamingo_inbound_csv_class' ), 10, 1 );
		endif;
	}
}
