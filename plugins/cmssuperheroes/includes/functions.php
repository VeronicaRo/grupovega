<?php

global $cms_html_id;

if (empty($cms_html_id)) {
    $cms_html_id = array();
}
/**
 * Require libraries if needed.
 *
 * @access public
 *
 */
function cmsResizeLib()
{
    //check if lib exists
    if (!function_exists('mr_image_resize')) {
        require_once(CMS_LIBRARIES . 'mr-image-resize.php');
    }
    return;
}

function cmsGetCategoriesByPostID($post_ID = null, $taxo = 'category')
{
    $term_cats = array();
    $categories = get_the_terms($post_ID, $taxo);
    if ($categories) {
        foreach ($categories as $category) {
            $term_cats[] = get_term($category, $taxo);
        }
    }
    return $term_cats;
}

/**
 * Generator unique html id
 * @param type $id : string
 */
if (!function_exists("cmsHtmlID")) {
    function cmsHtmlID($id)
    {
        global $cms_html_id;
        $id = str_replace(array('_'), '-', $id);
        if (isset($cms_html_id[$id])) {
            $count = count($cms_html_id[$id]);
            $cms_html_id[$id][$count] = 1;
            $count++;
            return $id . '-' . $count;
        } else {
            $cms_html_id[$id] = array(1);
            return $id;
        }
    }
}

function cmsFileScanDirectory($dir, $mask, $options = array(), $depth = 0)
{
    $options += array(
        'nomask' => '/(\.\.?|CSV)$/',
        'callback' => 0,
        'recurse' => TRUE,
        'key' => 'uri',
        'min_depth' => 0,
    );

    $options['key'] = in_array($options['key'], array('uri', 'filename', 'name')) ? $options['key'] : 'uri';
    $files = array();
    if (is_dir($dir) && $handle = opendir($dir)) {
        while (FALSE !== ($filename = readdir($handle))) {
            if (!preg_match($options['nomask'], $filename) && $filename[0] != '.') {
                $uri = "$dir/$filename";
                if (is_dir($uri) && $options['recurse']) {
                    // Give priority to files in this folder by merging them in after any subdirectory files.
                    $files = array_merge(cmsFileScanDirectory($uri, $mask, $options, $depth + 1), $files);
                } elseif ($depth >= $options['min_depth'] && preg_match($mask, $filename)) {
                    // Always use this match over anything already set in $files with the
                    // same $$options['key'].
                    $file = new stdClass();
                    $file->uri = $uri;
                    $file->filename = $filename;
                    $file->name = pathinfo($filename, PATHINFO_FILENAME);
                    $files[$filename] = $file;
                }
            }
        }
        closedir($handle);
    }
    return $files;
}

function cms_require_folder($foldername, $path)
{
    $dir = $path . DIRECTORY_SEPARATOR . $foldername;
    if (!is_dir($dir)) {
        return;
    }
    $files = array_diff(scandir($dir), array('..', '.'));
    foreach ($files as $file) {
        $patch = $dir . DIRECTORY_SEPARATOR . $file;
        if (file_exists($patch) && strpos($file, ".php") !== false) {
            include_once $patch;
        }
    }
}

function cms_require_once_folder($foldername, $path)
{
    $dir = $path . DIRECTORY_SEPARATOR . $foldername;
    if (!is_dir($dir)) {
        return;
    }
    $files = array_diff(scandir($dir), array('..', '.'));
    foreach ($files as $file) {
        $patch = $dir . DIRECTORY_SEPARATOR . $file;
        if (file_exists($patch) && strpos($file, ".php") !== false) {
            require_once $patch;
        }
    }
}

function cms_get_template_file__($template, $data = array())
{
    extract($data);
    $template_file = cms_get_template_file($template);
    if ($template_file !== false) {
        ob_start();
        include $template_file;
        return ob_get_clean();
    }
    return false;
}

function cms_get_template_file($template, $dir = null)
{

    if ($dir === null) {
        $dir = 'vc_templates';
    }

    $template_file = get_template_directory() . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $template;

    if (file_exists($template_file)) {
        return $template_file;
    } else {
        $template_file = cmssuperheroes()->path('APP_DIR', 'templates/shortcodes') . DIRECTORY_SEPARATOR . $template;
        if (file_exists($template_file)) {
            return $template_file;
        }
    }
    return false;
}

function cms_do_the_content($content, $autop = true)
{

    if ($autop) {
        $content = wpautop(preg_replace('/<\/?p\>/', "\n", $content) . "\n");
    }

    return do_shortcode(shortcode_unautop($content));
}

