<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package consultivo
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="row">
                <div class="col-12">
                    <section class="error-404 text-center">
                        <header>
                            <h1><?php echo esc_html__( '404', 'consultivo' ); ?></h1>
                        </header><!-- .page-title -->
                        <div class="page-content">
                            <h3><?php echo esc_html__( 'OH PAGE NOT FOUND', 'consultivo' ); ?></h3>
                            <p><?php echo esc_html__('Sorry, you walked in on the wrong file.','consultivo')?></p>
                            <a class="button" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Back to home', 'consultivo'); ?></a>
                        </div><!-- .page-content -->
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/404.png'?>" alt="<?php echo esc_attr('404 page')?>">
                    </section><!-- .error-404 -->
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
