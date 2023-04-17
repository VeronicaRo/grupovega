<?php
$args = array(
    'name' => 'Testimonial Carousel',
    'base' => 'fr_testimonial_carousel',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_testimonial_carousel',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'group' => esc_html__('Template', 'consultivo'),
            'std' => 'fr_testimonial_carousel.php'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Arrows Style', 'consultivo'),
            'param_name' => 'arrow_style',
            'value' => array(
                'Bassic' => 'arrow-bassic',
                'Primary White' => 'arrow-primary-white',
            ),
            'group' => esc_html__('Carousel Settings', 'consultivo'),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_testimonial_carousel.php',
                )
            ),
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
            'heading' => esc_html__( 'Testimonial Item', 'consultivo' ),
            'param_name' => 'testimonial_item',
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_testimonial_carousel.php',
                    'fr_testimonial_carousel--layout1.php',
                )
            ),
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'consultivo' ),
                    'param_name' => 'image',
                    'description' => esc_html__( 'Select image from media library.', 'consultivo' ),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Content', 'consultivo'),
                    'param_name' => 'content',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Title', 'consultivo'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Position', 'consultivo'),
                    'param_name' => 'position',
                    'admin_label' => true,
                ),
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Title Color', 'consultivo'),
            'param_name' => 'title_color',
            'value' => '',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Position Color', 'consultivo'),
            'param_name' => 'position_color',
            'value' => '',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Content Color', 'consultivo'),
            'param_name' => 'content_color',
            'value' => '',
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Content Icon', 'consultivo' ),
            'param_name' => 'content_icon',
            'value' => '',
            'description' => esc_html__( 'Select Image from library.', 'consultivo' ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Background Icon', 'consultivo' ),
            'param_name' => 'background_icon',
            'value' => '',
            'description' => esc_html__( 'Select Image from library.', 'consultivo' ),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_testimonial_carousel.php',
                )
            ),
        ),

    ));

$args = consultivo_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_fr_testimonial_carousel extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>