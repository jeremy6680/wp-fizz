<?php

use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Location;

register_extended_field_group([
    'title' => 'Testimonial Block',
    'fields' => [
        Text::make('Name'),
		Textarea::make('Quote')
    ],
    'location' => [
        Location::if('block', 'acf/testimonial')
    ],
]);