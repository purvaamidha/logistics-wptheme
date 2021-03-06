<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */
$link_url =  get_post_meta( get_the_ID(),'wpopal_themer_link_link', true );
$link_text =  get_post_meta( get_the_ID(),'wpopal_themer_link_text', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php


			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif;
		?>

		<div class="entry-meta">
					
            <div class="entry-category pull-left">
                <?php the_category(' - '); ?>
            </div>
            <span class="meta-sep"></span>
			<span class="entry-date">
                <span><?php the_time( 'd M Y' ); ?></span>
            </span>
            <span class="meta-sep"></span>
            <span class="author"><?php esc_html_e('by ', 'jets'); the_author_posts_link(); ?></span>
			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
			<span class="meta-sep"></span>
			<span class="comments-link"><?php comments_popup_link( esc_html__( '0 comment', 'jets' ), esc_html__( '1 Comment', 'jets' ), esc_html__( '% Comments', 'jets' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( esc_html__( 'Edit', 'jets' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<div class="post-preview">
		<?php if( empty($link_url) ) : ?>
		<?php jets_fnc_post_thumbnail(); ?>
		<?php else : ?>
		<a class="post-link" href="<?php echo esc_url( $link_url ) ?>" title="<?php echo esc_url( $link_text ) ?>">
			<?php echo esc_url( $link_url ) ?>
		</a>
		<?php endif; ?>

		<span class="post-format">
			<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><i class="fa fa-link"></i></a>
		</span>
	</div>

	

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			if(is_single()){
				the_content( sprintf(
					esc_html__( 'Continue reading %s', 'jets').'<span class="meta-nav">&rarr;</span>',
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );
			}else{
				the_excerpt();
			}

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jets' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
