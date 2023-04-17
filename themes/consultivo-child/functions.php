<?php

/**
 * Add child styles.
 * 
 * @author CMS
 * @since 1.0.0
 */
function consultivo_enqueue_styles()
{
    $parent_style = 'consultivo-style';
    
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array(
        $parent_style
    ));
}

add_action('wp_enqueue_scripts', 'consultivo_enqueue_styles');

/**
 * Load vc template dir.
 * 
 * @author CMS
 * @since 1.0.0
 */
if (function_exists("vc_set_shortcodes_templates_dir")) {
    vc_set_shortcodes_templates_dir(get_stylesheet_directory() . "/vc_templates/");
}

add_action('after_switch_theme', 'consultivo_child_redirect_to_welcome_page');
function consultivo_child_redirect_to_welcome_page()
{
    if (is_child_theme()) {
        $parent_theme = wp_get_theme()->parent();
        if (class_exists('CMS_PORTAL')) {
            wp_safe_redirect(admin_url("themes.php?page={$parent_theme->get('TextDomain')}"));
        } else {
            wp_safe_redirect(admin_url("themes.php?page={$parent_theme->get('TextDomain')}-welcome"));
        }
    }
}