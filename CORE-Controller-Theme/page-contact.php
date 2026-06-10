<?php
/**
 * Template Name: Contact
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<div class="body-container">

    <?php 
        $bg = get_field('banner_background_image');
    ?>

    <section class="banner" style="background-image: url('<?php echo esc_url($bg); ?>')">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-50 block">
                    <h1><?php the_field('page_title_h1'); ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="columns">
                <div class="column-content">
                    <?php the_content(); ?>
                </div>

                <div class="column-contact">
                    <p class="yellow caps">Find Us</p>
                    <a class="icon" href="tel:(313) 818-3238"><span class="icon-phone"></span> (313) 818-3238</a>
                    <a class="icon" href="mailto:<?php the_field('email_address','options'); ?>"><span class="icon-email"></span> <?php the_field('email_address','options'); ?></a>
                    <p class="icon"><span class="icon-Map-pin"></span> <?php echo $GLOBALS['location_address']; ?></p>
                    <a href="<?php echo $GLOBALS['directions_url']; ?>" class="btn transparent">Driving Directions</a>
                    <div class="spacer-30"></div>
                    <iframe src="<?php echo $GLOBALS['location_map']; ?>" title="location map" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>

            </div>
        </div>
    </section>
    
    <?php if(get_field('include_awards','options')) : ?>
        <?php get_template_part('block','awards'); ?>
    <?php endif; ?>

</div><!-- #front-page -->

<?php get_footer();?>