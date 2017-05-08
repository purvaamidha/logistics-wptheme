<?php
/**
* @package opalservice
* @category Plugins
* @author WPOPAL
* |--------------------------------------------------------------------------
* | Plugin Opal Service 
* |--------------------------------------------------------------------------
* Plugin Name: Opal Service
* Plugin URI: http://www.wpopal.com/opalservice/
* Description: Create and maintain modern online menus for almost any kind of service.
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

if (!class_exists("OpalService")):
/**
 * Main OpalService Class
 * @since 1.0
 */
final class OpalService 
{
	/**
	 * @var Opalservice The one true Opalservice
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
	* Main Opalservice Instance
	*
	* Insures that only one instance of Opalservice exists in memory at any one
	* time. Also prevents needing to define globals all over the place.
	*
	* @since     1.0
	* @static
	* @staticvar array $instance
	* @uses      Opalservice::setup_constants() Setup the constants needed
	* @uses      Opalservice::includes() Include the required files
	* @uses      Opalservice::load_textdomain() load the language files
	* @see       Opalservice()
	* @return    Opalservice
	*/
	public static function getInstance() {
		
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof OpalService ) ) {
			self::$instance = new OpalService;
			self::$instance->setup_constants();

			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain'));
			self::$instance->includes();
			//self::$instance->roles  = new Opalservice_Roles();
		}
		//update_option( 'opalservice_setup', '' );
		//add_action("admin_print_footer_scripts", array( self::$instance, 'shortcode_button_script'));
		return self::$instance;
	}

	/**
	* Function Defien
	*/
	public function setup_constants()
	{
		define("OPALSERVICE_VERSION", "1.0.0");
		define("OPALSERVICE_MINIMUM_WP_VERSION", "4.0");
		define("OPALSERVICE_PLUGIN_URL", plugin_dir_url( __FILE__ ));
		define("OPALSERVICE_PLUGIN_DIR", plugin_dir_path( __FILE__ ));
		define('OPALSERVICE_MEDIA_URL', plugins_url(plugin_basename(__DIR__) . '/assets/'));
		define('OPALSERVICE_LANGUAGE_DIR', plugin_dir_path( __FILE__ ) . '/languages/');
		define('OPALSERVICE_THEMER_TEMPLATES_DIR', get_template_directory().'/' );
		define('OPALSERVICE_THEMER_TEMPLATES_URL', get_bloginfo('template_url').'/' );

	}

	/**
	* Throw error on object clone
	*
	* The whole idea of the singleton design pattern is that there is a single
	* object, therefore we don't want the object to be cloned.
	*
	* @since  1.0
	* @access protected
	* @return void
	*/
	public function __clone() {
			// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'opalservice' ), '1.0' );
	}

	/**
     * Include a file
     *
     * @param string
     * @param bool
     * @param array
     */
	function _include( $file, $root = true, $args = array(), $unique = true ){
		if( $root ){
			$file = $this->plugin_path( $file );
		}
		if( is_array( $args ) ){
			extract( $args );
		}

		if( file_exists( $file ) )
		{
			if ( $unique ) {
				require_once $file;
			}
			else {
				require $file;
			}
		}
	}
    /**
    * Get the path of the plugin with sub path
    *
    * @param string $sub
    * @return string
    */
    function plugin_path( $sub = '' ){
    	if( ! $this->_plugin_path ) {
    		$this->_plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
    	}
    	return $this->_plugin_path . '/' . $sub;
    }
   
    public function includes(){
    	
    	global $opalservice_options;
	 	
    	// cmb2 custom field
		$this->_include('inc/vendors/cmb2/custom-fields/fontpicker.php');
		// /end include CMB2

		//-- include admin setting
		$this->_include('inc/admin/register-settings.php');
		$opalservice_options = opalservice_get_settings();
		//-- include teamplate loader
		$this->_include('inc/class-template-loader.php');
		//--
		$this->_include("inc/mixes-functions.php");
		//--
		$this->_include("inc/ajax-functions.php");

		$this->_include('inc/class-opalservice-query.php');

		//-- include all file *.php in directories , call function in inc/mixes-functions.php
		opalservice_includes( OPALSERVICE_PLUGIN_DIR . 'inc/post-types/*.php' );
		opalservice_includes( OPALSERVICE_PLUGIN_DIR . 'inc/taxonomies/*.php' );
		//--
		$this->_include("inc/template-functions.php");
		//-- 

		//--
		$this->_include("inc/class-opalservice-service.php"); //***
		//--
		$this->_include('inc/class-opalservice-scripts.php');
		//--
		$this->_include("inc/class-opalservice-shortcodes.php");
		
		if( class_exists("KingComposer") ){
			//--
			$this->_include("inc/vendors/kingcomposer.php"); //**
			//--
		}

		$this->_include('install.php');
		//--
		if ( get_option( 'opalservice_setup', false ) != 'installed' ) {
			register_activation_hook( __FILE__, 'opalservice_install' );
			update_option( 'opalservice_setup', 'installed' );
		}
		$this->_include('uninstall.php');
		// uninstall
		register_uninstall_hook( __FILE__, 'opalservice_uninstall' );
		//--
		// // add widgets
		add_action( 'widgets_init', array($this, 'widgets_init') );
	}

	/**
	* this is function Load all Widgets
	*/
	public function widgets_init() {
		opalservice_includes( OPALSERVICE_PLUGIN_DIR . 'inc/widgets/*.php' );
	}
	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	*/
	public function load_textdomain() {
			// Set filter for Opalservice's languages directory
		$lang_dir = dirname( plugin_basename( OPALSERVICE_PLUGIN_DIR ) ) . '/languages/';
		$lang_dir = apply_filters( 'opalservice_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale', get_locale(), 'opalservice' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'opalservice', $locale );

			// Setup paths to current locale file
		$mofile_local  = $lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/opalservice/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/opalservice folder
			load_textdomain( 'opalservice', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/opalservice/languages/ folder
			load_textdomain( 'opalservice', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'opalservice', false, $lang_dir );
		}
	}

}// end Class Root
endif; // End if class_exists check

/**
 * The main function responsible for returning the one true Opalservice
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $dpemployee = Opalservice(); ?>
 *
 * @since 1.0
 * @return object - The one true Opalservice Instance
 */
function Opalservice() {
	return OpalService::getInstance();
}

// Get Opalservice Running
Opalservice();

