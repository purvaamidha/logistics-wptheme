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

if (!function_exists('opalrequestquote_process_submit')) {
	function opalrequestquote_process_submit() {
		$status = Opalrequestquotes::process_acction_form();
		if($out = get_transient( get_current_user_id().'opal_mail_errors' ) ) {
        	delete_transient( get_current_user_id().'opal_mail_errors' );
    	}
		if(!$out){
			$return = array( 'status' => 'danger', 'msg' => __( 'Send Mail is Failed! Please check email address in setting backend is wrong!' , 'opalrequestquote' ) );
		}
		if ( $status ) {
			$thank_message = opalrequestquote_get_option('mail_message_success') ? opalrequestquote_get_option('mail_message_success') : "Thanks, your request quote is waiting to be confirmed. Updates will be sent to the email address you provided.";
			$return = array( 'status' => 'success', 'msg' => __( $thank_message, 'opalrequestquote' ) );
		} else {
			$return = array( 'status' => 'danger', 'msg' => __( 'Please enter content for some the field bellow!', 'opalrequestquote' ) );
		}

		echo json_encode($return); die();
	}
}
// add acction ajax
add_action( 'wp_ajax_requestquote_post_form', 'opalrequestquote_process_submit' );
add_action( 'wp_ajax_nopriv_requestquote_post_form', 'opalrequestquote_process_submit' );

//===========================
/**
* Function Show Form Appointment Ajax
* @var field
*/
if (!function_exists('opalrequestquote_show_form')) {
	function opalrequestquote_show_form() {
		echo Opalrequestquote_Template_Loader::get_template_part( 'content-requestquote-form-v2',array('title_form'=>""));
		die();
	}
}
// add acction ajax
add_action( 'wp_ajax_form_requestquote', 'opalrequestquote_show_form' );
add_action( 'wp_ajax_nopriv_form_requestquote', 'opalrequestquote_show_form' );

//===========================
/**
* Function Filter Bedroom by Types 
* @var field
*/
if (!function_exists('opalrequestquote_bedroom_filter')) {
	function opalrequestquote_bedroom_filter() {
		$admin = isset($_POST['admin']) ? $_POST['admin'] : "";
		echo Opalrequestquote_Template_Loader::get_template_part('content-field-bedroom',array('post_id'=> $_POST['id'],'admin'=>$admin));
		die();
	}
}
// add acction ajax
add_action( 'wp_ajax_bedroom_filter', 'opalrequestquote_bedroom_filter' );
add_action( 'wp_ajax_nopriv_bedroom_filter', 'opalrequestquote_bedroom_filter' );