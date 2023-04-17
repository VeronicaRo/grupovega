<?php
extract(shortcode_atts(array(
    'text_source' => 'custom-text',
    'text' => '',
    'show_line' => false,
    'line_position' => 'bottom',
    'tag' => 'h3',
    'align_lg' => 'align-left',
    'align_md' => 'align-left-md',
    'align_sm' => 'align-left-sm',
    'align_xs' => 'align-left-xs',

    'font_size' => '',
    'font_size_md' => '',
    'font_size_sm' => '',
    'font_size_xs' => '',
    'font_weight' => '600',

    'line_height' => '',
    'line_height_md' => '',
    'line_height_sm' => '',
    'line_height_xs' => '',

    'letter_spacing' => '',
    'text_transform' => 'none',
    'font_style'  => 'normal',

    'description' => '',
    'description_color' => '',
    'description_font_size' => '',
    'description_line_height' => '',
    'description_margin' => '',
    'des_font_weight' => '400',

    'margin_top' => '',
    'margin_right' => '',
    'margin_bottom' => '',
    'margin_left' => '',

    'padding_top' => '',
    'padding_right' => '',
    'padding_bottom' => '',
    'padding_left' => '',

    'text_color' => '',
    'bg_color' => '',
    'border_radius' => '',
    'custom_fonts' => 'false',
    'google_fonts' => '',

    'custom_local_fonts' => 'false',
    'local_fonts' => '',

    'animation' => '',
    'el_class' => '',
    'el_parallax' => 'false',
    'el_parallax_speed' => '1.5',
), $atts));

$inline_style = '';
if($custom_fonts == 'true') {
    // Build the data array
    $googleFontsParam = new Vc_Google_Fonts();
    $fieldSettings = array();
    $text_font_data = strlen( $google_fonts ) > 0 ? $googleFontsParam->_vc_google_fonts_parse_attributes( $fieldSettings, $google_fonts ) : '';

    // Build the inline style
    if(isset($text_font_data['values']['font_family'])) {
        $fontFamily = explode( ':', $text_font_data['values']['font_family'] );
        $styles[] = 'font-family:' . $fontFamily[0];
    }
    if(isset($text_font_data['values']['font_style'])) {
        $fontStyles = explode( ':', $text_font_data['values']['font_style'] );
        //$styles[] = 'font-weight:' . $fontStyles[1];
        $styles[] = 'font-style:' . $fontStyles[2];
    }
    if(isset($text_font_data['values']['font_family']) || isset($text_font_data['values']['font_style'])) {
        foreach( $styles as $attribute ){
            $inline_style .= $attribute.'; ';
        }
    }
    // Enqueue the right font
    $settings = get_option( 'wpb_js_google_fonts_subsets' );
    if ( is_array( $settings ) && ! empty( $settings ) ) {
        $subsets = '&subset=' . implode( ',', $settings );
    } else {
        $subsets = '';
    }
    // We also need to enqueue font from googleapis
    if ( isset( $text_font_data['values']['font_family'] ) ) {
        wp_enqueue_style(
            'vc_google_fonts_' . vc_build_safe_css_class( $text_font_data['values']['font_family'] ),
            '//fonts.googleapis.com/css?family=' . $text_font_data['values']['font_family'] . $subsets
        );
    }
} else {
    $inline_style = '';
}
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}

$h_local_fonts = '';
if($custom_local_fonts == 'true') {
$h_local_fonts = $local_fonts;
}

$styles_title = array(
    'margin-top'    => $margin_top,
    'margin-right'  => $margin_right,
    'margin-bottom' => $margin_bottom,
    'margin-left'   => $margin_left,
    'padding-top'   => $padding_top,
    'padding-right' => $padding_right,
    'padding-bottom' => $padding_bottom,
    'padding-left'  => $padding_left,
    'color'         => $text_color,
    'font-size'     => $font_size,
    'line-height'   => $line_height,
    'letter-spacing'   => $letter_spacing,
    'border-radius' => $border_radius,
    'text-transform'   => $text_transform,
    'font-weight'   => $font_weight,
    'font-style'    => $font_style,
    'font-family'   => $h_local_fonts,
    'display'       => 'inline-block',
    'background'    => $bg_color
);
$title_styles = '';
foreach ($styles_title as $key => $value) {
    if (!empty($value)) {
        $title_styles .= $key . ':' . $value . ';';
    }
}

