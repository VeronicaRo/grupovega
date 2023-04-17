<?php
extract($atts);

//wp_enqueue_script( 'owl-carousel', cmssuperheroes()->path('APP_URL').'assets/js/owl.carousel.min.js' );
$css_classes = ['cms-carousel-core', 'cms-carousel-layout1', 'owl-theme',$el_class];
$css_classes = apply_filters( 'cms_carousel_shortcode_css_class', $css_classes );
$rtl = is_rtl() ? 'true' : 'false';
$carousel_attrs = [
    'data-rtl="'.$rtl.'"',
    'data-margin="'.$margin.'"',
    'data-loop="'.$loop.'"',
    'data-nav="'.$nav.'"',
    'data-dots="'.$dots.'"',
    'data-autoplay="'.$autoplay.'"',
    'data-large-items="'.$large_items.'"',
    'data-medium-items="'.$medium_items.'"',
    'data-small-items="'.$small_items.'"',
    'data-xsmall-items="'.$xsmall_items.'"'
];
$carousel_attrs = apply_filters( 'cms_carousel_data_settings', $carousel_attrs );
?>
<div class="<?php echo trim(implode(' ', $css_classes)); ?>" <?php echo implode(' ', $carousel_attrs); ?>>
    <?php
    if (is_array($contents)):
        foreach ($contents as $key => $shortcode) {
            ?>
            <div class="cms-carousel-item">
                <?php echo cms_do_the_content($shortcode) ?>
            </div>
            <?php
        }
    endif;
    ?>
</div>
