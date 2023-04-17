<?php
/**
 * Newsletter form for VC
 * Require Newsletter plugin to be installed
 *
 * @package Autosmart
 * @since   Autosmart 1.0
 */

if(class_exists('Newsletter')) {
    $forms = array_filter( (array) get_option( 'newsletter_forms', array() ) );

    $forms_list = array(
        esc_html__( 'Default Form', 'consultivo' ) => 'default'
    );

    if ( $forms )
    {
        $index = 1;
        foreach ( $forms as $key => $form )
        {
            $forms_list[ sprintf( esc_html__( 'Form %s', 'consultivo' ), $index ) ] = $key;
            $index ++;
        }
    }

    vc_map(array(
        "name" => 'Newsletter',
        "base" => "fr_newsletter",
        "icon" => "cs_icon_for_vc",
        'description' => esc_html__( 'Newsletter Form', 'consultivo' ),
        "category" => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
        "params" => array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Newsletter Form', 'consultivo' ),
                'description' => esc_html__( 'Pick default or custom forms from Newsletter Plugin.', 'consultivo' ),
                'value'       => $forms_list,
                'admin_label' => true,
                'param_name'  => 'form'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__( 'Title', 'consultivo' ),
                "param_name" => "nl_title",
                'admin_label' => true,
                "value" => 'STAY IN TOUCH',
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__( 'Introduction', 'consultivo' ),
                "param_name" => "introduction",
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__( 'Link text', 'consultivo' ),
                "param_name" => "nl_link_text",
                "value" => 'See our Privacy Policy',
            ),
            array(
                "type" => "vc_link",
                "heading" => esc_html__( 'Link Url', 'consultivo' ),
                "param_name" => "nl_link_url",
            ),
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Introduction Color", 'consultivo'),
                "param_name" => "introduction_color",
                "value" => "",
            ),
             array(
                "type" => "textfield",
                "heading" => esc_html__( "Extra class name", "consultivo" ),
                "param_name" => "el_class",
                "description" => esc_html__( "Style particular content element differently - add a class name and refer to it in Custom CSS.", "consultivo" ),
            ),
            array(
                'type' => 'animation_style',
                'heading' => esc_html__( 'Animation Style', 'consultivo' ),
                'param_name' => 'animation',
                'description' => esc_html__( 'Choose your animation style', 'consultivo' ),
                'admin_label' => false,
                'weight' => 0,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Element Parallax', 'consultivo'),
                'param_name' => 'el_parallax',
                'value' => array(
                    'No' => 'false',
                    'Yes' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Parallax Speed', 'consultivo' ),
                'param_name' => 'el_parallax_speed',
                'value' => '',
                'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'consultivo' ),
                'dependency' => array(
                    'element'=>'el_parallax',
                    'value'=>array(
                        'true',
                    )
                ),
            ),
        )
    ));

    class WPBakeryShortCode_fr_newsletter extends CmsShortCode
    {

        protected function content($atts, $content = null)
        {
            return parent::content($atts, $content);
        }
    }
}
?>