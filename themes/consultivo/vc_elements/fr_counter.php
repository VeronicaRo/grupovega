<?php
vc_map(array(
    'name' => 'Counter',
    'base' => 'fr_counter',
    'icon' => 'cs_icon_for_vc',
    'class' => 'cms-vc-icon',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(

        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_counter',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'group' => esc_html__('Template', 'consultivo'),
            'std' => 'fr_counter.php'
        ),
        /* Title */
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Title', 'consultivo'),
            'param_name' => 'title',
            'description' => 'Enter title.',
            'admin_label' => true,
            'group' => esc_html__('Title', 'consultivo'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'consultivo'),
            'param_name' => 'title_color',
            'value' => '',
            'group' => esc_html__('Title', 'consultivo'),
        ),
        /* Digit */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Digit', 'consultivo'),
            'param_name' => 'digit',
            'description' => 'Enter digit.',
            'admin_label' => true,
            'group' => esc_html__('Digit', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Prefix', 'consultivo'),
            'param_name' => 'prefix',
            'description' => 'Enter prefix.',
            'group' => esc_html__('Digit', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Suffix', 'consultivo'),
            'param_name' => 'suffix',
            'description' => 'Enter suffix.',
            'group' => esc_html__('Digit', 'consultivo'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'consultivo'),
            'param_name' => 'digit_color',
            'value' => '',
            'group' => esc_html__('Digit', 'consultivo'),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Use Grouping', 'consultivo'),
            'param_name' => 'grouping',
            'value' => array(
                'No' => '0',
                'Yes' => '1',
            ),
            'group' => esc_html__('Digit', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Separator', 'consultivo'),
            'param_name' => 'separator',
            'group' => esc_html__('Digit', 'consultivo'),
            'dependency' => array(
                'element'=>'grouping',
                'value'=>array(
                    '1',
                )
            ),
        ),
        /* Icon */
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Library', 'consultivo' ),
            'value' => array(
                esc_html__( 'Medical Icon', 'consultivo' ) => 'medicalicon',
                esc_html__( 'Font Awesome', 'consultivo' ) => 'fontawesome',
            ),
            'param_name' => 'icon_list',
            'description' => esc_html__( 'Select icon library.', 'consultivo' ),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_counter--layout1.php',
                )
            ),
            'group' => esc_html__('Icon', 'consultivo'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon Medical', 'consultivo' ),
            'param_name' => 'icon_medicalicon',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'medicalicon',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'medicalicon',
            ),
            'description' => esc_html__( 'Select icon from library.', 'consultivo' ),
            'group' => esc_html__('Icon', 'consultivo'),
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
            'group' => esc_html__('Icon', 'consultivo'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon Color', 'consultivo'),
            'param_name' => 'icon_color',
            'value' => '',
            'group' => esc_html__('Icon', 'consultivo'),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_counter--layout1.php',
                )
            ),
        ),
        /* Extra */
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'consultivo' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'consultivo' ),
            'group'            => esc_html__('Extra', 'consultivo')
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation Style', 'consultivo' ),
            'param_name' => 'animation',
            'description' => esc_html__( 'Choose your animation style', 'consultivo' ),
            'admin_label' => false,
            'weight' => 0,
            'group' => esc_html__('Extra', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element Parallax', 'consultivo'),
            'param_name' => 'el_parallax',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            'group' => esc_html__('Extra', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax Speed', 'consultivo' ),
            'param_name' => 'el_parallax_speed',
            'value' => '',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'consultivo' ),
            'group' => esc_html__('Extra', 'consultivo'),
            'dependency' => array(
                'element'=>'el_parallax',
                'value'=>array(
                    'true',
                )
            ),
        ),
    )
));

class WPBakeryShortCode_fr_counter extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>