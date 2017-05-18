<?php
/**
* @package opalrequestquote
* @category Plugins
* @author WPOPAL
* |--------------------------------------------------------------------------
* | Plugin Opal Requestquote 
* |--------------------------------------------------------------------------
* Plugin Name: Opal Requestquote
* Plugin URI: http://www.wpopal.com/opalrequestquote/
* Description: Create and maintain modern online menus for almost any kind of requestquote.
* Version: 1.0.2
* Author: WPOPAL
* Author URI: http://www.wpopal.com
* Update: March, 24,2017
* License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}


if (!class_exists("OpalRequestquote")):
/**
 * Main OpalRequestquote Class
 * @since 1.0
 */
final class OpalRequestquote 
{
	/**
	 * @var Opalrequestquote The one true Opalrequestquote
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
	* Main Opalrequestquote Instance
	*
	* Insures that only one instance of Opalrequestquote exists in memory at any one
	* time. Also prevents needing to define globals all over the place.
	*
	* @since     1.0
	* @static
	* @staticvar array $instance
	* @uses      Opalrequestquote::setup_constants() Setup the constants needed
	* @uses      Opalrequestquote::includes() Include the required files
	* @uses      Opalrequestquote::load_textdomain() load the language files
	* @see       Opalrequestquote()
	* @return    Opalrequestquote
	*/
	public static function getInstance() {
		
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof OpalRequestquote ) ) {
			self::$instance = new OpalRequestquote;
			self::$instance->setup_constants();

			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain'));
			self::$instance->includes();
			//self::$instance->roles  = new Opalrequestquote_Roles();
			add_filter( 'opalrequestquote_google_map_api', array( self::$instance, 'load_google_map_api') );
		}
		return self::$instance;
	}

	/**
	* Function load google map API
	*/
	public static function load_google_map_api( $key ){ 
		if( opalrequestquote_get_option('google_map_api') ){
			$key = '//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key='.opalrequestquote_get_option('google_map_api') ;
		}
		return $key; 
	}

	/**
	* Function Defien
	*/
	public function setup_constants()
	{
		define("OPALREQUESTQUOTE_VERSION", "1.0.0");
		define("OPALREQUESTQUOTE_MINIMUM_WP_VERSION", "4.0");
		define("OPALREQUESTQUOTE_PLUGIN_URL", plugin_dir_url( __FILE__ ));
		define("OPALREQUESTQUOTE_PLUGIN_DIR", plugin_dir_path( __FILE__ ));
		define('OPALREQUESTQUOTE_MEDIA_URL', plugins_url(plugin_basename(__DIR__) . '/assets/'));
		define('OPALREQUESTQUOTE_LANGUAGE_DIR', plugin_dir_path( __FILE__ ) . '/languages/');
		define('OPALREQUESTQUOTE_THEMER_TEMPLATES_DIR', get_template_directory().'/' );
		define('OPALREQUESTQUOTE_THEMER_TEMPLATES_URL', get_bloginfo('template_url').'/' );
		define('OPALREQUESTQUOTE_PREFIX', 'opal_requestquote_' );
		define('OPALREQUESTQUOTE_TYPES_PREFIX', 'opal_requestquote_types_' );

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
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'opalrequestquote' ), '1.0' );
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
    public function setup_cmb2_url() {
    	return OPALREQUESTQUOTE_PLUGIN_URL . 'inc/vendors/cmb2/libraries';
    }

    public function includes(){
    	global $opalrequestquote_options;
		/**
		 * Get the CMB2 bootstrap!
		 *
		 * @description: Checks to see if CMB2 plugin is installed first the uses included CMB2; we can still use it even it it's not active. This prevents fatal error conflicts with other themes and users of the CMB2 WP.org plugin
		 *
		 */
		if ( file_exists( WP_PLUGIN_DIR . '/cmb2/init.php' ) ) {
			require_once WP_PLUGIN_DIR . '/cmb2/init.php';
		} elseif ( file_exists( OPALREQUESTQUOTE_PLUGIN_DIR . 'inc/vendors/cmb2/libraries/init.php' ) ) {
			require_once OPALREQUESTQUOTE_PLUGIN_DIR . 'inc/vendors/cmb2/libraries/init.php';
			//Customize CMB2 URL
			add_filter( 'cmb2_meta_box_url', array($this, 'setup_cmb2_url') );
		}
		// cmb2 custom field
			$this->_include('inc/vendors/cmb2/custom-fields/map/map.php');
		// /end include CMB2

		//-- include admin setting
		$this->_include('inc/admin/register-settings.php');
		$opalrequestquote_options = opalrequestquote_get_settings();
		//-- include teamplate loader
		$this->_include('inc/class-template-loader.php');
		//--
		$this->_include("inc/mixes-functions.php");
		//--
		$this->_include("inc/ajax-functions.php");
		//--
		$this->_include("inc/class-opalrequestquote-roles.php");
		//--
		$this->_include('inc/class-opalrequestquote-query.php');

		//-- include all file *.php in directories , call function in inc/mixes-functions.php
		opalrequestquote_includes( OPALREQUESTQUOTE_PLUGIN_DIR . 'inc/post-types/*.php' );
		opalrequestquote_includes( OPALREQUESTQUOTE_PLUGIN_DIR . 'inc/taxonomies/*.php' );
		//--
		$this->_include("inc/class-opalrequestquote-email.php");
		//--
		$this->_include("inc/class-opalrequestquote.php"); //***
		//--
		$this->_include("inc/template-functions.php");
		
		//--
		$this->_include('inc/class-opalrequestquote-scripts.php');
		//--
		$this->_include("inc/class-opalrequestquote-shortcodes.php");
		
		if( class_exists("KingComposer") ){
			//--
			$this->_include("inc/vendors/kingcomposer.php"); //**
			//--
		}

		$this->_include('install.php');
		//--
		if ( get_option( 'opalrequestquote_setup', false ) != 'installed' ) {
			register_activation_hook( __FILE__, 'opalrequestquote_install' );
			update_option( 'opalrequestquote_setup', 'installed' );
		}
		$this->_include('uninstall.php');
		// uninstall
		register_uninstall_hook( __FILE__, 'opalrequestquote_uninstall' );
		//--
		// // add widgets
		// add_action( 'widgets_init', array($this, 'widgets_init') );
		//add_action( 'init', array($this, 'widgets_area') );
	}

	/**
	* this is function Load all Widgets
	*/
	public function widgets_init() {
		opalrequestquote_includes( OPALREQUESTQUOTE_PLUGIN_DIR . 'inc/widgets/*.php' );
	}
	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	*/
	public function load_textdomain() {
			// Set filter for Opalrequestquote's languages directory
		$lang_dir = dirname( plugin_basename( OPALREQUESTQUOTE_PLUGIN_DIR ) ) . '/languages/';
		$lang_dir = apply_filters( 'opalrequestquote_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale', get_locale(), 'opalrequestquote' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'opalrequestquote', $locale );

			// Setup paths to current locale file
		$mofile_local  = $lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/opalrequestquote/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/opalrequestquote folder
			load_textdomain( 'opalrequestquote', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/opalrequestquote/languages/ folder
			load_textdomain( 'opalrequestquote', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'opalrequestquote', false, $lang_dir );
		}
	}

}// end Class Root
endif; // End if class_exists check





/**
 * The main function responsible for returning the one true Opalrequestquote
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $dpemployee = Opalrequestquote(); ?>
 *
 * @since 1.0
 * @return object - The one true Opalrequestquote Instance
 */
function Opalrequestquote() {
	require 'plugin-updates/plugin-update-checker.php';
		$ExampleUpdateChecker = PucFactory::buildUpdateChecker(
		'http://wpopal.com/thememods/opalrequestquote.json',
		__FILE__,
		'opalrequestquote'
	);
	return OpalRequestquote::getInstance();
}

// Get Opalrequestquote Running
Opalrequestquote();

