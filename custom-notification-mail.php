<?php
/*
Plugin Name: Custom notification mail
Description: This plugin allows you to customize the email address which send system notifications (new user, new comment).
Version: 0.1
Author: montera34
Author URI: http://montera34.com
License: GPLv3
*/

function m34_notifica_email_from_address( $email ) {
	    return 'info@montera34.com';
}
add_filter( 'wp_mail_from', 'm34_notifica_email_from_address' );


function m34_notifica_email_from_name( $name ) {
    return 'Montera34';
}
add_filter( 'wp_mail_from_name', 'm34_notifica_email_from_name' );
?>
