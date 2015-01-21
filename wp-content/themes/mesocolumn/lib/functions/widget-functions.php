<?php
////////////////////////////////////////////////////////////////////////////////
// Sidebar Widget
////////////////////////////////////////////////////////////////////////////////
function mesocolumn_theme_widgets_init() {
global $bp_active;

   register_sidebar(array(
    'name'=>__('Tabbed Sidebar', TEMPLATE_DOMAIN),
   	'id' => 'tabbed-sidebar',
	'description' => __( 'Sidebar Tabbed widget area', TEMPLATE_DOMAIN ),
	'before_widget' => '<div class="tabbertab"><aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
	));


    register_sidebar(array(
    'name'=>__('Right Sidebar', TEMPLATE_DOMAIN),
    'id' => 'right-sidebar',
	'description' => __( 'Right sidebar widget area', TEMPLATE_DOMAIN ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));


    if ( class_exists('woocommerce') ) {
   register_sidebar(array(
    'name'=>__('Shop Sidebar', TEMPLATE_DOMAIN),
    'id' => 'shop-sidebar',
	'description' => __( 'Widget area for WooCommerce Shop Pages', TEMPLATE_DOMAIN ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
    }


    if ( class_exists('jigoshop') ) {
   register_sidebar(array(
    'name'=>__('Shop Sidebar', TEMPLATE_DOMAIN),
    'id' => 'shop-sidebar',
	'description' => __( 'Widget area for Jigo Shop Pages', TEMPLATE_DOMAIN ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
    }

   if ( post_type_exists( 'portfolio' ) ) {
   register_sidebar(array(
    'name'=>__('Portfolio Sidebar', TEMPLATE_DOMAIN),
    'id' => 'portfolio-sidebar',
	'description' => __( 'Widget area for Portfolio Pages', TEMPLATE_DOMAIN ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
    }


   if ( class_exists( 'bbPress' ) ) {
   register_sidebar(array(
    'name'=>__('Forum Sidebar', TEMPLATE_DOMAIN),
    'id' => 'forum-sidebar',
	'description' => __( 'Widget area for BBPress Forum Pages', TEMPLATE_DOMAIN ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
    }


    if ( $bp_active == 'true' ) {
   register_sidebar(array(
    'name'=>__('BuddyPress Sidebar', TEMPLATE_DOMAIN),
    'id' => 'buddypress-sidebar',
	'description' => __( 'Widget area for BuddyPress Pages', TEMPLATE_DOMAIN ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
    }

	register_sidebar(array(
		'name'=>__('First Footer Widget Area', TEMPLATE_DOMAIN),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', TEMPLATE_DOMAIN ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar( array(
		'name' => __('Second Footer Widget Area', TEMPLATE_DOMAIN),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', TEMPLATE_DOMAIN ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __('Third Footer Widget Area', TEMPLATE_DOMAIN),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', TEMPLATE_DOMAIN ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

   	register_sidebar( array(
		'name' => __('Fourth Footer Widget Area', TEMPLATE_DOMAIN),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', TEMPLATE_DOMAIN ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'mesocolumn_theme_widgets_init' );



///////////////////////////////////////////////////////////////////////////////////
////custom most commented post widget
///////////////////////////////////////////////////////////////////////////////////
class My_THEME_Most_Commented_Widget extends WP_Widget {
function My_THEME_Most_Commented_Widget() {
//Constructor
parent::WP_Widget(false, $name = TEMPLATE_DOMAIN . ' | Most Comments', array(
'description' => __('Display your most commented posts.', TEMPLATE_DOMAIN)
));
}
function widget($args, $instance) {
// outputs the content of the widget
extract($args); // Make before_widget, etc available.
$mc_name = empty($instance['title']) ? __('Most Comments', TEMPLATE_DOMAIN) : apply_filters('widget_title', $instance['title']);

$mc_number = isset($instance['number']) ? $instance['number'] : "";
$mc_comment_count = isset($instance['commentcount']) ? $instance['commentcount'] : "";

$unique_id = $args['widget_id'];

global $wpdb, $post;
$mostcommenteds = $wpdb->get_results("SELECT $wpdb->posts.ID, post_title, post_name, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_total' FROM $wpdb->posts LEFT JOIN $wpdb->comments ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_date_gmt < '" . gmdate("Y-m-d H:i:s") . "' AND post_status = 'publish' AND post_password = '' GROUP BY $wpdb->comments.comment_post_ID ORDER  BY comment_total DESC LIMIT $mc_number");
  echo $before_widget;
  echo $before_title . $mc_name . $after_title;
  echo "<ul class='most-commented'> ";
  foreach ($mostcommenteds as $post) {
    $post_title = htmlspecialchars(stripslashes($post->post_title));
    $comment_total = (int) $post->comment_total;
    echo "<li><a href=\"" . get_permalink() . "\">$post_title</a>";
    if($mc_comment_count == 'yes') {
    echo "<span class='total-com'>&nbsp;($comment_total)</span>";
    }
    echo "</li>";
  }
  echo "</ul> ";
  echo $after_widget;
}
function update($new_instance, $old_instance) {
//update and save the widget
return $new_instance;
}
function form($instance) {
// Get the options into variables, escaping html characters on the way
$mc_name = isset($instance['title']) ? $instance['title'] : "";
$mc_number = isset($instance['number']) ? $instance['number'] : "";
$mc_comment_count = isset($instance['commentcount']) ? $instance['commentcount'] : "";
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Name for most comment(optional):', TEMPLATE_DOMAIN);?>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $mc_name;?>" /></label></p>

<p>
<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Total to show: ', TEMPLATE_DOMAIN);?>
<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" class="widefat" value="<?php echo $mc_number;?>" /></label>
</p>

<p>
<label for="<?php echo $this->get_field_id('commentcount'); ?>"><?php _e('Show comments count:', TEMPLATE_DOMAIN); ?></label>
<select id="<?php echo $this->get_field_id('commentcount'); ?>" name="<?php echo $this->get_field_name('commentcount'); ?>">
<option<?php if($mc_comment_count == 'yes') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentcount'); ?>" value="yes"><?php _e('yes', TEMPLATE_DOMAIN); ?></option>
<option<?php if($mc_comment_count == 'no') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentcount'); ?>" value="no"><?php _e('no', TEMPLATE_DOMAIN); ?></option>
</select>
</p>

<?php
}
}
register_widget('My_THEME_Most_Commented_Widget');


///////////////////////////////////////////////////////////////////////////////////
////wordpress and buddypress recent comment widget
///////////////////////////////////////////////////////////////////////////////////
class My_THEME_Recent_Comments_Widget extends WP_Widget {
function My_THEME_Recent_Comments_Widget() {
//Constructor
parent::WP_Widget(false, $name = TEMPLATE_DOMAIN . ' | Recent Comments', array(
'description' => __('Display your recent comments with user avatar.', TEMPLATE_DOMAIN)
));
}
function widget($args, $instance) {
// outputs the content of the widget
extract($args); // Make before_widget, etc available.
$rc_name = empty($instance['title']) ? __('Recent Comments', TEMPLATE_DOMAIN) : apply_filters('widget_title', $instance['title']);

$rc_number = isset($instance['number']) ? $instance['number'] : "";
$rc_avatar = isset($instance['avatar_on']) ? $instance['avatar_on'] : "";

$unique_id = $args['widget_id'];

global $wpdb;

$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,45) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC LIMIT $rc_number";

$comments = $wpdb->get_results($sql);
$pre_HTML = '';
$output = $pre_HTML;
echo $before_widget;
echo $before_title . $rc_name . $after_title;
echo "<ul class='gravatar_recent_comment'>";
foreach ($comments as $comment) {
$grav_email = $comment->comment_author_email;
$grav_name = $comment->comment_author;
$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($grav_email). "&amp;size=32";
?>
<li>
<?php if($rc_avatar == 'yes') {  ?><?php echo get_avatar( $grav_email, '32'); ?><?php } ?>

<?php if($rc_avatar == 'yes') { ?><div class="gravatar-comment-meta"><?php } ?>
<span class="author"><span class="aname"><?php echo strip_tags($comment->comment_author); ?></span> <?php _e('Says:', TEMPLATE_DOMAIN); ?></span>
<span class="comment"><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->com_excerpt); ?>...</a></span>
<?php if($rc_avatar == 'yes') { ?></div><?php } ?>

</li>
<?php
}
echo "</ul> ";
echo $after_widget;
?>
<?php }

function update($new_instance, $old_instance) {
//update and save the widget
return $new_instance;
}
function form($instance) {
// Get the options into variables, escaping html characters on the way
$rc_name = isset($instance['title']) ? $instance['title'] : "";
$rc_number = isset($instance['number']) ? $instance['number'] : "";
$rc_avatar = isset($instance['avatar_on']) ? $instance['avatar_on'] : "";
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Name for recent comment(optional):', TEMPLATE_DOMAIN); ?>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $rc_name; ?>" /></label></p>

<p>
<label for="<?php echo $this->get_field_id('avatar_on'); ?>"><?php _e('Enable avatar?:', TEMPLATE_DOMAIN); ?></label>
<select id="<?php echo $this->get_field_id('avatar_on'); ?>" name="<?php echo $this->get_field_name('avatar_on'); ?>">
<option<?php if($rc_avatar == 'yes') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('avatar_on'); ?>" value="yes"><?php _e('yes', TEMPLATE_DOMAIN); ?></option>
<option<?php if($rc_avatar == 'no') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('avatar_on'); ?>" value="no"><?php _e('no', TEMPLATE_DOMAIN); ?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Total to show:', TEMPLATE_DOMAIN); ?>
<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" class="widefat" value="<?php echo $rc_number; ?>" /></label></p>

<?php
}
}
register_widget('My_THEME_Recent_Comments_Widget');


//////////////////////////////////////////////////////////////////////////
// Multi Category Featured Posts Widget
///////////////////////////////////////////////////////////////////////////
class My_THEME_Featured_Multi_Category_Widget extends WP_Widget {
function My_THEME_Featured_Multi_Category_Widget() {
//Constructor
parent::WP_Widget(false, $name = TEMPLATE_DOMAIN . ' | Featured Categories', array(
'description' => __('Displays multi category posts with thumbnail.', TEMPLATE_DOMAIN)
));
}
function widget($args, $instance) {
global $bp_existed, $post;
// outputs the content of the widget
extract($args); // Make before_widget, etc available.

$feat_title = empty($instance['title']) ? __('Featured Categories', TEMPLATE_DOMAIN) : apply_filters('widget_title', $instance['title']);

$feat_name = isset($instance['featcatname']) ? $instance['featcatname'] : "";
$feat_thumb = isset($instance['featthumb']) ? $instance['featthumb'] : "";
$feat_thumb_size = isset($instance['featthumbsize']) ? $instance['featthumbsize'] : "";
$feat_total = isset($instance['feattotal']) ? $instance['feattotal'] : "";

$unique_id = $args['widget_id'];

echo $before_widget;

echo $before_title . $feat_title . $after_title;

echo "<ul class='recent-postcat'>";
$my_query = new WP_Query('cat='. $feat_name . '&' . 'showposts=' . $feat_total);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID;
$the_post_ids = get_the_ID();
$thepostlink = '<a href="'. get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
?>

<li class="<?php echo dez_get_has_thumb_check(); ?> <?php echo 'the-sidefeat-'.$feat_thumb_size; ?>">
<?php if($feat_thumb == 'yes') { ?>
<?php if($feat_thumb_size == '' || $feat_thumb_size == 'thumbnail'): ?>
<?php echo dez_get_featured_post_image($thepostlink,'</a>',50,50,'featpost alignleft','thumbnail', dez_get_singular_cat('false'), the_title_attribute('echo=0'), false); ?>
<?php else: ?>
<?php echo dez_get_featured_post_image('<div class="medium-thumb"><p>'.$thepostlink,'</a></p></div>',480,320,'featpost alignleft','medium', dez_get_singular_cat('false'), the_title_attribute('echo=0'), false); ?>
<?php endif; ?>
<?php } ?>
<div class="feat-post-meta">
<div class="feat-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
<small><?php echo the_time( get_option( 'date_format' ) ); ?><?php if ( comments_open() ) { ?><span class="widget-feat-comment"> - <?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span><?php } ?>
</small>
</div>
</li>
<?php endwhile; wp_reset_query(); ?>
<?php
echo "</ul>";
echo $after_widget;
// end echo result
}


function update($new_instance, $old_instance) {
//update and save the widget
return $new_instance;
}
function form($instance) {
// Get the options into variables, escaping html characters on the way
$feat_title = isset($instance['title']) ? $instance['title'] : "";
$feat_name = isset($instance['featcatname']) ? $instance['featcatname'] : "";
$feat_thumb_size = isset($instance['featthumbsize']) ? $instance['featthumbsize'] : "";
$feat_thumb = isset($instance['featthumb']) ? $instance['featthumb'] : "";
$feat_total = isset($instance['feattotal']) ? $instance['feattotal'] : "";
?>


<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title:",TEMPLATE_DOMAIN); ?> <em><?php _e("*required",TEMPLATE_DOMAIN); ?></em></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $feat_title; ?>" />
</p>

<p><label for="<?php echo $this->get_field_id('featcatname'); ?>"><?php _e("Category ID:",TEMPLATE_DOMAIN); ?><br /><em><?php _e("*separate by commas [,]",TEMPLATE_DOMAIN); ?></em> </label>
<input type="text" class="widefat" id="<?php echo $this->get_field_id('featcatname'); ?>" name="<?php echo $this->get_field_name('featcatname'); ?>" value="<?php echo $feat_name; ?>" />
</p>

<p><label for="<?php echo $this->get_field_id('featthumb'); ?>"><?php _e('Enable Thumbnails?:<br /><em>*post featured images</em>', TEMPLATE_DOMAIN); ?>    </label>
<select class="widefat" id="<?php echo $this->get_field_id('featthumb'); ?>" name="<?php echo $this->get_field_name('featthumb'); ?>">
<option<?php if($feat_thumb == 'yes') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featthumb'); ?>" value="yes"><?php _e('yes', TEMPLATE_DOMAIN); ?></option>
<option<?php if($feat_thumb== 'no') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featthumb'); ?>" value="no"><?php _e('no', TEMPLATE_DOMAIN); ?></option>
</select>
</p>

<p><label for="<?php echo $this->get_field_id('featthumbsize'); ?>"><?php _e('Thumbnails Size?:', TEMPLATE_DOMAIN); ?>    </label>
<select class="widefat" id="<?php echo $this->get_field_id('featthumbsize'); ?>" name="<?php echo $this->get_field_name('featthumbsize'); ?>">
<option<?php if($feat_thumb_size == 'thumbnail') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featthumbsize'); ?>" value="thumbnail"><?php _e('thumbnail', TEMPLATE_DOMAIN); ?></option>
<option<?php if($feat_thumb_size == 'medium') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('featthumbsize'); ?>" value="medium"><?php _e('medium', TEMPLATE_DOMAIN); ?></option>
</select>
</p>

<p><label for="<?php echo $this->get_field_id('feattotal'); ?>"><?php _e("Total:",TEMPLATE_DOMAIN); ?></label> <br />
<input class="widefat" id="<?php echo $this->get_field_id('feattotal'); ?>" name="<?php echo $this->get_field_name('feattotal'); ?>" type="text" value="<?php echo $feat_total; ?>" />
</p>

<?php
}
}
register_widget('My_THEME_Featured_Multi_Category_Widget');


function dez_theme_widget_bannerads() { get_template_part('lib/templates/advertisement'); }
wp_register_sidebar_widget( TEMPLATE_DOMAIN.'_banner_ads',ucfirst(TEMPLATE_DOMAIN).' - Banner Ads', 'dez_theme_widget_bannerads','' );

function dez_theme_widget_tabber() { get_template_part('lib/templates/tabber-widget'); }
wp_register_sidebar_widget( TEMPLATE_DOMAIN.'_tabbed',ucfirst(TEMPLATE_DOMAIN).' - Tabbed', 'dez_theme_widget_tabber','' );

function dez_theme_widget_right_sidebar_ads() {
$get_ads_right_sidebar = get_theme_option('ads_right_sidebar'); if($get_ads_right_sidebar != '')  { ?>
<aside id="ctr-ad" class="widget">
<div class="textwidget adswidget"><?php echo stripcslashes(do_shortcode($get_ads_right_sidebar)); ?></div>
</aside>
<?php }
}
wp_register_sidebar_widget( TEMPLATE_DOMAIN.'_ads_right',ucfirst(TEMPLATE_DOMAIN).' - Ads Right', 'dez_theme_widget_right_sidebar_ads','' );


///////////////////////////////////////////////////////////////////////////////////
//// Widget CSS
///////////////////////////////////////////////////////////////////////////////////
function dez_add_widget_style_admin_head() {
print "<style type='text/css' media='screen'>"; ?>
.widget-content em { font-style:normal; color: #999; font-size: 11px; line-height:auto !important;  }
<?php print "</style>";
}
function dez_add_widget_style_head() {
print "<style type='text/css' media='screen'>"; ?>
.gravatar_recent_comment li, .twitterbox li { padding:0px; font-size: 1.025em; line-height:1.5em;  }
.gravatar_recent_comment span.author { font-weight:bold; }
.gravatar_recent_comment img { width:32px; height:32px; float:left; margin: 0 10px 0 0; }
ul.recent-postcat li {position:relative;border-bottom: 1px solid #EAEAEA;padding: 0 0 0.5em !important;margin: 0 0 1em !important;}
ul.recent-postcat li:last-child,ul.item-list li:last-child,.avatar-block li:last-child  { border-bottom: none;  }
ul.recent-postcat li .feat-post-meta { margin: 0px 0 0 75px; }
ul.recent-postcat li.has_no_thumb .feat-post-meta { margin: 0px; }
ul.recent-postcat img {background: white;padding: 5px;margin:0px;border: 1px solid #DDD;}
#custom #right-sidebar ul.recent-postcat li .feat-post-meta .feat-title {margin: 0;}
#custom #right-sidebar ul.recent-postcat li .feat-post-meta .feat-title {width: 100%;font-size: 1.05em; line-height:1.35em !important;font-weight: bold;}
ul.recent-postcat li .feat-post-meta small { font-size: 0.85em; padding:0; }
.bp-searchform {margin: 0px;padding: 5%;float: left;width: 90%;background: white;border: 1px solid #DDD;}
.bp-searchform label {display:none;}
#custom div.medium-thumb {margin:0 0 0.2em;width:99%;overflow:hidden;padding:0 !important;border:0 none !important;}
#custom div.medium-thumb p {text-align:center;margin:0;width:100%;padding:0;border:0 none;height:100%;overflow:hidden;}
#custom div.medium-thumb img {float:none;border:0 none;max-width:100%;margin:0 !important;padding:0 !important;}
ul.recent-postcat li.the-sidefeat-thumbnail img {padding:3px;}
ul.recent-postcat li.the-sidefeat-thumbnail img:hover {background:none;}
ul.recent-postcat li.the-sidefeat-medium .feat-post-meta {margin: 0;}
<?php print "</style>";
}
add_action('admin_head','dez_add_widget_style_admin_head');
add_action('wp_head','dez_add_widget_style_head');


?>