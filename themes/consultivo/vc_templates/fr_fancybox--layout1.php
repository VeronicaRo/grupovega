<?php
extract(shortcode_atts(array(
    'number' => '',
    'number_color' => '',
    'title' => '',
    'title_color' => '',
    'title_font_size' => '',
    'title_line_height' => '',
    'subtitle'          => '',
    'subtitle_color'    => '',
    'description' => '',
    'description_color' => '',
    'btn_text' => 'read more',
    'btn_link' => '#',
    'animation' => '',
    'el_class' => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
$link = vc_build_link($btn_link);
$a_href = '';
$a_target = '';
if ( strlen( $link['url'] ) > 0 ) {
    $a_href = $link['url'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}
?>
<div class="fr-fancybox-layout1  <?php echo esc_attr($el_parallax_class.' '.$el_class.' '.$animation_classes);?>" <?php echo esc_attr($parallax_speed); ?>>
	<div class="fr-fancybox-inner clearfix">
        <div class="fr-fancybox-number">
            <span class="number" style="color:<?php echo esc_attr($number_color);?>"><?php echo esc_attr($number);?>.</span>
        </div>
        <div class="fr-fancybox-content">
            <?php if(!empty($title)) : ?>
                <p class="fr-fancybox-subtitle" style="color:<?php echo esc_attr( $subtitle_color ); ?>;">
                    <?php echo wp_kses_post( $subtitle ); ?>
                </p>
            <?php endif;?>
            <?php if(!empty($title)) : ?>
                <h3 class="fr-fancybox-title" style="color:<?php echo esc_attr( $title_color ); ?>;font-size:<?php echo esc_attr( $title_font_size ); ?>;line-height:<?php echo esc_attr( $title_line_height ); ?>;">
                    <?php echo wp_kses_post( $title ); ?>
                </h3>
            <?php endif;?>
            <?php if($description) : ?>
                <div class="fr-fancybox-description" style="color:<?php echo esc_attr( $description_color ); ?>;">
                    <?php echo wp_kses_post(str_replace(']','></i>',str_replace('[i','<i',$description))); ?>
                </div>
            <?php endif; ?>
            <?php if(!(empty($btn_text))) : ?>
                <a href="<?php echo esc_url($a_href); ?>" target="<?php echo esc_attr($a_target); ?>" class="fr-fancybox-link"><i class="fa fa-plus"></i> <?php echo esc_attr($btn_text); ?></a>
            <?php endif; ?>
        </div>
	</div>
</div>