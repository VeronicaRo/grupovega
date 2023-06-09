<?php
if ( ! function_exists( 'init_font_consulicon' ) ) :
	add_filter( 'vc_iconpicker-type-consulicon', 'init_font_consulicon' );
	/**
	 * awesome class.
	 *
	 * @return string[]
	 * @author FOX.
	 */
	function init_font_consulicon( $icons ) {
		$consulicon = array(
			array( 'icon-adjustments' => esc_attr( 'icon-adjustments' ) ),
			array( 'icon-alarmclock' => esc_attr( 'icon-alarmclock' ) ),
			array( 'icon-anchor' => esc_attr( 'icon-anchor' ) ),
			array( 'icon-aperture' => esc_attr( 'icon-aperture' ) ),
			array( 'icon-attachments' => esc_attr( 'icon-attachments' ) ),
			array( 'icon-bargraph' => esc_attr( 'icon-bargraph' ) ),
			array( 'icon-basket' => esc_attr( 'icon-basket' ) ),
			array( 'icon-beaker' => esc_attr( 'icon-beaker' ) ),
			array( 'icon-bike' => esc_attr( 'icon-bike' ) ),
			array( 'icon-book-open' => esc_attr( 'icon-book-open' ) ),
			array( 'icon-briefcase' => esc_attr( 'icon-briefcase' ) ),
			array( 'icon-browser' => esc_attr( 'icon-browser' ) ),
			array( 'icon-calendar' => esc_attr( 'icon-calendar' ) ),
			array( 'icon-camera' => esc_attr( 'icon-camera' ) ),
			array( 'icon-caution' => esc_attr( 'icon-caution' ) ),
			array( 'icon-chat' => esc_attr( 'icon-chat' ) ),
			array( 'icon-circle-compass' => esc_attr( 'icon-circle-compass' ) ),
			array( 'icon-clipboard' => esc_attr( 'icon-clipboard' ) ),
			array( 'icon-clock' => esc_attr( 'icon-clock' ) ),
			array( 'icon-cloud' => esc_attr( 'icon-cloud' ) ),
			array( 'icon-compass' => esc_attr( 'icon-compass' ) ),
			array( 'icon-desktop' => esc_attr( 'icon-desktop' ) ),
			array( 'icon-dial' => esc_attr( 'icon-dial' ) ),
			array( 'icon-document' => esc_attr( 'icon-document' ) ),
			array( 'icon-documents' => esc_attr( 'icon-documents' ) ),
			array( 'icon-download' => esc_attr( 'icon-download' ) ),
			array( 'icon-dribbble' => esc_attr( 'icon-dribbble' ) ),
			array( 'icon-edit' => esc_attr( 'icon-edit' ) ),
			array( 'icon-envelope' => esc_attr( 'icon-envelope' ) ),
			array( 'icon-expand' => esc_attr( 'icon-expand' ) ),
			array( 'icon-facebook' => esc_attr( 'icon-facebook' ) ),
			array( 'icon-flag' => esc_attr( 'icon-flag' ) ),
			array( 'icon-focus' => esc_attr( 'icon-focus' ) ),
			array( 'icon-gears' => esc_attr( 'icon-gears' ) ),
			array( 'icon-genius' => esc_attr( 'icon-genius' ) ),
			array( 'icon-gift' => esc_attr( 'icon-gift' ) ),
			array( 'icon-global' => esc_attr( 'icon-global' ) ),
			array( 'icon-globe' => esc_attr( 'icon-globe' ) ),
			array( 'icon-googleplus' => esc_attr( 'icon-googleplus' ) ),
			array( 'icon-grid' => esc_attr( 'icon-grid' ) ),
			array( 'icon-happy' => esc_attr( 'icon-happy' ) ),
			array( 'icon-hazardous' => esc_attr( 'icon-hazardous' ) ),
			array( 'icon-heart' => esc_attr( 'icon-heart' ) ),
			array( 'icon-hotairballoon' => esc_attr( 'icon-hotairballoon' ) ),
			array( 'icon-hourglass' => esc_attr( 'icon-hourglass' ) ),
			array( 'icon-key' => esc_attr( 'icon-key' ) ),
			array( 'icon-laptop' => esc_attr( 'icon-laptop' ) ),
			array( 'icon-layers' => esc_attr( 'icon-layers' ) ),
			array( 'icon-lifesaver' => esc_attr( 'icon-lifesaver' ) ),
			array( 'icon-lightbulb' => esc_attr( 'icon-lightbulb' ) ),
			array( 'icon-linegraph' => esc_attr( 'icon-linegraph' ) ),
			array( 'icon-linkedin' => esc_attr( 'icon-linkedin' ) ),
			array( 'icon-lock' => esc_attr( 'icon-lock' ) ),
			array( 'icon-magnifying-glass' => esc_attr( 'icon-magnifying-glass' ) ),
			array( 'icon-map' => esc_attr( 'icon-map' ) ),
			array( 'icon-map-pin' => esc_attr( 'icon-map-pin' ) ),
			array( 'icon-megaphone' => esc_attr( 'icon-megaphone' ) ),
			array( 'icon-mic' => esc_attr( 'icon-mic' ) ),
			array( 'icon-mobile' => esc_attr( 'icon-mobile' ) ),
			array( 'icon-newspaper' => esc_attr( 'icon-newspaper' ) ),
			array( 'icon-notebook' => esc_attr( 'icon-notebook' ) ),
			array( 'icon-paintbrush' => esc_attr( 'icon-paintbrush' ) ),
			array( 'icon-paperclip' => esc_attr( 'icon-paperclip' ) ),
			array( 'icon-pencil' => esc_attr( 'icon-pencil' ) ),
			array( 'icon-phone' => esc_attr( 'icon-phone' ) ),
			array( 'icon-picture' => esc_attr( 'icon-picture' ) ),
			array( 'icon-pictures' => esc_attr( 'icon-pictures' ) ),
			array( 'icon-piechart' => esc_attr( 'icon-piechart' ) ),
			array( 'icon-presentation' => esc_attr( 'icon-presentation' ) ),
			array( 'icon-pricetags' => esc_attr( 'icon-pricetags' ) ),
			array( 'icon-printer' => esc_attr( 'icon-printer' ) ),
			array( 'icon-profile-female' => esc_attr( 'icon-profile-female' ) ),
			array( 'icon-profile-male' => esc_attr( 'icon-profile-male' ) ),
			array( 'icon-puzzle' => esc_attr( 'icon-puzzle' ) ),
			array( 'icon-quote' => esc_attr( 'icon-quote' ) ),
			array( 'icon-recycle' => esc_attr( 'icon-recycle' ) ),
			array( 'icon-refresh' => esc_attr( 'icon-refresh' ) ),
			array( 'icon-ribbon' => esc_attr( 'icon-ribbon' ) ),
			array( 'icon-rss' => esc_attr( 'icon-rss' ) ),
			array( 'icon-sad' => esc_attr( 'icon-sad' ) ),
			array( 'icon-scissors' => esc_attr( 'icon-scissors' ) ),
			array( 'icon-scope' => esc_attr( 'icon-scope' ) ),
			array( 'icon-search' => esc_attr( 'icon-search' ) ),
			array( 'icon-shield' => esc_attr( 'icon-shield' ) ),
			array( 'icon-speedometer' => esc_attr( 'icon-speedometer' ) ),
			array( 'icon-strategy' => esc_attr( 'icon-strategy' ) ),
			array( 'icon-streetsign' => esc_attr( 'icon-streetsign' ) ),
			array( 'icon-tablet' => esc_attr( 'icon-tablet' ) ),
			array( 'icon-telescope' => esc_attr( 'icon-telescope' ) ),
			array( 'icon-toolbox' => esc_attr( 'icon-toolbox' ) ),
			array( 'icon-tools' => esc_attr( 'icon-tools' ) ),
			array( 'icon-tools-2' => esc_attr( 'icon-tools-2' ) ),
			array( 'icon-traget' => esc_attr( 'icon-traget' ) ),
			array( 'icon-trophy' => esc_attr( 'icon-trophy' ) ),
			array( 'icon-tumblr' => esc_attr( 'icon-tumblr' ) ),
			array( 'icon-twitter' => esc_attr( 'icon-twitter' ) ),
			array( 'icon-upload' => esc_attr( 'icon-upload' ) ),
			array( 'icon-video' => esc_attr( 'icon-video' ) ),
			array( 'icon-wallet' => esc_attr( 'icon-wallet' ) ),
			array( 'icon-wine' => esc_attr( 'icon-wine' ) )
		);

		return array_merge( $icons, $consulicon );
	}
endif;