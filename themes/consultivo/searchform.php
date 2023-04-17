<?php
/**
 * Search Form
 */
$search_field_placeholder = consultivo_get_opt( 'search_field_placeholder' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div class="searchform-wrap">
        <input type="text" placeholder="<?php if(!empty($search_field_placeholder)) { echo esc_attr( $search_field_placeholder ); } else { esc_html_e('Search...', 'consultivo'); } ?>" name="s" class="search-field" />
    	<?php //if($sidebar_style == 'conversion') : ?>
            <button type="submit" id="searchsubmit"><i class="fa fa-search"></i> </button>
    	<?php //endif; ?>
    </div>
</form>