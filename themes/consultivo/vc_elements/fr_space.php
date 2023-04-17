<?php
vc_map(array(
    "name" => 'CMS Space',
    "base" => "fr_space",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    "params" => array(

        array(
            "type" => "textfield",
            "heading" => esc_html__("Space Larger Devices ( width >= 992px )", 'consultivo'),
            "param_name" => "space_lg",
            "description" => "Enter number."
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Space Medium Devices ( 768px <= width <= 991px )", 'consultivo'),
            "param_name" => "space_md",
            "description" => "Enter number."
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Space Small Devices ( 576px <= width <= 767px )", 'consultivo'),
            "param_name" => "space_sm",
            "description" => "Enter number."
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Space very Small Devices ( width <= 575px )", 'consultivo'),
            "param_name" => "space_xs",
            "description" => "Enter number."
        ),

    )
));

class WPBakeryShortCode_fr_space extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>