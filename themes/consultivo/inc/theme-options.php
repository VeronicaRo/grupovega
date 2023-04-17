<?php
if ( ! class_exists( 'ReduxFramework' ) ) {
	return;
}
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
	remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
}
$contact_forms = consultivo_get_contact_form();
$opt_name      = consultivo_get_opt_name();
$theme         = wp_get_theme();
$text_domain   = $theme->get( 'TextDomain' );
if ( is_child_theme() ) {
	$text_domain = $theme->parent()->get( 'TextDomain' );
}

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => class_exists( 'CmssuperheroesCore' ) ? 'submenu' : '',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => esc_html__( 'Theme Options', 'consultivo' ),
	'page_title'           => esc_html__( 'Theme Options', 'consultivo' ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => false,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-admin-generic',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => true,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
	'show_options_object'  => false,
	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => class_exists( 'CmssuperheroesCore' ) ? $text_domain : '',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => 'theme-options',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'              => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	),
	'templates_path'       => class_exists( 'CmssuperheroesCore' ) ? cmssuperheroes()->path( 'APP_DIR' ) . '/templates/redux/' : '',
);

Redux::SetArgs( $opt_name, $args );

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'General', 'consultivo' ),
	'icon'   => 'el-icon-home',
	'fields' => array(
		array(
			'id'       => 'show_page_loading',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Page Loading', 'consultivo' ),
			'subtitle' => esc_html__( 'Enable page loading effect when you load site.', 'consultivo' ),
			'default'  => false
		),
		array(
			'id'      => 'smoothscroll',
			'type'    => 'switch',
			'title'   => esc_html__( 'Smooth Scroll', 'consultivo' ),
			'default' => false
		),
		array(
			'id'    => 'dev_mode',
			'type'  => 'switch',
			'title' => esc_html__( 'Dev Mode (not recommended)', 'consultivo' ),
			'desc'  => 'no minimize , generate css over time...'
		),
	)
) );

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Header', 'consultivo' ),
	'icon'   => 'el-icon-website',
	'fields' => array(
		array(
			'id'       => 'header_layout',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Layout', 'consultivo' ),
			'subtitle' => esc_html__( 'Select a layout for header.', 'consultivo' ),
			'options'  => array(
				'1'  => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
				'2'  => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
				'3'  => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
				'4'  => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
				'5'  => get_template_directory_uri() . '/assets/images/header-layout/h5.jpg',
				'6'  => get_template_directory_uri() . '/assets/images/header-layout/h6.jpg',
				'7'  => get_template_directory_uri() . '/assets/images/header-layout/h7.jpg',
				'8'  => get_template_directory_uri() . '/assets/images/header-layout/h8.jpg',
				'9'  => get_template_directory_uri() . '/assets/images/header-layout/h9.jpg',
				'10' => get_template_directory_uri() . '/assets/images/header-layout/h10.jpg',
			),
			'default'  => '1'
		),
		array(
			'id'           => 'header_top_bg',
			'type'         => 'color',
			'title'        => esc_html__( 'Top Menu Background', 'consultivo' ),
			'output'       => array(
				'background-color' => '#site-header-wrap.header-layout2 .site-header-top, #site-header-wrap.header-layout3,#site-header-wrap.header-layout5 .site-header-top'
			),
			'force_output' => true
		),
		array(
			'id'           => 'header_main_bg',
			'type'         => 'color',
			'title'        => esc_html__( 'Main Menu Background', 'consultivo' ),
			'output'       => array( 'background-color' => '#site-header-wrap.header-layout2 .site-header-main, #site-header-wrap.header-layout3 .site-header-main .content-menu, #site-header-wrap.header-layout5 .site-header-main, #site-header-wrap.header-layout6 .site-header-main' ),
			'force_output' => true
		),
		array(
			'id'       => 'sticky_on',
			'type'     => 'switch',
			'title'    => esc_html__( 'Sticky Header', 'consultivo' ),
			'subtitle' => esc_html__( 'Header will be sticked when applicable.', 'consultivo' ),
			'default'  => false
		),
		array(
			'id'           => 'header_sticky_bg',
			'type'         => 'color',
			'title'        => esc_html__( 'Sticky Menu Background', 'consultivo' ),
			'output'       => array( 'background-color' => '#headroom.headroom--pinned:not(.headroom--top),.header-layout3 #headroom.headroom--pinned:not(.headroom--top) .content-menu,.header-layout6 #headroom.headroom--pinned:not(.headroom--top) .site-header-main, #site-header-wrap.header-layout6 #headroom.headroom--pinned:not(.headroom--top), #site-header-wrap.header-layout8 #headroom.headroom--pinned:not(.headroom--top)' ),
			'force_output' => true,
			'required'     => [ 'sticky_on', 'equals', '1' ],
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Top Bar', 'consultivo' ),
	'icon'       => 'el-icon-circle-arrow-right',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'top_bar_phone',
			'type'    => 'text',
			'title'   => esc_html__( 'Phone', 'consultivo' ),
			'default' => '002 01060070701',
			'desc'    => 'Ex: 002 01060070701',
		),
		array(
			'id'      => 'top_bar_email',
			'type'    => 'text',
			'title'   => esc_html__( 'Email', 'consultivo' ),
			'default' => 'consultivo@7oroof.com',
			'desc'    => 'Ex: Consultivo@7oroof.com',
		),
		array(
			'id'      => 'top_bar_address',
			'type'    => 'text',
			'title'   => esc_html__( 'Address', 'consultivo' ),
			'default' => '22 Albahr St, Tanta, Egypt',
			'desc'    => 'Ex: 22 Albahr St, Tanta, Egypt',
		),
		array(
			'title'  => esc_html__( 'Top bar social', 'consultivo' ),
			'type'   => 'section',
			'id'     => 'top_bar_social_section',
			'indent' => true
		),
		array(
			'id'      => 'top_bar_social',
			'type'    => 'sorter',
			'title'   => esc_html__( 'Social', 'consultivo' ),
			'desc'    => 'Choose which social networks are displayed and edit where they link to.',
			'options' => array(
				'enabled'  => array(
					'facebook'  => 'Facebook',
					'twitter'   => 'Twitter',
					'instagram' => 'Instagram',
				),
				'disabled' => array(
					'tripadvisor' => 'Tripadvisor',
					'google'      => 'Google',
					'youtube'     => 'Youtube',
					'vimeo'       => 'Vimeo',
					'tumblr'      => 'Tumblr',
					'pinterest'   => 'Pinterest',
					'yelp'        => 'Yelp',
					'skype'       => 'Skype',
					'linkedin'    => 'Linkedin',
				)
			),
			//'required' => array( 0 => 'top_bar_social_on', 1 => 'equals', 2 => true ),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Logo', 'consultivo' ),
	'icon'       => 'el el-picture',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'logo',
			'type'    => 'media',
			'title'   => esc_html__( 'Light Logo', 'consultivo' ),
			'default' => array(
				'url' => get_template_directory_uri() . '/assets/images/logo.png'
			)
		),
		array(
			'id'      => 'dark_logo',
			'type'    => 'media',
			'title'   => esc_html__( 'Dark Logo', 'consultivo' ),
			'default' => array(
				'url' => get_template_directory_uri() . '/assets/images/sticky-logo.png'
			)
		),
		array(
			'id'      => 'logo_sticky',
			'type'    => 'media',
			'title'   => esc_html__( 'Logo Sticky', 'consultivo' ),
			'default' => array(
				'url' => get_template_directory_uri() . '/assets/images/sticky-logo.png'
			)
		),
		array(
			'id'       => 'logo_maxw',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Logo Max Width', 'consultivo' ),
			'subtitle' => esc_html__( 'Set maximum width for your logo, just in case the logo is too large.', 'consultivo' ),
			'height'   => false,
			'unit'     => 'px',
		),
		array(
			'id'       => 'logo_maxw_sm',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Logo Max Width on Mobile', 'consultivo' ),
			'subtitle' => esc_html__( 'Set maximum width for your logo, just in case the logo is too large.', 'consultivo' ),
			'height'   => false,
			'unit'     => 'px',
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Navigation', 'consultivo' ),
	'icon'       => 'el el-lines',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'          => 'font_menu',
			'type'        => 'typography',
			'title'       => esc_html__( 'Menu Default Font', 'consultivo' ),
			'google'      => true,
			'font-backup' => true,
			'all_styles'  => true,
			'font-style'  => false,
			'font-weight' => true,
			'text-align'  => false,
			'font-size'   => false,
			'line-height' => false,
			'color'       => false,
			'output'      => array( 'body .primary-menu > li > a, body .primary-menu .sub-menu li a, .action-menu a' ),
			'units'       => 'px'
		),
		array(
			'id'       => 'menu_font_size',
			'type'     => 'text',
			'title'    => esc_html__( 'Font Size', 'consultivo' ),
			'validate' => 'numeric',
			'desc'     => 'Enter number',
			'msg'      => 'Please enter number',
			'default'  => ''
		),
		array(
			'id'      => 'menu_text_transform',
			'type'    => 'select',
			'title'   => esc_html__( 'Text Transform', 'consultivo' ),
			'options' => array(
				''          => esc_html__( 'Capitalize', 'consultivo' ),
				'uppercase' => esc_html__( 'Uppercase', 'consultivo' ),
				'lowercase' => esc_html__( 'Lowercase', 'consultivo' ),
				'initial'   => esc_html__( 'Initial', 'consultivo' ),
				'inherit'   => esc_html__( 'Inherit', 'consultivo' ),
				'none'      => esc_html__( 'None', 'consultivo' ),
			),
			'default' => ''
		),
		array(
			'title'  => esc_html__( 'Main Menu', 'consultivo' ),
			'type'   => 'section',
			'id'     => 'main_menu',
			'indent' => true
		),
		array(
			'id'      => 'main_menu_color',
			'type'    => 'link_color',
			'title'   => esc_html__( 'Color', 'consultivo' ),
			'output'  => array( '.primary-menu > li > a' ),
			'default' => array(
				'regular' => '',
				'hover'   => '',
				'active'  => '',
			),
		),
		array(
			'title'  => esc_html__( 'Sticky Menu', 'consultivo' ),
			'type'   => 'section',
			'id'     => 'sticky_menu',
			'indent' => true
		),
		array(
			'id'      => 'sticky_menu_color',
			'type'    => 'link_color',
			'title'   => esc_html__( 'Color', 'consultivo' ),
			'default' => array(
				'regular' => '',
				'hover'   => '',
				'active'  => '',
			),
		),
		array(
			'title'  => esc_html__( 'Button Navigation', 'consultivo' ),
			'type'   => 'section',
			'id'     => 'button_navigation',
			'indent' => true,
		),
		array(
			'title' => esc_html__( 'Show Custom Button', 'consultivo' ),
			'type'  => 'switch',
			'id'    => 'show_custom_button',
		),
		array(
			'title' => esc_html__( 'Show Search Button', 'consultivo' ),
			'type'  => 'switch',
			'id'    => 'show_search_button',
		),
		array(
			'title' => esc_html__( 'Show Cart Button', 'consultivo' ),
			'type'  => 'switch',
			'id'    => 'show_cart_button',
		),
		array(
			'id'       => 'h_btn_text',
			'type'     => 'text',
			'title'    => esc_html__( 'Button Text', 'consultivo' ),
			'default'  => 'Consultation',
			'required' => array( 0 => 'show_custom_button', 1 => 'equals', 2 => 1 ),
		),
		array(
			'id'           => 'h_btn_page_link',
			'type'         => 'select',
			'title'        => esc_html__( 'Page Link', 'consultivo' ),
			'data'         => 'page',
			'args'         => array(
				'post_type'      => 'page',
				'posts_per_page' => - 1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			),
			'force_output' => true,
			'required'     => array( 0 => 'show_custom_button', 1 => 'equals', 2 => 1 ),
		),
	)
) );

