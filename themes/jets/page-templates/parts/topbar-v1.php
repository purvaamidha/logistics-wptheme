<section id="opal-topbar" class="opal-topbar hidden-xs hidden-sm clearfix">
    <div class="container">
        <div class="pull-right">
            <ul class="list-inline pull-right">
                                        <?php if( !is_user_logged_in() ){ ?>
                                        <?php do_action( 'opal-account-buttons' ); ?>
                                        <?php }else{ ?>
                                            <?php $current_user = wp_get_current_user(); ?>
                                          <li>  <span class="hidden-xs"><?php esc_html_e('Welcome ', 'jets'); ?><?php echo esc_html( $current_user->display_name); ?> !</span></li>
                                          <li><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><?php esc_html_e('Logout', 'jets'); ?></a></li>
                                        <?php } ?>
                                    </ul> 
            <div class="email-header pull-left">
                <?php $page_id = @opalrequestquote_get_option( 'opalrequestquote_page' );
                    $page_link = ($page_id == "#") ? $page_id : get_page_link($page_id); ?>
                <a href="<?php echo esc_url($page_link); ?>" class="text-primary"><?php esc_html_e('Request a Quote', 'jets');?></a>
            </div>
        </div>

        <div class="pull-left text-call">
            <?php $hotline =  jets_fnc_theme_options('hotline', '1800-123 456 789'); ?>
            <span><?php esc_html_e('Call us now: ', 'jets');?></span><?php echo trim($hotline); ?>
        </div>     
    </div>                 
</section>