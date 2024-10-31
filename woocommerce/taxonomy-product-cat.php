<?php get_header(); ?>

<main id="sidebar-grid">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12 sidebar_grid-left">
                <?php get_sidebar(); ?>
            </div>
            <div class="col-md-9 col-12 sidebar_grid-right">
                <h2 class="title"><?php single_cat_title(); ?></h2>
                <p class="description"><?php echo category_description(); ?></p>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <?php
                        function get_total_product_count() {
                            $term = get_queried_object();
                            $product_count = $term->count;
                            return $product_count;
                        }
                        
                        $total_product_count = get_total_product_count();
                        echo '<p class="filter_p m-0">' . $total_product_count . ' items</p>';
                    ?>

                    <form method="GET" id="sortForm">
                        <label for="sort">Sort By:</label>
                        <select name="sort" id="sort" onchange="document.getElementById('sortForm').submit();">
                            <option value="name" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'name') echo 'selected'; ?>>Product Name</option>
                            <option value="price_asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') echo 'selected'; ?>>Price Low to High</option>
                            <option value="price_desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') echo 'selected'; ?>>Price High to Low</option>
                        </select>
                    </form>
                </div>

                <section id="product_tags">
                    <div class="d-flex flex-wrap product_tags-products">
                        <?php
                            $sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'name';
                            $term = get_queried_object();
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field'    => 'slug',
                                        'terms'    => $term->slug,
                                    ),
                                ),
                            );

                            switch ($sort_order) {
                                case 'price_asc':
                                    $args['orderby'] = 'meta_value_num';
                                    $args['meta_key'] = '_price';
                                    $args['order'] = 'ASC';
                                    break;
                                case 'price_desc':
                                    $args['orderby'] = 'meta_value_num';
                                    $args['meta_key'] = '_price';
                                    $args['order'] = 'DESC';
                                    break;
                                case 'name':
                                default:
                                    $args['orderby'] = 'title';
                                    $args['order'] = 'ASC';
                                    break;
                            }

                            $featured_query = new WP_Query($args);

                            if ($featured_query->have_posts()) : 
                                while ($featured_query->have_posts()) : $featured_query->the_post(); 
                                    global $product;
                        ?>
                                    <article class="product_card d-flex flex-column">
                                        <a class="product_card-link flex-grow-1" href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" class="product_card-image">
                                            <?php endif; ?>
                                            <h4 class="product_card-title text-center"><?php the_title(); ?></h4>
                                        </a>
                                        <div class="product_card-content d-flex flex-column align-items-center">
                                            <h3 class="product_card-content_price"><?php echo $product->get_price_html(); ?></h3>
                                            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="click w-100 text-center add-to-cart-button" data-product-id="<?php echo $product->get_id(); ?>">Add to Cart</a>
                                        </div>
                                    </article>
                        <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<p>No products found in this category!</p>';
                            endif;
                        ?>
                    </div>
                </section>

            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
