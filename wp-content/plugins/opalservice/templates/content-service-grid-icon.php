<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $service, $post; 
$service = new Opalservice_Service( get_the_ID() );
$categories = $service->getCategoryTax();
//---
$show_thumbnail_option = opalservice_get_option('service_show_thumbnail');
$show_thumbnail_option = ($show_thumbnail_option == true) ? $show_thumbnail_option : 1;
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
$show_readmore_option = opalservice_get_option('service_show_readmore');
$show_readmore_option = ($show_readmore_option == true) ? $show_readmore_option : 0;
$show_readmore = isset($show_readmore) ? $show_readmore : $show_readmore_option; // check exists kingc
//---
$max_char_option = opalservice_get_option('service_max_char');
$max_char_option = ($max_char_option == true) ? $max_char_option : 15;
$max_char = isset($max_char) ? $max_char : $max_char_option;// check exists kingc
//---
$show_number_option = opalservice_get_option('service_show_number');
$show_number_option = ($show_number_option == true) ? $show_number_option : 0;
$show_number = isset($show_number) ? $show_number : $show_number_option; // check exists kingc
//---
$image_size_option = opalservice_get_option('service_image_size');
$image_size_option = ($image_size_option == true) ? $image_size_option :'large';
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

if ($number <= 9) {
	$number = "0".$number;
}
$icon = $service->getIcon();
$iconpicker = $service->getIconPicker();

$layout = isset($layout) ? $layout : "";
?> 
<article itemscope itemtype="http://schema.org/Service" <?php post_class('page'); ?>>
	<?php do_action( 'opalservice_before_service_loop_item' ); ?>
	<?php if($show_number): ?>
		<div class="service-number">
			<?php echo $number.'.'; ?>
		</div>
 	<?php endif; ?>
 	<div class="service-wrapper">
		<header>			
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="service-box-image">
			        <a href="<?php the_permalink(); ?>" class="service-box-image-inner ">	
			         	
			         	<?php the_post_thumbnail($imgresizes); ?>
			        </a>
				</div>
			<?php endif; ?>
		</header>
	 
		<div class="entry-content">
			<?php if ( $layout == "grid_v3" || !empty($icon) || !empty($iconpicker)) : ?>
				<div class="service-box-icon">
				<?php if(!empty($icon)): ?>
			        <a href="<?php the_permalink(); ?>" class="service-box-icon-inner ">	
			         	<img src="<?php echo $icon; ?>" alt="icon">
			        </a>
			    <?php else: ?>
			        <i class="<?php echo $iconpicker; ?>"></i>
			    <?php endif; ?>
				</div>
			<?php endif; ?>
			<?php the_title( '<h4 class=""><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
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
			<div class="service-content">
			<?php if($show_description): ?>
				<div class="service-description">
					<?php echo opalservice_fnc_excerpt($max_char,'...'); ?>
				</div>
			<?php endif?>
			<?php if($show_readmore): ?>
			<div class="service-readmore">
				<a href="<?php echo esc_url( get_permalink() );?>">Read More <i class="text-primary fa fa-arrow-circle-o-right"></i> </a>
			</div>
			<?php endif?>
			</div>
		</div><!-- .entry-content -->
	</div>
	<?php do_action( 'opalservice_after_service_loop_item' ); ?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</article><!-- #post-## -->
