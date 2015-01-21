<?php get_header(); ?>

<?php do_action( 'bp_before_content' ); ?>

<!-- CONTENT START -->
<div class="content search-post">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ); ?>

<!-- POST ENTRY START -->
<div id="post-entry">
<section class="post-entry-inner">

<?php
$archive_headline = get_theme_option('archive_headline');
if($archive_headline != 'Disable') {
get_template_part( 'lib/templates/headline' );
} ?>

<?php
$archive_excerpt = get_theme_option('post_custom_excerpt');
$excerpt_moretext = get_theme_option('post_excerpt_moretext');
if($archive_excerpt == '0') { $archive_excerpt = '0'; } else if( empty($archive_excerpt) ) { $archive_excerpt = '30'; }
if($excerpt_moretext == '') { $excerpt_moretext = 'Continue Reading &raquo;'; }
$oddpost = 'alt-post'; $postcount = 1; if (have_posts()) : while (have_posts()) :  the_post();
?>

<?php do_action( 'bp_before_blog_post' ); ?>

<!-- POST START -->
<article <?php post_class($oddpost); ?> id="post-<?php the_ID(); ?>">

<h2 class="post-title entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php get_template_part( 'lib/templates/post-meta' ); ?>

<?php do_action( 'bp_before_post_content' ); ?>
<div class="post-content">
<div class="entry-content"><?php echo dez_get_custom_the_excerpt($archive_excerpt); ?></div>
</div>
<?php do_action( 'bp_after_post_content' ); ?>

</article>
<!-- POST END -->

<?php do_action( 'bp_after_blog_post' ) ?>

<?php ($oddpost == "alt-post") ? $oddpost="" : $oddpost="alt-post"; $postcount++; ?>

<?php endwhile; ?>

<?php else: ?>

<?php get_template_part( 'lib/templates/result' ); ?>

<?php endif; ?>

<?php get_template_part( 'lib/templates/paginate' ); ?>

</section>
</div>
<!-- POST ENTRY END -->

<?php do_action( 'bp_after_blog_home' ); ?>

</div><!-- CONTENT INNER END -->
</div><!-- CONTENT END -->

<?php do_action( 'bp_after_content' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>