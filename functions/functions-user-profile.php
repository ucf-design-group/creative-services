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

// Calls thhe 'remove_bio' function when the 'admin' section of the profile starts and
// starts output buffering.
function profile_admin_buffer_start() { ob_start("remove_bio"); }

// Closes output buffering once the 'admin' section of the profile ends.
function profile_admin_buffer_end() { ob_end_flush(); }

add_action('admin_head', 'profile_admin_buffer_start');
add_action('admin_footer', 'profile_admin_buffer_end');


/**
 * Modifies default user profile and removes 'color-picker' options.
 * 
 * We don't need users changing too many settings when they should be uploading
 * files instead so in the interest of not wasting time, the color scheme options
 * have been removed.
 */
// Removes admin 'color scheme picker' from user profiles
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

if ( ! function_exists( 'cor_remove_personal_options' ) ) {

	// Removes the leftover 'Visual Editor', 'Keyboard Shortcuts' and 'Toolbar' options.
  	function cor_remove_personal_options( $subject ) {
    	$subject = preg_replace( '#<h3>Personal Options</h3>.+?/table>#s', '', $subject, 1 );
    	return $subject;
  	}

	// Calls the function 'cor_remove_personal_options' to run while editing the buffer filter.
  	function cor_profile_subject_start() { ob_start( 'cor_remove_personal_options' ); }
  	// Closes output buffering for the personal options sectoin.
  	function cor_profile_subject_end() { ob_end_flush(); }
}
add_action( 'admin_head-profile.php', 'cor_profile_subject_start' );
add_action( 'admin_footer-profile.php', 'cor_profile_subject_end' );
?>