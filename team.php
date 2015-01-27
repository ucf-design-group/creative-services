<?php /* Template Name: Team */

get_header(); ?>

			<div class="content-area">
				<div class="main"> 
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content' );
					} ?>
				</div>
					<section class="creative-team">
						<form action="post" name="positionSwap">
							<input type="radio" name="position[]" value="Graphics" id="graphics" onclick="selectionListener();"/><label for="graphics">Graphics</label>
							<input type="radio" name="position[]" value="Web" id="web" onclick="selectionListener();"/><label for="web">Web</label>
							<input type="radio" name="position[]" value="Productions" id="productions" onclick="selectionListener();"/><label for="productions">Productions</label>
																<input type="radio" name="position[]" value="All" id="all" checked="checked" onclick="selectionListener();"/><label for="all">All</label>
						</form>
						<div class="isotope">
<?php 					

						$creative_users = get_users( array('role' => 'creative_member' ));
						// Array of WP_User objects.
						foreach ( $creative_users as $creative_user ) :?>
	 						<article id="<?php echo $title ?>" class="item <?php if($category){ echo $category[0]->cat_name; } ?>" style="background-image:url('<?php echo $image_url[0] ?>');">
							<div class="nameHeader"><h3><?php echo $user->user_nicename ?></h3></div>
							<div class="itemIcons">
								<a id="emailIcon" target="_blank" href="mailto:<?php echo $user?>"><i class="fa fa-envelope"></i></a>
							</div> -->
						</article>
<?php 					endforeach; ?>







<?php


						/*$creativeLoop = new WP_QUERY(array('post_type' => 'creative-team', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC'));
						while ($creativeLoop->have_posts()) {
							$creativeLoop->the_post();
							$title = get_the_title();
							$content = get_the_content();
							$category = get_the_category(); 
							$image = get_the_post_thumbnail($post->ID, 'medium');
							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
							$linkedin = get_post_meta($post->ID, 'creative-form-linkedin', true);
							$email = get_post_meta($post->ID, 'creative-form-email', true);
							$twitter = get_post_meta($post->ID, 'creative-form-twitter', true);
							$behance = get_post_meta($post->ID, 'creative-form-behance', true);
							$vimeo = get_post_meta($post->ID, 'creative-form-vimeo', true);
							$git = get_post_meta($post->ID, 'creative-form-git', true);
							$personal = get_post_meta($post->ID, 'creative-form-personal', true);
							$instagram = get_post_meta($post->ID, 'creative-form-instagram', true);*/

?>							
					<!-- 	<article id="<?php echo $title ?>" class="item <?php if($category){ echo $category[0]->cat_name; } ?>" style="background-image:url('<?php echo $image_url[0] ?>');">
							<div class="nameHeader"><h3><?php echo $title; ?></h3></div>
							<div class="itemIcons">
								<?php 
								if($email){
									?>
									<a id="emailIcon" target="_blank" href="mailto:<?php echo $email ?>"><i class="fa fa-envelope"></i></a>
									<?php
								}
								if($twitter){
									?>
									<a id="twitterIcon" target="_blank" href="https://twitter.com/<?php echo $twitter ?>"><i class="fa fa-twitter"></i></a>
									<?php
								}
								if($instagram){
									?>
									<a id="twitterIcon" target="_blank" href="http://instagram.com/<?php echo $instagram ?>"><i class="fa fa-instagram"></i></a>
									<?php
								}
								if($behance){
									?>
									<a id="behanceIcon" target="_blank" href="<?php echo $behance ?>"><i class="fa fa-behance"></i></a>
									<?php
								}
								if($linkedin){
									?>
									<a id="linkedinIcon" target="_blank" href="<?php echo $linkedin ?>"><i class="fa fa-linkedin"></i></a>
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
						</article> -->
						<script>
							document.getElementById('<?php echo $title ?>').onmouseover = function(){
								var funnyURL = '<?php echo $image_url[0]; ?>';
								funnyURL = funnyURL.substr(0,funnyURL.length - 5);
								funnyURL = funnyURL + '-funny.jpg';
								document.getElementById('<?php echo $title ?>').style.backgroundImage = 'url('+funnyURL+')';
							};
							document.getElementById('<?php echo $title ?>').onmouseout = function(){
								var normalURL = '<?php echo $image_url[0]; ?>';
								document.getElementById('<?php echo $title ?>').style.backgroundImage = 'url('+normalURL+')';
							};
						</script>

<?php 				/*}*/
?>









						</div>
					</section>
				</div>

<?php get_footer(); ?>