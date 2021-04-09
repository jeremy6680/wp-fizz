<?php

function my_acf_block_render_callback( $block ) {
  $slug = str_replace('acf/', '', $block['name']);
  $block['slug'] = $slug;
  $block['classes'] = implode(' ', [$block['slug'], $block['className'], $block['align']]);
  echo \App\template("blocks/${slug}", ['block' => $block]);
}

add_action('acf/init', function() {
  if( function_exists('acf_register_block') ) {
    // Look into views/blocks
    $dir = new DirectoryIterator(locate_template("views/blocks/"));
    // Loop through found blocks
    foreach ($dir as $fileinfo) {
      if (!$fileinfo->isDot()) {
        $slug = str_replace('.twig', '', $fileinfo->getFilename());
        // Get infos from file
        $file_path = locate_template("views/blocks/${slug}.twig");
        $file_headers = get_file_data($file_path, [
          'title' => 'Title',
          'description' => 'Description',
          'category' => 'Category',
          'icon' => 'Icon',
          'keywords' => 'Keywords',
        ]);
        if( empty($file_headers['title']) ) {
          die( _e('This block needs a title: ' . $file_path));
        }
        if( empty($file_headers['category']) ) {
          die( _e('This block needs a category: ' . $file_path));
        }
        // Register a new block
        $datas = [
          'name' => $slug,
          'title' => $file_headers['title'],
          'description' => $file_headers['description'],
          'category' => $file_headers['category'],
          'icon' => $file_headers['icon'],
          'keywords' => explode(' ', $file_headers['keywords']),
          'render_callback'  => 'my_acf_block_render_callback',
        ];
        acf_register_block($datas);
      }
    }
  }
});