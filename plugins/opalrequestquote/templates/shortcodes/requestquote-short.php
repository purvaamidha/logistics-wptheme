<div class="widget widget-requestquote-table">
	<div class="widget-content">
		<div class="opalrequestquote-recent rows">
			<div class="row">
				<div class="col-lg-12">
					<?php if( !empty($layout) ) : ?>
						<?php echo Opalrequestquote_Template_Loader::get_template_part( 'content-requestquote-'.$layout,array('title'=>$title,'description'=>$description)); ?>
					<?php endif; ?>
				</div>
			</div>	
		</div>
	</div>	
</div>	
