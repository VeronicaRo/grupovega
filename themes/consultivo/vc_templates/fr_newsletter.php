<?php
extract(shortcode_atts(array(
    'form' => '',
    'nl_title' => 'STAY IN TOUCH',
    'nl_link_text' => 'See our Privacy Policy',
    'nl_link_url' => '#',
    'introduction' => '',
    'introduction_color' => '',
    'animation'   => '',
    'el_class'   => '',
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
$link = vc_build_link($nl_link_url);
$a_href = '';
$a_target = '';
if ( strlen( $link['url'] ) > 0 ) {
    $a_href = $link['url'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}
$defined_forms = array( 'form_1', 'form_2', 'form_3', 'form_4', 'form_5', 'form_6', 'form_7', 'form_8', 'form_9', 'form_10' );
if(class_exists('Newsletter')) { ?>
    <div class="fr-newsletter placeholder-white <?php echo esc_attr( $el_parallax_class.' '.$el_class.' '.$animation_classes ); ?>" <?php echo esc_attr($parallax_speed); ?>>
        <div class="fr-newsletter-inner">
            <?php if(!empty($introduction)) : ?>
                <div class="fr-newsletter-top">
                    <p class="fr-newsletter-title">
                        <?php echo esc_attr($nl_title); ?>
                    </p>
                    <h3 class="fr-newsletter-heading" style="color: <?php echo esc_attr( $introduction_color ); ?>;">
                        <?php
                            echo wp_kses_post($introduction);
                        ?>
                    </h3>
                </div>
            <?php endif; ?>
            <?php
            if ( in_array( $form, $defined_forms ) ) {
                $form = str_replace( 'form_', '', $form );
                echo do_shortcode( '[newsletter_form form="' . esc_attr( $form ) . '"]' );
            } else {
                echo NewsletterSubscription::instance()->get_subscription_form_html5();
            }
            ?>
            <a href="<?php echo esc_url($a_href);?>" target="<?php echo esc_attr($a_target);?>" class="fr-newsletter-link"><?php echo esc_attr($nl_link_text); ?></a>
        </div>
    </div>
<?php } ?>