<?php
vc_map(array(
    'name' => 'Heading',
    'base' => 'fr_heading',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text Source', 'consultivo'),
            'param_name' => 'text_source',
            'value' => array(
                'Custom Text' => 'custom-text',
                'Post or Page Title' => 'post-page-title',
            ),
            'admin_label' => true,
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Text', 'consultivo' ),
            'param_name' => 'text',
            'value' => '',
            'admin_label' => true,
            'dependency' => array(
                'element'=>'text_source',
                'value'=>array(
                    'custom-text',
                )
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Line position','consultivo'),
            'param_name' => 'line_position',
            'value' => array(
                'Bottom' => 'bottom',
                'Right' => 'right'
            ),
            'dependency' => array(
                'element' => 'show_line',
                'value' => array(
                    'true'
                )
            ),
            'default' => 'bottom'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element tag', 'consultivo'),
            'param_name' => 'tag',
            'value' => array(
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
                'p' => 'p',
                'div' => 'div',
            ),
            'std' => 'h3',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text align large', 'consultivo'),
            'param_name' => 'align_lg',
            'value' => array(
                'left' => 'align-left',
                'right' => 'align-right',
                'center' => 'align-center',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text align medium', 'consultivo'),
            'param_name' => 'align_md',
            'value' => array(
                'left' => 'align-left-md',
                'right' => 'align-right-md',
                'center' => 'align-center-md',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text align small', 'consultivo'),
            'param_name' => 'align_sm',
            'value' => array(
                'left' => 'align-left-sm',
                'right' => 'align-right-sm',
                'center' => 'align-center-sm',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text align mini', 'consultivo'),
            'param_name' => 'align_xs',
            'value' => array(
                'left' => 'align-left-xs',
                'right' => 'align-right-xs',
                'center' => 'align-center-xs',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        /*Margin*/
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin top', 'consultivo'),
            'param_name' => 'margin_top',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin right', 'consultivo'),
            'param_name' => 'margin_right',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin bottom', 'consultivo'),
            'param_name' => 'margin_bottom',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin left', 'consultivo'),
            'param_name' => 'margin_left',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        /*Padding*/
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding top', 'consultivo'),
            'param_name' => 'padding_top',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding right', 'consultivo'),
            'param_name' => 'padding_right',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding bottom', 'consultivo'),
            'param_name' => 'padding_bottom',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding left', 'consultivo'),
            'param_name' => 'padding_left',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        /*Font size*/
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font size large', 'consultivo' ),
            'param_name' => 'font_size',
            'value' => '',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font size medium', 'consultivo' ),
            'param_name' => 'font_size_md',
            'value' => '',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font size small', 'consultivo' ),
            'param_name' => 'font_size_sm',
            'value' => '',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font size mini', 'consultivo' ),
            'param_name' => 'font_size_xs',
            'value' => '',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Line height large', 'consultivo' ),
            'param_name' => 'line_height',
            'value' => '',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Line height medium', 'consultivo' ),
            'param_name' => 'line_height_md',
            'value' => '',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Line height small', 'consultivo' ),
            'param_name' => 'line_height_sm',
            'value' => '',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Line height mini', 'consultivo' ),
            'param_name' => 'line_height_xs',
            'value' => '',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Weight', 'consultivo'),
            'param_name' => 'font_weight',
            'value' => array(
                'SemiBold' => '600',
                'Normal' => '400',
                'Medium' => '500',
                'Bold' => '700',
            ),
            'std' => '600',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Style', 'consultivo'),
            'param_name' => 'font_style',
            'value' => array(
                'Normal' => 'normal',
                'Italic' => 'italic',
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text Transform', 'consultivo'),
            'param_name' => 'text_transform',
            'value' => array(
                'None' => 'none',
                'Inherit' => 'inherit',
                'Uppercase' => 'uppercase',
                'Capitalize' => 'capitalize',
                'Lowercase' => 'lowercase',
            ),
            'std' => 'none',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Letter Spacing', 'consultivo' ),
            'param_name' => 'letter_spacing',
            'value' => '',
            'description' => 'Enter: ..px, ...em',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Border Radius', 'consultivo' ),
            'param_name' => 'border_radius',
            'value' => '',
            'description' => 'Enter: ..px, ...em',
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Text Color', 'consultivo'),
            'param_name' => 'text_color',
            'value' => '',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Background Color', 'consultivo'),
            'param_name' => 'bg_color',
            'value' => '',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Custom Local Fonts', 'consultivo'),
            'param_name' => 'custom_local_fonts',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Local Fonts', 'consultivo'),
            'param_name' => 'local_fonts',
            'value' => array(
                'Montserrat, sans-serif' => esc_html__('Montserrat', 'consultivo'),
                'Poppins' => esc_html__('Poppins', 'consultivo'),
            ),
            'dependency' => array(
                'element'=>'custom_local_fonts',
                'value'=>array(
                    'true',
                )
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Custom Google Fonts', 'consultivo'),
            'param_name' => 'custom_fonts',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
        ),
        array(
            'type' => 'google_fonts',
            'param_name' => 'google_fonts',
            'value' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
            'settings' => array(
                'fields' => array(
                    'font_family_description' => esc_html__( 'Select font family.', 'consultivo' ),
                    'font_style_description' => esc_html__( 'Select font styling.', 'consultivo' ),
                ),
            ),
            'dependency' => array(
                'element'=>'custom_fonts',
                'value'=>array(
                    'true',
                )
            ),
        ),

        /* Description */
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Description', 'consultivo' ),
            'param_name' => 'description',
            'value' => '',
            'group'      => esc_html__('Description', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Weight', 'consultivo'),
            'param_name' => 'des_font_weight',
            'value' => array(
                'SemiBold' => '600',
                'Normal' => '400',
                'Light' => '300',
                'Medium' => '500',
                'Bold' => '700',
            ),
            'group'      => esc_html__('Description', 'consultivo'),
            'std' => '600',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Style', 'consultivo'),
            'param_name' => 'font_style',
            'value' => array(
                'Normal' => 'normal',
                'Italic' => 'italic',
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font Size', 'consultivo' ),
            'param_name' => 'description_font_size',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Description', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Line Height', 'consultivo' ),
            'param_name' => 'description_line_height',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Description', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Margin bottom', 'consultivo' ),
            'param_name' => 'description_margin',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Description', 'consultivo'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'consultivo'),
            'param_name' => 'description_color',
            'value' => '',
            'group'      => esc_html__('Description', 'consultivo'),
        ),
        /* Extra */
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'consultivo' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'consultivo' ),
            'group'      => esc_html__('Extra', 'consultivo'),
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
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element Parallax', 'consultivo'),
            'param_name' => 'el_parallax',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            'group' => esc_html__('Extra', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax Speed', 'consultivo' ),
            'param_name' => 'el_parallax_speed',
            'value' => '',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'consultivo' ),
            'group' => esc_html__('Extra', 'consultivo'),
            'dependency' => array(
                'element'=>'el_parallax',
                'value'=>array(
                    'true',
                )
            ),
        ),
    )
));

class WPBakeryShortCode_fr_heading extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        $html_id = cmsHtmlID('cms-heading');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>