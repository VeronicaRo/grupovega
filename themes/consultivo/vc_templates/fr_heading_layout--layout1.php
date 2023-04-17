<?php
extract(shortcode_atts(array(
    'title' => '',
    'text' => '',
    'align_lg' => 'align-left',
    'align_md' => 'align-left-md',
    'align_sm' => 'align-left-sm',
    'align_xs' => 'align-left-xs',

    'title_color' => '',
    'text_color' => '',

    'animation' => '',
    'el_class' => '',
    'el_parallax' => 'false',
    'el_parallax_speed' => '1.5',
), $atts));
$html_id = cmsHtmlID('fr-heading-layout');

$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
?>
<div id="<?php echo esc_attr($atts['html_id']);?>" class="cms-heading-layout layout1  <?php echo esc_attr( $el_parallax_class.' '.$align_lg.' '.$align_md.' '.$align_sm.' '.$align_xs.' '.$animation_classes ); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <?php if(!empty($title)){?><h3 class="title" <?php echo !empty($title_color)?'style="color:'.$title_color.'"':'';?>><?php echo wp_kses_post($title);?></h3><?php } ?>
    <?php if(!empty($text)){?><p class="text" <?php echo !empty($text_color)?'style="color:'.$text_color.'"':'';?>><?php echo wp_kses_post($text);?></p><?php } ?>
</div>