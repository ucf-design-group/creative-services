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

	remove_menu_page('edit.php');
		remove_submenu_page('edit.php', 'post-new.php');
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
	// remove_menu_page('upload.php');
		// remove_submenu_page('upload.php', 'media-new.php');
	remove_menu_page('link-manager.php');
		remove_submenu_page('link-manager.php', 'link-add.php');
		remove_submenu_page('link-manager.php', 'edit-tags.php?taxonomy=link_category');
	remove_menu_page('edit-comments.php');

	$user = wp_get_current_user();
	// if ($user->wp_capabilities['Administrator'] != 1) {

			remove_submenu_page('index.php', 'update-core.php');
		//remove_menu_page('edit.php?post_type=page');
			//remove_submenu_page('edit.php', 'post-new.php?post_type=page');
		//remove_menu_page('themes.php');
			//remove_submenu_page('themes.php', 'widgets.php');
			//remove_submenu_page('themes.php', 'nav-menus.php');
			//remove_submenu_page('themes.php', 'theme-editor.php');
		remove_menu_page('plugins.php');
			remove_submenu_page('plugins.php', 'plugin-install.php');
			remove_submenu_page('plugins.php', 'plugin-editor.php');
		//remove_menu_page('users.php');
			//remove_submenu_page('users.php', 'user-new.php');
			//remove_submenu_page('users.php', 'profile.php');
		remove_menu_page('tools.php');
			remove_submenu_page('tools.php', 'import.php');
			remove_submenu_page('tools.php', 'export.php');
		//remove_menu_page('options-general.php');
			//remove_submenu_page( 'options-general.php', 'options-writing.php' );
			//remove_submenu_page( 'options-general.php', 'options-reading.php' );
			//remove_submenu_page( 'options-general.php', 'options-discussion.php' );
			//remove_submenu_page( 'options-general.php', 'options-media.php' );
			//remove_submenu_page( 'options-general.php', 'options-permalink.php' );
	// }
}
add_action('admin_menu', 'remove_menus');


/*	Add menus to the admin dashboard
 * 	
 *	In order for creativer users (graphics, video and web designers) to upload their work,
 * 	this menu is necessary. Users will be able to login to the site, upload files, and access
 *	their work using this method.
 *	
 *	The call for this page is located in the functions/functions.nav
 */
// function register_file_upload_menu(){

// 	/* 	Adds upload functions for all users, admins and creative 
// 		users (graphics, video and web). */

//     add_menu_page( 'File Upload', 'File Upload', 'manage_options', 'file-upload', 'creative_file_upload',plugins_url( 'myplugin/images/icon.png'), 6 ); 
//     		add_submenu_page( 'file-upload', 'My Custom Submenu Page', 'My Custom Submenu Page', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' );
// }
// add_action( 'admin_menu', 'register_file_upload_menu' );


/* Sample Custom Post Type
 *
 * In order to use this function, uncomment "add_action(...)" at the end.
 *
 * This code will add a new type of post to the site called "news".  It will appear
 * in the dashboard and have the features mentioned in the "supports" field.
 *
 * Full documentation for register_post_type() can be found at:
 * 		http://codex.wordpress.org/Function_Reference/register_post_type
 */

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

	register_post_type('file-upload', array(
	'labels' 			=> array(
		'name' 			=> 'File Upload',
		'singular_name' => 'File Upload'),
	'public'			=> true,
	'hierarchical'		=> false,
	'supports' 			=> array('title', 'thumbnail', 'editor'),
	'capability_type' 		=> 'upload',
	'capabilities' 		=> array(

		/* Capabilities that will be granted to creative users */
		//'read'					=> 'read_uploads',
		//'read_post' 			=> 'read_upload',
		// 'create_posts'			=> 'create_uploads',	
		//'edit_posts' 			=> 'edit_uploads',	
		// 'publish_posts' 		=> 'publish_uploads',
  //       'edit_published_posts'  => "edit_published_uploads",
  //       'delete_published_posts'=> "delete_published_uploads",
		//'delete_posts' 			=> 'delete_uploads',

		/* Capabilities that will be explicitly removed for creative users */
		// 'read_private_posts'	=> 'read_private_uploads',
		// 'edit_others_posts'	 	=> "edit_others_uploads",
	 //    'delete_private_posts'  => "delete_priate_uploads",
  //       'delete_others_posts'   => "delete_others_uploads",
  //       'edit_private_posts'    => "edit_private_uploads",
		),
	'taxonomies' 		=> array('category'),
	'has_archive' 		=> false
	));
}
add_action('init', 'custom_post_types');


/**
 *
 
function register_cpt_gallery() {
$labels = array( 
    'name' => _x( 'File Uploads', 'File Uploads' ),
    'singular_name' => _x( 'Gallery', 'gallery' ),
    'add_new' => _x( 'Add New', 'gallery' ),
    'add_new_item' => _x( 'Add New Gallery', 'gallery' ),
    'edit_item' => _x( 'Edit Gallery', 'gallery' ),
    'new_item' => _x( 'New Gallery', 'gallery' ),
    'view_item' => _x( 'View Gallery', 'gallery' ),
    'search_items' => _x( 'Search Galleries', 'gallery' ),
    'not_found' => _x( 'No galleries found', 'gallery' ),
    'not_found_in_trash' => _x( 'No galleries found in Trash', 'gallery' ),
    'parent_item_colon' => _x( 'Parent Gallery:', 'gallery' ),
    'menu_name' => _x( 'Galleries', 'gallery' ),
);
add_action( 'init', 'register_cpt_gallery' );
*/

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


/* To include other collections of functions, include_once() the relevant files here. */

include_once("functions/functions-nav.php");
// include_once("functions/functions-creative-team.php"), 'editor';
// include_once("functions/functions-portfolio.php");
include_once("functions/functions-user-profile.php");
include_once("functions/functions-user-roles.php");
include_once("functions/functions-admin-posts.php");
?>