function cms_inline_css($css)
{
    $css = str_replace("\"", "'", $css);
    echo '<div class="cms-inline-css" style="display:none" data-css="' . $css . '"></div>';
}

function cms_move_to_head($content)
{
    $content = str_replace("\"", "'", $content);
    echo '<div class="cms-ct-to-head" style="display:none" data-ct="' . $content . '"></div>';
}

function cms_allow_embed($content)
{
    echo do_shortcode($content);
}

function cms_allow_html($content)
{
    echo $content;
}

function cms_allow_RegisterWidget($class)
{
    register_widget($class);
}

function register_cms_widget($class)
{
    register_widget($class);
}

function cms_mail($to, $subject, $message, $headers = '', $attachments = array())
{
    return wp_mail($to, $subject, $message, $headers, $attachments);
}

function cms_crop_images()
{
    $query = array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'post_status' => 'inherit',
    );

    $media = new WP_Query($query);
    if ($media->have_posts()) {
        foreach ($media->posts as $image) {
            if (strpos($image->post_mime_type, 'image/') !== false) {
                $image_path = get_attached_file($image->ID);
                $metadata = wp_generate_attachment_metadata($image->ID, $image_path);
                wp_update_attachment_metadata($image->ID, $metadata);
            }
        }
    }
}

function cms_vc_param_shortcode($name, $call_back_function, $script)
{
    if (function_exists('vc_add_shortcode_param')) {
        vc_add_shortcode_param($name, $call_back_function, $script);
    }
}

/**
 * Added by NoName
 * Added for fix Envato Theme Check
 */
function cms_html_output($html)
{
    echo $html;
}

function cms_xoa_filter($tag, $function_to_remove, $priority)
{
    global $wp_filter;
    $r = false;
    if (isset($wp_filter[$tag])) {
        $r = $wp_filter[$tag]->remove_filter($tag, $function_to_remove, $priority);
        if (!$wp_filter[$tag]->callbacks) {
            unset($wp_filter[$tag]);
        }
    }
    return $r;
}

/**
 * use this instead base64_encode
 */
function cms_base64_mahoa($args)
{
    return base64_encode($args);
}

/**
 * use this instead base64_decode
 */
function cms_base64_giaima($args)
{
    return base64_decode($args);
}

/**
 * use this instead add_meta_box
 */
function cms_them_meta_box($id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null)
{
    global $wp_meta_boxes;

    if (empty($screen)) {
        $screen = get_current_screen();
    } elseif (is_string($screen)) {
        $screen = convert_to_screen($screen);
    } elseif (is_array($screen)) {
        foreach ($screen as $single_screen) {
            add_meta_box($id, $title, $callback, $single_screen, $context, $priority, $callback_args);
        }
    }

    if (!isset($screen->id)) {
        return;
    }

    $page = $screen->id;

    if (!isset($wp_meta_boxes))
        $wp_meta_boxes = array();
    if (!isset($wp_meta_boxes[$page]))
        $wp_meta_boxes[$page] = array();
    if (!isset($wp_meta_boxes[$page][$context]))
        $wp_meta_boxes[$page][$context] = array();

    foreach (array_keys($wp_meta_boxes[$page]) as $a_context) {
        foreach (array('high', 'core', 'default', 'low') as $a_priority) {
            if (!isset($wp_meta_boxes[$page][$a_context][$a_priority][$id]))
                continue;

            // If a core box was previously added or removed by a plugin, don't add.
            if ('core' == $priority) {
                // If core box previously deleted, don't add
                if (false === $wp_meta_boxes[$page][$a_context][$a_priority][$id])
                    return;

                /*
                 * If box was added with default priority, give it core priority to
                 * maintain sort order.
                 */
                if ('default' == $a_priority) {
                    $wp_meta_boxes[$page][$a_context]['core'][$id] = $wp_meta_boxes[$page][$a_context]['default'][$id];
                    unset($wp_meta_boxes[$page][$a_context]['default'][$id]);
                }
                return;
            }
            // If no priority given and id already present, use existing priority.
            if (empty($priority)) {
                $priority = $a_priority;
                /*
                 * Else, if we're adding to the sorted priority, we don't know the title
                 * or callback. Grab them from the previously added context/priority.
                 */
            } elseif ('sorted' == $priority) {
                $title = $wp_meta_boxes[$page][$a_context][$a_priority][$id]['title'];
                $callback = $wp_meta_boxes[$page][$a_context][$a_priority][$id]['callback'];
                $callback_args = $wp_meta_boxes[$page][$a_context][$a_priority][$id]['args'];
            }
            // An id can be in only one priority and one context.
            if ($priority != $a_priority || $context != $a_context)
                unset($wp_meta_boxes[$page][$a_context][$a_priority][$id]);
        }
    }

    if (empty($priority))
        $priority = 'low';

    if (!isset($wp_meta_boxes[$page][$context][$priority]))
        $wp_meta_boxes[$page][$context][$priority] = array();

    $wp_meta_boxes[$page][$context][$priority][$id] = array('id' => $id, 'title' => $title, 'callback' => $callback, 'args' => $callback_args);
}

