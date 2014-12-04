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
<?php
						$creativeLoop = new WP_QUERY(array('post_type' => 'creative-team', 'posts_per_page' => -1, 'orderby' =>'meta_value', 'order' => 'DSC', 'meta_key' => 'creative-form-order'));
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
					</section>
				</div>

<?php get_footer(); ?>