<?php
/**
 * Theme header.
 *
 * @package Postali Child
 * @author Postali LLC
**/
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>

	<!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N96GKF');</script>
    <!-- End Google Tag Manager -->

	<!-- Add JSON Schema here -->
    <?php 
    // Global Schema
    $global_schema = get_field('global_schema', 'options');
    if ( !empty($global_schema) ) :
        echo '<script type="application/ld+json">' . $global_schema . '</script>';
    endif;

    // Single Page Schema
    $single_schema = get_field('single_schema');
    if ( !empty($single_schema) ) :
        echo '<script type="application/ld+json">' . $single_schema . '</script>';
    endif; ?>

	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <?php if(is_page_template('front-page.php')): ?>
    <link rel="preload" as="image" href="https://www.michigancriminallawyer.com/wp-content/uploads/2026/03/hp-banner-bg.jpg" fetchpriority="high">
    <link rel="preload" as="image" href="https://www.michigancriminallawyer.com/wp-content/uploads/2026/06/hp-header-mobile.jpg" fetchpriority="high">
    <?php endif; ?>

</head>

<?php 
global $phone;
$phone = get_location_phone();
?>

<a class="skip-link" href='#main-content'>Skip to Main Content</a>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N96GKF"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

	<header>
		<div id="header-top" class="container">
			<div id="header-top_left">
				<?php the_custom_logo(); ?>
			</div>
			
			<div id="header-top_right">
                <div class="header-cta">
                    <p>24/7 <span>free</span> consultation</p> <a href="tel:<?php if($phone){echo $phone;} ?>" class="btn"><span class="icon-phone"></span> <?php if ( $phone ) { echo $phone; } ?></a>
                </div>
				<div id="header-top_right_menu">
                    <?php
                        $args = array(
                            'container' => false,
                            'theme_location' => 'header-nav'
                        );
                        wp_nav_menu( $args );
                    ?>	
					<div id="header-top_mobile">
						<div id="menu-icon" class="toggle-nav">
							<span class="line line-1"></span>
							<span class="line line-2"></span>
							<span class="line line-3"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header> 

    <span id="main-content"></span>

    <?php
        $locations = get_field('locations', 'options');
        foreach ( $locations as $location ) {
            $location_name = $location['name'];
            $location_default = $location['make_default_location'];
            $location_page = $location['location_page'];
            $location_map = $location['map_embed_url'];
            $location_address = $location['address'];
            $location_phone = $location['local_phone_number'];
            $location_copy = $location['map_block_copy'];
            $location_directions = $location['directions_url'];
            $location_id = $location_page->ID;
            
            
            if( is_tree( $location_id ) ) {

                $GLOBALS['location_name'] = $location_name;
                $GLOBALS['location_map'] = $location_map;
                $GLOBALS['location_phone'] = $location_phone;
                $GLOBALS['location_address'] = $location_address;
                $GLOBALS['location_copy'] = $location_copy;
                $GLOBALS['directions_url'] = $location_directions;

            } else {

                if ( $location_default ) {
                    $GLOBALS['location_name'] = $location_name;
                    $GLOBALS['location_map'] = $location_map;
                    $GLOBALS['location_phone'] = $location_phone;
                    $GLOBALS['location_address'] = $location_address;
                    $GLOBALS['location_copy'] = $location_copy;
                    $GLOBALS['directions_url'] = $location_directions;
                }

            }
        }
    ?>	