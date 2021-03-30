<?php

// ----
// Custom Fields
// ----
// cf https://github.com/wordplate/extended-acf

use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Url;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Fields\Taxonomy;
use WordPlate\Acf\Location;

// Custom Fields to add extra info to Pages
register_extended_field_group([
	'title' => 'Page info',
    'fields' => [
        Text::make('Subtitle'),
    ],
    'location' => [
        Location::if('post_type', 'page')
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