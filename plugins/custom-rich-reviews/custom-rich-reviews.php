<?php
/**
* @package custom-rich-review
* @category Plugins
* @author WPOPAL
* |--------------------------------------------------------------------------
* | Plugin Custom Rich Review
* |--------------------------------------------------------------------------
* Plugin Name: Custom Rich Review
* Plugin URI: http://www.wpopal.com/custom-rich-review/
* Description: Custom add some shortcode for rich-review.
* Version: 1.0.0
* Author: WPOPAL
* Author URI: http://www.wpopal.com
* License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

if (!class_exists("CustomRichReviews")):
/**
 * Main CustomRichReviews Class
 * @since 1.0
 */
final class CustomRichReviews 
{
	/**
	 * @var CustomRichReviews The one true CustomRichReviews
	 * @since 1.0
	 */
	private static $instance;

	 /**
     * Plugin path
     *
     * @var string
     */
	 protected $_plugin_path = null;

	/**
	 * contructor
	 */
	public function __construct() {
		
		
	}
	/**
	* Main CustomRichReviews Instance
	*
	* Insures that only one instance of CustomRichReviews exists in memory at any one
	* time. Also prevents needing to define globals all over the place.
	*
	* @since     1.0
	* @static
	* @staticvar array $instance
	* @see       CustomRichReviews()
	* @return    CustomRichReviews
	*/
	public static function getInstance() {
		
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof CustomRichReviews ) ) {
			self::$instance = new CustomRichReviews;
			define( 'CUSTOM_RICH_REVIEWS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			define( 'CUSTOM_RICH_REVIEWS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			add_action( 'plugins_loaded', array( self::$instance, 'add_shortcode_list_reviews'));
			if(  in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  ){ 
				add_action( 'plugins_loaded', array( self::$instance, 'add_element_review_total_kingomposer'));
			}
			

			add_action( 'wp_enqueue_scripts', array( self::$instance, 'loadScripts' ) );
		}
		return self::$instance;
	}

	/**
	 * load script file in frontend
	 */
	public static function loadScripts(){
 
		wp_enqueue_style( 'circle-frontend-css', CUSTOM_RICH_REVIEWS_PLUGIN_URL . 'css/circle.css', null, '1.0');
 
	}

	public static function add_shortcode_list_reviews(){

		add_shortcode( 'opal_reviews', array( self::$instance, 'create_shortcode_review_list' ) );
		 
	}
	/**
	* Fnc create_shortcode_review_list
	*/
	public static function create_shortcode_review_list(){
		return get_template_part('/rich-reviews/reviews');
	}
	
	/**
	* Fnc create_shortcode_review_total
	*/
	public static function add_element_review_total_kingomposer(){
		require_once CUSTOM_RICH_REVIEWS_PLUGIN_DIR. 'vendors/kingcomposer.php';
	}
	

}// end Class Root
endif; // End if class_exists check

/**
* Function Create RichReviews Shortcode 
*
*/

/**
 * The main function responsible for returning the one true CustomRichReviews
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $dpemployee = CustomRichReviews(); ?>
 *
 * @since 1.0
 * @return object - The one true CustomRichReviews Instance
 */
function CustomRichReviews() {
	return CustomRichReviews::getInstance();
}

// Get CustomRichReviews Running
CustomRichReviews();

