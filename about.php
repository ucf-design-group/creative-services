<?php /* Template Name: About */
get_header(); ?>

			<div class="content-area">
			<div class="aboutImage">
				<h1>Something should go here.</h1>
				<p>Some more things should be going here, maybe something about what exactly we do here in the OSI Creative Services. Not too many lines of text but just enough to get the point across, you know?</p>
			</div>
				<div class="main">
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'single' );
					} ?>
				</div>
				<!-- <aside> -->
					<!-- OPTIONAL -->
				<!-- </aside> -->
			</div>

<?php get_footer(); ?>