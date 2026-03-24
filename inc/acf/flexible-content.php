<?php
/**
 * ACF Flexible Content field group registration.
 *
 * Registers all flexible content layouts programmatically so they work
 * even without the ACF JSON sync workflow.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Page Builder flexible content field group.
 */
function elsner_scaffold_register_flexible_content() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Common section settings sub-fields (reused across layouts).
	$section_settings = array(
		array(
			'key'          => 'field_section_bg_style',
			'label'        => esc_html__( 'Background Style', 'elsner-scaffold' ),
			'name'         => 'background_style',
			'type'         => 'select',
			'choices'      => array(
				'white'    => esc_html__( 'White', 'elsner-scaffold' ),
				'light'    => esc_html__( 'Light Grey', 'elsner-scaffold' ),
				'dark'     => esc_html__( 'Dark', 'elsner-scaffold' ),
				'primary'  => esc_html__( 'Primary', 'elsner-scaffold' ),
				'gradient' => esc_html__( 'Gradient', 'elsner-scaffold' ),
				'image'    => esc_html__( 'Background Image', 'elsner-scaffold' ),
			),
			'default_value' => 'white',
			'return_format' => 'value',
		),
		array(
			'key'               => 'field_section_bg_image',
			'label'             => esc_html__( 'Background Image', 'elsner-scaffold' ),
			'name'              => 'background_image',
			'type'              => 'image',
			'return_format'     => 'array',
			'preview_size'      => 'medium',
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_section_bg_style',
						'operator' => '==',
						'value'    => 'image',
					),
				),
			),
		),
		array(
			'key'           => 'field_section_spacing',
			'label'         => esc_html__( 'Section Spacing', 'elsner-scaffold' ),
			'name'          => 'spacing',
			'type'          => 'select',
			'choices'       => array(
				'default' => esc_html__( 'Default', 'elsner-scaffold' ),
				'none'    => esc_html__( 'None', 'elsner-scaffold' ),
				'sm'      => esc_html__( 'Small', 'elsner-scaffold' ),
				'lg'      => esc_html__( 'Large', 'elsner-scaffold' ),
				'xl'      => esc_html__( 'Extra Large', 'elsner-scaffold' ),
			),
			'default_value' => 'default',
			'return_format' => 'value',
		),
		array(
			'key'   => 'field_section_extra_classes',
			'label' => esc_html__( 'Extra CSS Classes', 'elsner-scaffold' ),
			'name'  => 'extra_classes',
			'type'  => 'text',
		),
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_flexible_content',
			'title'                 => esc_html__( 'Page Builder — Flexible Content', 'elsner-scaffold' ),
			'fields'                => array(
				array(
					'key'          => 'field_flexible_content',
					'label'        => esc_html__( 'Page Sections', 'elsner-scaffold' ),
					'name'         => 'flexible_content',
					'type'         => 'flexible_content',
					'button_label' => esc_html__( '+ Add Section', 'elsner-scaffold' ),
					'layouts'      => array(

						// ----------------------------------------------------------
						// 1. Hero Banner
						// ----------------------------------------------------------
						'layout_hero' => array(
							'key'        => 'layout_hero',
							'name'       => 'hero',
							'label'      => esc_html__( 'Hero Banner', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array(
								array(
									'key'   => 'field_hero_eyebrow',
									'label' => esc_html__( 'Eyebrow Text', 'elsner-scaffold' ),
									'name'  => 'eyebrow',
									'type'  => 'text',
								),
								array(
									'key'      => 'field_hero_heading',
									'label'    => esc_html__( 'Heading', 'elsner-scaffold' ),
									'name'     => 'heading',
									'type'     => 'text',
									'required' => 1,
								),
								array(
									'key'   => 'field_hero_subheading',
									'label' => esc_html__( 'Subheading', 'elsner-scaffold' ),
									'name'  => 'subheading',
									'type'  => 'textarea',
									'rows'  => 3,
								),
								array(
									'key'           => 'field_hero_buttons',
									'label'         => esc_html__( 'CTA Buttons', 'elsner-scaffold' ),
									'name'          => 'buttons',
									'type'          => 'repeater',
									'min'           => 0,
									'max'           => 3,
									'button_label'  => esc_html__( '+ Add Button', 'elsner-scaffold' ),
									'sub_fields'    => array(
										array(
											'key'           => 'field_hero_btn_link',
											'label'         => esc_html__( 'Button Link', 'elsner-scaffold' ),
											'name'          => 'link',
											'type'          => 'link',
											'return_format' => 'array',
										),
										array(
											'key'     => 'field_hero_btn_style',
											'label'   => esc_html__( 'Button Style', 'elsner-scaffold' ),
											'name'    => 'style',
											'type'    => 'button_group',
											'choices' => array(
												'primary'   => esc_html__( 'Primary', 'elsner-scaffold' ),
												'secondary' => esc_html__( 'Secondary', 'elsner-scaffold' ),
												'outline'   => esc_html__( 'Outline', 'elsner-scaffold' ),
											),
											'default_value' => 'primary',
										),
									),
								),
								array(
									'key'           => 'field_hero_image',
									'label'         => esc_html__( 'Hero Image', 'elsner-scaffold' ),
									'name'          => 'image',
									'type'          => 'image',
									'return_format' => 'array',
									'preview_size'  => 'medium',
								),
								array(
									'key'           => 'field_hero_bg_image',
									'label'         => esc_html__( 'Background Image', 'elsner-scaffold' ),
									'name'          => 'background_image',
									'type'          => 'image',
									'return_format' => 'array',
									'preview_size'  => 'medium',
								),
								array(
									'key'     => 'field_hero_alignment',
									'label'   => esc_html__( 'Content Alignment', 'elsner-scaffold' ),
									'name'    => 'alignment',
									'type'    => 'button_group',
									'choices' => array(
										'left'   => esc_html__( 'Left', 'elsner-scaffold' ),
										'center' => esc_html__( 'Centre', 'elsner-scaffold' ),
										'right'  => esc_html__( 'Right', 'elsner-scaffold' ),
									),
									'default_value' => 'left',
								),
								array(
									'key'     => 'field_hero_height',
									'label'   => esc_html__( 'Hero Height', 'elsner-scaffold' ),
									'name'    => 'height',
									'type'    => 'select',
									'choices' => array(
										'auto'     => esc_html__( 'Auto', 'elsner-scaffold' ),
										'medium'   => esc_html__( 'Medium (500px)', 'elsner-scaffold' ),
										'large'    => esc_html__( 'Large (700px)', 'elsner-scaffold' ),
										'fullscreen' => esc_html__( 'Full Screen', 'elsner-scaffold' ),
									),
									'default_value' => 'large',
								),
							),
						),

						// ----------------------------------------------------------
						// 2. Text Block (WYSIWYG)
						// ----------------------------------------------------------
						'layout_text_block' => array(
							'key'        => 'layout_text_block',
							'name'       => 'text_block',
							'label'      => esc_html__( 'Text Block', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array_merge(
								array(
									array(
										'key'   => 'field_tb_eyebrow',
										'label' => esc_html__( 'Eyebrow', 'elsner-scaffold' ),
										'name'  => 'eyebrow',
										'type'  => 'text',
									),
									array(
										'key'   => 'field_tb_heading',
										'label' => esc_html__( 'Heading', 'elsner-scaffold' ),
										'name'  => 'heading',
										'type'  => 'text',
									),
									array(
										'key'          => 'field_tb_content',
										'label'        => esc_html__( 'Content', 'elsner-scaffold' ),
										'name'         => 'content',
										'type'         => 'wysiwyg',
										'toolbar'      => 'full',
										'media_upload' => 1,
									),
									array(
										'key'     => 'field_tb_width',
										'label'   => esc_html__( 'Max Width', 'elsner-scaffold' ),
										'name'    => 'width',
										'type'    => 'select',
										'choices' => array(
											'full'   => esc_html__( 'Full Width', 'elsner-scaffold' ),
											'wide'   => esc_html__( 'Wide (900px)', 'elsner-scaffold' ),
											'narrow' => esc_html__( 'Narrow (700px)', 'elsner-scaffold' ),
										),
										'default_value' => 'wide',
									),
									array(
										'key'     => 'field_tb_align',
										'label'   => esc_html__( 'Text Alignment', 'elsner-scaffold' ),
										'name'    => 'text_align',
										'type'    => 'button_group',
										'choices' => array(
											'left'   => esc_html__( 'Left', 'elsner-scaffold' ),
											'center' => esc_html__( 'Centre', 'elsner-scaffold' ),
										),
										'default_value' => 'left',
									),
								),
								$section_settings
							),
						),

						// ----------------------------------------------------------
						// 3. Image + Text (Split layout)
						// ----------------------------------------------------------
						'layout_image_text' => array(
							'key'        => 'layout_image_text',
							'name'       => 'image_text',
							'label'      => esc_html__( 'Image + Text', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array_merge(
								array(
									array(
										'key'           => 'field_it_image',
										'label'         => esc_html__( 'Image', 'elsner-scaffold' ),
										'name'          => 'image',
										'type'          => 'image',
										'return_format' => 'array',
										'preview_size'  => 'medium',
										'required'      => 1,
									),
									array(
										'key'   => 'field_it_eyebrow',
										'label' => esc_html__( 'Eyebrow', 'elsner-scaffold' ),
										'name'  => 'eyebrow',
										'type'  => 'text',
									),
									array(
										'key'      => 'field_it_heading',
										'label'    => esc_html__( 'Heading', 'elsner-scaffold' ),
										'name'     => 'heading',
										'type'     => 'text',
										'required' => 1,
									),
									array(
										'key'   => 'field_it_content',
										'label' => esc_html__( 'Content', 'elsner-scaffold' ),
										'name'  => 'content',
										'type'  => 'wysiwyg',
									),
									array(
										'key'           => 'field_it_cta',
										'label'         => esc_html__( 'CTA Button', 'elsner-scaffold' ),
										'name'          => 'cta',
										'type'          => 'link',
										'return_format' => 'array',
									),
									array(
										'key'     => 'field_it_layout',
										'label'   => esc_html__( 'Image Position', 'elsner-scaffold' ),
										'name'    => 'image_position',
										'type'    => 'button_group',
										'choices' => array(
											'left'  => esc_html__( 'Left', 'elsner-scaffold' ),
											'right' => esc_html__( 'Right', 'elsner-scaffold' ),
										),
										'default_value' => 'left',
									),
								),
								$section_settings
							),
						),

						// ----------------------------------------------------------
						// 4. Cards Grid
						// ----------------------------------------------------------
						'layout_cards_grid' => array(
							'key'        => 'layout_cards_grid',
							'name'       => 'cards_grid',
							'label'      => esc_html__( 'Cards Grid', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array_merge(
								array(
									array(
										'key'   => 'field_cg_eyebrow',
										'label' => esc_html__( 'Eyebrow', 'elsner-scaffold' ),
										'name'  => 'eyebrow',
										'type'  => 'text',
									),
									array(
										'key'   => 'field_cg_heading',
										'label' => esc_html__( 'Heading', 'elsner-scaffold' ),
										'name'  => 'heading',
										'type'  => 'text',
									),
									array(
										'key'   => 'field_cg_description',
										'label' => esc_html__( 'Description', 'elsner-scaffold' ),
										'name'  => 'description',
										'type'  => 'textarea',
										'rows'  => 2,
									),
									array(
										'key'          => 'field_cg_cards',
										'label'        => esc_html__( 'Cards', 'elsner-scaffold' ),
										'name'         => 'cards',
										'type'         => 'repeater',
										'min'          => 1,
										'max'          => 12,
										'button_label' => esc_html__( '+ Add Card', 'elsner-scaffold' ),
										'sub_fields'   => array(
											array(
												'key'           => 'field_card_icon',
												'label'         => esc_html__( 'Icon / Image', 'elsner-scaffold' ),
												'name'          => 'icon',
												'type'          => 'image',
												'return_format' => 'array',
												'preview_size'  => 'thumbnail',
											),
											array(
												'key'      => 'field_card_title',
												'label'    => esc_html__( 'Title', 'elsner-scaffold' ),
												'name'     => 'title',
												'type'     => 'text',
												'required' => 1,
											),
											array(
												'key'   => 'field_card_text',
												'label' => esc_html__( 'Text', 'elsner-scaffold' ),
												'name'  => 'text',
												'type'  => 'textarea',
												'rows'  => 3,
											),
											array(
												'key'           => 'field_card_link',
												'label'         => esc_html__( 'Link', 'elsner-scaffold' ),
												'name'          => 'link',
												'type'          => 'link',
												'return_format' => 'array',
											),
										),
									),
									array(
										'key'     => 'field_cg_columns',
										'label'   => esc_html__( 'Columns', 'elsner-scaffold' ),
										'name'    => 'columns',
										'type'    => 'button_group',
										'choices' => array(
											'2' => '2',
											'3' => '3',
											'4' => '4',
										),
										'default_value' => '3',
									),
								),
								$section_settings
							),
						),

						// ----------------------------------------------------------
						// 5. CTA Banner
						// ----------------------------------------------------------
						'layout_cta_banner' => array(
							'key'        => 'layout_cta_banner',
							'name'       => 'cta_banner',
							'label'      => esc_html__( 'CTA Banner', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array_merge(
								array(
									array(
										'key'      => 'field_cta_heading',
										'label'    => esc_html__( 'Heading', 'elsner-scaffold' ),
										'name'     => 'heading',
										'type'     => 'text',
										'required' => 1,
									),
									array(
										'key'   => 'field_cta_subheading',
										'label' => esc_html__( 'Subheading', 'elsner-scaffold' ),
										'name'  => 'subheading',
										'type'  => 'textarea',
										'rows'  => 2,
									),
									array(
										'key'           => 'field_cta_primary_btn',
										'label'         => esc_html__( 'Primary Button', 'elsner-scaffold' ),
										'name'          => 'primary_button',
										'type'          => 'link',
										'return_format' => 'array',
									),
									array(
										'key'           => 'field_cta_secondary_btn',
										'label'         => esc_html__( 'Secondary Button', 'elsner-scaffold' ),
										'name'          => 'secondary_button',
										'type'          => 'link',
										'return_format' => 'array',
									),
								),
								$section_settings
							),
						),

						// ----------------------------------------------------------
						// 6. Testimonials
						// ----------------------------------------------------------
						'layout_testimonials' => array(
							'key'        => 'layout_testimonials',
							'name'       => 'testimonials',
							'label'      => esc_html__( 'Testimonials', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array_merge(
								array(
									array(
										'key'   => 'field_t_eyebrow',
										'label' => esc_html__( 'Eyebrow', 'elsner-scaffold' ),
										'name'  => 'eyebrow',
										'type'  => 'text',
									),
									array(
										'key'   => 'field_t_heading',
										'label' => esc_html__( 'Heading', 'elsner-scaffold' ),
										'name'  => 'heading',
										'type'  => 'text',
									),
									array(
										'key'          => 'field_t_items',
										'label'        => esc_html__( 'Testimonials', 'elsner-scaffold' ),
										'name'         => 'items',
										'type'         => 'repeater',
										'min'          => 1,
										'button_label' => esc_html__( '+ Add Testimonial', 'elsner-scaffold' ),
										'sub_fields'   => array(
											array(
												'key'      => 'field_t_quote',
												'label'    => esc_html__( 'Quote', 'elsner-scaffold' ),
												'name'     => 'quote',
												'type'     => 'textarea',
												'required' => 1,
											),
											array(
												'key'   => 'field_t_author',
												'label' => esc_html__( 'Author Name', 'elsner-scaffold' ),
												'name'  => 'author',
												'type'  => 'text',
											),
											array(
												'key'   => 'field_t_position',
												'label' => esc_html__( 'Position / Company', 'elsner-scaffold' ),
												'name'  => 'position',
												'type'  => 'text',
											),
											array(
												'key'           => 'field_t_avatar',
												'label'         => esc_html__( 'Author Photo', 'elsner-scaffold' ),
												'name'          => 'avatar',
												'type'          => 'image',
												'return_format' => 'array',
												'preview_size'  => 'thumbnail',
											),
											array(
												'key'     => 'field_t_rating',
												'label'   => esc_html__( 'Star Rating', 'elsner-scaffold' ),
												'name'    => 'rating',
												'type'    => 'select',
												'choices' => array(
													'5' => esc_html__( '5 Stars', 'elsner-scaffold' ),
													'4' => esc_html__( '4 Stars', 'elsner-scaffold' ),
													'3' => esc_html__( '3 Stars', 'elsner-scaffold' ),
												),
												'default_value' => '5',
											),
										),
									),
									array(
										'key'     => 'field_t_style',
										'label'   => esc_html__( 'Display Style', 'elsner-scaffold' ),
										'name'    => 'display_style',
										'type'    => 'button_group',
										'choices' => array(
											'grid'   => esc_html__( 'Grid', 'elsner-scaffold' ),
											'slider' => esc_html__( 'Slider', 'elsner-scaffold' ),
										),
										'default_value' => 'grid',
									),
								),
								$section_settings
							),
						),

						// ----------------------------------------------------------
						// 7. FAQ Accordion
						// ----------------------------------------------------------
						'layout_faq' => array(
							'key'        => 'layout_faq',
							'name'       => 'faq',
							'label'      => esc_html__( 'FAQ Accordion', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array_merge(
								array(
									array(
										'key'   => 'field_faq_eyebrow',
										'label' => esc_html__( 'Eyebrow', 'elsner-scaffold' ),
										'name'  => 'eyebrow',
										'type'  => 'text',
									),
									array(
										'key'   => 'field_faq_heading',
										'label' => esc_html__( 'Heading', 'elsner-scaffold' ),
										'name'  => 'heading',
										'type'  => 'text',
									),
									array(
										'key'          => 'field_faq_items',
										'label'        => esc_html__( 'FAQ Items', 'elsner-scaffold' ),
										'name'         => 'items',
										'type'         => 'repeater',
										'min'          => 1,
										'button_label' => esc_html__( '+ Add FAQ', 'elsner-scaffold' ),
										'sub_fields'   => array(
											array(
												'key'      => 'field_faq_question',
												'label'    => esc_html__( 'Question', 'elsner-scaffold' ),
												'name'     => 'question',
												'type'     => 'text',
												'required' => 1,
											),
											array(
												'key'      => 'field_faq_answer',
												'label'    => esc_html__( 'Answer', 'elsner-scaffold' ),
												'name'     => 'answer',
												'type'     => 'wysiwyg',
												'toolbar'  => 'basic',
												'required' => 1,
											),
										),
									),
								),
								$section_settings
							),
						),

						// ----------------------------------------------------------
						// 8. Stats / Counters
						// ----------------------------------------------------------
						'layout_stats' => array(
							'key'        => 'layout_stats',
							'name'       => 'stats',
							'label'      => esc_html__( 'Stats / Counters', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array_merge(
								array(
									array(
										'key'   => 'field_stats_heading',
										'label' => esc_html__( 'Heading', 'elsner-scaffold' ),
										'name'  => 'heading',
										'type'  => 'text',
									),
									array(
										'key'          => 'field_stats_items',
										'label'        => esc_html__( 'Stat Items', 'elsner-scaffold' ),
										'name'         => 'items',
										'type'         => 'repeater',
										'min'          => 1,
										'max'          => 6,
										'button_label' => esc_html__( '+ Add Stat', 'elsner-scaffold' ),
										'sub_fields'   => array(
											array(
												'key'      => 'field_stat_value',
												'label'    => esc_html__( 'Value', 'elsner-scaffold' ),
												'name'     => 'value',
												'type'     => 'text',
												'required' => 1,
											),
											array(
												'key'   => 'field_stat_suffix',
												'label' => esc_html__( 'Suffix (e.g. +, %, K)', 'elsner-scaffold' ),
												'name'  => 'suffix',
												'type'  => 'text',
											),
											array(
												'key'      => 'field_stat_label',
												'label'    => esc_html__( 'Label', 'elsner-scaffold' ),
												'name'     => 'label',
												'type'     => 'text',
												'required' => 1,
											),
										),
									),
								),
								$section_settings
							),
						),

						// ----------------------------------------------------------
						// 9. Gallery Grid
						// ----------------------------------------------------------
						'layout_gallery' => array(
							'key'        => 'layout_gallery',
							'name'       => 'gallery',
							'label'      => esc_html__( 'Gallery', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array_merge(
								array(
									array(
										'key'   => 'field_gal_heading',
										'label' => esc_html__( 'Heading', 'elsner-scaffold' ),
										'name'  => 'heading',
										'type'  => 'text',
									),
									array(
										'key'           => 'field_gal_images',
										'label'         => esc_html__( 'Images', 'elsner-scaffold' ),
										'name'          => 'images',
										'type'          => 'gallery',
										'return_format' => 'array',
										'preview_size'  => 'medium',
										'min'           => 1,
									),
									array(
										'key'     => 'field_gal_columns',
										'label'   => esc_html__( 'Columns', 'elsner-scaffold' ),
										'name'    => 'columns',
										'type'    => 'button_group',
										'choices' => array(
											'2' => '2',
											'3' => '3',
											'4' => '4',
										),
										'default_value' => '3',
									),
								),
								$section_settings
							),
						),

						// ----------------------------------------------------------
						// 10. Video Section
						// ----------------------------------------------------------
						'layout_video' => array(
							'key'        => 'layout_video',
							'name'       => 'video',
							'label'      => esc_html__( 'Video Section', 'elsner-scaffold' ),
							'display'    => 'block',
							'sub_fields' => array_merge(
								array(
									array(
										'key'   => 'field_vid_heading',
										'label' => esc_html__( 'Heading', 'elsner-scaffold' ),
										'name'  => 'heading',
										'type'  => 'text',
									),
									array(
										'key'   => 'field_vid_description',
										'label' => esc_html__( 'Description', 'elsner-scaffold' ),
										'name'  => 'description',
										'type'  => 'textarea',
									),
									array(
										'key'      => 'field_vid_url',
										'label'    => esc_html__( 'Video URL (YouTube / Vimeo)', 'elsner-scaffold' ),
										'name'     => 'video_url',
										'type'     => 'url',
										'required' => 1,
									),
									array(
										'key'           => 'field_vid_poster',
										'label'         => esc_html__( 'Poster / Thumbnail Image', 'elsner-scaffold' ),
										'name'          => 'poster',
										'type'          => 'image',
										'return_format' => 'array',
									),
								),
								$section_settings
							),
						),

					), // end layouts
				), // end flexible_content field
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'post',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'seamless',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => array( 'the_content' ),
			'active'                => true,
		)
	);
}
add_action( 'acf/init', 'elsner_scaffold_register_flexible_content' );
