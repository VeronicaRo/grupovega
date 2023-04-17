<?php
/**
 * Template part for displaying default header layout
 */
$sticky_on = consultivo_get_opt( 'sticky_on', false );
$h_btn_text = consultivo_get_opt( 'h_btn_text' );
$h_btn_page_link = consultivo_get_opt( 'h_btn_page_link' );
$page_url = get_the_permalink($h_btn_page_link);


$top_bar_phone = consultivo_get_opt( 'top_bar_phone' );
$top_bar_email = consultivo_get_opt( 'top_bar_email' );
$top_bar_address = consultivo_get_opt( 'top_bar_address' );

$show_custom_button = consultivo_get_opt('show_custom_button',false);
$show_search_button = consultivo_get_opt('show_search_button',false);
$show_cart_button = consultivo_get_opt('show_cart_button',false);
if(is_page()){
    $sticky_on = consultivo_get_page_opt( 'sticky_on', false );
    $show_custom_button = consultivo_get_page_opt('show_custom_button',true);
    if($show_custom_button){
        $h_btn_text = consultivo_get_page_opt( 'h_btn_text' );
        $h_btn_page_link = consultivo_get_page_opt( 'h_btn_page_link' );
    }
    $show_search_button = consultivo_get_page_opt('show_search_button',true);
    $show_cart_button = consultivo_get_page_opt('show_cart_button',true);
}

?>
<header id="masthead" class="site-header">
    <div id="site-header-wrap" class="header-layout1 header-layout3 header-layout9 <?php if($sticky_on == 1) { echo 'is-sticky'; } ?>">
        <div class="clearfix">
            <div class="site-header-top">
                <div class="container">
                    <div class="branding col-text-left">
                        <?php get_template_part( 'template-parts/header-branding' ); ?>
                    </div>
                    <div class="col-text-right">
                        <ul>
                            <li><i class="icon-map-pin"></i> <span>Visit Us:<br/><?php echo esc_html($top_bar_address);?></span></li>
                            <li><i class="icon-document"></i> <span>Email Us:<br/><?php echo esc_html($top_bar_email);?></span></li>
                            <li><i class="icon-phone"></i> <span>Call Us:<br/><?php echo esc_html($top_bar_phone);?></span></li>
                            <li>
                                <?php consultivo_top_bar_social_icon(); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="headroom" class="site-header-main">
                <div class="container">
                    <div class="content-menu">
                        <div class="col-text-left">
                            <div class="branding">
                                <?php get_template_part( 'template-parts/header-branding' ); ?>
                            </div>
                            <nav id="site-navigation" class="main-navigation">
                                <?php get_template_part( 'template-parts/header-menu' ); ?>
                            </nav>
                        </div>
                        <div class="col-text-right">
                        <ul class="action-menu primary-menu">
                        <?php if($show_search_button){?>
                            <li class="search-desktop"><a href="#" class="open-search"><i class="fa fa-search"></i></a></li>
                        <?php } ?>
                        <?php if($show_cart_button){?>
                            <li class="cart-desktop">
                                <?php if(class_exists('Woocommerce')){?>
                                <a href="<?php echo esc_url( home_url( '/cart' ) );?>" class="open-cart">
                                    <?php if(class_exists('Woocommerce')){?>
                                        <span class="cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
                                    <?php } ?>
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
                                <?php } ?>
                                <?php if(class_exists('Woocommerce')){?>
                                    <div class="widget_shopping_cart_content">
                                        <?php woocommerce_mini_cart(); ?>
                                    </div>
                                <?php } ?>
                            </li>
                        <?php } ?>
                        <?php if($show_custom_button){?>
                            <li class="button-link"><a href="<?php echo esc_url($page_url); ?>"><?php echo esc_html($h_btn_text); ?></a></li>
                        <?php } ?>
                        </ul>
                            <div class="action-mobile">
                                <a href="#" class="open-search search-mobile"><i class="fa fa-search"></i></a>
                                <a href="#" class="open-cart cart-mobile">
                                    <?php if(class_exists('Woocommerce')){?>
                                        <span class="cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
                                    <?php } ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="17" height="16.094" viewBox="0 0 17 16.094">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill-rule: evenodd;
                                                }
                                            </style>
                                        </defs>
                                        <path d="M3.579,-0.006 L-0.012,-0.006 L-0.012,1.994 L2.262,1.994 L3.203,5.318 L5.165,11.994 L15.271,11.994 L17.000,2.996 L4.000,2.996 L3.579,-0.006 ZM14.039,9.994 L6.363,9.994 L4.990,4.995 L14.995,4.995 L14.039,9.994 ZM12.994,12.994 C11.890,12.994 10.993,13.891 10.993,14.994 C10.993,16.095 11.896,15.997 13.000,15.997 C14.103,15.997 14.995,16.095 14.995,14.994 C14.995,13.891 14.097,12.994 12.994,12.994 ZM6.991,12.994 C5.887,12.994 4.990,13.891 4.990,14.994 C4.990,16.095 5.896,15.997 7.000,15.997 C8.103,15.997 8.992,16.095 8.992,14.994 C8.992,13.891 8.094,12.994 6.991,12.994 Z" class="cls-1"/>
                                    </svg>
                                </a>
                                <span class="btn-nav-mobile open-menu"><span></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>