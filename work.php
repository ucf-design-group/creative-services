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
						$creativeLoop = new WP_QUERY(array('post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' =>'rand'/*meta_key*/, 'order' => 'DSC'));
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
							$personal = get_post_meta($post->ID, 'portfolio-form-personal', true);
							$instagram = get_post_meta($post->ID, 'portfolio-form-instagram', true);

?>							<div class="item <?php if($category){ if($category[0]->cat_name == 'Video'){ echo 'width2'; } } ?> <?php if($category){ echo $category[0]->cat_name; } ?>" style="background-image: url('<?php echo $image_url[0]; ?>');">
								<div class="itemDescription">
									<h1><?php echo $name; ?></h1>
									<div class="itemIcons">
										<?php 
										if($twitter){
											?>
											<a id="twitterIcon" target="_blank" href="https://twitter.com/<?php echo $twitter ?>"><i class="fa fa-twitter"></i></a>
											<?php
										}
										if($instagram){
											?>
											<a id="twitterIcon" target="_blank" href="<?php echo $instagram ?>"><i class="fa fa-instagram"></i></a>
											<?php
										}
										if($behance){
											?>
											<a id="behanceIcon" target="_blank" href="<?php echo $behance ?>"><i class="fa fa-behance"></i></a>
											<?php
										}
										if($vimeo){
											?>
											<a id="vimeoIcon" target="_blank" href="<?php echo $vimeo ?>"><i class="fa fa-vimeo-square"></i></a>
											<?php
										}
										if($git){
											?>
											<a id="gitIcon" target="_blank" href="<?php echo $git ?>"><i class="fa fa-github"></i></a>
											<?php
										}
										if($personal){
											?>
											<a id="personalIcon" target="_blank" href="<?php echo $personal ?>"><i class="fa fa-user"></i></a>
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

<?php get_footer(); ?>