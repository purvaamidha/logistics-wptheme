<?php

/**
 * Load woocommerce styles follow theme skin actived
 *
 * @static
 * @access public
 * @since Wpopal_Themer 1.0
 */
function jets_template_main_content_class( ){
	return function_exists( 'kc_is_using' ) && kc_is_using() ? 'container-full' : 'container';
}
add_filter( 'jets_template_page_main_container_class', 'jets_template_page_main_container_class' );
/// put your code here


add_action('init', 'jets_kc_add_map_param', 99 );
function jets_kc_add_map_param(){
    global $kc;
    $kc->add_map_param(
		'element_pricing_table',
			array(
				"type" => "attach_image",
				"label" => esc_html__("Photo", 'jets'),
				"name" => "featured_image",
				"value" => '',
				'description' => ''
			)
		, 5);

	$kc->add_map_param(
		'element_pricing_table',
		array(
			'type'			=> 'textarea',
			'label'			=> esc_html__( 'Description', 'jets' ),
			'name'			=> 'description',
			'description'	=> esc_html__( 'The text description for your page.', 'jets' ),
			'value'		    => '',
		)
	, 6);

	//$kc->remove_map_param( 'element_pricing_table', 'subtitle');



	//// 
	$maps = array();
	
	// Give-Report
 		$maps['element_give_report'] =  array(
				"name"        => esc_html__("Give Report", 'jets'),
				"class"       => "",
				"description" => 'Show The Money Goes',
				"category"    => esc_html__('Elements', 'jets'),
				"icon"        => 'cpicon sl-paper-plane',
				"params"      => array(
				// start param
				array(
					'type'			=> 'group',
					'label'			=> esc_html__('Options', 'jets'),
					'name'			=> 'options',
					'description'	=> esc_html__( 'Repeat this fields with each item created, Each item corresponding Pie element.', 'jets' ),
					'options'		=> array('add_text' => esc_html__('Add new Pie and doughnut charts', 'jets')),
					'value' => '',
					'params' => array(
						array(
							'type' => 'number_slider',
							'label' => esc_html__( 'Value', 'jets' ),
							'name' => 'value',
							'description' => esc_html__( 'Enter targeted value of the bar (From 1 to 100).', 'jets' ),
							'admin_label' => true,
							'options' 		=> array(
								'min'		=> 1,
								'max'		=> 100,
							),
							'value' => '80'
						),
						array(
							'type' => 'color_picker',
							'label' => esc_html__( 'Value Color', 'jets' ),
							'name' => 'value_color',
							'description' => esc_html__( 'Color of targeted value text.', 'jets' ),
						),
						array(
							'type' => 'text',
							'label' => esc_html__( 'Label', 'jets' ),
							'name' => 'label',
							'description' => esc_html__( 'Enter text used as title of the bar.', 'jets' ),
							'admin_label' => true,
						),
					),
				),
				// end param
				array(
					"type"        => "textfield",
					"label"       => esc_html__("Wrapper class", 'jets'),
					"name"        => "wrap_class",
					"value"       => '',
					"admin_label" => true
				),
			  )
		);


	$maps['element_block_heading'] =  array(

			"name"        => esc_html__("Block Heading", 'jets'),
			"class"       => "",
			"description" => esc_html__( 'Display Block Heading', 'jets' ),
			"category"    => esc_html__('Elements', 'jets'),
			"icon"        => 'kc-icon-title',
			"params"      => array(

	    	array(
				"type"        => "textfield",
				"label"       => esc_html__("Heading", 'jets'),
				"name"        => "heading",
				"value"       => '',
				"admin_label" => true
			),
			array(
				"type"        => "textfield",
				"label"       => esc_html__("Sub Heading", 'jets'),
				"name"        => "subheading",
				"value"       => '',
				"admin_label" => true
			),
			array(
				"type" => "select",
				"label" => esc_html__("Style", 'jets'),
				"name" => "style",
				'options' 	=> array( 
					'style-v1' => esc_html__('No style', 'jets'), 
					'style-v2' => esc_html__('Style left', 'jets'),
					'style-v3' => esc_html__('Style center', 'jets'),
					'style-v4' => esc_html__('Style Light center', 'jets'),
					'style-v5' => esc_html__('Style Light left', 'jets')
				),
			),
		  )
	);
	$maps['element_timelife'] =  array(
     
        'name' => esc_html__('TimeLife', 'jets'),
        'description' => esc_html__('', 'jets'),
        'icon' => 'kc-icon-progress',
        'category' => 'Content',
        'css_box' => true,
        'params' => array(
     
            array(
                'type'            => 'text',
                'label'            => esc_html__( 'Title', 'jets' ),
                'name'            => 'title',
                'description'    => esc_html__( 'This is text title. Leave blank if no title is needed.', 'jets' ),
                'admin_label'    => true,
            ),
            array(
                'type'            => 'group',
                'label'            => esc_html__('Options', 'jets'),
                'name'            => 'options',
                'description'    => esc_html__( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'jets' ),
                'options'        => array('add_text' => esc_html__('Add new progress bar', 'jets')),
                'params' => array(
                    array(
                        'type' => 'text',
                        'label' => esc_html__( 'Year', 'jets' ),
                        'name' => 'year',
                        'description' => esc_html__( 'Enter value of bar.', 'jets' ),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => esc_html__( 'Day', 'jets' ),
                        'name' => 'day',
                        'description' => esc_html__( 'Enter text used as title of bar.', 'jets' ),
                        'admin_label' => true,
                    ),
                    
           			array(
                        'type' => 'text',
                        'label' => esc_html__( 'Title', 'jets' ),
                        'name' => 'title',
                        'description' => esc_html__( 'Enter text used as title of bar.', 'jets' ),
                        'admin_label' => false,
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => esc_html__( 'Content', 'jets' ),
                        'name' => 'content',
                        'description' => esc_html__( 'Enter text used as title of bar.', 'jets' ),
                        'admin_label' => false,
                    ),

                ),
            )
        )
     
    );
	$kc->add_map( $maps ); 
	///

} 