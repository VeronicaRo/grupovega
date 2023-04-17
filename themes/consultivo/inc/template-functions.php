<?php
/**
 * Helper functions for the theme
 *
 * @package consultivo
 */

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function consultivo_get_opt( $opt_id, $default = false ) {
	$opt_name = consultivo_get_opt_name();
	if ( empty( $opt_name ) ) {
		return $default;
	}

	global ${$opt_name};
	if ( ! isset( ${$opt_name} ) || ! isset( ${$opt_name}[ $opt_id ] ) ) {
		$options = get_option( $opt_name );
	} else {
		$options = ${$opt_name};
	}
	if ( ! isset( $options ) || ! isset( $options[ $opt_id ] ) || $options[ $opt_id ] === '' ) {
		return $default;
	}
	if ( is_array( $options[ $opt_id ] ) && is_array( $default ) ) {
		foreach ( $options[ $opt_id ] as $key => $value ) {
			if ( isset( $default[ $key ] ) && $value === '' ) {
				$options[ $opt_id ][ $key ] = $default[ $key ];
			}
		}
	}

	return $options[ $opt_id ];
}


/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function consultivo_get_page_opt( $opt_id, $default = false ) {
	$page_opt_name = consultivo_get_page_opt_name();
	if ( empty( $page_opt_name ) ) {
		return $default;
	}
	$id = get_the_ID();
	if ( ! is_archive() && is_home() ) {
		if ( ! is_front_page() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			$id             = $page_for_posts;
		}
	}

	return $options = ! empty( intval( $id ) ) ? get_post_meta( intval( $id ), $opt_id, true ) : $default;
}

/**
 *
 * Get post format values.
 *
 * @param $post_format_key
 * @param bool $default
 *
 * @return bool|mixed
 */
function consultivo_get_post_format_value( $post_format_key, $default = false ) {
	global $post;

	return $value = ! empty( $post->ID ) ? get_post_meta( $post->ID, $post_format_key, true ) : $default;
}


/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function consultivo_get_opt_name() {
	return apply_filters( 'consultivo_opt_name', 'cms_theme_options' );
}



/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function consultivo_get_page_opt_name() {
	return apply_filters( 'consultivo_page_opt_name', 'cms_page_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function consultivo_get_post_opt_name() {
	return apply_filters( 'consultivo_post_opt_name', 'consultivo_post_options' );
}
/**
 * Get page title and description.
 *
 * @return array Contains 'title'
 */
function consultivo_get_page_titles() {
	$title = '';

	// Default titles
	if ( ! is_archive() ) {
		// Posts page view
		if ( is_home() ) {
			// Only available if posts page is set.
			if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
				$title = get_post_meta( $page_for_posts, 'custom_title', true );
				if ( empty( $title ) ) {
					$title = get_the_title( $page_for_posts );
				}
			}
			if ( is_front_page() ) {
				$title = esc_html__( 'Blog', 'consultivo' );
			}
		} // Single page view
        elseif ( is_page() ) {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		} elseif ( is_404() ) {
			$title = esc_html__( '404', 'consultivo' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results', 'consultivo' );
		} else {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		}
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author:', 'consultivo' ) . ' ' . get_the_author();
	} // Author
	else {
		$title = get_the_archive_title();
        if(class_exists('Woocommerce')) {
            if (is_shop()) {
                $title = esc_html__('Shop', 'consultivo');
            }
        }
	}

	return array(
		'title' =>  $title,
	);
}

add_filter( 'get_the_archive_title', 'consultivo_archive_title_remove_label' );
function consultivo_archive_title_remove_label( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = single_post_title( '', false );
	}

	return $title;
}

/**
 * Generates an excerpt from the post content with custom length.
 * Default length is 55 words, same as default the_excerpt()
 *
 * The excerpt words amount will be 55 words and if the amount is greater than
 * that, then the string '&hellip;' will be appended to the excerpt. If the string
 * is less than 55 words, then the content will be returned as it is.
 *
 * @param int $length Optional. Custom excerpt length, default to 55.
 * @param int|WP_Post $post Optional. You will need to provide post id or post object if used outside loops.
 *
 * @return string           The excerpt with custom length.
 */
function consultivo_get_the_excerpt( $length = 55, $post = null ) {
	$post = get_post( $post );

	if ( empty( $post ) || 0 >= $length ) {
		return '';
	}

	if ( post_password_required( $post ) ) {
		return esc_html__( 'Post password required.', 'consultivo' );
	}

	$content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$excerpt_more = apply_filters( 'consultivo_excerpt_more', '&hellip;' );
	$excerpt      = wp_trim_words( $content, $length, $excerpt_more );

	return $excerpt;
}


