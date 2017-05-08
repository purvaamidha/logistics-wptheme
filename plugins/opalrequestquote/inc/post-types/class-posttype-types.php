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
class Opalrequestquote_PostType_Types{

	/**
	 * init action and filter data to define requestquote post type
	 */
	public static function init(){ 
		
		add_action( 'init', array( __CLASS__, 'definition' ) );
		// /End
		add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'metaboxes' ) );
	}


	/**
	 *
	 */
	public static function definition(){
		
		$labels = array(
			'name'                  => __( 'Types', 'opalrequestquote' ),
			'singular_name'         => __( 'Types', 'opalrequestquote' ),
			'add_new'               => __( 'Add New Types', 'opalrequestquote' ),
			'add_new_item'          => __( 'Add New Types', 'opalrequestquote' ),
			'edit_item'             => __( 'Edit Types', 'opalrequestquote' ),
			'new_item'              => __( 'New Types', 'opalrequestquote' ),
			'all_items'             => __( 'Types', 'opalrequestquote' ),
			'view_item'             => __( 'View Types', 'opalrequestquote' ),
			'search_items'          => __( 'Search Types', 'opalrequestquote' ),
			'not_found'             => __( 'No Types found', 'opalrequestquote' ),
			'not_found_in_trash'    => __( 'No Types found in Trash', 'opalrequestquote' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Types', 'opalrequestquote' ),
		);

		$labels = apply_filters( 'opalrequestquote_posttype_requestquote_labels' , $labels );
		$slug_field = opalrequestquote_get_option( 'slug_requestquote' );
      	$slug = ($slug_field == true) ? $slug_field : "requestquote";
		register_post_type( 'opal_types',
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
				'show_in_menu'  		=> 'edit.php?post_type=opal_requestquote',
			)
		);
	}


	/**
	 *
	 */
	public static function metaboxes( array $metaboxes ) {
		$prefix = OPALREQUESTQUOTE_TYPES_PREFIX; 		
		//$metaboxes = array();
		$metaboxes[ $prefix . 'managements' ] = array(
			'id'                        => $prefix . 'managements',
			'title'                     => __( 'Types Management', 'opalrequestquote' ),
			'object_types'              => array( 'opal_types' ),
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
		$prefix = OPALREQUESTQUOTE_TYPES_PREFIX;
		$fields = array(
			array(
				'id'                => 'bedroom_lists_group',
				'type'              => 'group',
				'fields'            => array(
					array(
						'id'                => 'bedroom_lists_key',
						'name'              => __( 'Content', 'opalrequestquote' ),
						'type'              => 'text',
					),
					array(
						'id'                => 'bedroom_lists_value',
						'name'              => __( 'Value', 'opalrequestquote' ),
						'type'              => 'text',
					),
					
				),
				'options'     => array(
			        'group_title'   => __( 'Bedroom {#}', 'opalrequestquote' ), // since version 1.1.4, {#} gets replaced by row 76
			        'add_button'    => __( 'Add Another Entry', 'opalrequestquote' ),
			        'remove_button' => __( 'Remove Entry', 'opalrequestquote' ),
			        'sortable'      => true, // beta
			        'closed'     	=> false, // true to have the groups closed by default
			   ),
			)
		);

		return apply_filters( 'opalrequestquote_postype_type_metaboxes_fields_managements' , $fields );
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
}

Opalrequestquote_PostType_Types::init();
