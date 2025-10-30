<?php

// enqueue the child theme stylesheet
Function wp_schools_enqueue_scripts() {
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' )  );
wp_enqueue_style( 'childstyle' );
wp_register_style( 'slick', get_stylesheet_directory_uri() . '/css/slick.css', array(), filemtime( get_stylesheet_directory() . '/css/slick.css' )  );
wp_enqueue_style( 'slick' );
wp_enqueue_style( 'icon-styles', 'https://d1azc1qln24ryf.cloudfront.net/152819/Davis/style-cf.css?qm2h65' ); // Enqueue styles for svg icons
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);


// Widget Logic Conditionals (child)
function is_child($parent) {
global $post;
return $post->post_parent == $parent;
}


// Widget Logic Conditionals (ancestor)
function is_tree( $pid ) {
global $post;

if ( is_page($pid) )
return true;

$anc = get_post_ancestors( $post->ID );
foreach ( $anc as $ancestor ) {
if( is_page() && $ancestor == $pid ) {
return true;
}
}
return false;
}


	// ACF Options Pages
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Customizations',
        'menu_title'    => 'Customizations',
        'menu_slug'     => 'customizations',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-admin-site', // Add this line and replace the second inverted commas with class of the icon you like
        'redirect'      => false
    ));

}

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

// Remove specific blog categories (i.e. "Case Results") from main Blog page loop
function exclude_category($query) {
if ( $query->is_home ) {
	$query->set('cat', '-5');
}
	return $query;
}
add_filter('pre_get_posts', 'exclude_category');


// Add additional menu for Mobile
function register_my_menu() {
  register_nav_menu('mobile-nav',__( 'Mobile Navigation' ));
}
add_action( 'init', 'register_my_menu' );


// Custom iPad only mobile detection (different than usual wp_is_mobile)
function my_wp_is_mobile() {
    if (
        ! empty($_SERVER['HTTP_USER_AGENT'])

        // bail out, if iPad
        && false !== strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')
    ) return false;
    return wp_is_mobile();
}


add_action('wp_enqueue_scripts', 'my_custom_scripts');


// <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,700,800%7COpen+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300%7CSource+Sans+Pro:200,300,400%7CLato%7CYanone+Kaffeesatz:300,400,700,800%7CTeko:400,500,600,700%7CRoboto:300,400%7CFjalla+One%7CTeko:500" rel="stylesheet">


// Additional JS plugins
function my_custom_scripts() {
  wp_register_script('custom-scripts', get_stylesheet_directory_uri() . '/js/custom_scripts.js',array(), time(), true);
  wp_enqueue_script('custom-scripts', get_stylesheet_directory_uri() . '/js/custom_scripts.js',array(), time(), true);
// Smooth Scroll + Homepage Scripts + Slick


  // wp_register_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,700,800%7COpen+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300%7CSource+Sans+Pro:200,300,400%7CLato%7CYanone+Kaffeesatz:300,400,700,800%7CTeko:400,500,600,700%7CRoboto:300,400%7CFjalla+One%7CTeko:500', array(), null );
  // wp_enqueue_style('google-fonts');




  if( is_home() || is_front_page() ) {
    wp_register_script('smooth_scroll', get_stylesheet_directory_uri() . '/js/smooth-scroll.min.js',array('jquery'), null, true);
    wp_enqueue_script('smooth_scroll', get_stylesheet_directory_uri() . '/js/smooth-scroll.min.js');
    wp_register_script('smooth_scroll_settings', get_stylesheet_directory_uri() . '/js/smooth-scroll-settings.js',array('jquery'), null, true);
    wp_enqueue_script('smooth_scroll_settings', get_stylesheet_directory_uri() . '/js/smooth-scroll-settings.js');
    wp_register_script('lazyScroller', get_stylesheet_directory_uri() . '/js/jquery.lazy.min.js',array('jquery'),null,true);
    wp_enqueue_script('lazyScroller');
    wp_register_script('lazyScroller2', get_stylesheet_directory_uri() . '/js/jquery.lazy.plugins.min.js',array('jquery'),null,true);
    wp_enqueue_script('lazyScroller2');
    wp_register_script('lazyScroller3', get_stylesheet_directory_uri() . '/js/lazy_settings.js',array('jquery'),null,true);
    wp_enqueue_script('lazyScroller3');
    wp_register_script('slick-js', get_stylesheet_directory_uri() . '/js/slick.min.js',array('jquery'),null,true);
    wp_enqueue_script('slick-js');
    wp_register_script('slick-custom', get_stylesheet_directory_uri() . '/js/slick-custom.js',array('jquery'),null,true);
    wp_enqueue_script('slick-custom');
    wp_register_style('slick-css', get_stylesheet_directory_uri() . '/css/slick.css', null, null, 'all' );
    wp_enqueue_script('slick-css');
    wp_register_script('lazysizes', get_stylesheet_directory_uri() . '/js/lazysizes.min.js', null, null, 'all' );
    wp_enqueue_script('lazysizes');
  }
  if(is_page(60)){
  	wp_register_script('lazyScroller', get_stylesheet_directory_uri() . '/js/jquery.lazy.min.js',array('jquery'),null,true);
    wp_enqueue_script('lazyScroller');
    wp_register_script('lazyScroller2', get_stylesheet_directory_uri() . '/js/jquery.lazy.plugins.min.js',array('jquery'),null,true);
    wp_enqueue_script('lazyScroller2');
    wp_register_script('lazyScroller3', get_stylesheet_directory_uri() . '/js/lazy_settings.js',array('jquery'),null,true);
    wp_enqueue_script('lazyScroller3');
  }

  // Google reCaptcha
  // wp_register_script('recaptcha', 'https://www.google.com/recaptcha/api.js',array(),false);
  // wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js',array(),false);
}

