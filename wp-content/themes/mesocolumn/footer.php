</div><!-- CONTAINER WRAP END -->
<?php do_action( 'bp_after_container_wrap' ); ?>

</section><!-- CONTAINER END -->
<?php do_action( 'bp_after_container' ); ?>

</div><!-- BODYCONTENT END -->
<?php do_action( 'bp_after_bodycontent' ); ?>

</div><!-- INNERWRAP BODYWRAP END -->
<?php do_action( 'bp_after_bodywrap' ); ?>

</div><!-- WRAPPER MAIN END -->
<?php do_action( 'bp_after_wrapper_main' ); ?>

</div><!-- WRAPPER END -->
<?php do_action( 'bp_after_wrapper' ); ?>


<?php do_action( 'bp_before_footer_top' ) ?>

<?php if ( is_active_sidebar( 'first-footer-widget-area' ) || is_active_sidebar( 'second-footer-widget-area' ) || is_active_sidebar( 'third-footer-widget-area' ) || is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>

<footer class="footer-top">
<div class="innerwrap">
<div class="ftop">

<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
<div class="footer-container-wrap">
<div class="fbox">
<div class="widget-area the-icons">
<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
<div class="fbox wider-cat">
<div class="widget-area the-icons">
<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
<div class="fbox">
<div class="widget-area the-icons">
<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
<div class="fbox">
<div class="widget-area the-icons">
<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
</div>
</div>
<?php endif; ?>

</div>
</div>
</div>

</footer><!-- FOOTER TOP END -->
<?php endif; ?>

<?php do_action( 'bp_after_footer_top' ); ?>

<?php do_action( 'bp_before_footer_bottom' ); ?>

<footer class="footer-bottom">
<div class="innerwrap">
<div class="fbottom">
<div class="footer-left">
<?php _e('Copyright &copy;', TEMPLATE_DOMAIN); ?> <?php echo gmdate(__('Y', TEMPLATE_DOMAIN)); ?>. <?php bloginfo('name');?>
<?php do_action( 'bp_footer_left' ); ?>
</div><!-- FOOTER LEFT END -->

<div class="footer-right">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
	<?php wp_nav_menu( array(
	'theme_location' => 'footer',
	'container' => false,
	'depth' => 1,
	'fallback_cb' => 'none'
	)); ?>
<?php } ?>

<?php if( has_nav_menu('footer') ) { echo '<br />'; } ?>
<?php if( get_theme_option('footer_credit') != 'Disable'): ?>

<?php //only allow author credit link in homepage and not sitewide
$paged = get_query_var( 'paged' );
if( (is_home() || is_front_page()) && !$paged ){
$author_link = '<a target="_blank" href="http://www.dezzain.com/wordpress-themes/mesocolumn/">Mesocolumn</a>';
} else {
$author_link = 'Mesocolumn';
}
printf( __( '%s Theme by Dezzain', TEMPLATE_DOMAIN ), $author_link );
?>

<?php endif; ?>

<?php do_action( 'bp_footer_right' ); ?>
</div>
</div>
<!-- FOOTER RIGHT END -->

</div>
</footer><!-- FOOTER BOTTOM END -->

<?php do_action( 'bp_after_footer_bottom' ); ?>

</div><!-- SECBODY END -->

<?php $footer_code = get_theme_option('footer_code'); echo stripcslashes(do_shortcode($footer_code)); ?>

<?php wp_footer(); ?>

</body>

</html>