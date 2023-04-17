<?php
/**
 * @Template: input.php
 * @since: 1.0.0
 * @author: KP
 * @descriptions:
 * @create: 21-Sep-18
 */
?>
<input type="text"
       name="<?php echo $this->field['name'] . $this->field['name_suffix'] . "[{$key}][{$field['name']}]"; ?>"
       value="<?php echo isset($item[$field['name']]) ? $item[$field['name']] : '' ?>">
