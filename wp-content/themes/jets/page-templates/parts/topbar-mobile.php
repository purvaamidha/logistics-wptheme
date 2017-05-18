<div class="topbar-mobile  hidden-lg hidden-md">
    <div class="active-mobile pull-left">
        <button data-toggle="offcanvas" class="btn btn-offcanvas btn-toggle-canvas offcanvas" type="button">
           <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="topbar-inner pull-left">
        <div class="active-mobile search-popup pull-left">
            <span class="fa fa-search"></span>
            <div class="active-content">
                <?php jets_fnc_categories_searchform(); ?>
            </div>
        </div>
        <div class="active-mobile setting-popup pull-left">
            <span class="fa fa-user"></span>
            <div class="active-content">
                <?php if(has_nav_menu( 'topmenu' )){ ?>
                    <div class="pull-left">
                        <?php
                            $args = array(
                                'theme_location'  => 'topmenu',
                                'container_class' => '',
                                'menu_class'      => 'menu-topbar'
                            );
                            wp_nav_menu($args);
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php if( class_exists('WooCommerce') ): ?>
            <div class="active-mobile pull-left cart-popup">
                <span class="fa fa-shopping-cart"></span>
                <div class="active-content">
                    <div class="widget_shopping_cart_content"></div>
                </div>
            </div>
        <?php endif; ?>  
    </div>       
</div>
