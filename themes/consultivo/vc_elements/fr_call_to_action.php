<?php
vc_map(array(
    'name' => 'Call To Action',
    'base' => 'fr_call_to_action',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_call_to_action',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'std' => 'fr_call_to_action.php',
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
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'consultivo' ),
            'param_name' => 'title',
            'value' => '',
            'admin_label' => true,
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_call_to_action.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Button Text', 'consultivo' ),
            'param_name' => 'button_text',
            'value' => '',
        ),
        array(
            'type' => 'vc_link',
            'class' => '',
            'heading' => esc_html__('Button Link', 'consultivo'),
            'param_name' => 'button_link',
            'value' => '',
        ),
        /*Layout 1*/
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Address', 'consultivo' ),
            'param_name' => 'address',
            'admin_label' => true,
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_call_to_action--layout1.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Email', 'consultivo' ),
            'param_name' => 'email',
            'admin_label' => true,
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_call_to_action--layout1.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Phone', 'consultivo' ),
            'param_name' => 'phone',
            'admin_label' => true,
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_call_to_action--layout1.php',
                )
            ),
        ),
    )
));

class WPBakeryShortCode_fr_call_to_action extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>