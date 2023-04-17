<?php
vc_map(array(
    'name' => 'Accordion',
    'base' => 'fr_accordion',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_accordion',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'std' => 'fr_accordion.php',
            'group' => esc_html__('Template', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' =>esc_html__('Active section', 'consultivo'),
            'param_name' => 'active_section',
            'description' => 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).',
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Accordion Items', 'consultivo' ),
            'param_name' => 'fr_accordion',
            'description' => esc_html__( 'Enter values for accordion item', 'consultivo' ),
            'value' => '',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Title', 'consultivo'),
                    'param_name' => 'ac_title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textarea',
                    'heading' =>esc_html__('Content', 'consultivo'),
                    'param_name' => 'ac_content',
                ),
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title color', 'consultivo' ),
            'param_name' => 'title_color'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Content color', 'consultivo' ),
            'param_name' => 'content_color'
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
    )
));

class WPBakeryShortCode_fr_accordion extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
?>