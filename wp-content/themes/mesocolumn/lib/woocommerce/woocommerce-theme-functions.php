<?php

///////////////////////////////////////////////////////////////////////////////
// woocommerce - conditional to check if woocommerce related page showed
///////////////////////////////////////////////////////////////////////////////
if( !function_exists('is_in_woocommerce_page')):
function is_in_woocommerce_page() {
return ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() ) ? true : false;
}
endif;


///////////////////////////////////////////////////////////////////////////////
// woocommerce - Change number or products per row to 4
///////////////////////////////////////////////////////////////////////////////
if (!function_exists('dez_woo_loop_columns')) {
function dez_woo_loop_columns() {
return 4;
}
}

///////////////////////////////////////////////////////////////////////////////
// woocommerce - add before and after container class
///////////////////////////////////////////////////////////////////////////////
if (!function_exists('woocommerce_theme_before_content')) {
function woocommerce_theme_before_content() { ?>
<!-- #content Starts -->
<div id="content">
<!-- .woo-content Starts -->
<div id="woo-container" class="woo-content">
<?php
}
}

if (!function_exists('woocommerce_theme_after_content')) {
function woocommerce_theme_after_content() { ?>
</div><!-- end .woo-content -->
</div><!-- end #content -->
<?php
}
}


function woocommerce_show_custom_ads_top() {}
function woocommerce_show_custom_ads_bottom() {}
add_action( 'woocommerce_before_shop_loop', 'woocommerce_show_custom_ads_top', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_show_custom_ads_bottom', 20 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_show_custom_ads_bottom', 5 );



///////////////////////////////////////////////////////////////////////////////
// woocommerce - paging and search fucntion tweak
///////////////////////////////////////////////////////////////////////////////
function woocommerceframework_add_search_fragment ( $settings ) {
	$settings['add_fragment'] = '&post_type=product';
	return $settings;
} // End woocommerceframework_add_search_fragment()

function woocommerceframework_woo_pagination_defaults ( $settings ) {
	$settings['use_search_permastruct'] = false;
	return $settings;
} // End woocommerceframework_woo_pagination_defaults()


function woocommerceframework_pagination() {
if ( is_search() && is_post_type_archive() ) {
add_filter( 'woo_pagination_args', 'woocommerceframework_add_search_fragment', 10 );
add_filter( 'woo_pagination_args_defaults', 'woocommerceframework_woo_pagination_defaults', 10 );
}
if( function_exists('dez_custom_woo_pagination') ) { dez_custom_woo_pagination(); }
}


///////////////////////////////////////////////////////////////////////////////
// woocommerce - add sharing box
///////////////////////////////////////////////////////////////////////////////
function dez_woo_sharebox() {}
add_action('woocommerce_share', 'dez_woo_sharebox', 20 );

///////////////////////////////////////////////////////////////////////////////
// woocommerce - allow shortcode in excerpt
///////////////////////////////////////////////////////////////////////////////
if (!function_exists('woocommerce_my_custom_excerpt')) {
function woocommerce_my_custom_excerpt( $post ) {
global $post;
echo '<div class="post-content">';
if ($post->post_excerpt) {
echo do_shortcode(wpautop(wptexturize($post->post_excerpt)));
} else {
echo wpautop( wptexturize( dez_get_custom_the_excerpt(30) ) );
}
echo '</div>';
}
}

///////////////////////////////////////////////////////////////////////////////
// woocommerce - allow thumbnail wrapper
///////////////////////////////////////////////////////////////////////////////

/**
 * WooCommerce Loop Product Thumbs
 **/

if ( !function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
function woocommerce_template_loop_product_thumbnail() {
echo woocommerce_get_product_thumbnail();
}
}

/**
 * WooCommerce Product Thumbnail
 **/