/**
 * Check if provided color string is valid color.
 * Only supports 'transparent', HEX, RGB, RGBA.
 *
 * @param  string $color
 *
 * @return boolean
 */
function consultivo_is_valid_color( $color ) {
	$color = preg_replace( "/\s+/m", '', $color );

	if ( $color === 'transparent' ) {
		return true;
	}

	if ( '' == $color ) {
		return false;
	}

	// Hex format
	if ( preg_match( "/(?:^#[a-fA-F0-9]{6}$)|(?:^#[a-fA-F0-9]{3}$)/", $color ) ) {
		return true;
	}

	// rgb or rgba format
	if ( preg_match( "/(?:^rgba\(\d+\,\d+\,\d+\,(?:\d*(?:\.\d+)?)\)$)|(?:^rgb\(\d+\,\d+\,\d+\)$)/", $color ) ) {
		preg_match_all( "/\d+\.*\d*/", $color, $matches );
		if ( empty( $matches ) || empty( $matches[0] ) ) {
			return false;
		}

		$red   = empty( $matches[0][0] ) ? $matches[0][0] : 0;
		$green = empty( $matches[0][1] ) ? $matches[0][1] : 0;
		$blue  = empty( $matches[0][2] ) ? $matches[0][2] : 0;
		$alpha = empty( $matches[0][3] ) ? $matches[0][3] : 1;

		if ( $red < 0 || $red > 255 || $green < 0 || $green > 255 || $blue < 0 || $blue > 255 || $alpha < 0 || $alpha > 1.0 ) {
			return false;
		}
	} else {
		return false;
	}

	return true;
}

/**
 * Minify css
 *
 * @param  string $css
 *
 * @return string
 */
function consultivo_css_minifier( $css ) {
	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );
	// Remove spaces before and after comment
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
	// Remove comment blocks, everything between /* and */, unless
	// preserved with /*! ... */ or /** ... */
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );
	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
	// Remove space before , ; { } ( ) >
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	// Converts all zeros value into short-hand
	$css = preg_replace( '/0 0 0 0/', '0', $css );
	// Shortern 6-character hex color codes to 3-character where possible
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );
}

/**
 * Header Tracking Code to wp_head hook.
 */
