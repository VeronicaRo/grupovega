<?php
$atts_extra = shortcode_atts(array(
    'style'                => 'style1',
    'source'               => '',
    'post_ids'             => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'col_lg'               => 4,
    'col_md'               => 3,
    'col_sm'               => 2,
    'col_xs'               => 1,
    'el_class'             => '',
    'img_size'             => 'large',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts);
$atts = array_merge($atts_extra, $atts);
extract($atts);
extract(cms_get_posts_of_grid('services', $atts));

$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
?>

<div id="<?php echo esc_attr($html_id) ?>" class="fr-grid fr-service-grid layout1<?php echo esc_attr($el_parallax_class.' '.$el_class); ?>" <?php echo esc_attr($parallax_speed); ?>>

    <div class="row">
        <?php
        if (is_array($posts)):
            $sizes = explode(',',$img_size);
            $i = 0;
            foreach ($posts as $post) {
                $default_size = 'large';
                if(!empty($sizes[$i])){
                    $default_size = $sizes[$i];
                }
                $item_class = "grid-item col-xl-{$col_lg} col-lg-{$col_md} col-md-{$col_sm} col-sm-{$col_xs} col-{$col_xs}";
                if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :?>
                    <div class="<?php echo esc_attr( $item_class ); ?>">
                        <div class="service-item-grid-default <?php echo esc_attr($style);?>">
                            <div class="fr-fancybox-inner clearfix">
                                <div class="item-icon"><?php
                                 $icon = get_post_thumbnail_id($post->ID);
                                 $default_size = 'full';
                                 $image_alt = get_post_meta($icon, '_wp_attachment_image_alt', true);
                                 $image_title = get_the_title($icon);
                                 if ( empty( $image_alt )) {$image_alt = $image_title;}
                                 $image_url = wp_get_attachment_image_src($icon, $default_size);?>
                                 <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>">
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                                    </h3>
                                    <div class="item-description">
                                        <?php
                                        $cms_the_excerpt = get_the_excerpt($post->ID);
                                        if(!empty($cms_the_excerpt)) {
                                            echo wp_trim_words( $cms_the_excerpt);
                                        } else {
                                            echo wp_trim_words( strip_shortcodes( $post->post_content ), $num_words = 13, $more = '.' );
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
            }
        endif; ?>
    </div>
</div>
