<?php

// Register stylesheets and scripts. 
wp_register_style( 'wpf-styles', get_stylesheet_directory_uri() . '/assets/dist/app.css', 1.0);
wp_register_style( 'wpf-layouts', get_stylesheet_directory_uri() . '/assets/dist/layouts.css', 1.0);
wp_register_style( 'wpf-components', get_stylesheet_directory_uri() . '/assets/dist/components.css', 1.0);
wp_register_style( 'wpf-blocks', get_stylesheet_directory_uri() . '/assets/dist/blocks.css', 1.0);
wp_register_script( 'wpf-js', get_stylesheet_directory_uri() . '/assets/dist/app.js', array('jquery'), '1.0.0', true );

// Enqueue stylesheets and scripts. 
wp_enqueue_style('wpf-styles');
wp_enqueue_style('wpf-layouts');
wp_enqueue_style('wpf-components');
wp_enqueue_style('wpf-blocks');
wp_enqueue_script('wpf-js');
