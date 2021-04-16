<?php

class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_filter( 'timber/acf-gutenberg-blocks-templates', array( $this, 'get_blocks_templates' ) );
		add_action( 'init', array( $this, 'wpfb_load' ) );
		add_action( 'init', array( $this, 'register_menus' ) );
		add_action('init', array($this, 'wpf_acf_utils') );
		add_action('acf/init', array($this, 'wpf_block_fields') );
		add_action('widgets_init', array($this, 'register_sidebars') );
		add_action( 'wp_enqueue_scripts', array( $this, 'wpf_scripts' ) );
		parent::__construct();
	}

	function wpfb_load() {
		/**
		*  Load WP Fizz Builder
		*/

		$filename = get_stylesheet_directory() . '/vendor/jeremy6680/wp-fizz-builder/wpfizzbuilder.php';

			if (file_exists($filename)) {
			    include_once( get_stylesheet_directory() . '/vendor/jeremy6680/wp-fizz-builder/wpfizzbuilder.php' );
			} else {
			    return;
			}	   

		}

	public function register_menus(){
		require(get_template_directory() . '/inc/menus.php');
	}

	public function register_sidebars() {
		require(get_template_directory() . '/inc/widgets.php');
	}

	// Enqueue scripts
	public function wpf_scripts() {
		require(get_template_directory() . '/inc/enqueue.php');
	}

	public function wpf_acf_utils() {
		require(get_template_directory() . '/inc/acf-utils.php');
	}

	public function wpf_block_fields() {
		require(get_template_directory() . '/inc/block-fields.php');
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

	/** Change location where Timber ACF WP Blocks will look for twig files
	 *
	 * cf https://palmiak.github.io/timber-acf-wp-blocks/#/filters
	 */
	public function get_blocks_templates() {
    	return ['templates/blocks']; // default: ['views/blocks']
    }

}

new StarterSite();