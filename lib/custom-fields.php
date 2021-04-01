<?php

// ----
// Custom Fields
// ----
// cf https://github.com/wordplate/extended-acf

use WordPlate\Acf\Fields\FlexibleContent;
use WordPlate\Acf\Fields\Layout;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Url;
use WordPlate\Acf\Fields\Link;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Fields\Taxonomy;
use WordPlate\Acf\Location;


/*****************************************
********** PAGE BUILDER WITH ACF  ********
******************************************/ 

register_extended_field_group([
	'title' => 'Page Builder',
	'fields' => [
	FlexibleContent::make('Components', 'page-components')
		->instructions('Create your own layout from the available components')
		->buttonLabel('Add a page component')
		->layouts([

			/****************************
			**** COMPONENT: CARDS *******
			*****************************/ 
			Layout::make('Cards')
			->fields([
				Repeater::make('Cards')
				->instructions('Add a card.')
				->fields([
				  Image::make('Image'),
				  Taxonomy::make('Category')
					  ->instructions('Select one term.')
					  ->appearance('select') // checkbox, multi_select, radio or select
					  ->returnFormat('object'), // object or id (default)
				  Relationship::make('Posts')
				  ->instructions('Add posts')
				  ->postTypes(['docs'])
				  ->filters([
					  'search', 
					  'taxonomy'
				  ])
				  ->elements(['featured_image'])
				  ->min(3)
				  ->max(3)
				  ->returnFormat('object') // id or object (default)
				  ->required()
				])
				->min(1)
				->collapsed('card')
				->buttonLabel('Add a card')
				->layout('row')
			])
			->layout('block'),

			/****************************
			**** COMPONENT: HERO ********
			*****************************/ 
			Layout::make('Hero')
			->fields([
				Text::make('Title'),
				Textarea::make('Outline')
				->rows(3),
				Image::make('Background Image', 'background_image')
				->returnFormat('object'),
				Group::make('Buttons')
				->instructions('Add a hero block with title, content and image to the page.')
				->fields([
					Text::make('CTA name', 'cta_name'),
					Link::make('CTA URL', 'cta_url'),
					Text::make('Other link name', 'other_link_name'),
					Link::make('Other link URL', 'other_link_URL'),
				])
				->layout('table')
				->required()
			])
			->layout('block'),

			/****************************
			**** COMPONENT: FEATURES ****
			*****************************/ 
			Layout::make('Features')
			->fields([
				Text::make('Title'),
				Repeater::make('Features')
				->instructions('Each feature includes an image, a name and a short description.')
				->fields([
				  Text::make('Name'),
				  Textarea::make('Description'),
				  Image::make('Image')
				  ->returnFormat('object')
				])
				->min(3)
				->max(6)
				->collapsed('features')
				->buttonLabel('Add a feature')
				->layout('table')
			])
			->layout('block'),

			/****************************
			**** COMPONENT: TITLE *******
			*****************************/ 
			Layout::make('Title')
			->fields([
				Text::make('Title'),
				Textarea::make('Subtitle')
				->rows(3),
			])
			->layout('block'),

		])
		->required(),
	],
	'location' => [
        Location::if('page_template', '==', 'builder.php'),
    ]
]);




// Custom Fields for the Home Page
register_extended_field_group([
	'title' => 'Home Page',
	'fields' => [
	Group::make('Hero')
    ->instructions('Add a hero block with title, content and image to the page.')
    ->fields([
        Text::make('Title'),
		Textarea::make('Subtitle')
		->rows(3),
        Text::make('CTA name', 'cta_name'),
		Link::make('CTA URL', 'cta_url'),
		Text::make('Other link name', 'other_link_name'),
		Link::make('Other link URL', 'other_link_URL'),
        Image::make('Background Image', 'background_image')
		->returnFormat('object')
    ])
    ->layout('block')
    ->required(),
	],
    'location' => [
        Location::if('page_type', '==', 'front_page'),
    ]
]);


// Custom Fields to add extra info to Pages
register_extended_field_group([
	'title' => 'Page info',
    'fields' => [
        Text::make('Subtitle'),
    ],
    'location' => [
        Location::if('post_type', 'page')->and('page_template', 'default')
    ],
]);

// Custom Fields for Single Doc Post
register_extended_field_group([
	'title' => 'Extra info',
	'fields' => [
	  Repeater::make('Resources')
	  ->instructions('Add useful links.')
	  ->fields([
		Url::make('Resource'),
	  ])
	  ->min(1)
	  ->collapsed('resource')
	  ->buttonLabel('Add a resource')
	  ->layout('table')
	],
	  'location' => [
		  Location::if('post_type', 'docs'),
	  ],
  ]);

// Custom Fields for Cards
register_extended_field_group([
	'title' => 'Cards',
	'fields' => [
	  Repeater::make('Cards')
	  ->instructions('Add a card.')
	  ->fields([
		Image::make('Image'),
		Taxonomy::make('Category')
			->instructions('Select one term.')
			->taxonomy('label')
			->appearance('select') // checkbox, multi_select, radio or select
			->returnFormat('object'), // object or id (default)
		Relationship::make('Posts')
		->instructions('Add posts')
		->postTypes(['docs'])
		->filters([
			'search', 
			'taxonomy'
		])
		->elements(['featured_image'])
		->min(3)
		->max(3)
		->returnFormat('object') // id or object (default)
		->required()
	  ])
	  ->min(1)
	  ->collapsed('card')
	  ->buttonLabel('Add a card')
	  ->layout('row')
	],
	  'location' => [
		  Location::if('block', 'acf/cards-block'),
	  ],
  ]);