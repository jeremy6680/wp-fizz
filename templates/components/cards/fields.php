<?php

/****************************
**** COMPONENT: CARDS *******
*****************************/ 

use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Fields\Taxonomy;

return 	Repeater::make('Cards')
        ->instructions('Add a card.')
        ->fields([
            Image::make('Image'),
            Taxonomy::make('Category')
                ->instructions('Select one term.')
                ->appearance('select') // checkbox, multi_select, radio or select
                ->returnFormat('object'), // object or id (default)
            Relationship::make('Posts')
            ->instructions('Add posts')
            ->filters([
                'search', 
                'taxonomy'
            ])
            ->elements(['featured_image'])
            ->min(3)
            ->max(3)
            ->returnFormat('object') // id or object (default)
        ])
        ->min(1)
        ->collapsed('card')
        ->buttonLabel('Add a card')
        ->layout('row');