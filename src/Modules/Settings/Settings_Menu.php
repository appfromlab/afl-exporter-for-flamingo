<?php
namespace Appfromlab\AFL_Exporter_For_Flamingo\Modules\Settings;

use function Appfromlab\AFL_Exporter_For_Flamingo\plugin;

defined( 'ABSPATH' ) || exit;

class Settings_Menu {

	public static function register_hooks() {

		// add_action( 'admin_menu', static::class . '::add_admin_menu' );.
	}

	public static function add_admin_menu() {

		add_options_page(
			__( 'AFL Exporter for Flamingo Settings', 'afl-exporter-for-flamingo' ),
			__( 'AFL Exporter for Flamingo', 'afl-exporter-for-flamingo' ),
			'manage_options',
			'afl-exporter-for-flamingo',
			static::class . '::render_settings_page'
		);
	}

	public static function render_settings_page() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
			<?php
				settings_fields( plugin()->config( 'app' )->get( 'settings' )['setting_group_key'] );
				do_settings_sections( plugin()->config( 'app' )->get( 'settings' )['page_slug'] );
				submit_button();
			?>
			</form>
		</div>
		<?php
	}
}
