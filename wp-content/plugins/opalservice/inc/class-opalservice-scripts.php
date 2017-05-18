<?php
/**
 * $Desc$
 *
 * @version    $Id$
 * @package    opalservice
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2016 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Opalservice_Scripts{

	/**
	 * Init
	 */
	public static function init(){
		add_action( 'wp_head', array( __CLASS__, 'initAjaxUrl' ), 15 );
	
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'loadScripts' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'loadAdminStyles')  );
 
	}

	/**
	 * load script file in backend
	 */
	public static function loadScripts(){
		// fontIconPicker core CSS -->
 		wp_enqueue_style( 'fontpicker-core-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/jquery.fonticonpicker.min.css', null, '1.0');
 		// required default theme -->
 		wp_enqueue_style( 'fontpicker-default-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css', null, '1.0');
 		// optional themes -->
 		wp_enqueue_style( 'fontpicker-bootstrap-theme-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css', null, '1.0');
 	
		wp_enqueue_style( 'opalservice-frontend-css', OPALSERVICE_PLUGIN_URL . 'assets/css/style.css', null, '1.0');
		wp_enqueue_style( 'bootstrap-vertical-tabs-min-css', OPALSERVICE_PLUGIN_URL . 'assets/css/bootstrap.vertical-tabs.min.css', null, '1.2.2');

		wp_enqueue_script("fontpicker-core-scripts", OPALSERVICE_PLUGIN_URL . 'assets/js/jquery.fonticonpicker.min.js', array( 'jquery' ));
		wp_enqueue_script("opalservice-scripts", OPALSERVICE_PLUGIN_URL . 'assets/js/script.js', array( 'jquery' ), "1.0.0", true);
 
	}

	/**
	 * load script file in backend
	 */
	public static function loadAdminStyles(){
 		//----------------------
 		wp_enqueue_style( 'opalservice-backend-css', OPALSERVICE_PLUGIN_URL . 'assets/css/admin-styles.css', null, '1.0');
		wp_enqueue_script("opalservice-scripts", OPALSERVICE_PLUGIN_URL . 'assets/js/opalservice.js', array( 'jquery' ), "1.0.0", true);
	}
 
    /**
     * add ajax url
     */
	public static function initAjaxUrl() {
		?>
		<script type="text/javascript">
			var ajaxurl = '<?php echo esc_js( admin_url('admin-ajax.php') ); ?>';
			var opalsiteurl = '<?php echo get_template_directory_uri(); ?>';
		</script>
		<?php
	}
}

Opalservice_Scripts::init();