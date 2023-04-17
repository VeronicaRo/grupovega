<?php
$term_list = cms_get_grid_term_list('services');
$args = array(
    'name' => 'Service Carousel',
    'base' => 'fr_service_carousel',
    'class' => 'vc-cms-service-carousel',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(

        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_service_carousel',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'std' => 'fr_service_carousel.php',
            'group' => esc_html__('Template', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'layout1_style',
            'heading' => esc_html__('Style','consultivo'),
            'group'            => esc_html__('Template', 'consultivo'),
            'value' => array(
                'Style 1' => 'style1',
                'Style 2' => 'style2'
            ),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_service_carousel.php',
                )
            )
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
            "group" => esc_html__("Template", 'consultivo'),
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
            'type'       => 'checkbox',
            'heading'    => esc_html__('Custom Source', 'consultivo'),
            'param_name' => 'custom_source',
            'value'      => '1',
            'description'        => 'Check here if you want custom source',
            'group'      => esc_html__('Source Settings', 'consultivo')
        ),
        array(
            'type'       => 'autocomplete',
            'heading'    => esc_html__('Select Categories', 'consultivo'),
            'param_name' => 'source',
            'description' => esc_html__('Leave blank to select all category', 'consultivo'),
            'admin_label' => true,
            'settings'   => array(
                'multiple' => true,
                'values'   => $term_list['auto_complete'],
            ),
            'dependency' => array(
                'element'=>'custom_source',
                'value'=>array(
                    'true',
                )
            ),
            'group'      => esc_html__('Source Settings', 'consultivo'),
        ),
        array(
            'type'       => 'autocomplete',
            'class'      => '',
            'heading'    => esc_html__('Select Post Name', 'consultivo'),
            'param_name' => 'post_ids',
            'description' => esc_html__('Leave blank to show all post', 'consultivo'),
            'settings'   => array(
                'multiple' => true,
                'values'   => cms_get_type_posts_data('services')
            ),
            'dependency' => array(
                'element'=>'custom_source',
                'value'=>array(
                    'true',
                )
            ),
            'group'      => esc_html__('Source Settings', 'consultivo'),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Order by', 'consultivo'),
            'param_name' => 'orderby',
            'value'      => array(
                'Date'   => 'date',
                'ID'     => 'ID',
                'Author' => 'author',
                'Title'  => 'title',
                'Random' => 'rand',
            ),
            'std'        => 'date',
            'group'      => esc_html__('Source Settings', 'consultivo')
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Sort order', 'consultivo'),
            'param_name' => 'order',
            'value'      => array(
                'Ascending'  => 'ASC',
                'Descending' => 'DESC',
            ),
            'std'        => 'DESC',
            'group'      => esc_html__('Source Settings', 'consultivo')
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Total items', 'consultivo'),
            'param_name' => 'limit',
            'value'      => '6',
            'group'      => esc_html__('Source Settings', 'consultivo'),
            'description' => esc_html__('Set max limit for items in carousel. Enter number only', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'consultivo' ),
            'param_name' => 'img_size',
            'value' => '',
            'description' => esc_html__( "Enter image size (Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).", "consultivo" ),
            'group'      => esc_html__('Source Settings', 'consultivo')
        ),
    ));

$args = consultivo_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_fr_service_carousel extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>