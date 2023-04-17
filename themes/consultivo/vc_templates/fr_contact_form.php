<?php
extract(shortcode_atts(array(
    'id'        => '',
    'title' => '',
    'description' => '',
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
    <div class="fr-contact-form fr-contact-form-default  <?php echo esc_attr( $el_parallax_class.' '.$el_class.' '.$animation_classes .' '. $style)?>" <?php echo esc_attr($parallax_speed); ?> style="background: <?php if(!empty($form_bg)){ echo esc_attr($form_bg); } ?>">
        <h3 <?php if(!empty($title_color)):?>style="color: <?php echo esc_attr($title_color);?>" <?php endif;?>><?php echo wp_kses_post($title);?></h3>
        <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $id ).'"]'); ?>
    </div>
<?php } ?>