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
class Opalrequestquote_PostType_RequestQuote{

	/**
	 * init action and filter data to define requestquote post type
	 */
	public static function init(){ 
		
		add_action( 'init', array( __CLASS__, 'definition' ) );

		// add opal insert save
		add_filter( 'wp_insert_post_data', array( __CLASS__, 'pre_post_insert' ), 10, 2 );
		add_action( 'save_post', array( __CLASS__, 'save_post_insert' ), 10, 2 );
		//--- sent mail when change status
		add_action( 'transition_post_status',  array( __CLASS__, 'send_email_status' ), 10, 3 );
		
		// custom edit page
		add_action( 'admin_menu', array( __CLASS__, 'remove_meta_box') );
		add_action( 'add_meta_boxes', array( __CLASS__, 'taxonomy_add_meta_box') );

		//-- custom add column to list post
		add_filter( 'manage_opal_requestquote_posts_columns',array(__CLASS__,'init_requestquote_columns'),10,1);
		add_action("manage_opal_requestquote_posts_custom_column", array(__CLASS__, "show_requestquote_columns"), 10, 2);
		// /End
		add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'metaboxes' ) );
	}


	/**
	 *
	 */
	public static function definition(){
		
		$labels = array(
			'name'                  => esc_html__( 'RequestQuote', 'opalrequestquote' ),
			'singular_name'         => esc_html__( 'RequestQuote', 'opalrequestquote' ),
			'add_new'               => esc_html__( 'Add New RequestQuote', 'opalrequestquote' ),
			'add_new_item'          => esc_html__( 'Add New RequestQuote', 'opalrequestquote' ),
			'edit_item'             => esc_html__( 'Edit RequestQuote', 'opalrequestquote' ),
			'new_item'              => esc_html__( 'New RequestQuote', 'opalrequestquote' ),
			'all_items'             => esc_html__( 'RequestQuote', 'opalrequestquote' ),
			'view_item'             => esc_html__( 'View RequestQuote', 'opalrequestquote' ),
			'search_items'          => esc_html__( 'Search RequestQuote', 'opalrequestquote' ),
			'not_found'             => esc_html__( 'No RequestQuote found', 'opalrequestquote' ),
			'not_found_in_trash'    => esc_html__( 'No RequestQuote found in Trash', 'opalrequestquote' ),
			'parent_item_colon'     => '',
			'menu_name'             => esc_html__( 'RequestQuote', 'opalrequestquote' ),
		);

		$labels = apply_filters( 'opalrequestquote_posttype_requestquote_labels' , $labels );
		$slug_field = opalrequestquote_get_option( 'slug_requestquote' );
      	$slug = ($slug_field == true) ? $slug_field : "requestquote";
		register_post_type( 'opal_requestquote',
			array(
				'labels'            	=> $labels,
				'supports'          	=> array('title'),
				'public'            	=> true,
				'has_archive'       	=> false,
				'rewrite'           	=> array( 'slug' => $slug ),
				'menu_position' 		=> 5,
				'categories'        	=> array(),
				'menu_icon'     		=> 'dashicons-calendar',
				'capability_type'    	=> 'post',
				'capabilities' 			=> array(
				    'create_posts' 		=> 'do_not_allow', // false < WP 4.5, credit @Ewout
				),
				'map_meta_cap' 			=> true,
				'publicly_queryable'  	=> false,
			)
		);
	}

		/**
	 * Add custom taxonomy columns
	 *
	 * @param $columns
	 *
	 * @return array
	 */
	public static function init_requestquote_columns($columns) {
		$columns = array_slice($columns, 0, 4, true) + array(OPALREQUESTQUOTE_PREFIX .'firstname' => esc_html__("Name", 'opalrequestquote')) + array_slice($columns, 4, count($columns) - 1, true);
		$columns = array_slice($columns, 0, 5, true) + array(OPALREQUESTQUOTE_PREFIX.'email' => esc_html__("Email", 'opalrequestquote')) + array_slice($columns, 5, count($columns) - 1, true);
		$columns = array_slice($columns, 0, 6, true) + array(OPALREQUESTQUOTE_PREFIX.'phonenumber' => esc_html__("Phone", 'opalrequestquote')) + array_slice($columns, 6, count($columns) - 1, true);
		$columns = array_slice($columns, 0, 7, true) + array('opal-status' => esc_html__("Status", 'opalrequestquote')) + array_slice($columns, 7, count($columns) - 1, true);
		return $columns;
	}

	/**
	 * Add content to custom column
	 *
	 * @param $column
	 */
	public static function show_requestquote_columns($column, $post_ID) {
		
		global $post;
		remove_post_type_support( 'opal_requestquote', 'date' );

		switch ($column) {
			//case 
			case OPALREQUESTQUOTE_PREFIX .'firstname':
				if (!empty($post->opal_requestquote_firstname)) {
					echo $post->opal_requestquote_firstname.' '.$post->opal_requestquote_lastname;
				} else {
					echo '_';
				}
				break;
			case OPALREQUESTQUOTE_PREFIX .'email':
				if (!empty($post->opal_requestquote_email)) {
					echo $post->opal_requestquote_email;
				} else {
					echo '_';
				}
				break;
			case OPALREQUESTQUOTE_PREFIX .'phonenumber':
				if (!empty($post->opal_requestquote_phonenumber)) {
					echo $post->opal_requestquote_phonenumber;
				} else {
					echo '_';
				}
				break;
			case 'opal-status':
					opalrequestquote_display_status( $post->ID );
				break;
		}
	}

	/**
	 *
	 */
	public static function metaboxes( array $metaboxes ) {
		$prefix = OPALREQUESTQUOTE_PREFIX; 		
		//$metaboxes = array();
		$metaboxes[ $prefix . 'managements' ] = array(
			'id'                        => $prefix . 'managements',
			'title'                     => esc_html__( 'RequestQuote Management', 'opalrequestquote' ),
			'object_types'              => array( 'opal_requestquote' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => self::metaboxes_management_fields()
		);
		return $metaboxes;
	}

	/**
	 *
	 */	
	public static function metaboxes_management_fields(){
		$prefix = OPALREQUESTQUOTE_PREFIX;
		$fields = array(
			
			
	        array(
	            'id'   => "{$prefix}movingfrom",
	            'name' => esc_html__( 'Moving From', 'opalrequestquote' ),
	            'type' => 'text',
	            'description'  => esc_html__( "It's auto get value on input search above! you can edit it", 'opalrequestquote' ),
	        ),
	        array(
	            'id'   => "{$prefix}movingto",
	            'name' => esc_html__( 'Moving From', 'opalrequestquote' ),
	            'type' => 'text',
	            'description'  => esc_html__( "It's auto get value on input search above! you can edit it", 'opalrequestquote' ),
	            'after_row'	=> '
	            <div data-fieldtype="text" class="cmb-row cmb-type-text cmb2-id-opal-requestquote-location">
					<div class="cmb-th">
						<label for="opal_requestquote_location">Location</label>
					</div>
					<div class="cmb-td">
						<div class="directions-description">
                            <span>'.esc_html__('The directions which are calculated on estimated driving distance and the unit is automatic!','opalrequestquote').'</span>
                        </div>
                        <div class="directions-message"></div>
                        <div id="directions_map"></div>
					</div>
				</div>',
	        ),
	        

	        array(
				'name'            => esc_html__( 'Moving On', 'opalrequestquote' ),
				'id'              => $prefix . 'movingon',
				'type'            => 'text_date',
			),

			array(
				'name'            => esc_html__( 'Types', 'opalrequestquote' ),
				'id'              => $prefix . 'type',
				'type'            => 'select',
				'options' 		  => self::TypesOptions(),
				'after_row'    	=> '<div id="bedroom-filter"><hr></div>',
			),


			array(
				'name'            => esc_html__( 'First Name', 'opalrequestquote' ),
				'id'              => $prefix . 'firstname',
				'type'            => 'text',
			),

			array(
				'name'            => esc_html__( 'Last Name', 'opalrequestquote' ),
				'id'              => $prefix . 'lastname',
				'type'            => 'text',
			),

			array(
				'name'            => esc_html__( 'Phone Number', 'opalrequestquote' ),
				'id'              => $prefix . 'phonenumber',
				'type'            => 'text_medium',
			),

			array(
				'name'            => esc_html__( 'Email', 'opalrequestquote' ),
				'id'              => $prefix . 'email',
				'type'            => 'text',
				'description' 		=> esc_html__('Please Enter Your Email','opalrequestquote')
			),

			
			array(
				'name'            => esc_html__( 'Additional comments', 'opalrequestquote' ),
				'id'              => $prefix . 'comment',
				'type'            => 'textarea',
			),
		);

		return apply_filters( 'opalrequestquote_postype_requestquote_metaboxes_fields_managements' , $fields );
	}
	/**
	*
	*/

	public static function remove_meta_box() {
	   remove_meta_box('submitdiv', 'opalrequestquote', 'normal');
	   remove_meta_box('opal_statusdiv', 'opalrequestquote', 'normal');
	}
	
	public static  function taxonomy_add_meta_box() {
	    add_meta_box( 'opalrequestquote_submit', esc_html__( 'Details', 'opalrequestquote' ), array( __CLASS__, 'submit_section' ), 'opalrequestquote' , 'side', 'core');
	}

	public static function submit_section( $post ) {
		require_once( OPALREQUESTQUOTE_PLUGIN_DIR . 'inc/admin/metaboxes/details.php' );
	}

	/**
	 * update status ( insert/update )
	 */
	public static function pre_post_insert( $data, $postarr ) {
		if(isset($_REQUEST[ 'action' ]) && $_REQUEST[ 'action' ] == "trash"){
			return $data;
		}
		if ( $data['post_type'] == 'opal_requestquote' ) {
			$statuses = opalrequestquote_register_status();
			if ( !in_array( $data['post_status'], $statuses ) ) {
				$data['post_status'] = isset($_REQUEST[ 'post_status_override' ]) ? $_REQUEST[ 'post_status_override' ] : 'opal-pending';
			}
		}
		return $data;
	}
	/**
	 * add opal status for post ( insert/update )
	 */
	public static function save_post_insert( $data, $postarr ) {
		if(isset($_REQUEST[ 'action' ]) && $_REQUEST[ 'action' ] == "trash"){
			return $data;
		}

		if ( $postarr->post_type == 'opal_requestquote' ) {
			if($_REQUEST[ 'action' ] != "editpost" && $postarr->post_status == "opal-pending"){
				// Send mail when insert requestquote
				$args = array('requestquote_id'=>$postarr->ID);
				
				Opalrequestquote_Email::sendNewRequestQuoteEmail( $args );
			}		
		}
		return $data;
	}


	/**
	 * add opal status for post ( update status )
	 */
	public static function send_email_status( $new_status, $old_status, $post ) {
		if ( $post->post_type == 'opal_requestquote' ) {
			$args = array('requestquote_id'=>$post->ID);

			if ( $old_status != $new_status && $new_status != "opal-pending") {
				Opalrequestquote_Email::sendChangeStatusEmail( $new_status, $args );
			}
		} 
		return $post;
	}

	/**
	 * 
	 */

	public static function generator_people(){
		$number = array();
		for ($i=1; $i <= 100; $i++) { 
			$number[$i] = $i;
		}
		return $number;
	}
	/**
	 * 
	 */

	public static function TypesOptions(){
		$options = array();
		$types = Opalrequestquote_Query::getTypesQuery();
		if($types->have_posts()): 
	        while( $types->have_posts() ): $types->the_post(); 
	          $options[get_the_ID()] = get_the_title(); 
	        endwhile; 
	        wp_reset_postdata();
  		endif;
		return $options;
	}
}

Opalrequestquote_PostType_RequestQuote::init();
