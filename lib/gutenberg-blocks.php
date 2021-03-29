<?php

    // Bail out if function doesn’t exist.
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    // Register a new block.
    acf_register_block( array(
        'name'            => 'example_block',
        'title'           => __( 'Example Block', 'your-text-domain' ),
        'description'     => __( 'A custom example block.', 'your-text-domain' ),
        'render_callback' => 'my_acf_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array( 'example' ),
    ) );