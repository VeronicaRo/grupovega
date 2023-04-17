<?php
$args = array(
    'name' => 'Client Carousel',
    'base' => 'fr_client_carousel',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(

        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_client_carousel',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'group' => esc_html__('Template', 'consultivo'),
            'std' => 'fr_client_carousel.php'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'consultivo' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'consultivo' ),
            'group'            => esc_html__('Template', 'consultivo')
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation Style', 'consultivo' ),
            'param_name' => 'animation',
            'description' => esc_html__( 'Choose your animation style', 'consultivo' ),
            'admin_label' => false,
            'weight' => 0,
            'group' => esc_html__('Template', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element Parallax', 'consultivo'),
            'param_name' => 'el_parallax',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            'group' => esc_html__('Template', 'consultivo'),
        ),
        array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Parallax Speed', 'consultivo' ),
                'param_name' => 'el_parallax_speed',
                'value' => '',
                'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'consultivo' ),
                'group' => esc_html__('Template', 'consultivo'),
                'dependency' => array(
                    'element'=>'el_parallax',
                    'value'=>array(
                        'true',
                    )
                ),
            ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Client Item', 'consultivo' ),
            'value' => '',
            'param_name' => 'client_item',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'consultivo' ),
                    'param_name' => 'image',
                    'value' => '',
                    'description' => esc_html__( 'Select image from media library.', 'consultivo' ),
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Link', 'consultivo' ),
                    'param_name' => 'link',
                    'value' => '',
                    'admin_label' => true,
                ),
            ),
        ),

    ));

$args = consultivo_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_fr_client_carousel extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>