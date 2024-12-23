<?php



define( "TRANSLATION_DOMAIN", "alphalab" );

function my_load_scripts() {

	wp_enqueue_script( 'html-to-image', 'https://cdn.jsdelivr.net/npm/html-to-image@1.11.11/dist/html-to-image.min.js', array() );

	wp_enqueue_style( 'lightgallery', 'https://cdn.jsdelivr.net/npm/lightgallery.js@1.4.0/dist/css/lightgallery.min.css', array() );
	wp_enqueue_script( 'lightgallery', 'https://cdn.jsdelivr.net/npm/lightgallery.js@1.4.0/dist/js/lightgallery.min.js', array( 'jquery' ), null, true );

	wp_enqueue_style( 'fade', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css' );
	wp_enqueue_script( 'fade', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', array( 'jquery' ), null, true );

}
add_action( 'wp_enqueue_scripts', 'my_load_scripts' );

function pre( $array ) {

	echo "<pre class='text-start p-2' dir='ltr' style='background:black;color:yellow'>";

	print_r( $array );

	echo "</pre>";

}





// Customize mce editor font sizes
if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
	function wpex_mce_text_sizes( $initArray ) {
		$initArray['fontsize_formats'] = "10px 12px 13px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px 50px";
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );


require_once get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

require get_template_directory() . '/inc/init.php';

require get_template_directory() . '/inc/helper.php';

require get_template_directory() . '/inc/blocks-init.php';


function bcard_custom_post_type() {
	register_post_type( 'business_card',
		array(
			'labels' => array(
				'name' => __( 'Business Cards', 'alphalab' ),
				'singular_name' => __( 'Business Card', 'alphalab' ),
				'add_new' => __( 'Add New', 'alphalab' ),
				'add_new_item' => __( 'Add New Business Card', 'alphalab' ),
				'edit_item' => __( 'Edit Business Card', 'alphalab' ),
				'new_item' => __( 'New Business Card', 'alphalab' ),
				'view_item' => __( 'View Business Card', 'alphalab' ),
				'view_items' => __( 'View Business Cards', 'alphalab' ),
				'search_items' => __( 'Search Business Cards', 'alphalab' ),
				'not_found' => __( 'No Business Cards found', 'alphalab' ),
				'not_found_in_trash' => __( 'No Business Cards found in Trash', 'alphalab' ),
				'all_items' => __( 'All Business Cards', 'alphalab' ),
				'archives' => __( 'Business Card Archives', 'alphalab' ),
				'attributes' => __( 'Business Card Attributes', 'alphalab' ),
				'insert_into_item' => __( 'Insert into Business Card', 'alphalab' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Business Card', 'alphalab' ),
				'menu_name' => __( 'Business Cards', 'alphalab' ),
				'filter_items_list' => __( 'Filter Business Cards list', 'alphalab' ),
				'items_list_navigation' => __( 'Business Cards list navigation', 'alphalab' ),
				'items_list' => __( 'Business Cards list', 'alphalab' ),
			),
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'show_in_rest' => true,
			'has_archive' => true,
			'menu_position' => 6,
			'menu_icon' => 'dashicons-index-card',
			'supports' => array( 'title' ),
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'business-card', 'with_front' => true ),
			'query_var' => true,
			'can_export' => true,
		)
	);
}
add_action( 'init', 'bcard_custom_post_type' );

function save_card_image() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_send_json_error( [ 'message' => 'Недостатньо прав для редагування.' ] );
	}

	$image_data = isset( $_POST['image'] ) ? sanitize_text_field( $_POST['image'] ) : '';
	$post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;

	if ( empty( $image_data ) || $post_id === 0 ) {
		wp_send_json_error( [ 'message' => 'Некоректні дані.' ] );
		return;
	}

	update_post_meta( $post_id, '_card_image_data', $image_data );

	wp_send_json_success( [ 'message' => 'Зображення збережено успішно.' ] );
}


add_action( 'wp_ajax_save_card_image', 'save_card_image' );
add_action( 'wp_ajax_nopriv_save_card_image', 'save_card_image' );


function remove_card_image_data_on_update( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( get_post_type( $post_id ) !== 'business_card' ) {
		return;
	}

	delete_post_meta( $post_id, '_card_image_data' );
}
add_action( 'save_post_business_card', 'remove_card_image_data_on_update' );
