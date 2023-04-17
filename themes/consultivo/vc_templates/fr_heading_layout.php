<?php
extract(shortcode_atts(array(
    'title' => '',
    'subtitle' => '',
    'text' => '',
    'align_lg' => 'align-center',
    'align_md' => 'align-center-md',
    'align_sm' => 'align-center-sm',
    'align_xs' => 'align-center-xs',

    'title_color' => '',
    'subtitle_color' => '',
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
<div id="<?php echo esc_attr($atts['html_id']);?>" class="cms-heading-layout  <?php echo esc_attr( $el_parallax_class.' '.$align_lg.' '.$align_md.' '.$align_sm.' '.$align_xs.' '.$animation_classes ); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <?php if(!empty($subtitle)){?><p class="subtitle" <?php echo !empty($subtitle_color)?'style="color:'.$subtitle_color.'"':'';?>><?php echo wp_kses_post($subtitle);?></p><?php } ?>
    <?php if(!empty($title)){?><h3 class="title" <?php echo !empty($title_color)?'style="color:'.$title_color.'"':'';?>><?php echo wp_kses_post($title);?></h3><?php } ?>
    <?php if(!empty($text)){?><p class="text" <?php echo !empty($text_color)?'style="color:'.$text_color.'"':'';?>><?php echo wp_kses_post($text);?></p><?php } ?>
</div>