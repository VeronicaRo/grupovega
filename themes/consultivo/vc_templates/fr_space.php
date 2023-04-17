<?php
extract(shortcode_atts(array(
    'space_lg' => '',
    'space_md' => '',
    'space_sm' => '',
    'space_xs' => '',
), $atts));
$uqid = uniqid();

?>
<div id="fr-space-<?php echo esc_attr($uqid);?>">
    <style type="text/css">
        <?php if(!empty($space_lg)) { ?>
        @media screen and (min-width: 992px) {
            #fr-space-<?php echo esc_attr($uqid);?> .fr-space {
                height: <?php echo esc_attr($space_lg); ?>px;
            }
        }
        <?php } ?>

        <?php if(!empty($space_md)) { ?>
        @media (min-width: 768px) and (max-width: 991px) {
            #fr-space-<?php echo esc_attr($uqid);?> .fr-space {
                height: <?php echo esc_attr($space_md); ?>px;
            }
        }
        <?php } ?>
        <?php if(!empty($space_sm)) { ?>
        @media (min-width: 576px) and (max-width: 767px) {
            #fr-space-<?php echo esc_attr($uqid);?> .fr-space {
                height: <?php echo esc_attr($space_sm); ?>px;
            }
        }
        <?php } ?>
        <?php if(!empty($space_xs)) { ?>
        @media screen and (max-width: 575px) {
            #fr-space-<?php echo esc_attr($uqid);?> .fr-space {
                height: <?php echo esc_attr($space_xs); ?>px;
            }
        }
        <?php } ?>
    </style>
    <div class="fr-space"></div>
</div>