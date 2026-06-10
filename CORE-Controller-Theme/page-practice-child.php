<?php
/**
 * Template Name: Practice Child  
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<div class="body-container">

    <?php 
        $bg = get_field('banner_bg_image','options');
    ?>

    <section class="banner">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-50 block">
                    <h1><?php the_field('page_title_h1'); ?></h1>
                    <div class="spacer-15"></div>
                    <p><?php the_field('value_proposition'); ?></p>
                    <div class="banner-cta-block">
                        <p class="cta-headline"><span>free</span> consultation • available 24/7</p>
                        <div class="banner-cta-block-buttons">
                            <a href="tel:<?php echo $GLOBALS['location_phone']; ?>" class="btn">Call Us Now</a><a href="#" class="btn alt">Get Started Online</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-bg" style="background-image: url('<?php echo esc_url($bg['url']); ?>')">
            <?php if(get_field('banner_testimonial','options')) { ?>
                <img src="/wp-content/uploads/2025/12/quote-icon.svg" alt="">
                <div class="spacer-30"></div>

                <?php

                $args = array(
                    'post_type'      => 'reviews',
                    'posts_per_page' => -1, // Get a batch of posts
                    'orderby'        => 'date', // Or 'ID' – this is fast and cacheable
                    'order'          => 'DESC'
                );
                $posts = get_posts( $args );
                shuffle( $posts );

                $count = 1;
                foreach ( $posts as $post ) {
                    setup_postdata( $post ); ?>
                    
                    <p><?php the_content(); ?></p>
                    <p class="small yellow caps spaced"><?php the_title(); ?></p>
                    <?php if($count = 1) { // Limit to 1 testimonial
                        break;
                    }
                    $count++;
                } wp_reset_postdata(); } ?>


        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="columns">
                <div class="column-66 block">
                    <?php the_field('upper_content'); ?>
                </div>
                <div class="column-33 block">
                    <?php get_template_part('block','sidebar'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('block','awards'); ?>

    <section class="white">
        <div class="container">
            <div class="columns">
                <div class="column-66 center block">
                    <?php the_field('lower_content'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('block','pre-footer'); ?>

</div>

<?php get_footer();?>