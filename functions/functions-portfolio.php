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
	$port_email = get_post_meta($post->ID, 'portfolio-form-email', true) ? get_post_meta($post->ID, 'portfolio-form-email', true) : '';
	$port_twitter = get_post_meta($post->ID, 'portfolio-form-twitter', true) ? get_post_meta($post->ID, 'portfolio-form-twitter', true) : '';
	$port_behance = get_post_meta($post->ID, 'portfolio-form-behance', true) ? get_post_meta($post->ID, 'portfolio-form-behance', true) : '';
	$port_vimeo = get_post_meta($post->ID, 'portfolio-form-vimeo', true) ? get_post_meta($post->ID, 'portfolio-form-vimeo', true) : '';
	$port_git = get_post_meta($post->ID, 'portfolio-form-git', true) ? get_post_meta($post->ID, 'portfolio-form-git', true) : '';
	$port_personal = get_post_meta($post->ID, 'portfolio-form-personal', true) ? get_post_meta($post->ID, 'portfolio-form-personal', true) : '';
	$port_instagram = get_post_meta($post->ID, 'portfolio-form-instagram', true) ? get_post_meta($post->ID, 'portfolio-form-instagram', true) : '';
	$port_linkedin = get_post_meta($post->ID, 'portfolio-form-linkedin', true) ? get_post_meta($post->ID, 'portfolio-form-linkedin', true) : '';

	?>
	<style type="text/css">#portfolio-form div{display:inline-block; padding:0 5px;} #portfolio-form-name, #portfolio-form-twitter, #portfolio-form-email, #portfolio-form-linkedin, #portfolio-form-instagram, #portfolio-form-behance, #portfolio-form-vimeo, #portfolio-form-git, #portfolio-form-personal{display: block; width:180px;}</style>
	<div id="portfolio-form">
		<div>
			<label for="portfolio-form-name">Creator's Name:</label>
			<input type="text" name="portfolio-form-name" id="portfolio-form-name" value="<?php echo $port_name; ?>" />
		</div>
		<div>
			<label for="portfolio-form-email">Email Address:</label>
			<input type="text" name="portfolio-form-email" id="portfolio-form-email" value="<?php echo $port_email; ?>" />
		</div>
		<div>
			<label for="portfolio-form-twitter">Twitter Handle:</label>
			<input type="text" name="portfolio-form-twitter" id="portfolio-form-twitter" value="<?php echo $port_twitter; ?>" />
		</div>
		<div>
			<label for="portfolio-form-instagram">Instagram URL:</label>
			<input type="text" name="portfolio-form-instagram" id="portfolio-form-instagram" value="<?php echo $port_instagram; ?>" />
		</div>
		<div>
			<label for="portfolio-form-behance">Behance URL:</label>
			<input type="text" name="portfolio-form-behance" id="portfolio-form-behance" value="<?php echo $port_behance; ?>" />
		</div>
		<div>
			<label for="portfolio-form-linkedin">LinkedIn URL:</label>
			<input type="text" name="portfolio-form-linkedin" id="portfolio-form-linkedin" value="<?php echo $port_linkedin; ?>" />
		</div>
		<div>
			<label for="portfolio-form-vimeo">Vimeo Video URL:</label>
			<input type="text" name="portfolio-form-vimeo" id="portfolio-form-vimeo" value="<?php echo $port_vimeo; ?>" />
		</div>
		<div>
			<label for="portfolio-form-git">Git URL:</label>
			<input type="text" name="portfolio-form-git" id="portfolio-form-git" value="<?php echo $port_git; ?>" />
		</div>
		<div>
			<label for="portfolio-form-git">Personal URL:</label>
			<input type="text" name="portfolio-form-personal" id="portfolio-form-personal" value="<?php echo $port_personal; ?>" />
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

	// $input['position'] = (isset($_POST['portfolio-form-position']) ? $_POST['portfolio-form-position'] : '');
	$input['name'] = (isset($_POST['portfolio-form-name']) ? $_POST['portfolio-form-name'] : '');
	$input['email'] = (isset($_POST['portfolio-form-email']) ? $_POST['portfolio-form-email'] : '');
	$input['linkedin'] = (isset($_POST['portfolio-form-linkedin']) ? $_POST['portfolio-form-linkedin'] : '');
	$input['twitter'] = (isset($_POST['portfolio-form-twitter']) ? $_POST['portfolio-form-twitter'] : '');
	$input['behance'] = (isset($_POST['portfolio-form-behance']) ? $_POST['portfolio-form-behance'] : '');
	$input['vimeo'] = (isset($_POST['portfolio-form-vimeo']) ? $_POST['portfolio-form-vimeo'] : '');
	$input['git'] = (isset($_POST['portfolio-form-git']) ? $_POST['portfolio-form-git'] : '');
	$input['personal'] = (isset($_POST['portfolio-form-personal']) ? $_POST['portfolio-form-personal'] : '');
	$input['instagram'] = (isset($_POST['portfolio-form-instagram']) ? $_POST['portfolio-form-instagram'] : '');

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