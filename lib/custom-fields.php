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
				require __DIR__.'/fields-components/cards.php'
			])
			->layout('block'),

			/****************************
			**** COMPONENT: HERO ********
			*****************************/ 
			Layout::make('Hero')
			->fields([
				require __DIR__.'/fields-components/hero.php'
			])
			->layout('block'),

			/****************************
			**** COMPONENT: FEATURES ****
			*****************************/ 
			Layout::make('Features')
			->fields([
				require __DIR__.'/fields-components/features.php'
			])
			->layout('block'),

			/****************************
			**** COMPONENT: TITLE *******
			*****************************/ 
			Layout::make('Title')
			->fields([
				require __DIR__.'/fields-components/title.php'
			])
			->layout('block'),

		])
	],
	'location' => [
        Location::if('page_template', '==', 'builder.php'),
    ]
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
		Group::make('Cards')
		->fields([
			require __DIR__.'/fields-components/cards.php'
		])
		->layout('row'),
	],
	'location' => [
		Location::if('block', 'acf/cards-block'),
	],
  ]);


  
  