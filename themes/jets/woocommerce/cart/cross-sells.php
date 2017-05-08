<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );
$_id = rand();
$columns_count = 3; 
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>

	<div class="cross-sells">

		<h2><?php esc_html_e( 'You may be interested in&hellip;', 'jets' ) ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			
		<div class="widget products-collection owl-carousel-play woocommerce" id="postcarousel-<?php echo esc_attr($_id); ?>" data-ride="carousel">
			<div class="woocommerce">
				<div class="widget-content <?php echo isset($style) ? esc_attr( $style ): ''; ?>">
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
	<?php woocommerce_product_loop_end(); ?>
</div>
<?php endif;
wp_reset_postdata();
