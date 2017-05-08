<?php

$bedrooms = Opalrequestquote_Query::getMetaboxValues($post_id,'bedroom_lists_group'); 
if(!empty($bedrooms[0])):
?>
	<?php if($admin): ?>
		<div data-fieldtype="select" class="cmb-row cmb-type-select cmb2-id-opal-requestquote-bedroom">
			<div class="cmb-th">
				<label class="bedroom-filter" for="opal_requestquote_bedroom"><?php esc_html_e('Bedrooms','opalrequestquote');?></label>
			</div>
			<div class="cmb-td">
				<select id="opal_requestquote_bedroom" name="opal_requestquote_bedroom" class="cmb2_select">
					<?php foreach( $bedrooms as $bedroom ):  ?>
			      		<option value="<?php echo $bedroom['bedroom_lists_value']; ?>"><?php echo $bedroom['bedroom_lists_key']; ?></option>
			    	<?php endforeach; ?>
				</select>
			</div>
		</div>
	<?php else: ?>
	<label class="bedroom-filter" for="type" ><?php esc_html_e('Bedrooms','opalrequestquote');?> <span class="reruired-lable">*</span></label>
	<select class="form-control opal_requestquote_bedroom" name="opal_requestquote_bedroom">
	    <?php foreach( $bedrooms as $bedroom ):  ?>
	      <option value="<?php echo $bedroom['bedroom_lists_value']; ?>"><?php echo $bedroom['bedroom_lists_key']; ?></option>
	    <?php endforeach; ?>
	</select>
	<?php endif; ?>
<?php endif; ?>