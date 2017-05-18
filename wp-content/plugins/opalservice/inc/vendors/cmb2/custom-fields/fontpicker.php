<?php
/**
 * $Desc$
 *
 * @version    $Id$
 * @package    opalestate
 * @author     Opal  Team <info@wpopal.com >
 * @copyright  Copyright (C) 2016 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Opalservice_Field_Fontpicker {

	/**
	 * Current version number
	 */
	const VERSION = '1.0.0';

	/**
	 * Initialize the plugin by hooking into CMB2
	 */
	public static function init() {
		add_filter( 'cmb2_render_fontpicker_service', array( __CLASS__, 'render_fontpicker' ), 10, 5 );

		add_filter( 'cmb2_sanitize_fontpicker_service', array( __CLASS__, 'sanitize_fontpicker' ), 10, 4 );
	}

	/**
	 * Render field
	 */
	public static function render_fontpicker( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		self::setup_admin_scripts();
		$name = $field->args( '_name' );

		$value = $field->value;

 		
		$data = get_post_meta( $field_object_id,  $field->args( '_name' )  . '_data' , true );
		$field_type_object->_desc( true, true );
		echo $field_type_object->input( array(
			'type'       => 'text',
			'name'       => $field->args( '_name' ),
			'value'      => isset( $data) ? $data : '',
			'id'      	 => 'IconPickerService',
			'desc'       => '',
		) );
			
	?>
	<?php 	
	}

	/**
	 * Optionally save the latitude/longitude values into two custom fields
	 */
	public static function sanitize_fontpicker( $override_value, $value, $object_id, $field_args ) {
 		if( $value ){
 			update_post_meta( $object_id, $field_args['id'] . '_data', $value );
 		}else{
 			$value = 0;
 		}
 		

		return $value;
	}	 

	/**
	 * Enqueue scripts and styles
	 */
	public static function setup_admin_scripts() {
		//----------------------
		wp_enqueue_script("fontpicker-scripts", OPALSERVICE_PLUGIN_URL . 'assets/js/jquery.fonticonpicker.min.js', array( 'jquery' ), "1.0.0", true);
		// fontIconPicker core CSS -->
 		wp_enqueue_style( 'fontpicker-core-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/jquery.fonticonpicker.min.css', null, '1.0');
 		// required default theme -->
 		wp_enqueue_style( 'fontpicker-default-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css', null, '1.0');
 		// optional themes -->
 		wp_enqueue_style( 'fontpicker-dark-grey-theme-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/themes/dark-grey-theme/jquery.fonticonpicker.darkgrey.min.css', null, '1.0');
 		wp_enqueue_style( 'fontpicker-bootstrap-theme-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css', null, '1.0');
 		wp_enqueue_style( 'fontpicker-inverted-theme-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/themes/inverted-theme/jquery.fonticonpicker.inverted.min.css', null, '1.0');
 		//-- Font -->
 		wp_enqueue_style( 'fontpicker-fonts-fontello-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/fontello-7275ca86/css/fontello.css', null, '1.0');
 		wp_enqueue_style( 'fontpicker-fonts-icomoon-css', OPALSERVICE_PLUGIN_URL . 'assets/css/fontpicker/icomoon/icomoon.css', null, '1.0');

	}

}

Opalservice_Field_Fontpicker::init();
