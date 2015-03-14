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


				// Conditional check to see if this is a custom post type 'movie-reviews' (if there is only these small additions involved - no need to use another template)
				if ( is_singular( 'movie-reviews' ) ) { ?>       

					<?php 
					$movie_link = 'movie_link';
					$movie_watch = 'Time';
					$themeta = get_post_meta($post->ID, $movie_link, true);
					$themeta2 = get_post_meta($post->ID, $movie_watch, true);

					if ( !empty ( $themeta ) ) { ?>

						<div class="movie-link entry-content">
							<a href="<?php echo get_post_meta($post->ID, $movie_link, true); ?>"> Great movie link that you should click on!</a>
						</div>
					
					<?php } else { ?>

					<div class="entry-content">
						<p>I watched a secret movie. I can't tell you what it is. <br>No, not THAT kind.</p>
					</div>

					<?php } 


					if ( !empty ( $themeta2 ) ) { ?>

						<div class="entry-content">
							<p>I watched the movie in the <?php echo get_post_meta($post->ID, $movie_watch, true); ?>.</p>
						</div>

					<?php } 
				}

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
