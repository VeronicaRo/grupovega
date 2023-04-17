<?php
/**
 * The template for displaying all single posts
 *
 * @package consultivo
 */

get_header();

if (is_singular('product')) :
    $sidebar_pos = consultivo_get_opt('sidebar_shop', 'right');
else :
    $sidebar_pos = consultivo_get_opt('post_sidebar_pos', 'right');
endif;
$post_comment_on = consultivo_get_opt('post_comment_on', true);
$page_for_posts = get_option('page_for_posts');
?>
    <div class="container content-container">
        <div class="row content-row">
            <div id="primary" <?php consultivo_primary_class($sidebar_pos, 'content-area'); ?>>
                <main id="main" class="site-main">
                    <?php
                    while (have_posts()) {
                        the_post();
                        get_template_part('template-parts/content-single/content');
                        if (comments_open() || get_comments_number() && $post_comment_on) {
                            comments_template();
                        }
                    }
                    ?>
                </main><!-- #main -->
            </div><!-- #primary -->

            <?php if ('left' == $sidebar_pos || 'right' == $sidebar_pos) : ?>
                <aside id="secondary" <?php consultivo_secondary_class($sidebar_pos, 'widget-area'); ?>>
                    <?php get_sidebar(); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
<?php
consultivo_set_post_views(get_the_ID());
get_footer();
