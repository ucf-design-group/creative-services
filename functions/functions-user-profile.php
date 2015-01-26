<?php 

/*	Modifies the default user contact information.
 *
 *	In the interest of not making custom post-types for users AND uploads,
 *  integrating our needs into the default user profiles is a much easier
 *	and cleaner way to go about this. The following method removes some of
 *	the default user contact information and adds the necessary handles/urls
 *	required by the site.
 */

function modify_user_contact_methods( $user_contact ) {

	/**
	 * So, what's happening here? $user_contact is an array of fields (user contacts)
	 * with a field and associated label. In the first section, fields are being added
	 * to the array, and below, default fields are being removed. Because this is an
	 * array variable and not a physical object on the page, a value needs to be returned
	 * to user_contactmethods so that the page and appropriately handle the changes.
	 */

	/* Add user contact methods */
	$user_contact['twitter'] = __( 'Twitter Handle (no @)' ); 	// Twitter Handle (appended to https://twitter.com/)
	$user_contact['instagram'] = __( 'Instagram Username' ); 	// Instagram Username (appended to https://instagram.com/)
	$user_contact['behance'] = __( 'Behance Username' );		// Behance Username (appended to https://www.behance.net/) 
	$user_contact['vimeo'] =__( 'Vimeo Username' );				// Vimeo Username (appended to https://vimeo.com/)			
	$user_contact['linkedin'] = __( 'LinkedIn url');			// LinkedIn url (Unique link) https://www.linkedin.com/profile/
	$user_contact['github'] = __( 'Github Username');			// Github Username (appended to https://github.com/)

	/* Remove user contact methods */
	unset( $user_contact['yim']);		// Yahoo IM
	unset( $user_contact['aim'] );		// AIM IM
	unset( $user_contact['jabber'] );	// Jabber hHandle
	unset( $user_contact['facebook']); 	// Facebook

	return $user_contact;
}
add_filter( 'user_contactmethods', 'modify_user_contact_methods' );


/**
 * Modifies the 'About Yourself' section in profiles.
 *
 * Removes the default 'About Yourself' section title and replaces the default
 * bio textarea with only password fields. This is so creativer users don't feel
 * obligated to inputting their information and also to make the experience easier
 * all together because the information will not be used on the front-end of the site.
 */

// Callback function to remove default bio field from user profile page
function remove_bio($buffer) {
  	
  	// Creates an array, $titles, that contains the 'About Yourself'  and 'About the user' titles.
	// 'About the user' is the depreciated section title for this section.
	$titles = array('#<h3>About Yourself</h3>#','#<h3>About the user</h3>#');
	
	// Replaces the strings in $titles with 'Password' in the $buffer filter.
	$buffer=preg_replace($titles,'<h3>Password</h3>',$buffer,1);

	// Creates a string comprised of the 'Password' title and the opening table tab.
	$biotable='#<h3>Password</h3>.+?<table.+?/tr>#s';

	// Replaces the $biotable string in the $buffer filter.
	$buffer=preg_replace($biotable,'<h3>Password</h3> <table class="form-table">',$buffer,1);
	return $buffer;
}

?>