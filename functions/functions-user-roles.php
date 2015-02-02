<?php 

/**
 * Creates user role 'Creative' with specific capabilities
 *
 * For more unformation on user roles/capabilities, view http://codex.wordpress.org/Function_Reference/add_role
 */

$result = add_role( 'creative_member', __( 'Creative' ), array(

		//'read' => true,
		//'create_posts' => true,
		//'edit_posts' => true,
		//'delete_posts' => true,
		// 'publish_posts' => true,
		// 'delete_published_posts' => true,
		// 'edit_published_posts' => true,
		// 'publish_posts' => true,
		// 'upload_files' => true,

    	/* Capabilites granted to creative users */
		//'read_uploads' 				=> true, // Allows user to view their creative posts
		//'read_upload'				=> true,
		// 'create_uploads' 			=> true, // Allows user to create new creative posts
		// //'edit_uploads' 				=> true, // Allows user to edit their creative posts
		// 'publish_uploads' 			=> true, // Allows the user to publish creative posts, otherwise posts stays in draft mode
		// 'edit_published_uploads' 	=> true, // Allows the user to edit a previously created post once it has been punlished
		// 'delete_published_uploads' 	=> true, // Allows the user to remove a previously created post once it has been published
		// //'delete_uploads'			=> true, // Allows the user to delete their own post, but not another's post

		// /* Capabilities explicitly removed for creative users */
		// 'read_private_uploads'		=> false, // Disallows the user from reading privately uploaded creative posts (Although they shouldn't be posting private posts anyway)
		// 'edit_others_puploads'		=> false, // Disallows the user from editing other creative user's posts
		// 'delete_others_uploads'		=> false, // Disallows the user from deleting other creative user's posts
		// 'delete_private_posts'		=> false, // Disallows the user from deleting privately published creative posts
		// 'edit_private_posts' 		=> false,  // Disallows the user from editing privately published creative posts	

		// 'manage_categories' 		=> false, // Disallows the user from managing post categories
    )
);
register_activation_hook( __FILE__, 'add_roles' );

/**
 *
 */
function add_creative_capabilities() {

	/* Get the appropriate role */
    $role = get_role( 'creative_member' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'read_uploads' );
    $role->add_cap( 'file_uploads' ); 

}
add_action( 'admin_init', 'add_creative_capabilities');

?>