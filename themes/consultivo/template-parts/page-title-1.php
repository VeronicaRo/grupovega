<?php

$titles = consultivo_get_page_titles();

ob_start();

if ( $titles['title'] )
{
    printf( '<h1 class="page-title ft-heading-b">%s</h1>', wp_kses_post($titles['title']) );
}

if ( ( is_page() && get_post_meta( get_the_ID(), 'breadcrumb_on', true ) ) || consultivo_get_opt( 'breadcrumb_on', false ) )
{
    consultivo_breadcrumb();
}
$titles_html = ob_get_clean();
$bg = '';
if(empty($bg)){
    $bg = get_template_directory_uri() . '/assets/images/ptitle-bg.jpg';
}
if(class_exists('Woocommerce')) {
    if (is_shop() || is_singular('product') ) {
        $shop_id = get_option('woocommerce_shop_page_id', '');
        if(isset(consultivo_get_opt('product_page_title_bg', true)['background-image'])) {
            $bg = consultivo_get_opt('product_page_title_bg', true)['background-image'];
        }
    }
}
if(is_singular('post')){
    $bg = get_the_post_thumbnail_url(get_the_ID(),'full');
}
if(is_singular(['portfolio','services'])){
    if(consultivo_get_page_opt('custom_pagetitle',false)){
        $p_bg = consultivo_get_page_opt('page_ptitle_bg',true)['background-image'];
        if($p_bg){
            $bg = $p_bg;
        }
    }
}
?>
    <?php if(class_exists('Woocommerce')){?>
        <div id="pagetitle" <?php if(is_single() || is_shop()){?>style="background-image:url('<?php echo esc_attr($bg); ?>')"<?php } ?> class="page-title page-title-layout1 bg-overlay">
    <?php }else{ ?>
        <div id="pagetitle" <?php if(is_single()){?>style="background-image:url('<?php echo esc_attr($bg); ?>')"<?php } ?> class="page-title page-title-layout1 bg-overlay">
    <?php } ?>
    <div class="container">
        <div class="page-title-inner">
            <div class="page-title-content clearfix">
                <?php printf( '%s', wp_kses_post($titles_html)); ?>
            </div>
        </div>
    </div>
</div>