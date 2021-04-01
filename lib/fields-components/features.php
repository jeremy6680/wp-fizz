<?php

/****************************
**** COMPONENT: FEATURES ****
*****************************/

use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;

return Group::make('Features')
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
        ]);