/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Page Title', 'consultivo' ),
	'icon'   => 'el-icon-map-marker',
	'fields' => array(
		array(
			'id'       => 'ptitle_layout',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Layout', 'consultivo' ),
			'subtitle' => esc_html__( 'Select a layout for page title.', 'consultivo' ),
			'options'  => array(
				'0' => get_template_directory_uri() . '/assets/images/page-title-layout/p0.jpg',
				'1' => get_template_directory_uri() . '/assets/images/page-title-layout/p1.jpg'
			),
			'default'  => '1'
		),
		array(
			'id'               => 'ptitle_bg',
			'type'             => 'background',
			'title'            => esc_html__( 'Background', 'consultivo' ),
			'subtitle'         => esc_html__( 'Page title background.', 'consultivo' ),
			'output'           => array( '#pagetitle' ),
			'background-color' => false,
			'default'          => get_template_directory_uri() . '/assets/images/ptitle-bg.jpg'
		),
		array(
			'id'       => 'ptitle_paddings',
			'type'     => 'spacing',
			'title'    => esc_html__( 'Content Paddings', 'consultivo' ),
			'subtitle' => esc_html__( 'Content page title paddings.', 'consultivo' ),
			'mode'     => 'padding',
			'units'    => array( 'em', 'px', '%' ),
			'top'      => true,
			'right'    => false,
			'bottom'   => true,
			'left'     => false,
			'output'   => array( '#pagetitle' ),
			'default'  => array(
				'padding-top'    => '',
				'padding-bottom' => '',
				'units'          => 'px',
			)
		),
		array(
			'id'       => 'ptitle_paddings_sm',
			'type'     => 'spacing',
			'title'    => esc_html__( 'Content Paddings Tablet & Mobile', 'consultivo' ),
			'subtitle' => esc_html__( 'Content page title paddings for Tablet & Mobile.', 'consultivo' ),
			'mode'     => 'padding',
			'units'    => array( 'em', 'px', '%' ),
			'top'      => true,
			'right'    => false,
			'bottom'   => true,
			'left'     => false,
			'default'  => array(
				'padding-top'    => '',
				'padding-bottom' => '',
				'units'          => 'px',
			)
		),
		array(
			'title'  => esc_html__( 'Title', 'consultivo' ),
			'type'   => 'section',
			'id'     => 'pt_title',
			'indent' => true
		),
		array(
			'id'          => 'ptitle_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Title Color', 'consultivo' ),
			'subtitle'    => esc_html__( 'Page title color.', 'consultivo' ),
			'output'      => array( '#pagetitle h1.page-title' ),
			'default'     => '',
			'transparent' => false,
		),
		array(
			'id'       => 'ptitle_font_size',
			'type'     => 'text',
			'title'    => esc_html__( 'Font Size', 'consultivo' ),
			'validate' => 'numeric',
			'desc'     => 'Enter number',
			'msg'      => 'Please enter number',
			'default'  => ''
		),
		array(
			'id'       => 'ptitle_line_height',
			'type'     => 'text',
			'title'    => esc_html__( 'Line Height', 'consultivo' ),
			'validate' => 'numeric',
			'desc'     => 'Enter number',
			'msg'      => 'Please enter number',
			'default'  => ''
		),
		array(
			'title'  => esc_html__( 'Breadcrumb', 'consultivo' ),
			'type'   => 'section',
			'id'     => 'pt_breadcrumb',
			'indent' => true
		),
		array(
			'id'      => 'breadcrumb_on',
			'type'    => 'switch',
			'title'   => esc_html__( 'Breadcrumb', 'consultivo' ),
			'default' => false
		),
	)
) );
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Single Product', 'consultivo' ),
	'icon'       => 'el el-shopping-cart-sign',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'show_product_page_title',
			'title'    => esc_html__( 'Custom page title', 'consultivo' ),
			'subtitle' => esc_html__( 'Custom product page title.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true,
		),
		array(
			'id'       => 'product_page_title_bg',
			'type'     => 'background',
			'title'    => esc_html__( 'Background', 'consultivo' ),
			'subtitle' => esc_html__( 'Background for product page title', 'consultivo' ),
			'output'   => array( '.single-product #pagetitle' ),
			'required' => array( 0 => 'show_product_page_title', 1 => 'equals', 2 => true )
		),
	)
) );
/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Content', 'consultivo' ),
	'icon'   => 'el-icon-pencil',
	'fields' => array(
		array(
			'id'       => 'content_bg_color',
			'type'     => 'color_rgba',
			'title'    => esc_html__( 'Background Color', 'consultivo' ),
			'subtitle' => esc_html__( 'Content background color.', 'consultivo' ),
			'output'   => array( 'background-color' => '#content' )
		),
		array(
			'id'             => 'content_padding',
			'type'           => 'spacing',
			'output'         => array( '#content' ),
			'right'          => false,
			'left'           => false,
			'mode'           => 'padding',
			'units'          => array( 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Content Padding', 'consultivo' ),
			'desc'           => esc_html__( 'Default: Top-100px, Bottom-100px', 'consultivo' ),
			'default'        => array(
				'padding-top'    => '',
				'padding-bottom' => '',
				'units'          => 'px',
			)
		),
		array(
			'id'       => 'content_sidebar_space',
			'type'     => 'text',
			'title'    => esc_html__( 'Content & Sidebar Space', 'consultivo' ),
			'validate' => 'numeric',
			'desc'     => 'Enter number (Default 30).',
			'msg'      => 'Please enter number',
			'default'  => ''
		),
		array(
			'id'      => 'search_field_placeholder',
			'type'    => 'text',
			'title'   => esc_html__( 'Search Form - Text Placeholder', 'consultivo' ),
			'default' => '',
			'desc'    => esc_html__( 'Default: Search Keywords...', 'consultivo' ),
		),
	)
) );


Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Archive', 'consultivo' ),
	'icon'       => 'el-icon-list',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'archive_sidebar_pos',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar Position', 'consultivo' ),
			'subtitle' => esc_html__( 'Select a sidebar position for blog home, archive, search...', 'consultivo' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'consultivo' ),
				'right' => esc_html__( 'Right', 'consultivo' ),
				'none'  => esc_html__( 'Disabled', 'consultivo' )
			),
			'default'  => 'right'
		),
		array(
			'id'       => 'archive_author_on',
			'title'    => esc_html__( 'Author', 'consultivo' ),
			'subtitle' => esc_html__( 'Show author name on each post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true,
		),
		array(
			'id'       => 'archive_date_on',
			'title'    => esc_html__( 'Date', 'consultivo' ),
			'subtitle' => esc_html__( 'Show date posted on each post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true,
		),
		array(
			'id'       => 'archive_tags_on',
			'title'    => esc_html__( 'Tags', 'consultivo' ),
			'subtitle' => esc_html__( 'Show tags names on each post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => false,
		),
		array(
			'id'       => 'archive_category_on',
			'title'    => esc_html__( 'Category', 'consultivo' ),
			'subtitle' => esc_html__( 'Show category names on single post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true
		),
		array(
			'id'       => 'archive_sticky_on',
			'title'    => esc_html__( 'Sticky', 'consultivo' ),
			'subtitle' => esc_html__( 'Show pin names on single post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true
		),
		array(
			'id'       => 'archive_comments_on',
			'title'    => esc_html__( 'Comments', 'consultivo' ),
			'subtitle' => esc_html__( 'Show comments count on each post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => false,
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Single Post', 'consultivo' ),
	'icon'       => 'el-icon-file-edit',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'post_sidebar_pos',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar Position', 'consultivo' ),
			'subtitle' => esc_html__( 'Select a sidebar position', 'consultivo' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'consultivo' ),
				'right' => esc_html__( 'Right', 'consultivo' ),
				'none'  => esc_html__( 'Disabled', 'consultivo' )
			),
			'default'  => 'right'
		),
		array(
			'id'       => 'post_comments_on',
			'title'    => esc_html__( 'Comments', 'consultivo' ),
			'subtitle' => esc_html__( 'Show comments count on single post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => false
		),
		array(
			'id'       => 'post_author_on',
			'title'    => esc_html__( 'Author', 'consultivo' ),
			'subtitle' => esc_html__( 'Show author name on single post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true
		),
		array(
			'id'       => 'author_info',
			'title'    => esc_html__( 'Author Info', 'consultivo' ),
			'subtitle' => esc_html__( 'Show author info on single post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true
		),
		array(
			'id'       => 'post_tags_on',
			'title'    => esc_html__( 'Tags', 'consultivo' ),
			'subtitle' => esc_html__( 'Show tag names on single post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true
		),
		array(
			'id'       => 'post_category_on',
			'title'    => esc_html__( 'Category', 'consultivo' ),
			'subtitle' => esc_html__( 'Show category names on single post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true
		),
		array(
			'id'       => 'post_date_on',
			'title'    => esc_html__( 'Date', 'consultivo' ),
			'subtitle' => esc_html__( 'Show date posted on each post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true,
		),
		array(
			'id'           => 'post_social_share_on',
			'title'        => esc_html__( 'Social Share', 'consultivo' ),
			'subtitle'     => esc_html__( 'Show social share on single post.', 'consultivo' ),
			'type'         => 'switch',
			'default'      => false,
			'force_output' => true
		),
		array(
			'id'       => 'post_comments_form_on',
			'title'    => esc_html__( 'Comments Form', 'consultivo' ),
			'subtitle' => esc_html__( 'Show comments form on single post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true
		),

		array(
			'id'       => 'post_feature_image_on',
			'title'    => esc_html__( 'Feature Image', 'consultivo' ),
			'subtitle' => esc_html__( 'Show feature image on single post.', 'consultivo' ),
			'type'     => 'switch',
			'default'  => true
		),

	)
) );
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Shop', 'consultivo' ),
	'icon'       => 'el el-shopping-cart-sign',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'sidebar_shop',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Shop sidebar', 'consultivo' ),
			'subtitle' => esc_html__( 'Select a sidebar position for shop', 'consultivo' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'consultivo' ),
				'right' => esc_html__( 'Right', 'consultivo' ),
				'none'  => esc_html__( 'Disabled', 'consultivo' )
			),
			'default'  => 'right'
		),
		array(
			'id'       => 'sidebar_product',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Product sidebar', 'consultivo' ),
			'subtitle' => esc_html__( 'Select a sidebar position for Product', 'consultivo' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'consultivo' ),
				'right' => esc_html__( 'Right', 'consultivo' ),
				'none'  => esc_html__( 'Disabled', 'consultivo' )
			),
			'default'  => 'right'
		),
		array(
			'id'      => 'product_per_page',
			'type'    => 'text',
			'title'   => esc_html__( 'Product per page', 'consultivo' ),
			'default' => '9'
		),
		array(
			'id'       => 'show_social_share',
			'title'    => esc_html__( 'Show Social Share', 'consultivo' ),
			'subtitle' => esc_html__( 'Show share button in single product page', 'consultivo' ),
			'type'     => 'switch',
			'default'  => false
		),
	)
) );

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Footer', 'consultivo' ),
	'icon'   => 'el el-website',
	'fields' => array(
		array(
			'id'       => 'footer_layout',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Layout', 'consultivo' ),
			'subtitle' => esc_html__( 'Select a layout for upper footer area.', 'consultivo' ),
			'options'  => array(
				'1' => get_template_directory_uri() . '/assets/images/footer-layout/ft1.jpg',
			),
			'default'  => '1'
		),
		array(
			'id'       => 'footer_bg',
			'type'     => 'background',
			'title'    => esc_html__( 'Background', 'consultivo' ),
			'subtitle' => esc_html__( 'Footer background.', 'consultivo' ),
			'default'  => '',
			'output'   => array( '.site-footer .top-footer' ),
		),
		array(
			'id'       => 'back_totop_on',
			'type'     => 'switch',
			'title'    => esc_html__( 'Back to Top Button', 'consultivo' ),
			'subtitle' => esc_html__( 'Show back to top button when scrolled down.', 'consultivo' ),
			'default'  => true
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Footer Top', 'consultivo' ),
	'icon'       => 'el el-circle-arrow-right',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'footer_top_column',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Columns', 'consultivo' ),
			'options' => array(
				'3' => esc_html__( '3 Column', 'consultivo' ),
				'4' => esc_html__( '4 Column', 'consultivo' ),
				'5' => esc_html__( '5 Column', 'consultivo' ),
			),
			'default' => '5',
		),

		array(
			'id'       => 'footer_top_paddings',
			'type'     => 'spacing',
			'title'    => esc_html__( 'Paddings', 'consultivo' ),
			'subtitle' => esc_html__( 'Footer top paddings.', 'consultivo' ),
			'mode'     => 'padding',
			'units'    => array( 'px' ),
			'right'    => false,
			'left'     => false,
			'default'  => array(
				'padding-top'    => '',
				'padding-bottom' => ''
			),
		),
		array(
			'id'     => 'footer_top_color',
			'type'   => 'color',
			'title'  => esc_html__( 'Text Color', 'consultivo' ),
			'output' => array( '.site-footer' )
		),
		array(
			'id'      => 'footer_top_link_color',
			'type'    => 'link_color',
			'title'   => esc_html__( 'Links Color', 'consultivo' ),
			'regular' => true,
			'hover'   => true,
			'active'  => true,
			'visited' => true,
			'output'  => array( '.site-footer .top-footer .widget_nav_menu ul.menu li a' ),
		),
		array(
			'title'  => esc_html__( 'Widget Title', 'consultivo' ),
			'type'   => 'section',
			'id'     => 'footer_wg_title',
			'indent' => true,
		),
		array(
			'id'          => 'footer_top_heading_font',
			'type'        => 'typography',
			'title'       => esc_html__( 'Font Family', 'consultivo' ),
			'google'      => true,
			'font-backup' => false,
			'all_styles'  => false,
			'font-style'  => false,
			'font-weight' => true,
			'text-align'  => false,
			'font-size'   => false,
			'line-height' => false,
			'color'       => false,
			'indent'      => true,
			'output'      => array( '.site-footer .top-footer .footer-widget-title' ),
		),
		array(
			'id'     => 'footer_top_heading_color',
			'type'   => 'color',
			'title'  => esc_html__( 'Title Color', 'consultivo' ),
			'output' => array( '.site-footer .top-footer .footer-widget-title' ),
		),
		array(
			'id'       => 'footer_top_heading_fs',
			'type'     => 'text',
			'title'    => esc_html__( 'Font Size', 'consultivo' ),
			'validate' => 'numeric',
			'desc'     => 'Enter number',
			'msg'      => 'Please enter number',
			'default'  => '',
			'output'   => array( '.site-footer .top-footer .footer-widget-title' ),
		),
		array(
			'id'      => 'footer_top_heading_tt',
			'type'    => 'select',
			'title'   => esc_html__( 'Text Transform', 'consultivo' ),
			'options' => array(
				''          => esc_html__( 'Capitalize', 'consultivo' ),
				'uppercase' => esc_html__( 'Uppercase', 'consultivo' ),
				'lowercase' => esc_html__( 'Lowercase', 'consultivo' ),
				'initial'   => esc_html__( 'Initial', 'consultivo' ),
				'inherit'   => esc_html__( 'Inherit', 'consultivo' ),
				'none'      => esc_html__( 'None', 'consultivo' ),
			),
			'default' => ''
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Footer Bottom', 'consultivo' ),
	'icon'       => 'el el-circle-arrow-right',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'     => 'footer_top_bg',
			'type'   => 'color',
			'title'  => esc_html__( 'Background Color', 'consultivo' ),
			'output' => array( 'background-color' => 'footer.site-footer .bottom-footer' ),
		),
		array(
			'id'     => 'footer_bottom_color',
			'type'   => 'color',
			'title'  => esc_html__( 'Text Color', 'consultivo' ),
			'output' => array( '.bottom-footer' )
		),
		array(
			'id'           => 'footer_copyright',
			'type'         => 'textarea',
			'title'        => esc_html__( 'Copyright', 'consultivo' ),
			'validate'     => 'html_custom',
			'default'      => '',
			'subtitle'     => esc_html__( 'Custom HTML Allowed: a,br,em,strong,span,p,div,h1->h6', 'consultivo' ),
			'allowed_html' => array(
				'a'      => array(
					'href'  => array(),
					'title' => array(),
					'class' => array(),
				),
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'span'   => array(),
				'p'      => array(),
				'div'    => array(
					'class' => array()
				),
				'h1'     => array(
					'class' => array()
				),
				'h2'     => array(
					'class' => array()
				),
				'h3'     => array(
					'class' => array()
				),
				'h4'     => array(
					'class' => array()
				),
				'h5'     => array(
					'class' => array()
				),
				'h6'     => array(
					'class' => array()
				),
				'ul'     => array(
					'class' => array()
				),
				'li'     => array(),
			)
		),
	)
) );


/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Colors', 'consultivo' ),
	'icon'   => 'el-icon-file-edit',
	'fields' => array(
		array(
			'id'          => 'primary_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Primary Color', 'consultivo' ),
			'transparent' => false,
			'default'     => '#98cb2b'
		),
		array(
			'id'          => 'secondary_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Secondary Color', 'consultivo' ),
			'transparent' => false,
			'default'     => '#333'
		),
		array(
			'id'      => 'link_color',
			'type'    => 'link_color',
			'title'   => __( 'Link Colors', 'consultivo' ),
			'default' => array(
				'regular' => '#333333',
				'hover'   => '#98cb2b',
				'active'  => '#98cb2b'
			),
			'output'  => array( 'a' )
		)
	)
) );

