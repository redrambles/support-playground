<?php get_header(); ?>

<?php do_action( 'bp_before_content' ); ?>
<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ); ?>

<!-- POST ENTRY END -->
<div id="post-entry">
<section class="post-entry-inner">

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>

<!-- POST START -->
<article <?php post_class('post-single page-single'); ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title entry-title"><?php the_title(); ?></h1>
<?php get_template_part( 'lib/templates/post-meta' ); ?>

<?php do_action( 'bp_before_page_content' ); ?>
<div class="post-content">
<div class="entry-content"><?php the_content( __('...more &raquo;',TEMPLATE_DOMAIN) ); ?></div>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
</div>
<?php do_action( 'bp_after_page_content' ); ?>

</article>
<!-- POST END -->

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

<?php get_sidebar(); ?>

<?php get_footer(); ?>