if ( !function_exists( 'woocommerce_get_product_thumbnail' ) ) {
function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
global $post, $woocommerce;
if ( ! $placeholder_width )
$placeholder_width = $woocommerce->get_image_size( 'shop_catalog_image_width' );
if ( ! $placeholder_height )
$placeholder_height = $woocommerce->get_image_size( 'shop_catalog_image_height' );
$output = '<div class="product-thumb">';
if ( has_post_thumbnail() ) {
$output .= get_the_post_thumbnail( $post->ID, $size );
} else {
$output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
}
$output .= '</div>';
return $output;
}
}


function add_post_right_div_start() {
global $post;
 $terms = get_the_terms( $post->ID, 'product_cat' );
 foreach ($terms as $term) {
    $product_cat_id = $term->term_id;
    break;
}
 echo '<div class="post-product-right product_'. $product_cat_id . '">';
 echo '<h1 class="product-post post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
 do_action('woocommerce_inside_product_right');
}
function add_post_right_div_end() {
 echo '</div>';
}


///////////////////////////////////////////////////////////////////////////////
// woocommerce - add head css
///////////////////////////////////////////////////////////////////////////////
function woo_wp_custom_css() {
if( function_exists('is_in_woocommerce_page') && is_in_woocommerce_page() ) { ?>
<?php print "<style type='text/css' media='all'>"; ?>
<?php if( is_cart() || is_checkout() ): ?>
div#woo-wrapper .content {width:95%;margin: 0;clear:both;}
div#woo-wrapper #post-entry article .post-content {float: none !important;padding:0;}
div#woo-wrapper article.page {border: 0 none !important;margin:0 !important;padding:0 !important;}
h3#order_review_heading { margin-top: 3em; }
.sidebar, footer.footer-top { display: none !important; }
<?php endif; ?>
#woo-container h2 {font-size:1.25em;margin: 1em 0; }
.woocommerce-page #content {float: left;width: 69%;padding: 0 !important;background: transparent none;border: 0 none;margin: 1em 0 2em !important;box-shadow: 0 0 0 0 transparent;-moz-box-shadow: 0 0 0 0 transparent;-webkit-box-shadow: 0 0 0 0 transparent;}
#custom .shop-sidebar {padding:3em 0 0;}

<?php if( get_theme_option('custom_shop') == 'Enable' ) {
} else { ?>
.woocommerce .related ul.products li.product, .woocommerce-page .related ul.products li.product, .woocommerce .upsells.products ul.products li.product, .woocommerce-page .upsells.products ul.products li.product, .woocommerce .related ul li.product, .woocommerce-page .related ul li.product, .woocommerce .upsells.products ul li.product, .woocommerce-page .upsells.products ul li.product { clear:none;width:20%;height:350px;float:left;margin:0 20px 20px 0; }
<?php } ?>
<?php print "</style>"; ?>
<?php }
}
add_action('wp_head', 'woo_wp_custom_css', 20);


//remove default open and close wrapper for woocommerce
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
//add new open and close wrapper for woocommerce
add_action('woocommerce_before_main_content', 'woocommerce_theme_before_content', 10);
add_action('woocommerce_after_main_content', 'woocommerce_theme_after_content', 20);



if( get_theme_option('custom_shop') == 'Enable' ) {
remove_action('wp_head', 'woo_wp_custom_css', 10);
// Remove add to cart button on archives
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Remove sale flash on archives
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

update_option( 'woocommerce_show_subcategories', 'no' );
update_option( 'woocommerce_shop_show_subcategories', 'no' );

// Remove pagination (we're using the WooFramework default pagination)
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );

//remove star rating near title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action('woocommerce_inside_product_right', 'woocommerce_template_loop_rating',1);

add_action( 'woocommerce_pagination', 'woocommerceframework_pagination', 10 );
add_action('woocommerce_inside_product_right', 'woocommerce_my_custom_excerpt',12);

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_action( 'woocommerce_inside_product_right', 'woocommerce_template_loop_price', 10);

add_action('woocommerce_after_shop_loop_item','add_post_right_div_start',0);
add_action('woocommerce_after_shop_loop_item','add_post_right_div_end',99);

}

?>