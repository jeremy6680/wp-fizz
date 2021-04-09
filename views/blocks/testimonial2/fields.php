<?php

use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Location;

register_extended_field_group([
    'title' => 'Testimonial2 Block',
    'fields' => [
        Text::make('Nom'),
		Textarea::make('Phrase')
    ],
    'location' => [
        Location::if('block', 'acf/testimonial2')
    ],
]);