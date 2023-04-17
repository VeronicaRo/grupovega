<?php
vc_map(array(
    'name' => 'Google Map',
    'base' => 'fr_googlemap',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'consultivo'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('API Key', 'consultivo'),
            'param_name' => 'api',
            'value' => '',
            'description' => esc_html__('Enter you api key of map, get key from (https://console.developers.google.com)', 'consultivo')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Address', 'consultivo'),
            'param_name' => 'address',
            'value' => 'New York, United States',
            'description' => esc_html__('Enter address of Map', 'consultivo')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Coordinate', 'consultivo'),
            'param_name' => 'coordinate',
            'value' => '',
            'description' => esc_html__('Enter coordinate of Map, format input (latitude, longitude)', 'consultivo')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Click Show Info window', 'consultivo'),
            'param_name' => 'infoclick',
            'value' => array(
                esc_html__('Yes, please', 'consultivo') => true
            ),
            'description' => esc_html__('Click a marker and show info window (Default Show).', 'consultivo')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Marker Coordinate', 'consultivo'),
            'param_name' => 'markercoordinate',
            'value' => '',
            'description' => esc_html__('Enter marker coordinate of Map, format input (latitude, longitude)', 'consultivo')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Marker Title', 'consultivo'),
            'param_name' => 'markertitle',
            'value' => '',
            'description' => esc_html__('Enter Title Info windows for marker', 'consultivo')
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Marker Description', 'consultivo'),
            'param_name' => 'markerdesc',
            'value' => '',
            'description' => esc_html__('Enter Description Info windows for marker', 'consultivo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Marker Icon', 'consultivo'),
            'param_name' => 'markericon',
            'value' => '',
            'description' => esc_html__('Select image icon for marker', 'consultivo')
        ),
        array(
            'type' => 'textarea_raw_html',
            'heading' => esc_html__('Marker List', 'consultivo'),
            'param_name' => 'markerlist',
            'value' => '',
            'description' => esc_html__('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'consultivo')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Info Window Max Width', 'consultivo'),
            'param_name' => 'infowidth',
            'value' => '200',
            'description' => esc_html__('Set max width for info window', 'consultivo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Map Type', 'consultivo'),
            'param_name' => 'type',
            'value' => array(
                'ROADMAP' => 'ROADMAP',
                'HYBRID' => 'HYBRID',
                'SATELLITE' => 'SATELLITE',
                'TERRAIN' => 'TERRAIN'
            ),
            'description' => esc_html__('Select the map type.', 'consultivo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Style Template', 'consultivo'),
            'param_name' => 'style',
            'value' => array(
                'Default' => '',
                'Custom' => 'custom',
                'Light Monochrome' => 'light-monochrome',
                'Blue water' => 'blue-water',
                'Midnight Commander' => 'midnight-commander',
                'Paper' => 'paper',
                'Red Hues' => 'red-hues',
                'Hot Pink' => 'hot-pink'
            ),
            'description' => 'Select your heading size for title.'
        ),
        array(
            'type' => 'textarea_raw_html',
            'heading' => esc_html__('Custom Template', 'consultivo'),
            'param_name' => 'content',
            'value' => '',
            'description' => esc_html__('Get template from http://snazzymaps.com', 'consultivo')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Zoom', 'consultivo'),
            'param_name' => 'zoom',
            'value' => '13',
            'description' => esc_html__('zoom level of map, default is 13', 'consultivo')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Width', 'consultivo'),
            'param_name' => 'width',
            'value' => 'auto',
            'description' => esc_html__('Width of map without pixel, default is auto', 'consultivo')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Height', 'consultivo'),
            'param_name' => 'height',
            'value' => '350px',
            'description' => esc_html__('Height of map without pixel, default is 350px', 'consultivo')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Scroll Wheel', 'consultivo'),
            'param_name' => 'scrollwheel',
            'value' => array(
                esc_html__('Yes, please', 'consultivo') => true
            ),
            'description' => esc_html__('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'consultivo')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Pan Control', 'consultivo'),
            'param_name' => 'pancontrol',
            'value' => array(
                esc_html__('Yes, please', 'consultivo') => true
            ),
            'description' => esc_html__('Show or hide Pan control.', 'consultivo')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Zoom Control', 'consultivo'),
            'param_name' => 'zoomcontrol',
            'value' => array(
                esc_html__('Yes, please', 'consultivo') => true
            ),
            'description' => esc_html__('Show or hide Zoom Control.', 'consultivo')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Scale Control', 'consultivo'),
            'param_name' => 'scalecontrol',
            'value' => array(
                esc_html__('Yes, please', 'consultivo') => true
            ),
            'description' => esc_html__('Show or hide Scale Control.', 'consultivo')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Map Type Control', 'consultivo'),
            'param_name' => 'maptypecontrol',
            'value' => array(
                esc_html__('Yes, please', 'consultivo') => true
            ),
            'description' => esc_html__('Show or hide Map Type Control.', 'consultivo')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Street View Control', 'consultivo'),
            'param_name' => 'streetviewcontrol',
            'value' => array(
                esc_html__('Yes, please', 'consultivo') => true
            ),
            'description' => esc_html__('Show or hide Street View Control.', 'consultivo')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Over View Map Control', 'consultivo'),
            'param_name' => 'overviewmapcontrol',
            'value' => array(
                esc_html__('Yes, please', 'consultivo') => true
            ),
            'description' => esc_html__('Show or hide Over View Map Control.', 'consultivo')
        ),
        /* Content */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Subtitle', 'consultivo'),
            'param_name' => 'gm_subtitle',
            'value' => '',
            'group' => esc_html__('Content', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_googlemap--layout2.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title', 'consultivo'),
            'param_name' => 'gm_title',
            'value' => '',
            'group' => esc_html__('Content', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_googlemap--layout2.php',
                )
            ),
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Address', 'consultivo'),
            'param_name' => 'gm_address',
            'value' => '',
            'group' => esc_html__('Content', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_googlemap--layout2.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Email', 'consultivo'),
            'param_name' => 'gm_email',
            'value' => '',
            'group' => esc_html__('Content', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_googlemap--layout2.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Phone', 'consultivo'),
            'param_name' => 'gm_phone',
            'value' => '',
            'group' => esc_html__('Content', 'consultivo'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'fr_googlemap--layout2.php',
                )
            ),
        ),
    )
));

class WPBakeryShortCode_fr_googlemap extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>