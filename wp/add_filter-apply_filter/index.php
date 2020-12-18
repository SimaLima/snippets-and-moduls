<?php

// ADD FILTER

// extra parameters:
// priority/order of activation if you have multiple functions on this hooks
// number of parameters
add_filter('add_fruits', 'add_fruits_function');

// Function declaration
function add_fruits_function( $fruits ) {

    $extra_fruits = array(
		'kiwis',
		'tangerines'
	);

	$fruits = array_merge( $extra_fruits, $fruits );

	return $fruits;
}



function show_fruits() {
	$fruits = array(
		'apples',
		'oranges',
		'peaches'
	);

    // this must execute after add_filter()
	if( has_filter('add_fruits') ) {
		$fruits = apply_filters('add_fruits', $fruits);
	}

    echo '<pre>'. print_r( $fruits, true ) . '</pre>';
}
show_fruits();



?>
