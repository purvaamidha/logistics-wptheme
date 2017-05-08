<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if( !(jets_fnc_theme_options('wc_show_related', false)) ){
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

		global $product, $woocommerce_loop;
		$posts_per_page = jets_fnc_theme_options('woo-number-product-single',6);

		if ( empty( $product ) || ! $product->exists() ) {
			return;
		}

		$related = wc_get_related_products( $product->get_id() );
		if ( sizeof( $related ) == 0 ) return;
		
		$args = apply_filters( 'woocommerce_related_products_args', array(
			'post_type'            => 'product',
			'ignore_sticky_posts'  => 1,
			'no_found_rows'        => 1,
			'posts_per_page'       => $posts_per_page,
			'orderby'              => $orderby,
			'post__in'             => $related,
			'post__not_in'         => array( $product->get_id() )
		) );
		
		$_count =1;
		$products = new WP_Query( $args );

		$columns_count = jets_fnc_theme_options('product-number-columns',3);
		$class_column = 'col-md-' . floor( 12/$columns_count );
		$style= '';
		if(jets_fnc_theme_options('wc_show_background_related')){
			$style = 'style="background-image: url('.esc_url_raw( jets_fnc_theme_options('wc_show_background_related') ).');"';
		}
		$_id = rand();
		if ( $products->have_posts() ) : ?>

			<div class="widget products-collection woocommerce" id="postcarousel-<?php echo esc_attr($_id); ?>" data-ride="carousel">
				<div class="background" <?php echo trim($style); ?>>
					<div class="mask"></div>
					<h3 class="widget-title">
				        <span><?php esc_html_e( 'Related Products', 'jets' ); ?></span>
					</h3>
					<div class="woocommerce">
						<div class="widget-content owl-carousel-play <?php echo isset($style) ? esc_attr( $style ): ''; ?>">
						    <?php   if( $products->post_count > $columns_count ) { ?>
							<div class="carousel-controls carousel-controls-v1 carousel-hidden">
								<a href="#postcarousel-<?php echo esc_attr($_id); ?>" data-slide="prev" class="left carousel-control">
									<span class="fa fa-angle-left"></span>
								</a>
								<a href="#postcarousel-<?php echo esc_attr($_id); ?>" data-slide="next" class="right carousel-control">
									<span class="fa fa-angle-right"></span>
								</a>
							</div>
							<?php } ?>

						    <div class="owl-carousel " data-slide="<?php echo esc_attr($columns_count); ?>"  data-singleItem="true" data-navigation="false" data-pagination="false">
								<?php while ( $products->have_posts() ) : $products->the_post();  ?>
										<div class="product-carousel-item">	<?php wc_get_template_part( 'content', 'product-inner' ); ?></div>
								<?php endwhile; ?>
							</div>

						</div>
					</div>
				</div>
			</div>

		<?php endif;

		wp_reset_postdata();
	}
