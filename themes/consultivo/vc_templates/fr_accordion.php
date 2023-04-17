<?php
extract(shortcode_atts(array(
    'fr_accordion' => '',
    'active_section' => '1',
    'title_color' => '',
    'content_color' => '',
    'el_class' => '',
    'animation' => '',
), $atts));
$accordion = array();
$accordion = (array) vc_param_group_parse_atts($fr_accordion);
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$html_id = cmsHtmlID('fr-accordion');
if(!empty($accordion)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="fr-accordion layout1 <?php echo esc_attr($el_class.' '.$animation_classes); ?>">
        <?php foreach ($accordion as $key => $value) {
            $ac_title = isset($value['ac_title']) ? $value['ac_title'] : '';
            $ac_content = isset($value['ac_content']) ? $value['ac_content'] : '';
            ?>
            <div class="card">
                <div class="card-header" id="heading-<?php echo esc_attr($key); ?>">
                    <a data-toggle="collapse" style="<?php if(!empty($title_color)){?>color: <?php echo esc_attr($title_color);?><?php } ?>" data-target="#collapse-<?php echo esc_attr($key); ?>" aria-expanded="<?php if($key == ($active_section - 1)) { echo 'true'; } else { echo 'false'; } ?>" aria-controls="collapse-<?php echo esc_attr($key); ?>">
                        <?php echo esc_attr($ac_title); ?>
                        <i class="zmdi zmdi-plus"></i>
                    </a>
                </div>
                <div id="collapse-<?php echo esc_attr($key); ?>" class="collapse  <?php if($key == ($active_section - 1)) { echo 'show'; } ?>" aria-labelledby="heading-<?php echo esc_attr($key); ?>" data-parent="#<?php echo esc_attr($html_id); ?>">
                    <div class="card-body" style="color: <?php echo esc_attr($content_color);?>">
                        <?php echo wp_kses_post($ac_content); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>