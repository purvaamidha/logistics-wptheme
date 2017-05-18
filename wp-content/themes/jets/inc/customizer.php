<?php

add_action( 'customize_register', 'jets_fnc_theme_cst_customizer' );

function jets_fnc_theme_cst_customizer($wp_customize){

	$wp_customize->add_setting('wpopal_theme_options[location]', array(
        'default'    => 'Vaishali, India',
        'type'       => 'option',
        'transport'=>'refresh',
         'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'wpopal_theme_options[location]', array(
        'label'    => esc_html__('Location ', 'jets'),
        'section'  => 'pbr_cst_general_settings',
        'settings' => 'wpopal_theme_options[location]',
        'priority' => 14,
    ) );

    $wp_customize->add_setting('wpopal_theme_options[working-days]', array(
        'default'    => 'Mon-Sat: 8.00 - 18.00',
        'type'       => 'option',
        'transport'=>'refresh',
         'sanitize_callback' => 'wpopal_themer_fnc_sanitize_textarea',
    ) );

    $wp_customize->add_control( new Wpopal_Themer_PBRTextAreaControl( $wp_customize, 'wpopal_theme_options[working-days]', array(
        'label'    => esc_html__('Working Days', 'jets'),
        'section'  => 'pbr_cst_general_settings',
        'settings' => 'wpopal_theme_options[working-days]',
        'priority' => 15,
    ) ) );


    $wp_customize->add_setting('wpopal_theme_options[hotline]', array(
        'default'    => '9821888916',
        'type'       => 'option',
        'transport'=>'refresh',
         'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'wpopal_theme_options[hotline]', array(
        'label'    => esc_html__('Hot Line ', 'jets'),
        'section'  => 'pbr_cst_general_settings',
        'settings' => 'wpopal_theme_options[hotline]',
        'priority' => 16,
    ) );


    $wp_customize->add_setting('wpopal_theme_options[email]', array(
        'default'    => 'info@moverdeal.com',
        'type'       => 'option',
        'transport'=>'refresh',
         'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'wpopal_theme_options[email]', array(
        'label'    => esc_html__('Email ', 'jets'),
        'section'  => 'pbr_cst_general_settings',
        'settings' => 'wpopal_theme_options[email]',
        'priority' => 17,
    ) );


    $wp_customize->add_setting('wpopal_theme_options[text-header]', array(
        'default'    => 'Providing Moving & Strorage Services',
        'type'       => 'option',
        'transport'=>'refresh',
         'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'wpopal_theme_options[text-header]', array(
        'label'    => esc_html__('Text Header ', 'jets'),
        'section'  => 'pbr_cst_general_settings',
        'settings' => 'wpopal_theme_options[text-header]',
        'priority' => 18,
    ) );

}