<?php /* Template Name: Work */
get_header(); ?>

			<div class="content-area">
				<div class="main">
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'single' );
					} ?>
				</div>
				<form action="post" name="positionSwap">
					<input type="radio" name="position[]" value="Graphics" id="graphics" onclick="selectionListener();"/><label for="graphics">Graphics</label>
					<input type="radio" name="position[]" value="Web" id="web" onclick="selectionListener();"/><label for="web">Web</label>
					<input type="radio" name="position[]" value="Productions" id="productions" onclick="selectionListener();"/><label for="productions">Productions</label>
					<input type="radio" name="position[]" value="All" id="all" checked="checked" onclick="selectionListener();"/><label for="all">All</label>
				</form>
				<div class="isotope">
<?php
						// Gets a list of all the creative users (users with the role 'creative_member').
						$creative_users = get_users( array('role' => 'creative_member' ));

						// Creates a list of all the portfolio works that have been uploaded by creative members.
						$creativeLoop = new WP_QUERY(array('post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DSC'));
						while ($creativeLoop->have_posts()) {
							// echo 'post \'' . $post->ID . '\' found! - ' . get_post_type() . sizeof($creativeLoop);
							$creativeLoop->the_post();
							$title = get_the_title();
							$content = get_the_content();
							$category = get_the_category(); 
							$image = get_the_post_thumbnail($post->ID, 'full');
							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
							$name = get_post_meta($post->ID, 'portfolio-form-name', true);
							$linkedin = get_post_meta($post->ID, 'portfolio-form-linkedin', true);
							$email = get_post_meta($post->ID, 'portfolio-form-email', true);
							$twitter = get_post_meta($post->ID, 'portfolio-form-twitter', true);
							$behance = get_post_meta($post->ID, 'portfolio-form-behance', true);
							$vimeo = get_post_meta($post->ID, 'portfolio-form-vimeo', true);
							$git = get_post_meta($post->ID, 'portfolio-form-git', true);
							$personal = get_post_meta($post->ID, 'portfolio-form-personal', true);
							$instagram = get_post_meta($post->ID, 'portfolio-form-instagram', true);
							$user_ID = get_post_meta($post->ID, 'portfolio-form-user-id', true);
							$image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), '100');
							// $user_ID = get_post_meta($post->ID), 'portfolio-form-user-id', true);

							// Gets the current user as a user object so personal link information can be pulled appropriately.
							$creative_user = get_userdata( $user_ID ); ?>

							<div class="item <?php if($category){ if($category[0]->cat_name == 'Video'){ echo 'width2'; } } ?> <?php if($category){ echo $category[0]->cat_name; } ?>" style="background-image: url('<?php echo $image_url; ?>');">
								<div class="itemDescription">
<?php 
									if($category){ 
										if($category[0]->cat_name == 'Video'){ ?>
											<a id="expandIcon" class="fancybox-media" href="<?php echo $vimeo ?>"><i class="fa fa-expand"></i></a>
<?php
										} else { ?>
												<a id="expandIcon" class="fancybox" rel="group" href="<?php echo $image_url[0]; ?>"><i class="fa fa-expand"></i></a>
<?php
										} 
									} ?>
									<h1><?php echo $name; ?></h1>

									<div class="itemIcons">
										<?php 
										// Commented because email is not necessary at this time but we might need it later.
										/*if($creative_user->email){
											?>
											<a id="emailIcon" target="_blank" href="mailto:<?php echo $creative_user->email ?>"><i class="fa fa-envelope"></i></a>
											<?php
										}*/
										if($creative_user){
											?>
											<a id="twitterIcon" target="_blank" href="https://twitter.com/<?php echo $creative_user->twitter ?>"><i class="fa fa-twitter"></i></a>
											<?php
										}
										if($creative_user){
											?>
											<a id="twitterIcon" target="_blank" href="http://instagram.com/<?php echo $creative_user->instagram ?>"><i class="fa fa-instagram"></i></a>
											<?php
										}
										if($creative_user){
											?>
											<a id="behanceIcon" target="_blank" href="<?php echo $creative_user->behance ?>"><i class="fa fa-behance"></i></a>
											<?php
										}
										if($creative_user){
											?>
											<a id="linkedinIcon" target="_blank" href="<?php echo $creative_user->linkedin ?>"><i class="fa fa-linkedin"></i></a>
											<?php
										}
										if($creative_user){
											?>
											<a id="gitIcon" target="_blank" href="<?php echo $creative_user->github ?>"><i class="fa fa-github"></i></a>
											<?php
										}
										if($creative_user){
											?>
											<a id="personalIcon" target="_blank" href="<?php echo $creative_user->personal ?>"><i class="fa fa-user"></i></a>
											<?php
										}
										?>
									</div>
								</div>
							</div>

<?php 				}
?>
				</div>
			</div>

<script type="text/javascript">
	jQuery(document).ready(function(?) {
		var busy = false;

		$(window).scroll(function() {
			if($(window).scrollTop() + $(window).height() == $(document).height() && busy == false) {
				scrollAjax();
			}
		});

	function scrollAjax() {
		busy == true;
		var existing_post_ids = [];
		$('.item').each(function(){
			post_ids.push($(this).data('post-id'));
		})

		$.ajax({
			type: "GET",
			dataType:'html',
			url:"<?php echo (bloginfo('template_url') . 'functions/functions-infinite-scroll.php'); ?>"
			data: {post_ids: existing_post_ids},
			success: function(data) {
				$('.isotope').append(data);
			}
		}).always(function(){ busy = false; });
	}

	});
</script>
<?php get_footer(); ?>