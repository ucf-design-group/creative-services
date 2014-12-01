<?php /* Template Name: Home */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="X-UA-Compatible" content="chrome=1" />
		<title><?php wp_title( '|', true, 'right' ); ?> OSI Creative Services</title>
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
	</head>
<?php
	global $post;
	if ($post->post_type == "page")
		$body_class = 'class="page-' . $post->post_name . '"';
	else if ($post->post_type != "")
		$body_class = ($post->post_type != 'post') ? 'class="post-' . $post->post_type . '"' : 'class="post-default"';
	else
		$body_class = "";
?>
	<body <?php echo $body_class; ?>>
		<div class="page">

			<div class="content-area">
				<div class="logoSection">
					<img class="CSlogo" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/CSlogo.png" alt="Creative Services Logo">
				</div>
				<div class="homeNav">
					<a href="<?php echo get_site_url(); ?>/work">Work</a>
					<a href="<?php echo get_site_url(); ?>/team">Team</a>
					<a href="<?php echo get_site_url(); ?>/about">About</a>
				</div>
			</div>

<?php get_footer(); ?>