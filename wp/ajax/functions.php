<?php

$static_nonce = 5987454543;

function localize_scripts() {
    global $static_nonce;

    wp_localize_script( 'wp-ajax', 'LOCALIZE', array(
        'security' => wp_create_nonce( 'wp-ajax-nonce' ), // dynamic nonce
        // one or another (||)
        'security_stat' => $static_nonce // static nonce
        )
    );

}



?>
