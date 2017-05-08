<?php 

	add_action('init', 'opalservice_element_kingcomposer_map', 99 );
 
	function opalservice_element_kingcomposer_map(){
		global $kc;

		$maps = array();

		 

		//=======================================================================
		$maps['element_service_list_service'] =  array(
		    'name' => esc_html__('List Services', 'opalservice'),
		    'icon' => 'kc-icon-post',
		    'description' => 'Show Listing Service Info',
		    'category' => esc_html__('Elements', 'opalservice'),
		    'params' => array(
		    	array(
					'type'        => 'text',
					'label'       => esc_html__('Title', 'opalservice'),
					'name'        => 'title',
					'description' => __( 'The title of the Service List.', 'opalservice' ),
					'value'	     => __( 'List Service', 'opalservice' ),
					'admin_label' => true
				),

				array(
					'type'			=> 'textarea',
					'label'			=> __( 'Description', 'opalservice' ),
					'name'			=> 'description',
					'description'	=> __( 'The text description for your page.', 'opalservice' ),
					'value'		   => base64_encode('The Description'),
				),

				array(
					'type'        => 'multiple',
					'label'       => __( 'By Categories', 'opalservice' ),
					'name'        => 'category',
					'description' => __( 'Layout of the page', 'opalservice' ),
					'admin_label' => true,
					'options'     => CategoryService_OptionArray(),
				),

				array(
					'type'        => 'dropdown',
					'label'       => __( 'Column', 'opalservice' ),
					'name'        => 'column',
					'description' => __( 'Number column of the page', 'opalservice' ),
					'admin_label' => true,
					'options'     => array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6)
				),

				array(
					'type'        => 'dropdown',
					'label'       => __( 'Layouts', 'opalservice' ),
					'name'        => 'layout',
					'description' => __( 'Layout of the page', 'opalservice' ),
					'admin_label' => true,
					'options'     => array(
						'grid_v1'       => 'Grid_V1 (Default)',
						'grid_v2'       => 'Grid_v2 (Absolute Elements)',
						'grid_v3'       => 'Grid_v3 (Show Icon)',
					)
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__('Limit', 'opalservice'),
					'name'        => 'limit',
					'description' => __( 'Number Limit of the page.', 'opalservice' ),
					'value'	     => __( '4', 'opalservice' ),
					'admin_label' => true
				),

				

				array(
					'type'        => 'dropdown',
					'label'       => __( 'Image Size', 'opalservice' ),
					'name'        => 'image_size',
					'description' => __( 'Thumbnail (default 150px x 150px max)<br>Medium resolution (default 300px x 300px max)<br>Large resolution (default 640px x 640px max)<br>Full resolution (original size uploaded)<br>Other resolutions', 'opalservice' ),
					'admin_label' => true,
					'options'     => array(
						'thumbnail'      	=> 'Thumbnail',
						'medium'          	=> 'Medium',
						'large'          	=> 'Large',
						'full'          	=> 'Full',
						'other'          	=> 'Other size',
					)
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__('Other Image Size', 'opalservice'),
					'name'        => 'other_size',
					'description' => __( 'the set Image size for all image service , example: 150x150. is width = 150px and height = 150px', 'opalservice' ),
					'value'	     => __( '150x150', 'opalservice' ),
					'admin_label' => true,
					'relation'	=> array(
						'parent'	=> 'image_size',
						'show_when'	=> 'other'
					),
				),
				
				array(
					'type'        => 'text',
					'label'       => esc_html__('Description Max Chars', 'opalservice'),
					'name'        => 'max_char',
					'description' => __( 'the set number max character for description service', 'opalservice' ),
					'value'	     => __( '10', 'opalservice' ),
					'admin_label' => true
				),

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Show Category', 'opalservice' ),
					'name'        => 'show_category',
					'description' => __( 'Show the Category of the page.', 'opalservice' ),
					'options'     => array(
						'yes' => __('Yes, Please!', 'opalservice'),
					)
				), 

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Show Button Read More', 'opalservice' ),
					'name'        => 'show_readmore',
					'description' => __( 'Show button Read More of the page.', 'opalservice' ),
					'options'     => array(
						'yes' => __('Yes, Please!', 'opalservice'),
					),
				), 

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Show Description', 'opalservice' ),
					'name'        => 'show_description',
					'description' => __( 'Show the Description of the page.', 'opalservice' ),
					'options'     => array(
						'yes' => __('Yes, Please!', 'opalservice'),
					)
				),

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Show Thumbnail', 'opalservice' ),
					'name'        => 'show_thumbnail',
					'description' => __( 'Show the Thumbnail of the page.', 'opalservice' ),
					'options'     => array(
						'yes' => __('Yes, Please!', 'opalservice'),
					),
				),
				

		   )
		);
		
		//=======================================================================

		$maps['element_service_carousel_service'] =  array(
		    'name' => esc_html__('Service Carousel Service', 'opalservice'),
		    'icon' => 'kc-icon-pcarousel',
		    'description' => 'Show list carousel service Info',
		    'category' => esc_html__('Elements', 'opalservice'),
		    'params' => array(
		    	array(
					'type'        => 'text',
					'label'       => esc_html__('Title', 'opalservice'),
					'name'        => 'title',
					'description' => __( 'The title of the Service List.', 'opalservice' ),
					'value'	     => __( 'List Service', 'opalservice' ),
					'admin_label' => true
				),

				array(
					'type'			=> 'textarea',
					'label'			=> __( 'Description', 'opalservice' ),
					'name'			=> 'description',
					'description'	=> __( 'The text description for your page.', 'opalservice' ),
					'value'		   => base64_encode('The Description'),
				),

				array(
					'type'        => 'multiple',
					'label'       => __( 'By Categories', 'opalservice' ),
					'name'        => 'category',
					'description' => __( 'Layout of the page', 'opalservice' ),
					'admin_label' => true,
					'options'     => CategoryService_OptionArray(),
				),

				array(
					'type' 		  => 'number_slider',  // USAGE RADIO TYPE
					'label'       => __( 'Column', 'opalservice' ),
					'name'        => 'column',
					'description' => __( 'Number column of the page', 'opalservice' ),
					'admin_label' => true,
				   'options' => array(    // REQUIRED
				        'min' => 1,
				        'max' => 6,
				        'unit' => '',
				        'show_input' => false
				    ),
				),

				array(
					'type'        => 'number_slider',
					'label'       => esc_html__('Limit', 'opalservice'),
					'name'        => 'limit',
					'description' => __( 'Number Limit of the page.', 'opalservice' ),
					'value'	     => __( '4', 'opalservice' ),
					'admin_label' => true,
					'options' => array(    // REQUIRED
				        'min' => 1,
				        'max' => 20,
				        'unit' => '',
				        'show_input' => false
				    ),
				),

				array(
					'type'        => 'dropdown',
					'label'       => __( 'Image Size', 'opalservice' ),
					'name'        => 'image_size',
					'description' => __( 'Thumbnail (default 150px x 150px max)<br>Medium resolution (default 300px x 300px max)<br>Large resolution (default 640px x 640px max)<br>Full resolution (original size uploaded)<br>Other resolutions', 'opalservice' ),
					'admin_label' => true,
					'options'     => array(
						'thumbnail'      	=> 'Thumbnail',
						'medium'          => 'Medium',
						'large'          	=> 'Large',
						'full'          	=> 'Full',
						'other'          	=> 'Other size',
					)
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__('Other Image Size', 'opalservice'),
					'name'        => 'other_size',
					'description' => __( 'the set Image size for all image service , example: 150x150. is width = 150px and height = 150px', 'opalservice' ),
					'value'	     => __( '150x150', 'opalservice' ),
					'admin_label' => true,
					'relation'	=> array(
						'parent'	=> 'image_size',
						'show_when'	=> 'other'
					),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__('Description Max Chars', 'opalservice'),
					'name'        => 'max_char',
					'description' => __( 'the set number max character for description service', 'opalservice' ),
					'value'	     => __( '10', 'opalservice' ),
					'admin_label' => true
				),

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Show Category', 'opalservice' ),
					'name'        => 'show_category',
					'description' => __( 'Show the Category of the page.', 'opalservice' ),
					'options'     => array(
						'yes' => __('Yes, Please!', 'opalservice'),
					)
				),

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Show Button Read More', 'opalservice' ),
					'name'        => 'show_readmore',
					'description' => __( 'Show button Read More of the page.', 'opalservice' ),
					'options'     => array(
						'yes' => __('Yes, Please!', 'opalservice'),
					)
				), 
					
				array(
					'type'        => 'checkbox',
					'label'       => __( 'Show Description', 'opalservice' ),
					'name'        => 'show_description',
					'description' => __( 'Show the Description of the page.', 'opalservice' ),
					'options'     => array(
						'yes' => __('Yes, Please!', 'opalservice'),
					)
				),

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Show Thumbnail', 'opalservice' ),
					'name'        => 'show_thumbnail',
					'description' => __( 'Show the Thumbnail of the page.', 'opalservice' ),
					'options'     => array(
						'yes' => __('Yes, Please!', 'opalservice'),
					)
				),
				// Owl Carousel Setting

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Enable Right To Left', 'opalservice' ),
					'name'        => 'enable_rtl',
					'options'     => array(
						'1' => __('Yes, Please!', 'opalservice'),
					)
				),
				array(
					'type'        => 'checkbox',
					'label'       => __( 'Enable Button Navigation', 'opalservice' ),
					'name'        => 'enable_navigation',
					'options'     => array(
						'1' => __('Yes, Please!', 'opalservice'),
					)
				),

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Enable Button Pagination', 'opalservice' ),
					'name'        => 'enable_pagination',
					'options'     => array(
						'1' => __('Yes, Please!', 'opalservice'),
					)
				),

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Enable Loop Carousel', 'opalservice' ),
					'name'        => 'enable_loop',
					'options'     => array(
						'1' => __('Yes, Please!', 'opalservice'),
					)
				),
				array(
					'type'        => 'checkbox',
					'label'       => __( 'Enable Mouse Drag', 'opalservice' ),
					'name'        => 'enable_mousedrag',
					'options'     => array(
						'1' => __('Yes, Please!', 'opalservice'),
					)
				),array(
					'type'        => 'checkbox',
					'label'       => __( 'Enable Touch Drag', 'opalservice' ),
					'name'        => 'enable_touchdrag',
					'options'     => array(
						'1' => __('Yes, Please!', 'opalservice'),
					)
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__('Slide By', 'opalservice'),
					'name'        => 'slide_by',
					'description' => __( 'Number Items will slide on a time. Default: 1', 'opalservice' ),
					'value'	     => __( '1', 'opalservice' ),
					'admin_label' => true
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__('Margin Each Items', 'opalservice'),
					'name'        => 'margin_item',
					'description' => __( 'Default 0', 'opalservice' ),
					'value'	     => __( '0', 'opalservice' ),
					'admin_label' => true
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__('Number Columns On Page (Default)', 'opalservice'),
					'name'        => 'default_items',
					'description' => __( 'Show number items when screen size between 1199px and 980px', 'opalservice' ),
					'admin_label' => true
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__('Number Columns On Page (Phones)', 'opalservice'),
					'name'        => 'mobile_items',
					'description' => __( 'Show number items when screen size bellow 480px', 'opalservice' ),
					'value'	     => __( '1', 'opalservice' ),
					'admin_label' => true
				),array(
					'type'        => 'text',
					'label'       => esc_html__('Number Columns On Page (Phones to Small tablets)', 'opalservice'),
					'name'        => 'tablet_small_items',
					'description' => __( 'Show number items when screen size between 641px and 480px', 'opalservice' ),
					'value'	     => __( '2', 'opalservice' ),
					'admin_label' => true
				),array(
					'type'        => 'text',
					'label'       => esc_html__('Number Columns On Page (Phones to tablets)', 'opalservice'),
					'name'        => 'tablet_items',
					'description' => __( 'Show number items when screen size between 768px and 641px', 'opalservice' ),
					'value'	     => __( '2', 'opalservice' ),
					'admin_label' => true
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__('Number Columns On Page (Portrait tablets)', 'opalservice'),
					'name'        => 'portrait_items',
					'description' => __( 'Show number items when screen size between 979px and 769px', 'opalservice' ),
					'value'	     => __( '3', 'opalservice' ),
					'admin_label' => true
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__('Number Columns On Page (Large display)', 'opalservice'),
					'name'        => 'large_items',
					'description' => __( 'Show number items when screen size 1200px and up', 'opalservice' ),
					'value'	     => __( '5', 'opalservice' ),
					'admin_label' => true
				),array(
					'type'        => 'text',
					'label'       => esc_html__('Custom Number Items with screen size', 'opalservice'),
					'name'        => 'custom_items',
					'description' => __( 'For example: [320, 1], [360, 1], [480, 1], [568, 2], [600, 2], [640, 2], [768, 2], [900, 3], [960, 3], [1024, 3] empty to disable', 'opalservice' ),
					'admin_label' => true
				),

				array(
					'type'        => 'checkbox',
					'label'       => __( 'Auto Play', 'opalservice' ),
					'name'        => 'autoplay',
					'description' => __( 'Show the Pagination of the page.', 'opalservice' ),
					'options'     => array(
						'1' => __('Yes, Please!', 'opalservice'),
					)
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__('Speed', 'opalservice'),
					'name'        => 'speed',
					'description' => __( 'Determines the duration of the transition in milliseconds.If less than 10, the number is interpreted as a speed (pixels/millisecond).This is probably desirable when scrolling items with variable sizes', 'opalservice' ),
					'admin_label' => true,
					'value'	     => __( '3000', 'opalservice' ),
				),

		   )
		);

		//=======================================================================


		$maps = apply_filters( 'opalservice_element_kingcomposer_map', $maps ); 
	    $kc->add_map( $maps );
	}
 

	/**
	* Get Array taxonomy category service
	*/
	function CategoryService_OptionArray()
	{
		$optionArray = array();
		$services = Opalservice_Query::getCategoryServices();
		foreach ($services as $service) {
			$optionArray[$service->slug] = $service->name;
		}
		return $optionArray;
	}



?>
