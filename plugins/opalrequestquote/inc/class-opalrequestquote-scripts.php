<?php
/**
 * $Desc$
 *
 * @version    $Id$
 * @package    opalrequestquote
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
class Opalrequestquote_Scripts{

	/**
	 * Init
	 */
	public static function init(){
		add_action( 'wp_head', array( __CLASS__, 'initAjaxUrl' ), 15 );
		
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'loadFrontendStyles' ), 999 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'loadScripts' ),999 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'loadAdminStyles') );
	}

	/**
	 * load script file in backend
	 */
	public static function loadScripts(){

		wp_enqueue_script("magnific-popup-js", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/libs/jquery.magnific-popup.min.js', null, "1.0.1", true);
		wp_enqueue_script("jquery-geocomplete-js", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/libs/jquery.geocomplete.min.js', null, "1.7.0", true);
		$key = 'AIzaSyDRVUZdOrZ1HuJFaFkDtmby0E93eJLykIk';
		$api = apply_filters( 'opallocation_google_map_api_123',  '//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key='.$key );	
		wp_enqueue_script("google-map-api",$api , null, "0.0.1", false);

		wp_enqueue_script("jquery-validation", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/libs/jquery.validate.min.js', array( 'jquery' ) );
		wp_enqueue_script("datetimepicker-js", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/libs/jquery.datetimepicker.full.min.js', array( 'jquery' ), "2.0.0", true);
		wp_enqueue_script("jquery-steps-js", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/libs/jquery.steps.min.js', array( 'jquery' ), "1.1.0", true);
		$opalrequestquote_page = opalrequestquote_get_option( 'opalrequestquote_page' );
		if(checkCurrentPageLink($opalrequestquote_page)){
			wp_enqueue_script("requestquotes-frontend-js", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/requestquote_frontend.js', array( 'jquery' ), "1.0.0", true);
		}
		wp_enqueue_script("opalrequestquote-scripts", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/scripts.js', array( 'jquery' ), "1.0.0", true);
		wp_enqueue_script("fitvids", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/jquery.fitvids.js', array( 'jquery' ), "1.0.0", true);

	}

	/**
     * load javascript and css file in admin system.
     */
    public static function loadAdminStyles() {
    	global $pagenow;
    	if($pagenow == 'post-new.php' || $pagenow == 'post.php' && get_post_type() =='opal_requestquote'):
	    	wp_enqueue_script("jquery-geocomplete-js", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/libs/jquery.geocomplete.min.js', null, "1.7.0", true);
			$key = 'AIzaSyDRVUZdOrZ1HuJFaFkDtmby0E93eJLykIk';
			$api = apply_filters( 'opallocation_google_map_api_123',  '//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key='.$key );	
			wp_enqueue_script("google-map-api",$api , null, "0.0.1", false);
			
			wp_enqueue_script("requestquotes-frontend-js", OPALREQUESTQUOTE_PLUGIN_URL . 'assets/js/requestquote_backend.js', array( 'jquery' ), "1.0.0", true);
		endif;
      	wp_enqueue_style( 'opalrequestquote-admin-css', OPALREQUESTQUOTE_PLUGIN_URL . 'assets/css/admin-styles.css', array(), '1.0.0' );
		wp_enqueue_media(); ?>
		<script type="text/javascript">
			var ajaxurl = '<?php echo esc_js( admin_url('admin-ajax.php') ); ?>';
			var opalsiteurl = '<?php echo get_template_directory_uri(); ?>';
			var pluginurl = '<?php echo OPALREQUESTQUOTE_PLUGIN_URL; ?>';	
		</script>
    <?php }

    /**
     * load javascript and css file in frontend system.
     */
    public static function loadFrontendStyles() {
    	wp_enqueue_style( 'magnific-popup-cs', OPALREQUESTQUOTE_PLUGIN_URL . 'assets/css/lib/magnific-popup.css', array(), '3.0.0' );
	   	wp_enqueue_style( 'opalrequestquote-frontend-css', OPALREQUESTQUOTE_PLUGIN_URL . 'assets/css/opalrequestquote.css', null, '1.0.3');
      	wp_enqueue_style( 'datetimepicker-css', OPALREQUESTQUOTE_PLUGIN_URL . 'assets/css/lib/jquery.datetimepicker.css', null, '3.0.3'); 	
      	wp_enqueue_style( 'jquery-steps-css', OPALREQUESTQUOTE_PLUGIN_URL . 'assets/css/lib/jquery.steps.css', null, '1.0.0'); 	
    }

    /**
     * add ajax url
     */
	public static function initAjaxUrl() {
		?>
		<script type="text/javascript">
			var ajaxurl = '<?php echo esc_js( admin_url('admin-ajax.php') ); ?>';
			var opalsiteurl = '<?php echo get_template_directory_uri(); ?>';
			var pluginurl = '<?php echo OPALREQUESTQUOTE_PLUGIN_URL; ?>';	
			var opal_lables = {
				        cancel: "<?php esc_html_e('Cancel', 'opalrequestquote'); ?>",
				        current: "<?php esc_html_e('Current Step:', 'opalrequestquote'); ?>",
				        pagination: "<?php esc_html_e('Pagination', 'opalrequestquote'); ?>",
				        finish: "<?php esc_html_e('Finish', 'opalrequestquote'); ?>",
				        next: "<?php esc_html_e('Next', 'opalrequestquote'); ?>",
				        previous: "<?php esc_html_e('Previous', 'opalrequestquote'); ?>",
				        loading: "<?php esc_html_e('Loading ...', 'opalrequestquote'); ?>"
				    }
		</script>
		<?php
	}
}

Opalrequestquote_Scripts::init();