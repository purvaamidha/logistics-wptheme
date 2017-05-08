<?php
 /**
  * $Desc
  *
  * @version    $Id$
  * @package    wpbase
  * @author      Team <opalwordpress@gmail.com >
  * @copyright  Copyright (C) 2015 prestabrain.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  *
  * @website  http://www.wpopal.com
  * @support  http://www.wpopal.com/questions/
  */

if(!function_exists('wpopal_create_type_footer')   ){
function wpopal_create_type_footer(){
  $labels = array(
    'name' => __( 'Footers', "wpopal-themer" ),
    'singular_name' => __( 'Footer', "wpopal-themer" ),
    'add_new' => __( 'Add Profile Footer', "wpopal-themer" ),
    'add_new_item' => __( 'Add Profile Footer', "wpopal-themer" ),
    'edit_item' => __( 'Edit Footer', "wpopal-themer" ),
    'new_item' => __( 'New Profile', "wpopal-themer" ),
    'view_item' => __( 'View Footer Profile', "wpopal-themer" ),
    'search_items' => __( 'Search Footer Profiles', "wpopal-themer" ),
    'not_found' => __( 'No Footer Profiles found', "wpopal-themer" ),
    'not_found_in_trash' => __( 'No Footer Profiles found in Trash', "wpopal-themer" ),
    'parent_item_colon' => __( 'Parent Footer:', "wpopal-themer" ),
    'menu_name' => __( 'Footers', "wpopal-themer" ),
  );

  $args = array(
      'labels' => $labels,
      'hierarchical' => true,
      'description' => 'List Footer',
      'supports' => array( 'title', 'editor' ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 5,
      'show_in_nav_menus' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => false,
      'has_archive' => false,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => false
  );
  register_post_type( 'footer', $args );

  if($options = get_option('wpb_js_content_types')){
    $check = true;
    foreach ($options as $key => $value) {
      if($value=='footer') $check=false;
    }
    if($check)
      $options[] = 'footer';
    update_option( 'wpb_js_content_types',$options );
  }else{
    $options = array('page','footer');
  }

}

add_action('init','wpopal_create_type_footer');

}