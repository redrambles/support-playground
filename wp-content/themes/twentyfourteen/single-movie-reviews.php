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
	$movie_url = get_field('movie_url');
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

				<?php get_template_part( 'content', 'page' ); ?>

				<h6 class="movie-link"><a href="<?php echo $movie_url ?>"><?php echo $movie_url; ?></a></h6>

		</div><!-- #content -->
	</div><!-- #primary -->
		<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->
<?php
get_sidebar();
get_footer();
