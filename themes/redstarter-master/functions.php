<?php
/**
 * RED Starter Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RED_Starter_Theme
 */

if ( ! function_exists( 'red_starter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function red_starter_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html( 'Primary Menu' ),
	) );

	// Switch search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif; // red_starter_setup
add_action( 'after_setup_theme', 'red_starter_setup' ); 

//FONT AWESOME
function wmpudev_enqueue_icon_stylesheet() {
	wp_register_style( 'fontawesome', 'http:////maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'fontawesome');
}
add_action( 'wp_enqueue_scripts', 'wmpudev_enqueue_icon_stylesheet' );

function custom_add_google_fonts() {
 wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Merriweather:300,400', false );
 }
 add_action( 'wp_enqueue_scripts', 'custom_add_google_fonts' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function red_starter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'red_starter_content_width', 640 );
}
add_action( 'after_setup_theme', 'red_starter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function red_starter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html( 'Sidebar' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'red_starter_widgets_init' );

/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function red_starter_minified_css( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( file_exists( get_template_directory() . '/build/css/style.min.css' ) ) {
		$stylesheet_uri = $stylesheet_dir_uri . '/build/css/style.min.css';
	}

	return $stylesheet_uri;
}
add_filter( 'stylesheet_uri', 'red_starter_minified_css', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function red_starter_scripts() {
	wp_enqueue_style( 'red-starter-style', get_stylesheet_uri() );

	wp_enqueue_script( 'red-starter-skip-link-focus-fix', get_template_directory_uri() . '/build/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'red_starter_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

//Banner Image function 

function get_banner(){
	if (is_front_page()){
		$img="http://localhost:8888/wordpress/wp-content/themes/redstarter-master/assets/images/home-hero.jpg"; ?>
   		<div class="hero-img flex flex-center" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),  url('<?php echo $img ?>')no-repeat; 
   		height:80vh;
   		background-size:cover">
   		<img src="http://localhost:8888/wordpress/wp-content/themes/redstarter-master/assets/images/logos/inhabitent-logo-full.svg">
   		</div>

	<?php }elseif (is_page(about)){
		$img = get_field("banner_image");
		echo '<section class="banner-about flex flex-center" style="background:linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),url('.$img.'); background-size:cover; height: 80vh;">';
		echo '<h1 class=" white-font">';
		the_title();
		echo '</h1>';
		echo'</section>';

		
	}	elseif(is_singular('adventure')){
		$img = get_field("banner_image");
		echo '<section class="banner-about" style="background:linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),url('.$img.'); background-size:cover; height: 80vh;"></section>';
	}
	
	} 
	
function wpb_widgets_init() {
 
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'wpb' ),
        'id' => 'sidebar-1',
        'description' => __( 'The main sidebar appears on the right on each page except the front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    register_sidebar( array(
        'name' =>__( 'Footer', 'wpb'),
        'id' => 'sidebar-2',
        'description' => __( 'Appears on the static front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_widgets_init' );

// search button 
add_filter( 'wp_nav_menu_items','add_search_box', 10, 2 );
function add_search_box( $items, $args ) {
    $items .= '<li class="search-logo menu-item green-font"> <i class= "fa fa-search" aria-hidden="true"></i></li> <li class="search-box menu-item">' . get_search_form( false ) . '</li>';


return $items;
}

