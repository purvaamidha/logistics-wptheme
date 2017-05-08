<?php
/**
 * Uninstall Opal Requestquote
 *
 * @package     Opal Requestquote
 * @subpackage  Uninstall
 * @copyright   Copyright (c) 2016, Wopal
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

function opalrequestquote_uninstall() {

	$delete_data = opalrequestquote_get_option( 'delete_data' );

	/* Make sure that the user wants to remove all the data. */
	if ( 'yes' === $delete_data ) {
		delete_option( 'opalrequestquote_setup' );

		$opalrequestquote_list_departments = opalrequestquote_get_option( 'opalrequestquote_list_departments' );
		/* Delete the plugin pages.	 */
		wp_delete_post( intval( $opalrequestquote_list_departments ), true );

		/* Remove all plugin options. */
		delete_option( 'opalrequestquote_settings' );


		/* Delete all tag terms. */
		$terms = get_terms( 'opalrequestquote_category_service', array( 'fields' => 'ids', 'hide_empty' => false ) );
  	foreach ( $terms as $value ) {
       	wp_delete_term( $value, 'opalrequestquote_category_service' );
  	}
  	$terms = get_terms( 'opal_department', array( 'fields' => 'ids', 'hide_empty' => false ) );
  	foreach ( $terms as $value ) {
       	wp_delete_term( $value, 'opal_department' );
  	}
	}
}