<?php
/**
 * Functions and definitions
 *
 * @package consultivo
 */
if (!function_exists('consultivo_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function consultivo_setup()
    {
        // Make theme available for translation.
        load_theme_textdomain('consultivo', get_template_directory() . '/languages');

        // Custom Header
        add_theme_support("custom-header");

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'consultivo'),
            'megamenu1' => esc_html__('Mega Menu 1','consultivo'),
            'megamenu2' => esc_html__('Mega Menu 2','consultivo'),
            'megamenu3' => esc_html__('Mega Menu 3','consultivo'),
            'megamenu4' => esc_html__('Mega Menu 4','consultivo')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('consultivo_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for core custom logo.
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));
        add_theme_support('post-formats', array(
            'gallery',
            'video',
        ));


        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        /* Change default image thumbnail sizes in wordpress */
        update_option('thumbnail_size_w', 300);
        update_option('thumbnail_size_h', 300);
        update_option('thumbnail_crop', 1);
        update_option('medium_size_w', 600);
        update_option('medium_size_h', 600);
        update_option('medium_crop', 1);
        update_option('large_size_w', 980);
        update_option('large_size_h', 650);
        update_option('large_crop', 1);

        add_image_size('consultivo-medium', 600, 430, true);
        add_image_size('consultivo-large', 1170, 700, true);

        remove_theme_support( 'widgets-block-editor' );
    }
endif;
add_action('after_setup_theme', 'consultivo_setup');

add_action('cms_locations', function ($cms_locations){
//    $cms_locations['cms-test'] ='Test Menu';
    return $cms_locations;
});

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function consultivo_content_width()
{
    $GLOBALS['content_width'] = apply_filters('consultivo_content_width', 640);
}

add_action('after_setup_theme', 'consultivo_content_width', 0);

/**
 * Register widget area.
 */
