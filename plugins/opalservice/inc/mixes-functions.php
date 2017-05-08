<?php
/**
 * $Desc$
 *
 * @version    $Id$
 * @package    opalservice
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2016 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * batch including all files in a path.
 *
 * @param String $path : PATH_DIR/*.php or PATH_DIR with $ifiles not empty
 */
function opalservice_includes( $path, $ifiles=array() ){

    if( !empty($ifiles) ){
         foreach( $ifiles as $key => $file ){
            $file  = $path.'/'.$file; 
            if(is_file($file)){
                require($file);
            }
         }   
    }else {
        $files = glob($path);
        foreach ($files as $key => $file) {
            if(is_file($file)){
                require($file);
            }
        }
    }
}

/**
* Get data from config files
*
* @param $name
*
* @return mixed
*/
if(!function_exists('get_config')){
    function get_config($name) {
        if (!empty($name)) {
            return require(OPALSERVICE_LANGUAGE_DIR . "{$name}.php");
        }
    }

}

/**
 *
 */
function opalservice_menu( $id ){
    global $menu; 

    $menu = new Opalservice_Menu( $id );

    return $menu; 
}



function opalservice_options( $key, $default = '' ){
    
    global $opalservice_options; 
    
    $value =  isset($opalservice_options[ $key ]) ? $opalservice_options[ $key ] : $default;
    $value = apply_filters( 'opalservice_option_', $value, $key, $default );
  
    return apply_filters( 'opalservice_option_' . $key, $value, $key, $default );
}

/**
 * @return integer
 */
if(!function_exists('convert_integer')){
    function convert_integer( $key, $default = '' ){
        $convert = $key ? $key : $default;
        return (int)$convert;
    }
}
/**
 * @return string boolean
 */
if(!function_exists('convert_boolean')){
    function convert_boolean( $key ){
        if($key == "1"){
           return "true";
        }
        return "false";
    }
}
/**
 *
 *  Applyer function to show unit for menu
 */

function opalservice_areasize_unit_format( $value='' ){
    return  $value . ' ' . '<span>'.'m2'.'</span>';
}

add_filter( 'opalservice_areasize_unit_format', 'opalservice_areasize_unit_format' );

/**
 *
 *  Applyer function to show unit for title
 */
if(!function_exists('opalservice_fnc_title')){
    //Custom Excerpt Function
    function opalservice_fnc_title($limit=2,$afterlimit=null) {
        $excerpt = get_the_title();
        if( $excerpt != ''){
           $excerpt = @explode(' ', strip_tags( $excerpt ), $limit);
        }else{
            $excerpt = @explode(' ', strip_tags(get_the_content( )), $limit);
        }
        if (count($excerpt)>=$limit) {
            @array_pop($excerpt);
            $excerpt = @implode(" ",$excerpt).' '.$afterlimit;
        } else {
            $excerpt = @implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return strip_shortcodes( $excerpt );
    }
} 

/**
 *
 *  Applyer function to show unit for excerpt
 */
if(!function_exists('opalservice_fnc_excerpt')){
    //Custom Excerpt Function
    function opalservice_fnc_excerpt($limit,$afterlimit='[...]') {
        $excerpt = get_the_excerpt();
        if( $excerpt != ''){
           $excerpt = @explode(' ', strip_tags( $excerpt ), $limit);
        }else{
            $excerpt = @explode(' ', strip_tags(get_the_content( )), $limit);
        }
        if (count($excerpt)>=$limit) {
            @array_pop($excerpt);
            $excerpt = @implode(" ",$excerpt).' '.$afterlimit;
        } else {
            $excerpt = @implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return strip_shortcodes( $excerpt );
    }
}

/**
 *
 *  Applyer function to show unit for description 
 */
if(!function_exists('opalservice_fnc_description')){
    //Custom Excerpt Function
    function opalservice_fnc_description($limit,$afterlimit='[...]') {
        $excerpt = get_the_content();
        if( $excerpt != ''){
           $excerpt = @explode(' ', strip_tags( $excerpt ), $limit);
        }else{
            $excerpt = @explode(' ', strip_tags(get_the_content( )), $limit);
        }
        if (count($excerpt)>=$limit) {
            @array_pop($excerpt);
            $excerpt = @implode(" ",$excerpt).' '.$afterlimit;
        } else {
            $excerpt = @implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return strip_shortcodes( $excerpt );
    }
}

/**
* Function pagination for plugin
* @param $pages 
* @param $$range
*/
function opalservice_pagination($pages = '', $range = 2 ) {
    global $paged;

    if(empty($paged))$paged = 1;

    $prev = $paged - 1;
    $next = $paged + 1;
    $showitems = ( $range * 2 )+1;
    $range = 2; // change it to show more links

    if( $pages == '' ){
        global $wp_query;

        $pages = $wp_query->max_num_pages;
        if( !$pages ){
            $pages = 1;
        }
    }

    if( 1 != $pages ){

        echo '<div class="pagination-main">';
            echo '<ul class="pagination">';
                echo ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) ? '<li><a aria-label="First" href="'.get_pagenum_link(1).'"><span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span></a></li>' : '';
                echo ( $paged > 1 ) ? '<li><a aria-label="Previous" href="'.get_pagenum_link($prev).'"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>' : '<li class="disabled"><a aria-label="Previous"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>';
                for ( $i = 1; $i <= $pages; $i++ ) {
                    if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) )
                    {
                        if ( $paged == $i ){
                            echo '<li class="active"><a href="'.get_pagenum_link($i).'">'.$i.' <span class="sr-only"></span></a></li>';
                        } else {
                            echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
                        }
                    }
                }
                echo ( $paged < $pages ) ? '<li><a aria-label="Next" href="'.get_pagenum_link($next).'"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>' : '';
                echo ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) ? '<li><a aria-label="Last" href="'.get_pagenum_link( $pages ).'"><span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span></a></li>' : '';
            echo '</ul>';
        echo '</div>';

    }
}

