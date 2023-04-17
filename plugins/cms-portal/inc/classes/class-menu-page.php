<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 *
 */
class CPTMenuPage
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'cpt_add_menu']);
//        add_action('admin_bar_menu', [$this, 'cms_add_admin_bar_menu'], 100);
    }

    public function cpt_add_menu()
    {
        $current_theme = wp_get_theme();
        if (is_child_theme()) {
            $current_theme = $current_theme->parent();
        }
        $theme_name = $current_theme->get('Name');
        $theme_text_domain = $current_theme->get('TextDomain');
        // <span class="update-plugins count-1"><span class="update-count">1</span></span>
        add_menu_page($theme_name, $theme_name, 'manage_options', $theme_text_domain, [
            $this,
            'cpt_add_dashboard_page'
        ], 'dashicons-admin-generic', 3);

        add_submenu_page($theme_text_domain, $theme_name, __('Dashboard', CPT_TEXT_DOMAIN), 'manage_options', $theme_text_domain, [
            $this,
            'cpt_add_dashboard_page'
        ], 0);
    }

    public function cpt_add_dashboard_page()
    {
        $cpt_dashboard_config = apply_filters('cpt_dashboard_config', []);
        $cpt_dashboard_config = array_merge([
            'documentation_link' => '#',
            'ticket_link' => '#',
            'video_tutorial_link' => '#',
            'demo_link' => '#',
            'rating_link' => 'https://themeforest.net/downloads',
        ], $cpt_dashboard_config);
        $dev_mode = apply_filters('cpt_dev_mode', false);

        $oAuth = get_option('cpt_oauth');
        $access_token = isset($oAuth['access_token']) ? $oAuth['access_token'] : '';
        $is_authenticate = false;
        if (!empty($access_token)) {
            $is_authenticate = true;

            // Verify Token
            $params = [
                'host' => str_replace('www.', '', $_SERVER['SERVER_NAME']),
                'token' => $access_token,
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/tokens/verify");
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
                $is_authenticate = false;
            } else {
                $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($responseCode != 200) {
                    $is_authenticate = false;
                } else {
                    $body = @json_decode($response, true);

                    if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                        $is_authenticate = false;
                    } else {
                        $oAuth['user_data'] = $body;
                        update_option('cpt_oauth', $oAuth);
                    }
                }
            }

            curl_close($ch);

            if (!$is_authenticate) {
                $refresh_token = isset($oAuth['refresh_token']) ? $oAuth['refresh_token'] : '';

                // Refresh Token
                $params = [
                    'host' => str_replace('www.', '', $_SERVER['SERVER_NAME']),
                    'token' => $refresh_token,
                ];

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/tokens/refresh");
                $headers = array(
                    "Content-Type: application/json",
                );
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                $response = curl_exec($ch);
                if ($response === false || curl_errno($ch)) {
                    $is_authenticate = false;
                } else {
                    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    if ($responseCode != 200) {
                        $is_authenticate = false;
                    } else {
                        $body = @json_decode($response, true);

                        if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                            $is_authenticate = false;
                        } else {
                            $access_token = $body['access_token'];
                            $oAuth['access_token'] = $body['access_token'];
                            $oAuth['expires_in'] = $body['expires_in'];
                            update_option('cpt_oauth', $oAuth);
//                            $is_authenticate = true;
                        }
                    }
                }

                curl_close($ch);
            }
        }

        if ($is_authenticate) {
            $is_valid = true;
            $theme = [];

            $current_theme = wp_get_theme();
            if (is_child_theme()) {
                $current_theme = $current_theme->parent();
            }
            // Get Theme Data
            $params = [
                'host' => str_replace('www.', '', $_SERVER['SERVER_NAME']),
                'theme_slug' => $current_theme->get('TextDomain'),
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/get/theme");
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
                $is_valid = false;
            } else {
                $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($responseCode != 200) {
                    $is_valid = false;
                } else {
                    $body = @json_decode($response, true);

                    if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                        $is_valid = false;
                    } else {
                        $theme = $body;
                    }
                }
            }

            curl_close($ch);

            if (!$is_valid) {
                cpt_get_template_file_e('pages/invalid-theme.php');
            } else {
                cpt_get_template_file_e('pages/dashboard.php', [
                    'config' => $cpt_dashboard_config,
                    'customer' => $oAuth['user_data'],
                    'theme' => $theme,
                ]);
            }
        } else {
            if ($dev_mode) {
                cpt_get_template_file_e('pages/login.php');
            } else {
                cpt_get_template_file_e('pages/verify-purchased-code.php');
            }
        }
    }

    public function cpt_add_plugins_page()
    {
        cpt_get_template_file_e('pages/plugins.php');
    }

    public function cpt_add_themes_page()
    {
        cpt_get_template_file_e('pages/themes.php');
    }
}