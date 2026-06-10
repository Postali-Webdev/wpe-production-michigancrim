<?php
/**
 * Single template
 *
 * @package Postali Parent
 * @author Postali LLC
 */

$blogDefault = get_field('default_blog_image', 'options');

get_header();?>



<div class="body-container">

    <section class="banner">
        <div class="container">
            <p id="breadcrumbs"><span><span><a href="/">Homepage</a> <span class="separator"> / </span> <a href="/results/">Case Results</a> <span class="separator"> / </span> <span class="breadcrumb_last" aria-current="page"><?php the_title(); ?></span></span></span></p>
            <div class="columns">
            <!-- for blog posts -->
                <div class="column-50">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
        <div class="banner-bg">
            <?php if ( has_post_thumbnail() ) { ?>
                <img src="<?php echo get_the_post_thumbnail(); ?>" alt="Featured Image">
            <?php } else { ?>
            <?php 
            $image = get_field('results_default_image','options');
            if( !empty( $image ) ): ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
            <?php } ?>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="columns">
                <div class="column-66 block">
                    <?php the_content(); ?>
                    <div class="spacer-30"></div>
                    <a href="/results/" class="btn">View All Results</a>
                </div>
                <div class="column-33 block">
                    <?php get_template_part('block','sidebar'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php if(get_field('include_awards','options')) : ?>
        <?php get_template_part('block','awards'); ?>
    <?php endif; ?>

</div>

<?php get_footer();?>