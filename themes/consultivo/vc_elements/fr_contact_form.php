<?php
    if(class_exists('WPCF7')) {
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

        $contact_forms = array();
        if ( $cf7 ) {
            foreach ( $cf7 as $cform ) {
                $contact_forms[ $cform->post_title ] = $cform->ID;
            }
        } else {
            $contact_forms[ esc_html__( 'No contact forms found', 'consultivo' ) ] = 0;
        }

        vc_map(array(
            'name' => 'Contact Form',
            'base' => 'fr_contact_form',
            'icon' => 'cs_icon_for_vc',
            'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
            'params' => array(
                array(
                    'type' => 'cms_template_img',
                    'param_name' => 'cms_template',
                    'shortcode' => 'fr_contact_form',
                    'heading' => esc_html__('Shortcode Template', 'consultivo'),
                    'std'        => 'fr_contact_form.php',
                    'group' => esc_html__('Template', 'consultivo'),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Select contact form', 'consultivo' ),
                    'param_name' => 'id',
                    'value' => $contact_forms,
                    'save_always' => true,
                    'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'consultivo' ),
                    'group' => esc_html__('Template', 'consultivo'),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Title', 'consultivo'),
                    'param_name' => 'title',
                    'group' => esc_html__('Template', 'consultivo'),
                    'admin_label' => true,
                    'dependency' => array(
                        'element' => 'cms_template',
                        'value' => array(
                            'fr_contact_form.php',
                            'fr_contact_form--layout1.php',
                        )
                    ),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__( 'Description', 'consultivo' ),
                    'param_name' => 'description',
                    'admin_label' => true,
                    'dependency' => array(
                        'element' => 'cms_template',
                        'value' => array(
                            'fr_contact_form--layout3.php',
                        )
                    ),
                    'group'      => esc_html__('Template', 'consultivo'),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Title color', 'consultivo'),
                    'param_name' => 'title_color',
                    'value' => '',
                    'group' => esc_html__('Template', 'consultivo'),
                    'dependency' => array(
                        'element' => 'cms_template',
                        'value' => array(
                            'fr_contact_form.php',
                            'fr_contact_form--layout1.php',
                        )
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Style', 'consultivo'),
                    'param_name' => 'style',
                    'group' => esc_html__('Template', 'consultivo'),
                    'value' => array(
                        'Default' => 'default',
                        'Primary' => 'primary',
                    ),
                    'dependency' => array(
                        'element' => 'cms_template',
                        'value' => array(
                            'fr_contact_form.php',
                            'fr_contact_form--layout2.php',
                        )
                    ),
                ),
                /* Extra */
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Extra class name', 'consultivo' ),
                    'param_name' => 'el_class',
                    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'consultivo' ),
                    'group'      => esc_html__('Extra', 'consultivo'),
                ),
                array(
                    'type' => 'animation_style',
                    'heading' => esc_html__( 'Animation Style', 'consultivo' ),
                    'param_name' => 'animation',
                    'description' => esc_html__( 'Choose your animation style', 'consultivo' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => esc_html__('Extra', 'consultivo'),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Element Parallax', 'consultivo'),
                    'param_name' => 'el_parallax',
                    'value' => array(
                        'No' => 'false',
                        'Yes' => 'true',
                    ),
                    'group' => esc_html__('Extra', 'consultivo'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Parallax Speed', 'consultivo' ),
                    'param_name' => 'el_parallax_speed',
                    'value' => '',
                    'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'consultivo' ),
                    'group' => esc_html__('Extra', 'consultivo'),
                    'dependency' => array(
                        'element'=>'el_parallax',
                        'value'=>array(
                            'true',
                        )
                    ),
                ),
            )
        ));

        class WPBakeryShortCode_fr_contact_form extends CmsShortCode
        {

            protected function content($atts, $content = null)
            {
                return parent::content($atts, $content);
            }
        }
    }
?>