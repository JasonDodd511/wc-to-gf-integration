<?php

/*
Plugin Name: WC To GF Integration
Plugin URI: https://github.com/JasonDodd511/wc-to-gf-integration
Description: Snippets that facilitate integration between WooCommerce and GravityForms
Version: 1.0.2
Author: Jason Dodd
Author URI:
License: GPL2
GitHub Plugin URI: https://github.com/JasonDodd511/wc-to-gf-integration
GitHub Branch:     master
GitHub Languages:
*/

/**
 * Provides capability to use session variables as merge tags in
 * GravityForms
 */
include dirname(__FILE__) . '/incl/gravityforms-extended-merge-tags.php';


/**
 * Create session if one hason't already been started
 */
function wcgf_start_session () {
	if(!session_id()) {
		session_start();
	}
}

add_action('init', 'wcgf_start_session', 1);

/**
 * Pull order data and store in session
 *
 * Stores billing data in session variables immediately after the
 * payment has been completed and before the $_REQUEST data is unset.
 *
 * @param $order_id
 *
 */
function wpgf_pull_billing_data ( $order_id ) {
	$_SESSION['wcgf_email'] = $_REQUEST['billing_email'];
	$_SESSION['wcgf_firstname'] = $_REQUEST['billing_first_name'];
	$_SESSION['order_id'] = $order_id;
}

add_action( 'woocommerce_pre_payment_complete', 'wpgf_pull_billing_data', 10, 1);