<?php /* Template Name: About */
get_header(); ?>

			<div class="content-area">
			<div class="aboutImage">
				<h1>We are the design group.</h1>
				<p> Do you know those posters for awesome events that occur around campus? Or those fun teaser videos for upcoming races or dances? Yeah, we make those. We team up with other agenicies in the Office of Student Involvement to create great experiences for UCF.</p>
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