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
class Opalservice_PostType_Service{

	/**
	 * init action and filter data to define service post type
	 */
	public static function init(){ 
		
		add_action( 'init', array( __CLASS__, 'definition' ) );
		//-- custom add column to list post
		add_filter( 'manage_opal_service_posts_columns',array(__CLASS__,'init_service_columns'),10);
		add_action("manage_opal_service_posts_custom_column", array(__CLASS__, "show_service_columns"), 10, 2);
		// /End
		add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'metaboxes' ) );
		//
		define( 'OPALSERVICE_SERVICE_PREFIX', 'opal_service_' );

	}

	/**
	 *
	 */
	public static function definition(){
		
		$labels = array(
			'name'                  => __( 'Services', 'opalservice' ),
			'singular_name'         => __( 'Services', 'opalservice' ),
			'add_new'               => __( 'Add Service', 'opalservice' ),
			'add_new_item'          => __( 'Add New Service', 'opalservice' ),
			'edit_item'             => __( 'Edit Service', 'opalservice' ),
			'new_item'              => __( 'New Service', 'opalservice' ),
			'all_items'             => __( 'Services', 'opalservice' ),
			'view_item'             => __( 'View Service', 'opalservice' ),
			'search_items'          => __( 'Search Service', 'opalservice' ),
			'not_found'             => __( 'No Service found', 'opalservice' ),
			'not_found_in_trash'    => __( 'No Service found in Trash', 'opalservice' ),
			'parent_item_colon'     => '',
			'menu_name'      			=> __( 'Opal Services', 'opalservice' ),
		);

		$labels = apply_filters( 'opalservice_postype_service_labels' , $labels );
		$slug_field = opalservice_get_option( 'slug_service' );
		$slug = isset($slug_field) ? $slug_field : "service";
		register_post_type( 'opal_service',
			array(
				'labels'            		=> $labels,
				'supports'          		=> array('title', 'editor','excerpt','thumbnail' ),
				'public'            		=> true,
				'has_archive'       		=> true,
				'rewrite'           		=> array( 'slug' => $slug ),
				'menu_position'   			=> 6,
				'categories'        		=> array(),
				'menu_icon'       			=> 'dashicons-admin-site',
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
	public static function init_service_columns($columns) {
		$columns = array_slice($columns, 0, 1, true) + array(OPALSERVICE_SERVICE_PREFIX .'thumb' => __("Image", 'opal_service')) + array_slice($columns, 1, count($columns) - 1, true);		
		return $columns;
	}

	/**
	 * Add content to custom column
	 *
	 * @param $column
	 */
	public static function show_service_columns($column, $post_ID) {

		global $post;
		switch ($column) {
			case OPALSERVICE_SERVICE_PREFIX .'thumb':
				echo '<a href="' . get_edit_post_link($post->ID) . '">' . get_the_post_thumbnail($post_ID,array( 100, 100)) . '</a>';
				break;
		}
	}



	/**
	 *
	 */
	public static function metaboxes( array $metaboxes ) {
		$prefix = OPALSERVICE_SERVICE_PREFIX; 		
		//$metaboxes = array();
		$metaboxes[ $prefix . 'managements' ] = array(
			'id'                        => $prefix . 'managements',
			'title'                     => __( 'Management', 'opalrequestquote' ),
			'object_types'              => array( 'opal_service' ),
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
		$prefix = OPALSERVICE_SERVICE_PREFIX;
		$fields = array(
			array(
				'id'                => $prefix.'icon',
				'type'              => 'file',
				'name' 				=> __( 'Upload Icon', 'opalservice' ),
				'description'		=> __('You can upload icon image or select icon by fontpicker bellow','opalservice')
			),

			array(
				'id'                => $prefix.'iconpicker',
				'type'              => 'fontpicker_service',
				'name' 				=> __( 'Select Icon ', 'opalservice' ),
			)
		);

		return apply_filters( 'opalrequestquote_postype_service_metaboxes_fields_managements' , $fields );
	}

}// end class

Opalservice_PostType_Service::init();
