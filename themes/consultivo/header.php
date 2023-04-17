<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package consultivo
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-HDN0D5HNMM"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-HDN0D5HNMM');
	</script>
	<meta name="google-site-verification" content="n0m78Gm7jVd7knEz_PfsDER7eSAY0tXSoSD8SrrNQ6M" />
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <?php consultivo_page_loading(); ?>
        <?php consultivo_header_layout(); ?>
        <?php if(!is_404()):?>
            <?php consultivo_page_title_layout(); ?>
        <?php endif;?>
        <div class="header-search search-popup">
            <div class="overlay"></div>
            <div class="container">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div id="content" class="site-content">
        	    <div class="content-inner" <?php consultivo_parallax_scroll(); ?>>
