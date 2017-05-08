<?php 
	extract( $atts );
?>
<?php if( isset($options) ) : ?>
<div class="element-timelife">
	<div class="inner">
	<?php foreach( $options as $option ):   ?>
		<div class="entry-timeline">
			<div class="timelife-head">
				<i class="fa fa-calendar icon" aria-hidden="true"></i>
				<div class="timelife-date">
					<span><?php echo trim( $option->day ); ?></span>
					<span><?php echo trim( $option->year ); ?></span>
				</div>
            </div>
            <div class="timelife-content">
            	<h4><?php echo trim( $option->title ); ?></h4>
            	<p class="timelife-description">
            		<?php echo trim( $option->content ); ?>
            	</p>
            </div> 
		</div>	
	<?php endforeach; ?>
	</div>
</div>	
<?php endif; ?>