<?php
extract(shortcode_atts(array(
    'button_text' => '',
    'button_link' => '',
    'button_style' => 'btn-default',
    'button_size' => 'size-default',
    'button_radius' => '',
    'align_lg' => 'align-left',
    'align_md' => 'align-left-md',
    'align_sm' => 'align-left-sm',
    'align_xs' => 'align-left-xs',
    'padding_top'    => '',
    'padding_right'  => '',
    'padding_bottom' => '',
    'padding_left'   => '',
    'margin_top' => '',
    'margin_right' => '',
    'margin_bottom' => '',
    'margin_left' => '',
    'br_top'   => '',
    'br_right'   => '',
    'br_bottom'   => '',
    'br_left'   => '',
    'button_icon' => false,
    'animation'   => '',
    'el_class'   => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
$link = vc_build_link($button_link);
$a_href = '';
$a_target = '';
if ( strlen( $link['url'] ) > 0 ) {
    $a_href = $link['url'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}

$style_padding = array(
    'padding-top'    => $padding_top,
    'padding-right'  => $padding_right,
    'padding-bottom' => $padding_bottom,
    'padding-left'   => $padding_left,
    'margin-top'    => $margin_top,
    'margin-right'  => $margin_right,
    'margin-bottom' => $margin_bottom,
    'margin-left'   => $margin_left,
    'border-top-left-radius'   => $br_top,
    '-webkit-border-top-left-radius'   => $br_top,
    'border-top-right-radius'   => $br_right,
    '-webkit-border-top-right-radius'   => $br_right,
    'border-bottom-left-radius'   => $br_left,
    '-webkit-border-bottom-left-radius'   => $br_left,
    'border-bottom-right-radius'   => $br_bottom,
    '-webkit-border-bottom-right-radius'   => $br_bottom,
);
$styles = '';
foreach ($style_padding as $key => $value) {
    if (!empty($value)) {
        $styles .= $key . ':' . $value . ';';
    }
}

$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );

?>
<div class="cms-button-wrapper <?php echo esc_attr($el_parallax_class.' '.$align_lg.' '.$align_md.' '.$align_sm.' '.$align_xs.' '.$el_class.' '.$animation_classes); ?>" <?php echo esc_attr($parallax_speed); ?>>

    <a <?php echo !empty($styles) ? 'style="' . esc_attr($styles) . '"' : '' ?> href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>" class="btn <?php echo esc_attr($button_style.' '.$button_size.' '.$button_radius); if($button_icon == true){ echo esc_attr( ' has-icon' ); } ?>">
        <span><?php echo esc_attr($button_text); ?></span>
    </a>

</div>