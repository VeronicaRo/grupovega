<?php
$term_list = cms_get_grid_term_list('portfolio');
vc_map(
    array(
        'name'     => esc_html__('Case Studies Grid', 'consultivo'),
        'base'     => 'fr_case_studies_grid',
        'class'    => 'case-studies-grid',
        'icon' => 'cs_icon_for_vc',
        'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
        'params'   => array(
            array(
                'type' => 'cms_template_img',
                'param_name' => 'cms_template',
                'shortcode' => 'fr_case_studies_grid',
                'heading' => esc_html__('Shortcode Template', 'consultivo'),
                'std' => 'fr_case_studies_grid.php',
                'group' => esc_html__('Template', 'consultivo'),
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
                    'values'   => cms_get_type_posts_data('portfolio')
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
                'description' => esc_html__('Set max limit for items in grid. Enter number only', 'consultivo'),
            ),

            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image size', 'consultivo' ),
                'param_name' => 'img_size',
                'value' => '',
                'description' => esc_html__( "Enter image size (Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height). Enter multiple sizes (Example: 100x100,200x200,300x300)).", "consultivo" ),
                'group'      => esc_html__('Grid Settings', 'consultivo')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Filter on Masonry', 'consultivo'),
                'param_name' => 'filter',
                'value'      => array(
                    'Enable'  => 'true',
                    'Disable' => 'false'
                ),
                'group'      => esc_html__('Grid Settings', 'consultivo')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Default Title', 'consultivo'),
                'param_name' => 'filter_default_title',
                'value'      => 'All',
                'group'      => esc_html__('Filter', 'consultivo'),
                'description' => esc_html__('Enter default title for filter option display, empty: All', 'consultivo'),
                'dependency' => array(
                    'element' => 'filter',
                    'value'   => 'true'
                ),
            ),

            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Alignment', 'consultivo'),
                'param_name' => 'filter_alignment',
                'value'      => array(
                    'Center'   => 'center',
                    'Left'   => 'left',
                    'Right'   => 'right',
                ),
                'description' => esc_html__('Select filter alignment.', 'consultivo'),
                'group'      => esc_html__('Filter', 'consultivo'),
                'dependency' => array(
                    'element' => 'filter',
                    'value'   => 'true'
                ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns XS Devices', 'consultivo'),
                'param_name'       => 'col_xs',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 1,
                'group'            => esc_html__('Grid Settings', 'consultivo')
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns SM Devices', 'consultivo'),
                'param_name'       => 'col_sm',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 2,
                'group'            => esc_html__('Grid Settings', 'consultivo')
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns MD Devices', 'consultivo'),
                'param_name'       => 'col_md',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 3,
                'group'            => esc_html__('Grid Settings', 'consultivo')
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns LG Devices', 'consultivo'),
                'param_name'       => 'col_lg',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 4,
                'group'            => esc_html__('Grid Settings', 'consultivo')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra class name', 'consultivo' ),
                'param_name' => 'el_class',
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'consultivo' ),
                'group'            => esc_html__('Grid Settings', 'consultivo')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Element Parallax', 'consultivo'),
                'param_name' => 'el_parallax',
                'value' => array(
                    'No' => 'false',
                    'Yes' => 'true',
                ),
                'group' => esc_html__('Grid Settings', 'consultivo'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Parallax Speed', 'consultivo' ),
                'param_name' => 'el_parallax_speed',
                'value' => '',
                'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'consultivo' ),
                'group' => esc_html__('Grid Settings', 'consultivo'),
                'dependency' => array(
                    'element'=>'el_parallax',
                    'value'=>array(
                        'true',
                    )
                ),
            ),
        )
    )
);

class WPBakeryShortCode_fr_case_studies_grid extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        $html_id = cmsHtmlID('fr-grid-case-studies');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>