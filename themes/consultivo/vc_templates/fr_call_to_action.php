<?php
extract(shortcode_atts(array(
    'title' => '',
    'button_text' => '',
    'button_link' => '',
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
<div class="fr-call-to-action default  <?php echo esc_attr($el_parallax_class.' '.$el_class.' '.$animation_classes); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <?php if(!empty($title)) : ?>
        <div class="fr-cta-content">
            <h3><?php echo esc_attr($title); ?></h3>
        </div>
    <?php endif; ?>
    <?php if(!empty($button_text)) : ?>
        <div class="fr-cta-button">
            <a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>" class="btn">
                <?php echo esc_html($button_text); ?>
            </a>
        </div>
    <?php endif; ?>
</div>