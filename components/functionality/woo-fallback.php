<?php

// Adding Items with AJAX
add_action('wp_ajax_add_to_cart_action', 'add_to_cart_action_callback');
add_action('wp_ajax_nopriv_add_to_cart_action', 'add_to_cart_action_callback');
function add_to_cart_action_callback() {
    // Initialize WooCommerce cart
    WC()->cart->init();

    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $quantity = 1; // You can modify this as needed

        // Add product to cart
        $added = WC()->cart->add_to_cart($product_id, $quantity);

        if ($added) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    wp_die();
}

// Number of items in cart
add_action('wp_ajax_update_cart_count', 'update_cart_count');
add_action('wp_ajax_nopriv_update_cart_count', 'update_cart_count');

function update_cart_count() {
    echo WC()->cart->get_cart_contents_count();
    wp_die();
}


// Load Cart Contents
function load_cart_contents() {
    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();
    $data = array(
        'cart_contents' => $mini_cart,
        'cart_total'    => WC()->cart->get_cart_total()
    );
    wp_send_json_success($data);
}
add_action('wp_ajax_load_cart_contents', 'load_cart_contents');
add_action('wp_ajax_nopriv_load_cart_contents', 'load_cart_contents');

// Update Cart Quantity
function update_cart_quantity() {
    $product_key = sanitize_text_field($_POST['product_key']);
    $quantity = intval($_POST['quantity']);
    if ($quantity > 0) {
        WC()->cart->set_quantity($product_key, $quantity);
    } else {
        WC()->cart->remove_cart_item($product_key);
    }
    wp_send_json_success();
}
add_action('wp_ajax_update_cart_quantity', 'update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity');

// Remove Cart Item
function remove_cart_item() {
    $product_key = sanitize_text_field($_POST['product_key']);
    WC()->cart->remove_cart_item($product_key);
    wp_send_json_success();
}
add_action('wp_ajax_remove_cart_item', 'remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'remove_cart_item');

// Blogs filter
function filter_categories() {
    $search_query = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : '';

    $args = array(
        'orderby' => 'name',
        'order'   => 'ASC',
        'name__like' => $search_query
    );

    $categories = get_categories($args);

    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            echo '<li>';
            echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
            echo '</li>';
        }
    } else {
        echo '<li>No categories found.</li>';
    }

    wp_die();
}
add_action('wp_ajax_filter_categories', 'filter_categories');
add_action('wp_ajax_nopriv_filter_categories', 'filter_categories');

// Search AJAX
add_action('wp_ajax_search_products', 'search_products_callback');
add_action('wp_ajax_nopriv_search_products', 'search_products_callback');

function search_products_callback() {
    $search = sanitize_text_field($_POST['search']);
    
    $args = array(
        'post_type' => 'product',
        's' => $search,
        'posts_per_page' => 5,
    );

    $search_query = new WP_Query($args);

    if ($search_query->have_posts()) :
        while ($search_query->have_posts()) : $search_query->the_post();
            global $product;
            ?>
            <article class="product_card d-flex flex-column">
                <a class="product_card-link flex-grow-1" href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>"
                        class="product_card-image">
                    <?php endif; ?>
                    <h4 class="product_card-title text-center"><?php the_title(); ?></h4>
                </a>
                <div class="product_card-content d-flex flex-column align-items-center">
                    <h3 class="product_card-content_price"><?php echo $product->get_price_html(); ?></h3>
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                        class="click w-100 text-center add-to-cart-button"
                        data-product-id="<?php echo $product->get_id(); ?>">Add to Cart</a>
                </div>
            </article>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No products found!</p>';
    endif;

    die();
}

add_action('wp_ajax_search_tags', 'search_tags_callback');
add_action('wp_ajax_nopriv_search_tags', 'search_tags_callback');

function search_tags_callback() {
    $search = sanitize_text_field($_POST['search']);
    
    $product_tags = get_terms('product_tag', array(
        'orderby'    => 'name',
        'order'      => 'ASC',
        'number'     => 4,
        'search'     => $search,
    ));
    
    ob_start();

    if (!empty($product_tags) && !is_wp_error($product_tags)) :
    ?>
    <div class="header_search-drop_tags d-flex mb-5 align-items-center">
        <h4 class="mb-0 me-4 d-inline">Popular Keywords</h4>
        <nav class="nav flex-row">
            <?php
            foreach ($product_tags as $tag) {
                $tag_link = get_term_link($tag);
                echo '<a class="nav-link" href="' . esc_url($tag_link) . '" data-tag="' . esc_attr($tag->slug) . '">' . esc_html($tag->name) . '</a>';
            }
            ?>
        </nav>
    </div>
    <?php
    else :
        echo '<p>No tags found!</p>';
    endif;

    $output = ob_get_clean();
    echo $output;
    die(); 
}
