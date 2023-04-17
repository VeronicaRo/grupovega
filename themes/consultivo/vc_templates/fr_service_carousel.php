<?php
extract(shortcode_atts(array(
    'source'               => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'post_ids'             => '',
    'animation'             => '',
    'el_class'             => '',
    'img_size'             => 'consultivo-medium',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'consultivo-carousel' );
$html_id = cmsHtmlID('fr-service-carousel');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
extract(cms_get_posts_of_grid('services', $atts));
extract(consultivo_get_param_carousel($atts));
?>

<div id="<?php echo esc_attr($html_id) ?>" class="fr-service-carousel fr-service-grid   owl-carousel animation-time <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?>>
    <?php if (is_array($posts)) {
        $sizes = explode(',', $img_size);
        $i = 0;
        foreach ($posts as $post) {
            $default_size = 'large';
            if (!empty($sizes[$i])) {
                $default_size = $sizes[$i];
            } ?>
            <div class="service-item-grid-default">
                <div class="fr-fancybox-inner clearfix">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {?>
                        <div class="item-icon"><?php
                         $icon = get_post_thumbnail_id($post->ID);
                         $default_size = 'full';
                         $image_alt = get_post_meta($icon, '_wp_attachment_image_alt', true);
                         $image_title = get_the_title($icon);
                         if ( empty( $image_alt )) {$image_alt = $image_title;}
                         $image_url = wp_get_attachment_image_src($icon, $default_size);?>
                         <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>">
                        </div>
                    <?php } ?>
                    <div class="item-content">
                        <h3 class="item-title">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                        </h3>
                        <div class="item-description">
                            <?php
                            $cms_the_excerpt = get_the_excerpt($post->ID);
                            if (!empty($cms_the_excerpt)) {
                                echo wp_trim_words($cms_the_excerpt);
                            } else {
                                echo wp_trim_words(strip_shortcodes($post->post_content), $num_words = 13, $more = '.');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    } ?>
</div>