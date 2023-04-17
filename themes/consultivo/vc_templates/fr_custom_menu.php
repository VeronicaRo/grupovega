<?php
extract(shortcode_atts(array(
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
    wp_enqueue_script('tekhrepair-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
?>
<div class="cms-custom-menu-layout1 <?php echo esc_attr($el_parallax_class.' '.$el_class.' '.$animation_classes); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <?php wp_nav_menu(array(
            'fallback_cb' => '',
            'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
            'menu'        => wp_get_nav_menu_object($atts['menu'])
        )
    ); ?>
</div>