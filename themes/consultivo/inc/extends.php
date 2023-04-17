<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package consultivo
 */

/**
 * Setup default image sizes after the theme has been activated
 */
function consultivo_after_setup_theme()
{

}
add_action( 'after_setup_theme', 'consultivo_after_setup_theme' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function consultivo_body_classes( $classes )
{
    // Adds a class for single post type extra
//    $singe_service_layout = consultivo_get_opt( 'singe_service_layout', 'construction-company' );
//    $singe_portfolio_layout = consultivo_get_opt( 'singe_portfolio_layout', 'construction-company' );
//    if ( is_singular('service') ) {
//        $classes[] = 'single-service-'.$singe_service_layout;
//    }
//    if ( is_singular('portfolio') ) {
//        $classes[] = 'single-portfolio-'.$singe_portfolio_layout;
//    }

    /* Sidebar Style */

    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    if (consultivo_get_opt( 'site_boxed', false )) {
        $classes[] = 'site-boxed';
    }

    if ( class_exists('WPBakeryVisualComposerAbstract') ) {
        $classes[] = 'visual-composer';
    }
    if ( class_exists('Woocommerce') ) {
        $classes[] = 'woocommerce';
    }

    return $classes;
}
add_filter( 'body_class', 'consultivo_body_classes' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function consultivo_pingback_header()
{
    if ( is_singular() && pings_open() )
    {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'consultivo_pingback_header' );
