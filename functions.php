<?php

/* Allow Post Thumbnails to be used */

function setup_thumbnails() {

	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'setup_thumbnails');


/* Remove menus from the admin dashboard
 *
 * In order to use this function, uncomment "add_action(...)" at the end.
 *
 * All of the administration pages are listed here (in order of appearance in the dashboard)
 * so that you may choose which are removed.  If you remove a main page, you do not also
 * need to remove its subpages.
 *
 * Use this for cleaning up the dashboard only (example: you wish to remove the Posts link
 * because you use only custom post types).  Do not use it for security (example: to keep
 * another user from editing theme files, etc).  Roles (Editor versus Admin) and
 * Capabilities (which can be added and removed for specific roles and users) are best
 * suited for such a purpose.
 */

function remove_menus() {

	/* Pages removed for all users, including administrators. */

	remove_menu_page( 'edit.php' );
		remove_submenu_page( 'edit.php', 'post-new.php' );
		remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
		remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
	remove_menu_page('upload.php');
		remove_submenu_page('upload.php', 'media-new.php');
	remove_menu_page('link-manager.php');
		remove_submenu_page('link-manager.php', 'link-add.php');
		remove_submenu_page('link-manager.php', 'edit-tags.php?taxonomy=link_category');	
	remove_menu_page('edit.php?post_type=osi-events');
		remove_submenu_page( 'edit.php?post_type=osi-events', 'edit.php?post_type=osi-events' );
		remove_submenu_page( 'edit.php?post_type=osi-events', 'post-new.php?post_type=osi-events' );
		remove_submenu_page( 'edit.php?post_type=osi-events', 'edit-tags.php?taxonomy=category&post_type=osi-events' );
	remove_menu_page('edit-comments.php');
		
	/* Pages removed for all users that aren't administrators (we only show them the uploads page) */

	if( ! is_admin() ){

		remove_menu_page('edit.php?post_type=page');
			remove_submenu_page('edit.php', 'post-new.php?post_type=page');
		remove_menu_page('themes.php');
			remove_submenu_page('themes.php', 'widgets.php');
			remove_submenu_page('themes.php', 'nav-menus.php');
			remove_submenu_page('themes.php', 'theme-editor.php');
		remove_menu_page('plugins.php');
			remove_submenu_page('plugins.php', 'plugin-install.php');
			remove_submenu_page('plugins.php', 'plugin-editor.php');
		remove_menu_page('users.php');
			remove_submenu_page('users.php', 'user-new.php');
			remove_submenu_page('users.php', 'profile.php');
		remove_menu_page('tools.php');
			remove_submenu_page('tools.php', 'import.php');
			remove_submenu_page('tools.php', 'export.php');
		remove_menu_page('options-general.php');
			remove_submenu_page( 'options-general.php', 'options-writing.php' );
			remove_submenu_page( 'options-general.php', 'options-reading.php' );
			remove_submenu_page( 'options-general.php', 'options-discussion.php' );
			remove_submenu_page( 'options-general.php', 'options-media.php' );
			remove_submenu_page( 'options-general.php', 'options-permalink.php' );

		/* Removes plugin menus */
		remove_menu_page( 'admin.php?page=wpseo_dashboard' );
		remove_menu_page( 'admin.php?page=powerpress/powerpressadmin_basic.php' );
			// remove_submenu_page();
	}
}
add_action('admin_menu', 'remove_menus');

