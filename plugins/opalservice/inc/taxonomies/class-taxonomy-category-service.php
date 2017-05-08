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
class Opalservice_Taxonomy_Category_Service{

	/**
	 *
	 */
	public static function init(){
		add_action( 'init', array( __CLASS__, 'definition' ) );
	}

	/**
	 *
	 */
	public static function definition(){
		
		$labels = array(
        'name'              => __( 'Service Categories', "opalservice" ),
        'singular_name'     => __( 'Service Category', "opalservice" ),
        'search_items'      => __( 'Search Category Service', "opalservice" ),
        'all_items'         => __( 'Service Categories', "opalservice" ),
        'parent_item'       => __( 'Parent Service Category', "opalservice" ),
        'parent_item_colon' => __( 'Parent Service Category:', "opalservice" ),
        'edit_item'         => __( 'Edit Service Category', "opalservice" ),
        'update_item'       => __( 'Update Service Category', "opalservice" ),
        'add_new_item'      => __( 'Add New ServiceCategory', "opalservice" ),
        'new_item_name'     => __( 'New ServiceCategory Name', "opalservice" ),
        'menu_name'         => __( 'Service Categories', "opalservice" ),
        );
		
        $slug_field = opalservice_get_option( 'slug_category_service' );
        $slug = isset($slug_field) ? $slug_field : "category-service";
		register_taxonomy( 'opalservice_category_service', 'opal_service', array(
			'labels' => array(
            'name'              => __('Categories','opalservice'),
            'all_items'         => __( 'Service Categories', 'opalservice' ),
            'add_new_item'      => __('Add New Service Category','opalservice'),
            'new_item_name'     => __('New Service Category','opalservice')
         ),
         'hierarchical'  		=> true,
         'query_var'            => true,
         'rewrite'       		=> array('slug' => $slug),
		) );
	}



}

Opalservice_Taxonomy_Category_Service::init();