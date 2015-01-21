<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php echo dez_get_featured_post_image('','',120, 120, 'alignleft', 'thumbnail',dez_get_singular_cat('false'),the_title_attribute('echo=0'), false); ?>
</a>

<div class="feat-right">
<h2 class="entry-title feat-title"><a rel="bookmark" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h2>

<div class="feat-meta">
<span class="feat_author vcard"><?php the_author_posts_link(); ?></span>
<span class="feat_time entry-date"><abbr class="published" title="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo the_time( get_option( 'date_format' ) ); ?></abbr></span>
<span class="feat_comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span>
</div>
<?php $getmodtime = get_the_modified_time(); if( !$getmodtime ) {$modtime = '<span class="date updated meta-no-display">'. get_the_time('c') . '</span>';} else {$modtime = '<span class="date updated meta-no-display">'. get_the_modified_time('c') . '</span>';} echo $modtime; ?>

<?php
$archive_excerpt = get_theme_option('post_custom_excerpt');
if($archive_excerpt != '0' || $archive_excerpt != '') { ?><div class="entry-content feat-content"><?php echo dez_get_custom_the_excerpt(15); ?></div>
<?php } ?>
</div>