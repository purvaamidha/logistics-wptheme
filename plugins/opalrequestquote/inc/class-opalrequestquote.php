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

class Opalrequestquotes{
	/**
	 *
	 */
	protected $post_id; 

	public $status;


	/**
	 * Constructor 
	 */
	public function __construct(){
		
	}	
	
	public static function process_acction_form()
	{
		if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "requestquote_post_form") {
			global $requestquote_field_args;
			$prefix = OPALREQUESTQUOTE_PREFIX;
			if (self::validate_form_requestquote()) {

				$requestquote_field_args = array(
					'movingfrom' 		=> $_POST[$prefix.'movingfrom'],
					'movingto' 			=> $_POST[$prefix.'movingto'],
					'movingon' 			=> $_POST[$prefix.'movingon'],
					'type' 				=> $_POST[$prefix.'type'],
					'bedroom' 			=> isset($_POST[$prefix.'bedroom']) ? $_POST[$prefix.'bedroom'] : "",
					'firstname' 		=> $_POST[$prefix.'firstname'],
					'lastname' 			=> $_POST[$prefix.'lastname'],
					'phonenumber' 		=> $_POST[$prefix.'phonenumber'],
					'email' 			=> $_POST[$prefix.'email'],
					'comment' 			=> $_POST[$prefix.'comment'],
					
				);

				// Add the content of the form to $post as an array
				$requestquote_post_args = array(
					'post_title' 		=> 'customer requestquote',
			      'post_status'   	=> 'opal-pending',           // Choose: publish, preview, future, draft, etc.
			      'post_type' 		=> 'opal_requestquote',  //'post',page' or use a custom post type if you want to
				);
				

				//save the new post
				$post_id = wp_insert_post($requestquote_post_args,true);

				  $requestquote = array(
				      'ID'           => $post_id,
				      'post_title'   => __('#No.','opalrequestquote').$post_id,
				  );

				// Update the post into the database
				  wp_update_post( $requestquote );

				//save the postmeta
				self::save_postmeta($post_id, $requestquote_field_args );

				//do_action( "opalrequestquote_after_save_requestquote" );

				return true;
			}else{
				return false;
			}
			
		}//end if
	}
	/**
	* Function Save Post Meta 
	* @use > process_acction_form()
	*/
	public static function save_postmeta($post_id, array $args)
	{
		foreach ($args as $key => $value) {
			add_post_meta( $post_id, OPALREQUESTQUOTE_PREFIX.$key , $value, true );
		}
		wp_reset_postdata();		
	}
	/**
	* Function Valide Form 
	* @use > process_acction_form()
	*/
	public static function validate_form_requestquote(){
		$prefix = OPALREQUESTQUOTE_PREFIX;
		// Do some minor form validation to make sure there is content
		if (!empty ($_POST[$prefix.'movingfrom'])|| !empty ($_POST[$prefix.'movingto']) || !empty ($_POST[$prefix.'movingon']) || !empty ($_POST[$prefix.'type']) || !empty ($_POST[$prefix.'firstname']) || !empty ($_POST[$prefix.'phonenumber']) || !empty ($_POST[$prefix.'email']) ) {
			return true;
		}
		//-----
		return false;
	}

}