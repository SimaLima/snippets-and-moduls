<?php
/**
* PAGE TEMPLATE: Add metabox
* Add metabox only to the page that is using certain page template
*/

function page_template_add_meta_box() {
	global $post;


	// PAGE TEMPLATE: template-my-account.php
	if ( 'template-name.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
		add_meta_box(
			'test-metabox', // METABOX ID
			'Testbox', // TITLE
			'template_name_html', // HTML FUNCTION
			'page',  // POST TYPES:  post, page, dashboard, link, attachment, custom
			'normal',// CONTEXT: normal, advanced, aside
			'default'// PRIORITY: high, core, default, low
		);
	}

}
add_action( 'add_meta_boxes', 'page_template_add_meta_box' );

?>
