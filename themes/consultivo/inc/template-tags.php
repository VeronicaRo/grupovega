<?php
/**
 * Custom template tags for this theme.
 *
 * @package consultivo
 */

/**
 * Header layout
 **/
function consultivo_page_loading()
{
    $page_loading = consultivo_get_opt( 'show_page_loading', false );

    if($page_loading) { ?>
        <div id="cms-loadding" class="cms-loader">
            <div class="loading-spin">
                <div class="spinner">
                    <div class="right-side"><div class="bar"></div></div>
                    <div class="left-side"><div class="bar"></div></div>
                </div>
                <div class="spinner color-2" style="">
                    <div class="right-side"><div class="bar"></div></div>
                    <div class="left-side"><div class="bar"></div></div>
                </div>
            </div>
        </div>
    <?php }
}

/**
 * Header layout
 **/
function consultivo_header_layout()
{
    $header_layout = consultivo_get_opt( 'header_layout', '' );
    $header_layout_old = $header_layout;
    $custom_header = consultivo_get_page_opt( 'custom_header', '0' );

    if ( is_page() && $custom_header == '1' )
    {
        $page_header_layout = consultivo_get_page_opt('header_layout');
        $header_layout = $page_header_layout;
        if($header_layout == '0') {
            return;
        }
    }
    get_template_part( 'template-parts/header-layout', $header_layout );
}

/**
 * Page title layout
 **/
function consultivo_page_title_layout()
{
    $ptitle_layout = consultivo_get_opt( 'ptitle_layout', '1' );
    $ptitle_old_layout = $ptitle_layout;
    $custom_pagetitle = consultivo_get_page_opt( 'custom_pagetitle', '0' );
    if ( $custom_pagetitle == '1' )
    {
        $page_ptitle_layout = consultivo_get_page_opt('ptitle_layout');
        $ptitle_layout = $page_ptitle_layout;
    }
    if ($ptitle_layout == '0') {
        if(is_search()) {
            get_template_part( 'template-parts/page-title',$ptitle_old_layout);
        }
        return;
    }
    get_template_part( 'template-parts/page-title', $ptitle_layout );
}

/**
 * Page title layout
 **/
function consultivo_footer()
{
    $footer_layout = consultivo_get_opt( 'footer_layout', '1' );
    $custom_footer = consultivo_get_page_opt( 'custom_footer', '0' );

    if ( is_page() && $custom_footer == '1' )
    {
        $page_footer_layout = consultivo_get_page_opt('footer_layout');
        $footer_layout = $page_footer_layout;
        if($footer_layout == '0') {
            return;
        }
    }
    get_template_part( 'template-parts/footer-layout', $footer_layout );
}

/**
 * Set primary content class based on sidebar position
 *
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function consultivo_primary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && (is_product_category()) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    else :
        $sidebar_load = 'sidebar-blog';
    endif;
    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array( trim( $extra_class ) );
        $xl = 'col-xl-8';
        if(class_exists('Woocommerce')) {
            if (is_shop() || is_singular(array('product'))) {
                $xl = 'col-xl-9';
            }
        }
        switch ( $sidebar_pos )
        {

            case 'left':
                $class[] = 'content-has-sidebar float-right  col-lg-8 col-md-12 '.$xl;
                break;

            case 'right':
                $class[] = 'content-has-sidebar float-left  col-lg-8 col-md-12 '.$xl;
                break;

            default:
                $class[] = 'content-full-width col-12';
                break;
        }

        $class = implode( ' ', array_filter( $class ) );

        if ( $class )
        {
            echo ' class="' . esc_html($class) . '"';
        }
    } else {
        echo ' class="content-area col-12"';
    }
}

/**
 * Set secondary content class based on sidebar position
 *
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function consultivo_secondary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && (is_product_category()) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    else :
        $sidebar_load = 'sidebar-blog';
    endif;

    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array(trim($extra_class));
        $xl = 'col-xl-4';
        if(class_exists('Woocommerce')) {
            if (is_shop() || is_singular(array('product'))) {
                $xl = 'col-xl-3';
            }
        }
        switch ($sidebar_pos) {
            case 'left':
                $class[] = 'widget-has-sidebar sidebar-fixed  col-lg-4 col-md-12 '.$xl;
                break;

            case 'right':
                $class[] = 'widget-has-sidebar sidebar-fixed  col-lg-4 col-md-12 '.$xl;
                break;

            default:
                break;
        }

        $class = implode(' ', array_filter($class));

        if ($class) {
            echo ' class="' . esc_html($class) . '"';
        }
    }
}


/**
 * Prints HTML for breadcrumbs.
 */
