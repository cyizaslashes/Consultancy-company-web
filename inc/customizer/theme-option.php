<?php 

/**
 * Theme Options Panel.
 *
 * @package bc-business-consulting
 */

$default = bc_business_consulting_get_default_theme_options();




// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'bc-business-consulting' ),
		'priority'   => 20,
		'capability' => 'edit_theme_options',
	)
);

// Global Section Start.*/

$wp_customize->add_section( 'social_option_section_settings',
	array(
		'title'      => esc_html__( 'Social Profile Options', 'bc-business-consulting' ),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Social Profile*/
		$wp_customize->add_setting( 'social_profile',
			array(
				'default'           => $default['social_profile'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bc_business_consulting_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'social_profile',
			array(
				'label'    => esc_html__( 'Global Social Profile ( Nav Right )', 'bc-business-consulting' ),
				'section'  => 'social_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		$wp_customize->add_setting( 'search_icon',
			array(
				'default'           => $default['search_icon'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bc_business_consulting_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'search_icon',
			array(
				'label'    => esc_html__( 'Search Icon ( Nav Right )', 'bc-business-consulting' ),
				'section'  => 'social_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		/*
		Social media
		*/
		$business_consulting_options['social']['fa-facebook']= array(
			'label' => esc_html__('Facebook URL', 'bc-business-consulting')
		);
		$business_consulting_options['social']['fa-twitter']= array(
			'label' => esc_html__('Twitter URL', 'bc-business-consulting')
		);
		$business_consulting_options['social']['fa-pinterest']= array(
			'label' => esc_html__('pinterest URL', 'bc-business-consulting')
		);
		$business_consulting_options['social']['fa-youtube']= array(
			'label' => esc_html__('Youtube URL', 'bc-business-consulting')
		);
		$business_consulting_options['social']['fa-instagram']= array(
			'label' => esc_html__('Instagram URL', 'bc-business-consulting')
		);
		
		foreach( $business_consulting_options as $key => $options ):
			foreach( $options as $k => $val ):
				// SETTINGS
				if ( isset( $key ) && isset( $k ) ){
					$wp_customize->add_setting('bc_business_consulting_social_profile_link['.$key .']['. $k .']',
						array(
							'default'           => esc_url( $default['social_profile_link'] ),
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'esc_url_raw'
						)
					);
					// CONTROLS
					$wp_customize->add_control('bc_business_consulting_social_profile_link['.$key .']['. $k .']', 
						array(
							'label'		 => esc_attr( $val['label'] ), 
							'section'    => 'social_option_section_settings',
							'type'       => 'url',
							
						)
					);
				}
			
			endforeach;
		endforeach;


/*Posts management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Blog Management', 'bc-business-consulting' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Posts Layout*/
		$wp_customize->add_setting( 'blog_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bc_business_consulting_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_layout',
			array(
				'label'    => esc_html__( 'Blog Layout Options', 'bc-business-consulting' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'bc-business-consulting' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'pull-left'  => esc_html__( 'Primary Sidebar - Content', 'bc-business-consulting' ),
					'pull-right' => esc_html__( 'Content - Primary Sidebar', 'bc-business-consulting' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'bc-business-consulting' ),
					),
				'type'     => 'select',
				'priority' => 170,
			)
		);
		
		
		/*content excerpt in global*/
		$wp_customize->add_setting( 'excerpt_length_blog',
			array(
				'default'           => $default['excerpt_length_blog'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bc_business_consulting_sanitize_positive_integer',
			)
		);
		$wp_customize->add_control( 'excerpt_length_blog',
			array(
				'label'    => esc_html__( 'Set Blog Excerpt Length', 'bc-business-consulting' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'number',
				'priority' => 175,
				'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),
		
			)
		);
		
		/*Blog Loop Content*/
		$wp_customize->add_setting( 'blog_loop_content_type',
			array(
				'default'           => $default['blog_loop_content_type'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bc_business_consulting_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_loop_content_type',
			array(
				'label'    => esc_html__( 'Blog Looop Content', 'bc-business-consulting' ),
				'section'  => 'theme_option_section_settings',
				'choices'               => array(
					'excerpt-only' => __( 'Excerpt Only', 'bc-business-consulting' ),
					'full-post' => __( 'Full Post', 'bc-business-consulting' ),
					),
				'type'     => 'select',
				'priority' => 180,
			)
		);
		
		
/*Posts management section start */
$wp_customize->add_section( 'page_option_section_settings',
	array(
		'title'      => esc_html__( 'Page Management', 'bc-business-consulting' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	
		/*Home Page Layout*/
		$wp_customize->add_setting( 'page_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bc_business_consulting_sanitize_select',
			)
		);
		$wp_customize->add_control( 'page_layout',
			array(
				'label'    => esc_html__( 'Page Layout Options', 'bc-business-consulting' ),
				'section'  => 'page_option_section_settings',
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'bc-business-consulting' ),
				'choices'   => array(
					'pull-left'  => esc_html__( 'Primary Sidebar - Content', 'bc-business-consulting' ),
					'pull-right' => esc_html__( 'Content - Primary Sidebar', 'bc-business-consulting' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'bc-business-consulting' ),
					),
				'type'     => 'select',
				'priority' => 170,
			)
		);


// Footer Section.
$wp_customize->add_section( 'footer_section',
	array(
	'title'      => esc_html__( 'Footer Options', 'bc-business-consulting' ),
	'priority'   => 130,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'copyright_text',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'bc-business-consulting' ),
	'section'  => 'footer_section',
	'type'     => 'text',
	'priority' => 120,
	)
);



// Footer Section.
$wp_customize->add_section( 'dialog_section',
	array(
	'title'      => esc_html__( 'Dialog & Award', 'bc-business-consulting' ),
	'priority'   => 130,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

	  /*Show dialog Section*/
		$wp_customize->add_setting( 'social_profile_dialog',
			array(
				'default'           => $default['social_profile_dialog'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'bc_business_consulting_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'social_profile_dialog',
			array(
				'label'    => esc_html__( 'Show Award & Dialog ?', 'bc-business-consulting' ),
				'section'  => 'dialog_section',
				'type'     => 'checkbox',
				
			)
		);

	// Setting copyright_text.
	$wp_customize->add_setting( 'dialog_top',
		array(
		'default'           => $default['dialog_top'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'dialog_top',
		array(
		'label'    => esc_html__( 'Dialog Top Right Text', 'bc-business-consulting' ),
		'section'  => 'dialog_section',
		'type'     => 'text',
		
		)
	);
 
		/*
		Award .
		*/
		$award['award_title_1']['title']= array(
			'label' => esc_html__('Award Title', 'bc-business-consulting'),
			
		);
		$award['award_title_1']['text']= array(
			'label' => esc_html__('Award Text', 'bc-business-consulting'),
			
		);
		
		$award['award_title_2']['title']= array(
			'label' => esc_html__('Award Title', 'bc-business-consulting'),
			
		);
		$award['award_title_2']['text']= array(
			'label' => esc_html__('Award Text', 'bc-business-consulting'),
			
		);
		
		$award['award_title_3']['title']= array(
			'label' => esc_html__('Award Title', 'bc-business-consulting'),
			
		);
		$award['award_title_3']['text']= array(
			'label' => esc_html__('Award Text', 'bc-business-consulting'),
			
		);
		
	
		foreach( $award as $key => $award_group ):
			foreach( $award_group as $k => $val ):
				// SETTINGS
				if ( isset( $key ) && isset( $k ) ){
					
					$wp_customize->add_setting('bc_business_consulting_award['.$key .']['. $k .']',
						array(
							'default'           => $default['bc_business_consulting_award'][$key][$k],
							'capability'     => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_text_field'
						)
					);
					// CONTROLS
					$wp_customize->add_control('bc_business_consulting_award['.$key .']['. $k .']', 
						array(
							'label' => esc_html( $val['label'] ), 
							'section'    => 'dialog_section',
							'type'     => 'text',
							
						)
					);
				}
			
			endforeach;
		endforeach;

