<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings;

defined( 'ABSPATH' ) || exit;

class Settings_Fields {

	public static function render_field_number( $option_name, $option_value = 0, $min = 0, $max = 100, $description = '' ) {

		printf(
			'<input type="number" min="%1$s" max="%2$s" id="%3$s" name="%3$s" value="%4$s">',
			esc_attr( $min ),
			esc_attr( $max ),
			esc_attr( $option_name ),
			esc_attr( $option_value )
		);

		if ( $description ) {
			echo '<p class="description">' . esc_html( $description ) . '</p>';
		}
	}

	public static function render_field_checkbox( $option_name, $option_value = false, $description = '' ) {

		printf( '<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s>', esc_attr( $option_name ), checked( $option_value, true, false ) );
		if ( $description ) {
			echo '<span class="description" style="margin-left: 6px">' . esc_html( $description ) . '</span>';
		}
	}
}