function consultivo_breadcrumb($icon = false)
{
    if ( ! class_exists( 'CMS_Breadcrumb' ) )
    {
        return;
    }

    $breadcrumb = new CMS_Breadcrumb();
    $entries = $breadcrumb->get_entries();

    if ( empty( $entries ) )
    {
        return;
    }

    ob_start();
    foreach ( $entries as $entry )
    {
        $entry = wp_parse_args( $entry, array(
            'label' => '',
            'url'   => ''
        ) );

        if ( empty( $entry['label'] ) )
        {
            continue;
        }

        echo '<li>';

        if ( ! empty( $entry['url'] ) )
        {
            printf(
                '<a class="breadcrumb-entry" href="%1$s">%2$s</a>',
                esc_url( $entry['url'] ),
                esc_attr( $entry['label'] )
            );
        }
        else
        {
            printf( '<span class="breadcrumb-entry" >%s</span>', esc_html( $entry['label'] ) );
        }

        echo '</li>';
    }

    $output = ob_get_clean();

    if ( $output )
    {
        printf( '<div class="bread-icon"><ul class="cms-breadcrumb">%1$s</ul></div>', wp_kses_post($output));
    }
}


function consultivo_entry_link_pages()
{
    wp_link_pages( array(
        'before' => sprintf( '<div class="page-links">', esc_html__( 'Pages:', 'consultivo' ) ),
        'after'  => '</div>',
    ) );
}


if ( ! function_exists( 'consultivo_entry_excerpt' ) ) :
    /**
     * Print post excerpt based on length.
     *
     * @param  integer $length
     */
    function consultivo_entry_excerpt( $length = 55 )
    {
        $cms_the_excerpt = get_the_excerpt();
        if(!empty($cms_the_excerpt)) {
            echo esc_html($cms_the_excerpt);
        } else {
            echo wp_kses_post(consultivo_get_the_excerpt( $length ));
        }
    }
endif;

/**
 * Prints post edit link when applicable
 */
function consultivo_entry_edit_link()
{
    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                esc_html__( 'Edit', 'consultivo' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<div class="entry-edit-link"><i class="fa fa-edit"></i>',
        '</div>'
    );
}


/**
 * Prints posts pagination based on query
 *
 * @param  WP_Query $query     Custom query, if left blank, this will use global query ( current query )
 * @return void
 */
function consultivo_posts_pagination( $query = null )
{
    $classes = array();

    if ( empty( $query ) )
    {
        $query = $GLOBALS['wp_query'];
    }

    if ( empty( $query->max_num_pages ) || ! is_numeric( $query->max_num_pages ) || $query->max_num_pages < 2 )
    {
        return;
    }

    $paged = get_query_var( 'paged' );

    if ( ! $paged && is_front_page() && ! is_home() )
    {
        $paged = get_query_var( 'page' );
    }

    $paged = $paged ? intval( $paged ) : 1;

    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) )
    {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $html_prev = wp_kses_post('<i class="fa fa-long-arrow-left"></i>');
    $html_next = wp_kses_post('<i class="fa fa-long-arrow-right"></i>');
    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'total'    => $query->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => $html_prev,
        'next_text' => $html_next,
    ) );

    $template = '
    <nav class="navigation posts-pagination">
        <div class="posts-page-links">%2$s</div>
    </nav>';

    if ( $links )
    {
        printf(
            wp_kses_post($template),
            esc_html__( 'Navigation', 'consultivo' ),
            wp_kses_post($links)
        );
    }
}

/**
 * Prints archive meta on blog
 */
