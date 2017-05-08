<?php
	$location =  jets_fnc_theme_options('location', 'New York, USA');
	$working =  jets_fnc_theme_options('working-days', 'Mon-Sat: 8.00 - 18.00');
	$hotline =  jets_fnc_theme_options('hotline', '1800-123 456 789'); 
?>
<div class="box-top hidden-sm hidden-xs">
	<div class="box-service-top hidden-md">
		<div class="box-content media">
			<div class="icon pull-left">
                <i class="fa fa-map-marker">&nbsp;</i>
            </div>
			<div class="description media-body">
            	<h5 class="title"><?php esc_html_e('Location', 'jets');?></h5>
            	<span><?php echo trim($location);?></span>
        	</div>
        </div>
    </div>
    <div class="box-service-top">
        <div class="box-content media">
			<div class="icon pull-left">
	         	<i class="fa fa-clock-o">&nbsp;</i>
			</div>
            <div class="description media-body">
                <h5 class="title"><?php esc_html_e('Working days', 'jets');?></h5>
                <span><?php echo trim($working);?></span>
            </div>
        </div>
    </div>
	<div class="box-service-top support">
        <div class="box-content media">
          	<div class="description  media-body">
               	<h5 class="title"><?php esc_html_e('Helpline', 'jets');?></h5>
                <p><?php echo trim($hotline);?></p>
            </div>
        </div>
  	</div>
	</div>