/* Removes links from the wpadminbar */
function remove_admin_bar_links() {
	
	/* Gets the global variable for the wpadminbar */
	global $wp_admin_bar;

	/**
	 * Removes buttons deemed unnecessary for the creative members. These buttons
	 * have extra functionality that creative members would never use and may distract
	 * them from the reason they're there: to upload works.
	 */
	// $wp_admin_bar->remove_menu('new-content');
	$wp_admin_bar->remove_menu('my-sites');
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

function custom_post_types() {

	/**
	 * Adds post type 'file-upload' for creative users to upload content to the site.
	 *
	 * One important thing to note here is the use of the post type's capabilities.
	 * Because creative users will need permission to read/write/edit/upload/etc. their
	 * uploads to the site, appropriate permissions (capabilities) must be designated
	 * so that the capabilities can be added to the creative user role.
	 *
	 * These capabilities correspond with functionality for the role 'creative-user'
	 * which us defined in "functions/functions-user-roles". For a direct correlation
	 * between this post type and creative users, view this file.
	 *
	 * For more information on capabilities, look at: http://codex.wordpress.org/Function_Reference/register_post_type
	*/

	register_post_type('file_upload', array(
	'labels' 			=> array(
		'name' 				=> 'Uploads',
		'singular_name' 	=> 'Upload'),
	'public' 			=> true,
	'hierarchical' 		=> false,
	'supports' 			=> array('title', 'thumbnail'),
	'capability_type'	=> 'file_upload',
	'capabilities' 		=> array(
	
		/**
		 * These are capabilities that will be litigated to creative users. This section
		 * does not grant them these permissions, but instead creates permission variables
		 * for the post type so that they can be granted to users. 
		 */

		/* Capabilities that will be granted to creative users */
		'read'					=> 'cr_read',
		'read_post' 			=> 'cr_read_post',
		'create_posts'			=> 'cr_create_posts',	
		'edit_posts' 			=> 'cr_edit_posts',	
		'publish_posts' 		=> 'cr_publish_posts',
 	 	'edit_published_posts'  => 'cr_edit_published_posts',
 	  	'delete_published_posts'=> 'cr_delete_published_posts',
		'delete_posts' 			=> 'cr_delete_posts',

		/* Capabilities that will be explicitly removed for creative users */
		'read_private_posts'	=> 'cr_read_private_posts',
		'edit_others_posts'	 	=> 'cr_edit_others_posts',
		'delete_private_posts'  => 'cr_delete_private_posts',
	 	'delete_others_posts'   => 'cr_delete_others_posts',
	 	'edit_private_posts'    => 'cr_edit_private_posts',
	 	'moderate_comments'		=> 'cr_moderate_comments',
		),

	'taxonomies' => array('category'),
	'has_archive' => false
	));

}
add_action('init', 'custom_post_types');


/* Change dashboard icons for the custom post types.
 *
 * In order to use this function, uncomment "add_action(...)" at the end.
 *
 * This CSS uses an icon from the cpt_icons collection for a custom post type
 * in the dashboard.  Place the icon in the resources directory.
 */

function cpt_icons() {

	?>
	<style type="text/css" media="screen">
		#menu-posts-news .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/resources/news.png) no-repeat 6px -17px !important;
		}
		#menu-posts-news:hover .wp-menu-image, #menu-posts-news.wp-has-current-submenu .wp-menu-image {
			background-position: 6px 7px!important;
		}
	</style>
<?php
}
//add_action('admin_head', 'cpt_icons');


function format_user_display_name_on_login( $username ) {
    $user = get_user_by( 'login', $username );

    $first_name = get_user_meta( $user->ID, 'first_name', true );
    $last_name = get_user_meta( $user->ID, 'last_name', true );

    $full_name = trim( $first_name . ' ' . $last_name );

    if ( ! empty( $full_name ) && ( $user->data->display_name != $full_name ) ) {
        $userdata = array(
            'ID' => $user->ID,
            'display_name' => $full_name,
        );

        wp_update_user( $userdata );
    }
}
add_action( 'wp_login', 'format_user_display_name_on_login' );


/* To include other collections of functions, include_once() the relevant files here. */

include_once("functions/functions-nav.php");
// include_once("functions/functions-creative-team.php");
include_once("functions/functions-file-upload.php");
include_once("functions/functions-user-profile.php");
include_once("functions/functions-user-roles.php");
// include_once("functions/functions-admin-posts.php");


function get_avatar_url($author_id, $size){
    $get_avatar = get_avatar( $author_id, $size );
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return ( $matches[1] );
}
?>