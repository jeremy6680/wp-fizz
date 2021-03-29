<?php 

// ----
// Custom Post Types
// ----
// cf https://github.com/johnbillion/extended-cpts/wiki

register_extended_post_type( 
	
	'docs', [

	# Add Gutenberg Support:
	'show_in_rest' => true,

	# Add the post type to the site's main RSS feed:
	'show_in_feed' => true,

	# Show all posts on the post type archive:
	'archive' => [
		'nopaging' => true,
	],

	# Add a dashicon in the menu:
	'menu_icon' => 'dashicons-portfolio',

	# Add the post type to the 'Recently Published' section of the dashboard:
	'dashboard_activity' => true,

	# Add some custom columns to the admin screen:
	'admin_cols' => [
		'doc_published' => [
			'title_icon'  => 'dashicons-calendar-alt',
			'meta_key'    => 'published_date',
			'date_format' => 'd/m/Y'
		],
		'doc_label' => [
			'taxonomy' => 'label'
		],
	],

	# Add some dropdown filters to the admin screen:
	'admin_filters' => [
		'doc_label' => [
			'taxonomy' => 'label'
		],
	],

], [

	# Override the base names used for labels:
	'singular' => 'Doc',
	'plural'   => 'Docs',
	'slug'     => 'docs',

] );