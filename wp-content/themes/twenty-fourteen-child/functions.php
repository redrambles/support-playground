<?php
/**
 * Twenty Fourteen CHILD functions and definitions
 *
 */

//import Parent Theme CSS

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

//Add Custom Post Types - SUPPORT TEST - January 10th 2015
// Creates Movie Reviews Custom Post Type
function movie_reviews_init() {

	$supports = array(
	'title', // post title
	'editor', // post content
	'author', // post author
	'thumbnail', // featured images
	'excerpt', // post excerpt
	'custom-fields', // custom fields
	'comments', // post comments
	'revisions', // post revisions
	'post-formats',
	'page-attributes' //so that you can indicate parent relationships between custom post types
	);
    $args = array(
      'label' => 'Movie Reviews',
      'has_archive' => true,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'movie-reviews'),
        'query_var' => true,
        'menu_icon' => 'dashicons-video-alt',
        'supports' => $supports,
    	'taxonomies' => array('post_tag', 'category'),
    );
    register_post_type( 'movie-reviews', $args );
}
add_action( 'init', 'movie_reviews_init' );


// Add a Genre taxonomy

//register custom taxonomies
function movie_create_taxonomies() {
	//define labels for the taxonomy
	$labels = array(
		'name' => __( 'Genre', 'movie' ),
		'singular-name' => __('Genre', 'movie' ),
		'search_items' => __( 'Search Genres', 'movie' ),
		'all_items' => __( 'Parent Genre', 'movie' ),
		'parent_item_colon' => __(' Parent Genre:', 'movie' ),
		'edit_item' => __( 'Edit Genre', 'movie' ),
		'update_item' => __( 'Update Genre', 'movie' ),
		'add_new_item' => __( 'Add New Genre', 'movie' ),
		'new_item_name' => __( 'New Genre', 'movie' ),
		'separate_items_with_commas' => __( 'Separate genres with commas', 'movie' ), //only with non-hierarchical taxonomies
		'menu_name' => __( 'Genre' ),
	);
	register_taxonomy( 'genre', 'movie-reviews', array(
		'hierarchical' => false,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'show_admin_column' => true
		)
	 );
}
add_action( 'init', 'movie_create_taxonomies', 0);

// Enables the use of shortcodes in sidebars - 
add_filter('widget_text', 'shortcode_unautop'); // This removes any 'forced styling' WP would have included
add_filter('widget_text', 'do_shortcode');


// Add Custom Meta Box
function movie_create_time_meta_box() {
	add_meta_box( 'movie_time_metabox', 'Time of the day movie was watched:', 'movie_time', 'movie-reviews', 'normal', 'high' );
}
function movie_time($post) { ?>
	<form action="" method="post">
		<?php // add nonce for security
		wp_nonce_field( 'move_metabox_nonce', 'movie_nonce' );
		//retrieve the metadata values if they exist
		$movie_watch = get_post_meta( $post->ID, 'Time', true ); ?>
		<label for "movie_watch">Did you watch the movie in the morning, afternoon or evening?</label>
		<input type="text" name="movie_watch" value="<?php echo esc_attr($movie_watch);?>"/>
	</form>
<?php }
add_action( 'add_meta_boxes', 'movie_create_time_meta_box');

add_action( 'save_post', 'movie_time_save_meta' );
function movie_time_save_meta( $post_id ) {
	if ( isset( $_POST['movie_watch'] ) ) {
		$new_movie_time_value = ( $_POST['movie_watch'] );
		update_post_meta( $post_id, 'Time', $new_movie_time_value );
	}
}


// shortcode: [page_sidebar] Usage example = [page_sidebar id="2" ] 
function diy_page_in_sidebar($atts, $content=null){
 
    extract(shortcode_atts( array('id' => ''), $atts));

     $output = '';
     $args = array(
		'page_id' => $id,
		);
     $custom_query = new WP_Query( $args );

		if ($custom_query->have_posts()) :
		$output .= '<div class="page_sidebar">';
		while ($custom_query->have_posts()) : $custom_query->the_post();?>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php the_post_thumbnail('thumb');?>

		<?php endwhile;
		$output .= '</div>';
		endif;
		wp_reset_postdata(); 

	return $output;

}
add_shortcode('page_sidebar', 'diy_page_in_sidebar');

// shortcode: [post_sidebar] Usage example = [post_sidebar id="4" ] 
function diy_post_in_sidebar($atts, $content=null){
 
    extract(shortcode_atts( array('id' => ''), $atts));

     $output = '';
     $args = array(
		'p' => $id,
		);
     $custom_query = new WP_Query( $args );

		if ($custom_query->have_posts()) :
		$output .= '<div class="post_sidebar">';
		while ($custom_query->have_posts()) : $custom_query->the_post();?>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php the_post_thumbnail('thumb');?>

		<?php endwhile;
		$output .= '</div>';
		endif;
		wp_reset_postdata(); 

	return $output;

}
add_shortcode('post_sidebar', 'diy_post_in_sidebar');

// shortcode: [home]
function diy_home_link_shortcode() {
return '<a href="http://example.com/">Home Page</a>';
}
add_shortcode('home', 'diy_home_link_shortcode');



//Display recent posts from a category
function wpb_postsbycategory() {
// the query
$the_query = new WP_Query( array( 'category_name' => 'edge-case-2', 'posts_per_page' => 10 ) ); 

// The Loop
if ( $the_query->have_posts() ) {
	$string .= '<ul class="postsbycategory widget_recent_entries">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
			if ( has_post_thumbnail() ) {
			$string .= '<li>';
			$string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 50, 50) ) . get_the_title() .'</a></li>';
			} else { 
			// if no featured image is found
			$string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
			}
			}
	} else {
	// no posts found
}
$string .= '</ul>';

return $string;

/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode [categoryposts]
add_shortcode('categoryposts', 'wpb_postsbycategory');

// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');

