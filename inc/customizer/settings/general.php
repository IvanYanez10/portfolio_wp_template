<?php
/**
 * General Customizer Options
 *
 * @package subetuwebWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'subetuwebWP_General_Customizer' ) ) :

	/**
	 * Settings for general options
	 */
	class subetuwebWP_General_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'customizer_options' ) );
			add_filter( 'subetuweb_head_css', array( $this, 'head_css' ) );

		}

		/**
		 * Customizer options
		 *
		 * @param WP_Customize_Manager $wp_customize Reference to WP_Customize_Manager.
		 * @since 1.0.0
		 */
		public function customizer_options( $wp_customize ) {

			/**
			 * Panel
			 */
			$panel = 'subetuweb_general_panel';
			$wp_customize->add_panel(
				$panel,
				array(
					'title'    => esc_html__( 'General Options', 'subetuwebwp' ),
					'priority' => 210,
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'subetuweb_general_styling',
				array(
					'title'    => esc_html__( 'General Styling', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Styling
			 */
			$wp_customize->add_setting(
				'subetuweb_customzer_styling',
				array(
					'transport'         => 'postMessage',
					'default'           => 'head',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				'subetuweb_customzer_styling',
				array(
					'label'       => esc_html__( 'Styling Options Location', 'subetuwebwp' ),
					'description' => esc_html__( 'If you choose Custom File, a CSS file will be created in your uploads folder.', 'subetuwebwp' ),
					'type'        => 'radio',
					'section'     => 'subetuweb_general_styling',
					'settings'    => 'subetuweb_customzer_styling',
					'priority'    => 10,
					'choices'     => array(
						'head' => esc_html__( 'WP Head', 'subetuwebwp' ),
						'file' => esc_html__( 'Custom File', 'subetuwebwp' ),
					),
				)
			);

			/**
			 * Primary Color
			 */
			$wp_customize->add_setting(
				'subetuweb_primary_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_primary_color',
					array(
						'label'    => esc_html__( 'Primary Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_styling',
						'settings' => 'subetuweb_primary_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Hover Primary Color
			 */
			$wp_customize->add_setting(
				'subetuweb_hover_primary_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#0b7cac',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_hover_primary_color',
					array(
						'label'    => esc_html__( 'Hover Primary Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_styling',
						'settings' => 'subetuweb_hover_primary_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Main Border Color
			 */
			$wp_customize->add_setting(
				'subetuweb_main_border_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#e9e9e9',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_main_border_color',
					array(
						'label'    => esc_html__( 'Main Border Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_styling',
						'settings' => 'subetuweb_main_border_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Heading Site Background
			 */
			$wp_customize->add_setting(
				'subetuweb_site_background_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Heading_Control(
					$wp_customize,
					'subetuweb_site_background_heading',
					array(
						'label'    => esc_html__( 'Site Background', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_styling',
						'priority' => 10,
					)
				)
			);

			/**
			 * Site Background
			 */
			$wp_customize->add_setting(
				'subetuweb_background_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_background_color',
					array(
						'label'           => esc_html__( 'Background Color', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_styling',
						'settings'        => 'subetuweb_background_color',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_hasnt_boxed_layout',
					)
				)
			);

			/**
			 * Site Background Image
			 */
			$wp_customize->add_setting(
				'subetuweb_background_image',
				array(
					'sanitize_callback' => 'subetuwebwp_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'subetuweb_background_image',
					array(
						'label'    => esc_html__( 'Background Image', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_styling',
						'settings' => 'subetuweb_background_image',
						'priority' => 10,
					)
				)
			);

			/**
			 * Site Background Image Position
			 */
			$wp_customize->add_setting(
				'subetuweb_background_image_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_background_image_position',
					array(
						'label'           => esc_html__( 'Position', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_styling',
						'settings'        => 'subetuweb_background_image_position',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_background_image',
						'choices'         => array(
							'initial'       => esc_html__( 'Default', 'subetuwebwp' ),
							'top left'      => esc_html__( 'Top Left', 'subetuwebwp' ),
							'top center'    => esc_html__( 'Top Center', 'subetuwebwp' ),
							'top right'     => esc_html__( 'Top Right', 'subetuwebwp' ),
							'center left'   => esc_html__( 'Center Left', 'subetuwebwp' ),
							'center center' => esc_html__( 'Center Center', 'subetuwebwp' ),
							'center right'  => esc_html__( 'Center Right', 'subetuwebwp' ),
							'bottom left'   => esc_html__( 'Bottom Left', 'subetuwebwp' ),
							'bottom center' => esc_html__( 'Bottom Center', 'subetuwebwp' ),
							'bottom right'  => esc_html__( 'Bottom Right', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Site Background Image Attachment
			 */
			$wp_customize->add_setting(
				'subetuweb_background_image_attachment',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_background_image_attachment',
					array(
						'label'           => esc_html__( 'Attachment', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_styling',
						'settings'        => 'subetuweb_background_image_attachment',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_background_image',
						'choices'         => array(
							'initial' => esc_html__( 'Default', 'subetuwebwp' ),
							'scroll'  => esc_html__( 'Scroll', 'subetuwebwp' ),
							'fixed'   => esc_html__( 'Fixed', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Site Background Image Repeat
			 */
			$wp_customize->add_setting(
				'subetuweb_background_image_repeat',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_background_image_repeat',
					array(
						'label'           => esc_html__( 'Repeat', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_styling',
						'settings'        => 'subetuweb_background_image_repeat',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_background_image',
						'choices'         => array(
							'initial'   => esc_html__( 'Default', 'subetuwebwp' ),
							'no-repeat' => esc_html__( 'No-repeat', 'subetuwebwp' ),
							'repeat'    => esc_html__( 'Repeat', 'subetuwebwp' ),
							'repeat-x'  => esc_html__( 'Repeat-x', 'subetuwebwp' ),
							'repeat-y'  => esc_html__( 'Repeat-y', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Site Background Image Size
			 */
			$wp_customize->add_setting(
				'subetuweb_background_image_size',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_background_image_size',
					array(
						'label'           => esc_html__( 'Size', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_styling',
						'settings'        => 'subetuweb_background_image_size',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_background_image',
						'choices'         => array(
							'initial' => esc_html__( 'Default', 'subetuwebwp' ),
							'auto'    => esc_html__( 'Auto', 'subetuwebwp' ),
							'cover'   => esc_html__( 'Cover', 'subetuwebwp' ),
							'contain' => esc_html__( 'Contain', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Heading Links Color
			 */
			$wp_customize->add_setting(
				'subetuweb_links_color_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Heading_Control(
					$wp_customize,
					'subetuweb_links_color_heading',
					array(
						'label'    => esc_html__( 'Links Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_styling',
						'priority' => 10,
					)
				)
			);

			/**
			 * Links Color
			 */
			$wp_customize->add_setting(
				'subetuweb_links_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_links_color',
					array(
						'label'    => esc_html__( 'Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_styling',
						'settings' => 'subetuweb_links_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Links Color Hover
			 */
			$wp_customize->add_setting(
				'subetuweb_links_color_hover',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_links_color_hover',
					array(
						'label'    => esc_html__( 'Color: Hover', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_styling',
						'settings' => 'subetuweb_links_color_hover',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'subetuweb_general_settings',
				array(
					'title'    => esc_html__( 'General Settings', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Main Layout Style
			 */
			$wp_customize->add_setting(
				'subetuweb_main_layout_style',
				array(
					'default'           => 'wide',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_main_layout_style',
					array(
						'label'    => esc_html__( 'Layout Style', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_main_layout_style',
						'priority' => 10,
						'choices'  => array(
							'wide'     => esc_html__( 'Wide', 'subetuwebwp' ),
							'boxed'    => esc_html__( 'Boxed', 'subetuwebwp' ),
							'separate' => esc_html__( 'Separate', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Boxed Layout Drop-Shadow
			 */
			$wp_customize->add_setting(
				'subetuweb_boxed_dropdshadow',
				array(
					'transport'         => 'postMessage',
					'default'           => true,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_boxed_dropdshadow',
					array(
						'label'           => esc_html__( 'Boxed Layout Drop-Shadow', 'subetuwebwp' ),
						'type'            => 'checkbox',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_boxed_dropdshadow',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_boxed_layout',
					)
				)
			);

			/**
			 * Boxed Width
			 */
			$wp_customize->add_setting(
				'subetuweb_boxed_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1280',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_boxed_width',
					array(
						'label'           => esc_html__( 'Boxed Width (px)', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_boxed_width',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_boxed_layout',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 4000,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Boxed Outside Background
			 */
			$wp_customize->add_setting(
				'subetuweb_boxed_outside_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#e9e9e9',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_boxed_outside_bg',
					array(
						'label'           => esc_html__( 'Outside Background', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_boxed_outside_bg',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_boxed_layout',
					)
				)
			);

			/**
			 * Separate Outside Background
			 */
			$wp_customize->add_setting(
				'subetuweb_separate_outside_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#f1f1f1',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_separate_outside_bg',
					array(
						'label'           => esc_html__( 'Outside Background', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_separate_outside_bg',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_separate_layout',
					)
				)
			);

			/**
			 * Boxed Inner Background
			 */
			$wp_customize->add_setting(
				'subetuweb_boxed_inner_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_boxed_inner_bg',
					array(
						'label'           => esc_html__( 'Inner Background', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_boxed_inner_bg',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_boxed_or_separate_layout',
					)
				)
			);

			/**
			 * Separate Content Padding
			 */
			$wp_customize->add_setting(
				'subetuweb_separate_content_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '30px',
					'sanitize_callback' => 'wp_kses_post',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_separate_content_padding',
					array(
						'label'           => esc_html__( 'Content Padding', 'subetuwebwp' ),
						'description'     => esc_html__( 'Add a custom content padding. px - em - %.', 'subetuwebwp' ),
						'type'            => 'text',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_separate_content_padding',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_separate_layout',
					)
				)
			);

			/**
			 * Separate Widgets Padding
			 */
			$wp_customize->add_setting(
				'subetuweb_separate_widgets_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '30px',
					'sanitize_callback' => 'wp_kses_post',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_separate_widgets_padding',
					array(
						'label'           => esc_html__( 'Widgets Padding', 'subetuwebwp' ),
						'description'     => esc_html__( 'Add a custom widgets padding. px - em - %.', 'subetuwebwp' ),
						'type'            => 'text',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_separate_widgets_padding',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_separate_layout',
					)
				)
			);

			/**
			 * Main Container Width
			 */
			$wp_customize->add_setting(
				'subetuweb_main_container_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1200',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_main_container_width',
					array(
						'label'           => esc_html__( 'Main Container Width (px)', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_main_container_width',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_hasnt_boxed_layout',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 4096,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Content Width
			 */
			$wp_customize->add_setting(
				'subetuweb_left_container_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '72',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_left_container_width',
					array(
						'label'       => esc_html__( 'Content Width (%)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_settings',
						'settings'    => 'subetuweb_left_container_width',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Sidebar Width
			 */
			$wp_customize->add_setting(
				'subetuweb_sidebar_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '28',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_sidebar_width',
					array(
						'label'       => esc_html__( 'Sidebar Width (%)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_settings',
						'settings'    => 'subetuweb_sidebar_width',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Schema Markup
			 */
			$wp_customize->add_setting(
				'subetuweb_schema_markup',
				array(
					'default'           => true,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_schema_markup',
					array(
						'label'    => esc_html__( 'Enable Schema Markup', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_schema_markup',
						'priority' => 10,
					)
				)
			);

			/**
			 * Heading Pages
			 */
			$wp_customize->add_setting(
				'subetuweb_pages_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Heading_Control(
					$wp_customize,
					'subetuweb_pages_heading',
					array(
						'label'    => esc_html__( 'Pages', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pages
			 */
			$wp_customize->add_setting(
				'subetuweb_page_single_layout',
				array(
					'default'           => 'right-sidebar',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Radio_Image_Control(
					$wp_customize,
					'subetuweb_page_single_layout',
					array(
						'label'    => esc_html__( 'Layout', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_page_single_layout',
						'priority' => 10,
						'choices'  => subetuwebwp_customizer_layout(),
					)
				)
			);

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting(
				'subetuweb_page_single_both_sidebars_style',
				array(
					'default'           => 'scs-style',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_single_both_sidebars_style',
					array(
						'label'           => esc_html__( 'Both Sidebars: Style', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_page_single_both_sidebars_style',
						'priority'        => 10,
						'choices'         => array(
							'ssc-style' => esc_html__( 'Sidebar / Sidebar / Content', 'subetuwebwp' ),
							'scs-style' => esc_html__( 'Sidebar / Content / Sidebar', 'subetuwebwp' ),
							'css-style' => esc_html__( 'Content / Sidebar / Sidebar', 'subetuwebwp' ),
						),
						'active_callback' => 'subetuwebwp_cac_has_page_single_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting(
				'subetuweb_page_single_both_sidebars_content_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_single_both_sidebars_content_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Content Width (%)', 'subetuwebwp' ),
						'type'            => 'number',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_page_single_both_sidebars_content_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'subetuwebwp_cac_has_page_single_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting(
				'subetuweb_page_single_both_sidebars_sidebars_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_single_both_sidebars_sidebars_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Sidebars Width (%)', 'subetuwebwp' ),
						'type'            => 'number',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_page_single_both_sidebars_sidebars_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'subetuwebwp_cac_has_page_single_bs_layout',
					)
				)
			);

			/**
			 * Mobile Sidebar Order
			 */
			$wp_customize->add_setting(
				'subetuweb_page_single_sidebar_order',
				array(
					'default'           => 'content-sidebar',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_single_sidebar_order',
					array(
						'label'           => esc_html__( 'Mobile Sidebar Order', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_page_single_sidebar_order',
						'priority'        => 10,
						'choices'         => array(
							'content-sidebar' => esc_html__( 'Content / Sidebar', 'subetuwebwp' ),
							'sidebar-content' => esc_html__( 'Sidebar / Content', 'subetuwebwp' ),
						),
						'active_callback' => 'subetuwebwp_cac_has_page_single_rl_layout',
					)
				)
			);

			/**
			 * Content Padding
			 */
			$wp_customize->add_setting(
				'subetuweb_page_content_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_page_content_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_page_content_tablet_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_page_content_tablet_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_page_content_mobile_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_page_content_mobile_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Dimensions_Control(
					$wp_customize,
					'subetuweb_page_content_padding',
					array(
						'label'       => esc_html__( 'Content Padding (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_settings',
						'settings'    => array(
							'desktop_top'    => 'subetuweb_page_content_top_padding',
							'desktop_bottom' => 'subetuweb_page_content_bottom_padding',
							'tablet_top'     => 'subetuweb_page_content_tablet_top_padding',
							'tablet_bottom'  => 'subetuweb_page_content_tablet_bottom_padding',
							'mobile_top'     => 'subetuweb_page_content_mobile_top_padding',
							'mobile_bottom'  => 'subetuweb_page_content_mobile_bottom_padding',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Heading Search Result Page
			 */
			$wp_customize->add_setting(
				'subetuweb_search_result_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Heading_Control(
					$wp_customize,
					'subetuweb_search_result_heading',
					array(
						'label'    => esc_html__( 'Search Result Page', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Search Source
			 */
			$wp_customize->add_setting(
				'subetuweb_menu_search_source',
				array(
					'default'           => 'any',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_menu_search_source',
					array(
						'label'    => esc_html__( 'Source', 'subetuwebwp' ),
						'type'     => 'select',
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_menu_search_source',
						'priority' => 10,
						'choices'  => $this->get_post_types(),
					)
				)
			);

			/**
			 * Search Posts Per Page
			 */
			$wp_customize->add_setting(
				'subetuweb_search_post_per_page',
				array(
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_search_post_per_page',
					array(
						'label'       => esc_html__( 'Search Posts Per Page', 'subetuwebwp' ),
						'type'        => 'number',
						'section'     => 'subetuweb_general_settings',
						'settings'    => 'subetuweb_search_post_per_page',
						'priority'    => 10,
						'input_attrs' => array(
							'min' => 0,
						),
					)
				)
			);

			/**
			 * Search Page
			 */
			$wp_customize->add_setting(
				'subetuweb_search_custom_sidebar',
				array(
					'default'           => true,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_search_custom_sidebar',
					array(
						'label'    => esc_html__( 'Custom Sidebar', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_search_custom_sidebar',
						'priority' => 10,
					)
				)
			);

			/**
			 * Search Page Layout
			 */
			$wp_customize->add_setting(
				'subetuweb_search_layout',
				array(
					'default'           => 'right-sidebar',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Radio_Image_Control(
					$wp_customize,
					'subetuweb_search_layout',
					array(
						'label'    => esc_html__( 'Layout', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_search_layout',
						'priority' => 10,
						'choices'  => subetuwebwp_customizer_layout(),
					)
				)
			);

			/**
			 * Page Search Logo
			 */
			$wp_customize->add_setting(
				'subetuweb_search_logo',
				array(
					'default'           => '',
					'sanitize_callback' => 'subetuwebwp_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'subetuweb_search_logo',
					array(
						'label'       => esc_html__( 'Search Logo', 'subetuwebwp' ),
						'description' => esc_html__( 'Select a search page logo.', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_settings',
						'settings'    => 'subetuweb_search_logo',
						'priority'    => 10,
					)
				)
			);

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting(
				'subetuweb_search_both_sidebars_style',
				array(
					'default'           => 'scs-style',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_search_both_sidebars_style',
					array(
						'label'           => esc_html__( 'Both Sidebars: Style', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_search_both_sidebars_style',
						'priority'        => 10,
						'choices'         => array(
							'ssc-style' => esc_html__( 'Sidebar / Sidebar / Content', 'subetuwebwp' ),
							'scs-style' => esc_html__( 'Sidebar / Content / Sidebar', 'subetuwebwp' ),
							'css-style' => esc_html__( 'Content / Sidebar / Sidebar', 'subetuwebwp' ),
						),
						'active_callback' => 'subetuwebwp_cac_has_search_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting(
				'subetuweb_search_both_sidebars_content_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_search_both_sidebars_content_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Content Width (%)', 'subetuwebwp' ),
						'type'            => 'number',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_search_both_sidebars_content_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'subetuwebwp_cac_has_search_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting(
				'subetuweb_search_both_sidebars_sidebars_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_search_both_sidebars_sidebars_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Sidebars Width (%)', 'subetuwebwp' ),
						'type'            => 'number',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_search_both_sidebars_sidebars_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'subetuwebwp_cac_has_search_bs_layout',
					)
				)
			);

			/**
			 * Mobile Sidebar Order
			 */
			$wp_customize->add_setting(
				'subetuweb_search_sidebar_order',
				array(
					'default'           => 'content-sidebar',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_search_sidebar_order',
					array(
						'label'           => esc_html__( 'Mobile Sidebar Order', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_settings',
						'settings'        => 'subetuweb_search_sidebar_order',
						'priority'        => 10,
						'choices'         => array(
							'content-sidebar' => esc_html__( 'Content / Sidebar', 'subetuwebwp' ),
							'sidebar-content' => esc_html__( 'Sidebar / Content', 'subetuwebwp' ),
						),
						'active_callback' => 'subetuwebwp_cac_has_search_rl_layout',
					)
				)
			);

			/**
			 * Heading Sitewide Identity
			 */
			$wp_customize->add_setting(
				'subetuweb_opengraph_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Heading_Control(
					$wp_customize,
					'subetuweb_opengraph_heading',
					array(
						'label'       => esc_html__( 'OpenGraph', 'subetuwebwp' ),
						'description' => esc_html__( 'This is information taken by social media when a link is shared', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_settings',
						'priority'    => 10,
					)
				)
			);

			/**
			 * Enable OpenGraph
			 */
			$wp_customize->add_setting(
				'subetuweb_open_graph',
				array(
					'default'           => false,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_open_graph',
					array(
						'label'    => esc_html__( 'Enable OpenGraph', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_open_graph',
						'priority' => 10,
					)
				)
			);

			/**
			 * Twitter Handle
			 */
			$wp_customize->add_setting(
				'subetuweb_twitter_handle',
				array(
					'default'           => '',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_twitter_handle',
					array(
						'label'    => esc_html__( 'Twitter Username', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_twitter_handle',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Facebook Page URL
			 */
			$wp_customize->add_setting(
				'subetuweb_facebook_page_url',
				array(
					'default'           => '',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_facebook_page_url',
					array(
						'label'    => esc_html__( 'Facebook Page URL', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_facebook_page_url',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Facebook App ID
			 */
			$wp_customize->add_setting(
				'subetuweb_facebook_appid',
				array(
					'default'           => '',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_facebook_appid',
					array(
						'label'    => esc_html__( 'Facebook App ID', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_settings',
						'settings' => 'subetuweb_facebook_appid',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'subetuweb_general_page_header',
				array(
					'title'    => esc_html__( 'Page Title', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Page Title Visibility
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_visibility',
				array(
					'default'           => 'all-devices',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_header_visibility',
					array(
						'label'    => esc_html__( 'Visibility', 'subetuwebwp' ),
						'type'     => 'select',
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_page_header_visibility',
						'priority' => 10,
						'choices'  => array(
							'all-devices'        => esc_html__( 'Show On All Devices', 'subetuwebwp' ),
							'hide-tablet'        => esc_html__( 'Hide On Tablet', 'subetuwebwp' ),
							'hide-mobile'        => esc_html__( 'Hide On Mobile', 'subetuwebwp' ),
							'hide-tablet-mobile' => esc_html__( 'Hide On Tablet & Mobile', 'subetuwebwp' ),
							'hide-all-devices'   => esc_html__( 'Hide On All Devices', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Heading Tag
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_heading_tag',
				array(
					'default'           => 'h1',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_header_heading_tag',
					array(
						'label'    => esc_html__( 'Heading Tag', 'subetuwebwp' ),
						'type'     => 'select',
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_page_header_heading_tag',
						'priority' => 10,
						'choices'  => array(
							'h1'   => esc_html__( 'H1', 'subetuwebwp' ),
							'h2'   => esc_html__( 'H2', 'subetuwebwp' ),
							'h3'   => esc_html__( 'H3', 'subetuwebwp' ),
							'h4'   => esc_html__( 'H4', 'subetuwebwp' ),
							'h5'   => esc_html__( 'H5', 'subetuwebwp' ),
							'h6'   => esc_html__( 'H6', 'subetuwebwp' ),
							'div'  => esc_html__( 'div', 'subetuwebwp' ),
							'span' => esc_html__( 'span', 'subetuwebwp' ),
							'p'    => esc_html__( 'p', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Style
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_style',
				array(
					'default'           => '',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_header_style',
					array(
						'label'    => esc_html__( 'Style', 'subetuwebwp' ),
						'type'     => 'select',
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_page_header_style',
						'priority' => 10,
						'choices'  => array(
							''                 => esc_html__( 'Default', 'subetuwebwp' ),
							'centered'         => esc_html__( 'Centered', 'subetuwebwp' ),
							'centered-minimal' => esc_html__( 'Centered Minimal', 'subetuwebwp' ),
							'background-image' => esc_html__( 'Background Image', 'subetuwebwp' ),
							'hidden'           => esc_html__( 'Hidden', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_bg_image',
				array(
					'sanitize_callback' => 'subetuwebwp_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'subetuweb_page_header_bg_image',
					array(
						'label'           => esc_html__( 'Image', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_bg_image',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Background Image Title/Breadcrumb Position
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_bg_title_breadcrumb_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'center',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_page_header_bg_title_breadcrumb_position',
					array(
						'label'           => esc_html__( 'Title/Breadcrumb Position', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_bg_title_breadcrumb_position',
						'priority'        => 10,
						'choices'         => array(
							'left'   => esc_html__( 'Left', 'subetuwebwp' ),
							'center' => esc_html__( 'Center', 'subetuwebwp' ),
							'right'  => esc_html__( 'Right', 'subetuwebwp' ),
						),
						'active_callback' => 'subetuwebwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Background Image Position
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_bg_image_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'top center',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_header_bg_image_position',
					array(
						'label'           => esc_html__( 'Position', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_bg_image_position',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_bg_image_page_header',
						'choices'         => array(
							'initial'       => esc_html__( 'Default', 'subetuwebwp' ),
							'top left'      => esc_html__( 'Top Left', 'subetuwebwp' ),
							'top center'    => esc_html__( 'Top Center', 'subetuwebwp' ),
							'top right'     => esc_html__( 'Top Right', 'subetuwebwp' ),
							'center left'   => esc_html__( 'Center Left', 'subetuwebwp' ),
							'center center' => esc_html__( 'Center Center', 'subetuwebwp' ),
							'center right'  => esc_html__( 'Center Right', 'subetuwebwp' ),
							'bottom left'   => esc_html__( 'Bottom Left', 'subetuwebwp' ),
							'bottom center' => esc_html__( 'Bottom Center', 'subetuwebwp' ),
							'bottom right'  => esc_html__( 'Bottom Right', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image Attachment
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_bg_image_attachment',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_header_bg_image_attachment',
					array(
						'label'           => esc_html__( 'Attachment', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_bg_image_attachment',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_bg_image_page_header',
						'choices'         => array(
							'initial' => esc_html__( 'Default', 'subetuwebwp' ),
							'scroll'  => esc_html__( 'Scroll', 'subetuwebwp' ),
							'fixed'   => esc_html__( 'Fixed', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image Repeat
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_bg_image_repeat',
				array(
					'transport'         => 'postMessage',
					'default'           => 'no-repeat',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_header_bg_image_repeat',
					array(
						'label'           => esc_html__( 'Repeat', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_bg_image_repeat',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_bg_image_page_header',
						'choices'         => array(
							'initial'   => esc_html__( 'Default', 'subetuwebwp' ),
							'no-repeat' => esc_html__( 'No-repeat', 'subetuwebwp' ),
							'repeat'    => esc_html__( 'Repeat', 'subetuwebwp' ),
							'repeat-x'  => esc_html__( 'Repeat-x', 'subetuwebwp' ),
							'repeat-y'  => esc_html__( 'Repeat-y', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image Size
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_bg_image_size',
				array(
					'transport'         => 'postMessage',
					'default'           => 'cover',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_page_header_bg_image_size',
					array(
						'label'           => esc_html__( 'Size', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_bg_image_size',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_bg_image_page_header',
						'choices'         => array(
							'initial' => esc_html__( 'Default', 'subetuwebwp' ),
							'auto'    => esc_html__( 'Auto', 'subetuwebwp' ),
							'cover'   => esc_html__( 'Cover', 'subetuwebwp' ),
							'contain' => esc_html__( 'Contain', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image Height
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_bg_image_height',
				array(
					'transport'         => 'postMessage',
					'default'           => '400',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_page_header_bg_image_height',
					array(
						'label'           => esc_html__( 'Height (px)', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_bg_image_height',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 800,
							'step' => 1,
						),
						'active_callback' => 'subetuwebwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Background Image Overlay Opacity
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_bg_image_overlay_opacity',
				array(
					'transport'         => 'postMessage',
					'default'           => '0.5',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_page_header_bg_image_overlay_opacity',
					array(
						'label'           => esc_html__( 'Overlay Opacity', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_bg_image_overlay_opacity',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 1,
							'step' => 0.1,
						),
						'active_callback' => 'subetuwebwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Background Image Overlay Color
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_bg_image_overlay_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#000000',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_page_header_bg_image_overlay_color',
					array(
						'label'           => esc_html__( 'Overlay Color', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_bg_image_overlay_color',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Padding
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_top_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '34',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_page_header_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '34',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_page_header_tablet_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_page_header_tablet_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_page_header_mobile_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_page_header_mobile_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Dimensions_Control(
					$wp_customize,
					'subetuweb_page_header_padding',
					array(
						'label'       => esc_html__( 'Padding (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_page_header',
						'settings'    => array(
							'desktop_top'    => 'subetuweb_page_header_top_padding',
							'desktop_bottom' => 'subetuweb_page_header_bottom_padding',
							'tablet_top'     => 'subetuweb_page_header_tablet_top_padding',
							'tablet_bottom'  => 'subetuweb_page_header_tablet_bottom_padding',
							'mobile_top'     => 'subetuweb_page_header_mobile_top_padding',
							'mobile_bottom'  => 'subetuweb_page_header_mobile_bottom_padding',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Page Title Background Color
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_background',
				array(
					'transport'         => 'postMessage',
					'default'           => '#f5f5f5',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_page_header_background',
					array(
						'label'           => esc_html__( 'Background Color', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_page_header_background',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_hasnt_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Color
			 */
			$wp_customize->add_setting(
				'subetuweb_page_header_title_color',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_page_header_title_color',
					array(
						'label'    => esc_html__( 'Text Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_page_header_title_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Breadcrumbs Heading
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumbs_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Heading_Control(
					$wp_customize,
					'subetuweb_breadcrumbs_heading',
					array(
						'label'    => esc_html__( 'Breadcrumbs', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_page_header',
						'priority' => 10,
					)
				)
			);

			/**
			 * Breadcrumbs
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumbs',
				array(
					'default'           => true,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_breadcrumbs',
					array(
						'label'    => esc_html__( 'Enable Breadcrumbs', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_breadcrumbs',
						'priority' => 10,
					)
				)
			);

			/**
			 * Breadcrumbs Item Title
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumb_show_title',
				array(
					'default'           => true,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_breadcrumb_show_title',
					array(
						'label'    => esc_html__( 'Show Item Title', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_breadcrumb_show_title',
						'priority' => 10,
					)
				)
			);

			/**
			 * Breadcrumbs Position
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumbs_position',
				array(
					'default'           => '',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_breadcrumbs_position',
					array(
						'label'           => esc_html__( 'Position', 'subetuwebwp' ),
						'type'            => 'select',
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_breadcrumbs_position',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_breadcrumbs',
						'choices'         => array(
							''            => esc_html__( 'Absolute Right', 'subetuwebwp' ),
							'under-title' => esc_html__( 'Under Title', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Breadcrumb Separator
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumb_separator',
				array(
					'transport'         => 'postMessage',
					'default'           => '>',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_breadcrumb_separator',
					array(
						'label'    => esc_html__( 'Breadcrumb Separator', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_breadcrumb_separator',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Home Item
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumb_home_item',
				array(
					'transport'         => 'postMessage',
					'default'           => 'icon',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_breadcrumb_home_item',
					array(
						'label'    => esc_html__( 'Home Item', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_breadcrumb_home_item',
						'priority' => 10,
						'choices'  => array(
							'icon' => esc_html__( 'Icon', 'subetuwebwp' ),
							'text' => esc_html__( 'Text', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Translation for Homepage
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumb_translation_home',
				array(
					'transport'         => 'postMessage',
					'default'           => esc_html__( 'Home', 'subetuwebwp' ),
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_breadcrumb_translation_home',
					array(
						'label'    => esc_html__( 'Translation for Homepage', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_breadcrumb_translation_home',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Translation for "404 Not Found"
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumb_translation_error',
				array(
					'transport'         => 'postMessage',
					'default'           => esc_html__( '404 Not Found', 'subetuwebwp' ),
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_breadcrumb_translation_error',
					array(
						'label'    => esc_html__( 'Translation for "404 Not Found"', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_breadcrumb_translation_error',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Translation for "Search results for"
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumb_translation_search',
				array(
					'transport'         => 'postMessage',
					'default'           => esc_html__( 'Search results for', 'subetuwebwp' ),
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_breadcrumb_translation_search',
					array(
						'label'    => esc_html__( 'Translation for "Search results for"', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_breadcrumb_translation_search',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Posts Taxonomy
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumb_posts_taxonomy',
				array(
					'default'           => 'category',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_breadcrumb_posts_taxonomy',
					array(
						'label'    => esc_html__( 'Posts Taxonomy', 'subetuwebwp' ),
						'type'     => 'select',
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_breadcrumb_posts_taxonomy',
						'priority' => 10,
						'choices'  => array(
							'none'     => esc_html__( 'None', 'subetuwebwp' ),
							'category' => esc_html__( 'Category', 'subetuwebwp' ),
							'post_tag' => esc_html__( 'Tag', 'subetuwebwp' ),
							'blog'     => esc_html__( 'Blog Page', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Products Taxonomy
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumb_products_taxonomy',
				array(
					'default'           => 'shop',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_breadcrumb_products_taxonomy',
					array(
						'label'    => esc_html__( 'Products Taxonomy', 'subetuwebwp' ),
						'type'     => 'select',
						'section'  => 'subetuweb_general_page_header',
						'settings' => 'subetuweb_breadcrumb_products_taxonomy',
						'priority' => 10,
						'choices'  => array(
							'none'        => esc_html__( 'None', 'subetuwebwp' ),
							'product_cat' => esc_html__( 'Category', 'subetuwebwp' ),
							'product_tag' => esc_html__( 'Tag', 'subetuwebwp' ),
							'shop'        => esc_html__( 'Shop Page', 'subetuwebwp' ),
						),
					)
				)
			);

			// If subetuweb Portfolio plugin is activated.
			if ( class_exists( 'subetuweb_Portfolio' ) ) {

				/**
				 * Portfolio Taxonomy
				 */
				$wp_customize->add_setting(
					'subetuweb_breadcrumb_portfolio_taxonomy',
					array(
						'default'           => 'subetuweb_portfolio_category',
						'sanitize_callback' => 'subetuwebwp_sanitize_select',
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'subetuweb_breadcrumb_portfolio_taxonomy',
						array(
							'label'    => esc_html__( 'Portfolio Taxonomy', 'subetuwebwp' ),
							'type'     => 'select',
							'section'  => 'subetuweb_general_page_header',
							'settings' => 'subetuweb_breadcrumb_portfolio_taxonomy',
							'priority' => 10,
							'choices'  => array(
								'none'                     => esc_html__( 'None', 'subetuwebwp' ),
								'subetuweb_portfolio_category' => esc_html__( 'Category', 'subetuwebwp' ),
								'subetuweb_portfolio_tag'      => esc_html__( 'Tag', 'subetuwebwp' ),
								'portfolio'                => esc_html__( 'Portfolio Page', 'subetuwebwp' ),
							),
						)
					)
				);

			}

			/**
			 * Breadcrumbs Text Color
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumbs_text_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#c6c6c6',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_breadcrumbs_text_color',
					array(
						'label'           => esc_html__( 'Text Color', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_breadcrumbs_text_color',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_breadcrumbs',
					)
				)
			);

			/**
			 * Breadcrumbs Separator Color
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumbs_seperator_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#c6c6c6',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_breadcrumbs_seperator_color',
					array(
						'label'           => esc_html__( 'Separator Color', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_breadcrumbs_seperator_color',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_breadcrumbs',
					)
				)
			);

			/**
			 * Breadcrumbs Link Color
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumbs_link_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_breadcrumbs_link_color',
					array(
						'label'           => esc_html__( 'Link Color', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_breadcrumbs_link_color',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_breadcrumbs',
					)
				)
			);

			/**
			 * Breadcrumbs Link Color
			 */
			$wp_customize->add_setting(
				'subetuweb_breadcrumbs_link_color_hover',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_breadcrumbs_link_color_hover',
					array(
						'label'           => esc_html__( 'Link Color: Hover', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_page_header',
						'settings'        => 'subetuweb_breadcrumbs_link_color_hover',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_breadcrumbs',
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'subetuweb_general_scroll_top',
				array(
					'title'    => esc_html__( 'Scroll To Top', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Scroll To Top
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top',
				array(
					'default'           => true,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_scroll_top',
					array(
						'label'    => esc_html__( 'Scroll Up Button', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_scroll_top',
						'settings' => 'subetuweb_scroll_top',
						'priority' => 10,
					)
				)
			);

			/**
			 * Scroll Top Arrow
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_arrow',
				array(
					'default'           => 'angle_up',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Icon_Select_Multi_Control(
					$wp_customize,
					'subetuweb_scroll_top_arrow',
					array(
						'label'           => esc_html__( 'Arrow Icon', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'type'            => 'select',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
						'choices'         => subetuwebwp_get_scrolltotop_icons( 'up_arrows' ),
					)
				)
			);

			/**
			 * Scroll Top Position
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'right',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_scroll_top_position',
					array(
						'label'           => esc_html__( 'Position', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'settings'        => 'subetuweb_scroll_top_position',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
						'choices'         => array(
							'left'  => esc_html__( 'Left', 'subetuwebwp' ),
							'right' => esc_html__( 'Right', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Scroll Top Bottom Position
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_bottom_position',
				array(
					'transport'         => 'postMessage',
					'default'           => '20',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_scroll_top_bottom_position',
					array(
						'label'           => esc_html__( 'Bottom Position (px)', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'settings'        => 'subetuweb_scroll_top_bottom_position',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Scroll Top Size
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_size',
				array(
					'transport'         => 'postMessage',
					'default'           => '40',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_scroll_top_size',
					array(
						'label'           => esc_html__( 'Button Size (px)', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'settings'        => 'subetuweb_scroll_top_size',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 60,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Scroll Top Icon Size
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_icon_size',
				array(
					'transport'         => 'postMessage',
					'default'           => '18',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_scroll_top_icon_size',
					array(
						'label'           => esc_html__( 'Icon Size (px)', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'settings'        => 'subetuweb_scroll_top_icon_size',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 60,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Scroll Top Border Radius
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_border_radius',
				array(
					'transport'         => 'postMessage',
					'default'           => '2',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_scroll_top_border_radius',
					array(
						'label'           => esc_html__( 'Border Radius (px)', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'settings'        => 'subetuweb_scroll_top_border_radius',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Scroll Top Background Color
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => 'rgba(0,0,0,0.4)',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_scroll_top_bg',
					array(
						'label'           => esc_html__( 'Background Color', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'settings'        => 'subetuweb_scroll_top_bg',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
					)
				)
			);

			/**
			 * Scroll Top Background Hover Color
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_bg_hover',
				array(
					'transport'         => 'postMessage',
					'default'           => 'rgba(0,0,0,0.8)',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_scroll_top_bg_hover',
					array(
						'label'           => esc_html__( 'Background Color: Hover', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'settings'        => 'subetuweb_scroll_top_bg_hover',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
					)
				)
			);

			/**
			 * Scroll Top Color
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_scroll_top_color',
					array(
						'label'           => esc_html__( 'Color', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'settings'        => 'subetuweb_scroll_top_color',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
					)
				)
			);

			/**
			 * Scroll Top Hover Color
			 */
			$wp_customize->add_setting(
				'subetuweb_scroll_top_color_hover',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_scroll_top_color_hover',
					array(
						'label'           => esc_html__( 'Color: Hover', 'subetuwebwp' ),
						'section'         => 'subetuweb_general_scroll_top',
						'settings'        => 'subetuweb_scroll_top_color_hover',
						'priority'        => 10,
						'active_callback' => 'subetuwebwp_cac_has_scrolltop',
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'subetuweb_general_pagination',
				array(
					'title'    => esc_html__( 'Pagination', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Pagination Align
			 */
			$wp_customize->add_setting(
				'subetuweb_pagination_align',
				array(
					'transport'         => 'postMessage',
					'default'           => 'right',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_pagination_align',
					array(
						'label'    => esc_html__( 'Align', 'subetuwebwp' ),
						'type'     => 'select',
						'section'  => 'subetuweb_general_pagination',
						'settings' => 'subetuweb_pagination_align',
						'priority' => 10,
						'choices'  => array(
							'right'  => esc_html__( 'Right', 'subetuwebwp' ),
							'center' => esc_html__( 'Center', 'subetuwebwp' ),
							'left'   => esc_html__( 'Left', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Pagination Font Size
			 */
			$wp_customize->add_setting(
				'subetuweb_pagination_font_size',
				array(
					'transport'         => 'postMessage',
					'default'           => '18',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_pagination_font_size',
					array(
						'label'       => esc_html__( 'Font Size (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_pagination',
						'settings'    => 'subetuweb_pagination_font_size',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Pagination Border Width
			 */
			$wp_customize->add_setting(
				'subetuweb_pagination_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_pagination_border_width',
					array(
						'label'       => esc_html__( 'Border Width (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_pagination',
						'settings'    => 'subetuweb_pagination_border_width',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 20,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Pagination Background Color
			 */
			$wp_customize->add_setting(
				'subetuweb_pagination_bg',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_pagination_bg',
					array(
						'label'    => esc_html__( 'Background Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_pagination',
						'settings' => 'subetuweb_pagination_bg',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Background Color Hover
			 */
			$wp_customize->add_setting(
				'subetuweb_pagination_hover_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#f8f8f8',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_pagination_hover_bg',
					array(
						'label'    => esc_html__( 'Background Color: Hover', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_pagination',
						'settings' => 'subetuweb_pagination_hover_bg',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Color
			 */
			$wp_customize->add_setting(
				'subetuweb_pagination_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#555555',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_pagination_color',
					array(
						'label'    => esc_html__( 'Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_pagination',
						'settings' => 'subetuweb_pagination_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Color Hover
			 */
			$wp_customize->add_setting(
				'subetuweb_pagination_hover_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_pagination_hover_color',
					array(
						'label'    => esc_html__( 'Color: Hover', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_pagination',
						'settings' => 'subetuweb_pagination_hover_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Border Color
			 */
			$wp_customize->add_setting(
				'subetuweb_pagination_border_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#e9e9e9',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_pagination_border_color',
					array(
						'label'    => esc_html__( 'Border Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_pagination',
						'settings' => 'subetuweb_pagination_border_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Border Color Hover
			 */
			$wp_customize->add_setting(
				'subetuweb_pagination_border_hover_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#e9e9e9',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_pagination_border_hover_color',
					array(
						'label'    => esc_html__( 'Border Color: Hover', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_pagination',
						'settings' => 'subetuweb_pagination_border_hover_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'subetuweb_general_forms',
				array(
					'title'    => esc_html__( 'Forms (Input - Textarea)', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Forms Label Color
			 */
			$wp_customize->add_setting(
				'subetuweb_label_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#929292',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_label_color',
					array(
						'label'    => esc_html__( 'Label Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_forms',
						'settings' => 'subetuweb_label_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Forms Padding
			 */
			$wp_customize->add_setting(
				'subetuweb_input_top_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '6',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_right_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '12',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '6',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_left_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '12',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_input_tablet_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_tablet_right_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_tablet_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_tablet_left_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_input_mobile_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_mobile_right_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_mobile_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_mobile_left_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Dimensions_Control(
					$wp_customize,
					'subetuweb_input_padding_dimensions',
					array(
						'label'       => esc_html__( 'Padding (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_forms',
						'settings'    => array(
							'desktop_top'    => 'subetuweb_input_top_padding',
							'desktop_right'  => 'subetuweb_input_right_padding',
							'desktop_bottom' => 'subetuweb_input_bottom_padding',
							'desktop_left'   => 'subetuweb_input_left_padding',
							'tablet_top'     => 'subetuweb_input_tablet_top_padding',
							'tablet_right'   => 'subetuweb_input_tablet_right_padding',
							'tablet_bottom'  => 'subetuweb_input_tablet_bottom_padding',
							'tablet_left'    => 'subetuweb_input_tablet_left_padding',
							'mobile_top'     => 'subetuweb_input_mobile_top_padding',
							'mobile_right'   => 'subetuweb_input_mobile_right_padding',
							'mobile_bottom'  => 'subetuweb_input_mobile_bottom_padding',
							'mobile_left'    => 'subetuweb_input_mobile_left_padding',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Forms Font Size
			 */
			$wp_customize->add_setting(
				'subetuweb_input_font_size',
				array(
					'transport'         => 'postMessage',
					'default'           => '14',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_input_font_size',
					array(
						'label'       => esc_html__( 'Font Size (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_forms',
						'settings'    => 'subetuweb_input_font_size',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Forms Border Width
			 */
			$wp_customize->add_setting(
				'subetuweb_input_top_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_right_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_bottom_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_left_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_input_tablet_top_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_tablet_right_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_tablet_bottom_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_tablet_left_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_input_mobile_top_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_mobile_right_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_mobile_bottom_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_input_mobile_left_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Dimensions_Control(
					$wp_customize,
					'subetuweb_input_border_width_dimensions',
					array(
						'label'       => esc_html__( 'Border Width (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_forms',
						'settings'    => array(
							'desktop_top'    => 'subetuweb_input_top_border_width',
							'desktop_right'  => 'subetuweb_input_right_border_width',
							'desktop_bottom' => 'subetuweb_input_bottom_border_width',
							'desktop_left'   => 'subetuweb_input_left_border_width',
							'tablet_top'     => 'subetuweb_input_tablet_top_border_width',
							'tablet_right'   => 'subetuweb_input_tablet_right_border_width',
							'tablet_bottom'  => 'subetuweb_input_tablet_bottom_border_width',
							'tablet_left'    => 'subetuweb_input_tablet_left_border_width',
							'mobile_top'     => 'subetuweb_input_mobile_top_border_width',
							'mobile_right'   => 'subetuweb_input_mobile_right_border_width',
							'mobile_bottom'  => 'subetuweb_input_mobile_bottom_border_width',
							'mobile_left'    => 'subetuweb_input_mobile_left_border_width',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Forms Border Radius
			 */
			$wp_customize->add_setting(
				'subetuweb_input_border_radius',
				array(
					'transport'         => 'postMessage',
					'default'           => '3',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_input_border_radius',
					array(
						'label'       => esc_html__( 'Border Radius (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_forms',
						'settings'    => 'subetuweb_input_border_radius',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Forms Border Color
			 */
			$wp_customize->add_setting(
				'subetuweb_input_border_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#dddddd',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_input_border_color',
					array(
						'label'    => esc_html__( 'Border Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_forms',
						'settings' => 'subetuweb_input_border_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Forms Border Color Focus
			 */
			$wp_customize->add_setting(
				'subetuweb_input_border_color_focus',
				array(
					'transport'         => 'postMessage',
					'default'           => '#bbbbbb',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_input_border_color_focus',
					array(
						'label'    => esc_html__( 'Border Color: Focus', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_forms',
						'settings' => 'subetuweb_input_border_color_focus',
						'priority' => 10,
					)
				)
			);

			/**
			 * Forms Background Color
			 */
			$wp_customize->add_setting(
				'subetuweb_input_background',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_input_background',
					array(
						'label'    => esc_html__( 'Background Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_forms',
						'settings' => 'subetuweb_input_background',
						'priority' => 10,
					)
				)
			);

			/**
			 * Forms Color
			 */
			$wp_customize->add_setting(
				'subetuweb_input_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_input_color',
					array(
						'label'    => esc_html__( 'Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_forms',
						'settings' => 'subetuweb_input_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'subetuweb_general_theme_button',
				array(
					'title'    => esc_html__( 'Theme Buttons', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Theme Buttons Padding
			 */
			$wp_customize->add_setting(
				'subetuweb_theme_button_top_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '14',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_theme_button_right_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '20',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_theme_button_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '14',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_theme_button_left_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '20',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_theme_button_tablet_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_theme_button_tablet_right_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_theme_button_tablet_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_theme_button_tablet_left_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'subetuweb_theme_button_mobile_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_theme_button_mobile_right_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_theme_button_mobile_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'subetuweb_theme_button_mobile_left_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'subetuwebwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Dimensions_Control(
					$wp_customize,
					'subetuweb_theme_button_padding_dimensions',
					array(
						'label'       => esc_html__( 'Padding (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_theme_button',
						'settings'    => array(
							'desktop_top'    => 'subetuweb_theme_button_top_padding',
							'desktop_right'  => 'subetuweb_theme_button_right_padding',
							'desktop_bottom' => 'subetuweb_theme_button_bottom_padding',
							'desktop_left'   => 'subetuweb_theme_button_left_padding',
							'tablet_top'     => 'subetuweb_theme_button_tablet_top_padding',
							'tablet_right'   => 'subetuweb_theme_button_tablet_right_padding',
							'tablet_bottom'  => 'subetuweb_theme_button_tablet_bottom_padding',
							'tablet_left'    => 'subetuweb_theme_button_tablet_left_padding',
							'mobile_top'     => 'subetuweb_theme_button_mobile_top_padding',
							'mobile_right'   => 'subetuweb_theme_button_mobile_right_padding',
							'mobile_bottom'  => 'subetuweb_theme_button_mobile_bottom_padding',
							'mobile_left'    => 'subetuweb_theme_button_mobile_left_padding',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Theme Buttons Border Radius
			 */
			$wp_customize->add_setting(
				'subetuweb_theme_button_border_radius',
				array(
					'transport'         => 'postMessage',
					'default'           => '0',
					'sanitize_callback' => 'subetuwebwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Range_Control(
					$wp_customize,
					'subetuweb_theme_button_border_radius',
					array(
						'label'       => esc_html__( 'Border Radius (px)', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_theme_button',
						'settings'    => 'subetuweb_theme_button_border_radius',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Theme Buttons Background Color
			 */
			$wp_customize->add_setting(
				'subetuweb_theme_button_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_theme_button_bg',
					array(
						'label'    => esc_html__( 'Background Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_theme_button',
						'settings' => 'subetuweb_theme_button_bg',
						'priority' => 10,
					)
				)
			);

			/**
			 * Theme Buttons Background Color Hover
			 */
			$wp_customize->add_setting(
				'subetuweb_theme_button_hover_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#0b7cac',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_theme_button_hover_bg',
					array(
						'label'    => esc_html__( 'Background Color: Hover', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_theme_button',
						'settings' => 'subetuweb_theme_button_hover_bg',
						'priority' => 10,
					)
				)
			);

			/**
			 * Theme Buttons Color
			 */
			$wp_customize->add_setting(
				'subetuweb_theme_button_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_theme_button_color',
					array(
						'label'    => esc_html__( 'Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_theme_button',
						'settings' => 'subetuweb_theme_button_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Theme Buttons Color Hover
			 */
			$wp_customize->add_setting(
				'subetuweb_theme_button_hover_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_theme_button_hover_color',
					array(
						'label'    => esc_html__( 'Color: Hover', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_theme_button',
						'settings' => 'subetuweb_theme_button_hover_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'subetuweb_general_error_page',
				array(
					'title'    => esc_html__( '404 Error Page', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Blank Page
			 */
			$wp_customize->add_setting(
				'subetuweb_error_page_blank',
				array(
					'default'           => 'off',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_error_page_blank',
					array(
						'label'       => esc_html__( 'Blank Page', 'subetuwebwp' ),
						'description' => esc_html__( 'Enable this option to remove all the elements and have full control of the 404 error page.', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_error_page',
						'settings'    => 'subetuweb_error_page_blank',
						'priority'    => 10,
						'choices'     => array(
							'on'  => esc_html__( 'On', 'subetuwebwp' ),
							'off' => esc_html__( 'Off', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Page 404 Logo
			 */
			$wp_customize->add_setting(
				'subetuweb_404_logo',
				array(
					'default'           => '',
					'sanitize_callback' => 'subetuwebwp_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'subetuweb_404_logo',
					array(
						'label'       => esc_html__( '404 Logo', 'subetuwebwp' ),
						'description' => esc_html__( 'Select a 404 logo.', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_error_page',
						'settings'    => 'subetuweb_404_logo',
						'priority'    => 10,
					)
				)
			);

			/**
			 * Layout
			 */
			$wp_customize->add_setting(
				'subetuweb_error_page_layout',
				array(
					'default'           => 'full-width',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Radio_Image_Control(
					$wp_customize,
					'subetuweb_error_page_layout',
					array(
						'label'    => esc_html__( 'Layout', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_error_page',
						'settings' => 'subetuweb_error_page_layout',
						'priority' => 10,
						'choices'  => array(
							'full-width'  => subetuwebWP_INC_DIR_URI . 'customizer/assets/img/fw.png',
							'full-screen' => subetuwebWP_INC_DIR_URI . 'customizer/assets/img/fs.png',
						),
					)
				)
			);

			/**
			 * Template
			 */
			$wp_customize->add_setting(
				'subetuweb_error_page_template',
				array(
					'default'           => '0',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_error_page_template',
					array(
						'label'       => esc_html__( 'Select Template', 'subetuwebwp' ),
						'description' => esc_html__( 'Choose a template created in Theme Panel > My Library.', 'subetuwebwp' ),
						'type'        => 'select',
						'section'     => 'subetuweb_general_error_page',
						'settings'    => 'subetuweb_error_page_template',
						'priority'    => 10,
						'choices'     => subetuwebwp_customizer_helpers( 'library' ),
					)
				)
			);

			/**
			 * Section Theme Icons
			 *
			 * @since 2.0
			 */
			$wp_customize->add_section(
				'subetuweb_general_theme_icons',
				array(
					'title'    => esc_html__( 'Theme Icons', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Choose Default Theme Icons
			 */
			$wp_customize->add_setting(
				'subetuweb_theme_default_icons',
				array(
					'default'           => 'sili',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_theme_default_icons',
					array(
						'label'       => esc_html__( 'Select Icons', 'subetuwebwp' ),
						'description' => esc_html__( 'Choose icons you would like to use in the theme.', 'subetuwebwp' ),
						'type'        => 'select',
						'section'     => 'subetuweb_general_theme_icons',
						'settings'    => 'subetuweb_theme_default_icons',
						'priority'    => 10,
						'choices'     => array(
							'svg'  => esc_html__( 'subetuweb SVG Icons', 'subetuwebwp' ),
							'sili' => esc_html__( 'Simple Line Icons', 'subetuwebwp' ),
							'fai'  => esc_html__( 'Font Awesome Icons', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Disable subetuwebWP SVG Icons
			 */
			$wp_customize->add_setting(
				'subetuweb_disable_svg_icons',
				array(
					'default'           => true,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_disable_svg_icons',
					array(
						'label'    => esc_html__( 'Disable subetuweb SVG Icons', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_theme_icons',
						'priority' => 10,
					)
				)
			);

			/**
			 * Blog Entries Meta Icons Color
			 */
			$wp_customize->add_setting(
				'subetuweb_theme_blog_posts_icons_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_theme_blog_posts_icons_color',
					array(
						'label'    => esc_html__( 'Blog Entries Icons: Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_theme_icons',
						'settings' => 'subetuweb_theme_blog_posts_icons_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Single Blog Post Meta Icons Color
			 */
			$wp_customize->add_setting(
				'subetuweb_theme_single_post_icons_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'subetuwebwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Color_Control(
					$wp_customize,
					'subetuweb_theme_single_post_icons_color',
					array(
						'label'    => esc_html__( 'Single Post Icons: Color', 'subetuwebwp' ),
						'section'  => 'subetuweb_general_theme_icons',
						'settings' => 'subetuweb_theme_single_post_icons_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section SEO
			 *
			 * @since 3.0.0
			 */
			$wp_customize->add_section(
				'subetuweb_general_seo_settings',
				array(
					'title'    => esc_html__( 'SEO Settings', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Enable image alt text on blog entry featured images
			 */
			$wp_customize->add_setting(
				'subetuweb_enable_be_fimage_alt',
				array(
					'default'           => false,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_enable_be_fimage_alt',
					array(
						'label'    => esc_html__( 'Use featured image ALT text on blog entries', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_seo_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Enable image alt text on single post featured images
			 */
			$wp_customize->add_setting(
				'subetuweb_enable_sp_fimage_alt',
				array(
					'default'           => false,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_enable_sp_fimage_alt',
					array(
						'label'    => esc_html__( 'Use featured image ALT text on single posts', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_seo_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Enable image alt text on single post featured images
			 */
			$wp_customize->add_setting(
				'subetuweb_enable_srp_fimage_alt',
				array(
					'default'           => false,
					'sanitize_callback' => 'subetuwebwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'subetuweb_enable_srp_fimage_alt',
					array(
						'label'    => esc_html__( 'Use featured image ALT text on single post related items', 'subetuwebwp' ),
						'type'     => 'checkbox',
						'section'  => 'subetuweb_general_seo_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Call Performance Section
			 *
			 * @since 3.0.3
			 * @return void
			 */
			$this->performance_section( $wp_customize, $panel );
		}

		/**
		 * Performance Section
		 *
		 * @return void
		 *
		 * @since 3.0.3
		 */
		private function performance_section( $wp_customize, $panel ) {
			/**
			 * Section
			 */
			$wp_customize->add_section(
				'subetuweb_general_performance_section',
				array(
					'title'    => esc_html__( 'Performance', 'subetuwebwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Emoji
			 */
			$wp_customize->add_setting(
				'subetuweb_performance_emoji',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enable',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_performance_emoji',
					array(
						'label'       => esc_html__( 'Emoji', 'subetuwebwp' ),
						'description' => esc_html__( 'This style is all the css for the WP emoji.', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_performance_section',
						'settings'    => 'subetuweb_performance_emoji',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'subetuwebwp' ),
							'enabled'  => esc_html__( 'Enabled', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Font Awesome Icons
			 */
			$wp_customize->add_setting(
				'subetuweb_performance_fontawesome',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_performance_fontawesome',
					array(
						'label'       => esc_html__( 'Font Awesome Icons', 'subetuwebwp' ),
						'description' => esc_html__( 'This style is all the css for the font awesome icons.', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_performance_section',
						'settings'    => 'subetuweb_performance_fontawesome',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'subetuwebwp' ),
							'enabled'  => esc_html__( 'Enabled', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Simple Line Icons
			 */
			$wp_customize->add_setting(
				'subetuweb_performance_simple_line_icons',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_performance_simple_line_icons',
					array(
						'label'       => esc_html__( 'Simple Line Icons', 'subetuwebwp' ),
						'description' => esc_html__( 'This style is all the css for the simple line icons.', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_performance_section',
						'settings'    => 'subetuweb_performance_simple_line_icons',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'subetuwebwp' ),
							'enabled'  => esc_html__( 'Enabled', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Lightbox
			 */
			$wp_customize->add_setting(
				'subetuweb_performance_lightbox',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_performance_lightbox',
					array(
						'label'       => esc_html__( 'Lightbox', 'subetuwebwp' ),
						'description' => esc_html__( 'This script enables you to overlay your images on the current page, used for the gallerie, single product and content images.', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_performance_section',
						'settings'    => 'subetuweb_performance_lightbox',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'subetuwebwp' ),
							'enabled'  => esc_html__( 'Enabled', 'subetuwebwp' ),
						),
					)
				)
			);

			/**
			 * Custom Select
			 */
			$wp_customize->add_setting(
				'subetuweb_performance_custom_select',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'subetuwebwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new subetuwebWP_Customizer_Buttonset_Control(
					$wp_customize,
					'subetuweb_performance_custom_select',
					array(
						'label'       => esc_html__( 'Custom Select', 'subetuwebwp' ),
						'description' => esc_html__( 'This script uses the native select box and add overlays a stylable <span> element in order to acheive the desired look.', 'subetuwebwp' ),
						'section'     => 'subetuweb_general_performance_section',
						'settings'    => 'subetuweb_performance_custom_select',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'subetuwebwp' ),
							'enabled'  => esc_html__( 'Enabled', 'subetuwebwp' ),
						),
					)
				)
			);
		}

		/**
		 * Helpers
		 *
		 * @since 1.0.0
		 * @param object $return    return template.
		 */
		public static function helpers( $return = null ) {

			// Return elementor templates array.
			if ( 'elementor' === $return ) {
				$templates     = array( esc_html__( 'Default', 'subetuwebwp' ) );
				$get_templates = get_posts(
					array(
						'post_type'   => 'elementor_library',
						'numberposts' => -1,
						'post_status' => 'publish',
					)
				);

				if ( ! empty( $get_templates ) ) {
					foreach ( $get_templates as $template ) {
						$templates[ $template->ID ] = $template->post_title;
					}
				}

				return $templates;
			}

		}

		/**
		 * Get post types
		 *
		 * @since 1.3.7
		 * @param object $args    post type.
		 */
		private static function get_post_types( $args = array() ) {
			$post_type_args = array(
				'show_in_nav_menus' => true,
			);

			if ( ! empty( $args['post_type'] ) ) {
				$post_type_args['name'] = $args['post_type'];
			}

			$_post_types = get_post_types( $post_type_args, 'objects' );

			$post_types        = array();
			$post_types['any'] = esc_html__( 'All Post Types', 'subetuwebwp' );

			foreach ( $_post_types as $post_type => $object ) {
				$post_types[ $post_type ] = $object->label;
			}

			return $post_types;
		}

		/**
		 * Generates arrays of elements to target
		 *
		 * @since 1.0.0
		 * @param object $return    return value.
		 */
		private static function primary_color_arrays( $return ) {

			// Texts.
			$texts = apply_filters(
				'subetuweb_primary_texts',
				array(
					'a:hover',
					'a.light:hover',
					'.theme-heading .text::before',
					'.theme-heading .text::after',
					'#top-bar-content > a:hover',
					'#top-bar-social li.subetuwebwp-email a:hover',
					'#site-navigation-wrap .dropdown-menu > li > a:hover',
					'#site-header.medium-header #medium-searchform button:hover',
					'.subetuwebwp-mobile-menu-icon a:hover',
					'.blog-entry.post .blog-entry-header .entry-title a:hover',
					'.blog-entry.post .blog-entry-readmore a:hover',
					'.blog-entry.thumbnail-entry .blog-entry-category a',
					'ul.meta li a:hover',
					'.dropcap',
					'.single nav.post-navigation .nav-links .title',
					'body .related-post-title a:hover',
					'body #wp-calendar caption',
					'body .contact-info-widget.default i',
					'body .contact-info-widget.big-icons i',
					'body .custom-links-widget .subetuwebwp-custom-links li a:hover',
					'body .custom-links-widget .subetuwebwp-custom-links li a:hover:before',
					'body .posts-thumbnails-widget li a:hover',
					'body .social-widget li.subetuwebwp-email a:hover',
					'.comment-author .comment-meta .comment-reply-link',
					'#respond #cancel-comment-reply-link:hover',
					'#footer-widgets .footer-box a:hover',
					'#footer-bottom a:hover',
					'#footer-bottom #footer-bottom-menu a:hover',
					'.sidr a:hover',
					'.sidr-class-dropdown-toggle:hover',
					'.sidr-class-menu-item-has-children.active > a',
					'.sidr-class-menu-item-has-children.active > a > .sidr-class-dropdown-toggle',
					'input[type=checkbox]:checked:before',
				)
			);

			// SVG Icon color.
			$svg_icons = apply_filters(
				'subetuweb_primary_svg_icons',
				array(
					'.single nav.post-navigation .nav-links .title .owp-icon use',
					'.blog-entry.post .blog-entry-readmore a:hover .owp-icon use',
					'body .contact-info-widget.default .owp-icon use',
					'body .contact-info-widget.big-icons .owp-icon use',
				)
			);

			// Backgrounds.
			$backgrounds = apply_filters(
				'subetuweb_primary_backgrounds',
				array(
					'input[type="button"]',
					'input[type="reset"]',
					'input[type="submit"]',
					'button[type="submit"]',
					'.button',
					'#site-navigation-wrap .dropdown-menu > li.btn > a > span',
					'.thumbnail:hover i',
					'.post-quote-content',
					'.omw-modal .omw-close-modal',
					'body .contact-info-widget.big-icons li:hover i',
					'body div.wpforms-container-full .wpforms-form input[type=submit]',
					'body div.wpforms-container-full .wpforms-form button[type=submit]',
					'body div.wpforms-container-full .wpforms-form .wpforms-page-button',
				)
			);

			// Borders.
			$borders = apply_filters(
				'subetuweb_primary_borders',
				array(
					'.widget-title',
					'blockquote',
					'#searchform-dropdown',
					'.dropdown-menu .sub-menu',
					'.blog-entry.large-entry .blog-entry-readmore a:hover',
					'.subetuwebwp-newsletter-form-wrap input[type="email"]:focus',
					'.social-widget li.subetuwebwp-email a:hover',
					'#respond #cancel-comment-reply-link:hover',
					'body .contact-info-widget.big-icons li:hover i',
					'#footer-widgets .subetuwebwp-newsletter-form-wrap input[type="email"]:focus',
				)
			);

			// Return array.
			if ( 'texts' === $return ) {
				return $texts;
			} elseif ( 'svg_icons' === $return ) {
				return $svg_icons;
			} elseif ( 'backgrounds' === $return ) {
				return $backgrounds;
			} elseif ( 'borders' === $return ) {
				return $borders;
			}

		}

		/**
		 * Generates array of elements to target
		 *
		 * @since 1.0.0
		 * @param object $return    return value.
		 */
		private static function hover_primary_color_array( $return ) {

			// Hover backgrounds.
			$hover = apply_filters(
				'subetuweb_hover_primary_backgrounds',
				array(
					'input[type="button"]:hover',
					'input[type="reset"]:hover',
					'input[type="submit"]:hover',
					'button[type="submit"]:hover',
					'input[type="button"]:focus',
					'input[type="reset"]:focus',
					'input[type="submit"]:focus',
					'button[type="submit"]:focus',
					'.button:hover',
					'#site-navigation-wrap .dropdown-menu > li.btn > a:hover > span',
					'.post-quote-author',
					'.omw-modal .omw-close-modal:hover',
					'body div.wpforms-container-full .wpforms-form input[type=submit]:hover',
					'body div.wpforms-container-full .wpforms-form button[type=submit]:hover',
					'body div.wpforms-container-full .wpforms-form .wpforms-page-button:hover',
				)
			);

			// Return array.
			if ( 'hover' === $return ) {
				return $hover;
			}

		}

		/**
		 * Returns array of elements and border style to apply
		 *
		 * @since 1.0.0
		 */
		private static function main_border_array() {

			return apply_filters(
				'subetuweb_border_color_elements',
				array(

					// General.
					'table th',
					'table td',
					'hr',
					'.content-area',
					'body.content-left-sidebar #content-wrap .content-area,
					.content-left-sidebar .content-area',

					// Top bar.
					'#top-bar-wrap',

					// Header.
					'#site-header',

					// Search top header.
					'#site-header.top-header #search-toggle',

					// Dropdown.
					'.dropdown-menu ul li',

					// Page header.
					'.centered-minimal-page-header',

					// Blog.
					'.blog-entry.post',

					'.blog-entry.grid-entry .blog-entry-inner',

					'.blog-entry.thumbnail-entry .blog-entry-bottom',

					'.single-post .entry-title',

					'.single .entry-share-wrap .entry-share',
					'.single .entry-share',
					'.single .entry-share ul li a',

					'.single nav.post-navigation',
					'.single nav.post-navigation .nav-links .nav-previous',

					'#author-bio',
					'#author-bio .author-bio-avatar',
					'#author-bio .author-bio-social li a',

					'#related-posts',

					'#comments',
					'.comment-body',
					'#respond #cancel-comment-reply-link',

					'#blog-entries .type-page',

					// Pagination.
					'.page-numbers a,
					.page-numbers span:not(.elementor-screen-only),
					.page-links span',

					// Widgets.
					'body #wp-calendar caption,
					body #wp-calendar th,
					body #wp-calendar tbody',

					'body .contact-info-widget.default i,
					body .contact-info-widget.big-icons i',

					'body .posts-thumbnails-widget li',

					'body .tagcloud a',

				)
			);

		}

		/**
		 * Get CSS
		 *
		 * @param obj $output    css output.
		 * @since 1.0.0
		 */
		public function head_css( $output ) {

			// Global vars.
			$primary_color                 = get_theme_mod( 'subetuweb_primary_color', '#13aff0' );
			$hover_primary_color           = get_theme_mod( 'subetuweb_hover_primary_color', '#0b7cac' );
			$main_border_color             = get_theme_mod( 'subetuweb_main_border_color', '#e9e9e9' );
			$background_color              = get_theme_mod( 'subetuweb_background_color', '#ffffff' );
			$background_image              = get_theme_mod( 'subetuweb_background_image' );
			$background_image_position     = get_theme_mod( 'subetuweb_background_image_position' );
			$background_image_attachment   = get_theme_mod( 'subetuweb_background_image_attachment' );
			$background_image_repeat       = get_theme_mod( 'subetuweb_background_image_repeat' );
			$background_image_size         = get_theme_mod( 'subetuweb_background_image_size' );
			$links_color                   = get_theme_mod( 'subetuweb_links_color', '#333333' );
			$links_color_hover             = get_theme_mod( 'subetuweb_links_color_hover', '#13aff0' );
			$boxed_width                   = get_theme_mod( 'subetuweb_boxed_width', '1280' );
			$boxed_outside_bg              = get_theme_mod( 'subetuweb_boxed_outside_bg', '#e9e9e9' );
			$separate_outside_bg           = get_theme_mod( 'subetuweb_separate_outside_bg', '#f1f1f1' );
			$boxed_inner_bg                = get_theme_mod( 'subetuweb_boxed_inner_bg', '#ffffff' );
			$separate_content_padding      = get_theme_mod( 'subetuweb_separate_content_padding', '30px' );
			$separate_widgets_padding      = get_theme_mod( 'subetuweb_separate_widgets_padding', '30px' );
			$main_container_width          = get_theme_mod( 'subetuweb_main_container_width', '1200' );
			$left_container_width          = get_theme_mod( 'subetuweb_left_container_width', '72' );
			$sidebar_width                 = get_theme_mod( 'subetuweb_sidebar_width', '28' );
			$content_top_padding           = get_theme_mod( 'subetuweb_page_content_top_padding' );
			$content_bottom_padding        = get_theme_mod( 'subetuweb_page_content_bottom_padding' );
			$tablet_content_top_padding    = get_theme_mod( 'subetuweb_page_content_tablet_top_padding' );
			$tablet_content_bottom_padding = get_theme_mod( 'subetuweb_page_content_tablet_bottom_padding' );
			$mobile_content_top_padding    = get_theme_mod( 'subetuweb_page_content_mobile_top_padding' );
			$mobile_content_bottom_padding = get_theme_mod( 'subetuweb_page_content_mobile_bottom_padding' );
			$title_breadcrumb_position     = get_theme_mod( 'subetuweb_page_header_bg_title_breadcrumb_position', 'center' );
			$page_header_top_padding       = get_theme_mod( 'subetuweb_page_header_top_padding', '34' );
			$page_header_bottom_padding    = get_theme_mod( 'subetuweb_page_header_bottom_padding', '34' );
			$tablet_ph_top_padding         = get_theme_mod( 'subetuweb_page_header_tablet_top_padding' );
			$tablet_ph_bottom_padding      = get_theme_mod( 'subetuweb_page_header_tablet_bottom_padding' );
			$mobile_ph_top_padding         = get_theme_mod( 'subetuweb_page_header_mobile_top_padding' );
			$mobile_ph_bottom_padding      = get_theme_mod( 'subetuweb_page_header_mobile_bottom_padding' );
			$page_header_title_color       = get_theme_mod( 'subetuweb_page_header_title_color' );
			$breadcrumbs_text_color        = get_theme_mod( 'subetuweb_breadcrumbs_text_color', '#c6c6c6' );
			$breadcrumbs_seperator_color   = get_theme_mod( 'subetuweb_breadcrumbs_seperator_color', '#c6c6c6' );
			$breadcrumbs_link_color        = get_theme_mod( 'subetuweb_breadcrumbs_link_color', '#333333' );
			$breadcrumbs_link_color_hover  = get_theme_mod( 'subetuweb_breadcrumbs_link_color_hover', '#13aff0' );
			$scroll_top_bottom_position    = get_theme_mod( 'subetuweb_scroll_top_bottom_position', '20' );
			$scroll_top_size               = get_theme_mod( 'subetuweb_scroll_top_size', '40' );
			$scroll_top_icon_size          = get_theme_mod( 'subetuweb_scroll_top_icon_size', '18' );
			$scroll_top_border_radius      = get_theme_mod( 'subetuweb_scroll_top_border_radius', '2' );
			$scroll_top_bg                 = get_theme_mod( 'subetuweb_scroll_top_bg', 'rgba(0,0,0,0.4)' );
			$scroll_top_bg_hover           = get_theme_mod( 'subetuweb_scroll_top_bg_hover', 'rgba(0,0,0,0.8)' );
			$scroll_top_color              = get_theme_mod( 'subetuweb_scroll_top_color', '#ffffff' );
			$scroll_top_color_hover        = get_theme_mod( 'subetuweb_scroll_top_color_hover', '#ffffff' );
			$pagination_font_size          = get_theme_mod( 'subetuweb_pagination_font_size', '18' );
			$pagination_border_width       = get_theme_mod( 'subetuweb_pagination_border_width', '1' );
			$pagination_bg                 = get_theme_mod( 'subetuweb_pagination_bg' );
			$pagination_hover_bg           = get_theme_mod( 'subetuweb_pagination_hover_bg', '#f8f8f8' );
			$pagination_color              = get_theme_mod( 'subetuweb_pagination_color', '#555555' );
			$pagination_hover_color        = get_theme_mod( 'subetuweb_pagination_hover_color', '#333333' );
			$pagination_border_color       = get_theme_mod( 'subetuweb_pagination_border_color', '#e9e9e9' );
			$pagination_border_hover_color = get_theme_mod( 'subetuweb_pagination_border_hover_color', '#e9e9e9' );
			$label_color                   = get_theme_mod( 'subetuweb_label_color', '#929292' );
			$input_top_padding             = get_theme_mod( 'subetuweb_input_top_padding', '6' );
			$input_right_padding           = get_theme_mod( 'subetuweb_input_right_padding', '12' );
			$input_bottom_padding          = get_theme_mod( 'subetuweb_input_bottom_padding', '6' );
			$input_left_padding            = get_theme_mod( 'subetuweb_input_left_padding', '12' );
			$tablet_input_top_padding      = get_theme_mod( 'subetuweb_input_tablet_top_padding' );
			$tablet_input_right_padding    = get_theme_mod( 'subetuweb_input_tablet_right_padding' );
			$tablet_input_bottom_padding   = get_theme_mod( 'subetuweb_input_tablet_bottom_padding' );
			$tablet_input_left_padding     = get_theme_mod( 'subetuweb_input_tablet_left_padding' );
			$mobile_input_top_padding      = get_theme_mod( 'subetuweb_input_mobile_top_padding' );
			$mobile_input_right_padding    = get_theme_mod( 'subetuweb_input_mobile_right_padding' );
			$mobile_input_bottom_padding   = get_theme_mod( 'subetuweb_input_mobile_bottom_padding' );
			$mobile_input_left_padding     = get_theme_mod( 'subetuweb_input_mobile_left_padding' );
			$input_font_size               = get_theme_mod( 'subetuweb_input_font_size', '14' );
			$input_top_border_width        = get_theme_mod( 'subetuweb_input_top_border_width', '1' );
			$input_right_border_width      = get_theme_mod( 'subetuweb_input_right_border_width', '1' );
			$input_bottom_border_width     = get_theme_mod( 'subetuweb_input_bottom_border_width', '1' );
			$input_left_border_width       = get_theme_mod( 'subetuweb_input_left_border_width', '1' );
			$tablet_input_top_bw           = get_theme_mod( 'subetuweb_input_tablet_top_border_width' );
			$tablet_input_right_bw         = get_theme_mod( 'subetuweb_input_tablet_right_border_width' );
			$tablet_input_bottom_bw        = get_theme_mod( 'subetuweb_input_tablet_bottom_border_width' );
			$tablet_input_left_bw          = get_theme_mod( 'subetuweb_input_tablet_left_border_width' );
			$mobile_input_top_bw           = get_theme_mod( 'subetuweb_input_mobile_top_border_width' );
			$mobile_input_right_bw         = get_theme_mod( 'subetuweb_input_mobile_right_border_width' );
			$mobile_input_bottom_bw        = get_theme_mod( 'subetuweb_input_mobile_bottom_border_width' );
			$mobile_input_left_bw          = get_theme_mod( 'subetuweb_input_mobile_left_border_width' );
			$input_border_radius           = get_theme_mod( 'subetuweb_input_border_radius', '3' );
			$input_border_color            = get_theme_mod( 'subetuweb_input_border_color', '#dddddd' );
			$input_border_color_focus      = get_theme_mod( 'subetuweb_input_border_color_focus', '#bbbbbb' );
			$input_background              = get_theme_mod( 'subetuweb_input_background' );
			$input_color                   = get_theme_mod( 'subetuweb_input_color', '#333333' );
			$theme_button_top_padding      = get_theme_mod( 'subetuweb_theme_button_top_padding', '14' );
			$theme_button_right_padding    = get_theme_mod( 'subetuweb_theme_button_right_padding', '20' );
			$theme_button_bottom_padding   = get_theme_mod( 'subetuweb_theme_button_bottom_padding', '14' );
			$theme_button_left_padding     = get_theme_mod( 'subetuweb_theme_button_left_padding', '20' );
			$tablet_tb_top_padding         = get_theme_mod( 'subetuweb_theme_button_tablet_top_padding' );
			$tablet_tb_right_padding       = get_theme_mod( 'subetuweb_theme_button_tablet_right_padding' );
			$tablet_tb_bottom_padding      = get_theme_mod( 'subetuweb_theme_button_tablet_bottom_padding' );
			$tablet_tb_left_padding        = get_theme_mod( 'subetuweb_theme_button_tablet_left_padding' );
			$mobile_tb_top_padding         = get_theme_mod( 'subetuweb_theme_button_mobile_top_padding' );
			$mobile_tb_right_padding       = get_theme_mod( 'subetuweb_theme_button_mobile_right_padding' );
			$mobile_tb_bottom_padding      = get_theme_mod( 'subetuweb_theme_button_mobile_bottom_padding' );
			$mobile_tb_left_padding        = get_theme_mod( 'subetuweb_theme_button_mobile_left_padding' );
			$theme_button_border_radius    = get_theme_mod( 'subetuweb_theme_button_border_radius', '0' );
			$theme_button_bg               = get_theme_mod( 'subetuweb_theme_button_bg', '#13aff0' );
			$theme_button_hover_bg         = get_theme_mod( 'subetuweb_theme_button_hover_bg', '#0b7cac' );
			$theme_button_color            = get_theme_mod( 'subetuweb_theme_button_color', '#ffffff' );
			$theme_button_hover_color      = get_theme_mod( 'subetuweb_theme_button_hover_color', '#ffffff' );
			$theme_blog_icons_color        = get_theme_mod( 'subetuweb_theme_blog_posts_icons_color', '#333333' );
			$theme_post_icons_color        = get_theme_mod( 'subetuweb_theme_single_post_icons_color', '#333333' );

			// Both sidebars page layout.
			$page_layout            = get_theme_mod( 'subetuweb_page_single_layout', 'right-sidebar' );
			$bs_page_content_width  = get_theme_mod( 'subetuweb_page_single_both_sidebars_content_width' );
			$bs_page_sidebars_width = get_theme_mod( 'subetuweb_page_single_both_sidebars_sidebars_width' );

			// Both sidebars search layout.
			$search_layout            = get_theme_mod( 'subetuweb_search_layout', 'right-sidebar' );
			$bs_search_content_width  = get_theme_mod( 'subetuweb_search_both_sidebars_content_width' );
			$bs_search_sidebars_width = get_theme_mod( 'subetuweb_search_both_sidebars_sidebars_width' );

			// Meta.
			$meta_breadcrumbs_text_color       = get_post_meta( subetuwebwp_post_id(), 'subetuweb_breadcrumbs_color', true );
			$meta_breadcrumbs_seperator_color  = get_post_meta( subetuwebwp_post_id(), 'subetuweb_breadcrumbs_separator_color', true );
			$meta_breadcrumbs_link_color       = get_post_meta( subetuwebwp_post_id(), 'subetuweb_breadcrumbs_links_color', true );
			$meta_breadcrumbs_link_color_hover = get_post_meta( subetuwebwp_post_id(), 'subetuweb_breadcrumbs_links_hover_color', true );
			$meta_breadcrumbs_link_color_hover = get_post_meta( subetuwebwp_post_id(), 'subetuweb_breadcrumbs_links_hover_color', true );

			// Define css var.
			$css                        = '';
			$content_padding_css        = '';
			$tablet_content_padding_css = '';
			$mobile_content_padding_css = '';

			// Get primary color arrays.
			$texts       = self::primary_color_arrays( 'texts' );
			$svg_icons   = self::primary_color_arrays( 'svg_icons' );
			$backgrounds = self::primary_color_arrays( 'backgrounds' );
			$borders     = self::primary_color_arrays( 'borders' );

			// Get hover primary color arrays.
			$hover_primary = self::hover_primary_color_array( 'hover' );

			// Get hover primary color arrays.
			$main_border = self::main_border_array();

			// Texts.
			if ( ! empty( $texts ) && '#13aff0' != $primary_color ) {
				$css .= implode( ',', $texts ) . '{color:' . $primary_color . ';}';
				$css .= implode( ',', $svg_icons ) . '{stroke:' . $primary_color . ';}';
			}

			// Backgrounds.
			if ( ! empty( $backgrounds ) && '#13aff0' != $primary_color ) {
				$css .= implode( ',', $backgrounds ) . '{background-color:' . $primary_color . ';}';
				$css .= '.thumbnail:hover .link-post-svg-icon{background-color:' . $primary_color . ';}';
				$css .= 'body .contact-info-widget.big-icons li:hover .owp-icon{background-color:' . $primary_color . ';}';
			}

			// Borders.
			if ( ! empty( $borders ) && '#13aff0' != $primary_color ) {
				foreach ( $borders as $key => $val ) {
					if ( is_array( $val ) ) {
						$css .= $key . '{';
						foreach ( $val as $key => $val ) {
							$css .= 'border-' . $val . '-color:' . $primary_color . ';';
						}
						$css .= '}';
					} else {
						$css .= $val . '{border-color:' . $primary_color . ';}';
					}
				}
			}

			// Blockquotes color.
			if ( ! empty( $primary_color ) && '#13aff0' != $primary_color ) {
				$css .= 'blockquote, .wp-block-quote{border-left-color:' . $primary_color . ';}';
				$css .= 'body .contact-info-widget.big-icons li:hover .owp-icon{border-color:' . $primary_color . ';}';
			}

			// Hover primary color.
			if ( ! empty( $hover_primary ) && '#0b7cac' != $hover_primary_color ) {
				$css .= implode( ',', $hover_primary ) . '{background-color:' . $hover_primary_color . ';}';
			}

			// Main border color.
			if ( ! empty( $main_border ) && '#e9e9e9' != $main_border_color ) {
				$css .= implode( ',', $main_border ) . '{border-color:' . $main_border_color . ';}';
				$css .= 'body .contact-info-widget.big-icons .owp-icon, body .contact-info-widget.default .owp-icon{border-color:' . $main_border_color . ';}';
			}

			// Get site background color.
			if ( ! empty( $background_color ) && '#ffffff' != $background_color ) {
				$css .= 'body, .has-parallax-footer:not(.separate-layout) #main{background-color:' . $background_color . ';}';
			}

			// Get site background image.
			if ( ! empty( $background_image ) ) {
				$css .= 'body{background-image:url(' . $background_image . ');}';
			}

			// Get site background position.
			if ( ! empty( $background_image_position ) && 'initial' != $background_image_position ) {
				$css .= 'body{background-position:' . $background_image_position . ';}';
			}

			// Get site background attachment.
			if ( ! empty( $background_image_attachment ) && 'initial' != $background_image_attachment ) {
				$css .= 'body{background-attachment:' . $background_image_attachment . ';}';
			}

			// Get site background repeat.
			if ( ! empty( $background_image_repeat ) && 'initial' != $background_image_repeat ) {
				$css .= 'body{background-repeat:' . $background_image_repeat . ';}';
			}

			// Get site background size.
			if ( ! empty( $background_image_size ) && 'initial' != $background_image_size ) {
				$css .= 'body{background-size:' . $background_image_size . ';}';
			}

			// Links color.
			if ( ! empty( $links_color ) && '#333333' != $links_color ) {
				$css .= 'a{color:' . $links_color . ';}';
				$css .= 'a .owp-icon use {stroke:' . $links_color . ';}';
			}

			// Links color hover.
			if ( ! empty( $links_color_hover ) && '#13aff0' != $links_color_hover ) {
				$css .= 'a:hover{color:' . $links_color_hover . ';}';
				$css .= 'a:hover .owp-icon use {stroke:' . $links_color_hover . ';}';
			}

			// Boxed width.
			if ( ! empty( $boxed_width ) && '1280' != $boxed_width ) {
				$css .= '.boxed-layout #wrap, .boxed-layout .parallax-footer, .boxed-layout .owp-floating-bar{width:' . $boxed_width . 'px;}';
			}

			// Boxed outside background.
			if ( ! empty( $boxed_outside_bg ) && '#e9e9e9' != $boxed_outside_bg ) {
				$css .= '.boxed-layout{background-color:' . $boxed_outside_bg . ';}';
			}

			// Separate outside background.
			if ( ! empty( $separate_outside_bg ) && '#f1f1f1' != $separate_outside_bg ) {
				$css .= '.separate-layout, .has-parallax-footer.separate-layout #main{background-color:' . $separate_outside_bg . ';}';
			}

			// Boxed inner background.
			if ( ! empty( $boxed_inner_bg ) && '#ffffff' != $boxed_inner_bg ) {
				$css .= '.boxed-layout #wrap, .separate-layout .content-area, .separate-layout .widget-area .sidebar-box, body.separate-blog.separate-layout #blog-entries > *, body.separate-blog.separate-layout .subetuwebwp-pagination, body.separate-blog.separate-layout .blog-entry.grid-entry .blog-entry-inner, .has-parallax-footer:not(.separate-layout) #main{background-color:' . $boxed_inner_bg . ';}';
			}

			// Separate content padding.
			if ( ! empty( $separate_content_padding ) && '30px' != $separate_content_padding ) {
				$css .= '.separate-layout .content-area, .separate-layout.content-left-sidebar .content-area, .content-both-sidebars.scs-style .content-area, .separate-layout.content-both-sidebars.ssc-style .content-area, body.separate-blog.separate-layout #blog-entries > *, body.separate-blog.separate-layout .subetuwebwp-pagination, body.separate-blog.separate-layout .blog-entry.grid-entry .blog-entry-inner{padding:' . $separate_content_padding . ';}.separate-layout.content-full-width .content-area{padding:' . $separate_content_padding . ' !important;}';
			}

			// Separate widgets padding.
			if ( ! empty( $separate_widgets_padding ) && '30px' != $separate_widgets_padding ) {
				$css .= '.separate-layout .widget-area .sidebar-box{padding:' . $separate_widgets_padding . ';}';
			}

			// Content top padding.
			if ( ! empty( $main_container_width ) && '1200' != $main_container_width ) {
				$css .= '.container{width:' . $main_container_width . 'px;}';
			}

			// Content top padding.
			if ( ! empty( $left_container_width ) && '72' != $left_container_width ) {
				$css .= '@media only screen and (min-width: 960px){ .content-area, .content-left-sidebar .content-area{width:' . $left_container_width . '%;} }';
			}

			// Content top padding.
			if ( ! empty( $sidebar_width ) && '28' != $sidebar_width ) {
				$css .= '@media only screen and (min-width: 960px){ .widget-area, .content-left-sidebar .widget-area{width:' . $sidebar_width . '%;} }';
			}

			// Content top padding.
			if ( isset( $content_top_padding ) && '' != $content_top_padding ) {
				$content_padding_css .= 'padding-top:' . $content_top_padding . 'px;';
			}

			// Content bottom padding.
			if ( isset( $content_bottom_padding ) && '' != $content_bottom_padding ) {
				$content_padding_css .= 'padding-bottom:' . $content_bottom_padding . 'px;';
			}

			// Content padding css.
			if ( isset( $content_top_padding ) && '' != $content_top_padding
				|| isset( $content_bottom_padding ) && '' != $content_bottom_padding ) {
				$css .= '#main #content-wrap, .separate-layout #main #content-wrap{' . $content_padding_css . '}';
			}

			// Tablet content top padding.
			if ( isset( $tablet_content_top_padding ) && '' != $tablet_content_top_padding ) {
				$tablet_content_padding_css .= 'padding-top:' . $tablet_content_top_padding . 'px;';
			}

			// Tablet content bottom padding.
			if ( isset( $tablet_content_bottom_padding ) && '' != $tablet_content_bottom_padding ) {
				$tablet_content_padding_css .= 'padding-bottom:' . $tablet_content_bottom_padding . 'px;';
			}

			// Tablet content padding css.
			if ( isset( $tablet_content_top_padding ) && '' != $tablet_content_top_padding
				|| isset( $tablet_content_bottom_padding ) && '' != $tablet_content_bottom_padding ) {
				$css .= '@media (max-width: 768px){#main #content-wrap, .separate-layout #main #content-wrap{' . $tablet_content_padding_css . '}}';
			}

			// Mobile content top padding.
			if ( isset( $mobile_content_top_padding ) && '' != $mobile_content_top_padding ) {
				$mobile_content_padding_css .= 'padding-top:' . $mobile_content_top_padding . 'px;';
			}

			// Mobile content bottom padding.
			if ( isset( $mobile_content_bottom_padding ) && '' != $mobile_content_bottom_padding ) {
				$mobile_content_padding_css .= 'padding-bottom:' . $mobile_content_bottom_padding . 'px;';
			}

			// Mobile content padding css.
			if ( isset( $mobile_content_top_padding ) && '' != $mobile_content_top_padding
				|| isset( $mobile_content_bottom_padding ) && '' != $mobile_content_bottom_padding ) {
				$css .= '@media (max-width: 480px){#main #content-wrap, .separate-layout #main #content-wrap{' . $mobile_content_padding_css . '}}';
			}

			// Title/breadcrumb position.
			if ( ! empty( $title_breadcrumb_position ) && 'center' != $title_breadcrumb_position ) {
				$css .= '.background-image-page-header .page-header-inner, .background-image-page-header .site-breadcrumbs{text-align: ' . $title_breadcrumb_position . '}';
			}

			// Page header padding.
			if ( isset( $page_header_top_padding ) && '34' != $page_header_top_padding && '' != $page_header_top_padding
				|| isset( $page_header_bottom_padding ) && '34' != $page_header_bottom_padding && '' != $page_header_bottom_padding ) {
				$css .= '.page-header, .has-transparent-header .page-header{padding:' . subetuwebwp_spacing_css( $page_header_top_padding, '', $page_header_bottom_padding, '' ) . '}';
			}

			// Tablet page header padding.
			if ( isset( $tablet_ph_top_padding ) && '' != $tablet_ph_top_padding
				|| isset( $tablet_ph_bottom_padding ) && '' != $tablet_ph_bottom_padding ) {
				$css .= '@media (max-width: 768px){.page-header, .has-transparent-header .page-header{padding:' . subetuwebwp_spacing_css( $tablet_ph_top_padding, '', $tablet_ph_bottom_padding, '' ) . '}}';
			}

			// Mobile page header padding.
			if ( isset( $mobile_ph_top_padding ) && '' != $mobile_ph_top_padding
				|| isset( $mobile_ph_bottom_padding ) && '' != $mobile_ph_bottom_padding ) {
				$css .= '@media (max-width: 480px){.page-header, .has-transparent-header .page-header{padding:' . subetuwebwp_spacing_css( $mobile_ph_top_padding, '', $mobile_ph_bottom_padding, '' ) . '}}';
			}

			// Page header color.
			if ( ! empty( $page_header_title_color ) ) {
				$css .= '.page-header .page-header-title, .page-header.background-image-page-header .page-header-title{color:' . $page_header_title_color . ';}';
			}

			// Breadcrumbs text color.
			if ( ! empty( $breadcrumbs_text_color ) && '#c6c6c6' != $breadcrumbs_text_color ) {
				$css .= '.site-breadcrumbs, .background-image-page-header .site-breadcrumbs{color:' . $breadcrumbs_text_color . ';}';
			}

			// Breadcrumbs seperator color.
			if ( ! empty( $breadcrumbs_seperator_color ) && '#c6c6c6' != $breadcrumbs_seperator_color ) {
				$css .= '.site-breadcrumbs ul li .breadcrumb-sep, .site-breadcrumbs ol li .breadcrumb-sep{color:' . $breadcrumbs_seperator_color . ';}';
			}

			// Breadcrumbs link color.
			if ( ! empty( $breadcrumbs_link_color ) && '#333333' != $breadcrumbs_link_color ) {
				$css .= '.site-breadcrumbs a, .background-image-page-header .site-breadcrumbs a{color:' . $breadcrumbs_link_color . ';}';
				$css .= '.site-breadcrumbs a .owp-icon use, .background-image-page-header .site-breadcrumbs a .owp-icon use{stroke:' . $breadcrumbs_link_color . ';}';
			}

			// Breadcrumbs link hover color.
			if ( ! empty( $breadcrumbs_link_color_hover ) && '#13aff0' != $breadcrumbs_link_color_hover ) {
				$css .= '.site-breadcrumbs a:hover, .background-image-page-header .site-breadcrumbs a:hover{color:' . $breadcrumbs_link_color_hover . ';}';
				$css .= '.site-breadcrumbs a:hover .owp-icon use, .background-image-page-header .site-breadcrumbs a:hover .owp-icon use{stroke:' . $breadcrumbs_link_color_hover . ';}';
			}

			// Meta breadcrumbs text color.
			if ( ! empty( $meta_breadcrumbs_text_color ) ) {
				$css .= '.site-breadcrumbs, .background-image-page-header .site-breadcrumbs{color:' . $meta_breadcrumbs_text_color . ';}';
			}

			// Meta breadcrumbs seperator color.
			if ( ! empty( $meta_breadcrumbs_seperator_color ) ) {
				$css .= '.site-breadcrumbs ul li .breadcrumb-sep{color:' . $meta_breadcrumbs_seperator_color . ';}';
			}

			// Meta breadcrumbs link color.
			if ( ! empty( $meta_breadcrumbs_link_color ) ) {
				$css .= '.site-breadcrumbs a, .background-image-page-header .site-breadcrumbs a{color:' . $meta_breadcrumbs_link_color . ';}';
			}

			// Meta breadcrumbs link hover color.
			if ( ! empty( $meta_breadcrumbs_link_color_hover ) ) {
				$css .= '.site-breadcrumbs a:hover, .background-image-page-header .site-breadcrumbs a:hover{color:' . $meta_breadcrumbs_link_color_hover . ';}';
			}

			// Scroll top button bottom position.
			if ( ! empty( $scroll_top_bottom_position ) && '20' != $scroll_top_bottom_position ) {
				$css .= '#scroll-top{bottom:' . $scroll_top_bottom_position . 'px;}';
			}

			// Scroll top button size.
			if ( ! empty( $scroll_top_size ) && '40' != $scroll_top_size ) {
				$css .= '#scroll-top{width:' . $scroll_top_size . 'px;height:' . $scroll_top_size . 'px;line-height:' . $scroll_top_size . 'px;}';
			}

			// Scroll top button icon size.
			if ( ! empty( $scroll_top_icon_size ) && '18' != $scroll_top_icon_size ) {
				$css .= '#scroll-top{font-size:' . $scroll_top_icon_size . 'px;}';
				$css .= '#scroll-top .owp-icon{width:' . $scroll_top_icon_size . 'px; height:' . $scroll_top_icon_size . 'px;}';
			}

			// Scroll top button border radius.
			if ( ! empty( $scroll_top_border_radius ) && '2' != $scroll_top_border_radius ) {
				$css .= '#scroll-top{border-radius:' . $scroll_top_border_radius . 'px;}';
			}

			// Scroll top button background color.
			if ( ! empty( $scroll_top_bg ) && 'rgba(0,0,0,0.4)' != $scroll_top_bg ) {
				$css .= '#scroll-top{background-color:' . $scroll_top_bg . ';}';
			}

			// Scroll top button background hover color.
			if ( ! empty( $scroll_top_bg_hover ) && 'rgba(0,0,0,0.8)' != $scroll_top_bg_hover ) {
				$css .= '#scroll-top:hover{background-color:' . $scroll_top_bg_hover . ';}';
			}

			// Scroll top button background color.
			if ( ! empty( $scroll_top_color ) && '#ffffff' != $scroll_top_color ) {
				$css .= '#scroll-top{color:' . $scroll_top_color . ';}';
				$css .= '#scroll-top .owp-icon use{stroke:' . $scroll_top_color . ';}';
			}

			// Scroll top button background hover color.
			if ( ! empty( $scroll_top_color_hover ) && '#ffffff' != $scroll_top_color_hover ) {
				$css .= '#scroll-top:hover{color:' . $scroll_top_color_hover . ';}';
				$css .= '#scroll-top:hover .owp-icon use{stroke:' . $scroll_top_color . ';}';
			}

			// Pagination font size.
			if ( ! empty( $pagination_font_size ) && '18' != $pagination_font_size ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{font-size:' . $pagination_font_size . 'px;}';
			}

			// Pagination border width.
			if ( ! empty( $pagination_border_width ) && '1' != $pagination_border_width ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{border-width:' . $pagination_border_width . 'px;}';
			}

			// Pagination background color.
			if ( ! empty( $pagination_bg ) ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{background-color:' . $pagination_bg . ';}';
			}

			// Pagination background color hover.
			if ( ! empty( $pagination_hover_bg ) && '#f8f8f8' != $pagination_hover_bg ) {
				$css .= '.page-numbers a:hover, .page-links a:hover span, .page-numbers.current, .page-numbers.current:hover{background-color:' . $pagination_hover_bg . ';}';
			}

			// Pagination color.
			if ( ! empty( $pagination_color ) && '#555555' != $pagination_color ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{color:' . $pagination_color . ';}';
				$css .= '.page-numbers a .owp-icon use{stroke:' . $pagination_color . ';}';
			}

			// Pagination color hover.
			if ( ! empty( $pagination_hover_color ) && '#333333' != $pagination_hover_color ) {
				$css .= '.page-numbers a:hover, .page-links a:hover span, .page-numbers.current, .page-numbers.current:hover{color:' . $pagination_hover_color . ';}';
				$css .= '.page-numbers a:hover .owp-icon use{stroke:' . $pagination_hover_color . ';}';
			}

			// Pagination border color.
			if ( ! empty( $pagination_border_color ) && '#e9e9e9' != $pagination_border_color ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{border-color:' . $pagination_border_color . ';}';
			}

			// Pagination border color hover.
			if ( ! empty( $pagination_border_hover_color ) && '#e9e9e9' != $pagination_border_hover_color ) {
				$css .= '.page-numbers a:hover, .page-links a:hover span, .page-numbers.current, .page-numbers.current:hover{border-color:' . $pagination_border_hover_color . ';}';
			}

			// Label color.
			if ( ! empty( $label_color ) && '#929292' != $label_color ) {
				$css .= 'label, body div.wpforms-container-full .wpforms-form .wpforms-field-label{color:' . $label_color . ';}';
			}

			// Input padding.
			if ( isset( $input_top_padding ) && '6' != $input_top_padding && '' != $input_top_padding
				|| isset( $input_right_padding ) && '12' != $input_right_padding && '' != $input_right_padding
				|| isset( $input_bottom_padding ) && '6' != $input_bottom_padding && '' != $input_bottom_padding
				|| isset( $input_left_padding ) && '12' != $input_left_padding && '' != $input_left_padding ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{padding:' . subetuwebwp_spacing_css( $input_top_padding, $input_right_padding, $input_bottom_padding, $input_left_padding ) . '}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{padding:' . subetuwebwp_spacing_css( $input_top_padding, $input_right_padding, $input_bottom_padding, $input_left_padding ) . '; height: auto;}';
			}

			// Tablet input padding.
			if ( isset( $tablet_input_top_padding ) && '' != $tablet_input_top_padding
				|| isset( $tablet_input_right_padding ) && '' != $tablet_input_right_padding
				|| isset( $tablet_input_bottom_padding ) && '' != $tablet_input_bottom_padding
				|| isset( $tablet_input_left_padding ) && '' != $tablet_input_left_padding ) {
				$css .= '@media (max-width: 768px){form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{padding:' . subetuwebwp_spacing_css( $tablet_input_top_padding, $tablet_input_right_padding, $tablet_input_bottom_padding, $tablet_input_left_padding ) . '}}';
				$css .= '@media (max-width: 768px){body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{padding:' . subetuwebwp_spacing_css( $tablet_input_top_padding, $tablet_input_right_padding, $tablet_input_bottom_padding, $tablet_input_left_padding ) . '}}';
			}

			// Mobile input padding.
			if ( isset( $mobile_input_top_padding ) && '' != $mobile_input_top_padding
				|| isset( $mobile_input_right_padding ) && '' != $mobile_input_right_padding
				|| isset( $mobile_input_bottom_padding ) && '' != $mobile_input_bottom_padding
				|| isset( $mobile_input_left_padding ) && '' != $mobile_input_left_padding ) {
				$css .= '@media (max-width: 480px){form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{padding:' . subetuwebwp_spacing_css( $mobile_input_top_padding, $mobile_input_right_padding, $mobile_input_bottom_padding, $mobile_input_left_padding ) . '}}';
				$css .= '@media (max-width: 480px){body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{padding:' . subetuwebwp_spacing_css( $mobile_input_top_padding, $mobile_input_right_padding, $mobile_input_bottom_padding, $mobile_input_left_padding ) . '}}';
			}

			// Input font size.
			if ( ! empty( $input_font_size ) && '14' != $input_font_size ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{font-size:' . $input_font_size . 'px;}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{font-size:' . $input_font_size . 'px;}';
			}

			// Input border width border width.
			if ( isset( $input_top_border_width ) && '1' != $input_top_border_width && '' != $input_top_border_width
				|| isset( $input_right_border_width ) && '1' != $input_right_border_width && '' != $input_right_border_width
				|| isset( $input_bottom_border_width ) && '1' != $input_bottom_border_width && '' != $input_bottom_border_width
				|| isset( $input_left_border_width ) && '1' != $input_left_border_width && '' != $input_left_border_width ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{border-width:' . subetuwebwp_spacing_css( $input_top_border_width, $input_right_border_width, $input_bottom_border_width, $input_left_border_width ) . '}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-width:' . subetuwebwp_spacing_css( $input_top_border_width, $input_right_border_width, $input_bottom_border_width, $input_left_border_width ) . '}';
			}

			// Tablet input border width border width.
			if ( isset( $tablet_input_top_bw ) && '' != $tablet_input_top_bw
				|| isset( $tablet_input_right_bw ) && '' != $tablet_input_right_bw
				|| isset( $tablet_input_bottom_bw ) && '' != $tablet_input_bottom_bw
				|| isset( $tablet_input_left_bw ) && '' != $tablet_input_left_bw ) {
				$css .= '@media (max-width: 768px){form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{border-width:' . subetuwebwp_spacing_css( $tablet_input_top_bw, $tablet_input_right_bw, $tablet_input_bottom_bw, $tablet_input_left_bw ) . '}}';
				$css .= '@media (max-width: 768px){body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-width:' . subetuwebwp_spacing_css( $tablet_input_top_bw, $tablet_input_right_bw, $tablet_input_bottom_bw, $tablet_input_left_bw ) . '}}';
			}

			// Mobile input border width border width.
			if ( isset( $mobile_input_top_bw ) && '' != $mobile_input_top_bw
				|| isset( $mobile_input_right_bw ) && '' != $mobile_input_right_bw
				|| isset( $mobile_input_bottom_bw ) && '' != $mobile_input_bottom_bw
				|| isset( $mobile_input_left_bw ) && '' != $mobile_input_left_bw ) {
				$css .= '@media (max-width: 480px){form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{border-width:' . subetuwebwp_spacing_css( $mobile_input_top_bw, $mobile_input_right_bw, $mobile_input_bottom_bw, $mobile_input_left_bw ) . '}}';
				$css .= '@media (max-width: 480px){body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-width:' . subetuwebwp_spacing_css( $mobile_input_top_bw, $mobile_input_right_bw, $mobile_input_bottom_bw, $mobile_input_left_bw ) . '}}';
			}

			// Input border radius.
			if ( ! empty( $input_border_radius ) && '3' != $input_border_radius ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea, .woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single{border-radius:' . $input_border_radius . 'px;}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-radius:' . $input_border_radius . 'px;}';
			}

			// Input border color.
			if ( ! empty( $input_border_color ) && '#dddddd' != $input_border_color ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea,.select2-container .select2-choice, .woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single{border-color:' . $input_border_color . ';}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-color:' . $input_border_color . ';}';
			}

			// Input border color focus.
			if ( ! empty( $input_border_color_focus ) && '#bbbbbb' != $input_border_color_focus ) {
				$css .= 'form input[type="text"]:focus,form input[type="password"]:focus,form input[type="email"]:focus,form input[type="tel"]:focus,form input[type="url"]:focus,form input[type="search"]:focus,form textarea:focus,.select2-drop-active,.select2-dropdown-open.select2-drop-above .select2-choice,.select2-dropdown-open.select2-drop-above .select2-choices,.select2-drop.select2-drop-above.select2-drop-active,.select2-container-active .select2-choice,.select2-container-active .select2-choices{border-color:' . $input_border_color_focus . ';}';
				$css .= 'body div.wpforms-container-full .wpforms-form input:focus, body div.wpforms-container-full .wpforms-form textarea:focus, body div.wpforms-container-full .wpforms-form select:focus{border-color:' . $input_border_color_focus . ';}';
			}

			// Input border background.
			if ( ! empty( $input_background ) ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea, .woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single{background-color:' . $input_background . ';}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{background-color:' . $input_background . ';}';
			}

			// Input border color.
			if ( ! empty( $input_color ) && '#333333' != $input_color ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{color:' . $input_color . ';}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{color:' . $input_color . ';}';
			}

			// Theme buttons padding.
			if ( isset( $theme_button_top_padding ) && '14' != $theme_button_top_padding && '' != $theme_button_top_padding
				|| isset( $theme_button_right_padding ) && '20' != $theme_button_right_padding && '' != $theme_button_right_padding
				|| isset( $theme_button_bottom_padding ) && '14' != $theme_button_bottom_padding && '' != $theme_button_bottom_padding
				|| isset( $theme_button_left_padding ) && '20' != $theme_button_left_padding && '' != $theme_button_left_padding ) {
				$css .= '.theme-button,input[type="submit"],button[type="submit"],button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{padding:' . subetuwebwp_spacing_css( $theme_button_top_padding, $theme_button_right_padding, $theme_button_bottom_padding, $theme_button_left_padding ) . '}';
			}

			// Tablet theme buttons padding.
			if ( isset( $tablet_tb_top_padding ) && '' != $tablet_tb_top_padding
				|| isset( $tablet_tb_right_padding ) && '' != $tablet_tb_right_padding
				|| isset( $tablet_tb_bottom_padding ) && '' != $tablet_tb_bottom_padding
				|| isset( $tablet_tb_left_padding ) && '' != $tablet_tb_left_padding ) {
				$css .= '@media (max-width: 768px){.theme-button,input[type="submit"],button[type="submit"],button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{padding:' . subetuwebwp_spacing_css( $tablet_tb_top_padding, $tablet_tb_right_padding, $tablet_tb_bottom_padding, $tablet_tb_left_padding ) . '}}';
			}

			// Mobile theme buttons padding.
			if ( isset( $mobile_tb_top_padding ) && '' != $mobile_tb_top_padding
				|| isset( $mobile_tb_right_padding ) && '' != $mobile_tb_right_padding
				|| isset( $mobile_tb_bottom_padding ) && '' != $mobile_tb_bottom_padding
				|| isset( $mobile_tb_left_padding ) && '' != $mobile_tb_left_padding ) {
				$css .= '@media (max-width: 480px){.theme-button,input[type="submit"],button[type="submit"],button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{padding:' . subetuwebwp_spacing_css( $mobile_tb_top_padding, $mobile_tb_right_padding, $mobile_tb_bottom_padding, $mobile_tb_left_padding ) . '}}';
			}

			// Theme buttons border radius.
			if ( ! empty( $theme_button_border_radius ) && '0' != $theme_button_border_radius ) {
				$css .= '.theme-button,input[type="submit"],button[type="submit"],button,.button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{border-radius:' . $theme_button_border_radius . 'px;}';
			}

			// Theme buttons background color.
			if ( ! empty( $theme_button_bg ) && '#13aff0' != $theme_button_bg ) {
				$css .= 'body .theme-button,body input[type="submit"],body button[type="submit"],body button,body .button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{background-color:' . $theme_button_bg . ';}';
			}

			// Theme buttons background color.
			if ( ! empty( $theme_button_hover_bg ) && '#0b7cac' != $theme_button_hover_bg ) {
				$css .= 'body .theme-button:hover,body input[type="submit"]:hover,body button[type="submit"]:hover,body button:hover,body .button:hover, body div.wpforms-container-full .wpforms-form input[type=submit]:hover, body div.wpforms-container-full .wpforms-form input[type=submit]:active, body div.wpforms-container-full .wpforms-form button[type=submit]:hover, body div.wpforms-container-full .wpforms-form button[type=submit]:active, body div.wpforms-container-full .wpforms-form .wpforms-page-button:hover, body div.wpforms-container-full .wpforms-form .wpforms-page-button:active{background-color:' . $theme_button_hover_bg . ';}';
			}

			// Theme buttons background color.
			if ( ! empty( $theme_button_color ) && '#ffffff' != $theme_button_color ) {
				$css .= 'body .theme-button,body input[type="submit"],body button[type="submit"],body button,body .button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{color:' . $theme_button_color . ';}';
			}

			// Theme buttons hover color.
			if ( ! empty( $theme_button_hover_color ) && '#ffffff' != $theme_button_hover_color ) {
				$css .= 'body .theme-button:hover,body input[type="submit"]:hover,body button[type="submit"]:hover,body button:hover,body .button:hover, body div.wpforms-container-full .wpforms-form input[type=submit]:hover, body div.wpforms-container-full .wpforms-form input[type=submit]:active, body div.wpforms-container-full .wpforms-form button[type=submit]:hover, body div.wpforms-container-full .wpforms-form button[type=submit]:active, body div.wpforms-container-full .wpforms-form .wpforms-page-button:hover, body div.wpforms-container-full .wpforms-form .wpforms-page-button:active{color:' . $theme_button_hover_color . ';}';
			}

			// Blog entries meta icons color.
			if ( ! empty( $theme_blog_icons_color ) && '#333333' != $theme_blog_icons_color ) {
				$css .= '#blog-entries ul.meta li i{color:' . $theme_blog_icons_color . ';}';
				$css .= '#blog-entries ul.meta li .owp-icon use{stroke:' . $theme_blog_icons_color . ';}';
			}

			// Single post meta icons color.
			if ( ! empty( $theme_post_icons_color ) && '#333333' != $theme_post_icons_color ) {
				$css .= '.single-post ul.meta li i{color:' . $theme_post_icons_color . ';}';
				$css .= '.single-post ul.meta li .owp-icon use{stroke:' . $theme_post_icons_color . ';}';
			}

			// If page Both Sidebars layout.
			if ( 'both-sidebars' == $page_layout ) {

				// Both Sidebars layout page content width.
				if ( ! empty( $bs_page_content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.page.content-both-sidebars .content-area {width: ' . $bs_page_content_width . '%;}
							body.page.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.page.content-both-sidebars.ssc-style .widget-area {left: -' . $bs_page_content_width . '%;}
						}';
				}

				// Both Sidebars layout page sidebars width.
				if ( ! empty( $bs_page_sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.page.content-both-sidebars .widget-area{width:' . $bs_page_sidebars_width . '%;}
							body.page.content-both-sidebars.scs-style .content-area{left:' . $bs_page_sidebars_width . '%;}
							body.page.content-both-sidebars.ssc-style .content-area{left:' . $bs_page_sidebars_width * 2 . '%;}
						}';
				}
			}

			// If search Both Sidebars layout.
			if ( 'both-sidebars' == $search_layout ) {

				// Both Sidebars layout search content width.
				if ( ! empty( $bs_search_content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.search-results.content-both-sidebars .content-area {width: ' . $bs_search_content_width . '%;}
							body.search-results.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.search-results.content-both-sidebars.ssc-style .widget-area {left: -' . $bs_search_content_width . '%;}
						}';
				}

				// Both Sidebars layout search sidebars width.
				if ( ! empty( $bs_search_sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.search-results.content-both-sidebars .widget-area{width:' . $bs_search_sidebars_width . '%;}
							body.search-results.content-both-sidebars.scs-style .content-area{left:' . $bs_search_sidebars_width . '%;}
							body.search-results.content-both-sidebars.ssc-style .content-area{left:' . $bs_search_sidebars_width * 2 . '%;}
						}';
				}
			}

			// Return CSS.
			if ( ! empty( $css ) ) {
				$output .= '/* General CSS */' . $css;
			}

			// Return output css.
			return $output;

		}

	}

endif;

return new subetuwebWP_General_Customizer();
