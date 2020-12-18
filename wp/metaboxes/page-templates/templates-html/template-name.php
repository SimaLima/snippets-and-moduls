<?php
/**
* PAGE TEMPLATE: HTML function
*/

function template_name_html(){
	wp_nonce_field( '_template_name_nonce', 'template_name_nonce' );
?>
	<!-- HTML START-->
	<h3>Input title</h3>
	<p>
		<label for="test_field">Label text</label><br>
		<input type="text" name="test_field" id="test_field" value="<?php echo esc_HTML( get_meta( 'test_field' ) ); ?>">
	</p>
	<!-- HTML END -->
<?php
}



?>
