<?php
extract(shortcode_atts(array(
    'testimonial_item' => '',
    'title_color' => '',
    'position_color' => '',
    'content_color' => '',
    'content_icon' => '',
    'background_icon' => '',
    'el_class' => '',
    'animation' => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'consultivo-carousel' );
$html_id = cmsHtmlID('fr-testimonial-carousel');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
extract(consultivo_get_param_carousel($atts));
$testimonials = (array) vc_param_group_parse_atts($testimonial_item);
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
if (!empty($content_icon)) {
    $attachment_image_icon = wp_get_attachment_image_src($content_icon, 'full');
    $image_content_icon = $attachment_image_icon[0];
    $image_alt_1 = get_post_meta($content_icon, '_wp_attachment_image_alt', true);
    $image_title_1 = get_the_title($content_icon);
    if ( empty( $image_alt_1 )) {$image_alt_1 = $image_title_1;}
}
if (!empty($background_icon)) {
    $attachment_image_bg = wp_get_attachment_image_src($background_icon, 'full');
    $image_bg_icon = $attachment_image_bg[0];
    $image_alt_2 = get_post_meta($background_icon, '_wp_attachment_image_alt', true);
    $image_title_2 = get_the_title($background_icon);
    if ( empty( $image_alt_2 )) {$image_alt_2 = $image_title_2;}
}
if(!empty($testimonials)) : ?>
    <div class="carousel-has-icon-bg">
        <?php if(!empty($image_bg_icon)){?>
            <div class="bg-icon">
                <img src="<?php echo esc_url($image_bg_icon);?>" alt="<?php echo esc_attr($image_alt_2);?>">
            </div>
        <?php } ?>
        <div id="<?php echo esc_attr($html_id);?>" class="fr-testimonial-carousel default owl-carousel <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?>>
            <?php foreach ($testimonials as $key => $value) {
                $title = isset($value['title']) ? $value['title'] : '';
                $content = isset($value['content']) ? $value['content'] : '';
                $position = isset($value['position']) ? $value['position'] : '';
                $image = isset($value['image']) ? $value['image'] : '';
                ?>
                <div class="fr-testimonial-item <?php echo esc_attr( $animation_classes ); ?>">
                    <div class="fr-testimonial-item-inner">
                        <?php if(!empty($image)): ?>
                            <div class="fr-testimonial-image"><?php
                             $default_size = 'full';
                             $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                             $image_title = get_the_title($image);
                             if ( empty( $image_alt )) {$image_alt = $image_title;}
                             $image_url = wp_get_attachment_image_src($image, $default_size);?>
                             <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>">
                            </div>
                        <?php endif; ?>
                        <div class="fr-testimonial-content" style="<?php if(!empty($content_color)) { echo 'color:'.esc_attr($content_color).';'; } ?>">
                            <?php echo esc_html($content); ?>
                        </div>
                        <?php if(!empty($image_content_icon)):?>
                            <div class="icon">
                                <img src="<?php echo esc_url($image_content_icon);?>" alt="<?php echo esc_attr($image_alt_1);?>">
                            </div>
                        <?php endif;?>
                        <h3 class="fr-testimonial-title" style="<?php if(!empty($title_color)) { echo 'color:'.esc_attr($title_color).';'; } ?>"><?php echo esc_html($title); ?></h3>
                        <p class="fr-testimonial-position" style="<?php if(!empty($position_color)) { echo 'color:'.esc_attr($position_color).';'; } ?>"><?php echo esc_html($position); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php endif;?>