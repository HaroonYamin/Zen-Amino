<?php
function wordpress_active() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'custom-logo' );
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Navbar', 'web_name' ),
			'menu-2' => esc_html__( 'Dropdown Menu', 'web_name' ),
        )
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'wordpress_active' );

function svg_upload( $mime_types ) {
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter( 'upload_mimes', 'svg_upload' );

if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(
		array (
			'page_title' =>'Header',
			'menu_title' =>'Edit Header',
			'menu_slug' =>'header-setting',
			'capability'    => 'edit_posts',
		)
	);
    acf_add_options_page(
		array (
			'page_title' =>'Footer',
			'menu_title' =>'Edit Footer',
			'menu_slug' =>'footer-setting',
			'capability'    => 'edit_posts',
		)
	);
	acf_add_options_page(
		array (
			'page_title' =>'Home Page',
			'menu_title' =>'Edit Home',
			'menu_slug' =>'home-setting',
			'capability'    => 'edit_posts',
		)
	);
}

function enqueue_custom_styles() {
    wp_enqueue_style( 'arimo-fonts', get_stylesheet_directory_uri() . '/includes/fonts/arimo/stylesheet.css');
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/addons/bootstrap/css/bootstrap.css');
	wp_enqueue_style( 'aos-css', get_stylesheet_directory_uri() . '/addons/aos/aos.css');
	wp_enqueue_style( 'splide-css', get_stylesheet_directory_uri() . '/addons/splide/splide.min.css' );
    wp_enqueue_style( 'support-css', get_stylesheet_directory_uri() . '/includes/support.css');
	wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/includes/styles.css', array(), filemtime(get_stylesheet_directory() . '/includes/styles.css') );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_styles' );

function enqueue_custom_scripts() {
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/includes/script.js', array(), filemtime(get_stylesheet_directory() . '/includes/script.js') );
	wp_enqueue_script( 'checkout-validation', get_template_directory_uri() . '/components/functionality/checkout-errors.js', array('jquery'), filemtime(get_stylesheet_directory() . '/components/functionality/checkout-errors.js'), true );
	wp_enqueue_script( 'splide-js', get_template_directory_uri() . '/addons/splide/splide.min.js' );
    wp_enqueue_script( 'aos-js', get_template_directory_uri() . '/addons/aos/aos.js');
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/addons/bootstrap/js/bootstrap.js', array(), '1.0', true );
	wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );

require 'components/gutenberg.php';

function custom_theme_wc_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'custom_theme_wc_support' );


// Localized AJAX scriptenqueue_woo_ajax_script');
add_action('wp_enqueue_scripts', 'enqueue_woo_ajax_script');
add_action('wp_enqueue_scripts', 'enqueue_woo_ajax_script');
function enqueue_woo_ajax_script() {
    wp_enqueue_script(
        'woo-ajax',
        get_template_directory_uri() . '/components/functionality/woo-ajax.js',
        array('jquery'),
        filemtime(get_stylesheet_directory() . '/components/functionality/woo-ajax.js'),
        true
    );
	
    wp_localize_script('woo-ajax', 'woo_ajax_obj', array(
		'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('woocommerce-cart')
    ));
}

include get_template_directory() . '/components/functionality/woo-fallback.php';