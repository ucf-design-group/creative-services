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
							<input type="radio" name="position[]" value="Graphics" id="graphics" onclick="workSelectionListener();"/><label for="graphics">Graphics</label>
							<input type="radio" name="position[]" value="Web" id="web" onclick="workSelectionListener();"/><label for="web">Web</label>
							<input type="radio" name="position[]" value="Productions" id="productions" onclick="workSelectionListener();"/><label for="productions">Productions</label>
							<input type="radio" name="position[]" value="All" id="all" checked="checked" onclick="workSelectionListener();"/><label for="all">All</label>
						</form>
						<div id="allSection">
<?php
						$creativeLoop = new WP_QUERY(array('post_type' => 'creative-team', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC'));
						while ($creativeLoop->have_posts()) {
							$creativeLoop->the_post();
							$title = get_the_title();
							$content = get_the_content();
							$image = get_the_post_thumbnail($post->ID, 'medium');
							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
							// $position = get_post_meta($post->ID, 'creative-form-position', true);
							$email = get_post_meta($post->ID, 'creative-form-email', true);
							$twitter = get_post_meta($post->ID, 'creative-form-twitter', true);
							$behance = get_post_meta($post->ID, 'creative-form-behance', true);
							$vimeo = get_post_meta($post->ID, 'creative-form-vimeo', true);
							$git = get_post_meta($post->ID, 'creative-form-git', true);

?>							
						<article class="creative">
							<div class="creativeHeadshot"><?php echo $image ?></div>
							<h3><?php echo $title; ?></h3>
<!-- 							<span>Email:</span><a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
							<span>Twitter:</span><a class="twitter" href="https://twitter.com/<?php echo $twitter; ?>">@<?php echo $twitter; ?></a>
							<span>Behance:</span><a class="behance" href="<?php echo $behance; ?>">Behance</a>
							<span>Vimeo:</span><a class="vimeo" href="<?php echo $vimeo; ?>">Vimeo</a>
							<span>Github:</span><a class="github" href="<?php echo $git; ?>">Github</a> -->
						</article>
<?php 				}
?>
						</div>
						<div id="graphicSection" class="hidden">
<?php
//Grab Others

						$creativeLoop = new WP_QUERY(array('post_type' => 'creative-team', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC', 'category_name' => 'Graphic'));
						while ($creativeLoop->have_posts()) {
							$creativeLoop->the_post();
							$title = get_the_title();
							$content = get_the_content();
							$image = get_the_post_thumbnail($post->ID, 'medium');
							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
							// $position = get_post_meta($post->ID, 'creative-form-position', true);
							$email = get_post_meta($post->ID, 'creative-form-email', true);
							$twitter = get_post_meta($post->ID, 'creative-form-twitter', true);
							$behance = get_post_meta($post->ID, 'creative-form-behance', true);
							$vimeo = get_post_meta($post->ID, 'creative-form-vimeo', true);
							$git = get_post_meta($post->ID, 'creative-form-git', true);

?>							
						<article class="creative">
							<div class="creativeHeadshot"><?php echo $image ?></div>
							<h3><?php echo $title;?></h3>
<!-- 							<span>Email:</span><a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
							<span>Twitter:</span><a class="twitter" href="https://twitter.com/<?php echo $twitter; ?>">@<?php echo $twitter; ?></a>
							<span>Behance:</span><a class="behance" href="<?php echo $behance; ?>">Behance</a>
							<span>Vimeo:</span><a class="vimeo" href="<?php echo $vimeo; ?>">Vimeo</a>
							<span>Github:</span><a class="github" href="<?php echo $git; ?>">Github</a> -->
						</article>
<?php 				}
?>
						</div>
						<div id="webSection" class="hidden">
<?php

					$creativeLoop = new WP_QUERY(array('post_type' => 'creative-team', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC', 'category_name' => 'Web'));
						while ($creativeLoop->have_posts()) {
							$creativeLoop->the_post();
							$title = get_the_title();
							$content = get_the_content();
							$image = get_the_post_thumbnail($post->ID, 'medium');
							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
							// $position = get_post_meta($post->ID, 'creative-form-position', true);
							$email = get_post_meta($post->ID, 'creative-form-email', true);
							$twitter = get_post_meta($post->ID, 'creative-form-twitter', true);
							$behance = get_post_meta($post->ID, 'creative-form-behance', true);
							$vimeo = get_post_meta($post->ID, 'creative-form-vimeo', true);
							$git = get_post_meta($post->ID, 'creative-form-git', true);

?>							
						<article class="creative">
							<div class="creativeHeadshot"><?php echo $image ?></div>
							<h3><?php echo $title; ?></h3>
<!-- 							<span>Email:</span><a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
							<span>Twitter:</span><a class="twitter" href="https://twitter.com/<?php echo $twitter; ?>">@<?php echo $twitter; ?></a>
							<span>Behance:</span><a class="behance" href="<?php echo $behance; ?>">Behance</a>
							<span>Vimeo:</span><a class="vimeo" href="<?php echo $vimeo; ?>">Vimeo</a>
							<span>Github:</span><a class="github" href="<?php echo $git; ?>">Github</a> -->
						</article>
<?php 				}
?>
						</div>
						<div id="productionSection" class="hidden">
<?php

					$creativeLoop = new WP_QUERY(array('post_type' => 'creative-team', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'ASC', 'category_name' => 'Video'));
						while ($creativeLoop->have_posts()) {
							$creativeLoop->the_post();
							$title = get_the_title();
							$content = get_the_content();
							$image = get_the_post_thumbnail($post->ID, 'medium');
							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
							// $position = get_post_meta($post->ID, 'creative-form-position', true);
							$email = get_post_meta($post->ID, 'creative-form-email', true);
							$twitter = get_post_meta($post->ID, 'creative-form-twitter', true);
							$behance = get_post_meta($post->ID, 'creative-form-behance', true);
							$vimeo = get_post_meta($post->ID, 'creative-form-vimeo', true);
							$git = get_post_meta($post->ID, 'creative-form-git', true);

?>							
						<article class="creative">
							<div class="creativeHeadshot"><?php echo $image ?></div>
							<h3><?php echo $title; ?></h3>
<!-- 							<span>Email:</span><a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
							<span>Twitter:</span><a class="twitter" href="https://twitter.com/<?php echo $twitter; ?>">@<?php echo $twitter; ?></a>
							<span>Behance:</span><a class="behance" href="<?php echo $behance; ?>">Behance</a>
							<span>Vimeo:</span><a class="vimeo" href="<?php echo $vimeo; ?>">Vimeo</a>
							<span>Github:</span><a class="github" href="<?php echo $git; ?>">Github</a> -->
						</article>
<?php 				}
?>
					</div>
					</section>
				</div>

<?php get_footer(); ?>