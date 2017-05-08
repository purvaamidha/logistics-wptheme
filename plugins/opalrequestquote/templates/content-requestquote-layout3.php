<?php 
$prefix = OPALREQUESTQUOTE_PREFIX;
$opalrequestquote_page = opalrequestquote_get_option( 'opalrequestquote_page' );
?>
<div class="requestquote-form layout3">
    <div class="requestquote-header txtcenter">
        <?php if(isset($title) && trim($title)!=''): ?>
            <div class="requestquote-title">
                <h3><?php echo trim($title); ?></h3>
            </div>
        <?php endif; ?>
        <?php if(isset($description) && trim($description)!=''): ?>
            <div class="requestquote-description">
                <p><?php echo trim($description); ?></p>
            </div>
        <?php endif; ?>
    </div> <!-- /.requestquote-header -->
    <div class='requestquote-content-form'>
        <form class="form-vertical requestquote_short_form" name="requestquote_short_form" method="post" action="<?php echo get_page_link($opalrequestquote_page); ?>">
            <?php do_action( 'opalrequestquote_before_form' ); ?>
            <div class="fleft movingfrom">
                <input id="<?php echo $prefix; ?>movingfrom" name="<?php echo $prefix; ?>movingfrom" type="text" placeholder="<?php esc_html_e('Moving from', 'opalrequestquote');?>" class="required">
            </div>
            <div class="fleft movingto">
                <input id="<?php echo $prefix; ?>movingto" name="<?php echo $prefix; ?>movingto" type="text" placeholder="<?php esc_html_e('Moving to', 'opalrequestquote');?>" class="required">
            </div>
            <div class="fleft movingon">
                <input class="required form-control <?php echo $prefix; ?>movingon" name="<?php echo $prefix; ?>movingon" type="text" placeholder="<?php esc_html_e('When', 'opalrequestquote');?>">
            </div>
            <div class="fleft requestquote_type">
                <select class="required form-control " name="<?php echo $prefix; ?>type">
                    <option value=""><?php esc_html_e('Residence Size','opalrequestquote'); ?></option>
                    <?php $types = Opalrequestquote_Query::getTypesQuery();
                    if($types->have_posts()): ?>
                        <?php while( $types->have_posts() ): $types->the_post(); ?>
                          <option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif ?>  
                </select>
            </div>
            <div class="bedroom-filter" class="fleft" id="bedroom-filter"></div>
            <div class="fleft">
                <button type="submit" class="btn"><?php esc_html_e('Show My Quote', 'opalrequestquote');?></button>
                <?php do_action( 'opalrequestquote_after_form' ); ?>
                <input type="hidden" name="action" class="requestquote_action" value="requestquote_post" />
                <?php wp_nonce_field( 'requestquote_post','requestquote_post_field' ); ?>
            </div> 
        </form>
    </div> <!-- /.requestquote-content-form -->
</div> <!--/.requestquote-form (0) -->