<?php

// Passing a variable to the template part:

// Before WP 5.5:

// Setting varibale
// Make key available to the template parts
set_query_var( 'variable', $var );

// Getting variable on template part:
// Get $var variable from parent template
$var = get_query_var( 'variable' );


// WP 5.5+:

// Setting variable - through 3rd param
echo get_template_part('inc/template-parts/file' null, array);

// Getting variable - on template part
echo "<pre>". print_r( $args, true ) . "</pre>";


?>
