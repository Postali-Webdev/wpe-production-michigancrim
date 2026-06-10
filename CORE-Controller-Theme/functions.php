<?php
/**
 * Theme functions.
 *
 * @package Postali Child
 * @author Postali LLC
 */
	require_once dirname( __FILE__ ) . '/includes/admin.php';
	require_once dirname( __FILE__ ) . '/includes/utility.php';
    if(get_field('include_results','options') == 'yes') {
	    require_once dirname( __FILE__ ) . '/includes/case-results-cpt.php'; // Custom Post Type Case Results
    };
    if(get_field('include_testiimonials','options') == 'yes') {
	    require_once dirname( __FILE__ ) . '/includes/testimonials-cpt.php'; // Custom Post Type Testimonials
    }
    if(get_field('include_attorneys','options') == 'yes') {
	    require_once dirname( __FILE__ ) . '/includes/attorneys-cpt.php'; // Custom Post Type Testimonials
    }

	add_theme_support( 'post-thumbnails' );

	add_action('wp_enqueue_scripts', 'postali_parent_scripts');
	function postali_parent_scripts() {

		wp_enqueue_style( 'parent-stylesheet', get_template_directory_uri() . '/style.css' ); // Enqueue Parent theme style sheet (theme info)
		wp_enqueue_style( 'parent-styles', get_template_directory_uri() . '/assets/css/styles.css'); // Enqueue Parent theme styles.css
		
		wp_register_style( 'icomoon', 'https://cdn.icomoon.io/152819/DavisCriminal-New/style.css?vhcdpp', array() );
		wp_enqueue_style('icomoon');

		// Compiled .js using Grunt.js
		wp_register_script('custom-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js',array('jquery'), null, true); 
		wp_enqueue_script('custom-scripts');
        wp_register_script('search-scripts', get_template_directory_uri() . '/assets/js/search.min.js',array('jquery'), null, true); 
		wp_enqueue_script('search-scripts');

        //slick
        wp_register_script('slick-scripts', get_template_directory_uri() . '/assets/js/slick.min.js',array('jquery'), null, true); 
        wp_enqueue_script('slick-scripts');
        wp_register_script('slick-custom', get_template_directory_uri() . '/assets/js/slick-custom.min.js',array('jquery'), null, true); 
        wp_enqueue_script('slick-custom');
        wp_enqueue_style( 'slick-styles', get_template_directory_uri() . '/assets/css/slick.css'); // Enqueue Parent theme styles.css

        //aria menus
        wp_enqueue_script( 'textdomain-wai-aria', get_template_directory_uri() . '/assets/js/src/wai-aria.js', array( 'jquery' ), null );

		if ( is_page_template( 'front-page.php' ) ) {

            // Home Page Javascript
            wp_register_script('scrollCue', get_stylesheet_directory_uri() . '/assets/js/scrollCue.min.js', array('jquery'));
            wp_enqueue_script('scrollCue');	
            wp_register_style( 'scrollCue', get_stylesheet_directory_uri() . '/assets/css/scrollCue.css', array() );
		    wp_enqueue_style('scrollCue');	
            wp_register_script('home-scripts', get_template_directory_uri() . '/assets/js/home.min.js',array('jquery'), null, true); 
            wp_enqueue_script('home-scripts');
		}

        if ( is_page_template( 'page-pa-navigational.php' ) ) {

            wp_register_script('smooth-scroll', get_stylesheet_directory_uri() . '/assets/js/smooth-scroll.min.js', array('jquery'));
            wp_enqueue_script('smooth-scroll');	
            wp_register_script('smooth-scroll-custom', get_stylesheet_directory_uri() . '/assets/js/smooth-scroll-custom.min.js', array('jquery'));
            wp_enqueue_script('smooth-scroll-custom');	
		}
	}

	// Register Site Navigations
	function postali_parent_register_nav_menus() {
		register_nav_menus(
			array(
				'header-nav' => __( 'Header Navigation', 'postali' ),
				'footer-nav' => __( 'Footer Navigation', 'postali' ),
                'footer-practice-areas' => __( 'Footer Practice Areas', 'postali' ),
                'practice-areas-nav' => __( 'Pratice Areas Navigation', 'postali' ),
			)
		);
	}
	add_action( 'init', 'postali_parent_register_nav_menus' );

	// Add Custom Logo Support
	add_theme_support( 'custom-logo' );

	function postali_custom_logo_setup() {
		$defaults = array(
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		);
		add_theme_support( 'custom-logo', $defaults );
	}
	add_action( 'after_setup_theme', 'postali_custom_logo_setup' );

	// ACF Options Pages
	if( function_exists('acf_add_options_page') ) {
		
		acf_add_options_page(array(
			'page_title'    => 'Instructions',
			'menu_title'    => 'Instructions',
			'menu_slug'     => 'theme-instructions',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-smiley', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

		acf_add_options_page(array(
			'page_title'    => 'Site Customizations',
			'menu_title'    => 'Site Customizations',
			'menu_slug'     => 'site-customizations',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-admin-customizer', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

	}

	// Save newly created fields to child theme
	add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
	function my_acf_json_save_point( $path ) {
		
		// update path
		$path = get_stylesheet_directory() . '/acf-json';
		
		// return
		return $path;
	
	}
	
	// Add ability to add SVG to Wordpress Media Library
	function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');
	
	//add SVG to allowed file uploads
	function add_file_types_to_uploads($file_types){

		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes );

		return $file_types;
	}
	add_action('upload_mimes', 'add_file_types_to_uploads');

    //enable upload for webp image files.
    function webp_upload_mimes($existing_mimes) {
        $existing_mimes['webp'] = 'image/webp';
        return $existing_mimes;
    }
    add_filter('mime_types', 'webp_upload_mimes');

    //enable preview / thumbnail for webp image files.
    function webp_is_displayable($result, $path) {
        if ($result === false) {
            $displayable_image_types = array( IMAGETYPE_WEBP );
            $info = @getimagesize( $path );
            if (empty($info)) {
                $result = false;
            } elseif (!in_array($info[2], $displayable_image_types)) {
                $result = false;
            } else {
                $result = true;
            }
        }
        return $result;
    }
    add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

    // Add category metabox to page
    function share_categories() {
        register_taxonomy_for_object_type('category', 'page');
    }
    add_action( 'init', 'share_categories' );

	// Widget Logic Conditionals
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

	// Get location phone number if inside location tree
	function get_location_phone() {
		$locations = get_field('locations', 'options');
		if ( $locations ) {
			// First, check if we're inside a specific location tree
			foreach ( $locations as $location ) {
				$location_page = $location['location_page'];
				if ( $location_page && is_tree( $location_page->ID ) ) {
					return $location['local_phone_number'];
				}
			}
			// If not in any tree, return the default location's phone
			foreach ( $locations as $location ) {
				if ( $location['make_default_location'] ) {
					return $location['local_phone_number'];
				}
			}
		}
		return false; // No locations or no default set
	}

	// Display Current Year as shortcode - [year]
	function year_shortcode () {
		$year = date_i18n ('Y');
		return $year;
		}
	add_shortcode ('year', 'year_shortcode');
	
	// WP Backend Menu area taller
	add_action('admin_head', 'taller_menus');

	function taller_menus() {
	echo '<style>
		.posttypediv div.tabs-panel {
			max-height:500px !important;
		}
	</style>';
	}

	// Customize the logo on the wp-login.php page
	function my_login_logo() { ?>
		<style type="text/css">
			#login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png);
			height:45px;
			width:204px;
			background-size: 204px 45px;
			background-repeat: no-repeat;
			padding-bottom: 30px;
			}
		</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );
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

	// Add Search Bar to Top Nav
	function mainmenu_navsearch($items, $args) {
		if ($args->theme_location == 'header-nav') {
			ob_start();
			?>

			<li class="menu-item menu-item-search search-holder">
				<form class="navbar-form-search" role="search" method="get" action="/">
					<div class="search-form-container hdn" id="search-input-container">
						<div class="search-input-group">
							<div class="form-group">
                                <input type="text" name="s" placeholder="Search for..." id="search-input-5cab7fd94d469" value="" class="form-control">
                                <label for="s">search for... </label>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-search" id="search-button"><span class="icon-search-icon" aria-hidden="true"></span></button>
				</form>	
			</li>

            <li class="menu-item mobile-nav-item">
				<a href="tel:<?php echo $GLOBALS['phone']; ?>" class="btn">Call Us Now - <?php echo $GLOBALS['phone']; ?></a>
			</li>

			<?php
			$new_items = ob_get_clean();

			$items .= $new_items;
		}
		return $items;
	}
	add_filter('wp_nav_menu_items', 'mainmenu_navsearch', 10, 2);

	// Add template column to page list in wp-admin
	function page_column_views( $defaults ) {
		$defaults['page-layout'] = __('Template');
		return $defaults;
	}
	add_filter( 'manage_pages_columns', 'page_column_views' );

	function page_custom_column_views( $column_name, $id ) {
		if ( $column_name === 'page-layout' ) {
			$set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
			if ( $set_template == 'default' ) {
				echo 'Default';
			}
			$templates = get_page_templates();
			ksort( $templates );
			foreach ( array_keys( $templates ) as $template ) :
				if ( $set_template == $templates[$template] ) echo $template;
			endforeach;
		}
	}
	add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );

    // debug logging function
    if (!function_exists('write_log')) {
        function write_log($log) {
            if (true === WP_DEBUG) {
                if (is_array($log) || is_object($log)) {
                    error_log(print_r($log, true));
                } else {
                    error_log($log);
                }
            }
        }
    }


// Gravity Forms - Check for form submissions in last 5 days - send email if none found
function retrieve_latest_gform_submissions() {
	$site_url = get_site_url();
	$search_criteria = [
		'status' => 'active'
	];
	$form_ids = 1; // Replace with primary contact form ID
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


// Pre-populate the "Custom Sidebar Menu" repeater (field_6a1de1bc4245d) in the
// page editor with all pages nested under the current page's parent (i.e. the
// current page and its siblings). Only fills the repeater when it's empty, so
// manual edits are never overwritten once saved.
function prepopulate_sidebar_menu_with_children( $value, $post_id, $field ) {

	// Only pre-fill inside the admin editor; the front end uses saved values.
	if ( ! is_admin() ) {
		return $value;
	}

	// Leave existing/manually-entered rows untouched.
	if ( ! empty( $value ) ) {
		return $value;
	}

	// Make sure we have a real page to work from.
	$current_id = (int) $post_id;
	if ( ! $current_id || get_post_type( $current_id ) !== 'page' ) {
		return $value;
	}

	// Look under the current page's parent, so we gather all sibling pages.
	$parent_id = (int) get_post_field( 'post_parent', $current_id );
	if ( ! $parent_id ) {
		return $value;
	}

	// All pages nested directly under that parent, ordered as they appear in Pages.
	$children = get_pages( array(
		'parent'      => $parent_id,
		'sort_column' => 'menu_order,post_title',
		'sort_order'  => 'ASC',
		'post_status' => 'publish',
	) );

	if ( empty( $children ) ) {
		return $value;
	}

	$rows = array();
	foreach ( $children as $child ) {
		// Each repeater row is keyed by the Link sub-field key (field_6a1de1dc4245e).
		$rows[] = array(
			'field_6a1de1dc4245e' => array(
				'title'  => get_the_title( $child->ID ),
				'url'    => get_permalink( $child->ID ),
				'target' => '',
			),
		);
	}

	return $rows;
}
add_filter( 'acf/load_value/key=field_6a1de1bc4245d', 'prepopulate_sidebar_menu_with_children', 10, 3 );



?>
