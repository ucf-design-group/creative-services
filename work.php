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
				<form action="post" name="workSwap">
							<input type="radio" name="position[]" value="Graphics" id="work_graphics" onclick="workSelectionListener();"/><label for="work_graphics">Graphics</label>
							<input type="radio" name="position[]" value="Web" id="work_web" onclick="workSelectionListener();"/><label for="work_web">Web</label>
							<input type="radio" name="position[]" value="Productions" id="work_productions" onclick="workSelectionListener();"/><label for="work_productions">Productions</label>
							<input type="radio" name="position[]" value="All" id="work_all" checked="checked" onclick="workSelectionListener();"/><label for="work_all">All</label>
						</form>
				<div class="packery js-packery" data-packery-options='{ "columnWidth": ".grid-sizer", "itemSelector": ".item" }'>
				<div class="grid-sizer"></div>
<?php
						$creativeLoop = new WP_QUERY(array('post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' =>'rand', 'order' => 'DSC'));
						while ($creativeLoop->have_posts()) {
							$creativeLoop->the_post();
							$title = get_the_title();
							$content = get_the_content();
							$category = get_the_category(); 
							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
							$name = get_post_meta($post->ID, 'portfolio-form-name', true);
							$twitter = get_post_meta($post->ID, 'portfolio-form-twitter', true);
							$behance = get_post_meta($post->ID, 'portfolio-form-behance', true);
							$vimeo = get_post_meta($post->ID, 'portfolio-form-vimeo', true);
							$git = get_post_meta($post->ID, 'portfolio-form-git', true);

?>							<div class="item <?php if($category){ if($category[0]->cat_name == 'Video'){ echo 'w2'; } } ?> <?php if($category){ echo $category[0]->cat_name; } ?>" style="background-image: url('<?php echo $image_url[0]; ?>');">
								<div class="itemDescription">
									<h1><?php echo $name; ?></h1>
									<a href="">Fake LINK!</a>
								</div>
							</div>

<?php 				}
?>
				</div>
			</div>

			<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/packery.js"></script>

<?php get_footer(); ?>