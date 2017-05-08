<?php $prefix = OPALREQUESTQUOTE_PREFIX; ?>
<div id="requestquote-page" data-role="page">

	<div class='modal'></div>
    <form class="form-horizontal requestquote_post_form" name="requestquote_post_form" method="post" action="">
        <div>
            <h3><?php esc_html_e('Move Information','opalrequestquote');?></h3>
            <section>
            	<div class="row">
            		<div class="col-md-4 boder-right">
            			<h3><?php esc_html_e('Where Are You Moving?','opalrequestquote');?></h3>
            			<label for="<?php echo $prefix; ?>movingfrom"><?php esc_html_e('Moving From','opalrequestquote');?> <span class="reruired-lable">*</span></label>
		                <input id="<?php echo $prefix; ?>movingfrom" name="<?php echo $prefix; ?>movingfrom" type="text" value="<?php echo isset($_POST[$prefix.'movingfrom']) ? $_POST[$prefix.'movingfrom'] : "" ;?>" class="required">
		                <label for="<?php echo $prefix; ?>movingto"><?php esc_html_e('To','opalrequestquote');?> <span class="reruired-lable">*</span></label>
		                <input id="<?php echo $prefix; ?>movingto" name="<?php echo $prefix; ?>movingto" type="text" value="<?php echo isset($_POST[$prefix.'movingto']) ? $_POST[$prefix.'movingto'] : "" ;?>" class="required">
                        
            		</div><!-- /.col-md-4 -->
            		<div class="col-md-4 boder-right">
            			<h3><?php esc_html_e('Where Are You Moving?','opalrequestquote');?></h3>
            			<label for="<?php echo $prefix; ?>date"><?php esc_html_e('Moving On','opalrequestquote');?> <span class="reruired-lable">*</span></label>
		                <input class="form-control <?php echo $prefix; ?>movingon" name="<?php echo $prefix; ?>movingon" type="text" placeholder="_/_/_ " value="<?php echo isset($_POST[$prefix.'movingon']) ? $_POST[$prefix.'movingon'] : "" ;?>" class="required" >
		               
            		</div><!-- /.col-md-4 -->
            		<div class="col-md-4">
            			<h3><?php esc_html_e('What Size is Your Home?','opalrequestquote');?></h3>
            			<label for="type"><?php esc_html_e('Type','opalrequestquote');?> <span class="reruired-lable">*</span></label>
				        <select id="<?php echo $prefix; ?>type" class="form-control <?php echo $prefix; ?>type" name="<?php echo $prefix; ?>type" class="required" >
				        	<option value=""><?php esc_html_e('Select Type','opalrequestquote'); ?></option>
					        <?php $types = Opalrequestquote_Query::getTypesQuery();
					        if($types->have_posts()): ?>
					            <?php while( $types->have_posts() ): $types->the_post(); ?>
                                    <?php if(isset($_POST[$prefix.'type']) && $_POST[$prefix.'type'] == get_the_ID()): ?>
					                   <option value="<?php echo get_the_ID(); ?>" selected="selected"><?php the_title(); ?></option>
                                    <?php  else: ?>
                                        <option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
                                    <?php endif;?>
					            <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
					      	<?php endif ?>  
            			</select>
				        <div class="bedroom-filter" id="bedroom-filter"></div>
            		</div><!-- /.col-md-4 -->

            		
            	</div><!-- /.row -->
                <div class="row">
                    
                    <div class="col-md-8">
                        <div class="directions-description">
                            <span><?php esc_html_e('The directions which are calculated on estimated driving distance and the unit is automatic!','opalrequestquote'); ?></span>
                        </div>
                        <div class="directions-message"></div>
                        <div id="directions_map"></div>
                    </div>
                </div>
            </section>
            <h3><?php esc_html_e('Contact Information','opalrequestquote');?></h3>
            <section>
            	<h3><?php esc_html_e('Please provide your information so a representative can contact you for an in-home estimate.','opalrequestquote');?></h3>
            	<div class="row">
            		<div class="col-md-4 boder-right">
            			<label for="<?php echo $prefix; ?>firstname"><?php esc_html_e('First Name','opalrequestquote');?> <span class="reruired-lable">*</span></label>
		                <input id="<?php echo $prefix; ?>firstname" name="<?php echo $prefix; ?>firstname" type="text" class="required">
		                <label for="<?php echo $prefix; ?>lastname"><?php esc_html_e('Last Name','opalrequestquote');?></label>
		                <input id="<?php echo $prefix; ?>lastname" name="<?php echo $prefix; ?>lastname" type="text">
            		</div><!-- /.col-md-4 -->
            		<div class="col-md-4 boder-right">
            			<label for="<?php echo $prefix; ?>phonenumber"><?php esc_html_e('Phone number','opalrequestquote');?> <span class="reruired-lable">*</span></label>
		                <input id="<?php echo $prefix; ?>phonenumber" name="<?php echo $prefix; ?>phonenumber" type="text" class="required">
		                <label for="<?php echo $prefix; ?>email"><?php esc_html_e('Email address','opalrequestquote');?> <span class="reruired-lable">*</span></label>
		                <input id="<?php echo $prefix; ?>email" name="<?php echo $prefix; ?>email" type="text" class="required">
		               
            		</div><!-- /.col-md-4 -->
            		<div class="col-md-4">
            			<label for="<?php echo $prefix; ?>comment"><?php esc_html_e('Additional comments','opalrequestquote');?> </label>
		                <textarea class="form-control" rows="7" id="<?php echo $prefix; ?>comment" name="<?php echo $prefix; ?>comment"></textarea>
            		</div><!-- /.col-md-4 -->
            		
            	</div><!-- /.row -->
                
            </section>
            <h3><?php esc_html_e('Get Instant Quote','opalrequestquote');?></h3>
            <section>
                <div class="requestquote-icon-check"></div>
                <div class='requestquote-message'>
                    Thanks, your request quote  is waiting to be confirmed.

                Updates will be sent to the email address you provided.

                If you have any question please feel free call us

                1800-12345678
                </div>
            </section>
            
        </div>
    </form>


</div> <!-- //.requestquote-page
