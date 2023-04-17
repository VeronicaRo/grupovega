<?php
extract(shortcode_atts(array(
    'title' => '',
    'title_color' => '',
    'title_font_size' => '',
    'title_line_height' => '',
    'description' => '',
    'description_color' => '',
    'icon_list' => 'image_icon',
    'icon_fontawesome' => '',
    'el_icon'  => '',
    'image_icon' => '',
    'icon_color' => '',
    'icon_font_size' => '',
    'animation' => '',
    'el_class' => '',
    'icon_styles' => 'normal',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
$icon = $image_icon;
if($icon_list == 'fontawesome'){
    $icon  = $icon_fontawesome;
}
if($icon_list == 'el_icon'){
    $icon  = $el_icon;
}
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
?>
<div class="fr-fancybox-default  <?php echo esc_attr($el_parallax_class.' '.$el_class.' '.$animation_classes); ?>" <?php echo esc_attr($parallax_speed); ?>>
	<div class="fr-fancybox-inner clearfix">
        <div class="fr-fancybox-icon">
            <?php if($icon_list == 'image_icon'){
             $default_size = 'full';
             $image_alt = get_post_meta($icon, '_wp_attachment_image_alt', true);
             $image_title = get_the_title($icon);
             if ( empty( $image_alt )) {$image_alt = $image_title;}
             $image_url = wp_get_attachment_image_src($icon, $default_size);?>
             <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>">
            <?php }else{?>
            <i class="<?php echo esc_attr($icon); ?>" style="<?php if(!empty($icon_font_size)) { echo 'font-size:'.esc_attr($icon_font_size).';'; } if(!empty($icon_color)){echo 'color:'.esc_attr($icon_color).';';} ?>"></i>
            <?php }?>
        </div>
        <div class="fr-fancybox-content">
            <?php if(!empty($title)) : ?>
                <h3 class="fr-fancybox-title" style="<?php if(!empty($title_color)) { echo 'color:'.esc_attr($title_color).';'; } if(!empty($title_font_size)) { echo 'font-size:'.esc_attr($title_font_size).';'; } if(!empty($title_line_height)) { echo 'line-height:'.esc_attr($title_line_height).';'; } ?>">
                    <?php echo wp_kses_post( $title ); ?>
                </h3>
            <?php endif;?>
            <?php if($description) : ?>
                <div class="fr-fancybox-description" <?php if(!empty($description_color)) : ?> style="<?php if(!empty($description_color)) { echo 'color:'.esc_attr($description_color).';'; } ?>" <?php endif; ?>>
                    <?php echo wp_kses_post( $description ); ?>
                </div>
            <?php endif; ?>
        </div>
	</div>
</div>