<section id="opal-topbar" class="opal-topbar hidden-xs hidden-sm clearfix">
    <div class="container">
        <div class="pull-right">
            <div class="email-header pull-left">
                <?php $email =  jets_fnc_theme_options('email', 'info@company.com'); ?>
                    <span class="fa fa-envelope-o"></span> <a href="mailto:<?php echo sanitize_email($email) ;?>"><?php echo sanitize_email($email);?></a>
            </div>
            <div class="pull-right">
            <?php if ( is_active_sidebar( 'header-socials' ) ) : ?>
                <?php dynamic_sidebar('header-socials'); ?>
            <?php endif; ?>
            </div>
        </div>

        <div class="pull-left">
            <?php $text_header =  jets_fnc_theme_options('text-header', 'Providing Moving & Storage Services'); ?>
            <?php echo trim($text_header); ?>
        </div>     
    </div>                 
</section>