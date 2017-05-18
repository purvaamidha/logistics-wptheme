<?php 
$atts  = array_merge( array(
		'title'            		=> '',
		'description'      		=> '',
		'layout'				=> 'layout1',
	), $atts); 
extract( $atts );
// show by shortcode [opal_requestquote_short]
echo do_shortcode( '[opal_requestquote_short  title="'.$title.'"  description="'.$description.'"  layout="'.$layout.'" ]' );

