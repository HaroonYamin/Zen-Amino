<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );

$current_user = wp_get_current_user();
?>

<nav class="woocommerce-MyAccount-navigation account_nav" aria-label="<?php esc_html_e( 'Account pages', 'woocommerce' ); ?>">
	<h1 class="account_user">
		<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M10 2C7.92893 2 6.25 3.67893 6.25 5.75C6.25 7.82107 7.92893 9.5 10 9.5C12.0711 9.5 13.75 7.82107 13.75 5.75C13.75 3.67893 12.0711 2 10 2ZM4.75 5.75C4.75 2.85051 7.10051 0.5 10 0.5C12.8995 0.5 15.25 2.85051 15.25 5.75C15.25 8.6495 12.8995 11 10 11C7.10051 11 4.75 8.6495 4.75 5.75Z" fill="rgb(var(--color-orange))"></path>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M3.70293 14C3.18942 14 2.7698 14.2514 2.58209 14.6301C2.22208 15.3564 1.83539 16.3366 1.75444 17.2798C1.71845 17.6991 1.89311 18.0458 2.17849 18.223L1.78273 18.8601L2.17849 18.223C3.24819 18.8875 5.67877 20 9.99988 20C14.321 20 16.7516 18.8875 17.8213 18.223C18.1067 18.0458 18.2813 17.6991 18.2453 17.2798C18.1644 16.3366 17.7777 15.3564 17.4177 14.6301C17.23 14.2514 16.8103 14 16.2968 14H3.70293ZM1.23814 13.9639C1.71811 12.9956 2.71308 12.5 3.70293 12.5H16.2968C17.2867 12.5 18.2817 12.9956 18.7616 13.9639C19.1541 14.7557 19.6353 15.9335 19.7398 17.1515C19.8172 18.0533 19.4424 18.9819 18.6128 19.4972C17.2998 20.3128 14.594 21.5 9.99988 21.5C5.40578 21.5 2.69996 20.3128 1.38697 19.4972C0.557403 18.9819 0.182531 18.0533 0.259933 17.1515C0.364477 15.9335 0.845633 14.7557 1.23814 13.9639Z" fill="rgb(var(--color-orange))"></path>
		</svg>

		<?php echo esc_html__( $current_user->display_name, 'woocommerce' ); ?>
	</h1>

	<ul class="account_nav-list">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>

	<div class="account_mobile">
		<button class="account_mobile-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			My Account
		</button>
		<div class="collapse" id="collapseExample">
			<ul class="account_mobile-list">
				<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
					<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
						<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
