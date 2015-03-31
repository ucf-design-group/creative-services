<?php 

/**
 * Creates user role 'Creative' with specific capabilities
 *
 * For more unformation on user roles/capabilities, view http://codex.wordpress.org/Function_Reference/add_role
 */

$result = add_role(
	'creative_member', 
	__( 'Creative' ),
);
register_activation_hook( __FILE__, 'add_roles' );

/**
 *
 */
function add_creative_capabilities() {

	/* Gets the WordPress roles global variable */
	GLOBAL $wp_roles;

	$wp_roles->add_cap( 'file_upload' );

    /* Add global role capabilities */
    $wp_roles->add_cap( 'creative_member', 'read');
    // $wp_roles->remove_cap( 'creative_member', 'create_posts');
    $wp_roles->add_cap( 'creative_member', 'cr_read');
    $wp_roles->add_cap( 'creative_member', 'cr_create_posts');
    $wp_roles->add_cap( 'creative_member', 'publish_posts');
    $wp_roles->add_cap( 'creative_member', 'cr_publish_posts');
    $wp_roles->add_cap( 'creative_member', 'delete_published_posts');
    $wp_roles->add_cap( 'creative_member', 'upload_files');

    /* Add post-related role capabilities */
    $wp_roles->add_cap( 'creative_member', 'cr_read');
    $wp_roles->add_cap( 'creative_member', 'cr_create_posts');
    $wp_roles->add_cap( 'creative_member', 'cr_edit_posts');
    $wp_roles->add_cap( 'creative_member', 'cr_publish_posts');
    $wp_roles->add_cap( 'creative_member', 'cr_edit_published_posts');
    $wp_roles->add_cap( 'creative_member', 'cr_delete_published_posts');
    $wp_roles->add_cap( 'creative_member', 'cr_delete_posts');
}
add_action( 'admin_init', 'add_creative_capabilities');

?>