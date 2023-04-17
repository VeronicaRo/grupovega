<?php

/* Remove result count & product ordering & item product category..... */
function consultivo_cwoocommerce_remove_function()
{
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 0);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 0);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10, 0);
    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10, 0);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10, 0);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10, 0);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

    /*Single product*/
    //woocommerce_template_single_add_to_cart
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 0);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 0);
    //woocommerce_output_product_data_tabs
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10, 0);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20, 0);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30, 0);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50, 0);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 0);
}

add_action('init', 'consultivo_cwoocommerce_remove_function');


/* Product Category */
add_filter('woocommerce_after_shop_loop_item', 'cryptech_woocommerce_product');
function cryptech_woocommerce_product()
{
    ?>
    <div class="woocommerce-product-inner">
        <div class="woocommerce-product-header">
            <?php
            $icon = get_post_thumbnail_id(get_the_ID());
            $default_size = 'full';
            $image_alt = get_post_meta($icon, '_wp_attachment_image_alt', true);
            $image_title = get_the_title($icon);
            if (empty($image_alt)) {
                $image_alt = $image_title;
            }
            $image_url = wp_get_attachment_image_src($icon, $default_size); ?>
            <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php woocommerce_show_product_loop_sale_flash(); ?>
            <div class="woocomerce-overlay-add-cart">
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
        </div>
        <div class="woocommerce-product-holder">
            <h3 class="woocommerce-product-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="woocommerce-product-meta clearfix">
                <?php woocommerce_template_loop_price(); ?>
                <?php woocommerce_template_loop_rating(); ?>
            </div>
        </div>
    </div>
<?php }

/*woocommerce_template_single_add_to_cart
woocommerce_template_single_meta*/
add_filter('woocommerce_single_product_summary', 'woocommerce_single_price_ratings', 11);
function woocommerce_single_price_ratings()
{
    ?>
    <div class="single-price-rating">
        <?php
        woocommerce_template_single_price();
        woocommerce_single_rating()
        ?>
    </div>
<?php }

add_action('woocommerce_share', function () {
    $show_social_share = consultivo_get_opt('show_social_share', false);
    if ($show_social_share) {
        ?>
        <div class="share-product">
            <h3>Share Products:</h3>
            <ul class="social-share">
                <li><a class="fb-social" title="Facebook" target="_blank"
                       href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i
                                class="zmdi zmdi-facebook"></i><span><?php echo esc_html__('Share', 'consultivo'); ?></span></a>
                </li>
                <li><a class="tw-social" title="Twitter" target="_blank"
                       href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i
                                class="zmdi zmdi-twitter"></i><span><?php echo esc_html__('Twitter', 'consultivo'); ?></span></a>
                </li>
                <li><a class="in-social" title="LinkedIn" target="_blank"
                       href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=&source="><i
                                class="zmdi zmdi-linkedin"></i><span><?php echo esc_html__('Share', 'consultivo'); ?></span></a>
                </li>
                <li><a class="pin-social" title="Pinterest" target="_blank"
                       href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(the_post_thumbnail_url('full')); ?>&media=&description=<?php the_title(); ?>"><i
                                class="zmdi zmdi-pinterest"></i><span><?php echo esc_html__('Pin', 'consultivo'); ?></span></a>
                </li>
            </ul>
        </div>
        <?php
    }
});
add_action('woocommerce_product_meta_end', 'show_availabiltity');
function show_availabiltity($product)
{
    echo '<span class="stock_wrapper">Availability: <span class="stock">' . get_post_meta(get_the_ID(), '_stock_status')[0] . '</span></span>';
}

add_action('woocommerce_after_single_product_summary', function () {
    $next_post_id = get_the_ID();
    $prev_post_id = get_the_ID();

    if (get_next_post()) {
        $next_post = get_next_post();
        $next_post_id = $next_post->ID;
    }

    if (get_previous_post()) {
        $prev_post = get_previous_post();
        $prev_post_id = $prev_post->ID;
    }

    woocommerce_template_single_sharing();
    woocommerce_output_product_data_tabs();
    ?>
    <ul class="single-nav-product">
        <li><a href="<?php echo get_permalink($prev_post_id); ?>"><i class="fa fa-long-arrow-left"></i></a></li>
        <li><a href="<?php echo get_permalink($next_post_id); ?>"><i class="fa fa-long-arrow-right"></i></a></li>
    </ul>
    <?php

});
add_action('woocommerce_single_product_summary', 'woocommerce_single_meta_add_cart', 31);
function woocommerce_single_meta_add_cart()
{
    echo '<h4>Other Detail:</h4>';
    woocommerce_template_single_meta();
    echo '<div class="single-product-action">';
    woocommerce_template_single_add_to_cart();
    echo '<div class="yith">';

}


/* Function that displays output for the Tab Specification. */
function consultivo_custom_tab_content_specification($slug, $tab)
{
    $product_specification = consultivo_get_page_opt('product_specification');
    $result = count($product_specification); ?>
    <div class="tab-content-wrap">
        <?php if (!empty($product_specification)) : ?>
            <div class="tab-product-feature-list">
                <?php for ($i = 0; $i < $result; $i += 2) { ?>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <?php echo isset($product_specification[$i]) ? esc_html($product_specification[$i]) : ''; ?>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-12">
                            <?php echo isset($product_specification[$i + 1]) ? esc_html($product_specification[$i + 1]) : ''; ?>
                        </div>
                    </div>
                    <div class="line-gap"></div>
                <?php } ?>
            </div>
        <?php endif; ?>
    </div>
<?php }

/* Removes the "shop" title on the main shop page */
function consultivo_hide_page_title()
{
    return false;
}

add_filter('woocommerce_show_page_title', 'consultivo_hide_page_title');

add_action('woocommerce_before_add_to_cart_quantity', 'quantity_title');
function quantity_title()
{
    echo '<span>Quantity:</span> <i class="zmdi zmdi-minus"></i>';
}

add_action('woocommerce_after_add_to_cart_quantity', 'cart_change_quantity');
function cart_change_quantity()
{
    echo '<i class="zmdi zmdi-plus"></i>';
}

add_filter('woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1);

function iconic_cart_count_fragments($fragments)
{

    $fragments['span.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';

    return $fragments;

}

function woocommerce_single_rating()
{
    global $product;

    if ('no' === get_option('woocommerce_enable_review_rating')) {
        return;
    }

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average = $product->get_average_rating();

    if ($rating_count > 0) : ?>

        <div class="woocommerce-product-rating">
            <?php echo wc_get_rating_html($average, $rating_count); ?>
            <?php if (comments_open()) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">
                (<?php printf(_n('%s Review  /  Add Review', '%s Review(s)  /  Add Review', $review_count, 'consultivo'), '<span class="count">' . esc_html($review_count) . '</span>'); ?>
                )</a><?php endif ?>
        </div>

    <?php endif;
}

add_action('woocommerce_widget_product_item_end', function () {
    global $product; ?>
    <div class="my-custom clear-all">
        <a href="<?php echo esc_url($product->get_permalink()); ?>">
            <?php echo wp_kses_post($product->get_image()); ?>
        </a>
        <div class="widget-item-meta">
            <span class="product-title"><a
                        href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_attr($product->get_name()); ?></a></span>
            <?php echo wp_kses_post($product->get_price_html()); ?>
        </div>
    </div>
    <?php
}, 1);