if ( ! function_exists( 'consultivo_archive_meta_post' ) ) :
    function consultivo_archive_meta_post()
    {
        $archive_author_on = consultivo_get_opt('archive_author_on', false);
        $archive_date_on = consultivo_get_opt('archive_date_on', true);
        $archive_tags_on = consultivo_get_opt('archive_tags_on', false);
        $archive_category_on = consultivo_get_opt('archive_category_on', true);
        $archive_sticky_on = consultivo_get_opt('archive_sticky_on', false);
        $archive_comments_on = consultivo_get_opt('archive_comments_on', false);
        if (is_single()) {
            $archive_author_on = consultivo_get_opt('post_author_on', false);
            $archive_date_on = consultivo_get_opt('post_date_on', false);
            $archive_tags_on = consultivo_get_opt('post_tags_on', false);
            $archive_category_on = consultivo_get_opt('post_category_on', false);
            $archive_sticky_on = consultivo_get_opt('post_sticky_on', false);
            $archive_comments_on = consultivo_get_opt('post_comments_on', false);
        }?>
        <div class="post-meta clearfix">
            <ul class="entry-meta">
                <?php if($archive_category_on && get_the_category()){ ?>
                    <li class="cat">
                        <i class="fa fa-folder"></i>
                        <?php  the_category(', '); ?>
                    </li>
                <?php } ?>
                <?php if($archive_tags_on && get_the_tags()){ ?>
                    <li>
                        <i class="fa fa-tags"></i>
                        <?php  the_tags('',', ',''); ?>
                    </li>
                <?php } ?>
                 <?php if ($archive_date_on) { ?>
                     <li>
                         <i class="fa fa-calendar"></i>
                         <?php echo get_the_date('M d, Y'); ?>
                     </li>
                 <?php } ?>
                <?php if ($archive_comments_on) : ?>
                    <li>
                        <i class="fa fa-comment"></i>
                        <a href="<?php the_permalink(); ?>"><?php echo comments_number(esc_html__('No Comment', 'consultivo'), esc_html__('1 Comment', 'consultivo'), esc_html__('% Comments', 'consultivo')); ?></a>
                    </li>
                <?php endif; ?>
                <?php if ($archive_author_on) : ?>
                    <li>
                        <i class="fa fa-user"></i>
                        <span><?php echo esc_html__('By', 'consultivo'); ?></span>
                        <?php the_author_posts_link(); ?>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="data">
                <?php if(!is_single()){?>
                <h2 class="entry-title <?php if (is_sticky()) { ?>is-sticky<?php } ?>">
                    <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark">
                        <?php if (is_sticky()) { ?>
                            <i class="fa fa-thumb-tack"></i>
                        <?php } ?>
                        <?php the_title(); ?>
                    </a>
                </h2>
                <?php } ?>
            </div>
        </div><?php
    }
endif;


/**
 * List socials share for post.
 */
function consultivo_socials_share() { ?>
    <ul class="social-share">
        <li><a class="fb-social" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="zmdi zmdi-facebook"></i><span><?php echo esc_html__('Share', 'consultivo'); ?></span></a></li>
        <li><a class="tw-social" title="Twitter" target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="zmdi zmdi-twitter"></i><span><?php echo esc_html__('Twitter', 'consultivo'); ?></span></a></li>
        <li><a class="in-social" title="LinkedIn" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=&source="><i class="zmdi zmdi-linkedin"></i><span><?php echo esc_html__('Share', 'consultivo'); ?></span></a></li>
        <li><a class="pin-social" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(the_post_thumbnail_url( 'full' )); ?>&media=&description=<?php the_title(); ?>"><i class="zmdi zmdi-pinterest"></i><span><?php echo esc_html__('Pin', 'consultivo'); ?></span></a></li>
    </ul>
    <?php
}

/**
 * Footer Top
 */
