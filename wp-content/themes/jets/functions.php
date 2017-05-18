<?php
/**
 * Jets functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */
define( 'WOOSA_THEME_VERSION', '1.0' );

/**
 * Set up the content width value based on the theme's design.
 *
 * @see jets_fnc_content_width()
 *
 * @since Jets 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

function jets_fnc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jets_fnc_content_width', 810 );
}
add_action( 'after_setup_theme', 'jets_fnc_content_width', 0 );



if ( ! function_exists( 'jets_fnc_setup' ) ) :
/**
 * Jets setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Jets 1.0
 */
function jets_fnc_setup() {

	/*
	 * Make Jets available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Jets, use a find and
	 * replace to change 'jets' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'jets', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
 
	add_editor_style();
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Main menu', 'jets' ),
		'secondary' => esc_html__( 'Menu in left sidebar', 'jets' ),
		'topmenu'	=> esc_html__( 'Topbar Menu', 'jets' ),
		'footermenu'	=> esc_html__( 'Footer Menu', 'jets' ),
		'addressfooter'	=> esc_html__( 'Address Footer Menu', 'jets' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'jets_fnc_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// add support for display browser title
	add_theme_support( 'title-tag' );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	jets_fnc_get_load_plugins();

}
endif; // jets_fnc_setup
add_action( 'after_setup_theme', 'jets_fnc_setup' );

/**
 * get theme prefix which will use for own theme setting as page config, customizer
 *
 * @return string text_domain
 */
function jets_themer_get_theme_prefix(){
	return 'jets_';
}

add_filter( 'wpopal_themer_get_theme_prefix', 'jets_themer_get_theme_prefix' );

/**
 * Get Theme Option Value.
 * @param String $name : name of prameters 
 */
function jets_fnc_theme_options($name, $default = false) {
  
    // get the meta from the database
    $options = ( get_option( 'wpopal_theme_options' ) ) ? get_option( 'wpopal_theme_options' ) : null;
  
    // return the option if it exists
    if ( isset( $options[$name] ) ) {
        return apply_filters( 'wpopal_theme_options_$name', $options[ $name ] );
    }
    if( get_option( $name ) ){
        return get_option( $name );
    }
    // return default if nothing else
    return apply_filters( 'wpopal_theme_options_$name', $default );
}


//Update logo wordpress 4.5
if ( version_compare( $GLOBALS['wp_version'], '4.5', '>=' ) ) {
	function jets_fnc_setup_logo() {
	    add_theme_support( 'custom-logo' );
	}
	add_action( 'after_setup_theme', 'jets_fnc_setup_logo' );
}

/**
 * Require function for including 3rd plugins
 *
 */
require_once( get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php' );

function jets_fnc_get_load_plugins(){

	$plugins[] =(array(
		'name'                     => esc_html__('MetaBox', 'jets'),// The plugin name
	    'slug'                     => 'meta-box', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));

	$plugins[] =(array(
		'name'                     => esc_html__('WooCommerce','jets'), // The plugin name
	    'slug'                     => 'woocommerce', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));


	$plugins[] =(array(
		'name'                     => esc_html__('MailChimp', 'jets'),// The plugin name
	    'slug'                     => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__('Contact Form 7','jets'), // The plugin name
	    'slug'                     => 'contact-form-7', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));

	$plugins[] =(array(
		'name'                     => esc_html__('King Composer - Page Builder', 'jets'),// The plugin name
	    'slug'                     => 'kingcomposer', // The plugin slug (typically the folder name)
	    'required'                 => true,
	
	));

	$plugins[] =(array(
		'name'                     => esc_html__('Revolution Slider', 'jets'),// The plugin name
        'slug'                     => 'revslider', // The plugin slug (typically the folder name)
        'required'                 => true ,
        'source'                   => esc_url( 'http://www.wpopal.com/thememods/revslider.zip' ), // The plugin source
	));

	$plugins[] =(array(
		'name'                     => esc_html__('Wpopal Themer For Themes', 'jets'),// The plugin name
        'slug'                     => 'wpopal-themer', // The plugin slug (typically the folder name)
        'required'                 => true ,
        'source'				   => esc_url( 'http://www.wpopal.com/_opalfw_/wpopal-themer.zip')
	));

	$plugins[] =(array(
		'name'                     => esc_html__('Opal Service', 'jets'),// The plugin name
	   'slug'                     => 'opalservice', // The plugin slug (typically the folder name)
	   'required'                 =>  true,
	   'source'				   		=> esc_url('http://www.wpopal.com/thememods/opalservice.zip')
	));

	$plugins[] =(array(
			'name'                  => esc_html__('Opal Requestquote', 'jets'),// The plugin name
		   'slug'                   => 'opalrequestquote', // The plugin slug (typically the folder name)
		   'required'               =>  true,
		   'source'				   	=> esc_url('http://www.wpopal.com/thememods/opalrequestquote.zip')
		));

	$plugins[] =(array(
		'name'                    => esc_html__('Rich Reviews', 'jets'),// The plugin name
	   'slug'                     => 'rich-reviews', // The plugin slug (typically the folder name)
	   'required'                 =>  true,
	));

	$plugins[] =(array(
			'name'                  => esc_html__('Custom Rich Reviews', 'jets'),// The plugin name
		   'slug'                   => 'custom-rich-reviews', // The plugin slug (typically the folder name)
		   'required'               =>  true,
		   'source'				   	=> esc_url('http://www.wpopal.com/thememods/custom-rich-reviews.zip')
		));


	$plugins[] =(array(
		'name'                     => esc_html__('YITH WooCommerce Wishlist', 'jets'),// The plugin name
	    'slug'                     => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
	    'required'                 =>  true
	));

	tgmpa( $plugins );
}

/**
 * Register three Jets widget areas.
 *
 * @since Jets 1.0
 */
function jets_fnc_registart_widgets_sidebars() {
	 
	register_sidebar( 
	
	array(
		'name'          => esc_html__( 'Sidebar Default', 'jets' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Newsletter' , 'jets'),
		'id'            => 'newsletter',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Vertical Menu' , 'jets'),
		'id'            => 'vertical-menu',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));	

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Left Sidebar' , 'jets'),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));
	register_sidebar(
	array(
		'name'          => esc_html__( 'Right Sidebar' , 'jets'),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Left Sidebar' , 'jets'),
		'id'            => 'blog-sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Right Sidebar', 'jets'),
		'id'            => 'blog-sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Service Left Sidebar' , 'jets'),
		'id'            => 'service-sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Service Right Sidebar', 'jets'),
		'id'            => 'service-sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 1' , 'jets'),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 2' , 'jets'),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 3' , 'jets'),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 4' , 'jets'),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 5' , 'jets'),
		'id'            => 'footer-5',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Mass Footer Body' , 'jets'),
		'id'            => 'mass-footer-body',
		'description'   => esc_html__( 'Appears in the end of footer section of the site.', 'jets'),
		'before_widget' => '<aside id="%1$s" class="widget-footer clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title hide"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar(
	array(
		'name'          => esc_html__( 'Custom Service', 'jets'),
		'id'            => 'custom-service',
		'description'   => esc_html__( 'Appears in the header right section of the site.', 'jets'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));
	register_sidebar(
	array(
		'name'          => esc_html__( 'Header socials', 'jets'),
		'id'            => 'header-socials',
		'description'   => esc_html__( 'Appears in the header right section of the site.', 'jets'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));

	register_sidebar(
	array(
		'name'          => esc_html__( 'Header Information', 'jets'),
		'id'            => 'header-info',
		'description'   => esc_html__( 'Appears in the header right section of the site.', 'jets'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));
}
add_action( 'widgets_init', 'jets_fnc_registart_widgets_sidebars' );

/**
 * Register Lato Google font for Jets.
 *
 * @since Jets 1.0
 *
 * @return string
 */
function jets_fnc_font_url() {
	 
	$fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lora = _x( 'on', 'Hind font: on or off', 'jets' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $poppins = _x( 'on', 'Open Sans font: on or off', 'jets' );
 
 	$playfair = _x( 'on', 'Pay fair font: on or off', 'jets' );

    if ( 'off' !== $lora || 'off' !== $poppins || 'off' !==$playfair ) {
        $font_families = array();
 
        if ( 'off' !== $lora ) {
            $font_families[] = 'Fjalla+One';
        }
        if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:300,400,500,600,700';
        }
 		if ( 'off' !== $playfair ) {
            $font_families[] = 'Playfair+Display:700,400italic';
        }
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		 
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Jets 1.0
 */
function jets_fnc_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'jets-open-sans', jets_fnc_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'jets-fa', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.0.3' );

	if(isset($_GET['opal-skin']) && $_GET['opal-skin']) {
		$currentSkin = $_GET['opal-skin'];
	}else{
		$currentSkin = str_replace( '.css','', jets_fnc_theme_options('skin','default') );
	}
	if( is_rtl() ){
		if( !empty($currentSkin) && $currentSkin != 'default' ){ 
			wp_enqueue_style( 'jets-'.$currentSkin.'-style', get_template_directory_uri() . '/css/skins/rtl-'.$currentSkin.'/style.css' );
		}else {
			// Load our main stylesheet.
			wp_enqueue_style( 'jets-style', get_template_directory_uri() . '/css/rtl-style.css' );
		}
	}
	else {
		if( !empty($currentSkin) && $currentSkin != 'default' ){ 
			wp_enqueue_style( 'jets-'.$currentSkin.'-style', get_template_directory_uri() . '/css/skins/'.$currentSkin.'/style.css' );
		}else {
			// Load our main stylesheet.
			wp_enqueue_style( 'jets-style', get_template_directory_uri() . '/css/style.css' );
		}	
	}	

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'jets-ie', get_template_directory_uri() . '/css/ie.css', array( 'jets-style' ), '20131205' );
	wp_style_add_data( 'jets-ie', 'conditional', 'lt IE 9' );


	wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20130402' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array( 'jquery' ), '20150315', true );


	wp_enqueue_script( 'prettyphoto-js',	get_template_directory_uri().'/js/jquery.prettyPhoto.js');
	wp_enqueue_style ( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
	
	wp_enqueue_script ( 'jets-functions-js', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150315', true );
	// Add stylesheet.
	wp_enqueue_style( 'custom-rich-review', get_template_directory_uri() . '/js/rich-reviews/style.css', array(), '1.0.0' );
	// Add Js
	wp_enqueue_script("custom-rich-review-autosize", get_template_directory_uri() . '/js/rich-reviews/autosize.js', array( 'jquery' ), "1.0.0", true);
	wp_enqueue_script("custom-rich-review-scripts", get_template_directory_uri() . '/js/rich-reviews/scripts.js', array( 'jquery' ), "1.0.0", true);

	wp_localize_script( 'jets-functions-js', 'jetsAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

}
add_action( 'wp_enqueue_scripts', 'jets_fnc_scripts' );



/**
* Function Remove Control Customizer
*
*/
add_action( "customize_register", "jest_theme_customize_register",999,1 );
function jest_theme_customize_register( $wp_customize ) {

 //=============================================================
 // Remove keepheader option from theme customizer
 //=============================================================
 $wp_customize->remove_control("wpopal_theme_options[image-payment]");

}


/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Jets 1.0
 */
function jets_fnc_admin_fonts() {
	wp_enqueue_style( 'jets-lato', jets_fnc_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'jets_fnc_admin_fonts' );

require_once(  get_template_directory() . '/inc/custom-header.php' );
require_once(  get_template_directory() . '/inc/function-post.php' );
require_once(  get_template_directory() . '/inc/functions-import.php' );
require_once(  get_template_directory() . '/inc/template-tags.php' );
require_once(  get_template_directory() . '/inc/template.php' );
require_once(  get_template_directory() . '/inc/customizer/opalservice.php' );
require_once(  get_template_directory() . '/inc/customizer.php' );


if(  in_array( 'wpopal-themer/wpopal-themer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  ){
	
	if(class_exists('Wpopal_User_Account')){
 		new Wpopal_User_Account();
 	}
	/**
	 * Check and load to support visual composer
	 */
	if(  in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  ){ 
		require_once(  get_template_directory() . '/inc/vendors/kingcomposer/functions.php' );
	}

	/**
	 * Check to support woocommerce
	 */
	if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
		add_theme_support( 'woocommerce');
		require_once(  get_template_directory() . '/inc/vendors/woocommerce/functions.php' );
	}
}