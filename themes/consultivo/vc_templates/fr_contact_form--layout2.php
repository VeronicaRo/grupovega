<?php
extract(shortcode_atts(array(
    'id'        => '',
    'title' => '',
    'title_color' => '',
    'style' => '',
    'animation' => '',
    'el_class'  => '',
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
if(class_exists('WPCF7')) { ?>
    <div class="fr-contact-form fr-contact-form-layout2 <?php echo esc_attr( $el_parallax_class.' '.$el_class.' '.$animation_classes .' '.$style)?>" <?php echo esc_attr($parallax_speed); ?>>
        <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $id ).'"]'); ?>
    </div>
<?php } ?>