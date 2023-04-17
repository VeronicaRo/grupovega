<?php
extract( shortcode_atts( array(
    'title'      => 'Download <br/> Our Brochures',
    'file'      => '',
    'animation' => '',
    'el_class'  => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts ) );
$html_id   = cmsHtmlID( 'cms-file' );
$image_url = '';
if ( ! empty( $atts['video_bg_image'] ) ) {
    $attachment_image = wp_get_attachment_image_src( $atts['video_bg_image'], 'full' );
    $image_url        = $attachment_image[0];
}
$animation_tmp     = isset( $animation ) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('multicon-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
?>
<div id="<?php echo esc_attr( $html_id ); ?>"
     class="cms-file-download layout1 <?php echo esc_attr( $el_parallax_class.' '.$el_class . ' ' . $animation_classes ); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <div class="cms-file-inner">
        <?php
        if ( ! empty( $file ) ):
            $file_size = filesize( get_attached_file( $file ) );
            $file_size_layout = '';
            if ( $file_size >= 0 && $file_size < 1024 ) {
                $file_size_layout = $file_size . 'B';
            }
            if ( $file_size >= 1024 && $file_size < 1048576 ) {
                $file_size_layout = number_format( $file_size / 1024, 2 ) . 'KB';
            }

            if ( $file_size >= 1073741824 ) {
                $file_size_layout = number_format( $file_size / 1024, 2 ) . 'MB';
            }
            ?>
            <a href="<?php echo esc_url( wp_get_attachment_url( $file ) ); ?>" target="_blank"><?php echo wp_kses_post($title); ?></a>
            <img src="<?php echo get_template_directory_uri() . '/assets/images/pdf.png'; ?>" alt="<?php echo esc_attr('Download File');?>">
        <?php endif; ?>
    </div>
</div>