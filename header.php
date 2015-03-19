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
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<?php if(is_page('work') || is_page('team')){
			?>
				<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
			<?php
		} ?>
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

		
		<?php include_once( // Include Google Analytics Tracking 
		'analyticstracking.php' ); ?>
		
		<div class="page">
			<header>
				<nav class="main-menu full">
 					<a id="navLogoLink" href="http://osi.ucf.edu/creativeservices/"><img class="navLogo" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/CSlogo.png" alt="Creative Services Logo"></a>
					<div class="screen-reader-text skip-link"><a href="#UPDATE ME" title="Skip to content">Skip to content</a></div>
					<div class="compact-menu">
						<a href="#" class="menu-toggle"><i class="fa fa-align-justify"></i> Menu</a>
<!-- 						<?php get_search_form(); ?>
 -->				</div>
					<ul>
<?php
							$current_ID = $post->ID;

							$navQuery = array('post_type' => 'page', 'post_status' => 'publish', 'posts_per_page' => -1, 'meta_key' => 'page-form-order', 'orderby' => 'meta_value', 'order' => 'ASC');
							$navLoop = new WP_Query($navQuery);

							while ($navLoop->have_posts()) {

								$navLoop->the_post();

								$name = get_the_title();
								$link = get_permalink();
								$nav_li_class = (get_the_ID() == $current_ID) ? ' class="current" ' : '';

								if (get_post_meta($post->ID, 'page-form-visible', true) == 'show') {
							
?>
						<li<?php echo $nav_li_class; ?>><a href="<?php echo $link; ?>"><?php echo $name; ?></a></li>
<?php 							}
							} ?>
						<!-- <li>
							<form method="get" id="searchform" class="searchform" action="http://localhost/wp/" role="search">
								<input type="search" class="field" name="s" value="" id="s" placeholder="Search &#133;" />
							</form>
						</li> -->
					</ul>
				</nav>
			</header>
<!-- HEADER END -->
