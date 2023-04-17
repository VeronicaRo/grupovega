<?php
$args = array(
    'name' => 'Price Column',
    'base' => 'fr_price',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        /* Template */
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
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon', 'consultivo' ),
            'value' => array(
                esc_html__( 'Image Icon', 'consultivo' ) => 'image_icon',
                esc_html__( 'Font Awesome', 'consultivo' ) => 'fontawesome',
            ),
            'param_name' => 'icon_list',
            'description' => esc_html__( 'Select icon library.', 'consultivo' ),
            'group' => esc_html__('General', 'consultivo'),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image', 'consultivo' ),
            'param_name' => 'image_icon',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'consultivo' ),
            'group' => esc_html__('General', 'consultivo'),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'image_icon',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon FontAwesome', 'consultivo' ),
            'param_name' => 'icon_fontawesome',
            'value' => '',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'fontawesome',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__( 'Select icon from library.', 'consultivo' ),
            'group' => esc_html__('General', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'consultivo' ),
            'param_name' => 'title',
            'group' => esc_html__('General', 'consultivo'),
            'admin_label' => true,
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Currency Icon', 'consultivo' ),
            'param_name' => 'currency_icon',
            'group' => esc_html__('General', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Price', 'consultivo' ),
            'param_name' => 'price',
            'group' => esc_html__('General', 'consultivo'),
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Text', 'consultivo' ),
            'param_name' => 'text',
            'group' => esc_html__('General', 'consultivo'),
            'admin_label' => true,
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Button text', 'consultivo' ),
            'param_name' => 'button_text',
            'group' => esc_html__('General', 'consultivo'),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Button link', 'consultivo' ),
            'param_name' => 'button_link',
            'group' => esc_html__('General', 'consultivo'),
        ),
    ));
vc_map($args);

class WPBakeryShortCode_fr_price extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>