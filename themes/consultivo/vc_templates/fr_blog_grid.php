<?php
$atts_extra = shortcode_atts(array(
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
    'pagination_type'      => 'pagination',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts);
$atts = array_merge($atts_extra, $atts);
extract($atts);
extract(cms_get_posts_of_grid('post', $atts));

$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;
$grid_sizer = "col-xl-{$col_lg} col-lg-{$col_md} col-md-{$col_sm} col-sm-{$col_xs} col-{$col_xs}";

$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
if($pagination_type == 'loadmore' || $pagination_type === 'pagination') {
    wp_enqueue_script('isotope');
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('consultivo-isotope', get_template_directory_uri() . '/assets/js/isotope.cms.js', array('jquery'), '1.0.0', true);
    $html_id = str_replace('-', '_', $html_id);
    wp_enqueue_script('cms-loadmore-grid', get_template_directory_uri() . '/assets/js/cms-loadmore-grid.js', array('jquery'), 'all', true);
    wp_localize_script('cms-loadmore-grid', 'cms_load_more_' . $html_id, array(
        'startPage' => $paged,
        'maxPages'  => $max,
        'total'     => $total,
        'perpage'   => $limit,
        'nextLink'  => $next_link,
    ));
}
?>

<div id="<?php echo esc_attr($html_id) ?>" class="cms-grid fr-grid fr-blog-grid default  <?php echo esc_attr($el_parallax_class.' '.$el_class); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <div class="row">
        <?php
        if (is_array($posts)):
            foreach ($posts as $post) {
                $img_id       = get_post_thumbnail_id( $post->ID );
                $img          = wpb_getImageBySize( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ) );
                $thumbnail    = $img['p_img_large'][0];
                $item_class = "grid-item col-xl-{$col_lg} col-lg-{$col_md} col-md-{$col_sm} col-sm-{$col_xs} col-{$col_xs}";
                ?>
                <div class="<?php echo esc_attr( $item_class ); ?>">
                    <div class="grid-item-inner">
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
                                    echo wp_trim_words( $cms_the_excerpt, $num_words = 30 , $more = '.' );
                                } else {
                                    echo wp_trim_words( strip_shortcodes( $post->post_content ), $num_words = 20, $more = '.' );
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
        endif;?>
    </div>

    <?php if ($pagination_type == 'pagination') { ?>
        <div class="cms-grid-pagination">
            <?php consultivo_posts_pagination(); ?>
        </div>
    <?php } ?>
    <?php if (!empty($next_link) && $pagination_type == 'loadmore') { ?>
        <div class="cms-load-more text-center">
            <span class="button">
                <?php echo esc_html__('view more doctor', 'consultivo') ?>
            </span>
        </div>
    <?php } ?>
</div>