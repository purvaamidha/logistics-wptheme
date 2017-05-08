<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $service, $post; 
$service = new Opalservice_Service( get_the_ID() );
$show_readmore_option = opalservice_get_option('service_show_readmore');
$show_readmore_option = ($show_readmore_option == true) ? $show_readmore_option : 0;
$show_readmore = isset($show_readmore) ? $show_readmore : $show_readmore_option; // check exists kingc
//---
$max_char_option = opalservice_get_option('service_max_char');
$max_char_option = ($max_char_option == true) ? $max_char_option : 15;
$max_char = isset($max_char) ? $max_char : $max_char_option;// check exists kingc

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

$icon = $service->getIcon();
$layout = isset($layout) ? $layout : "";
$col  = ($layout =="tabs_v2") ? "6" : "12";
?> 
<div class="service-content">
	<?php do_action( 'opalservice_before_service_loop_item' ); ?>
	<div class="row">
		<?php if($layout == "tabs_v2"): ?>
			<div class="col-md-6">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="service-box-image">
			        <a href="<?php the_permalink(); ?>" class="service-box-image-inner ">	
			         	<?php the_post_thumbnail( $imgresizes ); ?>
			        </a>
				</div>
			<?php endif; ?>
			</div>
		<?php endif; //end layout ?>

		<div class="col-md-<?php echo $col; ?> service-box">
			<?php if(!empty($title)){ ?>		      			
				<div class="service-subtitle ">
				<?php echo trim($title); ?>
				</div>
			<?php } ?>
			<?php the_title( '<h3 class="service-title">','</h3>'); ?> 
			<div class="service-description">
				<?php echo opalservice_fnc_excerpt($max_char,'...'); ?>
			</div>
			<?php if($show_readmore): ?>
				<div class="service-readmore">
					<a class="btn btn-primary" href="<?php echo esc_url( get_permalink() );?>"><?php esc_html_e('Read More','opalservice'); ?> <i class="fa-fw fa fa-long-arrow-right" aria-hidden="true"></i> </a>
				</div>
			<?php endif?>
		</div>
	</div>
	
	<?php do_action( 'opalservice_after_service_loop_item' ); ?>	
</div>
