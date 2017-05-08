<?php

/**
 * Load woocommerce styles follow theme skin actived
 *
 * @static
 * @access public
 * @since Wpopal_Themer 1.0
 */
function jets_fnc_woocommerce_load_media() {
    $current = jets_fnc_theme_options( 'skin','default' );
    if($current == 'default'){
        $path =  get_template_directory_uri() .'/css/woocommerce.css';
    }else{
        $path =  get_template_directory_uri() .'/css/skins/'.$current.'/woocommerce.css';
    }
    wp_enqueue_style( 'jets-woocommerce', $path , 'jets-woocommerce-front' , WOOSA_THEME_VERSION, 'all' );
}
add_action( 'wp_enqueue_scripts','jets_fnc_woocommerce_load_media', 15 );

/**
 * Auto config product images after the theme actived.
 */
function jets_fnc_woocommerce_setup(){
	$catalog = array(
		'width' 	=> '465',	// px
		'height'	=> '528',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '550',	// px
		'height'	=> '625',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '90',	// px
		'height'	=> '102',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_action( 'jets_setup_theme_actived', 'jets_fnc_woocommerce_setup');

/**
 */
add_filter('woocommerce_add_to_cart_fragments',				'jets_fnc_woocommerce_header_add_to_cart_fragment' );

function jets_fnc_woocommerce_header_add_to_cart_fragment( $fragments ){
	global $woocommerce;

	$fragments['#cart .mini-cart-items'] =  sprintf( '<span class="mini-cart-items"> %d  </span> ', $woocommerce->cart->cart_contents_count);    
    return $fragments;
}
add_filter( 'yith_wcwl_button_label',          'jets_fnc_wpo_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'jets_fnc_wpo_woocomerce_icon_wishlist_add' );

function jets_fnc_wpo_woocomerce_icon_wishlist( $value='' ){
	return '<i class="fa fa-heart-o"></i><span>'.esc_html__('Wishlist', 'jets').'</span>';
}

function jets_fnc_wpo_woocomerce_icon_wishlist_add(){
	return '<i class="fa fa-heart-o"></i><span>'.esc_html__('Wishlist', 'jets').'</span>';
}
/**
 * Mini Basket
 */
if(!function_exists('jets_fnc_minibasket')){
    function jets_fnc_minibasket( $style='' ){ 
        $template =  apply_filters( 'jets_fnc_minibasket_template', jets_fnc_get_header_layout( '' )  );  
 
        return get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
if(jets_fnc_theme_options("woo-show-minicart",true)){
	add_action( 'jets_template_header_right', 'jets_fnc_minibasket', 30, 0 );
}
/******************************************************
 * 												   	  *
 * Hook functions applying in archive, category page  *
 *												      *
 ******************************************************/
function jets_template_woocommerce_main_container_class( $class ){ 
	if( is_product() ){
		$class .= ' '.  jets_fnc_theme_options('woocommerce-single-layout') ;
	}else if( is_product_category() || is_archive()  ){ 
		$class .= ' '.  jets_fnc_theme_options('woocommerce-archive-layout') ;
	}
	return $class;
}

add_filter( 'jets_template_woocommerce_main_container_class', 'jets_template_woocommerce_main_container_class' );
function jets_fnc_get_woocommerce_sidebar_configs( $configs='' ){

	global $post; 
	$right = null; $left = null; 

	if( is_product() ){
		
		$left  =  jets_fnc_theme_options( 'woocommerce-single-left-sidebar' ); 
		$right =  jets_fnc_theme_options( 'woocommerce-single-right-sidebar' );  

	}else if( is_product_category() || is_archive() ){
		$left  =  jets_fnc_theme_options( 'woocommerce-archive-left-sidebar' ); 
		$right =  jets_fnc_theme_options( 'woocommerce-archive-right-sidebar' ); 
	}

 
	return jets_fnc_get_layout_configs( $left, $right );
}

add_filter( 'jets_fnc_get_woocommerce_sidebar_configs', 'jets_fnc_get_woocommerce_sidebar_configs', 1, 1 );


function jets_woocommerce_breadcrumb_defaults( $args ){
	$args['wrap_before'] = '<div class="opal-breadscrumb"><div class="container"><ol class="opal-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
	$args['wrap_after'] = '</ol></div></div>';

	return $args;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'jets_woocommerce_breadcrumb_defaults' );

add_action( 'jets_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );
/**
 * Remove show page results which display on top left of listing products block.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 10 );


function jets_fnc_woocommerce_after_shop_loop_start(){
	echo '<div class="products-bottom-wrap clearfix">';
}

add_action( 'woocommerce_after_shop_loop', 'jets_fnc_woocommerce_after_shop_loop_start', 1 );

function jets_fnc_woocommerce_after_shop_loop_after(){
	echo '</div>';
}

add_action( 'woocommerce_after_shop_loop', 'jets_fnc_woocommerce_after_shop_loop_after', 10000 );


/**
 * Wrapping all elements are wrapped inside Div Container which rendered in woocommerce_before_shop_loop hook
 */
function jets_fnc_woocommerce_before_shop_loop_start(){
	echo '<div class="products-top-wrap clearfix">';
}

function jets_fnc_woocommerce_before_shop_loop_end(){
	echo '</div>';
}


add_action( 'woocommerce_before_shop_loop', 'jets_fnc_woocommerce_before_shop_loop_start' , 0 );
add_action( 'woocommerce_before_shop_loop', 'jets_fnc_woocommerce_before_shop_loop_end' , 1000 );


function jets_fnc_woocommerce_display_modes(){
	global $wp;
	$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	$woo_display = jets_fnc_theme_options( 'wc_listgrid', 'grid' );

	if ( isset($_COOKIE['jets_woo_display']) && $_COOKIE['jets_woo_display'] == 'list' ) {
		$woo_display = $_COOKIE['jets_woo_display'];
	}
	
	echo '<form action="'.  $current_url  .'" class="display-mode" method="get">';
 
		echo '<button title="'.esc_html__('Grid', 'jets').'" class="btn '.($woo_display == 'grid' ? 'active' : '').'" value="grid" name="display" type="submit"><i class="fa fa-th"></i></button>';	
		echo '<button title="'.esc_html__( 'List', 'jets' ).'" class="btn '.($woo_display == 'list' ? 'active' : '').'" value="list" name="display" type="submit"><i class="fa fa-th-list"></i></button>';	
	echo '</form>'; 
}

add_action( 'woocommerce_before_shop_loop', 'jets_fnc_woocommerce_display_modes' , 10 );


/**
 * Processing hook layout content
 */
function jets_fnc_layout_main_class( $class ){
	$sidebar = jets_fnc_theme_options( 'woo-sidebar-show', 1 ) ;
	if( is_single() ){
		$sidebar = jets_fnc_theme_options('woo-single-sidebar-show'); ;
	}
	else {
		$sidebar = jets_fnc_theme_options('woo-sidebar-show'); 
	}

	if( $sidebar ){
		return $class;
	}

	return 'col-lg-12 col-md-12 col-xs-12';
}
add_filter( 'jets_woo_layout_main_class', 'jets_fnc_layout_main_class', 4 );


/**
 *
 */
function jets_fnc_woocommerce_archive_image(){ 
	if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) { 
		$thumb =  get_woocommerce_term_meta( get_queried_object()->term_id, 'thumbnail_id', true ) ;

		if( $thumb ){
			$img = wp_get_attachment_image_src( $thumb, 'full' ); 
		
			echo '<p class="category-banner"><img src="'.$img[0].'""></p>'; 
		}
	}
}
add_action( 'woocommerce_archive_description', 'jets_fnc_woocommerce_archive_image', 9 );
/**
 * Add action to init parameter before processing
 */

function jets_fnc_before_woocommerce_init(){
	if( isset($_GET['display']) && ($_GET['display']=='list' || $_GET['display']=='grid') ){  
		setcookie( 'jets_woo_display', trim($_GET['display']) , time()+3600*24*100,'/' );
		$_COOKIE['jets_woo_display'] = trim($_GET['display']);
	}
}

add_action( 'init', 'jets_fnc_before_woocommerce_init' );
/***************************************************
 * 												   *
 * Hook functions applying in single product page  *
 *												   *
 ***************************************************/


/** 
 * Remove review to products tabs. and display this as block below the tab.
 */
function jets_fnc_woocommerce_product_tabs( $tabs ){

	if( isset($tabs['reviews']) ){
//		unset( $tabs['reviews'] ); 
	}
	return $tabs;
}
add_filter( 'woocommerce_product_tabs','jets_fnc_woocommerce_product_tabs', 99 );
 
 /**
  * Rehook product review products in woocommerce_after_single_product_summary
  */
function jets_fnc_product_reviews(){
	return comments_template();
}
//add_action('woocommerce_after_single_product_summary','jets_fnc_product_reviews', 10 );
 


/**
 * Show/Hide related, upsells products
 */
function jets_woocommerce_related_upsells_products($located, $template_name) {
	$options      = get_option('wpopal_theme_options');
	$content_none = get_template_directory() . '/woocommerce/content-none.php';

	if ( 'single-product/related.php' == $template_name ) {
		if ( isset( $options['wc_show_related'] ) && 
			( 1 == $options['wc_show_related'] ) ) {
			$located = $content_none;
		}
	} elseif ( 'single-product/up-sells.php' == $template_name ) {
		if ( isset( $options['wc_show_upsells'] ) && 
			( 1 == $options['wc_show_upsells'] ) ) {
			$located = $content_none;
		}
	}

	return apply_filters( 'jets_woocommerce_related_upsells_products', $located, $template_name );
}

add_filter( 'wc_get_template', 'jets_woocommerce_related_upsells_products', 10, 2 );

/**
 * Number of products per page
 */
function jets_woocommerce_shop_per_page($number) {
	$value = jets_fnc_theme_options('woo-number-page', get_option('posts_per_page'));
	if ( is_numeric( $value ) && $value ) {
		$number = absint( $value );
	}
	return $number;
}

add_filter( 'loop_shop_per_page', 'jets_woocommerce_shop_per_page' );

/**
 * Number of products per row
 */
function jets_woocommerce_shop_columns($number) {
	$value = jets_fnc_theme_options('wc_itemsrow', 4);
	if ( in_array( $value, array(2, 3, 4, 6) ) ) {
		$number = $value;
	}
	return $number;
}

add_filter( 'loop_shop_columns', 'jets_woocommerce_shop_columns' );

/**
 *
 */
function jets_fnc_woocommerce_share_box() {
	if ( jets_fnc_theme_options('wc_show_share_social', 1) ) {
		get_template_part( 'page-templates/parts/sharebox' );
	}
}
add_action( 'jets_woocommerce_after_single_product_summary', 'jets_fnc_woocommerce_share_box', 25 );

/**
 *
 */
function jets_fnc_woo_product_nav(){
    echo '<div class="product-nav pull-right">';

        previous_post_link('<p>%link</p>', '<i class="fa fa-angle-left"></i>', FALSE); 
        next_post_link('<p>%link</p>', '<i class="fa fa-angle-right"></i>', FALSE); 

    echo '</div>';
}

add_action( 'jets_woocommerce_after_single_product_title', 'jets_fnc_woo_product_nav', 1 );


// rating star
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'jets_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating');


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 1 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );


//remove_action( 'jets_woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
//add_action( 'jets_woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );

function jets_woocommerce_show_product_thumbnails( $layout ){ 
	return $layout;
}

add_filter( 'wpopal_themer_woocommerce_show_product_thumbnails', 'jets_woocommerce_show_product_thumbnails'  );

function jets_woocommerce_show_product_images( $layout ){ 
	return $layout;
}

add_filter( 'wpopal_themer_woocommerce_show_product_images', 'jets_woocommerce_show_product_images'  );



/* ---------------------------------------------------------------------------
 * WooCommerce - Function get Query
 * --------------------------------------------------------------------------- */
 
function jets_fnc_get_review_counting(){

    global $post; 
    $output = array();

    for($i=1; $i <= 5; $i++){
         $args = array(
            'post_id'      => ( $post->ID ),
            'meta_query' => array(
              array(
                'key'   => 'rating',
                'value' => $i
              )
            ),      
            'count' => true
        );
        $output[$i] = get_comments( $args );
    }
    return $output;
}

 
/* ---------------------------------------------------------------------------
 * WooCommerce - Function get Query
 * --------------------------------------------------------------------------- */
 


function jets_fnc_woocommerce_before_shop_loop_item_title(){

    global $product;

    if( $product->regular_price ){
        $percentage = round( ( ( $product->regular_price - $product->get_regular_price() ) / $product->regular_price ) * 100 );
        echo '<span class="product-sale-label">-' . trim( $percentage ) . '%</span>';
    }
                                            
}


if ( ! function_exists( 'jets_fnc_woocommerce_content' ) ) {

    /**
     * Output WooCommerce content.
     *
     * This function is only used in the optional 'woocommerce.php' template
     * which people can add to their themes to add basic woocommerce support
     * without hooks or modifying core templates.
     *
     */
    function jets_fnc_woocommerce_content() {

        if ( is_singular( 'product' ) ) {

            while ( have_posts() ) : the_post();

                wc_get_template_part( 'content', 'single-product' );

            endwhile;

        } else { ?>

            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

            <?php endif; ?>

            <?php do_action( 'woocommerce_archive_description' ); ?>

            <?php if ( have_posts() ) : ?>

                <?php do_action('woocommerce_before_shop_loop'); ?>

                <div class="childrens">
                    <?php woocommerce_product_subcategories(); ?>  
                </div>

                <?php woocommerce_product_loop_start(); ?>

                   
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php do_action('woocommerce_after_shop_loop'); ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif;

        }
    }
}
