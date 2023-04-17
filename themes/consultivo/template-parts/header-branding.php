<?php
/**
 * Template part for displaying site branding
 */
$header_id = consultivo_get_opt('header_layout');

if(is_page() && consultivo_get_page_opt('custom_header') == true){
    $header_id = consultivo_get_page_opt('header_layout');
}
$logo = consultivo_get_opt( 'logo', array( 'url' => '', 'id' => '' ) );
$logo_url = $logo['url'];
if($header_id == 2 || $header_id == 3 || $header_id == 9){
    $logo = consultivo_get_opt( 'dark_logo', array( 'url' => '', 'id' => '' ) );
    $logo_url = $logo['url'];
}
$logo_sticky = consultivo_get_opt( 'logo_sticky', array( 'url' => '', 'id' => '' ) );
$logo_sticky_url = $logo_sticky['url'];

if ($logo_url)
{
    if ( is_front_page() && is_home() ) {
        printf('<h1 class="site-title">');
    }
    printf(
        '<a class="logo" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_url )
    );
    printf(
        '<a class="logo-sticky" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_sticky_url )
    );
    if ( is_front_page() && is_home() ) {
        printf('</h1>');
    }
}
else
{
    if ( is_front_page() && is_home() ) {
        printf('<h1 class="site-title">');
    }
    printf(
        '<a class="logo" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( get_template_directory_uri().'/assets/images/logo.png' )
    );
    printf(
        '<a class="logo-sticky" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( get_template_directory_uri().'/assets/images/sticky-logo.png' )
    );
    if ( is_front_page() && is_home() ) {
        printf('</h1>');
    }

}