function consultivo_footer_top() {
    $footer_top_column = consultivo_get_opt( 'footer_top_column',5 );
    $footer_layout = consultivo_get_opt( 'footer_layout' );

    if(empty($footer_top_column))
        return;

    $_class = "";

    switch ($footer_top_column){
        case '3':
            $_class = 'col-xl-6 col-lg-6 col-md-6 col-sm-6';
            break;
        case '4':
            $_class = 'col-xl-3 col-lg-3 col-md-6 col-sm-6';
            break;
        case '5':
            $_class = 'col-xl-2 col-lg-2 col-md-4 col-sm-4';
            break;
    }
    echo '<div class="cms-footer-item col-xl-3 col-lg-3 col-md-12 col-sm-12">';
    dynamic_sidebar( 'sidebar-footer-1' );
    echo "</div>";
    for($i = 2 ; $i <= $footer_top_column - 1 ; $i++){
        if ( is_active_sidebar( 'sidebar-footer-' . $i ) ){
            echo '<div class="cms-footer-item ' . esc_attr($_class) . '">';
                dynamic_sidebar( 'sidebar-footer-' . $i );
            echo "</div>";
        }
    }
    echo '<div class="cms-footer-item col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">';
    dynamic_sidebar( 'sidebar-footer-' . $footer_top_column );
    echo "</div>";
}

/**
 * Social Footer
 */