function consultivo_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Blog Sidebar', 'consultivo'),
        'id'            => 'sidebar-blog',
        'description'   => esc_html__('Add widgets here.', 'consultivo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Page Sidebar', 'consultivo'),
        'id'            => 'sidebar-page',
        'description'   => esc_html__('Add widgets here.', 'consultivo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Shop Sidebar', 'consultivo'),
        'id'            => 'sidebar-shop',
        'description'   => esc_html__('Add widgets here.', 'consultivo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Product Sidebar', 'consultivo'),
        'id'            => 'sidebar-product',
        'description'   => esc_html__('Add widgets here.', 'consultivo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    $footer_top_column = consultivo_get_opt( 'footer_top_column', '5' );
    if(isset($footer_top_column) && $footer_top_column) {

        for($i = 1 ; $i <= $footer_top_column ; $i++){
            register_sidebar(array(
                'name' => sprintf(esc_html__('Footer Top %s', 'consultivo'), $i),
                'id'            => 'sidebar-footer-' . $i,
                'description'   => esc_html__('Add widgets here.', 'consultivo'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="footer-widget-title">',
                'after_title'   => '</h3>',
            ));
        }
    }
}

add_action('widgets_init', 'consultivo_widgets_init');
/**
 * Enqueue scripts and styles.
 */
function consultivo_scripts()
{
    $theme = wp_get_theme(get_template());

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0');
    wp_enqueue_style('font-material-icon', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css', array(), '2.2.0');
    wp_enqueue_style('font-consulicon-icon', get_template_directory_uri() . '/assets/css/consulicon.css', array(), 'all');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.0');
    wp_enqueue_style('YouTubePopUp',get_template_directory_uri() . '/assets/css/YouTubePopUp.css',array(),'all');
    wp_enqueue_style('consultivo-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), 'all');
    wp_enqueue_style('consultivo-menu', get_template_directory_uri() . '/assets/css/menu.css', array(), $theme->get('Version'));
    wp_enqueue_style('consultivo-style', get_stylesheet_uri());
    wp_enqueue_style('consultivo-google-fonts', consultivo_fonts_url());
    wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true);
    wp_enqueue_script('moment-with-locales',get_template_directory_uri() . '/assets/js/moment.js', array('jquery'), 'all', true);
    wp_enqueue_script('bootstrap-datetimepicker-js', get_template_directory_uri() . '/assets/js/fr-datetimepicker.js', array('jquery'), 'all', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('headroom', get_template_directory_uri() . '/assets/js/headroom.min.js', array('jquery'), $theme->get('Version'), true);
    wp_enqueue_script('consultivo-headroom', get_template_directory_uri() . '/assets/js/headroom.js', array('jquery'), $theme->get('Version'), true);

    wp_enqueue_script('nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array( 'jquery' ), 'all', true);
    wp_enqueue_script('enscroll', get_template_directory_uri() . '/assets/js/enscroll.js', array( 'jquery' ), 'all', true);
    wp_enqueue_script('match-height', get_template_directory_uri() . '/assets/js/match-height-min.js', array( 'jquery' ), '1.0.0', true);
    wp_enqueue_script('consultivo-sidebar-fixed', get_template_directory_uri() . '/assets/js/sidebar-scroll-fixed.js', array( 'jquery' ), '1.0.0', true);
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array('jquery'), '1.0.0', true);
    wp_register_script('consultivo-carousel', get_template_directory_uri() . '/assets/js/cms-carousel.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script('consultivo-carousel-filter', get_template_directory_uri() . '/assets/js/owl-filter.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script('consultivo-counter-lib', get_template_directory_uri() . '/assets/js/counter.min.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script('consultivo-counter', get_template_directory_uri() . '/assets/js/cms-counter.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script('consultivo-parallax', get_template_directory_uri() . '/assets/js/cms-parallax.js', array( 'jquery'), $theme->get('Version'), true);
    wp_enqueue_script('video-popup', get_template_directory_uri() . '/assets/js/YouTubePopUp.jquery.js', array('jquery'), '1.0.1', true);
    $smoothscroll = consultivo_get_opt( 'smoothscroll', false );
    if(isset($smoothscroll) && $smoothscroll) {
        wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.min.js', array( 'jquery' ), 'all', true);
    }
    $parallaxscroll = consultivo_get_opt( 'parallaxscroll', false );
    if(isset($parallaxscroll) && $parallaxscroll) {
        wp_enqueue_script('consultivo-parallax');
    }
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('owl-carousel');
    wp_enqueue_script('isotope');
    wp_localize_script('consultivo-main','main_data',array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
    wp_enqueue_script('consultivo-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), 'all', true);

}

add_action('wp_enqueue_scripts', 'consultivo_scripts');

/* add editor styles */
function consultivo_add_editor_styles()
{
    add_editor_style('editor-style.css');
}
add_action('admin_init', 'consultivo_add_editor_styles');

/* add admin styles */
function consultivo_admin_style()
{
    $theme = wp_get_theme(get_template());
    wp_enqueue_style('font-consulicon-icon', get_template_directory_uri() . '/assets/css/consulicon.css', array(), 'all');
    wp_enqueue_style('consultivo-admin-style', get_template_directory_uri() . '/assets/css/admin.css',array(),'all');
    wp_enqueue_style('modal', get_template_directory_uri() . '/assets/css/modal.css', array(), '4.0.0');
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true);
    wp_enqueue_style('font-material-icon', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css', array(), '2.2.0');

	wp_enqueue_style('consultivo-get-started-css', get_template_directory_uri() . '/assets/css/get-started.css');
	wp_enqueue_script('consultivo-get-started-js', get_template_directory_uri() . '/assets/js/get-started.js', ['jquery'], $theme->get('Version'), true);
	wp_localize_script('consultivo-get-started-js', 'main_data', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'consultivo_admin_style');


/**
 * Helper functions for this theme.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Theme options
 */
require_once get_template_directory() . '/inc/theme-options.php';

/**
 * Page options
 */
require_once get_template_directory() . '/inc/page-options.php';
/**
 * CSS Generator.
 */
require_once get_template_directory() . '/inc/classes/class-css-generator.php';

/**
 * Breadcrumb.
 */
require_once get_template_directory() . '/inc/classes/class-breadcrumb.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/* Load lib Font */
require_once get_template_directory() . '/inc/libs/fontawesome.php';
require_once get_template_directory() . '/inc/libs/materialdesign.php';
require_once get_template_directory() . '/inc/libs/consulicon.php';

/**
 * Custom params & remove VC Elements.
 */

function consultivo_vc_after_init()
{

    vc_remove_element("vc_button");
    vc_remove_element("vc_button2");
    vc_remove_element("vc_cta_button");
    vc_remove_element("vc_cta_button2");
    vc_remove_element("vc_cta");
    vc_remove_element("vc_cta");
    vc_remove_element("vc_tabs");
    vc_remove_element("vc_tour");
    vc_remove_element("vc_accordion");
    require_once ( get_template_directory() . '/vc_elements/fr_custom_vc_param.php' );

}

add_action('vc_after_init', 'consultivo_vc_after_init');

/**
 * Add new elements for VC
 */
function consultivo_vc_elements()
{
    if (class_exists('CmsShortCode')) {

        cms_require_folder('vc_elements', get_template_directory());
    }
}

add_action('vc_before_init', 'consultivo_vc_elements');

/**
 * Additional widgets for the theme
 */
require_once get_template_directory() . '/widgets/widget-recent-posts.php';
require_once get_template_directory() . '/widgets/widget-social.php';
require_once get_template_directory() . '/widgets/widget-contact-form.php';
require_once get_template_directory() . '/widgets/class.widget-extends.php';

/*
 * Show post number of category
 */
function show_count_category( $cat_args ) {
    $cat_args['show_count'] = 1;
    return $cat_args;
}

add_filter( 'widget_categories_args', 'show_count_category', 10, 1 );
add_filter('woocommerce_product_categories_widget_args',function($cat_args){
    $cat_args['show_count'] = 1;
    return $cat_args;
});
function consultivo_custom_title($v1){
    $v1 = esc_attr('Single Post');
    return $v1;
}
add_filter('consultivo_breadcrumb_single_post_title','consultivo_custom_title',10,3);
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/extends.php';


/**
 * Tutorials snippet functions. You should add those to extends.php
 * and remove the file.
 */
require_once get_template_directory() . '/inc/snippets.php';

/**
 * Add custom class in Row Visual Composer
 */
function consultivo_vc_shortcode_css_class( $classes, $settings_base, $atts )
{
    $classes_arr = explode( ' ', $classes );

    if ( 'vc_row' == $settings_base ) {
        if ( $atts['cms_row_class'] ) {
            $classes_arr[] = $atts['cms_row_class'];
        }
    }
    if ( 'vc_row' == $settings_base ) {
        if ( $atts['cms_row_opacity'] ) {
            $classes_arr[] = $atts['cms_row_opacity'];
        }
    }

    if ( 'vc_row_inner' == $settings_base ) {
        if ( $atts['cms_row_inner_class'] ) {
            $classes_arr[] = $atts['cms_row_inner_class'];
        }
    }
    if ( 'vc_row_inner' == $settings_base ) {
        if ( $atts['cms_row_inner_opacity'] ) {
            $classes_arr[] = $atts['cms_row_inner_opacity'];
        }
    }
    if ( 'vc_column' == $settings_base ) {
        if ( $atts['cms_column_class'] ) {
            $classes_arr[] = $atts['cms_column_class'];
        }
    }

    if ( isset($atts['animation_column']) && $atts['animation_column'] ) {
        wp_enqueue_script( 'waypoints' );
        wp_enqueue_style( 'animate-css' );
        $classes_arr[] = 'wpb_animate_when_almost_visible '.' wpb_'.$atts['animation_column'].' '.$atts['animation_column'];
    }


    return implode( ' ', $classes_arr );
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'consultivo_vc_shortcode_css_class', 10, 3 );
}


if ( ! function_exists( 'consultivo_fonts_url' ) ) :
    /**
     * Register Google fonts.
     *
     * Create your own consultivo_fonts_url() function to override in a child theme.
     *
     * @since league 1.1
     *
     * @return string Google fonts URL for the theme.
     */
    function consultivo_fonts_url()
    {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'consultivo' ) )
        {
            $fonts[] = 'Roboto:300,400,400i,500,500i,700,700i,900';
        }
        if ( 'off' !== _x( 'on', 'Montserrat: on or off', 'consultivo' ) )
        {
            $fonts[] = 'Montserrat:400,500,600,700';
        }
        if ( 'off' !== _x( 'on', 'Lato font: on or off', 'consultivo' ) )
        {
            $fonts[] = 'Lato:400,700';
        }

        if ( 'off' !== _x( 'on', 'Cabin font: on or off', 'consultivo' ) )
        {
            $fonts[] = 'Cabin:400,700';
        }

        if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'consultivo' ) )
        {
            $fonts[] = 'Poppins:400,700';
        }

        if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'consultivo' ) )
        {
            $fonts[] = 'Playfair Display:400';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;
/**
 * Commnet Form
 */
function consultivo_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'consultivo_comment_field_to_bottom' );

/* Optimize Images */
add_filter( 'jpeg_quality', function(){return 60;} );
/* Woocommerce*/
if(class_exists('Woocommerce')){
    add_filter( 'loop_shop_per_page', function($items){
        $items = consultivo_get_opt('product_per_page','9');
        return $items;
    }, 3 );
    require_once( get_template_directory() . '/woocommerce/wc-function-hooks.php' );
    add_filter( 'woocommerce_output_related_products_args', 'consultivo_related_products_args' );
    function consultivo_related_products_args( $args ) {
        $args['posts_per_page'] = 3; // 4 related products
        //$args['columns'] = 2; // arranged in 2 columns
        return $args;
    }
}
add_filter( 'wp_image_editors', 'change_graphic_lib' );
function change_graphic_lib($array) {
    return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}

add_filter('swa_ie_options_name', 'function_options_name');
function function_options_name()
{
    //Example name of theme option is "cms_theme_options"
    return consultivo_get_opt_name();
}
add_filter('swa_post_types', 'function_swa_post_types');
function function_swa_post_types($post_type)
{
    $post_type[] = 'portfolio';
    $post_type[] = 'services';
    $post_type[] = 'cms-mega-menu';

    return $post_type;
}
add_filter('cms_documentation_link', 'function_add_documentation_link');
function function_add_documentation_link($url)
{
    $url = 'http://doc.cmssuperheroes.com/wordpress/consultivo/';
    return $url;
}
/* Dashboard Theme */
add_filter('cms_ticket_link', 'consultivo_add_cms_ticket_link');
function consultivo_add_cms_ticket_link($url)
{
    $url = array('type' => 'url', 'link' => 'https://cmssuperheroes.com/ticket');
    return $url;
}
add_filter('cms_video_tutorial_link',function(){
    return 'https://www.youtube.com/channel/UCaKGMorHhiMd46GS5h2B-zQ';
});

add_action('admin_menu', 'consultivo_remove_post_custom_fields');
function consultivo_remove_post_custom_fields(){
    remove_meta_box('postcustom', 'page', 'normal');
}

/*
 * Get Started
 */
require_once get_template_directory() . '/inc/get-started.php';
/*
 * Get Started
 */