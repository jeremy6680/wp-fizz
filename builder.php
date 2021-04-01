<?php
/**
 * Template Name: Builder
 * Description: A Page Template with no Gutenberg Blocks (just ACF)
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$templates        = array( 'builder.twig' );

Timber::render( $templates, $context );