$styles_desc = array(
    'color'   => $description_color,
    'font-size'   => $description_font_size,
    'line-height'   => $description_line_height,
    'font-weight'   => $des_font_weight,
    'margin-bottom' => $description_margin
);
$desc_styles = '';
foreach ($styles_desc as $key => $value) {
    if (!empty($value)) {
        $desc_styles .= $key . ':' . $value . ';';
    }
}

$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );

?>
<div id="<?php echo esc_attr($atts['html_id']);?>" class="cms-heading <?php echo esc_attr( $el_parallax_class.' '.$align_lg.' '.$align_md.' '.$align_sm.' '.$align_xs.' '.$animation_classes ); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <?php if(!empty($font_size_md) || !empty($line_height_md)) : ?>
        <style type="text/css">
            @media (min-width: 991px) and (max-width: 1200px) {
                #<?php echo esc_attr($atts['html_id']);?> .cms-heading-tag {
                    <?php if(!empty($font_size_md)) : ?>
                        font-size: <?php echo esc_attr($font_size_md); ?> !important;
                    <?php endif; ?>
                    <?php if(!empty($line_height_md)) : ?>
                        line-height: <?php echo esc_attr($line_height_md); ?> !important;
                    <?php endif; ?>
                }
            }
        </style>
    <?php endif; ?>

    <?php if(!empty($font_size_sm) || !empty($line_height_sm)) : ?>
        <style type="text/css">
            @media (min-width: 768px) and (max-width: 991px) {
                #<?php echo esc_attr($atts['html_id']);?> .cms-heading-tag {
                    <?php if(!empty($font_size_sm)) : ?>
                        font-size: <?php echo esc_attr($font_size_sm); ?> !important;
                    <?php endif; ?>
                    <?php if(!empty($line_height_sm)) : ?>
                        line-height: <?php echo esc_attr($line_height_sm); ?> !important;
                    <?php endif; ?>
                }
            }
        </style>
    <?php endif; ?>

    <?php if(!empty($font_size_xs) || !empty($line_height_xs)) : ?>
        <style type="text/css">
            @media screen and (max-width: 767px) {
                #<?php echo esc_attr($atts['html_id']);?> .cms-heading-tag {
                    <?php if(!empty($font_size_xs)) : ?>
                        font-size: <?php echo esc_attr($font_size_xs); ?> !important;
                    <?php endif; ?>
                    <?php if(!empty($line_height_xs)) : ?>
                        line-height: <?php echo esc_attr($line_height_xs); ?> !important;
                    <?php endif; ?>
                }
            }
        </style>
    <?php endif; ?>

    <<?php echo esc_attr( $tag ); ?> class="cms-heading-tag <?php echo esc_attr( $el_class ); if($show_line == true){echo esc_attr( ' line-'.$line_position );} ?>" <?php echo (!empty($title_styles ) || !empty($inline_style)) ? 'style="' . esc_attr($title_styles) . ' '. $inline_style .'"' : '' ?>>
        <?php if($text_source == 'custom-text' && !empty($text)) {
            echo wp_kses_post( $text );
        } else {
            echo get_the_title();
        } ?>
    </<?php echo esc_attr( $tag ); ?>>

    <?php if(!empty($description)) : ?>
        <div class="cms-heading-desc" <?php echo !empty($desc_styles) ? 'style="' . esc_attr($desc_styles) . '"' : '' ?>>
            <?php echo wp_kses_post( $description  ); ?>
        </div>
    <?php endif; ?>
</div>