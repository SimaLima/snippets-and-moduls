<?php
/**
* PAGE TEMPLATE: Saving function
* Save metabox value to DB with security actions: nonce, esc, and sanitize
*/

function template_name_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['template_name_nonce'] ) || ! wp_verify_nonce( $_POST['template_name_nonce'], '_template_name_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['test_field'] ) )
		update_post_meta( $post_id, 'test_field', esc_attr( sanitize_text_field( $_POST['test_field'] ) ) );
}
add_action( 'save_post', 'template_name_save' );
?>
