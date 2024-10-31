<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);

$first_name = wp_get_current_user()->user_firstname;
$last_name = wp_get_current_user()->user_lastname;
$email = wp_get_current_user()->user_email;

$edit_account_url = wc_get_endpoint_url( 'edit-account', '', wc_get_page_permalink( 'myaccount' ) );
$edit_address_url = wc_get_endpoint_url( 'edit-address', '', wc_get_page_permalink( 'myaccount' ) );
?>

<h2 class="account_dashboard-headings"><?php esc_html_e( 'Account Information', 'woocommerce' ); ?></h2>
<div class="account_row d-flex">
	<div class="account_row-col">
		<h3 class="account_row-title">Contact Information<h3>
		<p class="account_row-p"><?php echo esc_html__( $first_name . ' ' . $last_name, 'woocommerce' ); ?></p>
		<p class="account_row-p"><?php echo esc_html__( $email, 'woocommerce' ); ?></p>
		<a href="<?php echo esc_url( $edit_account_url ); ?>" class="account_row-a">Edit</a>
	</div>
</div>

<?php include_once( 'my-address.php' ); ?>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
