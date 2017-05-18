<?php
/**
 * The Template for displaying all single posts
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */

$jets_page_layouts = apply_filters( 'jets_fnc_get_single_sidebar_configs', null );

get_header( apply_filters( 'jets_fnc_get_header_layout', null ) );

?>
<?php do_action( 'jets_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters( 'jets_template_main_content_class',  'container' ); ?>">
	<div class="row">
		<?php if( isset($jets_page_layouts['sidebars']) && !empty($jets_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		<div id="main-content" class="main-content col-sm-12 <?php echo esc_attr($jets_page_layouts['main']['class']); ?>">

			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();
							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );

							if( jets_fnc_theme_options('blog-show-share-post', true) ){
								get_template_part( 'page-templates/parts/sharebox' );
							}

							// Previous/next post navigation.
							jets_fnc_post_nav();

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}

							if( jets_fnc_theme_options('blog-show-related-post', true) ): ?>
							<div class="related-posts">
								<?php
				                   
				                    jets_fnc_related_post( 3 , 'post', 'category');
			                    ?>
			                   </div>  
			                <?php endif; ?>
			                <?php

						endwhile;
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	

	</div>	
</section>
<?php
get_footer();
