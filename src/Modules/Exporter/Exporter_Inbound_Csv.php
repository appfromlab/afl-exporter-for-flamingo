<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Modules\Exporter;

class Exporter_Inbound_Csv extends \Flamingo_Csv {

	public function get_file_name() {

		return sprintf(
			'%1$s-flamingo-inbound-%2$s.csv',
			sanitize_key( get_bloginfo( 'name' ) ),
			wp_date( 'Y-m-d' )
		);
	}

	public function print_data() {

		$args = array(
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		if ( ! empty( $_REQUEST['s'] ) ) {
			$args['s'] = $_REQUEST['s'];
		}

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			if ( 'subject' === $_REQUEST['orderby'] ) {
				$args['meta_key'] = '_subject';
				$args['orderby']  = 'meta_value';
			} elseif ( 'from' === $_REQUEST['orderby'] ) {
				$args['meta_key'] = '_from';
				$args['orderby']  = 'meta_value';
			}
		}

		if (
			! empty( $_REQUEST['order'] )
			&& 'asc' === strtolower( $_REQUEST['order'] )
		) {
			$args['order'] = 'ASC';
		}

		if ( ! empty( $_REQUEST['m'] ) ) {
			$args['m'] = $_REQUEST['m'];
		}

		if ( ! empty( $_REQUEST['channel_id'] ) ) {
			$args['channel_id'] = $_REQUEST['channel_id'];
		}

		if ( ! empty( $_REQUEST['channel'] ) ) {
			$args['channel'] = $_REQUEST['channel'];
		}

		$items = \Flamingo_Inbound_Message::find( $args );

		if ( empty( $items ) ) {
			return;
		}

		$form_field_keys = array_keys( $items[0]->fields );

		// Print header.
		$csv_header = array_merge(
			array(
				'id'   => __( 'ID', 'flamingo' ),
				'date' => __( 'Date', 'flamingo' ),
			),
			array_combine( $form_field_keys, $form_field_keys )
		);
		$csv_header = apply_filters( 'afl_eff_flamingo_inbound_csv_header', $csv_header, $items );

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo \flamingo_csv_row( $csv_header );

		// Print items.
		$template_row = array_fill_keys( array_keys( $csv_header ), '' );

		foreach ( $items as $item ) {
			echo "\r\n";

			$row = $template_row;

			// Iterate form fields.
			foreach ( $form_field_keys as $field_key ) {

				if ( array_key_exists( $field_key, $row ) ) {

					$col = isset( $item->fields[ $field_key ] ) ? $item->fields[ $field_key ] : '';

					if ( is_array( $col ) ) {
						$col = flamingo_array_flatten( $col );
						$col = array_filter( array_map( 'trim', $col ) );
						$col = implode( ', ', $col );
					}

					$row[ $field_key ] = $col;
				}
			}

			$row['id']   = $item->id(); // Post ID.
			$row['date'] = get_post_time( 'c', false, $item->id() ); // Date.

			$row = apply_filters( 'afl_eff_flamingo_inbound_csv_item', $row, $item, $csv_header );

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo \flamingo_csv_row( $row );
		}
	}
}
