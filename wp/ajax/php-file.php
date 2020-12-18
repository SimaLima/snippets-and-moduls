<?php
/**
 * PHP file responsible for receiving and handling ajax request
 */

// ajax request require:
// var ajaxurl (header.php or somehow else)
// localize script (functions.php)
// js (request and response)
// this->php file



// not logged in users
add_action( 'wp_ajax_nopriv_function_name', 'function_name' );

// logged in users
add_action( 'wp_ajax_function_name', 'function_name' );



function function_name() {
    // NONCE:
    // check if data are submited from coresponding form (by using wp_nonce)

    // STATIC or DYNAMIC (can't be used both)


    // STATIC NONCE:
    // for frontend and defined inglobal scope of functions.php file
    // security_stat is global nonce name created in localize script (wp-ajax)
    global $static_nonce;
    if( $_POST[ 'security_stat' ] != $static_nonce ) {
        return;
    }


    // DYNAMIC NONCE
    // wp-ajax-nonce is nonce name created in localize script (wp-ajax)
    // security is key to check
    if( !check_ajax_referer( 'wp-ajax-nonce', 'security' ) ) {
        return;
    }



    // Prevent form data submision for unauthorized users
    if( !current_user_can( 'manage_options' ) ) {
        return;
    }



    // VALIDATE NUMBER
    if ( isset($_POST['number']) && !empty(trim($_POST['number'])) ) {
        if ( !is_numeric($_POST['number']) || $_POST['number'] == 0 ) {
            wp_send_json_error('There was an error with number.');
        }

        $number = (int)$_POST['number'];

    }
    else {
        wp_send_json_error('Ajax number is missing.');
    }



    // VALIDATE NUMBER -> SET DEFAULT
    if ( isset( $_POST['number'] ) && !empty( trim($_POST['number']) ) ) {
        if ( !is_numeric( $_POST['number'] ) || $_POST['number'] == 0 ) {
            $number = 123;
        else
            $number = (int)$_POST['number'];
    }
    else {
        $number = 123;
    }



    // VALIDATE AND CHECK THE SUBMITTED TEXT
    if ( isset($_POST['string']) && !empty(trim($_POST['string'])) ) {
        $string = sanitize_text_field( $_POST['string'] );
    }
    else {
        wp_send_json_error('Ajax dummy text is missing.');
    }



    // gathered data saved in associative array
    $received_data = [
        'number' => $number,
        'text' => $string
    ];



    // get or do something in DB
    $new_data = call_db_function($received_data);



    // send data back to JS
    wp_send_json_success($new_data);
}

?>
