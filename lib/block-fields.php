<?php

/*****************************************
*** CUSTOM FIELDS FOR BLOCKS WITH ACF  ***
******************************************/ 

// Setting up a variable to store the blocks directory.
$filename = get_template_directory() . "/views/blocks/";
if(file_exists($filename)):
    // if you have a components folder in your theme, the plugin will look for components there.
    $path = get_template_directory() . "/views";


// Start of a loop. The builder will look for blocks and will add them to the list of blocks.
foreach ( (glob($path . "/blocks/*") ) as $block  ) {

$block = basename($block);

require($path . "/blocks/".$block."/fields.php");

}

endif;

