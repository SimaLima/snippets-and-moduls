<?php

// ADD_ACTION - DO_ACTION

// function declaration hooked to hook 'hook_name'
function function_name(){
    return "Hello World!";
}
add_action('hook_name', 'function_name');

// call after defining function (call somewhere in code)
do_action('hook_name');



// 1O -priority/order of activation if you have multiple functions on this hooks
// 2 - number of parameters
add_action('my_hook', 'my_function', 10, 2);

// Function declaration
function my_function( $first_name, $last_name ) {
	echo $first_name . ' ' . $last_name;
}

// Custom hook to call somewhere in code
do_action('my_hook', 'Simun', 'Ivanac');

?>
