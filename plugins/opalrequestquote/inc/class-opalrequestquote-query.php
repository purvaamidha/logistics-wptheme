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
class Opalrequestquote_Query {


	public static function getTypesQuery( $args=array() ){
		$default = array(
			'post_type'         => 'opal_types',
		);

		$args = array_merge( $default, $args );
		return new WP_Query( $args );
	}


	/**
	* Gets meta box value
	*
	* @access public
	* @param $post_id
	* @param $key
	* @param $single
	* @return string
	*/
	public static function getMetaboxValues($post_id,$key, $single = true){
		return get_post_meta( $post_id, $key, $single ); 
	}


	/**
	* @param $term_id is term_id in taxonomy
	* @param $post_id is id post type
	*/
	public static function check_active_category_by_post_id($term_id,$post_id,$term_name){
		$termid = array(); 
		$terms = wp_get_post_terms( $post_id, $term_name);
		foreach ($terms as $term) {
			$termid[] = $term->term_id;
		}
		if(in_array($term_id,$termid)){
			return true;
		}
		return false;
	}


}