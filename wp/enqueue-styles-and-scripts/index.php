<?php
// FUNCTION FOR ENQUEUEING STYLESHEET AND SCRIPT WITH DYNAMIC VERSIONS OF FILE (FOR AVOIDING CACHE ISSUES)
// ENQUEUE: styles and scripts


// wp_enqueue_scripts
function load_styles_and_scripts() {

    $style_ver = filemtime( get_stylesheet_directory() . '/style.css' );
    wp_enqueue_style( 'style_css', get_stylesheet_uri(), array(), $style_ver );

    $script_ver = filemtime( get_stylesheet_directory() . '/assets/js/script.js' );
    wp_enqueue_script( 'script_js', get_template_directory_uri() . '/assets/js/script.js', array(), $script_ver, true );

}
add_action( 'wp_enqueue_scripts', 'load_styles_and_scripts' );



// admin_enqueue_scripts
function load_admin_styles_and_scripts() {

    $admin_style_ver = filemtime( get_stylesheet_directory() . '/admin/style.css' );
	wp_enqueue_style( 'admin_style_css', get_template_directory_uri() . '/admin/style.css', false, $style_ver );

    $admin_script_ver = filemtime( get_stylesheet_directory() . '/admin/script.js' );
    wp_enqueue_script( 'admin_script_js', get_template_directory_uri() . '/admin/script.js', array(), $script_ver, true );
}
add_action( 'admin_enqueue_scripts', 'load_admin_styles_and_scripts' );


?>
