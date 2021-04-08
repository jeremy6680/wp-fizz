<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context          = Timber::context();
$context['posts'] = new Timber\PostQuery();
$templates        = array( 'index.twig' );
if ( is_home() ) {
	$context['title'] = 'Blog';
	$context['post']['subtitle'] = __("In this blog, I will tell you how — and why — I created this starter theme. Feel free to leave comments as I'm always happy to chat!", 'wpf-theme');
	array_unshift( $templates, 'home.twig' );
}
Timber::render( $templates, $context );
