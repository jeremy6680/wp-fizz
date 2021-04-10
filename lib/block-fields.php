<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
/*****************************************
*** CUSTOM FIELDS FOR BLOCKS WITH ACF  ***
******************************************/ 

// Setting up a variable to store the blocks directory.
$filename = get_template_directory() . "/views/blocks/";
if(file_exists($filename)):
    // if you have a components folder in your theme, the plugin will look for components there.
    $path = get_template_directory() . "/views";

else:
    // otherwise it will look for the block folder in this plugin.
    $path = plugin_dir_path( __DIR__ );
 
endif;

// Creation of an empty array where we will store the different blocks.
$blocks = [];

// Start of a loop. The builder will look for blocks and will add them to the list of blocks.
foreach ( (glob($path . "/blocks/*") ) as $block  ) {

$block = basename($block);
//echo 'acf/' . $block;
//echo $path . "/blocks/".$block."/fields.php";
//require($path . "/blocks/".$block."/fields.php");

require $path . "/blocks/".$block."/fields.php";



}

