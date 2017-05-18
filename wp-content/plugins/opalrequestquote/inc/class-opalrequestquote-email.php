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
class Opalrequestquote_Email {

	public static $headers;

	public  function __construct(){
		$from_name 		=  opalrequestquote_get_option('from_name');
		$from_email 	= opalrequestquote_get_option('from_email');
		self::$headers = sprintf( "From: %s <%s>\r\n Content-type: text/html", $from_name, $from_email );
	}
	/**
	 *
	 */
	public static function init() {

	}
	/**
	 *
	 */
	public static function sendNewRequestQuoteEmail( $args ){
		//global $opal_mail_errors;
		try{
			$from_name 		=  opalrequestquote_get_option('from_name');
			$from_email 	= opalrequestquote_get_option('from_email');
			$headers = sprintf( "From: %s <%s>\r\n Content-type: text/html", $from_name, $from_email );
			extract( $args );

			$datas = self::newrequest( $args ); //$requestquote_id
			extract( $datas );
			if(opalrequestquote_get_option('admin_email_enable') == 'yes' ){
				wp_mail( @$from_email, @$admin_subject, @$admin_message, $headers );
			}
			$opal_mail_errors = wp_mail( @$email, @$subject, @$message, $headers );
			set_transient( get_current_user_id().'opal_mail_errors', $opal_mail_errors );
			return $opal_mail_errors;
		} catch ( phpmailerException $e ) {
		  	$opal_mail_errors = new WP_Error( $e->getCode(), $e->getMessage() );
		  	set_transient( get_current_user_id().'opal_mail_errors', $opal_mail_errors );
  			return apply_filters( 'wp_mail_send_failed', false, $opal_mail_errors );
		}
	}

	/**
	 *
	 */
	public static function sendChangeStatusEmail( $status, $args ){
		try{
			$subject = '';
			$body 	= '';
			switch ( $status ) {
				
				case 'opal-pending':
					break;
				case 'opal-confirmed':
					$subject = html_entity_decode( opalrequestquote_get_option('confirmed_email_subject') );
					$body = html_entity_decode( opalrequestquote_get_option('confirmed_email_body') );
					break;
				case 'opal-closed':
					$subject = html_entity_decode( opalrequestquote_get_option('rejected_email_subject') );
					$body = html_entity_decode( opalrequestquote_get_option('rejected_email_subject') );
					break;
			}
			extract( $args );

			$requestquote_field_args = array(
					'name' 			=> get_post_meta( $requestquote_id, OPALREQUESTQUOTE_PREFIX .'firstname', true ).' '.get_post_meta( $requestquote_id, OPALREQUESTQUOTE_PREFIX .'lastname', true ),
					'email' 			=> get_post_meta( $requestquote_id, OPALREQUESTQUOTE_PREFIX .'email', true ),
					'date' 			=> get_post_meta( $requestquote_id, OPALREQUESTQUOTE_PREFIX .'movingon', true ),
					'phone' 		=> get_post_meta( $requestquote_id, OPALREQUESTQUOTE_PREFIX .'phonenumber', true ),
					'comment'		=> get_post_meta( $requestquote_id, OPALREQUESTQUOTE_PREFIX .'comment', true ),
				);
			$from_name 		=  opalrequestquote_get_option('from_name');
			$from_email 	= opalrequestquote_get_option('from_email');
			$headers = sprintf( "From: %s <%s>\r\n Content-type: text/html", $from_name, $from_email );
			$message = self::processShortTags($requestquote_field_args,$body);
			$email = get_post_meta( $requestquote_id, OPALREQUESTQUOTE_PREFIX .'email', true );
	
			$opal_mail_errors =  wp_mail( @$email, @$subject, @$message, $headers );
			set_transient( get_current_user_id().'opal_mail_errors', $opal_mail_errors );
			return $opal_mail_errors;
		} catch ( phpmailerException $e ) {
		  	$opal_mail_errors = new WP_Error( $e->getCode(), $e->getMessage() );
		  	set_transient( get_current_user_id().'opal_mail_errors', $opal_mail_errors );
  			return apply_filters( 'wp_mail_send_failed', false, $opal_mail_errors );
		}
	}

	/**
	 * get data of newrequest email
	 *
	 * @var $args  array: requestquote_id , $body 
	 * @return text: message
	 */
	public static function processShortTags ( $requestquote_field, $body ) {
		$requestquote_fields = $requestquote_field ? $requestquote_field : array(
					'name' 			=> "",
					'email' 		=> "",
					'movingon' 		=> "",
					'phonenumber' 	=> "",
					'comment'		=> "",
				);
		extract($requestquote_fields);
		$tags 	= array("{user_mail}","{user_name}","{comment}","{date}","{phone}","{site_name}","{site_link}","{current_time}");
		$values 	= array( $email, $firstname.' '.$lastname ,$comment,$movingon,$phonenumber,get_bloginfo( 'name' ) ,get_home_url(), date("F j, Y, g:i a"));
		$message = str_replace($tags, $values, $body);
		return $message;
	}

	/**
	 * get data of newrequest email
	 *
	 * @var $args  array: user_id, requestquote_id
	 * @return array: email, subject, message, admin_subject, admin_message
	 */
	public static function newrequest( $args ) {
		global $requestquote_field_args;
		if ($requestquote_field_args) {
			
			$requestquote_field =  $requestquote_field_args ? $requestquote_field_args : array();
			extract( $args );
			extract( $requestquote_field );
			// subject
			$subject = html_entity_decode( opalrequestquote_get_option('newrequest_email_subject') );
			$admin_subject = html_entity_decode( opalrequestquote_get_option('admin_email_subject') );
			// body
			$body = html_entity_decode( opalrequestquote_get_option('newrequest_email_body') );
			$admin_body = html_entity_decode( opalrequestquote_get_option('admin_email_body') );
			$message = self::processShortTags($requestquote_field,$body);

			$admin_message = self::processShortTags($requestquote_field,$admin_body);
			return apply_filters( 'opalrequestquote_send_email_newrequest', array( 'email' => $email, 'subject' => $subject, 'message' => $message, 'admin_subject'=>$admin_subject,'admin_message'=>$admin_message), $args );
		}// check save post
		return array();
	}
	
	
}

Opalrequestquote_Email::init();
