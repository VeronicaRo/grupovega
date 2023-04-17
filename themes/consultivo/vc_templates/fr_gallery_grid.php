<?php
extract(shortcode_atts(array(
    'group_images' => '',
    'el_class' => '',
    'animation' => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
$html_id = cmsHtmlID('fr-gallery-grid');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
extract(consultivo_get_param_carousel($atts));
$group_images = (array) vc_param_group_parse_atts($group_images);
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
wp_enqueue_script('isotope');
wp_enqueue_script('imagesloaded');
wp_enqueue_script('consultivo-isotope', get_template_directory_uri() . '/assets/js/isotope.cms.js', array('jquery'), '1.0.0', true);
if(!empty($group_images)) : ?>
    <div id="<?php echo esc_attr($html_id);?>" class="fr-gallery-grid default images-light-box <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo esc_attr($parallax_speed); ?>>
        <ul class="nav-gallery-filter filter-bar">
            <li class="filter-item active" data-filter="*">All</li>
            <?php foreach ($group_images as $key => $group):
                $handle_title  = str_replace(' ','-',strtolower($group['title'])); ?>
                <li class="filter-item" data-filter=".<?php echo esc_attr($handle_title); ?>"><?php echo esc_attr($group['title'])?></li>
            <?php endforeach;?>
        </ul>
        <div class="row gallery-filter isotope-grid">
            <?php $sizes = explode(',',$img_size);
            $default_size = end($sizes);
            foreach ($group_images as $key => $group):
                $images = explode(',',$group['images']);
                $handle_title  = str_replace(' ','-',strtolower($group['title']));
                if(!empty($images)) {
                    foreach ($images as $key => $img_id) {
                        $img = wpb_getImageBySize(array(
                            'attach_id' => $img_id,
                            'thumb_size' => $default_size,
                            'class' => '',
                        ));
                        $thumbnail = $img['thumbnail']; ?>
                        <div class="grid-item col-sm-12 col-md-6 col-lg-4 col-xl-4 <?php echo esc_attr($handle_title); ?>">
                            <a class="light-box" href="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'full')); ?>">
                                <div class="overlay-item">
                                    <i class="zmdi zmdi-plus"></i>
                                </div>
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        </div>
                        <?php
                    }
                }
            endforeach; ?>
        </div>
    </div>
<?php endif;?>

