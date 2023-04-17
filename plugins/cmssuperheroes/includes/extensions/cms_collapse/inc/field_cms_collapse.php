<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('ReduxFramework_cms_collapse')) {
    class ReduxFramework_cms_collapse
    {
        public function __construct($field = array(), $value = array(), $parent)
        {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;
            $this->extension_url = cms_redux_extensions()->extensions_url . 'cms_collapse/';
        }

        public function render()
        {
            echo '<div id="' . $this->field['id'] . '" class="panel-group">';
            if (is_array($this->value)):
                foreach ($this->value as $key => $item): ?>
                    <div class="panel panel-primary" data-number="<?php echo $key; ?>">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse"
                                   href="#<?php echo $this->field['id'] . $key; ?>"><?php echo !empty($item[$this->field['fields'][0]['name']]) ? $item[$this->field['fields'][0]['name']] : 'Collapse Default'; ?></a>
                                <?php if (isset($this->field['add_button']) && $this->field['add_button'] === true): ?>
                                    <a class="delete-collapse dashicons dashicons-trash"></a>
                                <?php endif; ?>
                            </h4>
                        </div>
                        <div id="<?php echo $this->field['id'] . $key; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php foreach ($this->field['fields'] as $field): ?>
                                    <div class="panel-col-3">
                                        <label><b><?php echo $field['label']; ?></b></label>
                                    </div>
                                    <div class="panel-col-9">
                                        <?php
                                        $f_type = !empty($field['type']) ? $field['type'] : "text";
                                        switch ($f_type) {
                                            case "date_range":
                                                $date_from = $date_to = '';
                                                if(isset($item[$field['name']])){
                                                    $date_from = $item[$field['name']]['date_from'];
                                                    $date_to = $item[$field['name']]['date_to'];
                                                }
                                                ?>
                                                <input type="text"
                                                       name="<?php echo $this->field['name'] . $this->field['name_suffix'] . "[{$key}][{$field['name']}][date_from]"; ?>"
                                                       value="<?php echo $date_from; ?>"
                                                       class="datepicker date_from"
                                                       placeholder="From..."
                                                />
                                                <input type="text"
                                                       name="<?php echo $this->field['name'] . $this->field['name_suffix'] . "[{$key}][{$field['name']}][date_to]"; ?>"
                                                       value="<?php echo $date_to; ?>"
                                                       class="datepicker date_to"
                                                       placeholder="To..."
                                                />
                                                <?php
                                                break;
                                            case "date":
                                                ?>
                                                <input type="text"
                                                       name="<?php echo $this->field['name'] . $this->field['name_suffix'] . "[{$key}][{$field['name']}]"; ?>"
                                                       value="<?php echo isset($item[$field['name']]) ? $item[$field['name']] : '' ?>"
                                                       class="datepicker"
                                                />
                                                <?php
                                                break;
                                            case "textarea":
                                                ?>
                                                <textarea style="width: 100%;"
                                                          name="<?php echo $this->field['name'] . $this->field['name_suffix'] . "[{$key}][{$field['name']}]"; ?>"
                                                          cols="30" rows="10"><?php echo isset($item[$field['name']]) ? $item[$field['name']] : '' ?></textarea>
                                                <?php
                                                break;
                                            default:
                                                ?>
                                                <input type="text"
                                                       name="<?php echo $this->field['name'] . $this->field['name_suffix'] . "[{$key}][{$field['name']}]"; ?>"
                                                       value="<?php echo isset($item[$field['name']]) ? $item[$field['name']] : '' ?>">
                                                <?php
                                                break;
                                        }
                                        ?>
                                        <span class="description"><?php echo isset($field['description'])?$field['description']:''; ?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            endif;
            echo '</div>';
            if (isset($this->field['add_button']) && $this->field['add_button'] === true) {
                echo '<button type="button" class="button add-collapse" data-id="' . $this->field['id'] . '">' . esc_html__('Add new', 'rc-framework') . '</button>';
            }

        }

        public function enqueue()
        {
            if (!wp_style_is('cms_collapse_css')) {
                wp_enqueue_style(
                    'cms_collapse_css',
                    $this->extension_url . 'inc/field_cms_collapse.css',
                    array(),
                    time(),
                    'all'
                );
            }

            if (!wp_script_is('bootstrap_js')) {
                wp_enqueue_script(
                    'bootstrap_js',
                    $this->extension_url . 'inc/bootstrap.min.js',
                    array('jquery'),
                    time(),
                    true
                );
            }

            if (!wp_script_is('cms_collapse_js')) {
                wp_enqueue_script(
                    'cms_collapse_js',
                    $this->extension_url . 'inc/field_cms_collapse.js',
                    array('jquery'),
                    time(),
                    true
                );
            }
            global $cms_collapse;

            $cms_collapse[$this->field['id']] = array(
                'template' => $this->create_template(),
                'field' => $this->field
            );
            wp_localize_script('cms_collapse_js', 'cms_collapse', $cms_collapse);
        }

        public function create_template()
        {
            $template = '<div class="panel panel-primary" data-number="{{number}}"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" href="#{{id}}">{{title}}</a><a class="delete-collapse dashicons dashicons-trash"></a></h4></div><div id="{{id}}" class="panel-collapse collapse"><div class="panel-body">';
            if (is_array($this->field['fields'])) {
                foreach ($this->field['fields'] as $field):
                    $desc = isset($field['description'])?$field['description']:'';
                    $template .= '<div class="panel-col-3"><label><b>' . $field['label'] . '</b></label></div><div class="panel-col-9">';
                    $f_type = !empty($field['type']) ? $field['type'] : "text";
                    switch ($f_type) {
                        case "date_range":
                            $template .= '<input type="text" name="{{' . $field['name'] . '_date_from' . '}}" value="" class="datepicker date_from" placeholder="From..." />';
                            $template .= '<input type="text" name="{{' . $field['name'] . '_date_to' . '}}" value="" class="datepicker date_to" placeholder="To..." />';
                            break;
                        case "date":
                            $template .= '<input type="text" name="{{' . $field['name'] . '}}" value="" class="datepicker" />';
                            break;
                        case "textarea":
                            $template .= '<textarea style="width: 100%;" cols="100" rows="10" name="{{' . $field['name'] . '}}"></textarea>';
                            break;
                        default:
                            $template .= '<input type="text" name="{{' . $field['name'] . '}}" value="">';
                            break;
                    }
                    $template .= '<span class="description">'.$desc.'</span>';
                    $template .= '</div>';
                    $template .='<div class="clearfix"></div>';
                endforeach;
            }
            $template .= '</div></div></div>';

            return $template;
        }
    }
}