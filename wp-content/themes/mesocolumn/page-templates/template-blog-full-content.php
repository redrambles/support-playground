<?php
/*
Template Name: Blog Full Content
*/
?>

<?php get_header(); ?>

<?php do_action( 'bp_before_content' ); ?>
<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ); ?>

<!-- POST ENTRY START -->
<div id="post-entry">
<section class="post-entry-inner">

<?php
global $more; $more = 0;
$max_num_post = get_option('posts_per_page');
$page = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("cat=&showposts=$max_num_post&paged=$page");
$oddpost = 'alt-post'; $postcount = 1;
if (have_posts()) : while ( have_posts() ) : the_post(); ?>

<?php do_action( 'bp_before_blog_post' ); ?>

<!-- POST START -->
<article <?php post_class($oddpost); ?> id="post-<?php the_ID(); ?>">

<h2 class="post-title entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php get_template_part( 'lib/templates/post-meta' ); ?>

<?php do_action( 'bp_before_post_content' ); ?>
<div class="post-content">
<div class="entry-content"><?php the_content( __('...Continue reading', TEMPLATE_DOMAIN) ); ?></div>
</div>
<?php do_action( 'bp_after_post_content' ); ?>

</article>
<!-- POST END -->

<?php do_action( 'bp_after_blog_post' ); ?>

<?php
$get_ads_code_one = get_theme_option('ads_code_one');
$get_ads_code_two = get_theme_option('ads_code_two');
if( $get_ads_code_one == '' && $get_ads_code_two == '') { ?>
<?php } else { ?>
<?php if( 2 == $postcount ){ ?>
<div class="adsense-post">
<?php echo stripcslashes(do_shortcode($get_ads_code_one)); ?>
</div>
<?php } elseif( 4 == $postcount ){ ?>
<div class="adsense-post">
<?php echo stripcslashes(do_shortcode($get_ads_code_two)); ?>
</div>
<?php } ?>
<?php } ?>

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