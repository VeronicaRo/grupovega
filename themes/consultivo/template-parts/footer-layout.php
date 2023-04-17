<?php
$footer_top_custom_width = consultivo_get_opt( 'footer_top_custom_width' );
$footer_copyright = consultivo_get_opt( 'footer_copyright' );
$footer_cta_title = consultivo_get_opt( 'footer_cta_title' );
$footer_cta_email = consultivo_get_opt( 'footer_cta_email' );
$footer_cta_phone = consultivo_get_opt( 'footer_cta_phone' );
?>
<footer id="colophon" class="site-footer footer-layout1 ft-main-r">
    <?php if ( is_active_sidebar( 'sidebar-footer-1' ) || is_active_sidebar( 'sidebar-footer-2' ) || is_active_sidebar( 'sidebar-footer-3' ) || is_active_sidebar( 'sidebar-footer-4' ) ) : ?>
        <div class="top-footer bg-overlay <?php echo esc_attr( $footer_top_custom_width ); ?>">
            <div class="container">
                <div class="row">
                    <?php consultivo_footer_top(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <?php
                    if ($footer_copyright) {
                        echo wp_kses_post('<p>'.$footer_copyright.'</p>');
                    } else {
                        echo wp_kses_post('<p> &copy; '.esc_attr(date("Y")).' With Love By <a target="_blank" href="https://cmssuperheroes.com/" style="margin-left: 5px;">cmssuperheroes.com</a><p>');
                    } ?>
                </div>
            </div>
        </div>
    </div>
</footer>