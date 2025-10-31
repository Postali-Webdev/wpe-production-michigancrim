<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $qode_options_passage;
global $wp_query;
?>
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.defer=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-N96GKF');</script>
    <!-- End Google Tag Manager -->


	<?php
		if(is_tree('1652')) { //flint
			echo '<script type="application/ld+json">' . get_field('flint_schema','options') . '</script>';
		} elseif(is_tree('865')) { //port huron
			echo '<script type="application/ld+json">' . get_field('port_huron_schema','options') . '</script>';
		} elseif(is_tree('2045')) { //southfield
			echo '<script type="application/ld+json">' . get_field('southfield_schema','options') . '</script>';
		} else { //detroit
			echo '<script type="application/ld+json">' . get_field('detroit_schema','options') . '</script>';
		}
	?>

	<?php 
	// Single Page Schema
	$local_schema = get_field('local_schema');
	if ( !empty($local_schema) ) :
		echo '<script type="application/ld+json">' . $local_schema . '</script>';
	endif; ?>

    <?php if (has_post_thumbnail()) {
        $attachment_image = wp_get_attachment_url( get_post_thumbnail_id() );
        echo '<link rel="preload" as="image" href="'.$attachment_image.'">';
        echo '<link rel="preload" as="image" href="'.$attachment_image.'.webp">';
    } ?>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php
	$responsiveness = "yes";
	if (isset($qode_options_passage['responsiveness'])) $responsiveness = $qode_options_passage['responsiveness'];
	if($responsiveness != "no"):
	?>
	<meta name=viewport content="width=device-width,initial-scale=1">
	<?php 
	endif;
	?>
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?><?php ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $qode_options_passage['favicon_image']; ?>">

	<link rel="preload" href="/wp-content/themes/davis/fonts/teko/teko-regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/davis/fonts/teko/teko-medium.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/davis/fonts/teko/teko-semibold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/davis/fonts/teko/teko-bold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/davis/fonts/roboto/roboto-light.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/davis/fonts/roboto/roboto-regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/uploads/svg-icons/fonts/icomoon.woff?-7lxhgk" as="font" type="font/woff" crossorigin>

	<?php if( is_front_page() ) : ?>
	<link rel="preload" href="/wp-content/uploads/2025/10/homepage_mobile_background.jpg.webp" as="image" fetchpriority="high">
	<?php endif; ?>

	<!-- <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,700,800%7COpen+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300%7CSource+Sans+Pro:200,300,400%7CLato%7CYanone+Kaffeesatz:300,400,700,800%7CTeko:400,500,600,700%7CRoboto:300,400%7CFjalla+One%7CTeko:500" rel="stylesheet"> -->
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N96GKF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="preload">
	<?php if(isset($qode_options_passage['pattern_background_image']) && $qode_options_passage['pattern_background_image'] != ""){  ?>
		<img alt="" src="<?php echo $qode_options_passage['pattern_background_image']; ?>" />
	<?php } ?>
	<?php if(isset($qode_options_passage['background_image']) && $qode_options_passage['background_image'] != ""){  ?>
		<img alt="" src="<?php echo $qode_options_passage['background_image']; ?>" />
	<?php } ?>
	<img alt="" src="<?php echo get_template_directory_uri(); ?>/css/img/pattern_background.png" />
</div>
	
<?php
	$header_in_grid = false;
	if ($qode_options_passage['header_in_grid'] == "yes") $header_in_grid = true;

	$centered_logo = false;
	if (isset($qode_options_passage['center_logo_image'])){ if($qode_options_passage['center_logo_image'] == "yes") { $centered_logo = true; }};
