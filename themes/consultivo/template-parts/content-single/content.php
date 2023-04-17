<?php
/**
 * Template part for displaying posts in loop
 *
 * @package consultivo
 */
$post_feature_image_on = consultivo_get_opt('post_feature_image_on', true);
$post_share_on = consultivo_get_opt('post_social_share_on', false);
$post_author_info_con_company = consultivo_get_opt('author_info', false);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-hentry'); ?>>
    <div class="entry-featured">
        <?php
        $gallery_list = explode(',', consultivo_get_post_format_value('post-gallery-images', ''));

        if (has_post_format('gallery') && $gallery_list[0]) : ?>
            <?php
            $light_box = consultivo_get_post_format_value('post-gallery-lightbox', '0');
            wp_enqueue_script('owl-carousel');
            wp_enqueue_script('consultivo-carousel');
            ?>
            <div class="cms-carousel owl-carousel featured-active <?php if ($light_box) {
                echo 'images-light-box';
            } ?>" data-item-xs="1" data-item-sm="1" data-item-md="1" data-item-lg="1" data-margin="30" data-loop="true"
                 data-autoplay="true" data-autoplaytimeout="5000" data-smartspeed="250" data-center="false"
                 data-arrows="true" data-bullets="false" data-stagepadding="0" data-stagepaddingsm="0" data-rtl="false">
                <?php
                foreach ($gallery_list as $img_id):
                    ?>
                    <div class="cms-carousel-item">
                        <a class="light-box"
                           href="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'full')); ?>"><img
                                    src="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'large')); ?>"
                                    alt="<?php echo esc_attr(get_post_meta($img_id, '_wp_attachment_image_alt', true)) ?>"></a>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        <?php elseif (has_post_format('quote')) : ?>
            <?php
            $quote_text = consultivo_get_post_format_value('post-quote-cite', '');
            echo esc_attr($quote_text);
            ?>
        <?php elseif (has_post_format('link')) : ?>
            <?php
            $link_pf = consultivo_get_post_format_value('post-link-url', '#');
            echo esc_url($link_pf);
            ?>
        <?php elseif (has_post_format('video')) : ?>
            <div class="entry-video featured-active">
                <?php
                $video_url = consultivo_get_post_format_value('post-video-url', '#');
                $video_file = consultivo_get_post_format_value('post-video-file', '');
                $video_html = consultivo_get_post_format_value('post-video-html', '');
                $video = '';
                if (!empty($video_url)) {
                    global $wp_embed;

                    if (function_exists('cms_allow_html')) {
                        cms_allow_html($wp_embed->run_shortcode('[embed]' . $video_url . '[/embed]'));
                    } else {
                        echo wp_kses_post($wp_embed->run_shortcode('[embed]' . $video_url . '[/embed]'));
                    }
                } elseif (!empty($video_file)) {
                    if (strpos('[embed', $video_file)) {
                        global $wp_embed;

                        if (function_exists('cms_allow_html')) {
                            cms_allow_html($wp_embed->run_shortcode($video_file));
                        } else {
                            echo wp_kses_post($wp_embed->run_shortcode($video_file));
                        }
                    } else {
                        echo do_shortcode($video_file);
                    }
                } else {
                    if ('' != $video_html) {
                        if (function_exists('cms_allow_html')) {
                            cms_allow_html($video_html);
                        } else {
                            echo wp_kses_post($video_html);
                        }
                    }
                }
                ?>
            </div>
        <?php elseif (has_post_format('audio')) : ?>
            <?php
            $audio_url = consultivo_get_post_format_value('post-audio-url', '#');
            echo esc_url($audio_url);
            ?>
        <?php else : ?>
            <?php
            if (has_post_thumbnail() && $post_feature_image_on) {
                echo '<div class="post-image">'; ?>
                <?php the_post_thumbnail('full'); ?>
                <?php echo '</div>';
            }
            ?>
        <?php endif; ?>
    </div><!-- .entry-featured -->
    <div class="entry-body">
        <div class="entry-content clearfix">
            <?php
            consultivo_archive_meta_post();
            the_content();
            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'consultivo') . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
            ));
            ?>
            <?php if (get_the_tags()) { ?>
                <div class="tag-share <?php echo esc_attr($post_share_on ? 'row' : ''); ?> clear-both">
                    <?php if ($post_share_on) { ?>
                        <div class="col-md-5">
                            <div class="share">
                                Share:<?php consultivo_socials_share(); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-<?php echo !$post_share_on ? '120' : '7'; ?>">
                        <div class="tags <?php echo !$post_share_on ? 'text-left' : ''; ?>">
                            <?php the_tags('', ' ', ''); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div><!-- .entry-content -->
    </div>
    <?php if (get_previous_post() || get_next_post()) { ?>
        <div class="col-12">
            <div class="row prev-next-post">
                <div class="col-md-6 prev-post">
                    <?php $pre_post = get_previous_post(); ?>
                    <?php if (!empty($pre_post)) {
                        $featured_img_url = get_the_post_thumbnail_url($pre_post->ID, 'thumbnail');
                        ?>
                        <div class="previous-post">
                            <div class="thumb">
                                <?php if (!empty($featured_img_url)) { ?>
                                    <?php
                                    $icon = get_post_thumbnail_id($pre_post->ID);
                                    $image_alt = get_post_meta($icon, '_wp_attachment_image_alt', true);
                                    $image_title = get_the_title($icon);
                                    if (empty($image_alt)) {
                                        $image_alt = $image_title;
                                    } ?>
                                    <img src="<?php echo esc_url($featured_img_url); ?>"
                                         alt="<?php echo esc_attr($image_alt); ?>">
                                <?php } ?>
                            </div>
                            <div class="link">
                                <span>Previous</span>
                                <a href="<?php echo esc_url(get_permalink($pre_post->ID)); ?>">
                                    <?php echo wp_kses_post($pre_post->post_title == '' ? esc_html('No Title') : $pre_post->post_title); ?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6 next-post">
                    <?php $next_post = get_next_post(); ?>
                    <?php if (!empty($next_post)) {
                        $featured_img_url = get_the_post_thumbnail_url($next_post->ID, 'thumbnail');
                        ?>
                        <div class="previous-post">
                            <div class="thumb">
                                <?php if (!empty($featured_img_url)) { ?>
                                    <?php
                                    $icon = get_post_thumbnail_id($next_post->ID);
                                    $image_alt = get_post_meta($icon, '_wp_attachment_image_alt', true);
                                    $image_title = get_the_title($icon);
                                    if (empty($image_alt)) {
                                        $image_alt = $image_title;
                                    } ?>
                                    <img src="<?php echo esc_url($featured_img_url); ?>"
                                         alt="<?php echo esc_attr($image_alt); ?>">
                                <?php } ?>
                            </div>
                            <div class="link">
                                <span>Next</span>
                                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                                    <?php echo wp_kses_post($next_post->post_title == '' ? esc_html('No Title') : $next_post->post_title); ?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php
    $content = get_the_author_meta('description');
    if ($post_author_info_con_company && !empty($content)) : ?>
        <div class="entry-author-info">
            <div class="author-post clearfix">
                <div class="author-avatar">
                    <?php echo get_avatar(get_the_author_meta('ID'), 'medium'); ?>
                </div>
                <div class="author-description">
                    <h3><?php echo get_the_author(); ?></h3>
                    <p>
                        <?php the_author_meta('description'); ?>
                    </p>
                    <?php consultivo_get_user_social(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</article><!-- #post -->

