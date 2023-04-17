<?php
/**
 * @Template: cms_bootstrap_tabs.php
 * @since: 1.0.0
 * @author: KP
 * @descriptions:
 * @create: 07-Aug-18
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CMS_Bootstrap_Tabs' ) ) {
	class CMS_Bootstrap_Tabs {
		public function __construct() {
			add_action( 'init', array( $this, 'add_shortcode' ) );
			add_action( 'vc_before_init', array( $this, 'add_param' ) );
		}

		function add_shortcode() {
			$enable_bootstrap_tabs = apply_filters( 'enable_cms_bootstrap_tabs', false );
			if ( $enable_bootstrap_tabs ) {
				add_shortcode( 'cms_bootstrap_tabs', array( $this, 'add_shortcode_cms_bootstrap_tabs' ) );
				add_shortcode( 'cms_bootstrap_section', array( $this, 'add_shortcode_cms_bootstrap_section' ) );
			}
		}

		function add_shortcode_cms_bootstrap_tabs( $atts, $contents = '' ) {
			global $cms_bootstrap_tabs;
			$atts               = shortcode_atts( array(
				'active' => 1
			), $atts );
			$cms_bootstrap_tabs = array(
				'tab-active'  => ! empty( $atts['active'] ) ? (int) $atts['active'] : 1,
				'tab-index'   => 1,
				'tab-content' => ''
			);

			return cms_get_template_file__( 'cms_bootstrap_tabs.php', array(
				'atts'     => $atts,
				'contents' => $contents
			) );
		}

		function add_shortcode_cms_bootstrap_section( $atts, $contents = '' ) {
			$atts = shortcode_atts( array(
				'title' => esc_html__( 'Title', CMS_TEXT_DOMAIN )
			), $atts );

			return cms_get_template_file__( 'cms_bootstrap_section.php', array(
				'atts'     => $atts,
				'contents' => $contents
			) );
		}

		function add_param() {
			$enable_cms_bootstrap_tabs = apply_filters( 'enable_cms_bootstrap_tabs', false );
			if ( $enable_cms_bootstrap_tabs ) {
				vc_map( array(
						"name"                    => esc_html__( "CMS Bootstrap Tabs", CMS_TEXT_DOMAIN ),
						"base"                    => "cms_bootstrap_tabs",
						"class"                   => "cms_bootstrap_tabs",
						"content_element"         => true,
						"show_settings_on_create" => false,
						"is_container"            => true,
						"controls"                => "full",
						"category"                => esc_html__( 'CmsSuperheroes Shortcodes', CMS_TEXT_DOMAIN ),
						"description"             => esc_html__( "", CMS_TEXT_DOMAIN ),
						"as_parent"               => array(
							'only' => 'cms_bootstrap_section'
						),
						"params"                  => array(
							array(
								"type"        => "textfield",
								"heading"     => esc_html__( "Active Tab", CMS_TEXT_DOMAIN ),
								"param_name"  => "active",
								"admin_label" => true,
								"description" => esc_html__( "Enter index off active tab.", CMS_TEXT_DOMAIN ),
							),
						),
						"js_view"                 => 'VcColumnView',
						'default_content' => '[cms_bootstrap_section][/cms_bootstrap_section]',
					)
				);
				vc_map( array(
						"name"                    => esc_html__( "CMS Bootstrap Section", CMS_TEXT_DOMAIN ),
						"base"                    => "cms_bootstrap_section",
						"class"                   => "cms_bootstrap_section",
						"content_element"         => true,
						"show_settings_on_create" => false,
						"is_container"            => true,
						"controls"                => "full",
						"category"                => esc_html__( 'CmsSuperheroes Shortcodes', CMS_TEXT_DOMAIN ),
						"description"             => esc_html__( "", CMS_TEXT_DOMAIN ),
						"as_parent"               => array(
							'except' => 'cms_bootstrap_section,cms_bootstrap_tabs'
						),
						"as_child"                => array(
							'only' => 'cms_bootstrap_tabs'
						),
						"params"                  => array(
							array(
								"type"        => "textfield",
								"heading"     => esc_html__( "Title", CMS_TEXT_DOMAIN ),
								"param_name"  => "title",
								"admin_label" => true,
								"description" => esc_html__( "Enter section title.", CMS_TEXT_DOMAIN ),
							),
						),
						"js_view"                 => 'VcColumnView'
					)
				);
			}
		}

		protected function cms_columnize_content( &$content ) {
			global $shortcode_tags;
			preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
			$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
			$pattern  = get_shortcode_regex();
			foreach ( $tagnames as $tag ) {
				$start = "[$tag";
				$end   = "[/$tag]";

				if ( strpos( $content, $end ) !== false ) {
					$content = str_replace( $start, '' . $start, $content );
					$content = str_replace( $end, $end . '|cms|', $content );
				}
				$content = str_replace( '][', ']|cms|[', $content );

			}

			return explode( '|cms|', $content );

		}
	}

	new CMS_Bootstrap_Tabs();

	if ( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'CMS_ShortcodeContainerBTT' ) && ! class_exists( 'CMS_ShortcodeContainerBTS' ) ) {

		/**
		 * Shortcode COntainer class
		 */
		class CMS_ShortcodeContainerBTT extends WPBakeryShortCodesContainer {

			/**
			 * [$controls_css_settings description]
			 * @var string
			 */
			protected $controls_css_settings = 'out-tc vc_controls-content-widget';

			/**
			 * [$controls_list description]
			 * @var array
			 */
			protected $controls_list = array( 'add', 'edit', 'delete' );

			/**
			 * @param $width
			 * @param $i
			 *
			 * @return string
			 */
			public function mainHtmlBlockParams( $width, $i ) {
				$sortable = ( vc_user_access_check_shortcode_all( 'cms_bootstrap_tabs' ) ? 'wpb_sortable' : 'vc-non-draggable' );

				return 'data-element_type="' . 'cms_bootstrap_tabs' . '" class="cms-content-holder wpb_' . 'cms_bootstrap_tabs' . ' ' . $sortable . ' wpb_content_holder vc_shortcodes_container"' . $this->customAdminBlockParams();
			}

			public function getColumnControls( $controls = 'full', $extended_css = '' ) {

				$column_controls = $this->getColumnControlsModular();

				$column_controls = str_replace( 'vc_element-move"', 'vc_element-move" data-vc-control="move"', $column_controls );
				$column_controls = str_replace( 'vc_edit"', 'vc_edit" data-vc-control="add"', $column_controls );
				$column_controls = str_replace( 'vc_control-btn-edit"', 'vc_control-btn-edit" data-vc-control="edit"', $column_controls );
//                $column_controls = str_replace( 'vc_control-btn-clone"', 'vc_control-btn-clone" data-vc-control="clone"', $column_controls );
				$column_controls = str_replace( 'vc_control-btn-delete"', 'vc_control-btn-delete" data-vc-control="delete"', $column_controls );

				return $column_controls;
			}

			public function contentAdmin( $atts, $content = null ) {

				$width = $el_class = '';

				$atts = shortcode_atts( $this->predefined_atts, $atts );
				extract( $atts );
				$this->atts = $atts;
				$output     = '';

				for ( $i = 0; $i < count( $width ); $i ++ ) {

					$output .= '<div ' . $this->mainHtmlBlockParams( $width, $i ) . '>';

					if ( $this->backened_editor_prepend_controls ) {
						$output .= $this->getColumnControls( 'full', 'vc_controls-out-tc vc_controls-content-widget' );
					}


					$output .= '<div class="cms-param-holder">';

					$output .= $this->paramsHtmlHolders( $atts );

					$output .= '</div>';

					$output .= '<div class="wpb_element_wrapper">';

					$output .= '<div ' . $this->containerHtmlBlockParams( $width, $i ) . '>';

					$output .= do_shortcode( shortcode_unautop( $content ) );

					$output .= '</div>';

					$output .= '</div>';

					$output .= '<a class="vc_edit" data-vc-control="add" href="#" title="Add Section"><i class="vc-composer-icon vc-c-icon-add"></i></a>';

					$output .= '</div>';
				}

				return $output;
			}
		}

		class CMS_ShortcodeContainerBTS extends WPBakeryShortCodesContainer {

			/**
			 * [$controls_css_settings description]
			 * @var string
			 */
			protected $controls_css_settings = 'out-tc vc_controls-content-widget';

			/**
			 * [$controls_list description]
			 * @var array
			 */
			protected $controls_list = array( 'add', 'edit', 'delete' );

			/**
			 * @param $width
			 * @param $i
			 *
			 * @return string
			 */
			public function mainHtmlBlockParams( $width, $i ) {
				$sortable = ( vc_user_access_check_shortcode_all( 'cms_bootstrap_section' ) ? 'wpb_sortable' : 'vc-non-draggable' );

				return 'data-element_type="' . 'cms_bootstrap_section' . '" class="cms-content-holder wpb_' . 'cms_bootstrap_section' . ' ' . $sortable . ' wpb_content_holder vc_shortcodes_container"' . $this->customAdminBlockParams();
			}

			public function getColumnControls( $controls = 'full', $extended_css = '' ) {

				$column_controls = $this->getColumnControlsModular();

				$column_controls = str_replace( 'vc_element-move"', 'vc_element-move" data-vc-control="move"', $column_controls );
				$column_controls = str_replace( 'vc_edit"', 'vc_edit" data-vc-control="add"', $column_controls );
				$column_controls = str_replace( 'vc_control-btn-edit"', 'vc_control-btn-edit" data-vc-control="edit"', $column_controls );
//                $column_controls = str_replace( 'vc_control-btn-clone"', 'vc_control-btn-clone" data-vc-control="clone"', $column_controls );
				$column_controls = str_replace( 'vc_control-btn-delete"', 'vc_control-btn-delete" data-vc-control="delete"', $column_controls );

				return $column_controls;
			}

			public function contentAdmin( $atts, $content = null ) {

				$width = $el_class = '';

				$atts = shortcode_atts( $this->predefined_atts, $atts );
				extract( $atts );
				$this->atts = $atts;
				$output     = '';

				$length = is_array($width)?count($width):1;
				for ( $i = 0; $i < $length; $i ++ ) {

					$output .= '<div ' . $this->mainHtmlBlockParams( $width, $i ) . '>';

					if ( $this->backened_editor_prepend_controls ) {
						$output .= $this->getColumnControls( 'full', 'vc_controls-out-tc vc_controls-content-widget' );
					}


					$output .= '<div class="cms-param-holder">';

					$output .= $this->paramsHtmlHolders( $atts );

					$output .= '</div>';

					$output .= '<div class="wpb_element_wrapper">';

					$output .= '<div ' . $this->containerHtmlBlockParams( $width, $i ) . '>';

					$output .= do_shortcode( shortcode_unautop( $content ) );

					$output .= '</div>';

					$output .= '</div>';

					$output .= '</div>';
				}

				return $output;
			}
		}
	}

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

		class WPBakeryShortCode_cms_bootstrap_tabs extends CMS_ShortcodeContainerBTT {
		}

		class WPBakeryShortCode_cms_bootstrap_section extends CMS_ShortcodeContainerBTS {
		}

	}
}