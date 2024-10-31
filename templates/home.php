<?php
/* Template Name: Home */
    get_header();
?>

<main id="home-page">

    <section id="hero">
        <div class="container position-relative">
            <div class="hero_bg" style="background-image: url(https://dynamic.zenamino.com/wp-content/uploads/2024/05/peptide-main-banner-bg.png);"></div>
            <div id="hero_slider" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-wrap="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#hero_slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#hero_slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <!-- <button type="button" data-bs-target="#hero_slider" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
                </div>
                
                <?php if( have_rows('slider') ): ?>
                <div class="carousel-inner">
                    <?php $active = true; ?>
                    <?php while( have_rows('slider') ): the_row(); 
                        $title = get_sub_field('title');
                        $subtitle = get_sub_field('subtitle');
                        $text = get_sub_field('text');
                        $label = get_sub_field('label');
                        $button = get_sub_field('button');
                        $image = get_sub_field('image');
                    ?>
                    <div class="carousel-item <?php if($active) { echo 'active'; $active = false; } ?>" data-bs-interval="5000">
                        <div class="row justify-content-evenly align-items-center">
                            <div class="col-1 d-lg-block d-none"></div>
                            <div class="hero_text col-lg-6 col-7">
                                <h2 class="hero_text-title"><?php echo $title; ?></h2>
                                <h3 class="hero_text-subtitle"><?php echo $subtitle; ?></h3>
                                <?php if( $text ): ?>
                                    <p class="hero_text-paragraph d-none d-md-block"><?php echo $text; ?></p>
                                <?php endif; ?>
                                <?php if( $label ): ?>
                                    <span class="hero_text-note d-none d-md-block"><?php echo $label; ?></span>
                                <?php endif; ?>

                                <?php if ($button):?>
                                    <a href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_url($button['target']); ?>" class="hero_text-button click"><?php echo $button['title']; ?></a>
                                <?php endif; ?>
                            </div>

                            <div class="col-1 d-lg-block d-none"></div>
                            <div class="hero_image col text-center">
                                <img class="hero_image-img" src="<?php echo $image; ?>" alt="A Bundle of peptides">
                            </div>
                            <div class="col-1 d-lg-block d-none"></div>
                        </div>
                    </div>
                  <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
            <!-- slide ended -->
        </div>
    </section>

    <section id="advantages">
        <div class="container">
            <div class="row justify-content-center">
                <?php
                $repeater = get_field('badges');
                        if ($repeater):
                            foreach ($repeater as $repeat):
                                ?>
                    <div class="col-lg-3 col-sm-5 col-12 d-flex align-items-baseline">
                        <img src="<?php echo $repeat['icon'] ?>" alt="icon" class="advantages_image me-2">
                                    <div class="advantages_text">
                                        <h4><?php echo $repeat['title']; ?></h4>
                                        <p><?php echo $repeat['subtitle']; ?></p>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        endif; 
                        ?>
                    </div>    
            </div>
        </div>
    </section>

    <section id="sidebar-grid">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-12 sidebar_grid-left">
                    <?php get_sidebar(); ?>
                </div>
                <div class="col-md-9 col-12 sidebar_grid-right">
                    <p class="home_content">At Zen Amino, we specialize in synthesizing highly purified peptides, proteins, and amino acid derivatives for scientific research and development. Using both automated and manual peptide synthesizers, alongside advanced solution and solid-phase peptide synthesis technology, we deliver peptides and proteins with purity levels exceeding 99%. From the initial stages of peptide synthesis to packaging and delivery, we adhere to the strictest quality control standards, ensuring our products arrive in their purest and most stable form. Our in-house testing throughout production, conducted in our analytical test lab, verifies the sequential fingerprints of our peptides for precise accuracy. This meticulous process involves the use of highly accurate High-Performance Liquid Chromatography and Mass Spectrometry analysis, scientifically confirming the purity, accuracy, and identity of each peptide. At Zen Amino, we're committed to providing the finest quality peptides and proteins for your research needs.</p>

                    <section id="product" class="splide">
                        <h2 class="product_title">Best Sellers</h2>
                        <div class="splide__track">
                            <div class="splide__list">
                                <?php
                                    $args = array(
                                        'post_type' => 'product',
                                        'posts_per_page' => -1,
                                        'tax_query'      => array(
                                            array(
                                                'taxonomy' => 'product_visibility',
                                                'field'    => 'name',
                                                'terms'    => 'featured',
                                                'operator' => 'IN',
                                            ),
                                        ),
                                    );
                                    $featured_query = new WP_Query($args);

                                    if ($featured_query->have_posts()) : 
                                        while ($featured_query->have_posts()) : $featured_query->the_post(); 
                                            global $product;
                                ?>
                                            <div class="splide__slide">
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
                                            </div>
                                <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    else :
                                        echo '<p>No featured products found!</p>';
                                    endif;
                                ?>
                            </div>
                        </div>
                    </section>

                    <section id="collection">
                        <!-- <h2 class="collection_title">Best Collections</h2> -->
                        <div class="container">
                            <div class="row justify-content-between">
                                <!-- <div class="col-6 d-flex align-items-center collection_card">
                                    <div class="collection_card-bg"></div>
                                    <div class="collection_card-text">
                                        <h4 class="collection_card-text_title">Peptide Capsules</h4>
                                        <a href="https://dynamic.zenamino.com/product-category/peptide-capsules/" class="collection_card-text_button click">Shop Now</a>
                                    </div>
                                    <img src="https://dynamic.zenamino.com/wp-content/uploads/2024/05/Screenshot_2.webp" alt="Collection image" class="collection_card-image">
                                </div> -->
                                <div class="col-6 d-flex align-items-center collection_card">
                                    <div class="collection_card-bg"></div>
                                    <div class="collection_card-text">
                                        <h4 class="collection_card-text_title">Peptides</h4>
                                        <a href="https://dynamic.zenamino.com/product-category/purchase-peptides/" class="collection_card-text_button click">Shop Now</a>
                                    </div>
                                    <img src="https://dynamic.zenamino.com/wp-content/uploads/2024/08/Zen-Amino-Multiple-Mockup-2.png" alt="Collection image" class="collection_card-image">
                                </div>
                                <div class="col-6 d-flex align-items-center collection_card">
                                    <div class="collection_card-bg"></div>
                                    <div class="collection_card-text">
                                        <h4 class="collection_card-text_title">Peptide Blends</h4>
                                        <a href="https://dynamic.zenamino.com/product-category/peptide-blends/" class="collection_card-text_button click">Shop Now</a>
                                    </div>
                                    <img src="https://dynamic.zenamino.com/wp-content/uploads/2024/08/Zen-Amino-Multiple-Mockup-3.png" alt="Collection image" class="collection_card-image">
                                </div>
                                <!-- <div class="col-6 d-flex align-items-center collection_card">
                                    <div class="collection_card-bg"></div>
                                    <div class="collection_card-text">
                                        <h4 class="collection_card-text_title">IGF-1 Proteins</h4>
                                        <a href="https://dynamic.zenamino.com/product-category/igf-1-proteins/" class="collection_card-text_button click">Shop Now</a>
                                    </div>
                                    <img src="https://dynamic.zenamino.com/wp-content/uploads/2024/05/Screenshot_2.webp" alt="Collection image" class="collection_card-image">
                                </div> -->
                            </div>
                        </div>
                    </section>

                    <section id="product_tags">
                        <h2 class="product_tags-title">Purchase The Highest Quality U.S.A Made Peptides Direct from Zen Amino</h2>
                        <div class="d-flex flex-wrap product_tags-products">
                            <?php
                                    $args = array(
                                        'post_type' => 'product',
                                        'posts_per_page' => -1,
                                    );
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
                                        echo '<p>No featured products found!</p>';
                                    endif;
                                ?>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-6 col-12 about_text">
                <?php
                    $title = get_field('about_zenamino');
                    if ($title):
                    ?>
                        <h2 class="about_text-title"><?php echo $title; ?></h2>
                    <?php 
                    endif; 
                    $repeater = get_field('title');
                    if ($repeater):
                        foreach ($repeater as $repeat):
                            ?>
                            <div class="about_text-card d-flex w-100 align-items-start">
                                <img src="<?php echo $repeat['icon'] ?>" alt="icon" class="about_text-card_image me-3">
                                <div class="about_text-card_title">
                                    <h4><?php echo $repeat['title']; ?></h4>
                                    <p><?php echo $repeat['paragraph']; ?></p>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif; 
                    ?>
                </div>
                <div class="col-lg-6 col-12 p-0 about_image img-fluid">
                <?php 
                $image = get_field('pure_and_tested');
                if($image):
                ?>
                <img src="<?php echo $image; ?>" alt="About Image" class="about_image-img">
                <?php
                endif;                    
                ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>


















       


