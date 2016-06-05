<?php
/*
Plugin Name: Notification email settings
Description: This plugin allows you to customize the email address which send system notifications (new user, new comment).
Version: 0.1
Author: montera34
Author URI: http://montera34.com
License: GPLv3
*/

// CHANGE DEFAULT FROM FIELD FOR MAIL FOR NOTIFICATIONS
function m34_notifica_mail_from( $default_mail ) {
	$settings = (array) get_option( 'm34_notifica_from' );
	$custom_mail = esc_attr( $settings['m34_notifica_mail_from'] );
	if ( $custom_mail != '' ) return $custom_mail;
	else return $default_email;
}
add_filter( 'wp_mail_from', 'm34_notifica_mail_from' );

// CHANGE DEFAULT NAME FIELD FOR MAIL FOR NOTIFICATIONS
function m34_notifica_mail_from_name( $default_name ) {
	$settings = (array) get_option( 'm34_notifica_from' );
	$custom_name = esc_attr( $settings['m34_notifica_mail_from_name'] );
	if ( $custom_name != '' ) return $custom_name;
	else return $default_name;
}
add_filter( 'wp_mail_from_name', 'm34_notifica_mail_from_name' );

// ADD PLUGIN OPTION SUBPAGE TO DASHBOARD
add_action('admin_menu', 'm34_notifica_register_options_page');
function m34_notifica_register_options_page() {
	add_submenu_page('options-general.php','Notification email','Notification email','manage_options','notifica_email', 'm34_notifica_options_page');
	//add_options_page( 'Notification email','Notification email','manage_options','notifica_email', 'm34_notifica_options_page' );
}

// REGISTER PLUGIN SETTINGS
add_action( 'admin_init', 'm34_notifica_register_settings' );
function m34_notifica_register_settings() {
	register_setting( 'm34_notifica_from_group', 'm34_notifica_from' );
	add_settings_section( 'm34-notifica-section-from', __('Email "From" field data','m34_notifica'), 'm34_notifica_section_from_callback', 'notifica_email' );
	add_settings_field( 'm34_notifica_mail_from', __('Email address to send notifications from','m34_notifica'), 'm34_notifica_mail_from_callback', 'notifica_email', 'm34-notifica-section-from' );
	add_settings_field( 'm34_notifica_mail_from_name', __('Name to send notifications from','m34_notifica'), 'm34_notifica_mail_from_name_callback', 'notifica_email', 'm34-notifica-section-from' );
}

// CALLBACK FUNCTIONS
function m34_notifica_section_from_callback() {
	echo __('This settings are applied to the emails sent automatically by wordpress. For instance, when a new user is added to the system, when a new comment is submited...','m34_notifica');
}
function m34_notifica_mail_from_callback() {
	$settings = (array) get_option( 'm34_notifica_from' );
	$from = esc_attr( $settings['m34_notifica_mail_from'] );
	echo "<input type='text' name='m34_notifica_from[m34_notifica_mail_from]' value='$from' />";
}
function m34_notifica_mail_from_name_callback() {
	$settings = (array) get_option( 'm34_notifica_from' );
	$name = esc_attr( $settings['m34_notifica_mail_from_name'] );
	echo "<input type='text' name='m34_notifica_from[m34_notifica_mail_from_name]' value='$name' />";
}

// GENERATE OUTPUT
function m34_notifica_options_page() { ?>
	<div class="wrap">
		<h2>Notification email settings</h2>
		<form method="post" action="options.php">
			<?php settings_fields( 'm34_notifica_from_group' ); ?>
			<?php do_settings_sections( 'notifica_email' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}


?>
