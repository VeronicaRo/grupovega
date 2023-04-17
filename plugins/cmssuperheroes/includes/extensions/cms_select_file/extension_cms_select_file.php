<?php
/**
 * @Template: extension_cms_datetime.php
 * @since: 1.0.0
 * @author: KP
 * @descriptions:
 * @create: 23-Dec-17
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('CMS_Redux_Extensions_cms_select_file')) {

    class CMS_Redux_Extensions_cms_select_file
    {

        protected $parent;
        public $extension_url;
        public $extension_dir;
        public static $theInstance;
        public static $version = "1.0.0";
        public $is_field = false;

        public function __construct($parent)
        {
            $this->parent = $parent;
            $this->field_name = 'cms_select_file';

            self::$theInstance = $this;

            $this->is_field = Redux_Helpers::isFieldInUse($parent, $this->field_name);

            add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array(
                $this,
                'overload_field_path'
            ));
        }

        public function overload_field_path($field)
        {
            return dirname(__FILE__) . '/inc/field_' . $this->field_name . '.php';
        }
    }
}

// Add Extra Media Type Filters to the WordPress Media Manager
function cms_post_mime_types( $post_mime_types ) {
    // select the mime type, here: 'application/pdf'
    // then we define an array with the label values
    $post_mime_types['application/pdf'] = array( 
        __( 'PDFs', 'cmssuperheroes' ), 
        __( 'Manage PDFs' , 'cmssuperheroes'), 
        _n_noop( 'PDF <span class="count">(%s)</span>', 
        'PDFs <span class="count">(%s)</span>' )
    );
    $post_mime_types['application/zip'] = array( 
        __( 'ZIPs', 'cmssuperheroes' ), 
        __( 'Manage ZIPs' , 'cmssuperheroes'), 
        _n_noop( 'ZIP <span class="count">(%s)</span>', 
        'ZIPs <span class="count">(%s)</span>' )
    );
    // then we return the $post_mime_types variable
    return $post_mime_types;
}
 
// Add Filter Hook
add_filter( 'post_mime_types', 'cms_post_mime_types' );
