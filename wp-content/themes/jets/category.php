<?php
/**
 * The template for displaying Category pages
 *
 * @link http://www.wpopal.com/theme/jets/
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */

$jets_page_layouts = apply_filters( 'jets_fnc_get_category_sidebar_configs', null ); 
$columns = jets_fnc_theme_options( 'blog-archive-column', 1 );
$bscol = floor( 12 / $columns );
$_count  = 0;

get_header( apply_filters( 'jets_fnc_get_header_layout', null ) ); ?>
<?php do_action( 'jets_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('jets_template_main_container_class','container');?> inner <?php echo jets_fnc_theme_options('blog-archive-layout') ; ?>">
	<div class="row">

		<?php if( isset($jets_page_layouts['sidebars']) && !empty($jets_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		
		<div id="main-content" class="main-content col-sm-12 <?php echo esc_attr($jets_page_layouts['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					<?php if ( have_posts() ) : ?>

					<header class="archive-header">
						<h1 class="archive-title"><?php printf( esc_html__( 'Category Archives: %s', 'jets' ), single_cat_title( '', false ) ); ?></h1>

						<?php
							// Show an optional term description.
							$term_description = term_description();
							if ( ! empty( $term_description ) ) :
								printf( '<div class="taxonomy-description">%s</div>', $term_description );
							endif;
						?>
					</header><!-- .archive-header -->

					<?php
							// Start the Loop.
							while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							?>
								<?php if($_count%$columns==0): ?>
									<div class="row">
								<?php endif;?>
									<div class="col-sm-<?php echo esc_attr($bscol); ?>">
										<?php get_template_part( 'content', get_post_format() ); ?>
									</div>
								<?php if($_count%$columns==$columns-1 || $_count == $wp_query->post_count -1): ?>
									</div>
								<?php endif;?>
							<?php
							$_count++;
							endwhile;
							// Previous/next page navigation.
							jets_fnc_paging_nav();

						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );

						endif;
					?>

				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->

 
 
	</div>	
</section>
<?php
get_footer();