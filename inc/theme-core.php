<?php
/**
 * Business Consulting functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business_Consulting
 */

if ( ! function_exists( 'bc_business_consulting_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bc_business_consulting_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Business Consulting, use a find and replace
		 * to change 'bc-business-consulting' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bc-business-consulting', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'bc-business-consulting' ),
			'top_menu' => esc_html__( 'Top Right Menu', 'bc-business-consulting' ),
			'footer' => esc_html__( 'Footer Right', 'bc-business-consulting' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'quote',
			'gallery',
			'audio',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'business_consulting_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		// Add theme editor style.
		add_editor_style( 'assets/editor-style.css' );
		
	   // Declare WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif;
add_action( 'after_setup_theme', 'bc_business_consulting_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bc_business_consulting_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bc_business_consulting_content_width', 640 );
}
add_action( 'after_setup_theme', 'bc_business_consulting_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bc_business_consulting_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bc-business-consulting' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bc-business-consulting' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'bc-business-consulting' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'bc-business-consulting' ),
		'before_widget' => '<aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget link-widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Slider', 'bc-business-consulting' ),
		'id'            => 'front_page_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'bc-business-consulting' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title screen-reader-text">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Page Slider', 'bc-business-consulting' ),
		'id'            => 'blog_page_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'bc-business-consulting' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title screen-reader-text">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Logo Right Widgets', 'bc-business-consulting' ),
		'id'            => 'logo_right_widgets',
		'description'   => esc_html__( 'Add widgets here.', 'bc-business-consulting' ),
		'before_widget' => '<div id="%1$s" class="%2$s logo_right_widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title screen-reader-text">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'bc_business_consulting_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bc_business_consulting_scripts() {
	/* FONTS*/
	wp_enqueue_style( 'bc-business-consulting-Roboto+Condensed', '//fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,700');
	wp_enqueue_style( 'bc-business-consulting-Roboto', '//fonts.googleapis.com/css?family=Roboto:400,500');

	
	/* PLUGIN CSS */
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/bootstrap.css' ), '3.3.7' );
	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/vendors/font-awesome/font-awesome.css' ), '4.7.0' );
	wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/magnific-popup.css' ), '1.1.0' );
	wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/vendors/owl-carousel/owl-carousel.css' ), '2.2.1' );
	wp_enqueue_style( 'aos-next', get_template_directory_uri() . '/vendors/aos-next/aos.css');
	
	/* THEME CORE CSS */
	wp_enqueue_style( 'bc-business-consulting-navigation', get_theme_file_uri( '/assets/navigation-menu.css' ), '1.0.0' );
	wp_enqueue_style( 'bc-business-consulting', get_stylesheet_uri() );


	/* PLUGIN JS */
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/bootstrap.js' ), 0, '3.3.7', true );
	wp_enqueue_script( 'aos-next-js', get_template_directory_uri() . '/vendors/aos-next/aos.js',0, '3.3.7', true );
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri().'/vendors/magnific-popup/jquery.magnific-popup.js', 0, '1.1.0',true );
	wp_enqueue_script( 'jquery-owl-carousel', get_theme_file_uri( '/vendors/owl-carousel/owl-carousel.js' ),0,'2.2.1',true );
	wp_enqueue_script( 'jquery-sticky', get_theme_file_uri( '/vendors/sticky/jquery.sticky.js' ),0,'1.0.4',true );
	
	wp_enqueue_script( 'bc-business-consulting-js', get_template_directory_uri().'/assets/bc-business-consulting.js', array('jquery'), '1.0.0', true);
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bc_business_consulting_scripts' );


if( ! function_exists( 'bc_business_consulting_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function bc_business_consulting_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
	add_action( 'wp_head', 'bc_business_consulting_pingback_header' );

endif;


add_filter( 'use_widgets_block_editor', '__return_false' );