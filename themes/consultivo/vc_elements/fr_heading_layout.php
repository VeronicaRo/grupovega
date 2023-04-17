<?php
vc_map(array(
    'name' => 'Heading with layout',
    'base' => 'fr_heading_layout',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_heading_layout',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'std' => 'fr_heading_layout.php',
            'group' => esc_html__('Template', 'consultivo'),
        ),
        /* Extra */
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'consultivo' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'consultivo' ),
            'group'      => esc_html__('Template', 'consultivo'),
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
        /* Layout Settings */
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text align large', 'consultivo'),
            'param_name' => 'align_lg',
            'value' => array(
                'auto' => '',
                'center' => 'align-center',
                'left' => 'align-left',
                'right' => 'align-right',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text align medium', 'consultivo'),
            'param_name' => 'align_md',
            'value' => array(
                'auto' => '',
                'center' => 'align-center-md',
                'left' => 'align-left-md',
                'right' => 'align-right-md',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text align small', 'consultivo'),
            'param_name' => 'align_sm',
            'value' => array(
                'auto' => '',
                'center' => 'align-center-sm',
                'left' => 'align-left-sm',
                'right' => 'align-right-sm',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text align mini', 'consultivo'),
            'param_name' => 'align_xs',
            'value' => array(
                'auto' => '',
                'center' => 'align-center-xs',
                'left' => 'align-left-xs',
                'right' => 'align-right-xs',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        /* Data */
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Title', 'consultivo' ),
            'param_name' => 'title',
            'admin_label' => true,
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_heading_layout.php',
                    'fr_heading_layout--layout1.php',
                    'fr_heading_layout--layout2.php',
                    'fr_heading_layout--layout3.php',
                )
            ),
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Subtitle', 'consultivo' ),
            'param_name' => 'subtitle',
            'admin_label' => true,
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_heading_layout.php',
                    'fr_heading_layout--layout2.php',
                    'fr_heading_layout--layout3.php',
                )
            ),
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Text', 'consultivo' ),
            'param_name' => 'text',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_heading_layout.php',
                    'fr_heading_layout--layout1.php',
                )
            ),
        ),
        /* Options */
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Title Color', 'consultivo'),
            'param_name' => 'title_color',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_heading_layout.php',
                    'fr_heading_layout--layout1.php',
                    'fr_heading_layout--layout2.php',
                    'fr_heading_layout--layout3.php',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Subtitle Color', 'consultivo'),
            'param_name' => 'subtitle_color',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_heading_layout.php',
                    'fr_heading_layout--layout2.php',
                    'fr_heading_layout--layout3.php',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Text Color', 'consultivo'),
            'param_name' => 'text_color',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_heading_layout.php',
                    'fr_heading_layout--layout1.php',
                )
            ),
        ),
    )
));

class WPBakeryShortCode_fr_heading_layout extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        $html_id = cmsHtmlID('cms-heading-width-layout');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>