?>
<div class="wrapper">
<header class="<?php if(isset($qode_options_passage['header_fixed']) && $qode_options_passage['header_fixed'] == "no"){ echo "no_fixed"; } ?><?php if($centered_logo){ echo " centered_logo"; } ?>">
	
	<?php if($header_in_grid){ ?>
		<div class="container">
			<div class="container_inner">
	<?php } ?>
				<div class="header_inner clearfix">
					<div class="logo_no_animate"> <a href="<?php echo home_url(); ?>/"><img class="logo" src="<?php echo $qode_options_passage['logo_image']; ?>" alt="Logo"/></a></div>
					<div class="header_inner_right">
						<?php
						$menu_type = $qode_options_passage['top_menu'];
						
						?>
						<nav class="main_menu <?php  if($menu_type == "drop_down") { echo "drop_down"; } elseif($menu_type == "drop_down2") { echo "drop_down2"; } else { echo "drop_down"; } ?>">
						<?php
							
							// swap out menu on Homepage, Mobile	
									
					if ( my_wp_is_mobile() ) {
						
							if($menu_type == "drop_down") :
								wp_nav_menu( array( 'theme_location' => 'mobile-menu' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type1_walker_nav_menu()
							 ));
							
							elseif($menu_type == "drop_down2"):
								wp_nav_menu( array( 'theme_location' => 'mobile-menu' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type2_walker_nav_menu()
								 ));
							
							
							else :
								wp_nav_menu( array( 'theme_location' => 'mobile-menu' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type1_walker_nav_menu()
								 ));
							endif;
						
						}
						
						else {
						
							
							if($menu_type == "drop_down") :
								wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type1_walker_nav_menu()
							 ));
							
							elseif($menu_type == "drop_down2"):
								wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type2_walker_nav_menu()
								 ));
							
							
							else :
								wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type1_walker_nav_menu()
								 ));
							endif;
							
						} // end menu swap
							
							
						?>
                        
						<span id="magic"></span>
						</nav>
						
						
                      
						<?php	
						$display_header_widget = $qode_options_passage['header_widget_area'];
						if($display_header_widget == "yes"){ ?> 
							<div class="header_right_widget">
								<?php dynamic_sidebar('header_right'); ?>
							</div>
						<?php } ?>
					</div>
					<div class="mobile">
						<div class="head-mobile mobile">
							<a href="#" id="menu-icon"><hr><hr><hr></a>
						</div>
						<div id="mobile-nav">
							<?php
						        // The parent theme menu has way too many complications, lets use a simple wp_menu, mobile-nav, set in the functions.php file
						        $args = array(
						          'container' => false,
						          'theme_location' => 'mobile-nav'
						        );
						        wp_nav_menu( $args );
						    ?>
						</div>
					</div>
				</div>
	<?php if($header_in_grid){ ?>
			</div>
		</div>
	<?php } ?>   

            <!-- phone button -->
						<?php if ( is_page('5') ) { ?>
							<h4 class="phone_tab"><i class="wp-svg-custom-bubble-notification bubble-notification"></i>Free Initial Consultation</h4>
						<?php } else { ?>
							<h4 class="phone_tab"><i class="wp-svg-custom-bubble-notification bubble-notification"></i>Free Initial Consultation</h4>	
						<?php }	?>	

 <div class="header_mobile_phone"><div class="container_inner"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header-mobile') ) : ?><?php endif; ?></div></div>
</header>


	<div class="content">
		<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$animation = get_post_meta($id, "qode_show-animation", true);

?>
			<?php if($qode_options_passage['page_transitions'] == "1" || $qode_options_passage['page_transitions'] == "2" || $qode_options_passage['page_transitions'] == "3" || $qode_options_passage['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "leftright")){ ?>
				<div class="meta">				
					<?php if($seo_title){ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php echo $seo_title; ?></div>
					<?php } else{ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></div>
					<?php } ?>
					<?php if($seo_description){ ?>
						<div class="seo_description"><?php echo $seo_description; ?></div>
					<?php } else if($qode_options_passage['meta_description']){?>
						<div class="seo_description"><?php echo $qode_options_passage['meta_description']; ?></div>
					<?php } ?>
					<?php if($seo_keywords){ ?>
						<div class="seo_keywords"><?php echo $seo_keywords; ?></div>
					<?php }else if($qode_options_passage['meta_keywords']){?>
						<div class="seo_keywords"><?php echo $qode_options_passage['meta_keywords']; ?></div>
					<?php }?>
					<span id="qode_page_id"><?php echo $wp_query->get_queried_object_id(); ?></span>
					<div class="body_classes"><?php echo implode( ',', get_body_class()); ?></div>
				</div>
			<?php } ?>
			<div class="content_inner <?php echo $animation;?> ">
				
			