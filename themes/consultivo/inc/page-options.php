<?php
/**
 * Register metabox for posts based on Redux Framework. Supported methods:
 *     isset_args( $post_type )
 *     set_args( $post_type, $redux_args, $metabox_args )
 *     add_section( $post_type, $sections )
 * Each post type can contains only one metabox. Pease note that each field id
 * leads by an underscore sign ( _ ) in order to not show that into Custom Field
 * Metabox from WordPress core feature.
 *
 * @param  consultivo_Post_Metabox $metabox
 */
function consultivo_page_options_register( $metabox ) {
	if ( ! $metabox->isset_args( 'post' ) ) {
		$metabox->set_args( 'post', array(
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'consultivo' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'page' ) ) {
		$metabox->set_args( 'page', array(
			'opt_name'            => consultivo_get_page_opt_name(),
			'display_name'        => esc_html__( 'Page Settings', 'consultivo' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_audio' ) ) {
		$metabox->set_args( 'cms_pf_audio', array(
			'opt_name'     => 'post_format_audio',
			'display_name' => esc_html__( 'Audio', 'consultivo' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_link' ) ) {
		$metabox->set_args( 'cms_pf_link', array(
			'opt_name'     => 'post_format_link',
			'display_name' => esc_html__( 'Link', 'consultivo' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_quote' ) ) {
		$metabox->set_args( 'cms_pf_quote', array(
			'opt_name'     => 'post_format_quote',
			'display_name' => esc_html__( 'Quote', 'consultivo' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_video' ) ) {
		$metabox->set_args( 'cms_pf_video', array(
			'opt_name'     => 'post_format_video',
			'display_name' => esc_html__( 'Video', 'consultivo' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_gallery' ) ) {
		$metabox->set_args( 'cms_pf_gallery', array(
			'opt_name'     => 'post_format_gallery',
			'display_name' => esc_html__( 'Gallery', 'consultivo' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/* Extra Post Type */
	if ( ! $metabox->isset_args( 'services' ) ) {
		$metabox->set_args( 'services', array(
			'opt_name'            => 'service_option',
			'display_name'        => esc_html__( 'Service Settings', 'consultivo' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
if ( ! $metabox->isset_args( 'portfolio' ) ) {
    $metabox->set_args( 'portfolio', array(
        'opt_name'            => 'portfolio_option',
        'display_name'        => esc_html__( 'Portfolio Settings', 'consultivo' ),
        'show_options_object' => false,
    ), array(
        'context'  => 'advanced',
        'priority' => 'default'
    ) );
}
	/**
	 * Config Doctor meta options
	 *
	 */
	$page_title = array(
        'id'           => 'ptitle_layout',
        'type'         => 'image_select',
        'title'        => esc_html__( 'Layout', 'consultivo' ),
        'subtitle'     => esc_html__( 'Select a layout for page title.', 'consultivo' ),
        'options'      => array(
            '0' => get_template_directory_uri() . '/assets/images/page-title-layout/p0.jpg',
            '1' => get_template_directory_uri() . '/assets/images/page-title-layout/p1.jpg'
        ),
        'default'      => consultivo_get_option_of_theme_options( 'ptitle_layout' ),
        'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
        'force_output' => true
    );
    /**
     * Config Services meta options
     *
     */
    $metabox->add_section( 'services', array(
        'title'  => esc_html__( 'Settings', 'consultivo' ),
        'desc'   => esc_html__( 'Settings for service icon.', 'consultivo' ),
        'icon'   => 'el-icon-cog',
        'fields' => array(
            array(
                'id' => 'icon',
                'type' => 'media',
                'preview' => 'true',
                'url' => 'true',
                'compiler' => 'true',
                'title' => esc_html__('Icon', 'consultivo'),
                'subtitle' => esc_html__('Choose the icon', 'consultivo'),
            )
        )
    ) );
    $metabox->add_section( 'services', array(
        'title'  => esc_html__( 'Page Title', 'consultivo' ),
        'desc'   => esc_html__( 'Settings for page title.', 'consultivo' ),
        'icon'   => 'el-icon-map-marker',
        'fields' => array(
            array(
                'id'      => 'custom_pagetitle',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Page Title', 'consultivo' ),
                'default' => false,
                'indent'  => true
            ),
            $page_title,
            array(
                'id'                    => 'page_ptitle_bg',
                'type'                  => 'background',
                'title'                 => esc_html__( 'Background', 'consultivo' ),
                'subtitle'              => esc_html__( 'Page title background.', 'consultivo' ),
                'output'                => array( '#pagetitle' ),
                'background-color'      => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'background-attachment' => false,
                'background-size'       => false,
                'required'              => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output'          => true
            ),
        )
    ) );
    $metabox->add_section( 'services', array(
        'title'  => esc_html__( 'Content', 'consultivo' ),
        'desc'   => esc_html__( 'Settings for content area.', 'consultivo' ),
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
                'desc'           => esc_html__( 'Default: Theme Option.', 'consultivo' ),
                'default'        => array(
                    'padding-top'    => '',
                    'padding-bottom' => '',
                    'units'          => 'px',
                )
            )
        )
    ) );
    /**
     * Config Case Study meta options
     *
     */
    $metabox->add_section( 'portfolio', array(
        'title'  => esc_html__( 'Page Title', 'consultivo' ),
        'desc'   => esc_html__( 'Settings for page title.', 'consultivo' ),
        'icon'   => 'el-icon-map-marker',
        'fields' => array(
            array(
                'id'      => 'custom_pagetitle',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Page Title', 'consultivo' ),
                'default' => false,
                'indent'  => true
            ),
            $page_title,
            array(
                'id'                    => 'page_ptitle_bg',
                'type'                  => 'background',
                'title'                 => esc_html__( 'Background', 'consultivo' ),
                'subtitle'              => esc_html__( 'Page title background.', 'consultivo' ),
                'output'                => array( '#pagetitle' ),
                'background-color'      => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'background-attachment' => false,
                'background-size'       => false,
                'required'              => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output'          => true
            ),
        )
    ) );
    $metabox->add_section( 'portfolio', array(
        'title'  => esc_html__( 'Content', 'consultivo' ),
        'desc'   => esc_html__( 'Settings for content area.', 'consultivo' ),
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
                'desc'           => esc_html__( 'Default: Theme Option.', 'consultivo' ),
                'default'        => array(
                    'padding-top'    => '',
                    'padding-bottom' => '',
                    'units'          => 'px',
                )
            )
        )
    ) );
	/**
	 * Config post meta options
	 *
	 */
	$single_post_fields = array();
    $single_post_fields[] = array(
        'id'      => 'custom_pagetitle',
        'type'    => 'switch',
        'title'   => esc_html__( 'Custom Page Title', 'consultivo' ),
        'default' => false,
        'indent'  => true
    );
	$single_post_fields[] = $page_title;
	$single_post_fields[] = array(
		'id'           => 'custom_title',
		'type'         => 'text',
		'title'        => esc_html__( 'Custom Title', 'consultivo' ),
		'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'consultivo' ),
		'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
		'force_output' => true
	);
	$single_post_fields[] = array(
		'id'           => 'page_ptitle_color',
		'type'         => 'color',
		'title'        => esc_html__( 'Title Color', 'consultivo' ),
		'subtitle'     => esc_html__( 'Page title color.', 'consultivo' ),
		'output'       => array( 'body #pagetitle h1.page-title' ),
		'default'      => '',
		'transparent'  => false,
		'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
		'force_output' => true
	);
	$single_post_fields[] = array(
		'id'                    => 'page_ptitle_bg',
		'type'                  => 'background',
		'title'                 => esc_html__( 'Background', 'consultivo' ),
		'subtitle'              => esc_html__( 'Page title background.', 'consultivo' ),
		'output'                => array( '#pagetitle' ),
		'background-color'      => false,
		'background-repeat'     => false,
		'background-position'   => false,
		'background-attachment' => false,
		'background-size'       => false,
		'required'              => array( 0 => 'custom_pagetitle', 1 => 'equals', 2 => true ),
		'force_output'          => true
	);
	$single_post_fields[] = array(
		'id'           => 'ptitle_paddings',
		'type'         => 'spacing',
		'title'        => esc_html__( 'Page Title Padding', 'consultivo' ),
		'mode'         => 'padding',
		'units'        => array( 'em', 'px', '%' ),
		'top'          => true,
		'right'        => false,
		'bottom'       => true,
		'left'         => false,
		'output'       => array( 'body #pagetitle' ),
		'default'      => array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'units'  => 'px',
		),
		'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
		'force_output' => true
	);
	$single_post_fields[] = array(
		'id'           => 'ptitle_content_align',
		'type'         => 'button_set',
		'title'        => esc_html__( 'Content Align', 'consultivo' ),
		'options'      => array(
			'themeoption' => esc_html__( 'Theme Option', 'consultivo' ),
			'left'        => esc_html__( 'Left', 'consultivo' ),
			'center'      => esc_html__( 'Center', 'consultivo' ),
			'right'       => esc_html__( 'Right', 'consultivo' ),
		),
		'default'      => 'themeoption',
		'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
		'force_output' => true
	);
	$single_post_fields[] = array(
		'id'             => 'post_content_padding',
		'type'           => 'spacing',
		'output'         => array( '.single-post #content' ),
		'right'          => false,
		'left'           => false,
		'mode'           => 'padding',
		'units'          => array( 'px' ),
		'units_extended' => 'false',
		'title'          => esc_html__( 'Content Padding', 'consultivo' ),
		'desc'           => esc_html__( 'Default: Theme Option.', 'consultivo' ),
		'default'        => array(
			'padding-top'    => '',
			'padding-bottom' => '',
			'units'          => 'px',
		)
	);
	$metabox->add_section( 'post', array(
		'title'  => esc_html__( 'Sidebar Position', 'consultivo' ),
		'icon'   => 'el el-refresh',
		'fields' => $single_post_fields
	) );

	/**
	 * Config page meta options
	 *
	 */
	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Header', 'consultivo' ),
		'desc'   => esc_html__( 'Header settings for the page.', 'consultivo' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'consultivo' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'consultivo' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'consultivo' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
                    '3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
                    '4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
                    '5' => get_template_directory_uri() . '/assets/images/header-layout/h5.jpg',
                    '6' => get_template_directory_uri() . '/assets/images/header-layout/h6.jpg',
                    '7' => get_template_directory_uri() . '/assets/images/header-layout/h7.jpg',
                    '8' => get_template_directory_uri() . '/assets/images/header-layout/h8.jpg',
                    '9' => get_template_directory_uri() . '/assets/images/header-layout/h9.jpg',
                    '10' => get_template_directory_uri() . '/assets/images/header-layout/h10.jpg',
				),
				'default'      => consultivo_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
            array(
                'id' => 'header_top_bg',
                'type' => 'color',
                'title' => esc_html__('Top Menu Background', 'consultivo'),
                'output' => array(
                    'background-color' => '#site-header-wrap.header-layout2 .site-header-top, #site-header-wrap.header-layout3,#site-header-wrap.header-layout5 .site-header-top'
                ),
                'force_output' => true
            ),
            array(
                'id' => 'header_main_bg',
                'type' => 'color',
                'title' => esc_html__('Main Menu Background', 'consultivo'),
                'output' => array('background-color' => '#site-header-wrap.header-layout2 .site-header-main,#site-header-wrap.header-layout3 .site-header-main .content-menu,#site-header-wrap.header-layout5 .site-header-main,#site-header-wrap.header-layout6 .site-header-main'),
                'force_output' => true
            ),
            array(
                'id'       => 'sticky_on',
                'type'     => 'switch',
                'title'    => esc_html__('Sticky Header', 'consultivo'),
                'subtitle' => esc_html__('Header will be sticked when applicable.', 'consultivo'),
                'default'  => false
            ),
            array(
                'id' => 'header_sticky_bg',
                'type' => 'color',
                'title' => esc_html__('Sticky Menu Background', 'consultivo'),
                'output' => array('background-color' => '#headroom.headroom--pinned:not(.headroom--top),.header-layout3 #headroom.headroom--pinned:not(.headroom--top) .content-menu,.header-layout6 #headroom.headroom--pinned:not(.headroom--top) .site-header-main'),
                'force_output' => true,
                'required' => ['sticky_on','equals','1'],
            ),
            array(
                'title' => esc_html__('Show Custom Button','consultivo'),
                'type' => 'switch',
                'id' => 'show_custom_button',
                'default' => false
            ),
            array(
                'id' => 'h_btn_text',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'consultivo'),
                'default' => 'Consultation',
                'required' => array( 0 => 'show_custom_button', 1 => 'equals', 2 => 1 ),
            ),
            array(
                'id'    => 'h_btn_page_link',
                'type'  => 'select',
                'title' => esc_html__( 'Page Link', 'consultivo' ),
                'data'  => 'page',
                'args'  => array(
                    'post_type'      => 'page',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ),
                'force_output' => true,
                'required' => array( 0 => 'show_custom_button', 1 => 'equals', 2 => 1 ),
            ),
            array(
                'title' => esc_html__('Show Search Button','consultivo'),
                'type' => 'switch',
                'id' => 'show_search_button',
            ),
            array(
                'title' => esc_html__('Show Cart Button','consultivo'),
                'type' => 'switch',
                'id' => 'show_cart_button',
            )
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Page Title', 'consultivo' ),
		'desc'   => esc_html__( 'Settings for page title.', 'consultivo' ),
		'icon'   => 'el-icon-map-marker',
		'fields' => array(
			array(
				'id'      => 'custom_pagetitle',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Page Title', 'consultivo' ),
				'default' => false,
				'indent'  => true
			),
			$page_title,
			array(
				'id'           => 'custom_title',
				'type'         => 'text',
				'title'        => esc_html__( 'Title', 'consultivo' ),
				'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'consultivo' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'page_ptitle_color',
				'type'         => 'color',
				'title'        => esc_html__( 'Title Color', 'consultivo' ),
				'subtitle'     => esc_html__( 'Page title color.', 'consultivo' ),
				'output'       => array( 'body #pagetitle h1.page-title' ),
				'default'      => '',
				'transparent'  => false,
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'ptitle_font_size',
				'type'         => 'text',
				'title'        => esc_html__( 'Title Font Size', 'consultivo' ),
				'validate'     => 'numeric',
				'desc'         => 'Enter number',
				'msg'          => 'Please enter number',
				'default'      => '',
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'                    => 'page_ptitle_bg',
				'type'                  => 'background',
				'title'                 => esc_html__( 'Background', 'consultivo' ),
				'subtitle'              => esc_html__( 'Page title background.', 'consultivo' ),
				'output'                => array('#pagetitle' ),
				'background-color'      => false,
				'background-repeat'     => false,
				'background-position'   => false,
				'background-attachment' => false,
				'background-size'       => false,
				'required'              => array( 'custom_pagetitle','equals',true ),
				'force_output'          => true
			),
			array(
				'id'           => 'ptitle_paddings',
				'type'         => 'spacing',
				'title'        => esc_html__( 'Content Paddings', 'consultivo' ),
				'subtitle'     => esc_html__( 'Content page title paddings.', 'consultivo' ),
				'mode'         => 'padding',
				'units'        => array( 'em', 'px', '%' ),
				'top'          => true,
				'right'        => false,
				'bottom'       => true,
				'left'         => false,
				'output'       => array( 'body #pagetitle' ),
				'default'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'units'  => 'px',
				),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Content', 'consultivo' ),
		'desc'   => esc_html__( 'Settings for content area.', 'consultivo' ),
		'icon'   => 'el-icon-pencil',
		'fields' => array(
            array(
                'id'       => 'sidebar_page_pos',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar Position', 'consultivo' ),
                'subtitle' => esc_html__( 'Select a sidebar position', 'consultivo' ),
                'options'  => array(
                    'left'  => esc_html__( 'Left', 'consultivo' ),
                    'right' => esc_html__( 'Right', 'consultivo' ),
                    'none'  => esc_html__( 'Disabled', 'consultivo' )
                ),
                'default'  => 'none'
            ),
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
				'force_output'   => true,
				'title'          => esc_html__( 'Content Padding', 'consultivo' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'consultivo' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			)
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Footer', 'consultivo' ),
		'desc'   => esc_html__( 'Settings for page footer.', 'consultivo' ),
		'icon'   => 'el el-website',
		'fields' => array(
			array(
				'id'      => 'custom_footer',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Footer', 'consultivo' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'footer_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'consultivo' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/footer-layout/f0.jpg',
                     '1' => get_template_directory_uri() . '/assets/images/footer-layout/ft1.jpg'
				),
				'default'      => '0',
				'required'     => array( 0 => 'custom_footer', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
            array(
                'id'    => 'footer_top_border',
                'type'  => 'switch',
                'title' => esc_html__('Footer Top Border', 'consultivo'),
                'default' => false,
                'force_output' => true
            ),
            array(
                'id'        => 'footer_top_border_option',
                'type'      => 'border',
                'title'     => esc_html__('Border Options', 'consultivo'),
                'output'    => array('.top-footer'),
                'required' => array(0 => 'footer_top_border', 1 => 'equals', 2 => true),
                'left' => false,
                'right' => false,
                'top' => false,
                'force_output' => true
            ),
            array(
                'id'                    => 'footer_image_bg',
                'type'                  => 'background',
                'title'                 => esc_html__( 'Footer Background', 'consultivo' ),
                'output'                => array('background-image' => '.site-footer' ),
                'force_output'          => true
            ),
            array(
                'id'    => 'footer_bottom_bg',
                'type'  => 'color_rgba',
                'title' => esc_html__('Footer Bottom background', 'consultivo'),
                'output'   => array('background-color' => '#page .site-footer .bottom-footer'),
                'force_output' => true
            ),
		)
	) );

	/**
	 * Config post format meta options
	 *
	 */

	$metabox->add_section( 'cms_pf_video', array(
		'title'  => esc_html__( 'Video', 'consultivo' ),
		'fields' => array(
			array(
				'id'    => 'post-video-url',
				'type'  => 'text',
				'title' => esc_html__( 'Video URL', 'consultivo' ),
				'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'consultivo' )
			),

			array(
				'id'    => 'post-video-file',
				'type'  => 'editor',
				'title' => esc_html__( 'Video Upload', 'consultivo' ),
				'desc'  => esc_html__( 'Upload video file', 'consultivo' )
			),

			array(
				'id'    => 'post-video-html',
				'type'  => 'textarea',
				'title' => esc_html__( 'Embadded video', 'consultivo' ),
				'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'consultivo' )
			)
		)
	) );

	$metabox->add_section( 'cms_pf_gallery', array(
		'title'  => esc_html__( 'Gallery', 'consultivo' ),
		'fields' => array(
			array(
				'id'       => 'post-gallery-lightbox',
				'type'     => 'switch',
				'title'    => esc_html__( 'Lightbox?', 'consultivo' ),
				'subtitle' => esc_html__( 'Enable lightbox for gallery images.', 'consultivo' ),
				'default'  => true
			),
			array(
				'id'       => 'post-gallery-images',
				'type'     => 'gallery',
				'title'    => esc_html__( 'Gallery Images ', 'consultivo' ),
				'subtitle' => esc_html__( 'Upload images or add from media library.', 'consultivo' )
			)
		)
	) );

	$metabox->add_section( 'cms_pf_audio', array(
		'title'  => esc_html__( 'Audio', 'consultivo' ),
		'fields' => array(
			array(
				'id'          => 'post-audio-url',
				'type'        => 'text',
				'title'       => esc_html__( 'Audio URL', 'consultivo' ),
				'description' => esc_html__( 'Audio file URL in format: mp3, ogg, wav.', 'consultivo' ),
				'validate'    => 'url',
				'msg'         => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'cms_pf_link', array(
		'title'  => esc_html__( 'Link', 'consultivo' ),
		'fields' => array(
			array(
				'id'       => 'post-link-url',
				'type'     => 'text',
				'title'    => esc_html__( 'URL', 'consultivo' ),
				'validate' => 'url',
				'msg'      => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'cms_pf_quote', array(
		'title'  => esc_html__( 'Quote', 'consultivo' ),
		'fields' => array(
			array(
				'id'    => 'post-quote-cite',
				'type'  => 'text',
				'title' => esc_html__( 'Cite', 'consultivo' )
			)
		)
	) );

}


add_action( 'cms_post_metabox_register', 'consultivo_page_options_register' );

function consultivo_get_option_of_theme_options( $key, $default = '' ) {
	if ( empty( $key ) ) {
		return '';
	}
	$options = get_option( consultivo_get_opt_name(), array() );
	$value   = isset( $options[ $key ] ) ? $options[ $key ] : $default;

	return $value;
}