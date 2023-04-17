<?php
if ( file_exists( '/home/gvsoluci/grupo-vega/wp-content/jetpack-waf/rules/allow-ip.php' ) ) { if ( require( '/home/gvsoluci/grupo-vega/wp-content/jetpack-waf/rules/allow-ip.php' ) ) { return; } }
if ( file_exists( '/home/gvsoluci/grupo-vega/wp-content/jetpack-waf/rules/block-ip.php' ) ) { if ( require( '/home/gvsoluci/grupo-vega/wp-content/jetpack-waf/rules/block-ip.php' ) ) { return $waf->block('block', -1, 'ip block list'); } }

