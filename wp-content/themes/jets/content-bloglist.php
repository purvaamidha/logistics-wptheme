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
<?php if( !is_single()): ?>
<div class="posts-wrapper clearfix">
<?php endif; ?>		
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
		<?php if(is_single()): ?>	
		<div class="entry-single">
		<?php endif; ?>	
		<?php if( !is_single()): ?>	
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
		<?php endif; ?>	
		<div class="entry-content">
			<header class="entry-header">
				<div class="entry-meta">
					
		            <div class="entry-category pull-left">
		                <?php the_category(' - '); ?>
		            </div>
		            <span class="meta-sep"></span>
		            <span class="author"><?php esc_html_e('by ', 'jets'); the_author_posts_link(); ?></span>
					<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<span class="meta-sep"></span>
					<span class="comments-link"><?php comments_popup_link( esc_html__( '0 comment', 'jets' ), esc_html__( '1 Comment', 'jets' ), esc_html__( '% Comments', 'jets' ) ); ?></span>
					<?php endif; ?>

					<?php edit_post_link( esc_html__( 'Edit', 'jets' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-meta -->
				<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					endif;
				?>
			</header><!-- .entry-header -->
			<?php if(is_single()): ?>	
			 	<div class="post-preview">
					<?php jets_fnc_post_thumbnail(); ?>
					<span class="post-format">
						<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><i class="fa fa-picture-o"></i></a>
					</span>
				</div>
			<?php endif; ?>	

			
				<?php
					/* translators: %s: Name of current post */
					if(is_single()){
						the_content( sprintf(
							esc_html__( 'Continue reading %s', 'jets').'<span class="meta-nav">&rarr;</span>',
							the_title( '<span class="screen-reader-text">', '</span>', false )
						) );
					}else{
						echo substr(get_the_excerpt(), 0,200);
					}

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jets' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
			<?php if(is_single()): ?>
				<footer class="entry-footer clearfix">
					<?php the_tags( '<div class="tag-links pull-left">', '', '</div>' ); ?>		
					<div class="pull-right">
						<?php if( jets_fnc_theme_options('blog-show-share-post', true) ){
							get_template_part( 'page-templates/parts/sharebox' );
						} ?>
					</div>			
				</footer>
			<?php endif; ?>
			<?php if(is_single()): ?>	
				</div>
			<?php endif; ?>	
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
<?php if( !is_single()): ?>
</div>
<?php endif; ?>	
