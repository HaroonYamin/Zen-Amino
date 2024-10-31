<?php get_header(); ?>

<main id="archive" class="single">
    <div class="container">
        <div class="archive_row">
            <section class="col-md-3 col-12 archive_left">
                <div class="archive_search">
                    <h4>Search the blog</h4>
                    <div class="archive_search-input">
                        <input type="search" placeholder="Filter Categories">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.8337 16.7142C15.7185 16.7146 15.6043 16.6922 15.4977 16.6483C15.3912 16.6044 15.2944 16.5398 15.2129 16.4583L11.667 12.9167V12.2583L11.442 12.025C10.4591 12.8677 9.20758 13.3317 7.91288 13.3333C7.60432 13.333 7.29634 13.307 6.99206 13.2559C5.65316 13.0269 4.44913 12.3033 3.61865 11.2284C2.78816 10.1535 2.39183 8.80589 2.50821 7.45256C2.6246 6.09923 3.24519 4.839 4.247 3.9217C5.24881 3.0044 6.55872 2.49699 7.91705 2.50001C8.14603 2.50025 8.37481 2.51444 8.60206 2.54251C9.57298 2.66436 10.4927 3.04727 11.2632 3.65045C12.0337 4.25363 12.6262 5.05453 12.9776 5.9678C13.3289 6.88108 13.426 7.87254 13.2585 8.83663C13.091 9.80072 12.6651 10.7013 12.0262 11.4425L12.2604 11.6675H12.9179L16.4512 15.2175C16.575 15.3399 16.6595 15.4964 16.6941 15.6671C16.7286 15.8378 16.7115 16.0148 16.645 16.1757C16.5785 16.3366 16.4655 16.4741 16.3206 16.5706C16.1757 16.6671 16.0053 16.7182 15.8312 16.7175L15.8337 16.7142ZM7.91705 4.16668C7.17537 4.16668 6.45035 4.38662 5.83366 4.79867C5.21698 5.21073 4.73632 5.79639 4.45249 6.48162C4.16866 7.16684 4.09442 7.92083 4.23912 8.64826C4.38381 9.37569 4.74093 10.0439 5.26537 10.5683C5.78982 11.0928 6.45801 11.4499 7.18544 11.5946C7.91287 11.7393 8.66686 11.6651 9.35208 11.3812C10.0373 11.0974 10.623 10.6167 11.0351 10.0001C11.4471 9.38338 11.667 8.65836 11.667 7.91668C11.6659 6.92246 11.2705 5.96928 10.5675 5.26625C9.86448 4.56323 8.91127 4.16778 7.91705 4.16668Z" fill=""></path>
                        </svg>
                    </div>
                </div>
                <div class="archive_categories">
                    <h4>Categories</h4>
                    <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order'   => 'ASC'
                        ));
                        
                        if (!empty($categories) && !is_wp_error($categories)) {
                            echo '<ul>';
                            foreach ($categories as $category) {
                                echo '<li>';
                                echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                    ?>
                </div>
                <div class="archive_recent">
                    <h4>Recent Posts</h4>
                    <?php
                        $args = array(
                            'post_type'      => 'post',
                            'posts_per_page' => 3,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        );

                        $recent_posts = new WP_Query($args);

                        if ($recent_posts->have_posts()) {
                            echo '<ul>';
                            while ($recent_posts->have_posts()) {
                                $recent_posts->the_post();
                                $time_diff = human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
                                echo '<li>';
                                echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a><span class="recent_time">' . $time_diff . '</span>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        } else {
                            echo '<p>No recent posts found.</p>';
                        }

                        wp_reset_postdata();
                    ?>
                </div>

            </section>
        
            <section class="col-md-9 col-12 archive_right">
                <h1 class="title"><?php the_title(); ?></h1>

                <div id="note" class="d-flex archive_note">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4ZM12 2C6.477 2 2 6.477 2 12C2 17.523 6.477 22 12 22C17.523 22 22 17.523 22 12C22 6.477 17.523 2 12 2ZM13 15H11V17H13V15ZM11 13H13L13.5 7H10.5L11 13Z" fill="rgb(var(--color-orange))"></path>
                    </svg>
                    <div class="note_text">
                        <p>
                            Product Usage: This PRODUCT IS INTENDED AS A RESEARCH CHEMICAL ONLY. This designation allows the use of research chemicals strictly for in vitro testing and laboratory experimentation only. All product information available on this website is for educational purposes only. Bodily introduction of any kind into humans or animals is strictly forbidden by law. This product should only be handled by licensed, qualified professionals. This product is not a drug, food, or cosmetic and may not be misbranded, misused or mislabled as a drug, food or cosmetic.
                        </p>
                    </div>
                </div>

                <div class="single_blog">
                    <div class="archive_meta">
                        <span class="author">By <?php the_author(); ?></span>
                        <span class="date"><?php echo get_the_date(); ?></span>
                    </div>

                    <?php the_content(); ?>
                </div>

            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>