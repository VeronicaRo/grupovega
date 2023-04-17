<?php
$args = array(
    'name' => 'Team Grid',
    'base' => 'fr_team_grid',
    'class' => 'fr-team-grid',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(

        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_team_grid',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'std' => 'fr_team_grid.php',
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
            'type' => 'param_group',
            'heading' => esc_html__( 'Team Members', 'consultivo' ),
            'param_name' => 'teams',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'consultivo' ),
                    'param_name' => 'image',
                    'description' => esc_html__( 'Select image from media library.', 'consultivo' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Title', 'consultivo'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Occupation', 'consultivo'),
                    'param_name' => 'occupation',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Facebook', 'consultivo'),
                    'param_name' => 'facebook',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Twitter', 'consultivo'),
                    'param_name' => 'twitter',
                    'admin_label' => true,
                ),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Image size', 'consultivo' ),
            'param_name' => 'img_size',
            'value' => '',
            'description' => __( "Enter image size (Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height). Enter multiple sizes (Example: 100x100,200x200,300x300)).", 'consultivo' ),
            'group'      => esc_html__('Grid Settings', 'consultivo')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns XS Devices', 'consultivo'),
            'param_name'       => 'col_xs',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6),
            'std'              => 1,
            'group'            => esc_html__('Grid Settings', 'consultivo')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns SM Devices', 'consultivo'),
            'param_name'       => 'col_sm',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6),
            'std'              => 2,
            'group'            => esc_html__('Grid Settings', 'consultivo')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns MD Devices', 'consultivo'),
            'param_name'       => 'col_md',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6),
            'std'              => 3,
            'group'            => esc_html__('Grid Settings', 'consultivo')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns LG Devices', 'consultivo'),
            'param_name'       => 'col_lg',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6),
            'std'              => 4,
            'group'            => esc_html__('Grid Settings', 'consultivo')
        ),

    ));
vc_map($args);

class WPBakeryShortCode_fr_team_grid extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>