/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Typography', 'consultivo' ),
	'icon'   => 'el-icon-text-width',
	'fields' => array(
		array(
			'id'          => 'font_main',
			'type'        => 'typography',
			'title'       => esc_html__( 'Main Font', 'consultivo' ),
			'subtitle'    => esc_html__( 'This will be the default font of your website.', 'consultivo' ),
			'google'      => true,
			'font-backup' => false,
			'all_styles'  => true,
			'line-height' => true,
			'font-size'   => true,
			'line-height' => false,
			'text-align'  => false,
			'output'      => array( 'body' ),
			'units'       => 'px'
		),
		array(
			'id'          => 'heading_font',
			'type'        => 'typography',
			'title'       => esc_html__( 'Heading Font', 'consultivo' ),
			'google'      => true,
			'font-backup' => false,
			'all_styles'  => true,
			'line-height' => true,
			'font-size'   => true,
			'line-height' => false,
			'text-align'  => false,
			'output'      => array( 'body' ),
			'units'       => 'px'
		),
		array(
			'id'      => 'custom_heading_font',
			'type'    => 'switch',
			'title'   => esc_html__( 'Custom Heading Font', 'consultivo' ),
			'default' => false,
			'indent'  => true
		),
		array(
			'id'          => 'font_h1',
			'type'        => 'typography',
			'title'       => esc_html__( 'H1', 'consultivo' ),
			'subtitle'    => esc_html__( 'This will be the default font for all H1 tags of your website.', 'consultivo' ),
			'google'      => true,
			'font-backup' => false,
			'line-height' => false,
			'all_styles'  => true,
			'text-align'  => false,
			'output'      => array( 'h1', '.h1', '.text-heading' ),
			'units'       => 'px',
			'required'    => array( 0 => 'custom_heading_font', 1 => 'equals', 2 => '1' ),
		),
		array(
			'id'          => 'font_h2',
			'type'        => 'typography',
			'title'       => esc_html__( 'H2', 'consultivo' ),
			'subtitle'    => esc_html__( 'This will be the default font for all H2 tags of your website.', 'consultivo' ),
			'google'      => true,
			'font-backup' => false,
			'all_styles'  => true,
			'text-align'  => false,
			'line-height' => false,
			'output'      => array( 'h2', '.h2' ),
			'units'       => 'px',
			'required'    => array( 0 => 'custom_heading_font', 1 => 'equals', 2 => '1' ),
		),
		array(
			'id'          => 'font_h3',
			'type'        => 'typography',
			'title'       => esc_html__( 'H3', 'consultivo' ),
			'subtitle'    => esc_html__( 'This will be the default font for all H3 tags of your website.', 'consultivo' ),
			'google'      => true,
			'font-backup' => false,
			'all_styles'  => true,
			'text-align'  => false,
			'line-height' => false,
			'output'      => array( 'h3', '.h3' ),
			'units'       => 'px',
			'required'    => array( 0 => 'custom_heading_font', 1 => 'equals', 2 => '1' ),
		),
		array(
			'id'          => 'font_h4',
			'type'        => 'typography',
			'title'       => esc_html__( 'H4', 'consultivo' ),
			'subtitle'    => esc_html__( 'This will be the default font for all H4 tags of your website.', 'consultivo' ),
			'google'      => true,
			'font-backup' => false,
			'all_styles'  => true,
			'text-align'  => false,
			'line-height' => false,
			'output'      => array( 'h4', '.h4' ),
			'units'       => 'px',
			'required'    => array( 0 => 'custom_heading_font', 1 => 'equals', 2 => '1' ),
		),
		array(
			'id'          => 'font_h5',
			'type'        => 'typography',
			'title'       => esc_html__( 'H5', 'consultivo' ),
			'subtitle'    => esc_html__( 'This will be the default font for all H5 tags of your website.', 'consultivo' ),
			'google'      => true,
			'font-backup' => false,
			'all_styles'  => true,
			'text-align'  => false,
			'line-height' => false,
			'output'      => array( 'h5', '.h5' ),
			'units'       => 'px',
			'required'    => array( 0 => 'custom_heading_font', 1 => 'equals', 2 => '1' ),
		),
		array(
			'id'          => 'font_h6',
			'type'        => 'typography',
			'title'       => esc_html__( 'H6', 'consultivo' ),
			'subtitle'    => esc_html__( 'This will be the default font for all H6 tags of your website.', 'consultivo' ),
			'google'      => true,
			'font-backup' => false,
			'all_styles'  => true,
			'line-height' => false,
			'text-align'  => false,
			'output'      => array( 'h6', '.h6' ),
			'units'       => 'px',
			'required'    => array( 0 => 'custom_heading_font', 1 => 'equals', 2 => '1' ),
		)
	)
) );

