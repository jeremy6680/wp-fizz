<?php

    // Bail out if function doesn’t exist.
    if ( ! function_exists( 'acf_register_block_type' ) ) {
        return;
    }

    // Register a new block.
    acf_register_block_type( array(
        'name'            => 'cards_block',
        'title'           => __( 'Cards Block', 'wpf-theme' ),
        'description'     => __( 'A block to highlights 3 posts', 'wpf-theme' ),
        'render_callback' => 'cards_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'index-card',
        'keywords'        => array( 'cards' ),
    ) );