function consultivo_header_code() {
	$site_header_code = consultivo_get_opt( 'site_header_code' );
	if ( $site_header_code !== '' ) {
		print wp_kses( $site_header_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_head', 'consultivo_header_code' );

/**
 * Footer Tracking Code to wp_footer hook.
 */
function consultivo_footer_code() {
	$site_footer_code = consultivo_get_opt( 'site_footer_code' );
	if ( $site_footer_code !== '' ) {
		print wp_kses( $site_footer_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_footer', 'consultivo_footer_code' );

/**
 * Custom Comment List
 */
function consultivo_comment_list( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
	?>
    <<?php echo ''.$tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		    <div class="comment-inner clearfix">
		        <div class="comment-media">
					<?php if ( $args['avatar_size'] != 0 ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					} ?>
		        </div>
		        <div class="comment-content">
		            <h4 class="comment-title">
		            	<?php printf( '%s', get_comment_author_link() ); ?><br>
		            	<span class="comment-date">
	                        <span><?php echo get_comment_date('M d, Y'); ?></span> - <?php echo get_comment_date('H:i a'); ?>
	                    </span>
		            </h4>
		            <div class="comment-text"><?php comment_text(); ?></div>
                    <div class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array(
                            'add_below' => $add_below,
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth']
                        ) ) ); ?>
                    </div>
		        </div>
		    </div>
		<?php if ( 'div' != $args['style'] ) : ?>
        </div>
	<?php endif;
}

/**
 * Get Doctor
 */
function consultivo_get_services(){
    $results = get_posts(array('post_type' => 'services', 'post_status' => 'publish','posts_per_page' => -1));
    $services = array();
    foreach ($results as $key => $value){
        $services[$value->ID] = $value->post_title;
    }
    return $services;
}
function consultivo_get_doctors(){
    $results = get_posts(array('post_type' => 'doctor', 'post_status' => 'publish','posts_per_page' => -1));
    $doctors = array();
    foreach ($results as $key => $value){
        $doctors[$value->ID] = $value->post_title;
    }
    return $doctors;
}
function consultivo_get_doctors_by_service($service_id = ''){
    $service_id = (string) $service_id;
    $args = array(
        'post_type'  => 'doctor',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'meta_key' => 'doctor_service',
        'meta_value' =>  $service_id,
        'meta_compare' => 'like',
    );
    $query = new WP_Query( $args );

    $doctors = array();

    foreach ($query->posts as $key => $doctor) {
        $doctors[$doctor->ID] = $doctor->post_title;
    }

    wp_reset_query();

    return $doctors;
}
/**
 * Add field subtitle to post.
 */
function consultivo_add_subtitle_field() {
	global $post;

	$screen = get_current_screen();

	if ( in_array( $screen->id, array( 'acm-post' ) ) ) {

		$value = get_post_meta( $post->ID, 'post_subtitle', true );

		echo '<div class="subtitle"><input type="text" name="post_subtitle" value="' . esc_attr( $value ) . '" id="subtitle" placeholder = "' . esc_attr( 'Subtitle' ) . '" style="width: 100%;margin-top: 4px;"></div>';
	}
}

add_action( 'edit_form_after_title', 'consultivo_add_subtitle_field' );

/**
 * Save custom theme meta
 */
function consultivo_save_meta_boxes( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_subtitle'] ) ) {
		update_post_meta( $post_id, 'post_subtitle', $_POST['post_subtitle'] );
	}
}

add_action( 'save_post', 'consultivo_save_meta_boxes' );


add_filter( 'cms_extra_post_types', 'consultivo_add_posttype' );
function consultivo_add_posttype( $postypes ) {
    $postypes['portfolio'] = array(
        'status'     => true,
        'item_name'  => __('Case Studies', 'consultivo'),
        'items_name' => __('Case Studies', 'consultivo'),
        'args'       => array(),
        'labels'     => array(
            'singular_name' => __('Case Studies', 'consultivo'),
            'add_new'       => _x('Add New', 'add new on admin panel', 'consultivo'),
        )
    );
    $postypes['services'] = array(
        'status'     => true,
        'item_name'  => esc_html__( 'Services', 'consultivo' ),
        'items_name' => esc_html__( 'Services', 'consultivo' ),
        'args'       => array(
            'menu_icon'          => 'dashicons-admin-tools',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt'
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'rewrite'             => array(
                'slug'       => 'service',
                'has_archive' => true,
            ),
        ),
        'labels'     => array()
    );
	return $postypes;
}


add_filter( 'cms_extra_taxonomies', 'consultivo_add_tax' );
function consultivo_add_tax( $taxonomies ) {
    $taxonomies['service-type'] = array(
        'status'     => true,
        'post_type'  => array( 'services' ),
        'taxonomy'   => esc_html__( 'Services Type', 'consultivo' ),
        'taxonomies' => esc_html__( 'Services Type', 'consultivo' ),
        'args'       => array(),
        'labels'     => array()
    );

    return $taxonomies;
}


add_filter( 'cms_enable_megamenu', 'consultivo_enable_megamenu' );
function consultivo_enable_megamenu() {
	return true;
}
add_filter( 'cms_locations', 'custom_icons' );
function custom_icons($locations) {
    $new = array('megamenu1','megamenu2','megamenu3','megamenu4');

    return array_merge($new,$locations);
}
add_filter( 'cms_enable_onepage', 'consultivo_enable_onepage' );
function consultivo_enable_onepage() {
	return false;
}

/* Add default pagram Carousel */
function consultivo_get_param_carousel( $atts ) {
	$default  = array(
		'col_xs'           => '1',
		'col_sm'           => '2',
		'col_md'           => '3',
		'col_lg'           => '4',
		'margin'           => '30',
		'loop'             => 'false',
		'autoplay'         => 'false',
		'autoplay_timeout' => '5000',
		'smart_speed'      => '250',
		'center'           => 'false',
		'stage_padding'    => '0',
		'arrows'           => 'false',
		'bullets'          => 'false',
	);
	$new_data = array_merge( $default, $atts );
	extract( $new_data );
	$carousel      = array(
		'data-item-xs' => $col_xs,
		'data-item-sm' => $col_sm,
		'data-item-md' => $col_md,
		'data-item-lg' => $col_lg,

		'data-margin'          => $margin,
		'data-loop'            => $loop,
		'data-autoplay'        => $autoplay,
		'data-autoplaytimeout' => $autoplay_timeout,
		'data-smartspeed'      => $smart_speed,
		'data-center'          => $center,
		'data-arrows'          => $arrows,
		'data-bullets'         => $bullets,
		'data-stagepadding'    => $stage_padding,
		'data-rtl'             => is_rtl() ? 'true' : 'false',
	);
	$carousel_data = '';
	foreach ( $carousel as $key => $value ) {
		if ( isset( $value ) ) {
			$carousel_data .= $key . '=' . $value . ' ';
		}
	}
	$new_data['carousel_data'] = $carousel_data;

	return $new_data;
}

function consultivo_add_vc_extra_param( $old_param ) {
	$extra_param         = array(
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Columns XS (< 767px)", 'consultivo' ),
			"param_name"       => "col_xs",
			"edit_field_class" => "vc_col-sm-3",
			"value"            => array( 1, 2, 3, 4 ),
			"std"              => 1,
			"group"            => 'Carousel Settings',
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Columns SM (< 991px)", 'consultivo' ),
			"param_name"       => "col_sm",
			"edit_field_class" => "vc_col-sm-3",
			"value"            => array( 1, 2, 3, 4 ),
			"std"              => 2,
			"group"            => 'Carousel Settings',
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Columns MD (< 1199px)", 'consultivo' ),
			"param_name"       => "col_md",
			"edit_field_class" => "vc_col-sm-3",
			"value"            => array( 1, 2, 3, 4 ),
			"std"              => 3,
			"group"            => 'Carousel Settings',
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Columns LG (> 1200px)", 'consultivo' ),
			"param_name"       => "col_lg",
			"edit_field_class" => "vc_col-sm-3",
			"value"            => array( 1, 2, 3, 4, 5, 6 ),
			"std"              => 4,
			"group"            => 'Carousel Settings',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Items', 'consultivo' ),
			'param_name'  => 'margin',
			'value'       => '',
			'group'       => 'Carousel Settings',
			'description' => 'Enter number: ...( Default 30 )',
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Loop Items", 'consultivo' ),
			"param_name" => "loop",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Autoplay", 'consultivo' ),
			"param_name" => "autoplay",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Autoplay Timeout', 'consultivo' ),
			'param_name'  => 'autoplay_timeout',
			'value'       => '',
			'group'       => 'Carousel Settings',
			'description' => 'Enter number: ...( Default 5000 )',
			'dependency'  => array(
				'element' => 'autoplay',
				'value'   => 'true',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Smart Speed', 'consultivo' ),
			'param_name'  => 'smart_speed',
			'value'       => '',
			'group'       => 'Carousel Settings',
			'description' => 'Enter number: ...( Default 250 )',
			'dependency'  => array(
				'element' => 'autoplay',
				'value'   => 'true',
			),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Center", 'consultivo' ),
			"param_name" => "center",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Stage Padding', 'consultivo' ),
			'param_name'  => 'stage_padding',
			'value'       => '',
			'group'       => 'Carousel Settings',
			'description' => 'Enter number: ...( Default 0 )',
			'dependency'  => array(
				'element' => 'center',
				'value'   => 'true',
			),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Show Arrows", 'consultivo' ),
			"param_name" => "arrows",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Show Bullets", 'consultivo' ),
			"param_name" => "bullets",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
		),
	);
	$old_param['params'] = array_merge( $old_param['params'], $extra_param );

	return $old_param;
}

/* Show/hide CMS Carousel */
add_filter( 'enable_cms_carousel', 'consultivo_enable_cms_carousel' );
function consultivo_enable_cms_carousel() {
	return false;
}

/*
 * Set post views count using post meta
 */
function consultivo_set_post_views( $postID ) {
	$countKey = 'post_views_count';
	$count    = get_post_meta( $postID, $countKey, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $countKey );
		add_post_meta( $postID, $countKey, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $countKey, $count );
	}
}
function consultivo_get_contact_form(){
    $contact_forms = array();
    if(class_exists('WPCF7')) {
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
        if ( $cf7 ) {
            foreach ( $cf7 as $cform ) {
                $contact_forms[ $cform->ID ] = $cform->post_title;
            }
        } else {
            $contact_forms[ esc_html__( 'No contact forms found', 'consultivo' ) ] = 0;
        }
    } else {
        $contact_forms = '';
    }
    return $contact_forms;
}
//add_shortcode( 'html_box', 'html_box_struct' );

/**
 * Export Demo Data
 */

add_filter('swa_ie_export_mode', 'function_enable_export_mode');
function function_enable_export_mode()
{
	return false;
}

if (!function_exists('consultivo_cpt_dev_mode')) {
	add_filter('cpt_dev_mode', 'consultivo_cpt_dev_mode');
	function consultivo_cpt_dev_mode()
	{
		return false;
	}
}

/*
 *  Dashboard Configurations
 */
if (!function_exists('consultivo_cpt_dashboard_config')) {
	add_filter('cpt_dashboard_config', 'consultivo_cpt_dashboard_config');
	function consultivo_cpt_dashboard_config()
	{
		return [
			'documentation_link'  => 'https://cmssuperheroes.gitbook.io/consultivo-wordpress-theme/',
			'ticket_link'         => 'https://cmssuperheroes.ticksy.com/',
			'video_tutorial_link' => 'https://www.youtube.com/watch?v=2yVgy0mHFk0&list=PL2sD6GXVuXxECDCGkjuv0ez-_5zrZOoIu&index=1',
			'demo_link'           => 'http://demo.cmssuperheroes.com/themeforest/consultivo/',
		];
	}
}
/*
 *  Dashboard Configurations
 */