function consultivo_footer_social() {
    $footer_social = consultivo_get_opt( 'footer_social' );
    $social = $footer_social['enabled'];
    if ($social) : foreach ($social as $key=>$value) { ?>
        <?php switch($key) {

            case 'facebook': echo '<a href="'.esc_url(consultivo_get_opt( 'social_facebook_url' )).'"><span><i class="fa fa-facebook"></i></span></a>';
            break;

            case 'twitter': echo '<a href="'.esc_url(consultivo_get_opt( 'social_twitter_url' )).'"><span><i class="fa fa-twitter"></i></span></a>';
            break;

            case 'linkedin': echo '<a href="'.esc_url(consultivo_get_opt( 'social_inkedin_url' )).'"><span><i class="fa fa-linkedin"></i></span></a>';
            break;

            case 'instagram': echo '<a href="'.esc_url(consultivo_get_opt( 'social_instagram_url' )).'"><span><i class="fa fa-instagram"></i></span></a>';
            break;

            case 'google': echo '<a href="'.esc_url(consultivo_get_opt( 'social_google_url' )).'"><span><i class="fa fa-google-plus"></i></span></a>';
            break;

            case 'skype': echo '<a href="'.esc_url(consultivo_get_opt( 'social_skype_url' )).'"><span><i class="fa fa-location-arrow"></i></span></a></li>';
            break;

            case 'pinterest': echo '<a href="'.esc_url(consultivo_get_opt( 'social_pinterest_url' )).'"><span><i class="fa fa-pinterest"></i></span></a>';
            break;

            case 'vimeo': echo '<a href="'.esc_url(consultivo_get_opt( 'social_vimeo_url' )).'"><span><i class="fa fa-vimeo"></i></span></a>';
            break;

            case 'youtube': echo '<a href="'.esc_url(consultivo_get_opt( 'social_youtube_url' )).'"><span><i class="fa fa-youtube"></i></span></a>';
            break;

            case 'yelp': echo '<a href="'.esc_url(consultivo_get_opt( 'social_yelp_url' )).'"><span><i class="fa fa-yelp"></i></span></a>';
            break;

            case 'tumblr': echo '<a href="'.esc_url(consultivo_get_opt( 'social_tumblr_url' )).'"><span><i class="fa fa-tumblr"></i></span></a>';
            break;

            case 'tripadvisor': echo '<a href="'.esc_url(consultivo_get_opt( 'social_tripadvisor_url' )).'"><span><i class="fa fa-tripadvisor"></i></span></a>';

            break;

        }
    }
    endif;
}
function consultivo_top_bar_social_icon() {
    $top_bar_social = consultivo_get_opt( 'top_bar_social' );
    $social = $top_bar_social['enabled'];
    ?><ul class="top-bar-social"><?php
    if ($social) : foreach ($social as $key=>$value) { ?>
        <?php switch($key) {

            case 'facebook': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_facebook_url' )).'"><i class="zmdi zmdi-facebook"></i></a></li>';
            break;

            case 'twitter': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_twitter_url' )).'"><i class="zmdi zmdi-twitter"></i></a></li>';
            break;

            case 'linkedin': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_inkedin_url' )).'"><i class="zmdi zmdi-linkedin"></i></a></li>';
            break;

            case 'instagram': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_instagram_url' )).'"><i class="zmdi zmdi-instagram"></i></a></li>';
            break;

            case 'google': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_google_url' )).'"><i class="zmdi zmdi-google-plus"></i></a></li>';
            break;

            case 'skype': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_skype_url' )).'"><i class="zmdi zmdi-skype"></i></a></li>';
            break;

            case 'pinterest': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_pinterest_url' )).'"><i class="zmdi zmdi-pinterest"></i></a></li>';
            break;

            case 'vimeo': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_vimeo_url' )).'"><i class="zmdi zmdi-vimeo"></i></a></li>';
            break;

            case 'youtube': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_youtube_url' )).'"><i class="zmdi zmdi-youtube"></i></a></li>';
            break;

            case 'yelp': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_yelp_url' )).'"><i class="fa fa-yelp"></i></a></li>';
            break;

            case 'tumblr': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_tumblr_url' )).'"><i class="fa fa-tumblr"></i></a></li>';
            break;

            case 'tripadvisor': echo '<li><a href="'.esc_url(consultivo_get_opt( 'social_tripadvisor_url' )).'"><i class="fa fa-tripadvisor"></i></a></li>';
            break;

        }
    }
    endif;
    ?></ul><?php
}
function consultivo_top_bar_social_icon_box() {
    $footer_social = consultivo_get_opt( 'footer_social' );
    $social = $footer_social['enabled'];
    if ($social) : foreach ($social as $key=>$value) { ?>
        <?php switch($key) {

            case 'facebook': echo '<a href="'.esc_url(consultivo_get_opt( 'social_facebook_url' )).'"><i class="zmdi zmdi-facebook-box"></i></a>';
            break;

            case 'twitter': echo '<a href="'.esc_url(consultivo_get_opt( 'social_twitter_url' )).'"><i class="zmdi zmdi-twitter-box"></i></a>';
            break;

            case 'linkedin': echo '<a href="'.esc_url(consultivo_get_opt( 'social_inkedin_url' )).'"><i class="zmdi zmdi-linkedin-box"></i></a>';
            break;

            case 'instagram': echo '<a href="'.esc_url(consultivo_get_opt( 'social_instagram_url' )).'"><i class="zmdi zmdi-instagram"></i></a>';
            break;

            case 'google': echo '<a href="'.esc_url(consultivo_get_opt( 'social_google_url' )).'"><i class="zmdi zmdi-google-plus-box"></i></a>';
            break;

            case 'skype': echo '<a href="'.esc_url(consultivo_get_opt( 'social_skype_url' )).'"><i class="zmdi zmdi-skype-box"></i></a>';
            break;

            case 'pinterest': echo '<a href="'.esc_url(consultivo_get_opt( 'social_pinterest_url' )).'"><i class="zmdi zmdi-pinterest-box"></i></a>';
            break;

            case 'vimeo': echo '<a href="'.esc_url(consultivo_get_opt( 'social_vimeo_url' )).'"><i class="zmdi zmdi-vimeo-box"></i></a>';
            break;

            case 'youtube': echo '<a href="'.esc_url(consultivo_get_opt( 'social_youtube_url' )).'"><i class="zmdi zmdi-youtube-box"></i></a>';
            break;

            case 'yelp': echo '<a href="'.esc_url(consultivo_get_opt( 'social_yelp_url' )).'"><i class="fa fa-yelp-box"></i></a>';
            break;

            case 'tumblr': echo '<a href="'.esc_url(consultivo_get_opt( 'social_tumblr_url' )).'"><i class="fa fa-tumblr-box"></i></a>';
            break;

            case 'tripadvisor': echo '<a href="'.esc_url(consultivo_get_opt( 'social_tripadvisor_url' )).'"><i class="fa fa-tripadvisor-box"></i></a>';
            break;

        }
    }
    endif;
}
function consultivo_contact_form() {
    $h_btn_link_type = consultivo_get_opt('h_btn_link_type', 'page_link');
    $popup_contact_form = consultivo_get_opt('popup_contact_form');
    $title_contact_form = consultivo_get_opt('title_contact_form');
    $footer_contact_form = consultivo_get_opt('footer_contact_form');
    if(class_exists('WPCF7') && $h_btn_link_type == 'contact_form' && !empty($popup_contact_form)) { ?>
    <div class="cms-modal cms-modal-contact-form">
        <div class="cms-close"></div>
        <div class="cms-modal-inner">
            <div class="cms-contact-form placeholder-dark cms-contact-form-flat style-primary">
                <?php if(!empty($title_contact_form)) : ?><h3 class="el-title"><?php echo esc_html__('Request a Free Quotation', 'consultivo')?></h3><?php endif; ?>
                <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $popup_contact_form ).'"]'); ?>
            </div>
            <?php if(!empty($footer_contact_form)) : ?>
                <div class="cms-contact-form-footer">
                    <?php echo wp_kses_post($footer_contact_form); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php }
}

