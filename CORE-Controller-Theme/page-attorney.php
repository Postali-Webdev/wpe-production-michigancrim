<?php
/**
 * Template Name: Attorney Bio
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<div class="body-container">

    <section class="banner">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-50 block">
                    <h1><?php the_field('page_title_h1'); ?></h1>
                    <div class="spacer-15"></div>
                    <p class="large yellow caps"><?php the_field('banner_value_proposition'); ?></p>
                </div>
                <div class="column-33 block">
                    <?php
                    $locations = get_field('locations','options');
                    if ($locations) {
                        foreach ($locations as $location) {
                            if ($location['make_default_location']) {
                                $phone = $location['local_phone_number'];
                                $address = $location['address'];
                                $link = $location['directions_url'];
                                break;
                            }
                        }
                    }

                    ?>

                    <a class="icon" href="tel:<?php echo $phone; ?>"><span class="icon-phone"></span> <?php echo $phone; ?></a>
                    <a class="icon" href="mailto:<?php the_field('email_address','options'); ?>"><span class="icon-email"></span> <?php the_field('email_address','options'); ?></a>
                    <a class="icon" href="<?php echo $link; ?>" target="_blank"><span class="icon-Map-pin"></span> <?php echo $address; ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="columns">
                <div class="column-66 block">
                    <?php the_field('main_content_block'); ?>
                </div>
                <div class="column-33 block sidebar">

                <?php 
                $image = get_field('attorney_headshot');
                if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="attorney-img" />
                    <div class="spacer-60"></div>
                <?php endif; ?>

                <?php if( have_rows('sidebar_blocks') ): ?>
                <?php while( have_rows('sidebar_blocks') ): the_row(); ?>  
                    <div class="sidebar-block">
                        <div class="sidebar-header"><?php the_sub_field('block_title'); ?></div>
                        <?php the_sub_field('block_content'); ?>
                    </div>
                    <div class="spacer-30"></div>
                <?php endwhile; ?>
                <?php endif; ?> 

                </div>
            </div>
        </div>
    </section>
    
    <?php get_template_part('block','pre-footer'); ?>

</div><!-- #front-page -->

<?php get_footer();?>