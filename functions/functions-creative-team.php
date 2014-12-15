<?php

function creative_meta_setup() {

	add_action('add_meta_boxes','creative_meta_add');
	add_action('save_post','creative_meta_save');
}
add_action('load-post.php','creative_meta_setup');
add_action('load-post-new.php','creative_meta_setup');

function creative_meta_add() {
 
	add_meta_box (
	'creative_meta',
	'Creative Information', 
	'creative_meta',
	'creative-team',
	'normal',
	'default');
}

function creative_meta() {

	global $post;
	wp_nonce_field(basename( __FILE__ ), 'creative-form-nonce' );

	// $position = get_post_meta($post->ID, 'creative-form-position', true) ? get_post_meta($post->ID, 'creative-form-position', true) : '';
	$email = get_post_meta($post->ID, 'creative-form-email', true) ? get_post_meta($post->ID, 'creative-form-email', true) : '';
	$instagram = get_post_meta($post->ID, 'creative-form-email', true) ? get_post_meta($post->ID, 'creative-form-email', true) : '';
	$linkedin = get_post_meta($post->ID, 'creative-form-email', true) ? get_post_meta($post->ID, 'creative-form-email', true) : '';
	$twitter = get_post_meta($post->ID, 'creative-form-twitter', true) ? get_post_meta($post->ID, 'creative-form-twitter', true) : '';
	$behance = get_post_meta($post->ID, 'creative-form-behance', true) ? get_post_meta($post->ID, 'creative-form-behance', true) : '';
	$vimeo = get_post_meta($post->ID, 'creative-form-vimeo', true) ? get_post_meta($post->ID, 'creative-form-vimeo', true) : '';
	$git = get_post_meta($post->ID, 'creative-form-git', true) ? get_post_meta($post->ID, 'creative-form-git', true) : '';
	$personal = get_post_meta($post->ID, 'creative-form-personal', true) ? get_post_meta($post->ID, 'creative-form-personal', true) : '';

	?>
	<style type="text/css">#creative-form div{display:inline-block; padding:0 5px;}#creative-form-email,#creative-form-instagram,#creative-form-linkedin, #creative-form-twitter, #creative-form-behance, #creative-form-vimeo, #creative-form-git, #creative-form-personal{display: block; width:150px;}</style>
	<div id="creative-form">
<!-- 		<div>
			<label for="creative-form-position">Position:</label>
			<input type="text" name="creative-form-position" id="creative-form-position" value="<?php echo $position; ?>" />
		</div> -->
		<div>
			<label for="creative-form-email">Email Address:</label>
			<input type="text" name="creative-form-email" id="creative-form-email" value="<?php echo $email; ?>" />
		</div>
		<div>
			<label for="creative-form-twitter">Twitter Handle:</label>
			<input type="text" name="creative-form-twitter" id="creative-form-twitter" value="<?php echo $twitter; ?>" />
		</div>
		<div>
			<label for="creative-form-instagram">Instagram Handle:</label>
			<input type="text" name="creative-form-instagram" id="creative-form-instagram" value="<?php echo $instagram; ?>" />
		</div>
		<div>
			<label for="creative-form-behance">Behance URL:</label>
			<input type="text" name="creative-form-behance" id="creative-form-behance" value="<?php echo $behance; ?>" />
		</div>
		<div>
			<label for="creative-form-linkedin">LinkedIn URL:</label>
			<input type="text" name="creative-form-linkedin" id="creative-form-linkedin" value="<?php echo $linkedin; ?>" />
		</div>
		<div>
			<label for="creative-form-vimeo">Vimeo Profile URL:</label>
			<input type="text" name="creative-form-vimeo" id="creative-form-vimeo" value="<?php echo $vimeo; ?>" />
		</div>
		<div>
			<label for="creative-form-git">Git URL:</label>
			<input type="text" name="creative-form-git" id="creative-form-git" value="<?php echo $git; ?>" />
		</div>
		<div>
			<label for="creative-form-personal">Personal URL:</label>
			<input type="text" name="creative-form-personal" id="creative-form-personal" value="<?php echo $personal; ?>" />
		</div>
	</div>
	<?php
}


function creative_meta_save() {

	global $post;
	$post_id = $post->ID;

	if (!isset($_POST['creative-form-nonce']) || !wp_verify_nonce($_POST['creative-form-nonce'], basename( __FILE__ ))) {
		return $post->ID;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post->ID;
	}

	$input = array();

	// $input['position'] = (isset($_POST['creative-form-position']) ? $_POST['creative-form-position'] : '');
	$input['twitter'] = (isset($_POST['creative-form-twitter']) ? $_POST['creative-form-twitter'] : '');
	$input['email'] = (isset($_POST['creative-form-email']) ? $_POST['creative-form-email'] : '');
	$input['linkedin'] = (isset($_POST['creative-form-linkedin']) ? $_POST['creative-form-linkedin'] : '');
	$input['instagram'] = (isset($_POST['creative-form-instagram']) ? $_POST['creative-form-instagram'] : '');
	$input['behance'] = (isset($_POST['creative-form-behance']) ? $_POST['creative-form-behance'] : '');
	$input['vimeo'] = (isset($_POST['creative-form-vimeo']) ? $_POST['creative-form-vimeo'] : '');
	$input['git'] = (isset($_POST['creative-form-git']) ? $_POST['creative-form-git'] : '');
	$input['personal'] = (isset($_POST['creative-form-personal']) ? $_POST['creative-form-personal'] : '');

	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'creative-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'creative-form-' . $field, $value, true );
		else if ($value && $value != $old)
			update_post_meta($post_id, 'creative-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'creative-form-' . $field, $old);
	}
}

?>