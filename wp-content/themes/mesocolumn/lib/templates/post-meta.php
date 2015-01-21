<div class="post-meta the-icons pmeta-alt<?php if( is_page() ) { echo ' meta-no-display'; } ?>">
<span class="post-author vcard"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php
$getmodtime = get_the_modified_time(); if( !$getmodtime ) {
$modtime = '<span class="date updated meta-no-display">'. get_the_time('c') . '</span>';
} else {
$modtime = '<span class="date updated meta-no-display">'. get_the_modified_time('c') . '</span>';
}
?>
<span class="entry-date"><i class="fa fa-clock-o"></i><abbr class="published" title="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo the_time( get_option( 'date_format' ) ); ?></abbr></span>
<span class="meta-no-display"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo the_title_attribute(); ?></a></span><?php echo $modtime; ?>


<?php if(get_post_type() != 'post' && get_post_type() != 'page'): ?>
<?php else: ?>
<?php if( is_tax() ) { ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo the_taxonomies('before=<span class="post-category"><i class="fa fa-file"></i>&after=</span>'); ?>
<?php } else { ?>
<?php if( get_post_type() != 'page') { ?>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="post-category"><i class="fa fa-file"></i><?php if( is_singular() ) { echo the_category(', '); } else { echo dez_get_singular_cat(); } ?></span>
<?php } ?>
<?php } ?>
<?php endif; ?>
<?php if ( comments_open() ) { ?>
<?php if( !is_tax() ) { ?>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="post-comment"><i class="fa fa-comment"></i><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span>
<?php } ?>
<?php } ?>
</div>