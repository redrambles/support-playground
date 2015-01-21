<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

<?php do_action( 'bp_before_content' ); ?>
<!-- CONTENT START -->
<div class="content full-width">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ); ?>

<!-- POST ENTRY -->
<div id="post-entry">
<section class="post-entry-inner">

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>

<article <?php post_class('post-single page-single'); ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title entry-title"><?php the_title(); ?></h1>

<div class="post-content">
<div class="entry-content"><?php the_content( __('...Continue reading', TEMPLATE_DOMAIN) ); ?></div>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>

</div><!-- POST CONTENT END -->

</article>

<?php endwhile; ?>
<?php comments_template(); ?>
<?php else : ?>
<?php get_template_part( 'lib/templates/result' ); ?>
<?php endif; ?>

</section>
</div>
<!-- POST ENTRY END -->

<?php do_action( 'bp_after_blog_home' ); ?>

</div><!-- CONTENT INNER END -->
</div><!-- CONTENT END -->

<?php do_action( 'bp_after_content' ); ?>

<?php get_footer(); ?>