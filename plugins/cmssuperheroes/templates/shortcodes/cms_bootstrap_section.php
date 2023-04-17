<?php
/**
 * @Template: cms_bootstrap_section.php
 * @since: 1.0.0
 * @author: KP
 * @descriptions:
 * @create: 10-Aug-18
 */
global $cms_bootstrap_tabs;
$section_active = ($cms_bootstrap_tabs['tab-index'] == $cms_bootstrap_tabs['tab-active'])  ? 'active' : '';
$id = 'tab-' . $cms_bootstrap_tabs['tab-index'] . '-'.time().rand(100,999);
extract(shortcode_atts(array(
	'title' => 'Tab title',
), $atts));
?>
	<li role="presentation" class="<?php echo esc_attr($section_active); ?>">
		<a href="#<?php echo esc_attr($id); ?>" aria-controls="<?php echo esc_attr($id); ?>" role="tab" data-toggle="tab">
			<?php echo esc_html($atts['title']); ?>
		</a>
	</li>
<?php
$cms_bootstrap_tabs['tab-content'] .= '<div role="tabpanel" class="tab-pane '.$section_active.'" id="'.esc_attr($id).'">'.do_shortcode($contents).'</div>';
$cms_bootstrap_tabs['tab-index']++;
