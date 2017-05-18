<?php 
/**
 * Install Opal Service
 *
 * @package     Opal Service
 * @subpackage  Uninstall
 * @copyright   Copyright (c) 2016, Wopal
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

function opalservice_install(){


	global $opalservice_options;
 

	// Clear the permalinks
	flush_rewrite_rules( false );

	// Add Upgraded From Option
	$current_version = get_option( 'opalservice_version' );
	if ( $current_version ) {
		update_option( 'opalservice_version_upgraded_from', $current_version );
	}

	// Setup some default options
	$options = array();

	$options['service_show_thumbnail']      = 1;
	$options['service_show_category']       = 0;
	$options['service_show_description']  	= 1;
	$options['service_show_readmore']  		= 1;
	$options['service_show_number']  		= 0;

	// Populate some default values
	update_option( 'opalservice_settings', array_merge( $opalservice_options, $options ) );
	//update_option( 'opalservice_version', GIVE_VERSION );

	 
	// Create Give roles
	// $roles = new Opalservice_Roles();
	// $roles->add_roles();
	// $roles->add_caps();
 
	// Add a temporary option to note that Give pages have been created
	set_transient( '_opalservice_installed', $options, 30 );

 
	// Bail if activating from network, or bulk
	if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
		return;
	}
	// Add the transient to redirect
	set_transient( '_opalservice_activation_redirect', true, 30 );

}
	

/**
 * Install user roles on sub-sites of a network
 *
 * Roles do not get created when Give is network activation so we need to create them during admin_init
 *
 * @since 1.0
 * @return void
 */
function opalservice_install_roles_on_network() {

	 
}

add_action( 'admin_init', 'opalservice_install_roles_on_network' );	
?>