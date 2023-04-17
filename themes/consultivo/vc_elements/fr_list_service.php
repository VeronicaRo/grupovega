<?php
vc_map(array(
    'name' => 'List Service',
    'base' => 'fr_list_service',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('All Service Text','consultivo'),
            'param_name' => 'title',
            'admin_label' => true,
            'value' => 'Services List'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Number','consultivo'),
            'param_name' => 'number',
            'value' => '6'
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Link', 'consultivo'),
            'param_name' => 'service_page',
            'value' => '',
        ),
    )
));

class WPBakeryShortCode_fr_list_service extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
?>