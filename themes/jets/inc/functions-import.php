<?php

function jets_fnc_import_remote_demos() { 
	return array(
		'jets' => array( 
			'name' 		=> 'jets', 
		 	'source'	=> 'http://wpsampledemo.com/jets/jets.zip',
		 	'preview'   => 'http://wpsampledemo.com/jets/screenshot.png'
		),
	);
}

add_filter( 'wpopal_themer_import_remote_demos', 'jets_fnc_import_remote_demos' );



function jets_fnc_import_theme() {
	return 'jets';
}
add_filter( 'wpopal_themer_import_theme', 'jets_fnc_import_theme' );

function jets_fnc_import_demos() {
	$folderes = glob( get_template_directory() .'/inc/import/*', GLOB_ONLYDIR ); 

	$output = array(); 

	foreach( $folderes as $folder ){
		$output[basename( $folder )] = basename( $folder );
	}
 	
 	return $output;
}
add_filter( 'wpopal_themer_import_demos', 'jets_fnc_import_demos' );

function jets_fnc_import_types() {
	return array(
			'all' => 'All',
			'content' => 'Content',
			'widgets' => 'Widgets',
			'page_options' => 'Theme + Page Options',
			'menus' => 'Menus',
			'rev_slider' => 'Revolution Slider',
			'vc_templates' => 'VC Templates'
		);
}
add_filter( 'wpopal_themer_import_types', 'jets_fnc_import_types' );
/**
 * Matching and resizing images with url.
 *
 *  $ouput = array(
 *        'allowed' => 1, // allow resize images via using GD Lib php to generate image
 *        'height'  => 900,
 *        'width'   => 800,
 *        'file_name' => 'blog_demo.jpg'
 *   ); 
 */
function jets_import_attachment_image_size( $url ){  

   $name = basename( $url );   
 
   $ouput = array(
         'allowed' => 0
   );     
   
   if( preg_match("#product#", $name) ) {
      $ouput = array(
         'allowed' => 1,
         'height'  => 1000,
         'width'   => 1000,
         'file_name' => 'product_demo.jpg'
      ); 
   }
   elseif( preg_match("#blog#", $name) ){
      $ouput = array(
         'allowed' => 1,
         'height'  => 594,
         'width'   => 890,
         'file_name' => 'blog_demo.jpg'
      ); 
   }
   elseif( preg_match("#slide#", $name) ){
      $ouput = array(
         'allowed' => 1,
         'height'  => 940,
         'width'   => 1920,
         'file_name' => 'slide_demo.jpg'
      );
   }
   elseif( preg_match("#gallary#", $name) ){
      $ouput = array(
         'allowed' => 1,
         'height'  => 594,
         'width'   => 890,
         'file_name' => 'gallary_demo.jpg'
      );
   }
   return $ouput;
}

add_filter( 'pbrthemer_import_attachment_image_size', 'jets_import_attachment_image_size' , 1 , 999 );