<?php
    $job = get_post_meta( get_the_ID(), 'testimonials_job', true );
?>
<div class="testimonials-v3">
	<div class="testimonials-body">
	    <p class="testimonials-description"><?php the_content() ?></p>                            
	    <h5 class="testimonials-name">
	         <?php the_title(); ?>
	    </h5>  
	    <div class="job">
			<?php echo empty($job) ? '' : trim( $job ); ?>
	    </div> 
	</div>
</div>