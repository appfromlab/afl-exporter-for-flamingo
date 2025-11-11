<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Plugin;

use function Appfromlab\AFL_Exporter_For_Flamingo\plugin;

defined( 'ABSPATH' ) || exit;

class Plugin_Actions {

	public static function plugin_admin_menu() {

		do_action( 'afl_exporter_for_flamingo/plugin_admin_menu' );
	}

	public static function plugin_action_links( $links ) {

		$settings_link = sprintf(
			'<a href="%1$s" aria-label="%2$s">%3$s</a>',
			esc_url( admin_url( 'options-general.php?page=' . rawurlencode( plugin()->config( 'app' )->get( 'settings' )['page_slug'] ) ) ),
			esc_attr( __( 'Settings', 'afl-exporter-for-flamingo' ) ),
			esc_html( __( 'Settings', 'afl-exporter-for-flamingo' ) )
		);

		array_unshift( $links, $settings_link );

		return $links;
	}

	public static function plugin_row_meta( $links, $file ) {

		if ( plugin()->config( 'app' )->get( 'plugin_basename' ) !== $file ) {
			return $links;
		}

		$plugin_links = plugin()->config( 'app' )->get( 'plugin_links' );

		if ( ! empty( $plugin_links ) ) {

			if ( ! empty( $plugin_links['documentation'] ) ) {
				$links[] = sprintf(
					'<a href="%1$s" target="_blank" rel="noopener noreferrer" aria-label="%2$s">%3$s</a>',
					esc_url( $plugin_links['documentation'] ),
					esc_attr( __( 'Documentation', 'afl-exporter-for-flamingo' ) ),
					esc_html( __( 'Documentation', 'afl-exporter-for-flamingo' ) )
				);
			}

			if ( ! empty( $plugin_links['support'] ) ) {
				$links[] = sprintf(
					'<a href="%1$s" target="_blank" rel="noopener noreferrer" aria-label="%2$s">%3$s</a>',
					esc_url( $plugin_links['support'] ),
					esc_attr( __( 'Support', 'afl-exporter-for-flamingo' ) ),
					esc_html( __( 'Support', 'afl-exporter-for-flamingo' ) )
				);
			}
		}

		return $links;
	}
}
