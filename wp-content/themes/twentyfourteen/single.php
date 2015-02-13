<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );


				// Conditional check to see if this is a custom post type 'movie-reviews' (if there is only this addition involved - no need to use another template)
				if ( is_singular( 'movie-reviews' ) ) { ?>       

					<div class="movie-link">
					<a href="<?php echo get_post_meta($post->ID, $key, true); ?>"> Great movie link that you should click on!</a>
					</div>

				<?php }

					// Previous/next post navigation.
					twentyfourteen_post_nav();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php

if ( $post->ID == 1 ) {
	get_sidebar( 'content' );
}
else {
 	get_sidebar('test');
}
get_sidebar();
get_footer();
