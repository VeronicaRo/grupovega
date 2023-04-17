<?php
vc_map(array(
    'name' => 'Fancy Box',
    'base' => 'fr_fancybox',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(

        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_fancybox',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'std' => 'fr_fancybox.php',
            'group' => esc_html__('Template', 'consultivo'),
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
        /*Number*/
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Number', 'consultivo'),
            'param_name' => 'number',
            'description' => 'Enter Number.',
            'group' => esc_html__('Number', 'consultivo'),
            'admin_label' => true,
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_fancybox--layout1.php',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Number Color', 'consultivo'),
            'param_name' => 'number_color',
            'value' => '',
            'group' => esc_html__('Number', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_fancybox--layout1.php',
                )
            ),
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
            'heading' => esc_html__('Text Color', 'consultivo'),
            'param_name' => 'title_color',
            'value' => '',
            'group' => esc_html__('Title', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Font Size', 'consultivo'),
            'param_name' => 'title_font_size',
            'description' => 'Enter ..px',
            'group' => esc_html__('Title', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Line Height', 'consultivo'),
            'param_name' => 'title_line_height',
            'description' => 'Enter ..px',
            'group' => esc_html__('Title', 'consultivo'),
        ),
        /* Sub title */
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Subtitle', 'consultivo'),
            'param_name' => 'subtitle',
            'description' => 'Enter Subtitle.',
            'admin_label' => true,
            'group' => esc_html__('Subtitle', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_fancybox--layout1.php',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'consultivo'),
            'param_name' => 'subtitle_color',
            'value' => '',
            'group' => esc_html__('Subtitle', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_fancybox--layout1.php',
                )
            ),
        ),
        /* Description */
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Description', 'consultivo'),
            'param_name' => 'description',
            'description' => 'Enter description.',
            'admin_label' => true,
            'group' => esc_html__('Description', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_fancybox.php',
                    'fr_fancybox--layout1.php',
                    'fr_fancybox--layout2.php',
                    'fr_fancybox--layout4.php',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Description Color', 'consultivo'),
            'param_name' => 'description_color',
            'value' => '',
            'group' => esc_html__('Description', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_fancybox.php',
                    'fr_fancybox--layout1.php',
                    'fr_fancybox--layout2.php',
                    'fr_fancybox--layout4.php',
                )
            ),
        ),

        /* Button */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Button Text', 'consultivo'),
            'param_name' => 'btn_text',
            'group' => esc_html__('Button', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_fancybox--layout1.php',
                )
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Button Link', 'consultivo'),
            'param_name' => 'btn_link',
            'group' => esc_html__('Button', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_fancybox--layout1.php',
                )
            ),
        ),

        /* Icon */
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Library', 'consultivo' ),
            'value' => array(
                esc_html__( 'Image Icon', 'consultivo' ) => 'image_icon',
                esc_html__( 'Font Awesome', 'consultivo' ) => 'fontawesome',
                esc_html__( 'El Icon', 'consultivo' ) => 'el_icon',
            ),
            'param_name' => 'icon_list',
            'description' => esc_html__( 'Select icon library.', 'consultivo' ),
            'group' => esc_html__('Icon', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_fancybox.php',
                    'fr_fancybox--layout2.php',
                    'fr_fancybox--layout3.php',
                    'fr_fancybox--layout4.php',
                )
            ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image', 'consultivo' ),
            'param_name' => 'image_icon',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'consultivo' ),
            'group' => esc_html__('Icon', 'consultivo'),
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
            'group' => esc_html__('Icon', 'consultivo'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'El Icon', 'consultivo' ),
            'param_name' => 'el_icon',
            'value' => '',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'consulicon',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'el_icon',
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
                'element' => 'icon_list',
                'value' => array(
                    'fontawesome',
                    'el_icon',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Icon Font Size', 'consultivo'),
            'param_name' => 'icon_font_size',
            'group' => esc_html__('Icon', 'consultivo'),
            'description' => 'Enter ..px',
            'dependency' => array(
                'element' => 'icon_list',
                'value' => array(
                    'fontawesome',
                    'el_icon',
                )
            ),
        )
    )
));

class WPBakeryShortCode_fr_fancybox extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>