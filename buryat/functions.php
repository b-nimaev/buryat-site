<?php
/**
 * buryat functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package buryat
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'buryat_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function buryat_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on buryat, use a find and replace
		 * to change 'buryat' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'buryat', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'navbar' => esc_html__( 'navbar', 'buryat' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'buryat_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'buryat_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function buryat_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'buryat_content_width', 640 );
}
add_action( 'after_setup_theme', 'buryat_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function buryat_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'buryat' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'buryat' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'buryat_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function buryat_scripts() {
	wp_enqueue_style( 'buryat-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', false, false, true );
	wp_enqueue_script( 'bootstrap' );

	wp_register_script( 'axios', get_template_directory_uri() . '/js/axios.min.js', false, false, true );
	wp_enqueue_script( 'axios' );	

	wp_register_script( 'vue', get_template_directory_uri() . '/js/vue.min.js', false, false, true );
	wp_enqueue_script( 'vue' );

	wp_register_script( 'buryat', get_template_directory_uri() . '/js/buryat.js', false, false, true );
	wp_enqueue_script( 'buryat' );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'buryat_scripts' );

// Подключаем локализацию в самом конце подключаемых к выводу скриптов, чтобы скрипт
// 'buryat', к которому мы подключаемся, точно был добавлен в очередь на вывод.
// Заметка: код можно вставить в любое место functions.php темы
add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){

	// Первый параметр 'buryat' означает, что код будет прикреплен к скрипту с ID 'buryat'
	// 'buryat' должен быть добавлен в очередь на вывод, иначе WP не поймет куда вставлять код локализации
	// Заметка: обычно этот код нужно добавлять в functions.php в том месте где подключаются скрипты, после указанного скрипта
	wp_localize_script( 'buryat', 'myajax', 
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);  

}

add_action('wp_ajax_nopriv_appendWord', 'appendWord_callback');
add_action('wp_ajax_appendWord', 'appendWord_callback');
function appendWord_callback() {
	$whatever = intval($_POST['whatever']);

	$whatever += 10;
	echo $whatever;

	wp_die();
}

add_filter( 'nav_menu_css_class', '__return_empty_array' );
add_filter( 'nav_menu_item_id', '__return_empty_string' );

add_filter( 'nav_menu_css_class', 'change_menu_item_css_classes', 10, 4 );

function change_menu_item_css_classes( $classes, $item, $args, $depth ) {
	if ( $args->theme_location === 'navbar' ) {
		$classes = [ 'nav-item' ];
	} else {
		$classes = [];
	}

	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'nav_link_class', $priority = 10, $accepted_args = 4 );
function nav_link_class($atts, $item, $args, $depth) {
	if (strpos($atts['href'], home_url())===false) {
		$atts['target'] = '_blank';
	}

	return $atts;
}

// Добавляем классы ссылкам
add_filter( 'nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 4 );
function filter_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

	$atts['class'] = 'nav-link';

	if ( $item->current ) {
		$class = 'active';
		$atts['class'] = 'nav-link active';
	}


	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'change_nav_menu_link_attributes' );

function change_nav_menu_link_attributes( $atts ) {
	if ( strpos( $atts['href'], home_url() ) === false ) {
		$atts['target'] = '_blank';
	}

	return $atts;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

