<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */
/*
*Template Name: 404 Page
*/

get_header( apply_filters( 'jets_fnc_get_header_layout', null ) ); ?>

<?php do_action( 'jets_template_main_before' ); ?>
<section id="main-container" class="notfound-page">
	<div class="<?php echo apply_filters('jets_template_main_container_class','container');?> inner clearfix ">
		<div class="row">
			<div id="main-content" class="main-content col-lg-12">
				<div id="primary" class="content-area">
					<div id="content" class="site-content col-md-7 col-sm-12 col-xs-12" role="main">
						<h1 class="title"><?php esc_html_e( '404', 'jets' ); ?></h1>
						<div class="sub"><?php esc_html_e( 'Oop, that link is broken.', 'jets' ); ?></div>
						<div class="error-description">
							<p><?php esc_html_e( 'Page doesn\'t exist or some other error occured. Go to our', 'jets' ); ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home page', 'jets'); ?></a>
								<?php esc_html_e( ' or go back to ', 'jets' ); ?>
								<a href="javascript: history.go(-1)"><?php esc_html_e('Previous page', 'jets'); ?></a>
							</p>
						</div>

				</div><!-- #content -->
				</div><!-- #primary -->
				<?php get_sidebar( 'content' ); ?>
			</div><!-- #main-content -->

			 
			<?php get_sidebar(); ?>
		 
		</div>	
	</div>
</section>
<?php

get_footer();

 