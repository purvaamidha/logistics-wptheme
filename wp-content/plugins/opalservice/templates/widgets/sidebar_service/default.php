<?php 
$limit  	= isset($num) ? $num : 4;
$parent_id = get_the_ID();
$post_ids = Opalservice_Query::getServiceId(get_the_ID());
$currentids =  array_merge(array(get_the_ID()),$post_ids);

$array 	= array(
			'posts_per_page' 	=> $limit,
			'post__in'			=> $currentids, 
			'orderby' 			=> 'post__in'
			);
$services = Opalservice_Query::getServiceQuery($array);
?>
<div class="opalservice-categories widget">
	<?php if(!empty($title)): ?>
	<h3 class="widget-title"><span><span><?php esc_html_e("Categories"); ?></span></span></h3>
	<?php endif; ?>

	<ul class="sidebar-service">
		<?php if( $services->have_posts() ): ?>
			<?php while($services->have_posts()) : $services->the_post() ?>
				<li class="cat-item <?php if($parent_id == get_the_ID()) { echo "active" ; }?>"> 
					<a href="<?php the_permalink(); ?>" class="service-link"><span><?php the_title(); ?></span></a>
				</li> 
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		
	</ul>
</div>
