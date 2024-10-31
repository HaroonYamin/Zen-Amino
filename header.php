<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" href="https://zenamino.com/wp-content/uploads/2024/06/favicon.svg" type="image/x-icon">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<header id="header">
		<div class="container changed">
			<div class="row justify-content-between align-items-center header_upper">
				<div class="header_logo col-2">
					<?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); }; ?>
				</div>

				<div class="col header_search">
					<div class="position-relative">
						<input id="search" class="header_search-input w-100" type="search" placeholder="Search">
						<label for="search" class="header_search-label">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M15.8337 16.7142C15.7185 16.7146 15.6043 16.6922 15.4977 16.6483C15.3912 16.6044 15.2944 16.5398 15.2129 16.4583L11.667 12.9167V12.2583L11.442 12.025C10.4591 12.8677 9.20758 13.3317 7.91288 13.3333C7.60432 13.333 7.29634 13.307 6.99206 13.2559C5.65316 13.0269 4.44913 12.3033 3.61865 11.2284C2.78816 10.1535 2.39183 8.80589 2.50821 7.45256C2.6246 6.09923 3.24519 4.839 4.247 3.9217C5.24881 3.0044 6.55872 2.49699 7.91705 2.50001C8.14603 2.50025 8.37481 2.51444 8.60206 2.54251C9.57298 2.66436 10.4927 3.04727 11.2632 3.65045C12.0337 4.25363 12.6262 5.05453 12.9776 5.9678C13.3289 6.88108 13.426 7.87254 13.2585 8.83663C13.091 9.80072 12.6651 10.7013 12.0262 11.4425L12.2604 11.6675H12.9179L16.4512 15.2175C16.575 15.3399 16.6595 15.4964 16.6941 15.6671C16.7286 15.8378 16.7115 16.0148 16.645 16.1757C16.5785 16.3366 16.4655 16.4741 16.3206 16.5706C16.1757 16.6671 16.0053 16.7182 15.8312 16.7175L15.8337 16.7142ZM7.91705 4.16668C7.17537 4.16668 6.45035 4.38662 5.83366 4.79867C5.21698 5.21073 4.73632 5.79639 4.45249 6.48162C4.16866 7.16684 4.09442 7.92083 4.23912 8.64826C4.38381 9.37569 4.74093 10.0439 5.26537 10.5683C5.78982 11.0928 6.45801 11.4499 7.18544 11.5946C7.91287 11.7393 8.66686 11.6651 9.35208 11.3812C10.0373 11.0974 10.623 10.6167 11.0351 10.0001C11.4471 9.38338 11.667 8.65836 11.667 7.91668C11.6659 6.92246 11.2705 5.96928 10.5675 5.26625C9.86448 4.56323 8.91127 4.16778 7.91705 4.16668Z" fill="#6B6B6B"></path>
							</svg>
						</label>
					</div>
					<div class="header_search-drop">
						<div class="header_search-drop_bg">
							<div class="container">
								<?php
								$product_tags = get_terms('product_tag', array(
									'orderby'    => 'name',
									'order'      => 'ASC',
									'number'     => 4,
								));
								if (!empty($product_tags) && !is_wp_error($product_tags)):
								?>
								<div class="header_search-drop_tags d-flex mb-1 align-items-center">
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
								<?php endif; ?>
								<h2 class="header_search-drop_title mb-3">Featured Products</h2>
								<div class="d-flex flex-wrap searched_products" id="searched-products-container">
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
										echo '<p>No featured products found!</p>';
									endif;
									?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="header_buttons col">
					<?php 
						$account = get_field('account_link', 'option');
						if($account):
					?>
					<a href="<?php echo $account; ?>" class="header_buttons-btn">
						<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M10 2C7.92893 2 6.25 3.67893 6.25 5.75C6.25 7.82107 7.92893 9.5 10 9.5C12.0711 9.5 13.75 7.82107 13.75 5.75C13.75 3.67893 12.0711 2 10 2ZM4.75 5.75C4.75 2.85051 7.10051 0.5 10 0.5C12.8995 0.5 15.25 2.85051 15.25 5.75C15.25 8.6495 12.8995 11 10 11C7.10051 11 4.75 8.6495 4.75 5.75Z" fill="#383838"></path>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M3.70305 14C3.18954 14 2.76992 14.2514 2.58222 14.6301C2.2222 15.3564 1.83551 16.3366 1.75456 17.2798C1.71857 17.6991 1.89323 18.0458 2.17861 18.223L1.78285 18.8601L2.17861 18.223C3.24831 18.8875 5.6789 20 10 20C14.3211 20 16.7517 18.8875 17.8214 18.223C18.1068 18.0458 18.2814 17.6991 18.2454 17.2798C18.1645 16.3366 17.7778 15.3564 17.4178 14.6301C17.2301 14.2514 16.8105 14 16.297 14H3.70305ZM1.23827 13.9639C1.71823 12.9956 2.7132 12.5 3.70305 12.5H16.297C17.2868 12.5 18.2818 12.9956 18.7617 13.9639C19.1543 14.7557 19.6354 15.9335 19.74 17.1515C19.8174 18.0533 19.4425 18.9819 18.6129 19.4972C17.2999 20.3128 14.5941 21.5 10 21.5C5.40591 21.5 2.70008 20.3128 1.38709 19.4972C0.557525 18.9819 0.182654 18.0533 0.260055 17.1515C0.364599 15.9335 0.845755 14.7557 1.23827 13.9639Z" fill="#383838"></path>
						</svg>
						<span>Sign in</span>
					</a>
					<?php endif; ?>
					<div class="header_buttons-cart">
						<?php echo do_shortcode('[fk_cart_menu]'); ?>
						<a href="#" class="header_buttons-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#cart-canvas" aria-controls="cart-canvas">
							<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 18.5C6.83579 18.5 6.5 18.8358 6.5 19.25C6.5 19.6642 6.83579 20 7.25 20C7.66421 20 8 19.6642 8 19.25C8 18.8358 7.66421 18.5 7.25 18.5ZM5 19.25C5 18.0074 6.00736 17 7.25 17C8.49264 17 9.5 18.0074 9.5 19.25C9.5 20.4926 8.49264 21.5 7.25 21.5C6.00736 21.5 5 20.4926 5 19.25Z" fill="#212223"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M17 18.5C16.5858 18.5 16.25 18.8358 16.25 19.25C16.25 19.6642 16.5858 20 17 20C17.4142 20 17.75 19.6642 17.75 19.25C17.75 18.8358 17.4142 18.5 17 18.5ZM14.75 19.25C14.75 18.0074 15.7574 17 17 17C18.2426 17 19.25 18.0074 19.25 19.25C19.25 20.4926 18.2426 21.5 17 21.5C15.7574 21.5 14.75 20.4926 14.75 19.25Z" fill="#212223"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M0.833932 0.62592C1.17858 0.396156 1.64423 0.489286 1.874 0.833932L3.15135 2.74996H19.2816C20.7081 2.74996 21.7746 4.06053 21.4846 5.45731L20.6814 9.32603C20.4819 10.2872 19.6823 11.008 18.7057 11.1072L6.02762 12.3944C6.61015 13.3714 7.67407 14 8.85479 14H18.5C18.9142 14 19.25 14.3357 19.25 14.75C19.25 15.1642 18.9142 15.5 18.5 15.5H8.85479C6.68409 15.5 4.78459 14.0406 4.22528 11.9432L2.0572 3.81291L0.62592 1.66598C0.396156 1.32134 0.489286 0.855684 0.833932 0.62592ZM3.72617 4.24996L5.50998 10.9392L18.5542 9.61484C18.8797 9.58179 19.1462 9.34151 19.2128 9.02113L20.0159 5.15241C20.1126 4.68682 19.7571 4.24996 19.2816 4.24996H3.72617Z" fill="#212223"></path>
							</svg>
							<span>My Cart</span>
							<span id="cart-count">0</span>
						</a>
						<div class="offcanvas offcanvas-end" tabindex="-1" id="cart-canvas" aria-labelledby="cart-canvas-label">
							<div class="offcanvas-header d-flex align-items-center">
								<a href="<?php echo wc_get_cart_url(); ?>" id="cart-canvas-label" class="button">Cart</a>
								<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body pt-0">
								<div id="offcanvas-cart-content" class="offcanvas-cart-content">
									<!-- Cart items will be loaded here via AJAX -->
								</div>
								<div class="offcanvas-cart-footer">
									<a href="<?php echo wc_get_checkout_url(); ?>" class="button click">Checkout</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End Cart -->
				</div>
			</div>

			<div class="d-flex justify-content-between align-items-center mt-4 header_lower">
				<nav class="header_nav col-8">
					<ul class="nav">
						<?php
							$pages = get_field('header_pages', 'option');
							if($pages):
								foreach($pages as $single):
						?>
									<li class="nav-item">
										<a class="nav-link" href="<?php echo $single['page']['url']; ?>" target="<?php echo $single['page']['target']; ?>"><?php echo $single['page']['title']; ?></a>
									</li>
						<?php 
								endforeach;
							endif; 
						?>
					</ul>
				</nav>
				<nav class="header_nav-2 col-4">
					<ul class="nav justify-content-end">
						<?php
							$pages_right = get_field('header_pages_right', 'option');
							if($pages_right):
								foreach($pages_right as $single):
						?>
									<li class="nav-item">
										<a class="nav-link" href="<?php echo $single['page']['url']; ?>" target="<?php echo $single['page']['target']; ?>"><?php echo $single['page']['title']; ?></a>
									</li>
						<?php 
								endforeach;
							endif; 
						?>
					</ul>
				</nav>
			</div>

			<div class="header_mobile">
				<div class="header_mobile-cart">
					<?php echo do_shortcode('[fk_cart_menu]'); ?>
				</div>

				<div class="header_mobile-search">
					<button class="header_mobile-cart_button" type="button" data-bs-toggle="offcanvas" data-bs-target="#search-drop" aria-controls="search-drop">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M10.875 3C6.52576 3 3 6.52576 3 10.875C3 15.2242 6.52576 18.75 10.875 18.75C13.0478 18.75 15.0139 17.871 16.4394 16.4475C17.8677 15.0212 18.75 13.0519 18.75 10.875C18.75 6.52576 15.2242 3 10.875 3ZM1.5 10.875C1.5 5.69733 5.69733 1.5 10.875 1.5C16.0527 1.5 20.25 5.69733 20.25 10.875C20.25 13.1956 19.4061 15.3202 18.0097 16.9569L22.2798 21.2192C22.573 21.5118 22.5734 21.9867 22.2808 22.2798C21.9882 22.573 21.5133 22.5734 21.2202 22.2808L16.9484 18.0169C15.3128 19.409 13.1916 20.25 10.875 20.25C5.69733 20.25 1.5 16.0527 1.5 10.875Z" fill="#212223"></path>
						</svg>
					</button>
					
					<div class="header_mobile-drop offcanvas offcanvas-top" data-bs-scroll="true" tabindex="-1" id="search-drop" aria-labelledby="search-drop-label">
						<div class="offcanvas-header header_mobile-drop_title">
							<div class="offcanvas-title" id="menu-drop-label">
								<?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); }; ?>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<div class="position-relative">
							<input id="search" class="header_mobile-search_drop-input w-100" type="search" placeholder="Search">
							<label for="search" class="header_search-label">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M15.8337 16.7142C15.7185 16.7146 15.6043 16.6922 15.4977 16.6483C15.3912 16.6044 15.2944 16.5398 15.2129 16.4583L11.667 12.9167V12.2583L11.442 12.025C10.4591 12.8677 9.20758 13.3317 7.91288 13.3333C7.60432 13.333 7.29634 13.307 6.99206 13.2559C5.65316 13.0269 4.44913 12.3033 3.61865 11.2284C2.78816 10.1535 2.39183 8.80589 2.50821 7.45256C2.6246 6.09923 3.24519 4.839 4.247 3.9217C5.24881 3.0044 6.55872 2.49699 7.91705 2.50001C8.14603 2.50025 8.37481 2.51444 8.60206 2.54251C9.57298 2.66436 10.4927 3.04727 11.2632 3.65045C12.0337 4.25363 12.6262 5.05453 12.9776 5.9678C13.3289 6.88108 13.426 7.87254 13.2585 8.83663C13.091 9.80072 12.6651 10.7013 12.0262 11.4425L12.2604 11.6675H12.9179L16.4512 15.2175C16.575 15.3399 16.6595 15.4964 16.6941 15.6671C16.7286 15.8378 16.7115 16.0148 16.645 16.1757C16.5785 16.3366 16.4655 16.4741 16.3206 16.5706C16.1757 16.6671 16.0053 16.7182 15.8312 16.7175L15.8337 16.7142ZM7.91705 4.16668C7.17537 4.16668 6.45035 4.38662 5.83366 4.79867C5.21698 5.21073 4.73632 5.79639 4.45249 6.48162C4.16866 7.16684 4.09442 7.92083 4.23912 8.64826C4.38381 9.37569 4.74093 10.0439 5.26537 10.5683C5.78982 11.0928 6.45801 11.4499 7.18544 11.5946C7.91287 11.7393 8.66686 11.6651 9.35208 11.3812C10.0373 11.0974 10.623 10.6167 11.0351 10.0001C11.4471 9.38338 11.667 8.65836 11.667 7.91668C11.6659 6.92246 11.2705 5.96928 10.5675 5.26625C9.86448 4.56323 8.91127 4.16778 7.91705 4.16668Z" fill="#6B6B6B"></path>
								</svg>
							</label>
						</div>
						<div class="container">
							<?php
							$product_tags = get_terms('product_tag', array(
								'orderby'    => 'name',
								'order'      => 'ASC',
								'number'     => 4,
							));
							if (!empty($product_tags) && !is_wp_error($product_tags)):
							?>
							<div class="header_search-drop_tags d-flex mb-1 align-items-center">
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
							<?php endif; ?>
							<h2 class="header_search-drop_title mb-3">Featured Products</h2>
							<div class="d-flex flex-wrap searched_products" id="searched-products-container">
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
									echo '<p>No featured products found!</p>';
								endif;
								?>
							</div>
						</div>
					</div>
				</div>

				<div class="header_mobile-menu">
					<button class="header_mobile-cart_button" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu-drop" aria-controls="menu-drop">
						<svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path id="Vector" d="M12 17H19M5 12H19M5 7H19" stroke="#000000" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>

					<div class="header_mobile-drop offcanvas offcanvas-top" data-bs-scroll="true" tabindex="-1" id="menu-drop" aria-labelledby="menu-drop-label">
						<div class="offcanvas-header header_mobile-drop_title">
							<div class="offcanvas-title" id="menu-drop-label">
								<?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); }; ?>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>

						<div class="header_mobile-account d-flex justify-content-between">
							<div class="header_mobile-account_text">
								<span>Account</span>
							</div>
							<a href="https://zenamino.com/account/" class="header_mobile-account_button">Sign In</a>
						</div>
						<?php
							$mobile_toggler = get_field('mobile_toggler', 'option');
							if($mobile_toggler):
								foreach($mobile_toggler as $single):
									$links = $single['links'];
						?>
									<div class="header_mobile-buy">
										<button class="header_mobile-buy_peptides w-100 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#buy_peptides-1" aria-expanded="false" aria-controls="buy_peptides-1">
											<span>Buy Peptides</span>
										</button>
										<div class="collapse header_mobile-buy_drop" id="buy_peptides-1">
											<ul class="u-list">
						<?php
												foreach($links as $i => $link):
													echo '<li class="u-list-item"><a href="'. $link['link']['url'] .'" target="'. $link['link']['target'] .'">'. $link['link']['title'] .'</a></li>';
												endforeach;
						?>
											</ul>
										</div>
									</div>
						<?php
								endforeach;
							endif;

							$mobile_header = get_field('mobile_header', 'option');
							if($mobile_header):
								foreach($mobile_header as $single):
									echo '<a href="'. $single['link']['url'] .'" target="'. $single['link']['target'] .'" class="header_mobile-page">'. $single['link']['title'] .'</a>';
								endforeach;
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</header>
<!-- <?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?> -->