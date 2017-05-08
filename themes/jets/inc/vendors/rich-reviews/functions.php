<?php

/**
 * Load rich-review styles follow theme skin actived
 *
 * @static
 * @access public
 * @since Wpopal_Themer 1.0
 */
global $post;

/**
* Add Stylesheet and Js
*/
function jets_fnc_rich_reviews_load_media() {
	// Add stylesheet.
	wp_enqueue_style( 'custom-rich-review', get_template_directory_uri() . '/js/rich-reviews/style.css', array(), '1.0.0' );
	// Add Js
	wp_enqueue_script("custom-rich-review-autosize", get_template_directory_uri() . '/js/rich-reviews/autosize.js', array( 'jquery' ), "1.0.0", true);
	wp_enqueue_script("custom-rich-review-scripts", get_template_directory_uri() . '/js/rich-reviews/scripts.js', array( 'jquery' ), "1.0.0", true);
}
add_action( 'wp_enqueue_scripts','jets_fnc_rich_reviews_load_media', 15 );

?>