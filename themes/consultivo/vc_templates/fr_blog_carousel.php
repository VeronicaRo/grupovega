<?php
extract(shortcode_atts(array(
    'source'               => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'post_ids'             => '',
    'animation'             => '',
    'layout1_style'        => 'style1',
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
extract(cms_get_posts_of_grid('post', $atts));
extract(consultivo_get_param_carousel($atts));
?>

<div id="<?php echo esc_attr($html_id) ?>" class="fr-blog-carousel  owl-carousel animation-time <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?>>
    <?php if (is_array($posts)):
        foreach ($posts as $post) {
            $img_id       = get_post_thumbnail_id( $post->ID );
            $img          = wpb_getImageBySize( array(
                'attach_id'  => $img_id,
                'thumb_size' => $img_size,
                'class'      => '',
            ) );
            $thumbnail    = $img['p_img_large'][0];
            ?>
            <div class="cms-carousel-item <?php echo esc_attr( $animation_classes ); ?>">
                <div class="grid-item-inner <?php echo esc_attr($layout1_style); ?>">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) : ?>
                         <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                             <div class="item-featured" style="background: url('<?php echo esc_url($thumbnail); ?>')">
                                 <i class="zmdi zmdi-plus"></i>
                             </div>
                         </a>
                    <?php endif; ?>
                    <div class="item-holder">
                        <div class="post-meta clearfix">
                            <ul class="entry-meta">
                                <?php if(get_the_terms($post->ID, 'category')){ ?>
                                    <li>
                                        <?php the_terms($post->ID, 'category', '', ', ' );  ?>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="data">
                                <h2 class="entry-title">
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                        <?php echo  get_the_title($post->ID); ?>
                                    </a>
                                </h2>
                                <span class="entry-date"><?php echo get_the_date('',$post->ID); ?></span>
                            </div>
                        </div>
                        <div class="entry-content">
                            <?php
                            $cms_the_excerpt = get_the_excerpt($post->ID);
                            if(!empty($cms_the_excerpt)) {
                                echo wp_trim_words( $cms_the_excerpt , $num_words = 25, $more = null );
                            } else {
                                echo wp_trim_words( strip_shortcodes( $post->post_content ), $num_words = 20, $more = null );
                            }
                            ?>
                        </div>
                        <div class="entry-more">
                            <a class="read-more" href="<?php echo esc_url( get_permalink($post->ID)); ?>"><i class="fa fa-plus"></i> <?php echo esc_html__('Read More', 'consultivo')?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    endif; ?>
</div>