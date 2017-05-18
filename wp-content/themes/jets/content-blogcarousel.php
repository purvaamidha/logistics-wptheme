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
 	<div class="post-preview">
		<?php jets_fnc_post_thumbnail(); ?>
		<span class="post-format">
			<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><i class="fa fa-picture-o"></i></a>
		</span>
		<div class="post-meta">
			<span class="date-post"><?php the_time( 'd' ); ?></span>
			<span class="month-post"><?php the_time( 'M' ); ?></span>					
		</div><!-- .entry-meta -->
	</div>
	<div class="entry-content">
		<header class="entry-header">
			<div class="entry-meta">
				
	            <div class="entry-category pull-left">
	                <?php the_category(' - '); ?>
	            </div>
				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
				<span class="meta-sep"></span>
				<span class="comments-link"><?php comments_popup_link( esc_html__( '0 comment', 'jets' ), esc_html__( '1 Comment', 'jets' ), esc_html__( '% Comments', 'jets' ) ); ?></span>
				<?php endif; ?>

				<?php edit_post_link( esc_html__( 'Edit', 'jets' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
			<?php
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			?>
		</header><!-- .entry-header -->		
	</div><!-- .entry-content -->
</article><!-- #post-## -->
