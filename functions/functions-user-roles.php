<?php 

$result = add_role(
    'creative_member',
    __( 'Creative' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => false,
        'delete_posts' => false, // Use false to explicitly deny
    )
);
/*
if ( null !== $result ) {
    echo 'Role created!';
}
else {
    echo 'This role already exists!';
}*/

function add_roles() {
	add_role( 'creative_member', 'Creative', array( 'read' => true, 'level_2' => true ) );
}
register_activation_hook( __FILE__, 'add_roles' );
?>