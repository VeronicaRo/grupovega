<?php
/**
 * @Template: cms_bootstrap_tabs.php
 * @since: 1.0.0
 * @author: KP
 * @descriptions:
 * @create: 07-Aug-18
 */
global $cms_bootstrap_tabs;
extract( shortcode_atts( array(
	'position' => 'top-left',
), $atts ) );
?>
<div class="cms-bootstrap-tabs">
    <ul class="nav nav-tabs <?php echo esc_attr( $position ); ?>" role="tablist">
	    <?php echo do_shortcode($contents); ?>
    </ul><!-- Nav tabs -->
    <div class="tab-content">
	    <?php echo $cms_bootstrap_tabs['tab-content']; ?>
    </div><!-- Tab panes -->
</div>


