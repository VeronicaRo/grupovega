<?php
vc_map(array(
    'name' => 'Button',
    'base' => 'fr_button',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Text', 'consultivo' ),
            'param_name' => 'button_text',
            'value' => '',
            'admin_label' => true,
            'group' => esc_html__('Button Settings', 'consultivo')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Button Icon','consultivo'),
            'param_name' => 'button_icon',
            'value' => '0',
            'group' => esc_html__('Button Settings', 'consultivo')
        ),
        array(
            'type' => 'vc_link',
            'class' => '',
            'heading' => esc_html__('Link', 'consultivo'),
            'admin_label' => true,
            'param_name' => 'button_link',
            'value' => '',
            'group' => esc_html__('Button Settings', 'consultivo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button Style', 'consultivo'),
            'param_name' => 'button_style',
            'value' => array(
                'Default' => 'btn-default',
                'Dark Button' => 'btn-dark',
            ),
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button radius', 'consultivo'),
            'param_name' => 'button_radius',
            'value' => array(
                'Default' => '',
                'No Radius' => 'no-radius',
            ),
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button Size', 'consultivo'),
            'param_name' => 'button_size',
            'value' => array(
                'Default' => 'size-default',
                'Large' => 'size-lg',
            ),
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Large', 'consultivo'),
            'param_name' => 'align_lg',
            'value' => array(
                'Left' => 'align-left',
                'Center' => 'align-center',
                'Right' => 'align-right',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Medium', 'consultivo'),
            'param_name' => 'align_md',
            'value' => array(
                'Left' => 'align-left-md',
                'Center' => 'align-center-md',
                'Right' => 'align-right-md',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Small', 'consultivo'),
            'param_name' => 'align_sm',
            'value' => array(
                'Left' => 'align-left-sm',
                'Center' => 'align-center-sm',
                'Right' => 'align-right-sm',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Mini', 'consultivo'),
            'param_name' => 'align_xs',
            'value' => array(
                'Left' => 'align-left-xs',
                'Center' => 'align-center-xs',
                'Right' => 'align-right-xs',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        /* Padding */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Top', 'consultivo'),
            'param_name' => 'padding_top',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Right', 'consultivo'),
            'param_name' => 'padding_right',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Bottom', 'consultivo'),
            'param_name' => 'padding_bottom',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Left', 'consultivo'),
            'param_name' => 'padding_left',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        /* Margin*/
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin top', 'consultivo'),
            'param_name' => 'margin_top',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin right', 'consultivo'),
            'param_name' => 'margin_right',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin bottom', 'consultivo'),
            'param_name' => 'margin_bottom',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin left', 'consultivo'),
            'param_name' => 'margin_left',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        /* Border radius */
        /* Padding */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Top', 'consultivo'),
            'param_name' => 'br_top',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Right', 'consultivo'),
            'param_name' => 'br_right',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Bottom', 'consultivo'),
            'param_name' => 'br_bottom',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Left', 'consultivo'),
            'param_name' => 'br_left',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'consultivo' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'consultivo' ),
            'group'            => esc_html__('Button Settings', 'consultivo')
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation Style', 'consultivo' ),
            'param_name' => 'animation',
            'description' => esc_html__( 'Choose your animation style', 'consultivo' ),
            'admin_label' => false,
            'weight' => 0,
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element Parallax', 'consultivo'),
            'param_name' => 'el_parallax',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            'group' => esc_html__('Button Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax Speed', 'consultivo' ),
            'param_name' => 'el_parallax_speed',
            'value' => '',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'consultivo' ),
            'group' => esc_html__('Button Settings', 'consultivo'),
            'dependency' => array(
                'element'=>'el_parallax',
                'value'=>array(
                    'true',
                )
            ),
        ),
    )
));

class WPBakeryShortCode_fr_button extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>