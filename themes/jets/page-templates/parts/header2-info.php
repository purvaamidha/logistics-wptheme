<?php
	$location =  jets_fnc_theme_options('location', 'New York, USA');
	$working =  jets_fnc_theme_options('working-days', 'Mon-Sat: 8.00 - 18.00');
	$hotline =  jets_fnc_theme_options('hotline', '1800-123 456 789'); 
?>
<div class="box-top hidden-sm hidden-xs">
	<div class="box-service-top hidden-md">
		<div class="box-content media">
			<div class="description media-body">
            	<h5 class="title"><?php esc_html_e('Location', 'jets');?></h5>
            	<span><?php echo trim($location);?></span>
        	</div>
        </div>
    </div>
    <div class="box-service-top">
        <div class="box-content media">
            <div class="description media-body">
                <h5 class="title"><?php esc_html_e('Working days', 'jets');?></h5>
                <span><?php echo trim($working);?></span>
            </div>
        </div>
    </div>
	<div class="box-service-top">
        <div class="box-content media">
          	<div class="description  media-body">
               	<h5 class="title"><?php esc_html_e('Helpline', 'jets');?></h5>
                <p><?php echo trim($hotline);?></p>
            </div>
        </div>
  	</div>
    <div class="box-service-top">
        <div class="box-content">
            <?php $page_id = @opalrequestquote_get_option( 'opalrequestquote_page' );
                    $page_link = ($page_id == "#") ? $page_id : get_page_link($page_id); ?>
            <a href="<?php echo esc_url($page_link); ?>" class="btn btn-primary"><?php esc_html_e('Request a Quote', 'jets');?></a>
        </div>
    </div>
</div>