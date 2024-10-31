<?php /* template Name: Checkout */ 
	get_header();
?>

<header class="no-header">
    <div class="container text-center">
        <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); }; ?>
    </div>
</header>

<section id="checkout">
    <div class="container">
        <?php the_content(); ?>
    </div>
</section>

<?php get_footer(); ?>

