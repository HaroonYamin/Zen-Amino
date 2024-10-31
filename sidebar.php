<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<section id="sidebar">
    <?php
    $terms = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ));

    if (!empty($terms) && !is_wp_error($terms)):
        foreach ($terms as $term):
    ?>
            <h4 class="sidebar_title"><?php echo esc_html($term->name) ?></h4>
            <ul class="sidebar_list">
                <?php
                    $products = new WP_Query(array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => $term->slug,
                            ),
                        ),
                    ));

                    if ($products->have_posts()):
                        while ($products->have_posts()): 
                            $products->the_post();
                            echo '<li class="sidebar_list-item"><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                        endwhile;
                    endif;
                ?>
            </ul>
    <?php
            wp_reset_postdata();
        endforeach;
    endif;
    ?>
</section>
