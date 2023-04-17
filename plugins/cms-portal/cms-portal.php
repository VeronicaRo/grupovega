<?php
/**
 * Plugin Name: CMS Portal
 * Description: Support to install, activate and update Plugins and Themes
 * Plugin URI:  https://cmssuperheroes.com/
 * Version:     1.2.1
 * Author:      KennethRoy
 * Author URI:  https://cmssuperheroes.com/
 * Text Domain: cms-portal
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('CPT_TEXT_DOMAIN', 'cms-portal');
define('CPT_PATH', __DIR__);
define('CPT_URL', plugin_dir_url(__FILE__));
define('CPT_TEMPLATE_PATH', 'cms-portal' . DIRECTORY_SEPARATOR);
define('CPT_SERVER_URL', 'https://core.cmssuperheroes.com/wp-json/api-bearer-auth/v1');
define('CPT_FAROST_SERVER_URL', 'https://core.farost.net/wp-json/api-bearer-auth/v1');
define('CPT_7OROOF_SERVER_URL', 'https://core.7oroof.com/wp-json/api-bearer-auth/v1');
define('CMS_PORTAL_VERSION', '1.2.1');
define('CPT_SELF_CHECKING', 'cpt-self-checking');
define('CPT_DISMISS_THEME_INFO', 'cpt-dismiss-theme-info');
define('CPT_DISMISS_REQUIRED_PLUGINS', 'cpt-dismiss-required-plugins');
define('CPT_CACHE_ALLOWED', true);

final class CMS_PORTAL
{
    private static $_instance = null;

    public $plugin_slug;
    public $plugin_base_name;

    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;

    }

    public function __construct()
    {
        $this->plugin_slug = plugin_basename(__DIR__);
        $this->plugin_base_name = plugin_basename(__FILE__);

        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);

        add_action('wp_enqueue_scripts', [$this, 'enqueue']);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue']);

        add_action('admin_init', array($this, 'disable_revslider_open_welcome_page'));
        add_action('admin_init', array($this, 'disable_vc_open_welcome_page'));
        add_action('admin_init', array($this, 'disable_woo_variation_swatches_open_welcome_page'));
        add_action('admin_init', array($this, 'disable_newsletter_open_welcome_page'));
        add_action('admin_init', array($this, 'disable_booked_open_welcome_page'), 8);
        add_action('admin_init', array($this, 'disable_custom_post_type_ui_open_welcome_page'), 0);
        add_action('admin_init', array($this, 'disable_elementor_open_welcome_page'));

        add_filter('plugins_api', array($this, 'info'), 20, 3);
        add_filter('site_transient_update_plugins', array($this, 'update'));
        add_action('upgrader_process_complete', array($this, 'purge'), 10, 2);
    }

    public function i18n()
    {
        load_plugin_textdomain(CPT_TEXT_DOMAIN);
    }

    public function init()
    {
        require_once __DIR__ . '/inc/helpers/template.php';
        require_once __DIR__ . '/inc/helpers/common.php';
        require_once __DIR__ . '/inc/helpers/api.php';

        if (!class_exists('CPTMenuPage')) {
            require_once CPT_PATH . '/inc/classes/class-menu-page.php';
            $this->menu_page = new CPTMenuPage();
        }

        if (!class_exists('CPTAjaxHandle')) {
            require_once CPT_PATH . '/inc/classes/class-ajax-handle.php';
            $this->ajax_handle = new CPTAjaxHandle();
        }

        add_action('admin_notices', [$this, 'admin_notice_introduction_theme']);
        add_action('admin_notices', [$this, 'admin_notice_required_plugins']);
    }

    public function enqueue()
    {

    }

    public function admin_enqueue()
    {
        $current_theme = wp_get_theme();
        if (is_child_theme()) {
            $current_theme = $current_theme->parent();
        }
        wp_enqueue_style('loading-css', CPT_URL . 'assets/lib/loading.css', [], '2.0.0');
        wp_enqueue_style('transition-css', CPT_URL . 'assets/lib/transition.css', [], '2.0.1');
        wp_enqueue_style('ldbtn-css', CPT_URL . 'assets/lib/ldbtn.css', [], '1.0.2');
        wp_enqueue_style('bootstrap-css', CPT_URL . 'assets/css/bootstrap.css', [], '4.5.0');
        wp_enqueue_style('fontawesome-css', CPT_URL . 'assets/lib/fontawesome/css/all.css', [], '5.9.0');
        wp_enqueue_style('cpt-admin-css', CPT_URL . 'assets/css/admin/main.css', [], '1.0.0');
        wp_enqueue_style('cpt-alert-css', CPT_URL . 'assets/css/admin/alert.css', [], '1.0.0');
        if (isset($_GET['page']) && $_GET['page'] == $current_theme->get('TextDomain')) {
            wp_enqueue_script('cpt-alert-js', CPT_URL . 'assets/js/admin/alert.js', ['jquery'], '1.0.0');
            wp_enqueue_script('cpt-admin-js', CPT_URL . 'assets/js/admin/main.js', [
                'jquery',
                'cpt-alert-js',
            ], '1.0.0');
            wp_localize_script('cpt-admin-js', 'cms_portal', [
                'ajax_url' => admin_url('admin-ajax.php'),
            ]);
        }
        else{
            wp_enqueue_script('cpt-dismiss-js', CPT_URL . 'assets/js/admin/dismiss.js', ['jquery'], '1.0.0');
            wp_localize_script('cpt-dismiss-js', 'cms_portal', [
                'ajax_url' => admin_url('admin-ajax.php'),
            ]);
        }
    }

    public function admin_notice_introduction_theme()
    {
        $transient = get_transient(CPT_DISMISS_THEME_INFO);

        if (false !== $transient && CPT_CACHE_ALLOWED) {
            return;
        }

        $screen = get_current_screen();
        if ($screen->parent_file != 'index.php') {
            return;
        }

        $current_theme = wp_get_theme();
        if (is_child_theme()) {
            $current_theme = $current_theme->parent();
        }
        $cpt_dashboard_config = apply_filters('cpt_dashboard_config', []);
        $cpt_dashboard_config = array_merge([
            'documentation_link' => '#',
            'ticket_link' => '#',
            'video_tutorial_link' => '#',
            'demo_link' => '#',
            'rating_link' => 'https://themeforest.net/downloads',
        ], $cpt_dashboard_config);

        ?>
        <div class="cpt-container cpt-notice notice is-dismissible">
            <?php
            cpt_get_template_file_e('partials/theme-info.php', [
                'config' => $cpt_dashboard_config,
            ]);
            ?>
            <button type="button" class="cpt-notice-dismiss notice-dismiss" data-key="<?php echo esc_attr(CPT_DISMISS_THEME_INFO); ?>">
                <span class="screen-reader-text"><?php echo esc_html__('Dismiss this notice.', CPT_TEXT_DOMAIN); ?></span>
            </button>
        </div>
        <?php
    }

    public function admin_notice_required_plugins()
    {
        $transient = get_transient(CPT_DISMISS_REQUIRED_PLUGINS);

        if (false !== $transient && CPT_CACHE_ALLOWED) {
            return;
        }

        $screen = get_current_screen();
        if ($screen->parent_file == 'plugins.php') {
            return;
        }

        $result = cpt_validate_required_plugins();

        if (!$result['need_install'] && !$result['need_activate'] && !$result['need_update']) {
            return;
        }

        $current_theme = wp_get_theme();
        if (is_child_theme()) {
            $current_theme = $current_theme->parent();
        }

        $screen = get_current_screen();
        if ($screen->parent_file == $current_theme->get('TextDomain')) {
            return;
        }

        ?>
        <div class="cpt-container notice notice-warning is-dismissible">
            <?php
            cpt_get_template_file_e('partials/validate-reuqired-plugins.php', [
                'validate_required_plugins_result' => $result,
            ]);
            ?>
            <button type="button" class="cpt-notice-dismiss notice-dismiss" data-key="<?php echo esc_attr(CPT_DISMISS_REQUIRED_PLUGINS); ?>">
                <span class="screen-reader-text"><?php echo esc_html__('Dismiss this notice.', CPT_TEXT_DOMAIN); ?></span>
            </button>
        </div>
        <?php
    }

    public function request()
    {

        $remote = get_transient(CPT_SELF_CHECKING);

        if (false === $remote || !CPT_CACHE_ALLOWED) {

            $params = [
                'plugin_slug' => $this->plugin_slug,
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, cpt_get_server_url() . "/get/plugin");
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
                return false;
            } else {
                $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $body = @json_decode($response);

                if ($responseCode != 200) {
                    return false;
                } else {
                    if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                        return false;
                    } else {
                        if (isset($body->download_url) && !empty($body->download_url)) {
                            $remote = $body;
                        } else {
                            return false;
                        }
                    }
                }
            }

            curl_close($ch);

            set_transient(CPT_SELF_CHECKING, $remote, DAY_IN_SECONDS);

        }

        return $remote;

    }

    function info($res, $action, $args)
    {
        // do nothing if you're not getting plugin information right now
        if ('plugin_information' !== $action) {
            return false;
        }

        // do nothing if it is not our plugin
        if ($this->plugin_slug !== $args->slug) {
            return false;
        }

        // get updates
        $remote = $this->request();

        if (!$remote) {
            return false;
        }

        $res = new stdClass();

        $res->name = $remote->name;
        $res->slug = $remote->slug;
        $res->version = $remote->version;
        $res->tested = $remote->tested;
        $res->requires = $remote->requires;
        $res->author = $remote->author;
        $res->author_profile = $remote->author_profile;
        $res->download_link = $remote->download_url;
        $res->trunk = $remote->download_url;
        $res->requires_php = $remote->requires_php;
        $res->last_updated = $remote->last_updated;

        $res->sections = array(
            'description' => $remote->sections->description,
            'installation' => $remote->sections->installation,
            'changelog' => $remote->sections->changelog,
        );

        if (!empty($remote->banners)) {
            $res->banners = array(
                'low' => $remote->banners->low,
                'high' => $remote->banners->high,
            );
        }

        return $res;

    }

    public function update($transient)
    {

        if (empty($transient->checked)) {
            return $transient;
        }

        $remote = $this->request();

        if (
            $remote
            && version_compare(CMS_PORTAL_VERSION, $remote->version, '<')
            && version_compare($remote->requires, get_bloginfo('version'), '<')
            && version_compare($remote->requires_php, PHP_VERSION, '<')
        ) {
            $res = new stdClass();
            $res->slug = $this->plugin_slug;
            $res->plugin = $this->plugin_base_name; // swa-demo-bar/swa-demo-bar.php
            $res->new_version = $remote->version;
            $res->tested = $remote->tested;
            $res->package = $remote->download_url;

            $transient->response[$res->plugin] = $res;

        }

        return $transient;

    }

    public function purge()
    {

        if (
            CPT_CACHE_ALLOWED
            && 'update' === $options['action']
            && 'plugin' === $options['type']
        ) {
            // just clean the cache when new plugin version is installed
            delete_transient(CPT_SELF_CHECKING);
        }

    }

    public function disable_revslider_open_welcome_page()
    {
        delete_transient('_revslider_welcome_screen_activation_redirect');
    }

    public function disable_vc_open_welcome_page()
    {
        delete_transient('_vc_page_welcome_redirect');
    }

    public function disable_woo_variation_swatches_open_welcome_page()
    {
        delete_option('activate-woo-variation-swatches');
    }

    public function disable_newsletter_open_welcome_page()
    {
        delete_option('newsletter_show_welcome');
    }

    public function disable_booked_open_welcome_page()
    {
        delete_transient('_booked_welcome_screen_activation_redirect');
        delete_option('booked_welcome_screen');
    }

    public function disable_custom_post_type_ui_open_welcome_page()
    {
        delete_transient('cptui_activation_redirect');
    }

    public function disable_elementor_open_welcome_page()
    {
        delete_transient('elementor_activation_redirect');
    }
}

CMS_PORTAL::instance();