<?php
/**
 * Template Name: Post List
 *  THIS IS IN DEVELOPMENT
 */

get_header(); ?>
 
<div id="main-content" class="main-content">
 
<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		get_template_part( 'featured-content' );
	}
?>
 
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php

			$authors = get_field( 'authors' );
			$authors = array_map('current', $authors);

			$args = array(
				'author__in' => $authors,
				'post_status' => get_field( 'post_status' ),
				'category__in' => get_field( 'categories' ),
				'post_type' => get_field( 'post_type' ),
				'posts_per_page' => get_field( 'posts_per_page' ),
				'orderby' => get_field( 'orderby' ),
				'order' => get_field( 'order' )
			);

			if( get_field( 'cartegory_include_exclude' ) == 'exclude' ) {
				$args['category__not_in'] = get_field( 'categories' );
			}
			else {
				$args['category__in'] = get_field( 'categories' );
			}

			if( !empty( get_field( 'has_featured_image' ) ) ) {
				$args['meta_query'] = array(
					array(
						'key'     => '_thumbnail_id',
						'value'   => '',
						'compare' => '!=',
					),
				);
			}

			$postlist = new WP_Query( $args );

			if ( $postlist->have_posts() ) :

				while ( $postlist->have_posts() ) : $postlist->the_post();

					get_template_part( 'content', get_post_format() );

				endwhile;

				twentyfourteen_paging_nav();

			else :

				get_template_part( 'content', 'none' );

			endif;
		?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->
 
<?php
get_sidebar();
get_footer();	