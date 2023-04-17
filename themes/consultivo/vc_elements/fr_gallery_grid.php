<?php
$args = array(
    'name' => 'Image Gallery Grid',
    'base' => 'fr_gallery_grid',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_gallery_grid',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'admin_label' => true,
            'group' => esc_html__('Template', 'consultivo'),
            'std' => 'fr_gallery_grid.php'
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
        /*Settings Data*/
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Item', 'consultivo' ),
            'param_name' => 'group_images',
            'group' => esc_html__('Settings Data','consultivo'),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_gallery_grid.php',
                )
            ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Title Group', 'consultivo'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'attach_images',
                    'heading' => esc_html__( 'Images', 'consultivo' ),
                    'param_name' => 'images',
                    'value' => '',
                    'description' => esc_html__( 'Select images for group from media library.', 'consultivo' ),
                ),
            ),
        ),
        array(
            'type' => 'attach_images',
            'heading' => esc_html__( 'Images', 'consultivo' ),
            'param_name' => 'images',
            'value' => '',
            'description' => esc_html__( 'Select icon image from media library.', 'consultivo' ),
            'group' => esc_html__('Settings Data','consultivo'),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_gallery_grid--layout1.php',
                    'fr_gallery_grid--layout2.php',
                    'fr_gallery_grid--layout3.php'
                )
            )
        ),
        /*Settings Grid*/
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'consultivo' ),
            'param_name' => 'img_size',
            'value' => '',
            'group' => esc_html__('Settings Data','consultivo'),
            'description' => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).', 'consultivo' ),
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns XS Devices', 'consultivo'),
            'param_name'       => 'col_xs',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6, 8, 12),
            'std'              => 1,
            'group' => esc_html__('Settings Data','consultivo'),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_gallery_grid--layout1.php',
                    'fr_gallery_grid--layout2.php'
                )
            )
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns SM Devices', 'consultivo'),
            'param_name'       => 'col_sm',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6, 8, 12),
            'std'              => 2,
            'group' => esc_html__('Settings Data','consultivo'),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_gallery_grid--layout1.php',
                    'fr_gallery_grid--layout2.php'
                )
            )
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns MD Devices', 'consultivo'),
            'param_name'       => 'col_md',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6, 8, 12),
            'std'              => 3,
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_gallery_grid--layout1.php',
                    'fr_gallery_grid--layout2.php'
                )
            ),
            'group' => esc_html__('Settings Data','consultivo'),
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns LG Devices', 'consultivo'),
            'param_name'       => 'col_lg',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6, 8, 12),
            'std'              => 4,
            'group' => esc_html__('Settings Data','consultivo'),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_gallery_grid--layout1.php',
                    'fr_gallery_grid--layout2.php'
                )
            )
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Custom Column Item', 'consultivo'),
            'param_name'       => 'custom_column',
            'value'      => array(
                'False'   => 'false',
                'True' => 'true',
            ),
            'std'              => false,
            'group' => esc_html__('Settings Data','consultivo'),
            'dependency' => array(
                'element' => 'cms_template',
                'value' => array(
                    'fr_gallery_grid--layout1.php',
                    'fr_gallery_grid--layout2.php'
                )
            )
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'List Item', 'consultivo' ),
            'param_name' => 'cms_list_column',
            'description' => esc_html__( 'Column for each item', 'consultivo' ),
            'value' => '',
            'group' => esc_html__('Settings Data','consultivo'),
            'dependency' => array(
                'element' => 'custom_column',
                'value'   => 'true'
            ),
            'params' => array(
                array(
                    'type'             => 'dropdown',
                    'heading'          => esc_html__('Columns XS Devices', 'consultivo'),
                    'param_name'       => 'custom_col_xs',
                    'edit_field_class' => 'vc_col-sm-3 vc_column',
                    'value'            => array(1, 2, 3, 4, 6, 8, 12),
                    'std'              => 1,
                    'group'            => esc_html__('Grid Settings', 'consultivo'),
                    'admin_label' => true,
                ),
                array(
                    'type'             => 'dropdown',
                    'heading'          => esc_html__('Columns SM Devices', 'consultivo'),
                    'param_name'       => 'custom_col_sm',
                    'edit_field_class' => 'vc_col-sm-3 vc_column',
                    'value'            => array(1, 2, 3, 4, 6, 8, 12),
                    'std'              => 2,
                    'group'            => esc_html__('Grid Settings', 'consultivo'),
                    'admin_label' => true,
                ),
                array(
                    'type'             => 'dropdown',
                    'heading'          => esc_html__('Columns MD Devices', 'consultivo'),
                    'param_name'       => 'custom_col_md',
                    'edit_field_class' => 'vc_col-sm-3 vc_column',
                    'value'            => array(1, 2, 3, 4, 6, 8, 12),
                    'std'              => 3,
                    'group'            => esc_html__('Grid Settings', 'consultivo'),
                    'admin_label' => true,
                ),
                array(
                    'type'             => 'dropdown',
                    'heading'          => esc_html__('Columns LG Devices', 'consultivo'),
                    'param_name'       => 'custom_col_lg',
                    'edit_field_class' => 'vc_col-sm-3 vc_column',
                    'value'            => array(1, 2, 3, 4, 6, 8, 12),
                    'std'              => 4,
                    'group'            => esc_html__('Grid Settings', 'consultivo'),
                    'admin_label' => true,
                ),
            ),
        ),
    ));
vc_map($args);

class WPBakeryShortCode_fr_gallery_grid extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>