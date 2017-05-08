<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="col-lg-4 col-md-4 col-sm-6 no-padding">
	<?php jets_fnc_post_thumbnail(); ?>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-6">
		<header class="entry-header">
			
			<div class="entry-meta">
				
	            <div class="entry-category pull-left">
	                <?php the_category(' - '); ?>
	            </div>
	            <span class="meta-sep"></span>
				<span class="entry-date">
	                <span><?php the_time( 'd M Y' ); ?></span>
	            </span>
				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
				<span class="meta-sep"></span>
				<span class="comments-link"><?php comments_popup_link( esc_html__( '0 comment', 'jets' ), esc_html__( '1 Comment', 'jets' ), esc_html__( '% Comments', 'jets' ) ); ?></span>
				<?php endif; ?>
			</div><!-- .entry-meta -->
			<?php
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			?>
		</header><!-- .entry-header -->			
	</div>
</article><!-- #post-## -->
