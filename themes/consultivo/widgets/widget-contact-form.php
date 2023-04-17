<?php
class CMS_Contact_Form_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'cms_contact_form_widget',
            esc_html__('CMS Contact Form', 'consultivo'),
            array('description' => esc_html__('Contact Form Widget', 'consultivo'),)
        );
    }

    function widget($args, $instance) {

        extract($args);

        $title = isset($instance['title']) ? (!empty($instance['title']) ? $instance['title']: '') : '';
        $text = isset($instance['text']) ? (!empty($instance['text']) ? $instance['text']: '') : '';
        $contact_form_id = isset($instance['contact_form_id']) ? (!empty($instance['contact_form_id']) ? $instance['contact_form_id']: '') : '';
        ?>

        <?php if(!empty($title)) : ?>
            <div class="cms-contact-form-layout-1 widget">
                <?php if(!empty($title)) : ?>
                    <h3 class="footer-widget-title"><?php echo esc_attr($title); ?></h3>
                <?php endif; ?>
                <?php if(!empty($text)) : ?>
                    <p class="form-text"><?php echo esc_attr($text); ?></p>
                <?php endif; ?>
                <div class="cms-contact-info-inner">
                    <?php
                        if(class_exists('WPCF7') && $contact_form_id) {
                            echo do_shortcode('[contact-form-7 id="' . esc_attr($contact_form_id) . '"]');
                        }
                    ?>
                </div>
            </div>
        <?php endif; }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['text'] = strip_tags($new_instance['text']);
        $instance['contact_form_id'] = strip_tags($new_instance['contact_form_id']);

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $text = isset($instance['text']) ? esc_attr($instance['text']) : '';
        $form_id = isset($instance['contact_form_id']) ? esc_attr($instance['contact_form_id']) : '';
        $contact_forms = consultivo_get_contact_form();
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title', 'consultivo' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e( 'Text', 'consultivo' ); ?></label>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo esc_attr( $this->get_field_id('text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text') ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('contact_form_id')); ?>"><?php esc_html_e( 'Contact form', 'consultivo' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id('contact_form_id') ); ?>" style="width: 100%" name="<?php echo esc_attr( $this->get_field_name('contact_form_id') ); ?>">
                <?php  foreach ($contact_forms as $key => $value):?>
                    <option value="<?php echo esc_attr($key);?>" <?php if($key == $form_id): echo 'selected="selected"'; endif;?>><?php echo esc_attr($value);?></option>
                <?php endforeach;?>
            </select>
        </p>

        <?php
    }

}
function register_contact_form_widget()
{
    global $wp_widget_factory;
    $wp_widget_factory->register('CMS_Contact_Form_Widget');
}

add_action('widgets_init', 'register_contact_form_widget');
