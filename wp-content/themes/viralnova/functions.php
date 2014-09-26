<?php
/**
 * CloneTemplates functions and definitions
 *
 * @package CloneTemplates
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'clonetemplates_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function clonetemplates_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on CloneTemplates, use a find and replace
	 * to change 'clonetemplates' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'clonetemplates', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add post thumbnail support
	add_theme_support( 'post-thumbnails' ); 
	set_post_thumbnail_size( 340, 252, true ); 
	add_image_size( 'featured', 690, 252, true );

	/*
	 * Loads the Options Panel
	 *
	 * If you're loading from a child theme use stylesheet_directory
	 * instead of template_directory
	 */

	if ( ! function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
		require_once dirname( __FILE__ ) . '/inc/options-framework/options-framework.php';
	}

	/*
	 * This is an example of how to add custom scripts to the options panel.
	 * This one shows/hides the an option when a checkbox is clicked.
	 *
	 * You can delete it if you not using that option
	 */

	add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

	function optionsframework_custom_scripts() { ?>

	<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery('#example_showhidden').click(function() {
	  		jQuery('#section-example_text_hidden').fadeToggle(400);
		});

		if (jQuery('#example_showhidden:checked').val() !== undefined) {
			jQuery('#section-example_text_hidden').show();
		}

	});
	</script>

	<?php
	}
	/* 
	 * This is an example of how to override a default filter
	 * for 'textarea' sanitization and $allowedposttags + embed and script.
	 */
	add_action('admin_init','optionscheck_change_santiziation', 100);
	 
	function optionscheck_change_santiziation() {
	    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
	    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
	}
	 
	function custom_sanitize_textarea($input) {
	    global $allowedposttags;
	    $custom_allowedtags["embed"] = array(
	      "src" => array(),
	      "type" => array(),
	      "allowfullscreen" => array(),
	      "allowscriptaccess" => array(),
	      "height" => array(),
	      "width" => array()
	      );
	      $custom_allowedtags["script"] = array(
		  "src" => array(),
	      "type" => array()
		  );
		  $custom_allowedtags["ins"] = array(
		  "style" => array(),
	      "data-ad-client" => array(),
	      "data-ad-slot" => array()
		  );
		  $custom_allowedtags["iframe"] = array(
		  "src" => array(),
	      "scrolling" => array(),
	      "frameborder" => array(),
	      "height" => array(),
	      "width" => array()
		  );
		  $custom_allowedtags["meta"] = array(
		  	"name" => array(),
	        "content" => array(),
	        "property"=>array()
		  );
	 
	      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
	      $output = wp_kses( $input, $custom_allowedtags);
	    return $output;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menus() in multi locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'clonetemplates' ),
		// 'footer' => __( 'Footer Menu', 'clonetemplates' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );
	 */

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'clonetemplates_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	if ( of_get_option('hide_admin_bar')) {
	// hide admin bar on all front facing pages.
		add_filter('show_admin_bar', '__return_false');
	}
}
endif; // clonetemplates_setup
add_action( 'after_setup_theme', 'clonetemplates_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function clonetemplates_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'clonetemplates' ),
		'id'            => 'sidebar-1',
		'description'   => 'Appears on the right of single post/page.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sticky Sidebar', 'clonetemplates' ),
		'id'            => 'sidebar-2',
		'description'   => __('Appears on the right of single post/page.', 'clonetemplates'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'clonetemplates' ),
		'id'            => 'sidebar-3',
		'description'   => __('Appears on the footer.', 'clonetemplates'),
		'before_widget' => '<div id="%1$s" class="widget oswald %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="title red">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Ad Widget', 'clonetemplates' ),
		'id'            => 'sidebar-4',
		'description'   => __('Appears on the header. Size: 728x90', 'clonetemplates'),
		'before_widget' => '<div id="%1$s" class="widget banner-ad %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Post Bottom Widget', 'clonetemplates' ),
		'id'            => 'sidebar-5',
		'description'   => __('Appears at the end of post content. Recommended Size: width <= 640px', 'clonetemplates'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Ad Widget', 'clonetemplates' ),
		'id'            => 'sidebar-7',
		'description'   => __('Appears on the footer. Recommended Size: width <= 728px', 'clonetemplates'),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Homepage Ad Widget', 'clonetemplates' ),
		'id'            => 'sidebar-6',
		'description'   => __('Appears on homepage and archive pages. Size: 300x300', 'clonetemplates'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'clonetemplates_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function clonetemplates_scripts() {
	
	// Google Fonts
	wp_dequeue_style( 'fa' );
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' );
	// Google Fonts
	wp_enqueue_style( 'viralfonts-ga-fonts', '//fonts.googleapis.com/css?family=Oswald:400,700|Open+Sans&subset=latin' );

	wp_enqueue_style( 'clonetemplates-style', get_stylesheet_uri() );
    
    // main styles
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/css/main.css', array(), '20140701', 'all' );
    
    //styles to make it responsive
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.2.0', 'all' );
    
    //extra styles
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css', array(), '20140701', 'all' );

	wp_enqueue_script( 'clonetemplates-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'clonetemplates-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.2.0', true );

	wp_enqueue_script( 'infcr', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), '2.0.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clonetemplates_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions you can edit on.
 */
require get_template_directory() . '/inc/ct-functions.php';

/**
 * Custom functions that act exclusively for your theme.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

