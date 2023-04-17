<?php
extract(shortcode_atts(array(
    'icon_list' => 'image_icon',
    'icon_fontawesome' => '',
    'image_icon' => '',
    'title' => 'Basic',
    'text' => '',
    'currency_icon' => '',
    'price' => '20',
    'button_text' => 'get started',
    'button_link' => '#',
    'animation' => '',
    'el_class'  => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
),$atts));
$icon = $image_icon;
if($icon_list == 'fontawesome'){
    $icon  = $icon_fontawesome;
}

$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';

$link = vc_build_link($button_link);
$a_href = '';
$a_target = '';
if ( strlen( $link['url'] ) > 0 ) {
    $a_href = $link['url'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}
?>
<div class="fr-price-list-default <?php echo esc_attr( $el_parallax_class.' '.$el_class.' '.$animation_classes )?>">
    <div class="fr-price-content">
        <div class="header">
            <div class="icon">
                <?php if($icon_list == 'image_icon'){
                 $default_size = 'full';
                 $image_alt = get_post_meta($icon, '_wp_attachment_image_alt', true);
                 $image_title = get_the_title($icon);
                 if ( empty( $image_alt )) {$image_alt = $image_title;}
                 $image_url = wp_get_attachment_image_src($icon, $default_size);?>
                 <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>">
                <?php }else{?>
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                <?php }?>
            </div>
            <h3><?php echo esc_attr($title); ?></h3>
        </div>
        <div class="price">
            <p><span><?php echo wp_kses_post($currency_icon);?></span><?php echo esc_attr($price); ?></p>
        </div>
        <div class="body">
            <p class="text"><?php echo wp_kses_post(nl2br(strip_tags($text)));?></p>
        </div>
        <div class="footer">
            <a class="button" href="<?php echo esc_url($a_href); ?>" target="<?php echo esc_attr($a_target);?>"><?php echo esc_html($button_text); ?></a>
        </div>
    </div>
</div>
