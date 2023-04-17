<?php
if (!function_exists('cpt_get_required_plugins')) {
    function cpt_get_required_plugins()
    {
        $oAuth = get_option('cpt_oauth');
        $access_token = isset($oAuth['access_token']) ? $oAuth['access_token'] : '';
        $current_theme = wp_get_theme();
        if (is_child_theme()) {
            $current_theme = $current_theme->parent();
        }
        $params = [
            'host' => str_replace('www.', '', $_SERVER['SERVER_NAME']),
            'theme_slug' => $current_theme->get('TextDomain'),
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/get/required-plugins");
        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer {$access_token}",
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        if ($response === false || curl_errno($ch)) {
            $result = [
                'stt' => false,
                'msg' => __('Fail to get required plugins!', CPT_TEXT_DOMAIN),
                'data' => []
            ];
        } else {
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $body = @json_decode($response, true);

            if ($responseCode != 200) {
                $result = [
                    'stt' => false,
                    'msg' => $body['message'],
                    'data' => []
                ];
            } else {
                if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                    $result = [
                        'stt' => false,
                        'msg' => __('Invalid response data!', CPT_TEXT_DOMAIN),
                        'data' => []
                    ];
                } else {
                    $result = [
                        'stt' => true,
                        'msg' => __('Successfully!', CPT_TEXT_DOMAIN),
                        'data' => $body
                    ];
                }
            }
        }

        curl_close($ch);

        return $result;
    }
}

if (!function_exists('cpt_validate_required_plugins')) {
    function cpt_validate_required_plugins()
    {
        $result = cpt_get_required_plugins();
        $required_plugins = $result['data'];
        if (empty($required_plugins)) {
            $required_plugins = [
                'external_plugins' => [],
                'internal_plugins' => [],
            ];
        }
        $installed_plugins = [];
        $installed_plugins_data = get_plugins();
        foreach ($installed_plugins_data as $installed_plugin_file => $installed_plugin_data) {
            $installed_plugin_file = explode('/', $installed_plugin_file);
            $installed_plugins[$installed_plugin_file[0]] = $installed_plugin_data;
        }

        $active_plugins = [];
        $active_plugins_data = get_option('active_plugins');
        foreach ($active_plugins_data as $active_plugin_file) {
            $active_plugin_file = explode('/', $active_plugin_file);
            $active_plugins[] = $active_plugin_file[0];
        }

        $result = [
            'need_install' => false,
            'need_activate' => false,
            'need_update' => false,
        ];

        foreach ($required_plugins['external_plugins'] as $plugin_slug => $plugin_data) {
            $is_installed = isset($installed_plugins[$plugin_slug]);
            $is_active = in_array($plugin_slug, $active_plugins);
            $need_update = isset($installed_plugins[$plugin_slug]) && version_compare($plugin_data['version'], $installed_plugins[$plugin_slug]['Version'], '>');
            if (!$is_installed) {
                $result['need_install'] = true;
            } else {
                if (!$is_active) {
                    $result['need_activate'] = true;
                }
            }
//            if ($need_update) {
//                $result['need_update'] = true;
//            }
        }

        foreach ($required_plugins['internal_plugins'] as $plugin_slug => $plugin_data) {
            $is_installed = isset($installed_plugins[$plugin_slug]);
            $is_active = in_array($plugin_slug, $active_plugins);
            $need_update = isset($installed_plugins[$plugin_slug]) && version_compare($plugin_data['version'], $installed_plugins[$plugin_slug]['Version'], '>');
            if (!$is_installed) {
                $result['need_install'] = true;
            } else {
                if (!$is_active) {
                    $result['need_activate'] = true;
                }
            }
            if ($need_update) {
                $result['need_update'] = true;
            }
        }

        return $result;
    }
}
?>