<?php
extract(shortcode_atts(array(
    'source'               => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'post_ids'             => '',
    'display_row'          => "",
    'animation'             => '',
    'el_class'             => '',
    'img_size'             => 'consultivo-medium',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'consultivo-carousel' );
$html_id = cmsHtmlID('fr-blog-carousel');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
extract(cms_get_posts_of_grid('portfolio', $atts));
extract(consultivo_get_param_carousel($atts));
?>

<div id="<?php echo esc_attr($html_id) ?>" class="fr-case-studies-carousel consultivo-carousel owl-carousel animation-time <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?>>
    <?php if (is_array($posts)):
        $item = 0;
        $count = 0;
        foreach ($posts as $post) {
            $img_id       = get_post_thumbnail_id( $post->ID );
            $img          = wpb_getImageBySize( array(
                'attach_id'  => $img_id,
                'thumb_size' => $img_size,
                'class'      => '',
            ) );
            $thumbnail    = $img['p_img_large'][0];
            if($display_row == "two") {
                if ($item == 0) {
                    echo '<div class="cms-carousel-item ' . $animation_classes . '">';
                }
            }
            $count++;
            ?>
                <div class="grid-item-inner">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) : ?>
                        <div class="item-featured" style="background: url('<?php echo esc_url($thumbnail);?>')">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <div class="overlay-primary"></div>
                                <i class="zmdi zmdi-plus"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="item-holder">
                        <?php if(get_the_terms($post->ID,'portfolio-category')){?>
                        <div class="cat">
                            <?php the_terms( $post->ID, 'portfolio-category', '', ', ' ); ?>
                        </div>
                        <?php } ?>
                        <h3>
                            <a href="<?php echo get_the_permalink($post->ID);?>"><?php echo get_the_title($post->ID);?></a>
                        </h3>
                    </div>
                </div>
            <?php
            if($display_row == "two") {
                if ($item == 1 || ($count == count($posts))) {
                    echo '</div>';
                    $item = 0;
                } else {
                    $item++;
                }
            }
        }
    endif; ?>
</div>