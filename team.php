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
						foreach ( $creative_users as $creative_user ) : ?>

	 						<article id="<?php echo $title ?>" class="item <?php if($category){ echo $category[0]->cat_name; } ?>" style="background-image:url('<?php echo $image_url[0] ?>');">
							<div class="nameHeader"><h3><?php echo $creative_user->display_name ?></h3></div>
							<div class="itemIcons">

<?php  							/* Every account has an email that is associated with the account so there is no need for an if statement here. */?>
								<a id="emailIcon" target="_blank" href="mailto:<?php echo $creative_user->user_email ?>"><i class="fa fa-envelope"></i></a>
<?php 							

								/* All of the following calls for personal user information are usernames that can be stored
								 * by simply storing the username, therefore not requesting an entire url from the creative member
								 * making it easier to input the information (for the creative member). Therefore some of the
								 * following calls have a website url prefix associated with the href call. This is because these
								 * sites follow the username url convention "http://websiteurl.com/usernamehere/ to access their 
								 * personal accounts on that site.
								 */

								if($creative_user->twitter) : ?>
									<a id="twitterIcon" target="_blank" href="http://twitter.com/<?php echo $creative_user->twitter ?>"><i class="fa fa-twitter"></i></a>
<?php 							endif;

								if($creative_user->instagram) : ?>
									<a id="twitterIcon" target="_blank" href="http://instagram.com/<?php echo $creative_user->instagram ?>"><i class="fa fa-instagram"></i></a>
<?php 							endif;

								if($creative_user->behance) : ?>
									<a id="behanceIcon" target="_blank" href="http://behance.net/<?php echo $creative_user->behance ?>"><i class="fa fa-behance"></i></a>
<?php 							endif;
								
								/* LinkedIn uses a unique link, so there is no prefix attached to the call because users will
								 * have to enter their unique LinkedIn url for it to work properly.
								 */
								if($creative_user->linkedin) : ?>
									<a id="linkedinIcon" target="_blank" href="<?php echo $creative_user->linkedin ?>"><i class="fa fa-linkedin"></i></a>
<?php 							endif;
								
								if($creative_user->vimeo) : ?>
									<a id="vimeoIcon" target="_blank" href="http://vimeo.com/<?php echo $creative_user->vimeo ?>"><i class="fa fa-vimeo-square"></i></a>
<?php 							endif;
								
								if($creative_user->github) : ?>
									<a id="gitIcon" target="_blank" href="http://github.com/<?php echo $creative_user->github ?>"><i class="fa fa-github"></i></a>
<?php 							endif;
																
								/* Personal websites have a unique link as well, so there is no prefix because users will have
								 * to entire their unique url if they have a personal website or portfolio for this link to work.
								 */
								if($creative_user->personal) :	?>
									<a id="personalIcon" target="_blank" href="<?php echo $creative_user->personal ?>"><i class="fa fa-user"></i></a>
<?php 							endif; ?>



							</div> 
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