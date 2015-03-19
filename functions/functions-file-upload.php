<?php

function file_upload_meta_setup() {

	add_action('add_meta_boxes','file_upload_meta_add');
	add_action('save_post','file_upload_meta_save');
}
add_action('load-post.php','file_upload_meta_setup');
add_action('load-post-new.php','file_upload_meta_setup');

function file_upload_meta_add() {
 
	add_meta_box (
	'file_upload_meta',
	'File Upload Details', 
	'file_upload_meta',
	'file_upload',
	'normal',
	'default');
}

function file_upload_meta() {

	global $post;
	wp_nonce_field(basename( __FILE__ ), 'file-upload-form-nonce' );

	$port_name = get_post_meta($post->ID, 'file-upload-form-name', true) ? get_post_meta($post->ID, 'file-upload-form-name', true) : '';

	?>
	<style type="text/css">#file-upload-form div{display:inline-block; padding:0 5px;} #file-upload-form-name, #file-upload-form-twitter, #file-upload-form-email, #file-upload-form-linkedin, #file-upload-form-instagram, #file-upload-form-behance, #file-upload-form-vimeo, #file-upload-form-git, #file-upload-form-personal{display: block; width:180px;}</style>
	<div id="file-upload-form">
		<div>
			<label for="file-upload-form-name">Creator's Name:</label>
			<input type="text" name="file-upload-form-name" id="file-upload-form-name" value="<?php echo $port_name; ?>" />
		</div>
	</div>
	<?php
}


function file_upload_meta_save() {

	global $post;
	$post_id = $post->ID;

	if (!isset($_POST['file-upload-form-nonce']) || !wp_verify_nonce($_POST['file-upload-form-nonce'], basename( __FILE__ ))) {
		return $post->ID;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post->ID;
	}

	$input = array();

	$input['name'] = (isset($_POST['file-upload-form-name']) ? $_POST['file-upload-form-name'] : '');
	$input['user-ID'] = get_current_user_id();

	// $input['order'] = str_pad($input['order'], 3, "0", STR_PAD_LEFT);

	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'file-upload-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'file-upload-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'file-upload-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'file-upload-form-' . $field, $old);
	}
}

?>