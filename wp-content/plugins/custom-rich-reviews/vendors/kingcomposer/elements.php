<?php 

add_action('init', 'custom_rich_reviews_element_kingcomposer_map', 99 );
 
	function custom_rich_reviews_element_kingcomposer_map(){
		global $kc;

		$maps = array();

		 

		//=======================================================================
		$maps['element_total_reviews'] =  array(
		    'name' => esc_html__('Total Rich Reviews', 'custom-rich-reviews'),
		    'icon' => 'kc-icon-post',
		    'description' => 'Show Total Rich Reviews Info',
		    'category' => esc_html__('Elements', 'custom-rich-reviews'),
		    'params' => array(
				array(
					'type'			=> 'textarea',
					'label'			=> __( 'Description', 'custom-rich-reviews' ),
					'name'			=> 'description',
					'description'	=> __( 'The text description for your page.', 'custom-rich-reviews' ),
					'value'		   => esc_html('The Description'),
				),
				array(
					'type'			=> 'text',
					'label'			=> __( 'Slug Page Link', 'custom-rich-reviews' ),
					'name'			=> 'link',
					'description'	=> __( 'The text slug page link for your page Reviews. (e.g: http://wpopaldemo.com/jets/<span style="color:red;" >reviews-customer</span>/)<br> the <span style="color:red;" >reviews-customer</span> is slug name', 'custom-rich-reviews' ),
					'value'		   => esc_html('reviews-customer'),
				),

		   )
		);

		//=======================================================================


		$maps = apply_filters( 'custom_rich_reviews_element_kingcomposer_map', $maps ); 
	    $kc->add_map( $maps );
	}

?>
