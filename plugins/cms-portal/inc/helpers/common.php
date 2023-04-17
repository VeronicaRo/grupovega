<?php
if (!function_exists('cpt_generate_protected_code')) {
    function cpt_generate_protected_code($length = 11)
    {
        return strtoupper(substr(md5(uniqid(mt_rand(), true) . ':' . microtime(true)), 5, $length));
    }
}

if (!function_exists('cpt_generate_slug')) {
    function cpt_generate_slug($str, $delimiter = '-')
    {
        $str = trim($str);
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;
    }
}

if (!function_exists('cpt_get_server_url')) {
    function cpt_get_server_url()
    {
        $theme = wp_get_theme();
        $author = strtolower($theme->get('Author'));
        $server_url = '';
        switch ($author) {
            case 'cmssuperheroes':
                $server_url = CPT_SERVER_URL;
                break;
            case 'farost':
                $server_url = CPT_FAROST_SERVER_URL;
                break;
            case '7oroof':
                $server_url = CPT_7OROOF_SERVER_URL;
                break;
            default:
                $server_url = CPT_SERVER_URL;
        }

        return $server_url;
    }
}
?>