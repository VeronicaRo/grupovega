<?php
/**
 * New VC Param type
 * cms_datetime
 * cms_video
 * cms_file_picker
 */
add_action('init', 'cms_add_vc_customs_params');
function cms_add_vc_customs_params()
{
    //date time
    vc_add_shortcode_param('cms_datetime', 'cms_datetime_settings_field', cmssuperheroes()->path('APP_URL').'/includes/types/assets/jquery.datetimepicker.js');
    add_action('admin_enqueue_scripts', 'cms_enqueue_admin_scripts');
    //video
    vc_add_shortcode_param('cms_video', 'cms_attach_images_form_field');
    vc_add_shortcode_param( 'cms_file_picker', 'cms_file_picker_settings_field', cmssuperheroes()->path('APP_URL').'/includes/types/assets/file_picker.js');

}

//date time field
function cms_datetime_settings_field($settings, $value)
{
    return '<div class="date-field cms_datetime_block" data-type="datetime" data-format="m/d/Y H:i">'
        . '<input type="text" name="' . esc_attr($settings['param_name']) . '" class="wpb_vc_param_value wpb-textinput" value="' . esc_attr($value) . '"/>'
        . '</div>';
}

function cms_enqueue_admin_scripts()
{
    //datetime
    wp_register_style('jquery-datetimepicker', cmssuperheroes()->path('APP_URL').'/includes/types/assets/jquery.datetimepicker.css');
    wp_enqueue_style('jquery-datetimepicker');
    wp_enqueue_script('date-time-element', cmssuperheroes()->path('APP_URL').'/includes/types/assets/datetime-element.js');
    //base
    wp_register_style('cms-admin-style', cmssuperheroes()->path('APP_URL').'/includes/types/assets/cms_admin.css');
    wp_enqueue_style('cms-admin-style');
    wp_enqueue_script('cms-wpb-video-element',cmssuperheroes()->path('APP_URL').'/includes/types/assets/wpb_media_attach.js');
}

//add video field
function cms_attach_images_form_field($settings, $value)
{
    ob_start();
    $param_value = cms_remove_not_match_media_attach_ids(explode(',',$value),array('audio','video'));
    ?><input type="hidden"
             class="wpb_vc_param_value gallery_widget_attached_images_ids <?php echo esc_attr($settings['param_name'] . ' ' . $settings['type']) ?>"
             name="<?php echo esc_attr($settings['param_name']) ?>" value="<?php echo $value ?>"/>
    <div class="gallery_widget_attached_images">
        <ul class="gallery_widget_attached_images_list">
            <?php echo ('' !== $param_value) ? cms_get_media_attached_thumb(explode(',', $param_value)) : '' ?>
        </ul>
    </div>
    <div class="gallery_widget_site_images">
    </div>
    <?php if (!empty($settings['single']) && $settings['single'] === true) : ?>
    <a class="gallery_widget_add_videos" href="#" data-single="true"
       title="<?php echo esc_attr__('Add Video', CMS_NAME) ?>">
        <i class="vc-composer-icon vc-c-icon-add"></i><?php echo esc_html__('Add Video', CMS_NAME) ?></a>
<?php else: ?>
    <a class="gallery_widget_add_videos" href="#" title="<?php echo esc_attr__('Add Videos', CMS_NAME) ?>">
        <i class="vc-composer-icon vc-c-icon-add"></i><?php echo esc_html__('Add Videos', CMS_NAME) ?></a>
<?php endif;
    return $output = ob_get_clean();
}

function cms_file_picker_settings_field( $settings, $value ) {
    $output = '';
    $select_file_class = '';
    $remove_file_class = ' hidden';
    $attachment_url = wp_get_attachment_url( $value );
    if ( $attachment_url ) {
        $select_file_class = ' hidden';
        $remove_file_class = '';
    }
    $output .= '<div class="file_picker_block">
                <div class="' . esc_attr( $settings['type'] ) . '_display">' .
        $attachment_url .
        '</div>
                <input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field" value="' . esc_attr( $value ) . '" />
                <button class="button file-picker-button' . $select_file_class . '">Select File</button>
                <button class="button file-remover-button' . $remove_file_class . '">Remove File</button>
              </div>
              ';
    return $output;
}


function cms_remove_not_match_media_attach_ids(array $ids,array $type)
{
    $valid_media = array();
    foreach ($ids as $id)
    {
        $meta = wp_get_attachment_metadata($id);
        if(in_array($id,$valid_media))
            continue;
        if(is_array($meta) && isset($meta['mime_type']))
        {
            $is_valid = false;
            foreach ($type as $check)
            {
                if(strpos($meta['mime_type'],$check) == 0)
                {
                    $is_valid = true;
                    break;
                }
            }
            if($is_valid)
                $valid_media[] = $id;
        }
    }
    return implode(',',$valid_media);
}

function cms_get_media_attached_thumb(array $ids)
{
    $output = '';

    foreach ( $ids as $id ) {
        if ( is_numeric( $id ) ) {
            $thumb_src = wp_get_attachment_thumb_file($id);
            $thumb_src = empty( $thumb_src) ? cmssuperheroes()->path('APP_URL').'/includes/types/assets/video.png' : $thumb_src;
        } else {
            $thumb_src = $id;
        }

        if (is_string($thumb_src)  ) {
            $output .= '
            <li class="added">
                <img rel="' . esc_attr( $id ) . '" src="' . esc_url( $thumb_src ) . '" />
                <a href="#" class="vc_icon-remove"><i class="vc-composer-icon vc-c-icon-close"></i></a>
            </li>';
        }
    }

    return $output;
}
