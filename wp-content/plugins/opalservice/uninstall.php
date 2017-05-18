<?php
/**
 * Uninstall Opal Service
 *
 * @package     Opal Service
 * @subpackage  Uninstall
 * @copyright   Copyright (c) 2016, Wopal
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

function opalservice_uninstall() {

	$delete_data = opalservice_get_option( 'delete_data' );

	/* Make sure that the user wants to remove all the data. */
	if ( 'yes' === $delete_data ) {
		delete_option( 'opalservice_setup' );

		$opalservice_list_departments = opalservice_get_option( 'opalservice_list_departments' );
		/* Delete the plugin pages.	 */
		wp_delete_post( intval( $opalservice_list_departments ), true );

		/* Remove all plugin options. */
		delete_option( 'opalservice_settings' );


		/* Delete all tag terms. */
		$terms = get_terms( 'opalservice_category_service', array( 'fields' => 'ids', 'hide_empty' => false ) );
  	foreach ( $terms as $value ) {
       	wp_delete_term( $value, 'opalservice_category_service' );
  	}
  	$terms = get_terms( 'opal_department', array( 'fields' => 'ids', 'hide_empty' => false ) );
  	foreach ( $terms as $value ) {
       	wp_delete_term( $value, 'opal_department' );
  	}
	}
}