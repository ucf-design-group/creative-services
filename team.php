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
		<!-- Commented out until functionality returns -->
		<!-- 	<form action="post" name="positionSwap">
				<input type="radio" name="position[]" value="Graphics" id="graphics" onclick="selectionListener();"/><label for="graphics">Graphics</label>
				<input type="radio" name="position[]" value="Web" id="web" onclick="selectionListener();"/><label for="web">Web</label>
				<input type="radio" name="position[]" value="Productions" id="productions" onclick="selectionListener();"/><label for="productions">Productions</label>
				<input type="radio" name="position[]" value="All" id="all" checked="checked" onclick="selectionListener();"/><label for="all">All</label>
			</form> -->
			<div class="isotope">

<?php 					

				$creative_users = get_users( array('role' => 'creative_member' ));
				foreach ( $creative_users as $creative_user ) :
					
					/* Takes the creative_user's id and passes it to get_avatar_url() in functions.php to parse the image output for
					 * the image's url which is then returned as a string which is then used to display the image as a background.
					 */
					$user_avatar_url = get_avatar_url ( $creative_user->ID, $size = '500' ); ?>

					<article id="<?php echo $creative_user->displayname ?>" class="item <?php if($category){ echo $category[0]->cat_name; } ?>" style="background-image:url('<?php echo $user_avatar_url ?>');">
						<div class="nameHeader"><h3><?php echo $creative_user->display_name ?></h3></div>
						<div class="itemIcons">

<?php					/* Every account has an email that is associated with the account so there is no need for an if statement here. 
										
							Email is no longer required at the moment, but this will remain commented out so that if we ever
							do need it, it doesn't have to be re-written.
							<a id="emailIcon" target="_blank" href="mailto:<?php echo $creative_user->user_email ?>"><i class="fa fa-envelope"></i></a> */?>
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
<?php						endif;

							if($creative_user->instagram) : ?>
							<a id="twitterIcon" target="_blank" href="http://instagram.com/<?php echo $creative_user->instagram ?>"><i class="fa fa-instagram"></i></a>
<?php 						endif;
			
							if($creative_user->behance) : ?>
							<a id="behanceIcon" target="_blank" href="http://behance.net/<?php echo $creative_user->behance ?>"><i class="fa fa-behance"></i></a>
<?php						endif;
										
							/* LinkedIn uses a unique link, so there is no prefix attached to the call because users will
							 * have to enter their unique LinkedIn url for it to work properly.
							 */
							if($creative_user->linkedin) : ?>
							<a id="linkedinIcon" target="_blank" href="<?php echo $creative_user->linkedin ?>"><i class="fa fa-linkedin"></i></a>
<?php 						endif;
										
							if($creative_user->vimeo) : ?>
							<a id="vimeoIcon" target="_blank" href="http://vimeo.com/<?php echo $creative_user->vimeo ?>"><i class="fa fa-vimeo-square"></i></a>
<?php 						endif;
							
							if($creative_user->github) : ?>
							<a id="gitIcon" target="_blank" href="http://github.com/<?php echo $creative_user->github ?>"><i class="fa fa-github"></i></a>
<?php 						endif;
																		
							/* Personal websites have a unique link as well, so there is no prefix because users will have
							 * to entire their unique url if they have a personal website or portfolio for this link to work.
							 */
							if($creative_user->personal) :	?>
							<a id="personalIcon" target="_blank" href="<?php echo $creative_user->personal ?>"><i class="fa fa-user"></i></a>
<?php 						endif; ?>
							</div> 
					</article>
<?php			endforeach; ?>

			</div>
		</section>
	</div>

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

<?php get_footer(); ?>