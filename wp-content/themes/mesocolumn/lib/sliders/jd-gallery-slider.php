<?php
$featured_on = get_theme_option('slider_on');
$featured_category = get_theme_option('feat_cat');
$featured_number = get_theme_option('feat_cat_count');
$featured_post = get_theme_option('feat_post');
?>

<?php if($featured_on == 'Enable'): ?>
<?php if(!$featured_category && !$featured_post): ?>
<?php else: ?>
<?php if($featured_category): ?>

<!-- GALLERY SLIDER START -->
<div id="featuredbox">
<div id="featured">
<div id="Gallerybox">
<div id="myGallery">
<?php
$query = new WP_Query( "cat=$featured_category&posts_per_page=$featured_number&orderby=date" );
while ( $query->have_posts() ) : $query->the_post(); ?>
<div class="imageElement post-<?php the_ID(); ?>">

<?php
$the_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "featured-slider-img" );
$thumbnail_src = $the_thumbnail_src[0];
$check_thumb = strpos($thumbnail_src, '640x480');
if( $check_thumb  ):
echo dez_get_featured_slider_image("", "", 640, 480, "alignleft full", "featured-slider-img", dez_get_singular_cat('false') ,the_title_attribute('echo=0'), true);
else:
echo dez_get_featured_slider_image("", "", 640, 480, "alignleft full", "full", dez_get_singular_cat('false')  ,the_title_attribute('echo=0'), true);
endif;
?>

<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a></h3>
<p><?php echo dez_get_custom_the_excerpt(30); ?></p>
<a href="<?php the_permalink(); ?>" title="<?php _e('Continue reading ', TEMPLATE_DOMAIN); ?><?php echo the_title_attribute(); ?>" class="open"></a>
</div>
<?php endwhile; wp_reset_query(); ?>
</div><!-- MYGALLERY END -->
</div><!-- GALLERBOX END -->
</div><!-- FEATURED END -->
</div>
<!-- GALLERY SLIDER END -->


<?php elseif($featured_post && !$featured_category): ?>

<!-- GALLERY SLIDER START -->
<div id="featuredbox">
<div id="featured">
<div id="Gallerybox">
<div id="myGallery">
<?php
query_posts( array( 'post__in' => explode(',', $featured_post), 'post_type'=> array('post', 'page', 'product', 'portfolio'), 'posts_per_page' => 100, 'ignore_sticky_posts' => 1, 'orderby' => 'date', 'order' => 'DESC' ) );
while ( have_posts() ) : the_post();
$post_regular_price = get_post_meta($post->ID,'_regular_price', true);
if( function_exists('get_woocommerce_currency_symbol') ){
$woo_cur_symbol = get_woocommerce_currency_symbol();
}
?>
<div class="imageElement post-<?php the_ID(); ?>">

<?php
$the_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "featured-slider-img" );
$thumbnail_src = $the_thumbnail_src[0];
$check_thumb = strpos($thumbnail_src, '640x480');
if( $check_thumb  ):
echo dez_get_featured_slider_image("", "", 640, 480, "alignleft full", "featured-slider-img", dez_get_singular_cat('false') ,the_title_attribute('echo=0'), true);
else:
echo dez_get_featured_slider_image("", "", 640, 480, "alignleft full", "full", dez_get_singular_cat('false')  ,the_title_attribute('echo=0'), true);
endif;
?>

<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a><?php if($post_regular_price) { ?><?php echo '<span class="pricebox">'. $woo_cur_symbol . $post_regular_price . '</span>'; ?><?php } ?></h3>
<p><?php echo dez_get_custom_the_excerpt(30); ?></p>
<a href="<?php the_permalink(); ?>" title="<?php _e('Continue reading ', TEMPLATE_DOMAIN); ?><?php echo the_title_attribute(); ?>" class="open"></a>
</div>
<?php endwhile; wp_reset_query(); ?>
</div><!-- MYGALLERY END -->
</div><!-- GALLERBOX END -->
</div><!-- FEATURED END -->
</div>
<!-- GALLERY SLIDER END -->

<?php endif; ?>

<?php endif; ?>

<?php endif; ?>