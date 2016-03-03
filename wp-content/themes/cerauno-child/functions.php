<?php


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 *  int $content_width
 */

// function my_single_blog_entry_width( $content_width ) {
// 	if (is_single()) {
// 		$content_width = 1000;
// 		return $content_width;
// 	}
// }
// add_filter( 'cerauno_content_width', 'my_single_blog_entry_width');

// if ( ! isset( $content_width ) )
//     $content_width = 800;

// Tested - Works!
// function remove_some_widgets(){

// 	// Unregister some of the sidebars
// 	unregister_sidebar( 'sidebar-1' );
// 	unregister_sidebar( 'sidebar-2' );
// }
// add_action( 'widgets_init', 'remove_some_widgets', 11 );