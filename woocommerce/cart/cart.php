<?php
defined('ABSPATH') || exit;
?>

<section id="cart">
    <div class="container">
        <?php do_action('woocommerce_before_cart'); ?>

        <div class="cart_heading d-flex align-items-center">
            <h1><?php esc_html_e('Shopping Cart', 'woocommerce'); ?></h1>
            <p><?php echo '(' . esc_html(WC()->cart->get_cart_contents_count()) . ' ' . esc_html__('items', 'woocommerce') . ')'; ?></p>
        </div>

        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <div class="row justify-content-between">
                <div class="col-7">
                    <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                        <?php do_action('woocommerce_before_cart_contents'); ?>

                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                        ?>
                                <div class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                    <div class="product_details-group d-flex align-items-center">
                                        <div class="product-thumbnail">
                                            <?php
                                            $image_size = 'full';
                                            $image_attributes = array(
                                                'title' => get_the_title($_product->get_id()),
                                                'alt' => get_post_meta($_product->get_id(), '_wp_attachment_image_alt', true),
                                            );

                                            if (!$product_permalink) {
                                                $image = $_product->get_image($image_size, $image_attributes);
                                                echo apply_filters('woocommerce_cart_item_thumbnail', $image, $cart_item, $cart_item_key);
                                            } else {
                                                $image = sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_image($image_size, $image_attributes));
                                                echo apply_filters('woocommerce_cart_item_thumbnail', $image, $cart_item, $cart_item_key);
                                            }
                                            ?>
                                        </div>

                                        <div class="product_group">
                                            <div class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                                <?php
                                                if (!$product_permalink) {
                                                    echo wp_kses_post($_product->get_name() . '&nbsp;');
                                                } else {
                                                    echo wp_kses_post(sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()));
                                                }

                                                echo wc_get_formatted_cart_item_data($cart_item);

                                                if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                    echo wp_kses_post('<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>');
                                                }
                                                ?>
                                            </div>

                                            <div class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                                <?php
                                                if ($_product->is_sold_individually()) {
                                                    $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                                } else {
                                                    $product_quantity = woocommerce_quantity_input(array(
                                                        'input_name' => "cart[{$cart_item_key}][qty]",
                                                        'input_value' => $cart_item['quantity'],
                                                        'max_value' => $_product->get_max_purchase_quantity(),
                                                        'min_value' => '0',
                                                        'product_name' => $_product->get_name(),
                                                    ), $_product, false);
                                                }

                                                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product_price-group">
                                        <div class="product-subtotal" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
                                            <?php
                                            echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
                                            ?>
                                        </div>

                                        <div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                            <?php
                                            echo '<p>' . esc_html__('each', 'woocommerce') . ' </p>' . apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="product-remove">
                                        <?php
                                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            esc_html__('Remove this item', 'woocommerce'),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ), $cart_item_key);
                                        ?>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>

                        <?php do_action('woocommerce_cart_contents'); ?>

                        <?php do_action('woocommerce_after_cart_contents'); ?>
                    </div>
                </div>

                <div class="col-4">
                    <div class="cart_buttons">
                        <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>
                        <?php do_action('woocommerce_proceed_to_checkout'); ?>
                    </div>
                    <div class="cart-collaterals">
                        <?php
                        do_action('woocommerce_cart_collaterals');
                        ?>
                    </div>

                    <div class="cart_promo position-relative">
                        <button class="cart_promo-button" type="button" data-bs-toggle="collapse" data-bs-target="#cart-promo" aria-expanded="false" aria-controls="cart-promo">
                            <?php esc_html_e('Have a promo code?', 'woocommerce'); ?>
                        </button>
                        <div class="cart_promo-content collapse" id="cart-promo">
                            <?php if (wc_coupons_enabled()) { ?>
                                <div class="coupon">
                                    <label for="coupon_code"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label>
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
                                    <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
                                    <?php do_action('woocommerce_cart_coupon'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="actions">
                        <?php do_action('woocommerce_cart_actions'); ?>
                        <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                    </div>
                </div>
            </div>
        </form>

        <?php do_action('woocommerce_after_cart'); ?>
    </div>
</section>
