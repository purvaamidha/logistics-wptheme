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
class Opalrequestquote_Shortcodes{
	
	/**
	 *
	 */
	static $shortcodes; 

	/**
	 *
	 */
	public static function init(){
	 	
	 	self::$shortcodes = array(
	 		'requestquote_short' => array( 'code' => 'requestquote_short', 'label' => __('Request Quote Short', 'opalrequestquote') ),
	 		'requestquote_page' => array( 'code' => 'requestquote_page', 'label' => __('Request Quote Page', 'opalrequestquote') ),
	 	);

	 	foreach( self::$shortcodes as $shortcode ){
	 		add_shortcode( 'opal_'.$shortcode['code'] , array( __CLASS__, $shortcode['code'] ) );
	 	}

	}

   /**
	* the requestquote short
	*/
	public static function requestquote_short($args= array(), $content){
		$default = array(
			'title' 		=> '',
			'description'	=> ''
		);
		$args = array_merge( $default , $args );

		return Opalrequestquote_Template_Loader::get_template_part( 'shortcodes/requestquote-short',$args);
	}

   /**
	* the requestquote page
	*/
	public static function requestquote_page($args= array(), $content){
		$default = array(
			'title' 		=> '',
			'description'	=> ''
		);
		$args = !empty($args) ? $args : array();
		$argss = array_merge( $default , $args );
		return Opalrequestquote_Template_Loader::get_template_part( 'shortcodes/requestquote-page',$argss);
	}
 

}

Opalrequestquote_Shortcodes::init();

		