function consultivo_parallax_scroll() {
    $parallaxscroll = consultivo_get_opt( 'parallaxscroll', false );
    $parallaxscroll_speed = consultivo_get_opt( 'parallaxscroll_speed', '4' );
    $data_parallax = '';
    if($parallaxscroll == true) {
        $data_parallax = 'data-speed='.$parallaxscroll_speed.'';
        echo esc_html( $data_parallax );
    }
    return $data_parallax;
}
add_action( 'show_user_profile', 'consultivo_user_fields' );
add_action( 'edit_user_profile', 'consultivo_user_fields' );
function consultivo_user_fields($user){
    $user_facebook = get_user_meta($user->ID, 'user_facebook', true);
    $user_twitter = get_user_meta($user->ID, 'user_twitter', true);
    $user_vimeo = get_user_meta($user->ID, 'user_vimeo', true);
    $user_linkedin = get_user_meta($user->ID, 'user_linkedin', true);
    $user_rss = get_user_meta($user->ID, 'user_rss', true);
    ?>
    <h3><?php esc_html_e('Social & Position', 'consultivo'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_facebook"><?php esc_html_e('Facebook', 'consultivo'); ?></label></th>
            <td>
                <input id="user_facebook" name="user_facebook" type="text" value="<?php echo esc_attr(isset($user_facebook) ? $user_facebook : ''); ?>" />
                <p class="description"><?php echo esc_html__('Enter social link.', 'consultivo'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="user_twitter"><?php esc_html_e('Twitter', 'consultivo'); ?></label></th>
            <td>
                <input id="user_twitter" name="user_twitter" type="text" value="<?php echo esc_attr(isset($user_twitter) ? $user_twitter : ''); ?>" />
                <p class="description"><?php echo esc_html__('Enter social link.', 'consultivo'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="user_vimeo"><?php esc_html_e('Vimeo', 'consultivo'); ?></label></th>
            <td>
                <input id="user_vimeo" name="user_vimeo" type="text" value="<?php echo esc_attr(isset($user_vimeo) ? $user_vimeo : ''); ?>" />
                <p class="description"><?php echo esc_html__('Enter social link.', 'consultivo'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="user_linkedin"><?php esc_html_e('Linkedin', 'consultivo'); ?></label></th>
            <td>
                <input id="user_linkedin" name="user_linkedin" type="text" value="<?php echo esc_attr(isset($user_linkedin) ? $user_linkedin : ''); ?>" />
                <p class="description"><?php echo esc_html__('Enter social link.', 'consultivo'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="user_rss"><?php esc_html_e('Rss', 'consultivo'); ?></label></th>
            <td>
                <input id="user_rss" name="user_rss" type="text" value="<?php echo esc_attr(isset($user_rss) ? $user_rss : ''); ?>" />
                <p class="description"><?php echo esc_html__('Enter social link.', 'consultivo'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}
add_action( 'personal_options_update', 'consultivo_save_user_custom_fields' );
add_action( 'edit_user_profile_update', 'consultivo_save_user_custom_fields' );
function consultivo_save_user_custom_fields( $user_id )
{
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    if(isset($_POST['user_facebook']))
        update_user_meta( $user_id, 'user_facebook', $_POST['user_facebook'] );
    if(isset($_POST['user_twitter']))
        update_user_meta( $user_id, 'user_twitter', $_POST['user_twitter'] );
    if(isset($_POST['user_vimeo']))
        update_user_meta( $user_id, 'user_vimeo', $_POST['user_vimeo'] );
    if(isset($_POST['user_linkedin']))
        update_user_meta( $user_id, 'user_linkedin', $_POST['user_linkedin'] );
    if(isset($_POST['user_rss']))
        update_user_meta( $user_id, 'user_rss', $_POST['user_rss'] );


}
/* Social User */
function consultivo_get_user_social() {
    $user_facebook = get_user_meta(get_the_author_meta( 'ID' ), 'user_facebook', true);
    $user_twitter = get_user_meta(get_the_author_meta( 'ID' ), 'user_twitter', true);
    $user_vimeo = get_user_meta(get_the_author_meta( 'ID' ), 'user_vimeo', true);
    $user_linkedin = get_user_meta(get_the_author_meta( 'ID' ), 'user_linkedin', true);
    $user_rss = get_user_meta(get_the_author_meta( 'ID' ), 'user_rss', true);

    ?>
    <ul class="user-social">
        <?php if(!empty($user_facebook)) { ?>
            <li><a href="<?php echo esc_url($user_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_twitter)) { ?>
            <li><a href="<?php echo esc_url($user_twitter); ?>"><i class="fa fa-twitter"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_vimeo)) { ?>
            <li><a href="<?php echo esc_url($user_vimeo); ?>"><i class="fa fa-vimeo"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_linkedin)) { ?>
            <li><a href="<?php echo esc_url($user_linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_rss)) { ?>
            <li><a href="<?php echo esc_url($user_rss); ?>"><i class="fa fa-rss"></i></a></li>
        <?php } ?>
    </ul> <?php
}
function consultivo_action_menu(){
    $h_btn_text = consultivo_get_opt( 'h_btn_text' );
    $h_btn_custom_link = consultivo_get_opt( 'h_btn_page_link' );
    $show_custom_button = consultivo_get_opt('show_custom_button',false);
    $show_search_button = consultivo_get_opt('show_search_button',false);
    $show_cart_button = consultivo_get_opt('show_cart_button',false);

    if(is_page()){
        $show_custom_button = consultivo_get_page_opt('show_custom_button',false);
        if($show_custom_button) {
            $h_btn_text = consultivo_get_page_opt('h_btn_text');
            $new_h_btn_custom_link = consultivo_get_page_opt('h_btn_page_link');
            if ($new_h_btn_custom_link != '') {
                $h_btn_custom_link = $new_h_btn_custom_link;
            }
        }
    }
    ?>
<ul class="action-menu primary-menu">
    <?php if($show_custom_button){?>
    <li class="button-link"><a href="<?php echo esc_url(get_permalink($h_btn_custom_link)); ?>"><?php echo esc_html($h_btn_text); ?></a></li>
    <?php } ?>
    <?php if($show_search_button){?>
    <li class="search-desktop"><a href="#" class="open-search"><i class="fa fa-search"></i></a></li>
    <?php } ?>
    <?php if($show_cart_button){?>
        <?php if(class_exists('Woocommerce')){?>
            <li class="cart-desktop">
                <a href="#" class="open-cart">
                    <span class="cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="17" height="16.094" viewBox="0 0 17 16.094">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #333;
                                    fill-rule: evenodd;
                                }
                            </style>
                        </defs>
                        <path d="M3.579,-0.006 L-0.012,-0.006 L-0.012,1.994 L2.262,1.994 L3.203,5.318 L5.165,11.994 L15.271,11.994 L17.000,2.996 L4.000,2.996 L3.579,-0.006 ZM14.039,9.994 L6.363,9.994 L4.990,4.995 L14.995,4.995 L14.039,9.994 ZM12.994,12.994 C11.890,12.994 10.993,13.891 10.993,14.994 C10.993,16.095 11.896,15.997 13.000,15.997 C14.103,15.997 14.995,16.095 14.995,14.994 C14.995,13.891 14.097,12.994 12.994,12.994 ZM6.991,12.994 C5.887,12.994 4.990,13.891 4.990,14.994 C4.990,16.095 5.896,15.997 7.000,15.997 C8.103,15.997 8.992,16.095 8.992,14.994 C8.992,13.891 8.094,12.994 6.991,12.994 Z" class="cls-1"/>
                    </svg>
                </a>
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </li>
        <?php } ?>
    <?php } ?>
</ul><?php
}