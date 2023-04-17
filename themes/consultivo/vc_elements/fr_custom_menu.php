<?php
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( is_array( $menus ) && ! empty( $menus ) ) {
    foreach ( $menus as $single_menu ) {
        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
            $custom_menus[ $single_menu->name ] = $single_menu->slug;
        }
    }
} else {
    $custom_menus = '';
}

vc_map(array(
    "name" => 'CMS Custom Menu',
    "base" => "fr_custom_menu",
    'icon' => 'cs_icon_for_vc',
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    "params" => array(
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
            'type' => 'textfield',
            'heading' => esc_html__( 'Element Title', 'consultivo' ),
            'param_name' => 'el_title',
            'admin_label' => true,
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_custom_menu--layout3.php',
                )
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__("Menu", 'consultivo'),
            'param_name' => 'menu',
            'value' => $custom_menus,
            "description" => "Select menu to display.",
        ),
    )
));

class WPBakeryShortCode_fr_custom_menu extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>