// Add shortcode to dynamically update year
function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');


// User role edits
add_filter( 'user_has_cap',
function( $caps ) {
    if ( ! empty( $caps['edit_pages'] ) )
        $caps['manage_options'] = true;
    return $caps;
} );


// Pagespeed
function qode_styles_child() {
wp_deregister_style('style_dynamic');
wp_register_style('style_dynamic', get_stylesheet_directory_uri() . '/css/style_dynamic.css');
wp_enqueue_style('style_dynamic');
wp_deregister_style('style_dynamic_responsive');
wp_register_style('style_dynamic_responsive', get_stylesheet_directory_uri() . '/css/style_dynamic_responsive.css');
wp_enqueue_style('style_dynamic_responsive');
 wp_deregister_style('custom_css');
    wp_register_style('custom_css', get_stylesheet_directory_uri() . '/css/custom_css.css');
    wp_enqueue_style('custom_css');
}
function qode_scripts_child() {
// wp_deregister_script('default_dynamic');
// wp_register_script('default_dynamic', get_stylesheet_directory_uri() . '/js/default_dynamic.js');
// wp_enqueue_style('default_dynamic', array(),false,true);
wp_deregister_script('custom_js');
    wp_register_script('custom_js', get_stylesheet_directory_uri() . '/js/custom_js.js');
    wp_enqueue_style('custom_js', array(),false,true);
}
add_action( 'wp_enqueue_scripts', 'qode_styles_child', 11);
add_action( 'wp_enqueue_scripts', 'qode_scripts_child', 11);

// Remove WordPress auto trash delete of pages
function wpb_remove_schedule_delete() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}
add_action( 'init', 'wpb_remove_schedule_delete' );

// Contact Form 7 Submission Page Redirect
add_action( 'wp_footer', 'mycustom_wp_footer' );

function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = '/form-success/';
}, false );
</script>
<?php
}

 /* Add webp extension if supported by browser. Used in conjunction with imagify */
 function checkWebpCompatibility($image_url) {
  $user_agent = $_SERVER['HTTP_USER_AGENT'];
  $browser = "Other";
  
  if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) $browser = 'Opera';
  elseif (strpos($user_agent, 'Edge')) $browser = 'Edge';
  elseif (strpos($user_agent, 'Chrome')) $browser = 'Chrome';
  elseif (strpos($user_agent, 'Safari')) $browser = 'Safari';
  elseif (strpos($user_agent, 'Firefox')) $browser = 'Firefox';
  elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) $browser = 'Internet Explorer';
      
  
  if( $browser == 'Internet Explorer' || $browser == 'Other') {
      return $image_url;
  } else {
      return $image_url . '.webp';
  }
}

function retrieve_latest_gform_submissions() {
    $site_url = get_site_url();
    $search_criteria = [
        'status' => 'active'
    ];
    $form_ids = 1; //search all forms
    $sorting = [
        'key' => 'date_created',
        'direction' => 'DESC'
    ];
    $paging = [
        'offset' => 0,
        'page_size' => 5
    ];
    
    $submissions = GFAPI::get_entries($form_ids, null, $sorting, $paging);
    $start_date = date('Y-m-d H:i:s', strtotime('-5 day'));
    $end_date = date('Y-m-d H:i:s');
    $entry_in_last_5_days = false;
    
    foreach ($submissions as $submission) {
        if( $submission['date_created'] > $start_date  && $submission['date_created'] <= $end_date ) {
            $entry_in_last_5_days = true;
        } 
    }
    if( !$entry_in_last_5_days ) {
        wp_mail('webdev@postali.com', 'Submission Status', "No submissions in last 5 days on $site_url");
    }
}
add_action('check_form_entries', 'retrieve_latest_gform_submissions');