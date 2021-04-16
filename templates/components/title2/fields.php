<?php

/****************************
**** COMPONENT: TITLE2 *******
*****************************/ 

use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;

return Group::make('Heading')
        ->fields([
            Text::make('Title'),
            Textarea::make('Outline')
            ->rows(3),
        ]);