<?php

if (!defined('ABSPATH')) {
    die();
}
if (!class_exists('CPTAjaxHandle')) {
    class CPTAjaxHandle
    {

        function __construct()
        {
            add_action('wp_ajax_cpt_verify_purchase_code', [$this, 'verify_purchase_code']);
            add_action('wp_ajax_cpt_login_to_server', [$this, 'login_to_server']);
            add_action('wp_ajax_cpt_log_out', [$this, 'log_out']);
            add_action('wp_ajax_cpt_install_plugin', [$this, 'install_plugin']);
            add_action('wp_ajax_cpt_activate_plugin', [$this, 'activate_plugin']);
            add_action('wp_ajax_cpt_update_plugin', [$this, 'update_plugin']);
            add_action('wp_ajax_cpt_update_theme', [$this, 'update_theme']);
            add_action('wp_ajax_cpt_can_import_demo', [$this, 'can_import_demo']);
            add_action('wp_ajax_cpt_dismiss', [$this, 'dismiss']);
        }

        function verify_purchase_code()
        {
            try {
                if (!isset($_POST["purchase_code"]) || empty($_POST["purchase_code"])) {
                    throw new Exception(__('Something went wrong!', CPT_TEXT_DOMAIN));
                }

                $current_theme = wp_get_theme();
                if (is_child_theme()) {
                    $current_theme = $current_theme->parent();
                }

                $params = [
                    'host' => str_replace('www.', '', $_SERVER['SERVER_NAME']),
                    'email' => isset($_POST["email"]) ? $_POST["email"] : '',
                    'name' => isset($_POST["name"]) ? $_POST["name"] : '',
                    'purchase_code' => $_POST["purchase_code"],
                    'theme_slug' => $current_theme->get('TextDomain'),
                ];

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/verify/purchase-code");
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
                    throw new Exception(__('Verify Fail!', CPT_TEXT_DOMAIN));
                } else {
                    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $body = @json_decode($response, true);

                    if ($responseCode != 200) {
                        throw new Exception($body['message']);
                    } else {
                        if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                            throw new Exception(__('Invalid response data!', CPT_TEXT_DOMAIN));
                        } else {
                            update_option('cpt_oauth', $body);
                            $result = [
                                'stt' => true,
                                'msg' => __('Verified Successfully!', CPT_TEXT_DOMAIN),
                                'data' => $body,
                            ];
                        }
                    }
                }

                curl_close($ch);
            } catch (Exception $e) {
                $result = [
                    'stt' => false,
                    'msg' => $e->getMessage(),
                    'data' => [],
                ];
            }

            wp_send_json($result);
            die();
        }

        function login_to_server()
        {
            try {
                if (!isset($_POST["username"]) || empty($_POST["username"]) || !isset($_POST["password"]) || empty($_POST["password"])) {
                    throw new Exception(__('Something went wrong!', CPT_TEXT_DOMAIN));
                }

                $params = [
                    'username' => $_POST["username"],
                    'password' => $_POST["password"],
                ];

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/login");
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
                    throw new Exception(__('Login Fail!', CPT_TEXT_DOMAIN));
                } else {
                    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $body = @json_decode($response, true);

                    if ($responseCode != 200) {
                        throw new Exception($body['message']);
                    } else {
                        if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                            throw new Exception(__('Invalid response data!', CPT_TEXT_DOMAIN));
                        } else {
                            update_option('cpt_oauth', $body);
                            $result = [
                                'stt' => true,
                                'msg' => __('Logged in Successfully!', CPT_TEXT_DOMAIN),
                                'data' => $body,
                            ];
                        }
                    }
                }

                curl_close($ch);
            } catch (Exception $e) {
                $result = [
                    'stt' => false,
                    'msg' => $e->getMessage(),
                    'data' => '',
                ];
            }

            wp_send_json($result);
            die();
        }

        function log_out()
        {
            try {
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

                curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/disconnect");
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
                    throw new Exception(__('Fail to get plugin download link!', CPT_TEXT_DOMAIN));
                } else {
                    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $body = @json_decode($response, true);

                    if ($responseCode != 200) {
                        throw new Exception($body['message']);
                    } else {
                        if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                            throw new Exception(__('Invalid response data!', CPT_TEXT_DOMAIN));
                        } else {
                            update_option('cpt_oauth', '');
                            $result = [
                                'stt' => true,
                                'msg' => __('Successfully!', CPT_TEXT_DOMAIN),
                                'data' => [],
                            ];
                        }
                    }
                }
            } catch (Exception $e) {
                $result = [
                    'stt' => false,
                    'msg' => $e->getMessage(),
                    'data' => [],
                ];
            }

            wp_send_json($result);
            die();
        }

        function install_plugin()
        {
            try {
                if (!isset($_POST["type"]) || empty($_POST["type"]) || !isset($_POST["plugin_slug"]) || empty($_POST["plugin_slug"])) {
                    throw new Exception(__('Something went wrong!', CPT_TEXT_DOMAIN));
                }

                $result = [
                    'stt' => false,
                    'msg' => __('Something went wrong!', CPT_TEXT_DOMAIN),
                    'data' => [],
                ];

                require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

                if ($_POST["type"] == 'internal') {
                    $oAuth = get_option('cpt_oauth');
                    $access_token = isset($oAuth['access_token']) ? $oAuth['access_token'] : '';
                    $current_theme = wp_get_theme();
                    if (is_child_theme()) {
                        $current_theme = $current_theme->parent();
                    }

                    $params = [
                        'host' => str_replace('www.', '', $_SERVER['SERVER_NAME']),
                        'theme_slug' => $current_theme->get('TextDomain'),
                        'plugin_slug' => $_POST["plugin_slug"],
                    ];

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/get/plugin-download-link");
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
                        throw new Exception(__('Fail to get plugin download link!', CPT_TEXT_DOMAIN));
                    } else {
                        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        $body = @json_decode($response, true);

                        if ($responseCode != 200) {
                            throw new Exception($body['message']);
                        } else {
                            if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                                throw new Exception(__('Invalid response data!', CPT_TEXT_DOMAIN));
                            } else {
                                if (isset($body['download_link']) && !empty($body['download_link'])) {
                                    $skin = new WP_Ajax_Upgrader_Skin();
                                    $upgrader = new Plugin_Upgrader($skin);
                                    $install_result = $upgrader->install($body['download_link']);

                                    if (!$install_result) {
                                        $result = [
                                            'stt' => false,
                                            'msg' => __('Fail to install plugin!', CPT_TEXT_DOMAIN),
                                            'data' => $body,
                                        ];
                                    } else {
                                        $html = cpt_get_template_file__('partials/required-plugin.php', [
                                            'plugin_slug' => $_POST['plugin_slug'],
                                        ]);
                                        $result = [
                                            'stt' => true,
                                            'msg' => __('Successfully!', CPT_TEXT_DOMAIN),
                                            'data' => $html,
                                        ];
                                    }
                                } else {
                                    $result = [
                                        'stt' => false,
                                        'msg' => __('Plugin download link not found!', CPT_TEXT_DOMAIN),
                                        'data' => $body
                                    ];
                                }
                            }
                        }
                    }

                    curl_close($ch);
                } elseif ($_POST["type"] == 'external') {
                    $api = plugins_api(
                        'plugin_information',
                        array(
                            'slug' => sanitize_key(wp_unslash($_POST['plugin_slug'])),
                            'fields' => array(
                                'sections' => false,
                            ),
                        )
                    );

                    if (!is_wp_error($api)) {
                        $skin = new WP_Ajax_Upgrader_Skin();
                        $upgrader = new Plugin_Upgrader($skin);
                        $install_result = $upgrader->install($api->download_link);

                        if (!$install_result) {
                            $result = [
                                'stt' => false,
                                'msg' => __('Fail to install plugin!', CPT_TEXT_DOMAIN),
                                'data' => [],
                            ];
                        } else {
                            $html = cpt_get_template_file__('partials/required-plugin.php', [
                                'plugin_slug' => $_POST['plugin_slug'],
                            ]);
                            $result = [
                                'stt' => true,
                                'msg' => __('Successfully!', CPT_TEXT_DOMAIN),
                                'data' => $html,
                            ];
                        }
                    }
                }
            } catch (Exception $e) {
                $result = [
                    'stt' => false,
                    'msg' => $e->getMessage(),
                    'data' => '',
                ];
            }

            wp_send_json($result);
            die();
        }

        function activate_plugin()
        {
            try {
                if (!isset($_POST["plugin_slug"]) || empty($_POST["plugin_slug"])) {
                    throw new Exception(__('Something went wrong!', CPT_TEXT_DOMAIN));
                }

                $result = [
                    'stt' => false,
                    'msg' => __('Fail!', CPT_TEXT_DOMAIN),
                    'data' => [],
                ];

                $installed_plugins_data = get_plugins();
                foreach ($installed_plugins_data as $installed_plugin_file => $installed_plugin_data) {
                    $_installed_plugin_file = explode('/', $installed_plugin_file);
                    if ($_installed_plugin_file[0] == $_POST["plugin_slug"]) {
                        if (is_plugin_active($installed_plugin_file)) {
                            throw new Exception(__('Plugin was activated!', CPT_TEXT_DOMAIN));
                        } else {
                            // null|WP_Error Null on success, WP_Error on invalid file.
                            $active_result = activate_plugin($installed_plugin_file);

                            if (!is_null($active_result)) {
                                $result = [
                                    'stt' => false,
                                    'msg' => __('Fail to activate plugin!', CPT_TEXT_DOMAIN),
                                    'data' => [],
                                ];
                            } else {
                                $html = cpt_get_template_file__('partials/required-plugin.php', [
                                    'plugin_slug' => $_POST['plugin_slug'],
                                ]);
                                $result = [
                                    'stt' => true,
                                    'msg' => __('Successfully!', CPT_TEXT_DOMAIN),
                                    'data' => $html,
                                ];
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                $result = [
                    'stt' => false,
                    'msg' => $e->getMessage(),
                    'data' => '',
                ];
            }

            wp_send_json($result);
            die();
        }

        function update_plugin()
        {
            try {
                if (!isset($_POST["type"]) || empty($_POST["type"]) || !isset($_POST["plugin_slug"]) || empty($_POST["plugin_slug"])) {
                    throw new Exception(__('Something went wrong!', CPT_TEXT_DOMAIN));
                }

                $result = [
                    'stt' => false,
                    'msg' => __('Fail!', CPT_TEXT_DOMAIN),
                    'data' => [],
                ];

                if ($_POST["type"] == 'internal') {
                    $oAuth = get_option('cpt_oauth');
                    $access_token = isset($oAuth['access_token']) ? $oAuth['access_token'] : '';
                    $current_theme = wp_get_theme();
                    if (is_child_theme()) {
                        $current_theme = $current_theme->parent();
                    }

                    check_admin_referer('update-plugin-' . $_POST['plugin_slug']);

                    require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

                    $params = [
                        'host' => str_replace('www.', '', $_SERVER['SERVER_NAME']),
                        'theme_slug' => $current_theme->get('TextDomain'),
                        'plugin_slug' => $_POST["plugin_slug"],
                    ];

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/get/plugin-download-link");
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
                        throw new Exception(__('Fail to get plugin download link!', CPT_TEXT_DOMAIN));
                    } else {
                        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        $body = @json_decode($response, true);

                        if ($responseCode != 200) {
                            throw new Exception($body['message']);
                        } else {
                            if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                                throw new Exception(__('Invalid response data!', CPT_TEXT_DOMAIN));
                            } else {
                                if (isset($body['download_link']) && !empty($body['download_link'])) {
                                    $installed_plugins_data = get_plugins();
                                    foreach ($installed_plugins_data as $installed_plugin_file => $installed_plugin_data) {
                                        $_installed_plugin_file = explode('/', $installed_plugin_file);
                                        if ($_installed_plugin_file[0] == $_POST['plugin_slug']) {
                                            $repo_updates = get_site_transient('update_plugins');

                                            if (!is_object($repo_updates)) {
                                                $repo_updates = new stdClass;
                                            }

                                            if (empty($repo_updates->response[$installed_plugin_file])) {
                                                $repo_updates->response[$installed_plugin_file] = new stdClass;
                                            }

                                            $repo_updates->response[$installed_plugin_file]->slug = $_POST['plugin_slug'];
                                            $repo_updates->response[$installed_plugin_file]->plugin = $installed_plugin_file;
                                            $repo_updates->response[$installed_plugin_file]->package = $body['download_link'];

                                            set_site_transient('update_plugins', $repo_updates);

                                            $skin = new WP_Ajax_Upgrader_Skin();
                                            $upgrader = new Plugin_Upgrader($skin);
                                            $update_result = $upgrader->upgrade($installed_plugin_file);

                                            if (!$update_result) {
                                                $result = [
                                                    'stt' => false,
                                                    'msg' => __('Fail to update plugin!', CPT_TEXT_DOMAIN),
                                                    'data' => $body,
                                                ];
                                            } else {
                                                $activate_result = activate_plugin($installed_plugin_file);

                                                if (!is_null($activate_result)) {
                                                    $result = [
                                                        'stt' => false,
                                                        'msg' => __('Fail to reactivate plugin after updated!', CPT_TEXT_DOMAIN),
                                                        'data' => $body,
                                                    ];
                                                } else {
                                                    $html = cpt_get_template_file__('partials/required-plugin.php', [
                                                        'plugin_slug' => $_POST['plugin_slug'],
                                                    ]);
                                                    $result = [
                                                        'stt' => true,
                                                        'msg' => __('Successfully!', CPT_TEXT_DOMAIN),
                                                        'data' => $html,
                                                    ];
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    $result = [
                                        'stt' => false,
                                        'msg' => __('Plugin download link not found!', CPT_TEXT_DOMAIN),
                                        'data' => $body
                                    ];
                                }
                            }
                        }
                    }

                    curl_close($ch);
                } elseif ($_POST["type"] == 'external') {
                    $_POST['slug'] = $_POST["plugin_slug"];
                    $_POST['plugin'] = $_POST["plugin_slug"];
                    $installed_plugins_data = get_plugins();
                    foreach ($installed_plugins_data as $installed_plugin_file => $installed_plugin_data) {
                        $_installed_plugin_file = explode('/', $installed_plugin_file);
                        if ($_installed_plugin_file[0] == $_POST["plugin_slug"]) {
                            $_POST['plugin'] = $installed_plugin_file;
                        }
                    }
//                    wp_ajax_update_plugin();
                    $plugin = plugin_basename(sanitize_text_field(wp_unslash($_POST['plugin'])));

                    require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

                    wp_update_plugins();

                    $skin = new WP_Ajax_Upgrader_Skin();
                    $upgrader = new Plugin_Upgrader($skin);
                    $result = $upgrader->bulk_upgrade(array($plugin));
                    if (is_wp_error($skin->result)) {
                        $result = [
                            'stt' => false,
                            'msg' => $skin->result->get_error_message(),
                            'data' => [],
                        ];
                    } elseif ($skin->get_errors()->has_errors()) {
                        $result = [
                            'stt' => false,
                            'msg' => $skin->get_error_messages(),
                            'data' => [],
                        ];
                    } elseif (is_array($result) && !empty($result[$plugin])) {
                        $html = cpt_get_template_file__('partials/required-plugin.php', [
                            'plugin_slug' => $_POST['plugin_slug'],
                        ]);
                        $result = [
                            'stt' => true,
                            'msg' => __('Successfully!', CPT_TEXT_DOMAIN),
                            'data' => $html,
                        ];
                    } elseif (false === $result) {
                        global $wp_filesystem;

                        $result = [
                            'stt' => false,
                            'msg' => __('Unable to connect to the filesystem. Please confirm your credentials.', CPT_TEXT_DOMAIN),
                            'data' => [],
                        ];

                        // Pass through the error from WP_Filesystem if one was raised.
                        if ($wp_filesystem instanceof WP_Filesystem_Base && is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->has_errors()) {
                            $result['msg'] = esc_html($wp_filesystem->errors->get_error_message());
                        }
                    }
                }
            } catch (Exception $e) {
                $result = [
                    'stt' => false,
                    'msg' => $e->getMessage(),
                    'data' => '',
                ];
            }

            wp_send_json($result);
            die();
        }

        function update_theme()
        {
            try {
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

                curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/get/theme-download-link");
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
                        'msg' => __('Fail to get theme download link!', CPT_TEXT_DOMAIN),
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
                            if (isset($body['download_link']) && !empty($body['download_link'])) {
                                require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                                include_once ABSPATH . 'wp-admin/includes/theme-install.php';

                                $repo_updates = get_site_transient('update_themes');
                                if (!is_object($repo_updates)) {
                                    $repo_updates = new stdClass;
                                }

                                if (empty($repo_updates->response[$body['slug']])) {
                                    $repo_updates->response[$body['slug']] = [];
                                }

                                $repo_updates->response[$body['slug']]['theme'] = $body['slug'];
                                $repo_updates->response[$body['slug']]['package'] = $body['download_link'];

                                set_site_transient('update_themes', $repo_updates);

                                $skin = new WP_Ajax_Upgrader_Skin();
                                $upgrader = new Theme_Upgrader($skin);
                                $update_result = $upgrader->upgrade($body['slug']);

                                if (!$update_result) {
                                    $result = [
                                        'stt' => false,
                                        'msg' => __('Fail to update theme!', CPT_TEXT_DOMAIN),
                                        'data' => $body
                                    ];
                                } else {
                                    $result = [
                                        'stt' => true,
                                        'msg' => __('Successfully!', CPT_TEXT_DOMAIN),
                                        'data' => $body
                                    ];
                                }
                            } else {
                                $result = [
                                    'stt' => false,
                                    'msg' => __('Theme download link not found!', CPT_TEXT_DOMAIN),
                                    'data' => $body
                                ];
                            }
                        }
                    }
                }

                curl_close($ch);

            } catch (Exception $e) {
                $result = [
                    'stt' => false,
                    'msg' => $e->getMessage(),
                    'data' => [],
                ];
            }

            wp_send_json($result);
            die();
        }

        function can_import_demo()
        {
            $result = [
                'stt' => false,
                'msg' => 'Please make sure installed Import Plugin',
                'data' => [],
            ];

            if ((class_exists('SWA_Import_Export') || class_exists('EF3_Import_Export')) && (class_exists('Elementor_Theme_Core') || class_exists('CmssuperheroesCore'))) {
                $url = '';
                if (class_exists('SWA_Import_Export')) {
                    $url = admin_url('admin.php?page=swa-import');
                } elseif (class_exists('EF3_Import_Export')) {
                    $url = admin_url('admin.php?page=ef3-import-and-export');
                }
                $result = [
                    'stt' => true,
                    'msg' => 'Installed Import Plugin',
                    'data' => esc_url($url),
                ];
            }

            wp_send_json($result);
            die();
        }

        function dismiss()
        {
            try {
                if (!isset($_POST["key"]) || empty($_POST["key"])) {
                    throw new Exception(__('Something went wrong!', CPT_TEXT_DOMAIN));
                }

                switch($_POST["key"]){
                    case CPT_DISMISS_THEME_INFO:
                        set_transient(CPT_DISMISS_THEME_INFO, true, DAY_IN_SECONDS * 7);
                        break;

                    case CPT_DISMISS_REQUIRED_PLUGINS:
                        set_transient(CPT_DISMISS_REQUIRED_PLUGINS, true, DAY_IN_SECONDS);
                        break;
                }

                $result = [
                    'stt' => true,
                    'msg' => __('Dismiss Successfully', CPT_TEXT_DOMAIN),
                    'data' => [],
                ];
            } catch (Exception $e) {
                $result = [
                    'stt' => false,
                    'msg' => $e->getMessage(),
                    'data' => [],
                ];
            }

            wp_send_json($result);
            die();
        }
    }
}