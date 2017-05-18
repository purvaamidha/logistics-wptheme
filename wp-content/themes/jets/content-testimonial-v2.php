<?php
    $link = get_post_meta( get_the_ID(), 'testimonials_link', true );
    $job = get_post_meta( get_the_ID(), 'testimonials_job', true );
?>
<div class="testimonials-v2">
	<div class="testimonials-body media">	                  
	    <div class="testimonials-avatar radius-x media-left">
	        <a href="<?php echo get_post_meta( get_the_ID(), 'testimonials_link', true ); ?>"><?php the_post_thumbnail('widget', '', 'class="radius-x"');?></a>
	    </div>
	    <div class="testimonials-meta">
	    	<div class="testimonials-description"><?php the_content() ?></div>
		    <h5 class="testimonials-name"><?php the_title(); ?></h5>  
		    <div class="job">
				<?php echo empty($job) ? '' : trim( $job ); ?>
		    </div>
	    </div>  
	               
	</div>
</div>