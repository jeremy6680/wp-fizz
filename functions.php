<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */





/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}



/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates/', 'views/', 'views/components/' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'acf_load' ), 4 );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'init', array( $this, 'register_menus' ) );
		add_action( 'init', array( $this, 'register_custom_fields' ) );
		add_action('init', array($this, 'wpf_acf_utils') );
		add_action('acf/init', array($this, 'wpf_register_blocks') );
		add_action('acf/init', array($this, 'wpf_display_blocks') );
		add_action('widgets_init', array($this, 'register_sidebars') );
		parent::__construct();
	}

function acf_load() {
	/**
	*  Load ACF
	*  cf https://www.advancedcustomfields.com/resources/including-acf-within-a-plugin-or-theme/
	*/

	   // Define path and URL to the ACF plugin.
	   define( 'MY_ACF_PATH', get_stylesheet_directory() . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/' );
	   define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/' );

	   // Include the ACF plugin.
	   include_once( MY_ACF_PATH . 'acf.php' );

	   // Customize the url setting to fix incorrect asset URLs.
	   add_filter('acf/settings/url', 'my_acf_settings_url');
	   function my_acf_settings_url( $url ) {
		   return MY_ACF_URL;
	   }

	   // (Optional) Hide the ACF admin menu item.
	   add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
	   function my_acf_settings_show_admin( $show_admin ) {
		   return false;
	   }
}

	/** This is where you can register custom post types. */
	public function register_post_types() {
		require('lib/custom-post-types.php');
	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {
		require('lib/taxonomies.php');
	}

	public function register_menus(){
		require('lib/menus.php');
	}

	public function register_custom_fields(){
		require('lib/custom-fields.php');
	}

	public function register_sidebars() {
		require('lib/widgets.php');
	}

	public function wpf_acf_utils() {
		require('lib/acf-utils.php');
	}

	public function wpf_register_blocks() {
		require('lib/blocks-register.php');
	}

	public function wpf_display_blocks() {
		require('lib/blocks-callback.php');
	}

	public function theme_supports() {

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

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_theme_support( 'menus' );
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';
		$context['primary_menu']  = new Timber\Menu('primary_menu');
		$context['footer_menu'] = new Timber\Menu('footer_menu');
		$context['site']  = $this;
		return $context;
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}

}

new StarterSite();

	/*
	 **************************
	 * Custom Theme Functions *
	 **************************
	 *
	 * Namespaced "wpf" - find and replace with your own three-letter-thing.
	 * 
	 */ 

	// Enqueue scripts
	function wpf_scripts() {

		// Enqueue stylesheet and scripts. Use minified for production.
			wp_enqueue_style( 'wpf-styles', get_stylesheet_directory_uri() . '/assets/dist/app.css', 1.0);
			wp_enqueue_style( 'wpf-components', get_stylesheet_directory_uri() . '/assets/dist/components.css', 1.0);
			wp_enqueue_script( 'wpf-js', get_stylesheet_directory_uri() . '/assets/dist/app.js', array('jquery'), '1.0.0', true );

	}
	add_action( 'wp_enqueue_scripts', 'wpf_scripts' );

	/**
	 * Hide editor on front page and pages which have the "No Editor" Template.
	 *
	 */
	add_action( 'admin_init', 'hide_editor' );

	function hide_editor() {
		// Get the Post ID.
		$id = !empty($_POST['post_id']) ? $_POST['post_id'] : '';
		$post_id = !empty($_GET['post']) ? $_GET['post'] : $id ;
		if( !isset( $post_id ) ) return;

		// Hide the editor on the page titled 'Homepage'
		$homepgname = get_the_title($post_id);
		if($homepgname == 'Home Page'){ 
			remove_post_type_support('page', 'editor');
		}

		// Hide the editor on a page with a specific page template
		// Get the name of the Page Template file.
		$template_file = get_post_meta($post_id, '_wp_page_template', true);

		if($template_file == 'no-editor-page.php'){ // the filename of the page template
			remove_post_type_support('page', 'editor');
		}
	}