$custom_font_selectors_1 = Redux::getOption( $opt_name, 'custom_font_selectors_1' );
$custom_font_selectors_1 = ! empty( $custom_font_selectors_1 ) ? explode( ',', $custom_font_selectors_1 ) : array();

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Fonts Selectors', 'consultivo' ),
	'icon'       => 'el el-fontsize',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'          => 'custom_font_1',
			'type'        => 'typography',
			'title'       => esc_html__( 'Custom Font', 'consultivo' ),
			'subtitle'    => esc_html__( 'This will be the font that applies to the class selector.', 'consultivo' ),
			'google'      => true,
			'font-backup' => true,
			'all_styles'  => true,
			'text-align'  => false,
			'output'      => $custom_font_selectors_1,
			'units'       => 'px',

		),
		array(
			'id'       => 'custom_font_selectors_1',
			'type'     => 'textarea',
			'title'    => esc_html__( 'CSS Selectors', 'consultivo' ),
			'subtitle' => esc_html__( 'Add class selectors to apply above font.', 'consultivo' ),
			'validate' => 'no_html'
		)
	)
) );


/* Social Media */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Social Media', 'consultivo' ),
	'icon'       => 'el el-twitter',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'social_facebook_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Facebook URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_twitter_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Twitter URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_inkedin_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Inkedin URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_rss_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Rss URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_instagram_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Instagram URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_google_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Google URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_skype_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Skype URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_pinterest_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Pinterest URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_vimeo_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Vimeo URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_youtube_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Youtube URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_yelp_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Yelp URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_tumblr_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Tumblr URL', 'consultivo' ),
			'default' => '',
		),
		array(
			'id'      => 'social_tripadvisor_url',
			'type'    => 'text',
			'title'   => esc_html__( 'Tripadvisor URL', 'consultivo' ),
			'default' => '',
		),
	)
) );

