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
                <div class="column-33 sidebar-block block">

                    <div class="sidebar-header">Related Practice Areas</div>

                    <?php if(get_field('custom_sidebar_menu')) { ?>
            

                        <?php if(get_field('menu_type') == 'pre') { ?>
                    
                            <div class="sidebar-nav">
                                <?php the_field('pre-menu'); ?>
                            </div>
                    
                        <?php } elseif (get_field('menu_type') == 'custom') { ?>
                    
                            <div class="sidebar-nav">
                                
                            <?php
                                // Get the current page's ID
                                $parent_id = get_the_ID();

                                // If the current page is a child, get its parent's ID
                                if ($post->post_parent) {
                                    $parent_id = $post->post_parent;
                                }

                                $child_args = array(
                                    'post_parent' => $parent_id,
                                    'post_type'   => 'page',    // Ensure it only gets pages
                                    'post_status' => 'publish',
                                    'order' => 'ASC',
                                    'posts_per_page' => '6',

                                );

                                $children = get_children($child_args);

                                if ($children) {
                                    echo '<ul class="sidebar-nav">';
                                    foreach ($children as $child) {
                                        echo '<li>';
                                        echo '<a href="' . get_permalink($child->ID) . '">' . $child->post_title . '</a> <span></span>';
                                        // Add more data like excerpt:
                                        // echo apply_filters('the_content', $child->post_content);
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                } else {
                                    $args = array(
                                        'container' => false,
                                        'theme_location' => 'footer-practice-areas'
                                    );
                                    wp_nav_menu( $args );
                                }
                                ?>
                            </div>
                    
                        <?php } ?>
                    
                    <?php } else { 
                        $current_id = get_the_ID();
                        $parent_id = wp_get_post_parent_id($current_id);
                        if ($parent_id) {
                            $pages = get_pages(array(
                                'parent' => $parent_id,
                                'sort_column' => 'menu_order',
                                'sort_order' => 'ASC',
                                'exclude' => $current_id,
                                'number' => 5
                            ));

                            if ($pages) {
                                echo '<ul class="sidebar-nav">';
                                foreach ($pages as $page) {
                                    echo '<li><a href="' . get_permalink($page->ID) . '">' . esc_html($page->post_title) . '</a><span></span></li>';
                                }
                                echo '</ul>';
                            }
                        } else {
                            $args = array(
                                'container' => false,
                                'theme_location' => 'footer-practice-areas'
                            );
                            wp_nav_menu( $args );
                        }
                    } ?>

                        


                        <div class="spacer-15"></div>
                        <p class="sidebar-more"><a href="/practice-areas/" title="Read more results">All Practice Areas</a> <span class="icon-tick-down"></span></p>

                    </div>




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