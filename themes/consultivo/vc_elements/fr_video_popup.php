<?php
$args = array(
    'name' => 'Video Popup',
    'base' => 'fr_video_popup',
    'class' => 'vc-cms-video-popup',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(

        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'fr_video_popup',
            'heading' => esc_html__('Shortcode Template', 'consultivo'),
            'std' => 'fr_video_popup.php',
            'group' => esc_html__('Template', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'consultivo' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'consultivo' ),
            'group'            => esc_html__('Template', 'consultivo')
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation Style', 'consultivo' ),
            'param_name' => 'animation',
            'description' => esc_html__( 'Choose your animation style', 'consultivo' ),
            'admin_label' => false,
            'weight' => 0,
            "group" => esc_html__("Template", 'consultivo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element Parallax', 'consultivo'),
            'param_name' => 'el_parallax',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            'group' => esc_html__('Template', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax Speed', 'consultivo' ),
            'param_name' => 'el_parallax_speed',
            'value' => '',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'consultivo' ),
            'group' => esc_html__('Template', 'consultivo'),
            'dependency' => array(
                'element'=>'el_parallax',
                'value'=>array(
                    'true',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax Speed', 'consultivo' ),
            'param_name' => 'el_parallax_speed',
            'value' => '',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'consultivo' ),
            'group' => esc_html__('Template', 'consultivo'),
            'dependency' => array(
                'element'=>'el_parallax',
                'value'=>array(
                    'true',
                )
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Video Popup Style','consultivo'),
            'param_name' => 'popup_style',
            'group' => esc_html__('Video Settings', 'consultivo'),
            'value' => array(
                'Video Popup Has Image' => 'video-has-image',
                'Video Popup No Image' => 'video-no-image'
            )
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Video Image', 'consultivo' ),
            'param_name' => 'video_image',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'consultivo' ),
            'group' => esc_html__('Video Settings', 'consultivo'),
            'dependency' => array(
                'element'=>'popup_style',
                'value'=>array(
                    'video-has-image',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Button Text','consultivo'),
            'param_name' => 'button_text',
            'group' => esc_html__('Video Settings', 'consultivo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Video Source','consultivo'),
            'param_name' => 'video_source',
            'admin_label' => true,
            'description' => 'Enter the video url here.',
            'group'       => esc_html__('Video Settings','consultivo'),
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Video Autoplay', 'consultivo'),
            'param_name' => 'video_autoplay',
            'value'      => '1',
            'description'        => 'Check here if you want video autoplay',
            'group'      => esc_html__('Video Settings', 'consultivo')
        ),
    ));
vc_map($args);

class WPBakeryShortCode_fr_video_popup extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>