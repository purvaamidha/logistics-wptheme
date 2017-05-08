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
class Opalservice_Shortcodes{
	
	/**
	 *
	 */
	static $shortcodes; 

	/**
	 *
	 */
	public static function init(){
	 	
	 	self::$shortcodes = array(
	 		'carousel_service' => array( 'code' => 'carousel_service', 'label' => __('Carousel Service') ),
	 		'list_services' => array( 'code' => 'list_services', 'label' => __('List Service') ),
	 		'tabs_services' => array( 'code' => 'tabs_services', 'label' => __('Tabs Service') ),
	 	);

	 	foreach( self::$shortcodes as $shortcode ){
	 		add_shortcode( 'opalservice_'.$shortcode['code'] , array( __CLASS__, $shortcode['code'] ) );
	 	}

	}

	/**
	* the listing service
	*/
	public static function list_services($args, $content){
		return Opalservice_Template_Loader::get_template_part( 'shortcodes/list-services',$args);
	}

	/**
	* the listing service
	*/
	public static function tabs_services($args, $content){
		return Opalservice_Template_Loader::get_template_part( 'shortcodes/tabs-services',$args);
	}

	/**
	* the carousel service
	*/
	public static function carousel_service($args, $content){
		return Opalservice_Template_Loader::get_template_part( 'shortcodes/carousel-service',$args);
	}


}

Opalservice_Shortcodes::init();

		


