<?php

// insert
wp_insert_term(
    $term, // string
    'taxonomy',
    array()
);

// delete
wp_delete_term(
    $term, // int
    'taxonomy',
    array()
);

// update
wp_update_term(
    $term, // int
    'taxonomy',
    array(
         'name' => 'new_name',
         'slug' => 'new_slug'
    )
);

// connect term with object
wp_set_object_terms(
    $object_id, // int
    $terms, // int, string, array
    'taxonomy', // string
    true // append (bool)
);

// remove term from object
wp_remove_object_terms(
    $object_id, // int
    $terms, //int, string, array
    $taxonomy // string, array
);


// get terms and their data
$terms = get_terms( array(
    'taxonomy' => 'media-categories',
    'hide_empty' => false,
    // 'orderby' => id,
    'exclude' => 1,2,3 [1,2,3] // string/array
) );


?>
