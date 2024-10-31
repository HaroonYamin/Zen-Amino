<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
?>

<section id="secure">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center secure_title">
            <svg class="me-4" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12C0 11.0572 0 10.5858 0.292893 10.2929C0.585786 10 1.05719 10 2 10H22C22.9428 10 23.4142 10 23.7071 10.2929C24 10.5858 24 11.0572 24 12V21C24 22.8856 24 23.8284 23.4142 24.4142C22.8284 25 21.8856 25 20 25H12H4C2.11438 25 1.17157 25 0.585786 24.4142C0 23.8284 0 22.8856 0 21V12Z" fill="black"></path>
                <path d="M18.75 10V8.5C18.75 6.87228 18.75 6.05842 18.5623 5.3928C18.0901 3.71847 16.7815 2.40993 15.1072 1.93772C14.4416 1.75 13.6277 1.75 12 1.75V1.75C10.3723 1.75 9.55842 1.75 8.8928 1.93772C7.21847 2.40993 5.90993 3.71847 5.43772 5.3928C5.25 6.05842 5.25 6.87228 5.25 8.5V10" stroke="black" stroke-width="2"></path>
                <circle cx="12" cy="17.5" r="3" fill="black"></circle>
            </svg>
            <h2>Secure Payment</h2>
        </div>
        <div class="check_steps">
            <div class="check_step">
                <span class="pass">1</span>
                <h4>Information</h4>
            </div>
            <div class="h_row h_1"></div>
            <div class="check_step check_1">
                <span>2</span>
                <h4>Shipping</h4>
            </div>
            <div class="h_row h_2"></div>
            <div class="check_step check_2">
                <span>3</span>
                <h4>Payment</h4>
            </div>
        </div>
    </div>
</section>

<div class="row justify-content-between " id="checkout_row">
    <div class="col-lg-5 col-md-6 col-12 checkout_form">
        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
            <div id="checkout-steps">
                <div class="checkout-step" id="step-1">
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>

                    <div class="button_group d-flex flex-wrap">
                        <button type="button" class="next-step step_1"><?php _e( 'Continue to Shipping', 'woocommerce' ); ?></button>
                        <p class="button_error w-100"></p>
                    </div>
                </div>

                <div class="checkout-step" id="step-2" style="display:none;">
                <h3 class="checkout-title"><?php _e( 'Shipping Method', 'woocommerce' ); ?></h3>
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>

                    <div class="button_group d-flex flex-wrap">
                        <button type="button" class="next-step step_2"><?php _e( 'Continue to Payment', 'woocommerce' ); ?></button>
                        <button type="button" class="prev-step step_1"><?php _e( 'Back to Address', 'woocommerce' ); ?></button>
                        <p class="button_error w-100"></p>
                    </div>
                </div>

                <div class="checkout-step" id="step-3" style="display:none;">
                <h3 class="checkout-title"><?php _e( 'Payment Method', 'woocommerce' ); ?></h3>
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>

                    <div class="button_group d-flex flex-wrap">
                        <button type="submit" class="place-order step_2"><?php _e( 'Place Order', 'woocommerce' ); ?></button>
                        <button type="button" class="prev-step"><?php _e( 'Back to Shipping', 'woocommerce' ); ?></button>
                        <p class="button_error w-100"></p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-lg-5 col-md-6 col-12">
        <button id="mobile_summary-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mobile_summary-content" aria-expanded="false" aria-controls="mobile_summary-content" class="collapsed">Hide Order Summary</button>
        <div class="checkout_cart collapse show" id="mobile_summary-content">
            <?php
            // Get the cart contents
            $cart = WC()->cart->get_cart();
            if ( ! empty( $cart ) ) :
            ?>
                <button id="toggle-summary" type="button" data-bs-toggle="collapse" data-bs-target="#cart-summary" aria-expanded="true" aria-controls="cart-summary">Hide Order Summary</button>
                <div id="cart-summary" class="collapse show">
                    <ul class="woocommerce-mini-cart cart_list product_list_widget">
                        <?php
                        foreach ( $cart as $cart_item_key => $cart_item ) {
                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                                $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'full' ), $cart_item, $cart_item_key );
                                $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                $product_quantity  = apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key );
                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                ?>
                                <li class="d-flex ">
                                    <?php echo $thumbnail; ?>
                                    <div class="product-details">
                                        <?php echo $product_name; ?>
                                        <?php echo $product_quantity; ?>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="checkout_cart-group">
                    <p class="subtotal"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>
                    <p class="shipping"><strong><?php _e( 'Shipping', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_shipping_total(); ?></p>
                    <p class="tax"><strong><?php _e( 'Tax', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_taxes_total(); ?></p>
                    <p class="total"><strong><?php _e( 'Total', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_total(); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
