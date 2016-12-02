<?php

/*
Plugin Name: WC To GF Integration
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: jason
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

include dirname(__FILE__) . '/incl/gravityforms-extended-merge-tags.php';

function wcgf_start_session () {
	if(!session_id()) {
		session_start();
	}
}

add_action('init', 'wcgf_start_session', 1);

function wpgf_pull_billing_data ( $order_id ) {
	$_SESSION['wcgf_email'] = $_REQUEST['billing_email'];
	$_SESSION['wcgf_firstname'] = $_REQUEST['billing_first_name'];
	$_SESSION['order_id'] = $order_id;
}

add_action( 'woocommerce_pre_payment_complete', 'wpgf_pull_billing_data', 10, 1);