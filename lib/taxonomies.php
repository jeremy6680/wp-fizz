<?php 

// ----
// Taxonomies
// ----
// cf https://github.com/johnbillion/extended-cpts/wiki

register_extended_taxonomy( 'label', 'docs', [

    # Use radio buttons in the meta box for this taxonomy on the post editing screen:
    'meta_box' => 'radio',

    # Add a custom column to the admin screen:
    'admin_cols' => [
        'updated' => [
            'title_cb'    => function() {
                return '<em>Last</em> Updated';
            },
            'meta_key'    => 'updated_date',
            'date_format' => 'd/m/Y'
        ],
    ],

] );