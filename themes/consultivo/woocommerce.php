<?php
/**
 * Custom Woocommerce shop page.
 */
get_header();
if( (class_exists( 'WooCommerce' ) && is_shop()) || (class_exists( 'WooCommerce' ) && is_product_category()) ) {
    $sidebar_pos = consultivo_get_opt('sidebar_shop', 'right');
} elseif(is_singular('product')) {
    $sidebar_pos = consultivo_get_opt('sidebar_product', 'right');
} else {
    $sidebar_pos = 'none';
}
$has_sidebar = true;
if(class_exists( 'WooCommerce' )) {
    if(is_shop()) {
        if (isset($_REQUEST['shop_layout']) && $_REQUEST['shop_layout'] == 'no-sidebar') {
            $has_sidebar = false;
        }
    }
}
?>
    <div class="container content-container">
        <div class="row content-row">
            <div id="primary" <?php if($has_sidebar && (is_active_sidebar( 'sidebar-shop' )  && is_shop() && ('left' == $sidebar_pos || 'right' == $sidebar_pos) ) ||  (is_active_sidebar( 'sidebar-product' )  && is_singular('product') && ( 'right' == $sidebar_pos || 'left' == $sidebar_pos))){ consultivo_primary_class( $sidebar_pos, 'content-area' ); }else{echo 'class="content-no-sidebar"';}?>>

                <main id="main" class="site-main" role="main">
                    <?php woocommerce_content(); ?>
                </main><!-- #main -->
            </div><!-- #primary -->
            <?php if ($has_sidebar &&  (is_active_sidebar( 'sidebar-shop' )  && is_shop() && ('left' == $sidebar_pos || 'right' == $sidebar_pos) ) ||  (is_active_sidebar( 'sidebar-product' )  && is_singular('product') && ( 'right' == $sidebar_pos || 'left' == $sidebar_pos)) ){ ?>
                <aside id="secondary"<?php consultivo_secondary_class( $sidebar_pos, 'widget-area' ); ?>>
                    <?php
                    if(is_singular('product')){
                        dynamic_sidebar( 'sidebar-product' );
                    }else{
                        dynamic_sidebar( 'sidebar-shop' );
                    }
                    ?>
                </aside>
            <?php } ?>
        </div>
    </div>
<?php
get_footer();