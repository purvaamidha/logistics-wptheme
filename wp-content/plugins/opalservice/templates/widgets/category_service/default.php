<?php 
$limit  	= isset($num) ? $num : 4;
$categories = Opalservice_Query::getCategoryServices($limit);
?>
<div class="opalservice-categories widget">
	<h3 class="widget-title"><span><span><?php esc_html_e("Categories"); ?></span></span></h3>
	<?php if($categories): ?>
	<ul class="service-categories">
		<?php foreach( $categories as $categorie ) :
			//echo get_the_ID();
			$checkactive = Opalservice_Query::check_active_category_by_post_id($categorie->term_id,get_the_ID());
			if ($checkactive): ?>
				<li class="cat-item <?php echo "active" ;?>"> 
					<a href="<?php echo get_term_link($categorie->term_id, 'opalservice_category_service');?>" class="categories-link"><span><?php echo $categorie->name ?></span></a>
				</li> 
			<?php else: ?>
				<li class="cat-item"> 
					<a href="<?php echo get_term_link($categorie->term_id, 'opalservice_category_service');?>" class="categories-link"><span><?php echo $categorie->name ?></span></a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</div>