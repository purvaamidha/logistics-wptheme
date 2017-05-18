<?php
$orderby = isset($order_by) ? $order_by : 'ID';
$order = isset($order_list) ? $order_list : 'ASC';

$tax_term = $show_date = $order = $main_color = $class = $blog_style = '';
$columns = 4;
$items =  12; 
$atts['post_type'] = 'post';
$atts['taxonomy'] = 'category';

$posts = get_posts( $atts );
$blog_style  = '';

extract( $atts );



$class       = $custom_class = '';
$css_class   = array( 'kc-post-layout-1');

array_push( $css_class, $custom_class );

if( isset( $class ) )
	array_push( $css_class, $class );

 
ob_start();

$col = floor(12/$columns);
$_count = 0;
 
 
$args = array(
	'paged' => 1,
	'posts_per_page' =>  $items,
	'post_status' => 'publish',
	'orderby'        	=> $orderby,
	'order' 			=> $order,
);
$loop = new WP_Query($args);

$class = '';
$last = '';

if($blog_style == 'bloglist'){
	$class = 'blog-item';
}elseif($blog_style == 'blog'){
	$class = 'blog-item col-lg-'.$col.' col-md-'.$col.' col-sm-'.$col.' col-xs-12';
}
?>
<div class="blog-post">
	
	<?php if($blog_style == 'blogcarousel') { $css_class[] = 'owl-carousel'; ?>
	<div class="<?php echo esc_attr($blog_style); ?>-layout <?php echo esc_attr( implode( ' ', $css_class ) ) ;?>" data-owl-options='{"items" : <?php echo esc_attr( $columns ); ?>, "tablet" : 2, "mobile" : 1, "navigation": "yes"}'>
	<?php }else{ ?>
		<div class="<?php echo esc_attr($blog_style); ?>-layout <?php echo esc_attr( implode( ' ', $css_class ) ) ;?>" >
	<?php } ?>

		 <?php  // wpopal_themer_get_template_part(); ?>
		 	<?php if ( $loop->have_posts() ) : ?>
		 	<?php
					// Start the Loop.
					while ( $loop->have_posts()  ) : $loop->the_post();
						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						?>
						<?php if($blog_style != 'blogcarousel'): ?>
							<?php if($blog_style == 'blog' && $_count%$columns==0): ?>
								<?php $first = ' first'?>
							<?php else: $first = ''; ?>
							<?php endif;?>
							<div class="<?php echo esc_attr($class).' '.esc_attr($first);?>">
						<?php endif; ?>

							<?php wpopal_themer_get_template_part( 'content', $blog_style  ); ?>

						<?php if($blog_style != 'blogcarousel'): ?>
							</div>
						<?php endif; ?>
					<?php
						$_count++;
					endwhile;
					 

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
	</div>	
</div>
<?php
$output = ob_get_clean();

echo trim( $output );

wp_reset_postdata();