<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $service, $post; 
$service = new Opalservice_Service( get_the_ID() );
$categories = $service->getCategoryTax();
//---------------------------------------
$show_thumbnail_option = opalservice_get_option('service_show_thumbnail');
$show_thumbnail_option = ($show_thumbnail_option == true) ? $show_thumbnail_option : 0;
$show_thumbnail = isset($show_thumbnail) ? $show_thumbnail : $show_thumbnail_option; // check exists kingc
//---
$show_category_option = opalservice_get_option('service_show_category');
$show_category_option = ($show_category_option == true) ? $show_category_option : 0;
$show_category = isset($show_category) ? $show_category : $show_category_option; // check exists kingc
//---
$show_description_option = opalservice_get_option('service_show_description');
$show_description_option = ($show_description_option == true) ? $show_description_option : 0;
$show_description = isset($show_description) ? $show_description : $show_description_option; // check exists kingc
//---
$show_learnmore_option = opalservice_get_option('service_show_learnmore');
$show_learnmore_option = ($show_learnmore_option == true) ? $show_learnmore_option : 0;
$show_learnmore = isset($show_learnmore) ? $show_learnmore : $show_learnmore_option; // check exists kingc
//---
$max_char_option = opalservice_get_option('service_max_char');
$max_char_option = ($max_char_option == true) ? $max_char_option : 50;
$max_char = isset($max_char) ? $max_char : $max_char_option;// check exists kingc
//---
$image_size_option = opalservice_get_option('service_image_size');
$image_size_option = ($image_size_option == true) ? $image_size_option :'medium';
$image_size = isset($image_size) ? $image_size : $image_size_option;// check exists kingc

$other_size_option = opalservice_get_option('service_other_size');
$other_size_option = ($other_size_option == true) ? $other_size_option :'279x230';
$other_size = isset($other_size) ? $other_size : $other_size_option;// check exists kingc

$imgresizes = "";
if($image_size == 'other'){
	$imgtemp = explode('x', $other_size);
	$imgresizes = array((int)$imgtemp[0],(int)$imgtemp[1]);
}else{
	$imgresizes = $image_size;
}

?>
<article itemscope itemtype="http://schema.org/Doctor" <?php post_class(); ?>>
	<?php do_action( 'opalservice_before_service_loop_item' ); ?>
	<div class="service-list row">
		<div class="service-left col-lg-4">
			<?php if($show_thumbnail) : ?>	
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="service-box-image">
						<a href="<?php the_permalink(); ?>" class="service-box-image-inner ">
							<?php the_post_thumbnail( $imgresizes ); ?>
						</a>
					</div>
				<?php endif; ?>
			<?php endif; ?>

		</div> <!--/.col-lg-4 left-->
		<div class="service-right col-lg-8">
			<div class="entry-content">
				<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
				<?php if($show_category): ?>
			     <div class="service-categories">
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
				<div class="service-description">
					<?php echo opalservice_fnc_description($max_char,'...'); ?>
				</div>
			<?php endif?>
			<hr>
			<?php if($show_learnmore): ?>
			<div class="service-learnmore">
				<a href="<?php echo esc_url( get_permalink() );?>">Learn More  </a>
			</div>
			<?php endif?>
			</div><!-- .entry-content -->
		</div> <!--/.col-lg-8 right-->
	</div> <!--/.row chef-list-->
<?php do_action( 'opalservice_after_service_loop_item' ); ?>
<meta itemprop="url" content="<?php the_permalink(); ?>" />
</article><!-- #post-## -->
