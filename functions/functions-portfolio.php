<?php

function portfolio_meta_setup() {

	add_action('add_meta_boxes','portfolio_meta_add');
	add_action('save_post','portfolio_meta_save');
}
add_action('load-post.php','portfolio_meta_setup');
add_action('load-post-new.php','portfolio_meta_setup');

function portfolio_meta_add() {
 
	add_meta_box (
	'portfolio_meta',
	'Portfolio Information', 
	'portfolio_meta',
	'portfolio',
	'normal',
	'default');
}

function portfolio_meta() {

	global $post;
	wp_nonce_field(basename( __FILE__ ), 'portfolio-form-nonce' );

	$port_name = get_post_meta($post->ID, 'portfolio-form-name', true) ? get_post_meta($post->ID, 'portfolio-form-name', true) : '';

	?>
	<style type="text/css">#portfolio-form div{display:inline-block; padding:0 5px;} #portfolio-form-name, #portfolio-form-twitter, #portfolio-form-email, #portfolio-form-linkedin, #portfolio-form-instagram, #portfolio-form-behance, #portfolio-form-vimeo, #portfolio-form-git, #portfolio-form-personal{display: block; width:180px;}</style>
	<div id="portfolio-form">
		<div>
			<label for="portfolio-form-name">Creator's Name:</label>
			<input type="text" name="portfolio-form-name" id="portfolio-form-name" value="<?php echo $port_name; ?>" />
		</div>
	</div>
	<?php
}


function portfolio_meta_save() {

	global $post;
	$post_id = $post->ID;

	if (!isset($_POST['portfolio-form-nonce']) || !wp_verify_nonce($_POST['portfolio-form-nonce'], basename( __FILE__ ))) {
		return $post->ID;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post->ID;
	}

	$input = array();

	$input['name'] = (isset($_POST['portfolio-form-name']) ? $_POST['portfolio-form-name'] : '');
	$input['user-ID'] = get_current_user_id();

	// $input['order'] = str_pad($input['order'], 3, "0", STR_PAD_LEFT);

	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'portfolio-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'portfolio-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'portfolio-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'portfolio-form-' . $field, $old);
	}
}

?>