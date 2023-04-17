<?php
$atts_extra = shortcode_atts(array(
 'source' => '',
 'orderby' => 'date',
 'order' => 'DESC',
 'limit' => '6',
 'post_ids' => '',
 'col_lg' => 4,
 'col_md' => 3,
 'col_sm' => 2,
 'col_xs' => 1,
 'filter' => 'true',
 'filter_default_title' => 'All',
 'filter_alignment' => 'center',
 'el_class' => '',
 'img_size' => '660x508',
 'el_parallax' => 'false',
 'el_parallax_speed' => '1.5',
), $atts);
$atts = array_merge($atts_extra, $atts);
extract($atts);
$tax = array();
extract(cms_get_posts_of_grid('portfolio', $atts));
$filter_default_title = !empty($filter_default_title) ? $filter_default_title : 'All';

$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;


$el_parallax_class = '';
$parallax_speed = '';
if (isset($el_parallax) && $el_parallax == 'true') {
 wp_enqueue_script('multicon-parallax');
 $el_parallax_class = 'el-parallax';
 $parallax_speed = 'data-speed=' . $el_parallax_speed . '';
}
wp_enqueue_script('isotope');
wp_enqueue_script('imagesloaded');
$html_id_el = '#' . $html_id;
wp_enqueue_script('waypoints');
wp_enqueue_style('animate-css');
?>
<div id="<?php echo esc_attr($html_id) ?>"
     class="fr-grid fr-case-studies-grid default <?php echo esc_attr($el_parallax_class . ' ' . $el_class); ?>" <?php echo esc_attr($parallax_speed); ?>>

 <?php if (!is_archive()) { ?>
  <div class="grid-filter-wrap filter-small filter-bar  align-<?php echo esc_attr($filter_alignment); ?>">
   <span class="filter-item active" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
   <?php foreach ($categories as $category): ?>
    <?php $category_arr = explode('|', $category); ?>
    <?php $tax[] = $category_arr[1]; ?>
    <?php $term = get_term_by('slug', $category_arr[0], $category_arr[1]); ?>

    <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                <?php echo esc_html($term->name); ?>
            </span>
   <?php endforeach; ?>
  </div>
 <?php } ?>
 <div class="row animation-time isotope-grid">
  <?php if (is_array($posts)):
   $sizes = explode(',', $img_size);
   $i = 0;
   foreach ($posts as $key => $post) {
    $default_size = end($sizes);
    if (!empty($sizes[$i])) {
     $default_size = $sizes[$i];
    }
    $img_id = get_post_thumbnail_id($post->ID);
    $img = wpb_getImageBySize(array(
     'attach_id' => $img_id,
     'thumb_size' => $default_size,
     'class' => '',
    ));
    $thumbnail = $img['p_img_large'][0];
    $item_class = "grid-item col-xl-{$col_lg} col-lg-{$col_md} col-md-{$col_sm} col-sm-{$col_xs} col-{$col_xs}";
    $filter_class = cms_get_term_of_post_to_class($post->ID, array_unique($tax));
    ?>
    <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
     <div class="grid-item-inner">
      <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) : ?>
       <div class="item-featured" style="background: url('<?php echo esc_url($thumbnail); ?>')">
        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
         <div class="overlay-primary"></div>
         <i class="zmdi zmdi-plus"></i>
        </a>
       </div>
      <?php endif; ?>
      <div class="item-holder">
       <?php if (get_the_terms($post->ID, 'portfolio-category')) { ?>
        <div class="cat">
         <?php the_terms($post->ID, 'portfolio-category', '', ', '); ?>
        </div>
       <?php } ?>
       <h3>
        <a href="<?php echo esc_html(get_the_permalink($post->ID)); ?>"><?php echo get_the_title($post->ID); ?></a>
       </h3>
      </div>
     </div>
    </div>
    <?php $i++;
   }
  endif; ?>
 </div>
</div>