<?php
/**
 * subetuwebWP Customizer Class
 *
 * @package subetuwebWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'subetuwebWP_Customizer' ) ) :

	/**
	 * The subetuwebWP Customizer class
	 */
	class subetuwebWP_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'customize_register',	array( $this, 'custom_controls' ) );
			add_action( 'customize_register',	array( $this, 'controls_helpers' ) );
			add_action( 'customize_register',	array( $this, 'customize_register' ), 11 );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'customize_panel_init' ) );
			add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'custom_customize_enqueue' ), 7 );
			//add_action( 'customize_controls_print_scripts', 'subetuweb_get_svg_icon' );
			//add_action( 'wp_ajax_subetuweb_update_search_box_light_mode', array( $this, 'update_search_box_light_Mode' ) );
		}

		/**
		 * Adds custom controls
		 *
		 * @since 1.0.0
		 */
		public function custom_controls( $wp_customize ) {

			// Path
			$dir = subetuwebWP_INC_DIR . 'customizer/controls/';

			// Load customize control classes
			require_once( $dir . 'dimensions/class-control-dimensions.php' 					);
			require_once( $dir . 'dropdown-pages/class-control-dropdown-pages.php' 			);
			require_once( $dir . 'heading/class-control-heading.php' 						);
			require_once( $dir . 'icon-select/class-control-icon-select.php' 				);
			require_once( $dir . 'icon-select-multi/class-control-icon-select-multi.php' 	);
			require_once( $dir . 'multiple-select/class-control-multiple-select.php' 		);
			require_once( $dir . 'slider/class-control-slider.php' 							);
			require_once( $dir . 'sortable/class-control-sortable.php' 						);
			require_once( $dir . 'text/class-control-text.php' 								);
			require_once( $dir . 'textarea/class-control-textarea.php' 						);
			require_once( $dir . 'typo/class-control-typo.php' 								);
			require_once( $dir . 'typography/class-control-typography.php' 					);

			// Register JS control types
			$wp_customize->register_control_type( 'subetuwebWP_Customizer_Dimensions_Control' 		);
			$wp_customize->register_control_type( 'subetuwebWP_Customizer_Dropdown_Pages' 			);
			$wp_customize->register_control_type( 'subetuwebWP_Customizer_Heading_Control' 			);
			$wp_customize->register_control_type( 'subetuwebWP_Customizer_Icon_Select_Control' 		);
			$wp_customize->register_control_type( 'subetuwebWP_Customizer_Icon_Select_Multi_Control' );
			$wp_customize->register_control_type( 'subetuwebWP_Customize_Multiple_Select_Control' 	);
			$wp_customize->register_control_type( 'subetuwebWP_Customizer_Slider_Control' 			);
			$wp_customize->register_control_type( 'subetuwebWP_Customizer_Sortable_Control' 		);
			$wp_customize->register_control_type( 'subetuwebWP_Customizer_Text_Control' 			);
			$wp_customize->register_control_type( 'subetuwebWP_Customizer_Textarea_Control' 		);

		}

		/**
		 * Updating the search box light Mode via Ajax request
		 *
		 * @since 1.0.0
		 */
		public function update_search_box_light_Mode() {
			$darkMode = esc_attr( $_REQUEST['darkMode'] );
			update_option( 'subetuwebCustomizerSearchdarkMode', $darkMode );
			wp_send_json_success();
		}

		/**
		 * Adds customizer helpers
		 *
		 * @since 1.0.0
		 */
		public function controls_helpers() {
			require_once( subetuwebWP_INC_DIR .'customizer/customizer-helpers.php' );
			require_once( subetuwebWP_INC_DIR .'customizer/sanitization-callbacks.php' );
		}

		/**
		 * Core modules
		 *
		 * @since 1.0.0
		 */
		public static function customize_register( $wp_customize ) {

			// Tweak default controls
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';

		}

		/**
		 * Loads Css files for customizer Panel
		 *
		 * @since 1.0.0
		 */
		public function customize_panel_init() {

			$settings = wp_parse_args( get_option( 'oe_panels_settings', [] ) );

			wp_enqueue_script( 'subetuwebwp-customize-js', subetuwebWP_INC_DIR_URI . 'customizer/assets/js/customize.js', array( 'jquery' ) );
			wp_enqueue_style( 'subetuwebwp-customize-preview', subetuwebWP_INC_DIR_URI . 'customizer/assets/css/customize-preview.min.css');
		}

		/**
		 * Loads js files for customizer preview
		 *
		 * @since 1.0.0
		 */
		public function customize_preview_init() {
			wp_enqueue_script( 'subetuwebwp-customize-preview', subetuwebWP_INC_DIR_URI . 'customizer/assets/js/customize-preview.min.js', array( 'customize-preview' ), subetuwebWP_THEME_VERSION, true );
		}

		/**
		 * Load scripts for customizer
		 *
		 * @since 1.0.0
		 */
		public function custom_customize_enqueue() {
			wp_enqueue_style( 'font-awesome', subetuwebWP_THEME_URI .'/assets/fonts/fontawesome/css/all.min.css', false, '5.11.2'  );
			wp_enqueue_style( 'simple-line-icons', subetuwebWP_INC_DIR_URI .'customizer/assets/css/customizer-simple-line-icons.min.css', false, '2.4.0' );
			wp_enqueue_style( 'subetuwebwp-general', subetuwebWP_INC_DIR_URI . 'customizer/assets/min/css/general.min.css' );
			wp_enqueue_script( 'subetuwebwp-general', subetuwebWP_INC_DIR_URI . 'customizer/assets/min/js/general.min.js', array( 'jquery', 'customize-base' ), false, true );
		}

	}

endif;

return new subetuwebWP_Customizer();
