<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $service, $post;
$service = new Opalservice_Service( get_the_ID() );
$categories = $service->getCategoryTax();
$imgresizes = "";

if($image_size == 'other'){
	$imgtemp = explode('x', $other_size);
	$imgresizes = array((int)$imgtemp[0],(int)$imgtemp[1]);
}else{
	$imgresizes = $image_size;
}


?>
<div itemscope itemtype="http://schema.org/Service" <?php post_class(); ?>>
	<?php do_action( 'opalservice_before_service_loop_item' ); ?>
	<?php if($show_thumbnail) : ?>
	<header>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="service-box-image">
		        <a href="<?php the_permalink(); ?>" class="service-box-image-inner ">	
		         	<?php the_post_thumbnail( $imgresizes ); ?>
		        </a>
			</div>
		<?php endif; ?>
	</header>
   <?php endif; ?>
	<div class="entry-content-carousel">
		<?php the_title( '<h4 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
		<?php if($show_category): ?>
	     <div class="service-categories info">
	     <?php foreach( $categories as $categorie ) :
	     			$namect = $categorie->name.'/';
		     		if ($categorie === end($categories) || count($categories) == 1){
		     			$namect = $categorie->name;
		     		}?>
		     	<a href="<?php echo get_term_link($categorie->term_id, 'opalservice_category_service');?>" class="categories-link"><span><?php echo $namect ?></span> </a>
			<?php endforeach; ?>
	     </div>
		<?php endif; ?>
		<?php if($show_description): ?>
			<div class="service-description-carousel">
				<?php echo opalservice_fnc_excerpt($max_char,'...'); ?>
			</div>
		<?php endif?>
		<?php if($show_readmore): ?>
		<div class="service-learnmore">
			<a href="<?php echo esc_url( get_permalink() );?>">Read More <i class="text-primary fa fa-arrow-circle-o-right"></i> </a>
		</div>
		<?php endif?>
	</div><!-- .entry-content -->
<?php do_action( 'opalservice_after_service_loop_item' ); ?>
<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div><!-- #post-## -->
