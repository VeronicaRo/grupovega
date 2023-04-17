<?php
extract(shortcode_atts(array(
    'client_item' => '',
    'el_class' => '',
    'animation' => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',

), $atts));

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'consultivo-carousel' );
$html_id = cmsHtmlID('fr-client-carousel');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
extract(consultivo_get_param_carousel($atts));
$clients = (array) vc_param_group_parse_atts($client_item);
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
if(!empty($clients)) : ?>

    <div id="<?php echo esc_attr($html_id);?>" class="fr-client-carousel layout1  default owl-carousel <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?>>
        <?php foreach ($clients as $key => $value) {
            $image = isset($value['image']) ? $value['image'] : '';
            $default_size = 'full';
            $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
            $image_title = get_the_title($image);
            if ( empty( $image_alt )) {$image_alt = $image_title;}
            $image_url = wp_get_attachment_image_src($image, $default_size);

            $client_link = isset($value['link']) ? $value['link'] : '';
            $link = vc_build_link($client_link);
            $a_href = '';
            $a_target = '';
            if ( strlen( $link['url'] ) > 0 ) {
                $a_href = $link['url'];
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            ?>
            <div class="fr-client-item <?php echo esc_attr( $animation_classes ); ?>">
                <?php if(!empty($image_url)): ?>
                    <a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>">
                     <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>">
                    </a>
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>

<?php endif;?>