<?php
extract(shortcode_atts(array(

    'title'         => '',
    'title_color'         => '',
    'grouping'         => '0',
    'separator'         => '',
    'digit'         => '',
    'digit_color'         => '',
    'prefix'         => '',
    'suffix'         => '',
    'el_class'         => '',
    'animation'         => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',

), $atts));
wp_enqueue_script( 'waypoints' );
wp_enqueue_script( 'consultivo-counter-lib' );
wp_enqueue_script( 'consultivo-counter' );
$html_id = cmsHtmlID('fr-counter');
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
<div id="<?php echo esc_attr($html_id);?>" class="cms-counter cms-counter-default <?php echo esc_attr( $el_parallax_class.' '.$animation_classes.' '.$el_class ); ?>" <?php echo esc_attr($parallax_speed); ?>>

    <div class="cms-counter-inner">
        <span id="<?php echo esc_attr($html_id);?>-digit" class="cms-counter-digit text-heading" data-grouping="<?php echo esc_attr($grouping); ?>" data-separator="<?php echo esc_attr($separator); ?>" data-digit="<?php echo esc_attr($digit);?>" data-prefix="<?php echo esc_attr($prefix);?>" data-suffix="<?php echo esc_attr($suffix);?>" style="<?php if(!empty($digit_color)) { echo 'color:'.esc_attr($digit_color).';'; } ?>"></span>
        <?php if(!empty($title)) : ?>
            <h3 class="cms-counter-title" style="<?php if(!empty($title_color)) { echo 'color:'.esc_attr($title_color).';'; } ?>">
                <?php echo apply_filters('the_title',$title);?>
            </h3>
        <?php endif;?>
    </div>
</div>