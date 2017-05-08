<?php 

	add_action('init', 'opalrequestquote_element_kingcomposer_map', 99 );
 
	function opalrequestquote_element_kingcomposer_map(){
		global $kc;

		$maps = array();

		//=======================================================================

		$maps['element_requestquote_short'] =  array(
		    'name' => esc_html__('Request Quote Short ', 'opalrequestquote'),
		    'icon' => 'kc-icon-post',
		    'description' => 'Show Request Quote Short Form Info',
		    'category' => esc_html__('Elements', 'opalrequestquote'),
		    'params' => array(
		    	array(
					'type'        => 'text',
					'label'       => esc_html__('Title', 'opalrequestquote'),
					'name'        => 'title',
					'description' => __( 'The title of the request quote.', 'opalrequestquote' ),
					'value'	      => __( 'Requestquote a Form', 'opalrequestquote' ),
					'admin_label' => true
				),

				array(
					'type'			=> 'textarea',
					'label'			=> __( 'Description', 'opalrequestquote' ),
					'name'			=> 'description',
					'description'	=> __( 'The text description for your page.', 'opalrequestquote' ),
					'value'		    => esc_html__('The Description'),
				),

				array(
					'type'			=> 'select',
					'label'			=> __( 'Description', 'opalrequestquote' ),
					'name'			=> 'layout',
					'description'	=> __( 'The text description for your page.', 'opalrequestquote' ),
					'value'		    => esc_html__('The Description'),
					'options'		=> array(
							'layout1' => esc_html__('Layout 1 Vertical', 'opalrequestquote'),
							'layout2' => esc_html__('Layout 2 Horizontal', 'opalrequestquote'),
							'layout3' => esc_html__('Layout 3 Horizontal2', 'opalrequestquote'),
						),
				),

		   )
		);

		$maps = apply_filters( 'opalrequestquote_element_kingcomposer_map', $maps ); 
	    $kc->add_map( $maps );
	}

?>
