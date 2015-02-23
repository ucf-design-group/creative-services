<?php

$post_ids = $_GET["post_ids"];


/* Query for the posts. */
$creativeLoop = new WP_QUERY(array('post__not_in' => $post_ids, 'post_type' => 'portfolio', 'posts_per_page' => 10, 'orderby' => 'date', 'order' => 'DSC'));

/* Initialize empty variable to put in objects. */
$content = '';

/* Get the posts and add it into $content.  */
if ($creativeLoop -> has_posts()) : while ($creativeLoop -> has_posts()) : $creativeLoop -> the_post;
	$content .= "<div data-post-id = ' " . get_the_id() . " ' class = 'single-post-wrapper'>";
	$content .= "</div>";
endwhile; endif; wp_reset_query();

/* Output the initially empty variable, then JavaScript will use it to return objects onto the page. */
echo $content;							

?>