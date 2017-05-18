<?php
    $job = get_post_meta( get_the_ID(), 'testimonials_job', true );
?>
<div class="testimonials-left text-center">
<div class="testimonials-body">
    <div class="testimonials-description"><?php the_content() ?></div>
    
    <div class="testimonials-avatar">
      <?php the_post_thumbnail('widget', '', 'class="radius-x"');?>
    </div>   
    <div class="testimonials-profile"> 
        <h4 class="testimonials-name">
            <?php the_title(); ?>
        </h4>
        <div class="job">
            <?php echo empty($job) ? '' : trim( $job ); ?>
        </div>
    </div>                
</div>
</div>