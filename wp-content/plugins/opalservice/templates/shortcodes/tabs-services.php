<?php 

$categorys = explode(',', $category);
$id = rand(time(),888);
if( class_exists("Opalservice_Query") ):
$query = Opalservice_Query::get_service_by_term_slug( $categorys, $limit ); 
$args_template = array(
					'show_readmore'		=>$show_readmore,
					'max_char'			=>$max_char,
					'image_size'		=>$image_size,
					'other_size'		=>$other_size,
					'query'				=>$query,
					'layout'			=>$layout,
					'title'				=>$title,
					);
?>
<div class="widget widget-service">
	<div class="opalservice-recent-service opalservice-rows service-tabs service-<?php echo $layout; ?> service-<?php echo $style; ?>">
		
		<?php if( $query->have_posts() ): ?> 
			<?php if($layout == "tabs_v1"): ?>
			<div class="row">
			<div class="col-md-6 col-sm-12 block-left"> <!-- required for floating -->
			<?php endif; ?>
			    <!-- Nav tabs -->
			    <ul class="nav nav-tabs <?php if($layout == "tabs_v1"){ ?> <?php } ?>">
			    <?php $i = 0; while ( $query->have_posts() ) : $query->the_post(); 
			    $service = new Opalservice_Service( get_the_ID() );
			    $icon = $service->getIcon();
				$iconpicker = $service->getIconPicker();
			    ?>
			
			      <li class="<?php if ( $i == 0 ){ echo "active"; } ?> ">
			      	<a href="#service-<?php echo get_the_ID().$id; ?>" data-toggle="tab"> 
				      	<?php if(!empty($icon)): ?>
				         	<img src="<?php echo $icon; ?>" alt="icon"><span><?php echo opalservice_fnc_title(3);?></span>
					    <?php else: ?>
					        <i class="<?php echo $iconpicker; ?>"></i><span><?php echo opalservice_fnc_title(3);?></span>
					    <?php endif; ?>
			      	</a>
			      </li>
			    <?php $i++; endwhile; ?>
			    </ul>
			<?php if($layout == "tabs_v1"): ?>
			</div>
			<?php endif; ?>
			<?php if($layout == "tabs_v1"): ?>
			<div class="col-md-6 col-sm-12 block-right">
			<?php endif; ?>
			    <!-- Tab panes -->
			    <div class="tab-content">
			    <?php $i = 0; while ( $query->have_posts() ) : $query->the_post(); ?>
			      	<div class="tab-pane <?php if ( $i == 0 ){ echo "active"; } ?>" id="service-<?php echo get_the_ID().$id; ?>">
			      		<?php echo Opalservice_Template_Loader::get_template_part( 'content-service-tabs',$args_template ); ?>
			      	</div>
			     <?php $i++; endwhile; ?>
			    </div>
			<?php if($layout == "tabs_v1"): ?>
			</div>
			</div>
			<?php endif; ?>
		<?php endif; //have_posts?>
		
	</div>	
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>