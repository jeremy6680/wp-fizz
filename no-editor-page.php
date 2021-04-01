<?php
/**
 * Template Name: No Editor Page
 * Description: A Page Template with no Gutenberg Blocks (just ACF)
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$templates        = array( 'no-editor-page.twig' );

Timber::render( $templates, $context );
