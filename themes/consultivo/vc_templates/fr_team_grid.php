<?php
extract(shortcode_atts(array(
    'teams' => '',
    'col_lg'               => 4,
    'col_md'               => 3,
    'col_sm'               => 2,
    'col_xs'               => 1,
    'img_size'             => 'large',
    'animation'             => '',
    'el_class'             => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
$html_id = cmsHtmlID('fr-team-grid');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('consultivo-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
extract(consultivo_get_param_carousel($atts));
$teams = (array) vc_param_group_parse_atts($teams);
$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;
?>
<div id="<?php echo esc_attr($html_id) ?>" class="fr-team-grid  animation-time <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <div class="row">
        <?php if (!empty($teams)):?>
            <?php foreach ($teams as $key => $value) {
                $image = isset($value['image']) ? $value['image'] : '';
                $title = isset($value['title']) ? $value['title'] : '';
                $occupation = isset($value['occupation']) ? $value['occupation'] : '';
                $fb = isset($value['facebook']) ? $value['facebook'] : '';
                $tw = isset($value['twitter']) ? $value['twitter'] : '';
                $item_class = "col-xl-{$col_lg} col-lg-{$col_md} col-md-{$col_sm} col-sm-{$col_xs} col-{$col_xs}";
                ?>
                <div class="fr-team-item animation-time <?php echo esc_attr( $animation_classes .' ' .$item_class ); ?> ">
                    <div class="fr-team-item-inner">
                        <div class="fr-member-image"><?php
                         $default_size = 'full';
                         $default_size = 'full';
                         $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                         $image_title = get_the_title($image);
                         if ( empty( $image_alt )) {$image_alt = $image_title;}
                         $image_url = wp_get_attachment_image_src($image, $default_size);?>
                         <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>">
                            <div class="overlay-info">
                                <ul>
                                    <li><a href="<?php echo esc_url($fb);?>"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="<?php echo esc_url($tw);?>"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="fr-team-content">
                            <h3 class="member-name"><?php echo esc_html($title);?></h3>
                            <p class="member-occupation"><?php echo esc_html($occupation);?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php endif; ?>
    </div>
</div>