/* Custom Code /--------------------------------------------------------- */
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Custom Code', 'consultivo' ),
	'icon'   => 'el-icon-edit',
	'fields' => array(

		array(
			'id'       => 'site_header_code',
			'type'     => 'textarea',
			'theme'    => 'chrome',
			'title'    => esc_html__( 'Header Custom Codes', 'consultivo' ),
			'subtitle' => esc_html__( 'It will insert the code to wp_head hook.', 'consultivo' ),
		),
		array(
			'id'       => 'site_footer_code',
			'type'     => 'textarea',
			'theme'    => 'chrome',
			'title'    => esc_html__( 'Footer Custom Codes', 'consultivo' ),
			'subtitle' => esc_html__( 'It will insert the code to wp_footer hook.', 'consultivo' ),
		),

	),
) );

/* Custom CSS /--------------------------------------------------------- */
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Custom CSS', 'consultivo' ),
	'icon'   => 'el-icon-adjust-alt',
	'fields' => array(

		array(
			'id'   => 'customcss',
			'type' => 'info',
			'desc' => esc_html__( 'Custom CSS', 'consultivo' )
		),

		array(
			'id'       => 'site_css',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'CSS Code', 'consultivo' ),
			'subtitle' => esc_html__( 'Advanced CSS Options. You can paste your custom CSS Code here.', 'consultivo' ),
			'mode'     => 'css',
			'validate' => 'css',
			'theme'    => 'chrome',
			'default'  => ""
		),

	),
) );