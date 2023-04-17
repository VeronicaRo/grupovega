<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) )
{
    return;
}

class CSS_Generator
{
    /**
     * scssc class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = true;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';


    /**
     * Constructor
     */
    function __construct() {
        $this->opt_name = consultivo_get_opt_name();

        if ( empty( $this->opt_name ) ) {
            return;
        }
        $this->dev_mode = consultivo_get_opt( 'dev_mode', '0' ) === '1' ? true : false;
        add_filter( 'cms_scssc_on', '__return_true' );
        add_action( 'init', array( $this, 'init' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 20 );
    }

    /**
     * init hook - 10
     */
    function init() {
        if ( ! class_exists( 'scssc' ) ) {
            return;
        }

        $this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );

        if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework ) {
            return;
        }
        add_action( 'wp', array( $this, 'generate_with_dev_mode' ) );
        add_action( "redux/options/{$this->opt_name}/saved", function () {
            $this->generate_file();
        } );
    }

    function generate_with_dev_mode() {
        if ( $this->dev_mode === true ) {
            $this->generate_file();
        }
    }

    /**
     * Generate options and css files
     */
    function generate_file() {
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/css/';

        $this->scssc = new scssc();
        $this->scssc->setImportPaths( $scss_dir );

        $_options = $scss_dir . 'variables.scss';

        $this->redux->filesystem->execute( 'put_contents', $_options, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->options_output() )
        ) );
        $css_file = $css_dir . 'theme.css';

        $this->scssc->setFormatter( 'scss_formatter' );
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->scssc->compile( '@import "theme.scss"' ) )
        ) );
    }

    /**
     * Output options to _variables.scss
     *
     * @access protected
     * @return string
     */
    protected function options_output()
    {
        ob_start();

        $primary_color = consultivo_get_opt( 'primary_color', '#ffab00' );
        if ( ! consultivo_is_valid_color( $primary_color ) )
        {
            $primary_color = '#ffab00';
        }
        printf( '$primary_color: %s;', esc_attr( $primary_color ) );

        $secondary_color = consultivo_get_opt( 'secondary_color', '#000000' );
        if ( ! consultivo_is_valid_color( $secondary_color ) )
        {
            $secondary_color = '#000000';
        }
        printf( '$secondary_color: %s;', esc_attr( $secondary_color ) );

        $link_color = consultivo_get_opt( 'link_color', '#ffab00' );
        if ( !empty($link_color['regular']) && isset($link_color['regular']) )
        {
            printf( '$link_color: %s;', esc_attr( $link_color['regular'] ) );
        } else {
            echo '$link_color: #ffc916;';
        }


        if ( !empty($link_color['hover']) && isset($link_color['hover']) )
        {
            printf( '$link_color_hover: %s;', esc_attr( $link_color['hover'] ) );
        } else {
            echo '$link_color_hover: #f3bc0b;';
        }


        if ( !empty($link_color['active']) && isset($link_color['active']) )
        {
            printf( '$link_color_active: %s;', esc_attr( $link_color['active'] ) );
        } else {
            echo '$link_color_active: #f3bc0b;';
        }

        /* Font */

        $menu_default_font = consultivo_get_opt( 'menu_default_font', 'Montserrat' );
        if (!empty($menu_default_font)) {
            printf( '$menu_default_font: %s;', esc_attr( $menu_default_font ) );
        }

        $heading_font = consultivo_get_opt( 'heading_font', 'Montserrat' );
        if(isset($heading_font['font-family']) && !empty($heading_font['font-family'])){
            printf( '$default_font: "%s";', esc_attr( $heading_font['font-family'] ) );
        }else{
            printf( '$default_font: "Montserrat";' );
        }
        $body_font = consultivo_get_opt( 'font_main', 'Roboto' );
        if(isset($body_font['font-family']) && !empty($body_font['font-family'])){
            printf( '$secondary_font: "%s";', esc_attr( $body_font['font-family'] ) );
        }else{
            printf( '$secondary_font: "Roboto";');
        }
        return ob_get_clean();
    }

    /**
     * Hooked wp_enqueue_scripts - 20
     * Make sure that the handle is enqueued from earlier wp_enqueue_scripts hook.
     */
    function enqueue()
    {
        $css = $this->inline_css();
        if ( !empty($css) )
        {
            wp_add_inline_style( 'consultivo-theme', $this->dev_mode ? $css : consultivo_css_minifier( $css ) );
        }
    }

    /**
     * Generate inline css based on theme options
     */
    protected function inline_css()
    {
        ob_start();
        /* General */
        $custom_pagetitle = consultivo_get_page_opt( 'custom_pagetitle', false );
        $ptitle_paddings = consultivo_get_page_opt( 'ptitle_paddings' );
        if (is_home() && !is_front_page()) {
            if ( isset($ptitle_paddings) && !empty($ptitle_paddings) ) {
                echo "body #pagetitle {
                    padding-top:" .esc_attr($ptitle_paddings['padding-top']). ";
                    padding-bottom:" .esc_attr($ptitle_paddings['padding-bottom']). ";
                }";
            }
        }
        /* Logo */
        $logo_maxw = consultivo_get_opt( 'logo_maxw',array('width' => '173px'));

        if (!empty($logo_maxw['width']) && $logo_maxw['width'] != 'px')
        {
            printf( '#site-header-wrap a.logo img, #site-header-wrap a.logo-sticky img { max-width: %s; }', esc_attr($logo_maxw['width']) );
        } ?>
        @media screen and (max-width: 991px) {
            <?php
            $logo_maxw_sm = consultivo_get_opt( 'logo_maxw_sm',array('width' => '173px'));
            if (!empty($logo_maxw_sm['width']) && $logo_maxw_sm['width'] != 'px') {
                printf( '#site-header-wrap a.logo img, #site-header-wrap a.logo-sticky img { max-width: %s; }', esc_attr($logo_maxw_sm['width']) );
            } ?>
        }
        <?php /* Menu */
        $menu_text_transform = consultivo_get_opt( 'menu_text_transform' );
        if ( ! empty( $menu_text_transform ) ) {
            printf( '.primary-menu > li > a { text-transform: %s !important; }', esc_attr($menu_text_transform) );
        }
        $menu_font_size = consultivo_get_opt( 'menu_font_size' );
        if ( ! empty( $menu_font_size ) ) {
            printf( '.primary-menu > li > a { font-size: %s'.'px !important; }', esc_attr($menu_font_size) );
        }
        $main_menu_color = consultivo_get_opt( 'main_menu_color' );
        if ( ! empty( $main_menu_color['regular'] ) ) {
            printf( '.primary-menu > li > a { color: %s !important; }', esc_attr($main_menu_color['regular']) );
        }
        if ( ! empty( $main_menu_color['hover'] ) ) {
            printf( '.primary-menu > li > a:hover { color: %s !important; }', esc_attr($main_menu_color['hover']) );
        }
        if ( ! empty( $main_menu_color['active'] ) ) {
            printf( '.primary-menu > li.current_page_item > a, .primary-menu > li.current-menu-item > a, .primary-menu > li.current_page_ancestor > a, .primary-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr($main_menu_color['active']) );
        }
        $sticky_menu_color = consultivo_get_opt( 'sticky_menu_color' );
        if ( ! empty( $sticky_menu_color['regular'] ) ) {
            printf( '.headroom--pinned:not(.headroom--top) .primary-menu > li > a { color: %s !important; }', esc_attr($sticky_menu_color['regular']) );
        }
        if ( ! empty( $sticky_menu_color['hover'] ) ) {
            printf( '.headroom--pinned:not(.headroom--top) .primary-menu > li > a:hover { color: %s !important; }', esc_attr($sticky_menu_color['hover']) );
        }
        if ( ! empty( $sticky_menu_color['active'] ) ) {
            printf( '.headroom--pinned:not(.headroom--top) .primary-menu > li.current_page_item > a, .headroom--pinned:not(.headroom--top) .primary-menu > li.current-menu-item > a, .headroom--pinned:not(.headroom--top) .primary-menu > li.current_page_ancestor > a, .headroom--pinned:not(.headroom--top) .primary-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr($sticky_menu_color['active']) );
        }

        /* Page Title */
        ?>
        @media screen and (max-width: 991px) {
            <?php
            $ptitle_paddings_sm = consultivo_get_opt( 'ptitle_paddings_sm');
            if ( isset($ptitle_paddings_sm) && !empty($ptitle_paddings_sm) ) {
                echo "body #pagetitle {
                    padding-top:" .esc_attr($ptitle_paddings_sm['padding-top']). ";
                    padding-bottom:" .esc_attr($ptitle_paddings_sm['padding-bottom']). ";
                }";
            } ?>
        }
        <?php
        $ptitle_overlay_style = consultivo_get_opt( 'ptitle_overlay_style', 'secondary' );
        $page_ptitle_overlay_style = consultivo_get_page_opt( 'ptitle_overlay_style', 'secondary' );
        $ptitle_bg_color = consultivo_get_opt( 'ptitle_bg_color' );
        $page_ptitle_bg_color = consultivo_get_page_opt( 'ptitle_bg_color' );
        if($custom_pagetitle && $page_ptitle_overlay_style == 'default' && !empty($page_ptitle_bg_color) ) {
            $ptitle_bg_color = $page_ptitle_bg_color;
            $ptitle_overlay_style = $page_ptitle_overlay_style;
        }
        if ( ! empty($ptitle_bg_color) && $ptitle_overlay_style == 'default' )
        {
            printf( '#pagetitle.overlay-default { background-color: transparent; background-color: %s; }', esc_attr($ptitle_bg_color['rgba']) );
        }
        if ( $ptitle_overlay_style == 'none' )
        {
            echo "#pagetitle.bg-overlay:before {
                display: none;
            }";
        }
        $ptitle_font_size = consultivo_get_opt( 'ptitle_font_size' );
        $page_title_font_size = consultivo_get_page_opt( 'ptitle_font_size' );
        if($custom_pagetitle && !empty($page_title_font_size)) {
            $ptitle_font_size = $page_title_font_size;
        }
        if ( ! empty( $ptitle_font_size ) ) {
            printf( '#pagetitle h1.page-title { font-size: %s'.'px; }', esc_attr($ptitle_font_size) );
        }
        $ptitle_line_hegiht = consultivo_get_opt( 'ptitle_line_hegiht' );
        if ( ! empty( $ptitle_line_hegiht ) ) {
            printf( '#pagetitle h1.page-title { line-height: %s'.'px; }', esc_attr($ptitle_line_hegiht) );
        }

        /* Button */
        /* Form Fields */
        /* Content */
        $content_sidebar_space = consultivo_get_opt( 'content_sidebar_space' );
        $content_sidebar_space_number = ($content_sidebar_space/2).'px';
        ?>
        @media screen and (min-width: 1280px) {
            <?php if ( ! empty( $content_sidebar_space ) ) {
                printf( '.content-row { margin-left: -'.'%s; }', esc_attr($content_sidebar_space_number) );
                printf( '.content-row { margin-right: -'.'%s; }', esc_attr($content_sidebar_space_number) );
                printf( '.content-row #primary, .content-row #secondary { padding-left: %s; }', esc_attr($content_sidebar_space_number) );
                printf( '.content-row #primary, .content-row #secondary { padding-right: %s; }', esc_attr($content_sidebar_space_number) );
            } ?>
        }
        @media screen and (min-width: 992px) {
            <?php if ( ! empty( $character_content ) ) {
                printf( '.site-content:before { content: "%s"; }', esc_attr($character_content) );
            } ?>
        }
        <?php
        /* Footer */
        $footer_top_heading_color = consultivo_get_opt( 'footer_top_heading_color' );
        $footer_top_heading_fs = consultivo_get_opt( 'footer_top_heading_fs' );
        $footer_top_heading_tt = consultivo_get_opt( 'footer_top_heading_tt' );
        $footer_top_paddings = consultivo_get_opt( 'footer_top_paddings' );
        if(!empty($footer_top_heading_color)) {
            echo '.top-footer .footer-widget-title {
                color: '.esc_attr( $footer_top_heading_color ).' !important;
            }';
        }
        if(!empty($footer_top_heading_fs)) {
            echo '.top-footer .footer-widget-title {
                font-size: '.esc_attr( $footer_top_heading_fs ).'px !important;
            }';
        }
        if(!empty($footer_top_heading_tt)) {
            echo '.top-footer .footer-widget-title {
                text-transform: '.esc_attr( $footer_top_heading_tt ).' !important;
            }';
        }
        if ( isset($footer_top_paddings) && !empty($footer_top_paddings) ) {
            if(!empty($footer_top_paddings['padding-top'])) {
                echo ".site-footer .top-footer {
                    padding-top:" .esc_attr($footer_top_paddings['padding-top']). ";
                }";
            }
            if(!empty($footer_top_paddings['padding-bottom'])) {
                echo ".site-footer .top-footer {
                    padding-bottom:" .esc_attr($footer_top_paddings['padding-bottom']). ";
                }";
            }
        }
        /* Custom Css */
        $custom_css = consultivo_get_opt( 'site_css' );
        if(!empty($custom_css)) { echo esc_attr($custom_css); }

        return ob_get_clean();
    }
}

new CSS_Generator();