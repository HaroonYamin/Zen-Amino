<?php
/**
 * Custom single product template for WooCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
get_header();
?>

<section id="single-product">
    <div class="container pt-5">
        <div class="row">
            <?php
                while ( have_posts() ) : the_post();
                    // do_action( 'woocommerce_single_product_summary' );
                    global $product;
            ?>

                    <div class="single-image col-lg-5 col-12 text-center">
                        <?php
                            if ( has_post_thumbnail() ) {
                                $image_id = get_post_thumbnail_id();
                                $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                                echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                            }
                        ?>
                    </div>
                    <div class="single-text col-lg-7 col-12">
                        <h1><?php echo $product->get_name(); ?></h1>
                        
                        <div class="single_price d-flex align-items-center justify-content-between mb-4">
                            <div class="single_price-price">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            <div class="single_price-star d-flex align-items-center gx-4">
                                <div class="d-flex align-items-center">
                                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="rgb(var(--color-orange))">
                                        <path fill="" d="M63.893,24.277c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0s-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719c0.302,0.166,0.636,0.25,0.968,0.25 c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704l14.294-14.657 C63.951,25.771,64.131,24.987,63.893,24.277z"/>
                                    </svg>
                                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="rgb(var(--color-orange))">
                                        <path fill="" d="M63.893,24.277c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0s-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719c0.302,0.166,0.636,0.25,0.968,0.25 c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704l14.294-14.657 C63.951,25.771,64.131,24.987,63.893,24.277z"/>
                                    </svg>
                                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="rgb(var(--color-orange))">
                                        <path fill="" d="M63.893,24.277c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0s-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719c0.302,0.166,0.636,0.25,0.968,0.25 c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704l14.294-14.657 C63.951,25.771,64.131,24.987,63.893,24.277z"/>
                                    </svg>
                                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="rgb(var(--color-orange))">
                                        <path fill="" d="M63.893,24.277c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0s-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719c0.302,0.166,0.636,0.25,0.968,0.25 c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704l14.294-14.657 C63.951,25.771,64.131,24.987,63.893,24.277z"/>
                                    </svg>
                                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="rgb(var(--color-orange))">
                                        <path fill="" d="M63.893,24.277c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0s-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719c0.302,0.166,0.636,0.25,0.968,0.25 c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704l14.294-14.657 C63.951,25.771,64.131,24.987,63.893,24.277z"/>
                                    </svg>
                                </div>
                                <p class="m-0">4.9 stars</p>
                            </div>
                        </div>

                        <div class="single_price-description">
                            <?php
                                if ( $product->get_short_description() ) {
                                    echo apply_filters( 'woocommerce_short_description', $product->get_short_description() );
                                }
                            ?>
                        </div>

                        <?php
                            $bullets = get_field('points', get_the_ID());
                            if($bullets):
                                echo '<ul class="single_bullets">';
                                foreach($bullets as $bullet):
                                    echo '<li class="single_bullets-item">' . $bullet['content'] . '</li>';
                                endforeach;
                                echo '</ul>';
                            endif;
                        ?>

                        <form class="cart single-cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                            <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                            <?php
                            do_action( 'woocommerce_before_add_to_cart_quantity' );
                            echo '<div class="single-quantity">';
                            echo '<button type="button" class="remove_quantity"><svg width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6 12H18" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
                            woocommerce_quantity_input(
                                array(
                                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                                )
                            );
                            echo '<button type="button" class="add_quantity"><svg width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 12H18" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/></svg></button></div>';

                            do_action( 'woocommerce_after_add_to_cart_quantity' );
                            ?>

                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

                            <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        </form>
                            
                        <div class="single_availablity"><strong>Availability:</strong> Ships today if ordered and paid by 12 PM PST. (Except Saturdays & Sundays)</div>

                        <div class="single_blocks d-flex">
                            <div class="single_blocks-box">
                                <img src="https://zenamino.com/wp-content/uploads/2024/06/icon_truck.svg" alt="">
                                <div class="single_blocks-box_group">
                                    <h4>FREE Shipping</h4>
                                    <p>for orders over $200</p>
                                    <h6></h6>
                                </div>
                            </div>
                            <div class="single_blocks-box">
                                <img src="https://zenamino.com/wp-content/uploads/2024/06/cart-order-summary-img2.webp" alt="">
                                <div class="single_blocks-box_group">
                                    <h4>Free (1) 30 ml Bacteriostatic Water</h4>
                                    <p>with qualified orders over $500 USD.</p>
                                    <h6>(excludes capsule products, cosmetic peptides, promo codes and shipping)</h6>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php

                endwhile;
            ?>
        </div>
    </div>
</section>

<section id="sidebar-grid" class="single_grid">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12 sidebar_grid-left">
                <?php get_sidebar(); ?>
            </div>
            <div class="col-md-9 col-12 sidebar_grid-right single">
                <section id="note" class="d-flex">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4ZM12 2C6.477 2 2 6.477 2 12C2 17.523 6.477 22 12 22C17.523 22 22 17.523 22 12C22 6.477 17.523 2 12 2ZM13 15H11V17H13V15ZM11 13H13L13.5 7H10.5L11 13Z" fill="rgb(var(--color-orange))"/>
                    </svg>
                    <div class="note_text">
                        <p>
                            Product Usage: This PRODUCT IS INTENDED AS A RESEARCH CHEMICAL ONLY. This designation allows the use of research chemicals strictly for in vitro testing and laboratory experimentation only. All product information available on this website is for educational purposes only. Bodily introduction of any kind into humans or animals is strictly forbidden by law. This product should only be handled by licensed, qualified professionals. This product is not a drug, food, or cosmetic and may not be misbranded, misused or mislabled as a drug, food or cosmetic.
                        </p>
                    </div>
                </section>

                <section id="single_details">
                    <?php
                        while ( have_posts() ) : the_post();
                            global $product;
                            $description = get_field('description', get_the_ID());
                            if($description):
                                foreach($description as $single):

                    ?>
                                    <div class="group">
                                        <div class="text">
                                            <h4><?php echo $single['heading'] ?></h4>
                                        </div>
                                        <div class="content w-100">
                                            <?php echo $single['content'] ?>
                                        </div>
                                    </div>
                    <?php
                                endforeach;
                            endif;
                         endwhile;
                    ?>
                </section>

            </div>
        </div>
    </div>
</section>


<?php 
do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' ); ?>