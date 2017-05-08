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

/**
 *
 */
function opalservice_template_init(){
	if( isset($_GET['display']) && ($_GET['display']=='list' || $_GET['display']=='grid') ){  
		setcookie( 'opalservice_displaymode', trim($_GET['display']) , time()+3600*24*100,'/' );
		$_COOKIE['opalservice_displaymode'] = trim($_GET['display']);
	}
}

add_action( 'init', 'opalservice_template_init' );

function opalservice_get_current_url(){

	global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));
 	
 	return $current_url;
}

/**
* |----------------------------------------
* | Single Service
* |----------------------------------------
*/ 

/**
 * single content
 */
function opal_service_content(){
	echo Opalservice_Template_Loader::get_template_part( 'single-service/content' );
}
/**
 * single price list
 */
function opal_service_other_service(){
	echo Opalservice_Template_Loader::get_template_part( 'single-service/other-service' );
}

/**
 * single contact
 */
function opal_service_contact(){
	echo Opalservice_Template_Loader::get_template_part( 'single-service/contacts' );
}

//--
add_action( 'opalservice_single_service_content', 'opal_service_content', 10 );
//--

//add_action( 'opalservice_after_single_service_summary', 'opal_service_tags', 35 );




