<?php  
add_action( 'customize_register',  'jets_register_service_customizer',99);
function jets_register_service_customizer( $wp_customize ){
    $wp_customize->add_panel( 'panel_opalservice', array(
        'priority' => 70,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Opal Services', 'jets' ),
        'description' =>esc_html__( 'Make default setting for page, general', 'jets' ),
    ) );
    //============================================================================
    // Sidebar for Archive Service 
    //============================================================================    
    

    /**
     * Archive Setting
     */
    $wp_customize->add_section( 'archive_service_settings', array(
        'priority' => 11,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Archive & Categgory Setting', 'jets' ),
        'description' => '',
        'panel' => 'panel_opalservice',
    ) );


    //sidebar archive left
    $wp_customize->add_setting( 'wpopal_theme_options[service-achive-page-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '',
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Wpopal_Themer_Sidebar_DropDown( $wp_customize,  'wpopal_theme_options[service-achive-page-left-sidebar]', array(
        'settings'  => 'wpopal_theme_options[service-achive-page-left-sidebar]',
        'label'     => esc_html__('Left Sidebar', 'jets'),
        'section'   => 'archive_service_settings' ,
         'priority' => 3
    ) ) );

      //sidebar archive right
    $wp_customize->add_setting( 'wpopal_theme_options[service-achive-page-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '',
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Wpopal_Themer_Sidebar_DropDown( $wp_customize,  'wpopal_theme_options[service-achive-page-right-sidebar]', array(
        'settings'  => 'wpopal_theme_options[service-achive-page-right-sidebar]',
        'label'     => esc_html__('Right Sidebar', 'jets'),
        'section'   => 'archive_service_settings',
         'priority' => 4 
    ) ) );



    //============================================================================
        // Sidebar for Single Service 
    //============================================================================

    /**
     * Single Page Setting
     */
    $wp_customize->add_section( 'service_single_settings', array(
        'priority' => 11,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Single Service Page Setting', 'jets' ),
        'description' => 'Configure Service page setting',
        'panel' => 'panel_opalservice',
    ) );



    //sidebar single left
    $wp_customize->add_setting( 'wpopal_theme_options[service-page-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '',
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Wpopal_Themer_Sidebar_DropDown( $wp_customize,  'wpopal_theme_options[service-page-left-sidebar]', array(
        'settings'  => 'wpopal_theme_options[service-page-left-sidebar]',
        'label'     => esc_html__('Left Sidebar', 'jets'),
        'section'   => 'service_single_settings' ,
         'priority' => 3
    ) ) );

      //sidebar single right
    $wp_customize->add_setting( 'wpopal_theme_options[service-page-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '',
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Wpopal_Themer_Sidebar_DropDown( $wp_customize,  'wpopal_theme_options[service-page-right-sidebar]', array(
        'settings'  => 'wpopal_theme_options[service-page-right-sidebar]',
        'label'     => esc_html__('Right Sidebar', 'jets'),
        'section'   => 'service_single_settings',
         'priority' => 4 
    ) ) );

}

/**
* Get Configuration for Page Layout
*
*/
function jets_fnc_get_single_page_service_sidebar_configs( $configs='' ){

global $post; 

$left  =  jets_fnc_theme_options( 'service-page-left-sidebar' ); 
$right =  jets_fnc_theme_options( 'service-page-right-sidebar' ); 

return jets_fnc_get_layout_configs( $left, $right);
}
add_filter( 'jets_fnc_get_single_service_sidebar_configs', 'jets_fnc_get_single_page_service_sidebar_configs', 1, 1 );
/**
* Get Configuration for Page Layout
*
*/
function jets_fnc_get_achive_page_service_sidebar_configs( $configs='' ){

global $post; 

$left  =  jets_fnc_theme_options( 'service-achive-page-left-sidebar' ); 
$right =  jets_fnc_theme_options( 'service-achive-page-right-sidebar' ); 

return jets_fnc_get_layout_configs( $left, $right);
}
add_filter( 'jets_fnc_get_archive_service_sidebar_configs', 'jets_fnc_get_achive_page_service_sidebar_configs', 1, 1 );


