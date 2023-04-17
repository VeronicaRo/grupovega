<?php
extract(shortcode_atts(array(
    'video_source'          => 'https://vimeo.com/81527238',
    'video_autoplay'        => false,
    'video_image'           => '',
    'button_text'           => '',
    'popup_style'           => '',
    'animation'             => '',
    'el_class'              => '',
    'el_parallax'           => 'false',
    'el_parallax_speed'     => '1.5',
), $atts));
$html_id = cmsHtmlID('fr-video-popup');
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

<div id="<?php echo esc_attr($html_id) ?>" class="fr-video-popup <?php echo esc_attr(  $el_parallax_class.' '.$el_class.' '.$animation_classes ); ?>"  <?php echo esc_attr($parallax_speed); ?>>
    <div class="fr-video-popup-content">
        <?php if($popup_style != "video-no-image"){?>
         <?php
         $default_size = 'full';
         $image_alt = get_post_meta($video_image, '_wp_attachment_image_alt', true);
         $image_title = get_the_title($video_image);
         if ( empty( $image_alt )) {$image_alt = $image_title;}
         $image_url = wp_get_attachment_image_src($video_image, $default_size);?>
         <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>">
        <?php } ?>
        <a class="<?php if($video_autoplay){?>video-autoplay<?php }else{ ?>video-no-autoplay<?php } ?> play-video-button <?php if($popup_style != "video-no-image"){ echo 'has-image'; } ?>" href="<?php echo esc_url($video_source);?>">
            <div class="icon">
                <i class="fa fa-play"></i>
                <span class="radar"></span>
            </div>
            <p class="button-text"><?php echo esc_html($button_text);?></p>
        </a>
    </div>
</div>