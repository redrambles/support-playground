<?php
/**
 * The template for displaying single movie reviews.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">


<?php
	//$movie_url = get_field('movie_url');
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

				<?php
				// Start the Loop.
				$key="movie_link";

				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' ); ?>

					<div class="movie-link">
					<a href="<?php echo get_post_meta($post->ID, $key, true); ?>">Great movie link that you should click on!</a>
					</div>	

				<?php endwhile; ?>


		</div><!-- #content -->
	</div><!-- #primary -->
		<?php get_sidebar( 'content' ); ?>

</div><!-- #main-content -->
<?php
get_sidebar();
get_footer();
