<?php 
/**
 * Install Opal Requestquote
 *
 * @package     Opal Requestquote
 * @subpackage  Uninstall
 * @copyright   Copyright (c) 2016, Wopal
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

function opalrequestquote_install(){


	global $opalrequestquote_options;
 

	// Clear the permalinks
	flush_rewrite_rules( false );

	// Add Upgraded From Option
	$current_version = get_option( 'opalrequestquote_version' );
	if ( $current_version ) {
		update_option( 'opalrequestquote_version_upgraded_from', $current_version );
	}

	// Setup some default options
	$options = array();
	
	$opalrequestquote_page = opalrequestquote_get_option( 'opalrequestquote_page' );
	if ( empty( $opalrequestquote_page ) ||  $opalrequestquote_page <= 0 ) {
	// Create a page to list all feature
		$requestquote_page = wp_insert_post(
			array(
				'post_content'   => '[opal_requestquote_page]',
				'post_title'     => wp_strip_all_tags( __( 'Request Quote', 'opalrequestquote' ) ),
				'post_name'      => sanitize_title( __( 'Request Quote', 'opalrequestquote' ) ),
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'ping_status'    => 'closed',
				'comment_status' => 'closed',
			)
		);
		$options['opalrequestquote_page'] = $requestquote_page;
	}
	// -- end create home page 

	// Populate some default values
	update_option( 'opalrequestquote_settings', array_merge( $opalrequestquote_options, $options ) );
	update_option( 'opalrequestquote_version', OPALREQUESTQUOTE_VERSION );

	 
	// Create Give roles
	$roles = new Opalrequestquote_Roles();
	$roles->add_roles();
	$roles->add_caps();
 
	// Add a temporary option to note that Give pages have been created
	set_transient( '_opalrequestquote_installed', $options, 30 );

 
	// Bail if activating from network, or bulk
	if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
		return;
	}
	// Add the transient to redirect
	set_transient( '_opalrequestquote_activation_redirect', true, 30 );

}
	

/**
 * Install user roles on sub-sites of a network
 *
 * Roles do not get created when Give is network activation so we need to create them during admin_init
 *
 * @since 1.0
 * @return void
 */
function opalrequestquote_install_roles_on_network() {

	global $wp_roles;

	if ( ! is_object( $wp_roles ) ) {
		return;
	}
 
	if ( ! array_key_exists( 'opalrequestquote_manager', $wp_roles->roles ) ) {
		$roles = new Opalrequestquote_Roles;
		$roles->add_roles();
		$roles->add_caps();

	}else {  
		remove_role( 'opalrequestquote_manager' );
	   remove_role( 'opalrequestquote_manager' );
		$roles = new Opalrequestquote_Roles;
		$roles->remove_caps();
	}
}

add_action( 'admin_init', 'opalrequestquote_install_roles_on_network' );	
?>