<?php

/**
 * $Desc$
 *
 * @version    $Id$
 * @package    opalrequestquote
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

class Opalrequestquote_Plugin_Settings {

	/**
	 * Option key, and option page slug
	 * @var string
	 */
	private $key = 'opalrequestquote_settings';

	/**
	 * Array of metaboxes/fields
	 * @var array
	 */
	protected $option_metabox = array();

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Constructor
	 * @since 1.0
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'admin_menu' ) , 10 );

		add_action( 'admin_init', array( $this, 'init' ) );

		//Custom CMB2 Settings Fields
		add_action( 'cmb2_render_opalrequestquote_title', 'opalrequestquote_title_callback', 10, 5 );

		add_action( 'cmb2_render_api', 'opalrequestquote_api_callback', 10, 5 );
		add_action( 'cmb2_render_license_key', 'opalrequestquote_license_key_callback', 10, 5 );
		add_action( "cmb2_save_options-page_fields", array( $this, 'settings_notices' ), 10, 3 );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-opalrequestquote_doctor_page_opalrequestquote-settings", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );

	}

	public function admin_menu() {
		//Settings
	 	add_submenu_page( 'edit.php?post_type=opal_requestquote', __( 'Settings', 'opalrequestquote' ), __( 'Settings', 'opalrequestquote' ), 'manage_options', 'opalrequestquote-settings',array( $this, 'admin_page_display' ) );
	}

	/**
	 * Register our setting to WP
	 * @since  1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );

	}

	/**
	 * Retrieve settings tabs
	 *
	 * @since 1.0
	 * @return array $tabs
	 */
	public function opalrequestquote_get_settings_tabs() {

		$settings = $this->opalrequestquote_settings( null );

		$tabs             = array();
		$tabs['general']  = __( 'General', 'opalrequestquote' );
		$tabs['emails']   = __( 'RequestQuote Email', 'opalrequestquote' );
		$tabs['statuses'] = __( 'RequestQuote Status', 'opalrequestquote' );

		//$tabs['sample_data']   = __( 'Sample Data', 'opalrequestquote' );
		if ( ! empty( $settings['addons']['fields'] ) ) {
			$tabs['addons'] = __( 'Add-ons', 'opalrequestquote' );
		}

		if ( ! empty( $settings['licenses']['fields'] ) ) {
			$tabs['licenses'] = __( 'Licenses', 'opalrequestquote' );
		}

		return apply_filters( 'opalrequestquote_settings_tabs', $tabs );
	}


	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  1.0
	 */
	public function admin_page_display() {

		$active_tab = isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $this->opalrequestquote_get_settings_tabs() ) ? $_GET['tab'] : 'general';

		?>

		<div class="wrap opalrequestquote_settings_page cmb2_options_page <?php echo $this->key; ?>">
			<h2 class="nav-tab-wrapper">
				<?php
				foreach ( $this->opalrequestquote_get_settings_tabs() as $tab_id => $tab_name ) {

					$tab_url = esc_url( add_query_arg( array(
						'settings-updated' => false,
						'tab'              => $tab_id
					) ) );

					$active = $active_tab == $tab_id ? ' nav-tab-active' : '';

					echo '<a href="' . esc_url( $tab_url ) . '" title="' . esc_attr( $tab_name ) . '" class="nav-tab' . $active . '">';
					echo esc_html( $tab_name );

					echo '</a>';
				}
				?>
			</h2>

			<?php cmb2_metabox_form( $this->opalrequestquote_settings( $active_tab ), $this->key ); ?>

		</div><!-- .wrap -->

		<?php
	}

	/**
	 * Define General Settings Metabox and field configurations.
	 *
	 * Filters are provided for each settings section to allow add-ons and other plugins to add their own settings
	 *
	 * @param $active_tab active tab settings; null returns full array
	 *
	 * @return array
	 */
	public function opalrequestquote_settings( $active_tab ) {
		$number = 0;
		$list_tags = '<td>
					<p class="tags-description">Use the following tags to automatically add requestquote information to the emails. Tags labeled with an asterisk (*) can be used in the email subject as well.</p>
				<div class="rtb-template-tags-box">
					<strong>{user_email}</strong> Email of the user who made the request quote
				</div>
				<div class="rtb-template-tags-box">
					<strong>{user_name}</strong> * Fisrtname and Lastname of the user who made the request quote
				</div>
				<div class="rtb-template-tags-box">
					<strong>{date}</strong> * Date is field movingon of the request quote
				</div>
				<div class="rtb-template-tags-box">
					<strong>{phone}</strong> Phone number if supplied with the request
				</div>
				<div class="rtb-template-tags-box">
					<strong>{comment}</strong> Message added to the request
				</div>
				<div class="rtb-template-tags-box">
					<strong>{site_name}</strong> The name of this website
				</div>
				<div class="rtb-template-tags-box">
					<strong>{site_link}</strong> A link to this website
				</div>
				<div class="rtb-template-tags-box">
					<strong>{current_time}</strong> Current date and time
				</div></td>';

		$opalrequestquote_settings = array(
			/**
			 * General Settings
			 */
			'general'     => array(
				'id'         => 'options_page',
				'title' => __( 'General Settings', 'opalrequestquote' ),
				'show_on'    => array( 'key' => 'options-page', 'value' => array( $this->key, ), ),
				'fields'     => apply_filters( 'opalrequestquote_settings_general', array(

						array(
							'name' => __( 'View Option Settings', 'opalrequestquote' ),
							'desc' => '',
							'type' => 'title',
							'id'   => 'opalrequestquote_title_general_settings_1',
							'before_display_wrap' 	=>'<hr>',
							'after_display_wrap' 	=>'<hr>',
						),
						array(
							'name'    => __( 'Request Quote Page', 'opalrequestquote' ),
							'desc'    => __( 'This is the request quote page. The <code>[opal_requestquote_page]</code> shortcode should be on this page.', 'opalrequestquote' ),
							'id'      => 'opalrequestquote_page',
							'type'    => 'select',
							'options' => opalrequestquote_cmb2_get_post_options( array(
								'post_type'   => 'page',
								'numberposts' => - 1
							) ),
						),
						array(
							'name'    => __( 'Google Map API', 'opalestate' ),
							'desc'    => __( 'Register a google api key and put here', 'opalestate' ),
							'id'      => 'google_map_api',
							'type'    => 'text',
							'default' => 'AIzaSyDRVUZdOrZ1HuJFaFkDtmby0E93eJLykIk',
						),
					)
				)
			),// end general


			//=============================================================

			/**
			 * RequestQuote Emails Options
			 */
			'emails'      => array(
				'id'         => 'options_page',
				'title' => __( 'Opalrequestquote Email Settings', 'opalrequestquote' ),
				'show_on'    => array( 'key' => 'options-page', 'value' => array( $this->key, ), ),
				'fields'     => apply_filters( 'opalrequestquote_settings_emails', array(
						array(
							'name' => __( 'Email Settings', 'opalrequestquote' ),
							'desc' => '<hr>',
							'id'   => 'opalrequestquote_title_email_settings_1',
							'type' => 'title'
						),
						array(
							'id'      => 'from_name',
							'name'    => __( 'From Name', 'opalrequestquote' ),
							'desc'    => __( 'The name donation receipts are said to come from. This should probably be your site or shop name.', 'opalrequestquote' ),
							'default' => get_bloginfo( 'name' ),
							'type'    => 'text'
						),
						array(
							'id'      => 'from_email',
							'name'    => __( 'From Email', 'opalrequestquote' ),
							'desc'    => __( 'Email to send donation receipts from. This will act as the "from" and "reply-to" address.', 'opalrequestquote' ),
							'default' => get_bloginfo( 'admin_email' ),
							'type'    => 'text'
						),
						array(
							'id'      => 'mail_message_success',
							'name'    => __( 'Success Message', 'opalrequestquote' ),
							'type'    => 'wysiwyg',
							'desc'	=> __( 'Enter the message to display when a requestquote request is made.', 'opalrequestquote' ),
							'default' => trim(preg_replace('/\t+/', '','
								Thanks, your requestquote request is waiting to be confirmed. Updates will be sent to the email address you provided.'))
						),
						array(
							'name' => __( 'Email Templates (Template Tags)', 'opalrequestquote' ),
							'desc' => $list_tags.'<br><hr>',
							'id'   => 'opalrequestquote_title_email_settings_2',
							'type' => 'title'
						),
						array(
							'name' => __( 'Email Settings (Admin Notification Email)', 'opalrequestquote' ),
							'desc' => '<hr>',
							'id'   => 'opalrequestquote_title_email_settings_3',
							'type' => 'title'
						),
						array(
							'name'    => __( 'Active Email', 'opalrequestquote' ),
							'desc' => __( 'Do you want to activate this e-mail template?', 'opalrequestquote' ),
							'id'      => 'admin_email_enable',
							'type'    => 'select',
							'options' => array( 'yes' => __( 'Yes', 'opalrequestquote' ), 'no' => __( 'No', 'opalrequestquote' ) ),
							'default' => 'yes'
						),

						array(
							'id'      			=> 'admin_email_subject',
							'name'    			=> __( 'Email Subject', 'opalrequestquote' ),
							'type'    			=> 'text',
							'desc'				=> __( 'The email subject for admin notifications.', 'opalrequestquote' ),
							'attributes'  		=> array(
		        										'placeholder' 		=> 'New RequestQuote Request',
		        										'rows'       	 	=> 3,
		    										),
							'default' => 'New RequestQuote Request',

						),
						array(
							'id'      => 'admin_email_body',
							'name'    => __( 'Email Body', 'opalrequestquote' ),
							'type'    => 'wysiwyg',
							'desc'	=> __( 'Enter the email an admin should receive when an initial request quote is made.', 'opalrequestquote' ),
							'default' => trim(preg_replace('/\t+/', '','
								A new request quote request has been made at {site_name}:<br>
								<br>
								{user_name}<br>
								{date}<br>
								Message:<br>
								{comment}
								<br>
								{site_link}<br>
								<br>
								&nbsp;<br>
								<br>
								<em>This message was sent by {site_link} on {current_time}.</em>'))
						),
						//------------------------------------------
						array(
							'name' => __( 'Email Settings (New Request Email)', 'opalrequestquote' ),
							'desc' => '<hr>',
							'id'   => 'opalrequestquote_title_email_settings_4',
							'type' => 'title'
						),
						array(
							'id'      		=> 'newrequest_email_subject',
							'name'    		=> __( 'Email Subject', 'opalrequestquote' ),
							'type'    		=> 'text',
							'desc'			=> __( 'The email subject a user should receive when they make an initial requestquote request.', 'opalrequestquote' ),
							'attributes'  	=> array(
		        									'placeholder' 		=> 'Your requestquote at '.get_bloginfo( 'name' ).' is pending',
		        									'rows'       	 	=> 3,
		    									),
							'default' 		=> 'Your requestquote at '.get_bloginfo( 'name' ).' is pending',
						),
						array(
							'id'      	=> 'newrequest_email_body',
							'name'    	=> __( 'Email Body', 'opalrequestquote' ),
							'type'    	=> 'wysiwyg',
							'desc'		=> __( 'Enter the email a user should receive when they make an initial requestquote request.', 'opalrequestquote' ),
							'default' 	=> trim(preg_replace('/\t+/', '', "Thanks {user_name},<br>
							<br>
							Your request quote is <strong>waiting to be confirmed</strong>.<br>
							<br>
							Give us a few moments to make sure that we've got space for you. You will receive another email from us soon. If this request was made outside of our normal working hours, we may not be able to confirm it until we're open again.<br>
							<br>
							<strong>Your request details:</strong><br>
							{user_name}<br>
							{date}<br>
							Your Message:<br>
							{comment}
							<br>
							&nbsp;<br>
							<br>
							<em>This message was sent by {site_link} on {current_time}.</em>"))


						),
						//=======================================
						array(
							'name' => __( 'Email Settings (Confirmed Email)', 'opalrequestquote' ),
							'desc' => '<hr>',
							'id'   => 'opalrequestquote_title_email_settings_5',
							'type' => 'title'
						),
						
						array(
							'id'      => 'confirmed_email_subject',
							'name'    => __( 'Email Subject', 'opalrequestquote' ),
							'type'    => 'text',
							'desc'			=> __( 'The email subject a user should receive when their request quote has been confirmed.', 'opalrequestquote' ),
							'attributes'  	=> array(
		        									'placeholder' 		=> 'Your requestquote at '.get_bloginfo( 'name' ).' is Confirmed',
		        									'rows'       	 	=> 3,
		    									),
							'default' 		=> 'Your requestquote at '.get_bloginfo( 'name' ).' is Confirmed',
						),
						array(
							'id'      => 'confirmed_email_body',
							'name'    => __( 'Email Body', 'opalrequestquote' ),
							'type'    => 'wysiwyg',
							'desc'	=> __( 'Enter the email a user should receive when their request quote has been confirmed.', 'opalrequestquote' ),
							'default' => trim(preg_replace('/\t+/', '','Hi {user_name},<br>
							<br>
							Your request quote has been <strong>confirmed</strong>. We look forward to seeing you soon.<br>
							<br>
							<strong>Your request quote:</strong><br>
							{user_name}<br>
							{date}<br>
							{comment}
							<br>
							&nbsp;<br>
							<br>
							<em>This message was sent by {site_link} on {current_time}.</em>'))
						),
						//-----------------------------------------------
						array(
							'name' => __( 'Email Settings (Rejected Email)', 'opalrequestquote' ),
							'desc' => '<hr>',
							'id'   => 'opalrequestquote_title_email_settings_6',
							'type' => 'title'
						),
						
						array(
							'id'      		=> 'rejected_email_subject',
							'name'    		=> __( 'Email Subject', 'opalrequestquote' ),
							'type'    		=> 'text',
							'desc'			=> __( 'The email subject a user should receive when their request quote has been rejected.', 'opalrequestquote' ),
							'attributes'  	=> array(
		        									'placeholder' 		=> 'Your request quote at '.get_bloginfo( 'name' ).' was not accepted',
		        									'rows'       	 	=> 3,
		    									),
							'default' => 'Your request quote at '.get_bloginfo( 'name' ).' was not accepted',
						),
						array(
							'id'      => 'rejected_email_body',
							'name'    => __( 'Email Body', 'opalrequestquote' ),
							'type'    => 'wysiwyg',
							'desc'	=> __( 'Enter the email a user should receive when their request quote has been rejected.', 'opalrequestquote' ),
							'default' => trim(preg_replace('/\t+/', '',"Hi {user_name},<br>
							<br>
							Sorry, we could not accomodate your request quote. We're full or not open at the time you requested:<br>
							<br>
							{user_name}<br>
							{date}<br>
							{comment}
							<br>
							&nbsp;<br>
							<br>
							<em>This message was sent by {site_link} on {current_time}.</em>"))
						),
					)
				)
			),// end mail
			//=============================================================
			'statuses'     => array(
				'id'         => 'options_page',
				'opalrequestquote_title' => __( 'Status Settings', 'opalrequestquote' ),
				'show_on'    => array( 'key' => 'options-page', 'value' => array( $this->key, ), ),
				'fields'     => array()
			),
		);
		
		$statuses = opalrequestquote_register_status();
		$fields = array();
		$i = 1;
		foreach ($statuses as $key => $status) {
			$fields[] = array(
				'name' => '',
				'desc' => '<hr>',
				'id'   => 'opalrequestquote_title_status_settings_'.$i,
				'type' => 'opalrequestquote_title'
			);
			$fields[] = array(
		        'name'    => sprintf( __( 'Background Color %s status', 'opalrequestquote' ), $status['label'] ),
			    'id'      => $key.'_bg_color',
			    'type'    => 'colorpicker',
			    'default' => isset($status['default_bg_color']) ? $status['default_bg_color'] : ''
		    );
		    $fields[] = array(
		        'name'    => sprintf( __( 'Text Color %s status', 'opalrequestquote' ), $status['label'] ),
			    'id'      => $key.'_text_color',
			    'type'    => 'colorpicker',
			    'default' => isset($status['default_text_color']) ? $status['default_text_color'] : ''
		    );
		    $i++;
		}
		$opalrequestquote_settings['statuses']['fields'] = apply_filters( 'opalrequestquote_settings_statuses', $fields );


	
		
		//Return all settings array if necessary
		if ( $active_tab === null || ! isset( $opalrequestquote_settings[ $active_tab ] ) ) {
			return apply_filters( 'opalrequestquote_registered_settings', $opalrequestquote_settings );
		}

		// Add other tabs and settings fields as needed
		return apply_filters( 'opalrequestquote_registered_settings', $opalrequestquote_settings[ $active_tab ] );

	}

	/**
	 * Show Settings Notices
	 *
	 * @param $object_id
	 * @param $updated
	 * @param $cmb
	 */
	public function settings_notices( $object_id, $updated, $cmb ) {

		//Sanity check
		if ( $object_id !== $this->key ) {
			return;
		}

		if ( did_action( 'cmb2_save_options-page_fields' ) === 1 ) {
			settings_errors( 'opalrequestquote-notices' );
		}

		add_settings_error( 'opalrequestquote-notices', 'global-settings-updated', __( 'Settings updated.', 'opalrequestquote' ), 'updated' );

	}


	/**
	 * Public getter method for retrieving protected/private variables
	 *
	 * @since  1.0
	 *
	 * @param  string $field Field to retrieve
	 *
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {

		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'fields', 'opalrequestquote_title', 'options_page' ), true ) ) {
			return $this->{$field};
		}
		if ( 'option_metabox' === $field ) {
			return $this->option_metabox();
		}

		throw new Exception( 'Invalid doctor: ' . $field );
	}


}

// Get it started
$Opalrequestquote_Settings = new Opalrequestquote_Plugin_Settings();

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 *
 * @param  string $key Options array key
 *
 * @return mixed        Option value
 */
function opalrequestquote_get_option( $key = '', $default = false ) {
	global $opalrequestquote_options;
	$value = ! empty( $opalrequestquote_options[ $key ] ) ? $opalrequestquote_options[ $key ] : $default;
	$value = apply_filters( 'opalrequestquote_get_option', $value, $key, $default );

	return apply_filters( 'opalrequestquote_get_option_' . $key, $value, $key, $default );
}


/**
 * Update an option
 *
 * Updates an opalrequestquote setting value in both the db and the global variable.
 * Warning: Passing in an empty, false or null string value will remove
 *          the key from the opalrequestquote_options array.
 *
 * @since 1.0
 *
 * @param string          $key   The Key to update
 * @param string|bool|int $value The value to set the key to
 *
 * @return boolean True if updated, false if not.
 */
function opalrequestquote_update_option( $key = '', $value = false ) {

	// If no key, exit
	if ( empty( $key ) ) {
		return false;
	}

	if ( empty( $value ) ) {
		$remove_option = opalrequestquote_delete_option( $key );

		return $remove_option;
	}

	// First let's grab the current settings
	$options = get_option( 'opalrequestquote_settings' );

	// Let's let devs alter that value coming in
	$value = apply_filters( 'opalrequestquote_update_option', $value, $key );

	// Next let's try to update the value
	$options[ $key ] = $value;
	$did_update      = update_option( 'opalrequestquote_settings', $options );

	// If it updated, let's update the global variable
	if ( $did_update ) {
		global $opalrequestquote_options;
		$opalrequestquote_options[ $key ] = $value;
	}

	return $did_update;
}

/**
 * Remove an option
 *
 * Removes an opalrequestquote setting value in both the db and the global variable.
 *
 * @since 1.0
 *
 * @param string $key The Key to delete
 *
 * @return boolean True if updated, false if not.
 */
function opalrequestquote_delete_option( $key = '' ) {

	// If no key, exit
	if ( empty( $key ) ) {
		return false;
	}

	// First let's grab the current settings
	$options = get_option( 'opalrequestquote_settings' );

	// Next let's try to update the value
	if ( isset( $options[ $key ] ) ) {

		unset( $options[ $key ] );

	}

	$did_update = update_option( 'opalrequestquote_settings', $options );

	// If it updated, let's update the global variable
	if ( $did_update ) {
		global $opalrequestquote_options;
		$opalrequestquote_options = $options;
	}

	return $did_update;
}


/**
 * Get Settings
 *
 * Retrieves all Opalrequestquote plugin settings
 *
 * @since 1.0
 * @return array Opalrequestquote settings
 */
function opalrequestquote_get_settings() {

	$settings = get_option( 'opalrequestquote_settings' );

	return (array) apply_filters( 'opalrequestquote_get_settings', $settings );

}

/**
 * Gateways Callback
 *
 * Renders gateways fields.
 *
 * @since 1.0
 *
 * @global $opalrequestquote_options Array of all the Opalrequestquote Options
 * @return void
 */
function opalrequestquote_enabled_gateways_callback( $field_object, $escaped_value, $object_id, $object_type, $field_type_object ) {

	$id                = $field_type_object->field->args['id'];
	$field_description = $field_type_object->field->args['desc'];
	$gateways          = opalrequestquote_get_payment_gateways();

	echo '<ul class="cmb2-checkbox-list cmb2-list">';

	foreach ( $gateways as $key => $option ) :

		if ( is_array( $escaped_value ) && array_key_exists( $key, $escaped_value ) ) {
			$enabled = '1';
		} else {
			$enabled = null;
		}

		echo '<li><input name="' . $id . '[' . $key . ']" id="' . $id . '[' . $key . ']" type="checkbox" value="1" ' . checked( '1', $enabled, false ) . '/>&nbsp;';
		echo '<label for="' . $id . '[' . $key . ']">' . $option['admin_label'] . '</label></li>';

	endforeach;

	if ( $field_description ) {
		echo '<p class="cmb2-metabox-description">' . $field_description . '</p>';
	}

	echo '</ul>';


}

/**
 * Output a message if the current page has the id of (the about page)
 * @param  object $field_args Current field args
 * @param  object $field      Current field object
 */
function cmb_before_row_cb( $field_args, $field ) {
   echo '<hr><hr>';
    
}

/**
 * Gateways Callback (drop down)
 *
 * Renders gateways select doctor
 *
 * @since 1.0
 *
 * @param $field_object , $escaped_value, $object_id, $object_type, $field_type_object Arguments passed by CMB2
 *
 * @return void
 */
function opalrequestquote_default_gateway_callback( $field_object, $escaped_value, $object_id, $object_type, $field_type_object ) {

	$id                = $field_type_object->field->args['id'];
	$field_description = $field_type_object->field->args['desc'];
	$gateways          = opalrequestquote_get_enabled_payment_gateways();

	echo '<select class="cmb2_select" name="' . $id . '" id="' . $id . '">';

	//Add a field to the Opalrequestquote Form admin single post view of this field
	if ( $field_type_object->field->object_type === 'post' ) {
		echo '<option value="global">' . __( 'Global Default', 'opalrequestquote' ) . '</option>';
	}

	foreach ( $gateways as $key => $option ) :

		$selected = isset( $escaped_value ) ? selected( $key, $escaped_value, false ) : '';


		echo '<option value="' . esc_attr( $key ) . '"' . $selected . '>' . esc_html( $option['admin_label'] ) . '</option>';

	endforeach;

	echo '</select>';

	echo '<p class="cmb2-metabox-description">' . $field_description . '</p>';

}

/**
 * Opalrequestquote Title
 *
 * Renders custom section titles output; Really only an <hr> because CMB2's output is a bit funky
 *
 * @since 1.0
 *
 * @param       $field_object , $escaped_value, $object_id, $object_type, $field_type_object
 *
 * @return void
 */
function opalrequestquote_title_callback( $field_object, $escaped_value, $object_id, $object_type, $field_type_object ) {

	$id                = $field_type_object->field->args['id'];
	$title             = $field_type_object->field->args['name'];
	$field_description = $field_type_object->field->args['desc'];

	echo '<hr>';

}

/**
 * Gets a number of posts and displays them as options
 *
 * @param  array $query_args Optional. Overrides defaults.
 * @param  bool  $force      Force the pages to be loaded even if not on settings
 *
 * @see: https://github.com/WebDevStudios/CMB2/wiki/Adding-your-own-field-types
 * @return array An array of options that matches the CMB2 options array
 */
function opalrequestquote_cmb2_get_post_options( $query_args, $force = false ) {

	$post_options = array( '' => '' ); // Blank option

	if ( ( ! isset( $_GET['page'] ) || 'opalrequestquote-settings' != $_GET['page'] ) && ! $force ) {
		return $post_options;
	}

	$args = wp_parse_args( $query_args, array(
		'post_type'   => 'page',
		'numberposts' => 10,
	) );

	$posts = get_posts( $args );

	if ( $posts ) {
		foreach ( $posts as $post ) {

			$post_options[ $post->ID ] = $post->post_title;

		}
	}

	return $post_options;
}


/**
 * Modify CMB2 Default Form Output
 *
 * @param string @args
 *
 * @since 1.0
 */

add_filter( 'cmb2_get_metabox_form_format', 'opalrequestquote_modify_cmb2_form_output', 10, 3 );

function opalrequestquote_modify_cmb2_form_output( $form_format, $object_id, $cmb ) {

	//only modify the opalrequestquote settings form
	if ( 'opalrequestquote_settings' == $object_id && 'options_page' == $cmb->cmb_id ) {

		return '<form class="cmb-form" method="post" id="%1$s" enctype="multipart/form-data" encoding="multipart/form-data"><input type="hidden" name="object_id" value="%2$s">%3$s<div class="opalrequestquote-submit-wrap"><input type="submit" name="submit-cmb" value="' . __( 'Save Settings', 'opalrequestquote' ) . '" class="button-primary"></div></form>';
	}

	return $form_format;

}


/**
 * Opalrequestquote License Key Callback
 *
 * @description Registers the license field callback for EDD's Software Licensing
 * @since       1.0
 *
 * @param array $field_object , $escaped_value, $object_id, $object_type, $field_type_object Arguments passed by CMB2
 *
 * @return void
 */
if ( ! function_exists( 'opalrequestquote_license_key_callback' ) ) {
	function opalrequestquote_license_key_callback( $field_object, $escaped_value, $object_id, $object_type, $field_type_object ) {

		$id                = $field_type_object->field->args['id'];
		$field_description = $field_type_object->field->args['desc'];
		$license_status    = get_option( $field_type_object->field->args['options']['is_valid_license_option'] );
		$field_classes     = 'regular-text opalrequestquote-license-field';
		$type              = empty( $escaped_value ) ? 'text' : 'password';

		if ( $license_status === 'valid' ) {
			$field_classes .= ' opalrequestquote-license-active';
		}

		$html = $field_type_object->input( array(
			'class' => $field_classes,
			'type'  => $type
		) );

		//License is active so show deactivate button
		if ( $license_status === 'valid' ) {
			$html .= '<input type="submit" class="button-secondary opalrequestquote-license-deactivate" name="' . $id . '_deactivate" value="' . __( 'Deactivate License', 'opalrequestquote' ) . '"/>';
		} else {
			//This license is not valid so delete it
			opalrequestquote_delete_option( $id );
		}

		$html .= '<label for="opalrequestquote_settings[' . $id . ']"> ' . $field_description . '</label>';

		wp_nonce_field( $id . '-nonce', $id . '-nonce' );

		echo $html;
	}
}


/**
 * Display the API Keys
 *
 * @since       2.0
 * @return      void
 */
function opalrequestquote_api_callback() {

	if ( ! current_user_can( 'manage_opalrequestquote_settings' ) ) {
		return;
	}

	do_action( 'opalrequestquote_tools_api_keys_before' );

	require_once OPALESTATE_PLUGIN_DIR . 'includes/admin/class-api-keys-table.php';

	$api_keys_table = new Opalrequestquote_API_Keys_Table();
	$api_keys_table->prepare_items();
	$api_keys_table->display();
	?>
	<p>
		<?php printf(
			__( 'API keys allow users to use the <a href="%s">Opalrequestquote REST API</a> to retrieve donation data in JSON or XML for external applications or devices, such as <a href="%s">Zapier</a>.', 'opalrequestquote' ),
			'https://opalrequestquotewp.com/documentation/opalrequestquote-api-reference/',
			'https://opalrequestquotewp.com/addons/zapier/'
		); ?>
	</p>

	<style>
		.opalrequestquote_doctor_page_opalrequestquote-settings .opalrequestquote-submit-wrap {
			display: none; /* Hide Save settings button on System Info Tab (not needed) */
		}
	</style>
	<?php

	do_action( 'opalrequestquote_tools_api_keys_after' );
}

add_action( 'opalrequestquote_settings_tab_api_keys', 'opalrequestquote_api_callback' );

/**
 * Hook Callback
 *
 * Adds a do_action() hook in place of the field
 *
 * @since 1.0
 *
 * @param array $args Arguments passed by the setting
 *
 * @return void
 */
function opalrequestquote_hook_callback( $args ) {
	do_action( 'opalrequestquote_' . $args['id'] );
}