/**
 * Add Shortcode
 * use instead add_shortcode
 */
function cms_them_shortcode($tag, $callback)
{
    global $shortcode_tags;
    if ('' == trim($tag)) {
        $message = __('Invalid shortcode name: Empty name given.');
        _doing_it_wrong(__FUNCTION__, $message, '4.4.0');
        return;
    }

    if (0 !== preg_match('@[<>&/\[\]\x00-\x20=]@', $tag)) {
        /* translators: 1: shortcode name, 2: space separated list of reserved characters */
        $message = sprintf(__('Invalid shortcode name: %1$s. Do not use spaces or reserved characters: %2$s'), $tag, '& / < > [ ] =');
        _doing_it_wrong(__FUNCTION__, $message, '4.4.0');
        return;
    }
    $shortcode_tags[$tag] = $callback;
}


/**
 * Custom VC
 */

cms_require_once_folder('VCModify/include/classes', CMS_INCLUDES);
cms_require_once_folder('VCModify/include/helper', CMS_INCLUDES);
cms_require_once_folder('VCModify/include/modify', CMS_INCLUDES);

/**
 * Dequeue some script/ style from 3rd plugin.
 *
 * Hooked to the wp_enqueue_scripts action, with a late priority (100),
 * so that it is after the script was enqueued.
 *
 */
add_action('wp_enqueue_scripts', 'cms_remove_scripts', 999);
function cms_remove_scripts($scripts = [])
{
    $scripts = apply_filters('cms_remove_scripts', $scripts);
    if (empty($scripts)) return;
    foreach ($scripts as $script) {
        wp_dequeue_script($script);
        wp_deregister_script($script);
    }
}

add_action('wp_enqueue_scripts', 'cms_remove_styles', 999);
function cms_remove_styles($styles = [])
{
    $styles = apply_filters('cms_remove_styles', $styles);
    if (empty($styles)) return;
    foreach ($styles as $style) {
        wp_dequeue_style($style);
        wp_deregister_style($style);
    }
}

add_action('admin_enqueue_scripts', 'cms_remove_admin_styles', 999);
function cms_remove_admin_styles()
{
    $styles = apply_filters('cms_remove_admin_styles', []);
    if (empty($styles)) return;
    foreach ($styles as $style) {
        wp_dequeue_style($style);
        wp_deregister_style($style);
    }
}

/**
 * remove type css/js/ version
 * need for w3c validator
 */
/* remove version */
if (!function_exists('cms_remove_script_version')) {
    function cms_remove_script_version($src)
    {
        $parts = explode('?ver', $src);
        return $parts[0];
    }

    add_filter('script_loader_src', 'cms_remove_script_version', 15, 1);
    add_filter('style_loader_src', 'cms_remove_script_version', 15, 1);
}
/**
 * W3C Validator
 * remove script, style  TYPE attribute
 */
if (!function_exists('cms_remove_type_attr')) {
    //add_filter('style_loader_tag', 'cms_remove_type_attr', 10, 2);
    //add_filter('script_loader_tag', 'cms_remove_type_attr', 10, 2);
    function cms_remove_type_attr($tag, $handle)
    {
        return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
    }
}
if (!function_exists('cms_rev_remove_type_attr')) {
    //add_filter('revslider_add_setREVStartSize', 'cms_rev_remove_type_attr', 10, 2);
    function cms_rev_remove_type_attr($tag)
    {
        return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
    }
}
/**
 * Remove auto p before shortcode
 */
function cms_shortcode_empty_paragraph_fix($content)
{
    $array = array(
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}

/* End Added by NoName */

if (!function_exists('cms_post_views')) {
    function cms_post_views($post_ID)
    {
        //Set the name of the Posts Custom Field.
        $count_key = 'post_views_count';
        //Returns values of the custom field with the specified key from the specified post.
        $count = get_post_meta($post_ID, $count_key, true);
        $count = $count ? intval($count) : 0;
        if (is_single()) {
            $count++;
            update_post_meta($post_ID, $count_key, $count);
        }
        return $count;
    }
}