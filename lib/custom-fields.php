<?php

// ----
// Custom Fields
// ----
// cf https://github.com/wordplate/extended-acf

use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Url;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Location;

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

register_extended_field_group([
    'title' => 'Example',
    'fields' => [
        Text::make('Title'),
		Text::make('Description'),
    ],
    'location' => [
        Location::if('block', 'acf/example-block')
    ],
]);

register_extended_field_group([
	'title' => 'Cards',
	'fields' => [
	  Repeater::make('Cards')
	  ->instructions('Add a card.')
	  ->fields([
		Image::make('Image'),
		Text::make('Label'),
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