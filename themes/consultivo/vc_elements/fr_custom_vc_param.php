<?php
/*
 * VC
 */
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("CMS Custom Style", 'consultivo'),
    "param_name" => "cms_row_class",
    "value" => array(
        'None' => '',
        'Row Overlay Primary Opacity' => 'bg-primary',
        'Row Overlay Dark Opacity' => 'bg-dark-over-flow',
        'Row Overlay Dark Opacity No Overflow' => 'bg-dark',
        'No Overflow Hidden' => 'no-overflow',
    ),
    "group" => esc_html__("CMS Customs", 'consultivo'),
));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("CMS Custom Opacity", 'consultivo'),
    "param_name" => "cms_row_opacity",
    "value" => array(
        'None' => '',
        '20%' => 'opacity2',
        '50%' => 'opacity5',
        '75%' => 'opacity7',
        '85%' => 'opacity85',
    ),
    'default' => 'opacity5',
    "group" => esc_html__("CMS Customs", 'consultivo'),
));

vc_add_param("vc_row_inner", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("CMS Custom Style", 'consultivo'),
    "param_name" => "cms_row_inner_class",
    "group" => esc_html__("CMS Customs", 'consultivo'),
    "value" => array(
        'None' => '',
        'Row Overlay Primary Opacity' => 'bg-primary',
        'Row Overlay White Opacity' => 'bg-white',
        'Row Overlay Dark Opacity' => 'bg-dark',
        'No Overflow Hidden' => 'no-overflow',
        'Wrap Slide and Form' => 'wrap-slide-and-form'
    ),
));
vc_add_param("vc_row_inner", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("CMS Custom Opacity", 'consultivo'),
    "param_name" => "cms_row_inner_opacity",
    "value" => array(
        'None' => '',
        '20%' => 'opacity2',
        '50%' => 'opacity5',
        '75%' => 'opacity7',
        '85%' => 'opacity85',
    ),
    'default' => 'opacity5',
    "group" => esc_html__("CMS Customs", 'consultivo'),
));

vc_add_param("vc_column", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("CMS Custom Style", 'consultivo'),
    "param_name" => "cms_column_class",
    "value" => array(
        'None' => '',
        'Column Stretch Right' => 'column-stretch-right',
        'Column Stretch Right Padding' => 'column-stretch-right-padding',
        'Column Stretch Left' => 'column-stretch-left',
        'Column Stretch Left Padding' => 'column-stretch-left-padding',
        'Column Radius' => 'radius-column',
        'Fancy Box Line Vertical' => 'throw-vertical',
        'Content Parallax Item' => 'content-parallax-item',
        'Art Board Content' => 'has-artboard',
    ),
    "group" => esc_html__("CMS Customs", 'consultivo'),
));

//vc_add_param("vc_column", array(
//    "type" => "dropdown",
//    "class" => "",
//    "heading" => esc_html__("CMS Column Offset", 'consultivo'),
//    "param_name" => "cms_column_offset",
//    "value" => array(
//        'None' => '',
//        'Offset Container Left' => 'col-offset-left',
//        'Offset Container Right' => 'col-offset-right'
//    ),
//    "group" => esc_html__("CMS Customs", 'consultivo'),
//));

//vc_add_param("vc_column_inner", array(
//    "type" => "dropdown",
//    "class" => "",
//    "heading" => esc_html__("CMS Custom Style", 'consultivo'),
//    "param_name" => "cms_column_inner_class",
//    "value" => array(
//        'None' => '',
//        'Remove Padding (Left/Right) Large Devices ( < 1199px ) to 30px' => 'rm-padding-lg30',
//        'Remove Padding (Left/Right) Large Devices ( < 1199px ) to 15px' => 'rm-padding-lg',
//        'Remove Padding (Left/Right) Medium Devices ( < 991px ) to 15px' => 'rm-padding-md',
//        'Remove Padding (Left/Right) Small Devices ( < 767px ) to 15px' => 'rm-padding-sm',
//        'Remove Padding (Left/Right) Mini Devices ( < 575px ) to 15px' => 'rm-padding-xs',
//    ),
//    "group" => esc_html__("CMS Customs", 'consultivo'),
//));

//vc_add_param("vc_column_inner",
//    array(
//        'type' => 'animation_style',
//        'heading' => esc_html__( 'Animation', 'consultivo' ),
//        'param_name' => 'animation_column',
//        'description' => esc_html__( 'Choose your animation style', 'consultivo' ),
//        'admin_label' => false,
//        'weight' => 0,
//        "group" => esc_html__("CMS Customs", 'consultivo'),
//    )
//);

// vc_tta_accordion
//--------------------------------------------------
vc_remove_param( 'vc_tta_accordion', 'title' );
vc_remove_param( 'vc_tta_accordion', 'style' );
vc_remove_param( 'vc_tta_accordion', 'shape' );
vc_remove_param( 'vc_tta_accordion', 'color' );
vc_remove_param( 'vc_tta_accordion', 'no_fill' );
vc_remove_param( 'vc_tta_accordion', 'spacing' );
vc_remove_param( 'vc_tta_accordion', 'gap' );
vc_remove_param( 'vc_tta_accordion', 'c_align' );
vc_remove_param( 'vc_tta_accordion', 'autoplay' );
vc_remove_param( 'vc_tta_accordion', 'c_icon' );
vc_remove_param( 'vc_tta_accordion', 'c_position' );
vc_add_param("vc_tta_accordion",
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Styles', 'consultivo' ),
        'param_name' => 'style',
        "value" => array(
            'Default' => 'default',
            'Renovation' => 'renovation',
            'Industrial' => 'industrial',
            'Corporate' => 'corporate',
        ),
    )
);

// vc_tta_tabs
//--------------------------------------------------
vc_remove_param( 'vc_tta_tabs', 'title' );
vc_remove_param( 'vc_tta_tabs', 'style' );
vc_remove_param( 'vc_tta_tabs', 'shape' );
vc_remove_param( 'vc_tta_tabs', 'color' );
vc_remove_param( 'vc_tta_tabs', 'spacing' );
vc_remove_param( 'vc_tta_tabs', 'gap' );
vc_add_param("vc_tta_tabs",
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Styles', 'consultivo' ),
        'param_name' => 'style',
        "value" => array(
            'Default' => 'default',
            'Industrial' => 'industrial',
            'Corporate' => 'corporate',
            'Estate' => 'estate',
        ),
    )
);

vc_remove_param( 'vc_tta_tour', 'title' );
vc_remove_param( 'vc_tta_tour', 'style' );
vc_remove_param( 'vc_tta_tour', 'shape' );
vc_remove_param( 'vc_tta_tour', 'color' );
vc_remove_param( 'vc_tta_tour', 'spacing' );
vc_remove_param( 'vc_tta_tour', 'gap' );
vc_add_param("vc_tta_tour",
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Styles', 'consultivo' ),
        'param_name' => 'style',
        "value" => array(
            'Default' => 'tour-default',
        ),
    )
);

// VC Image
//--------------------------------------------------
vc_remove_param( 'vc_single_image', 'style' );
vc_add_param("vc_single_image",
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Styles', 'consultivo' ),
        'param_name' => 'style',
        "value" => array(
            'None' => '',
            'Image Max height' => 'image-max-height'
        ),
        "group" => esc_html__("Styles", 'consultivo'),
    )
);