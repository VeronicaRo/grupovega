<?php
extract(shortcode_atts(array(
    'title' => 'All Services',
    'service_page' => '',
    'number' => '6'
),$atts));
$services = consultivo_get_services();
$i = 1;
$link = vc_build_link($service_page);
$a_href = '';
if ( strlen( $link['url'] ) > 0 ) {
    $a_href = $link['url'];
}
?>
<div class="list-services widget widget_categories">
    <ul>
        <li class="cat-item"><a href="<?php echo esc_url($a_href);?>"><?php echo esc_html($title);?></a></li>
        <?php foreach ($services as $key => $title){?>
            <li class="cat-item <?php if(get_the_ID() == $key){ echo 'active'; }?>"><a href="<?php echo esc_url(get_permalink($key));?>"><?php echo esc_attr(get_the_title($key));?></a></li>
            <?php if($i == $number){break;}else{$i++;} ?>
        <?php } ?>
    </ul>
</div>
