<?php
/**
 * Template Name: Practice Areas Navigational
 * @package Postali Child
 * @author Postali LLC
**/

get_header(); ?>

<?php 
    $bg = get_field('banner_background_image');
?>

<div class="body-container">

    <section class="banner">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-50 block">
                    <h1><?php the_field('page_title_h1'); ?></h1>
                    <div class="spacer-15"></div>
                    <p><?php the_field('banner_value_proposition'); ?></p>
                    <p class="cta"><?php the_field('call_to_action_text','options'); ?> </p>
                    
                    <div class="banner-cta-block">
                        <p class="cta-headline"><span>free</span> consultation • available 24/7</p>
                        <div class="banner-cta-block-buttons">
                            <a href="tel:<?php echo get_location_phone(); ?>" class="btn">Call Us Now</a><a href="/contact/" class="btn alt">Get Started Online</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-bg" style="background-image: url('<?php echo $bg; ?>')">
            
        </div>
    </section>

    <div class="pa-boxes">
        <?php if ( have_rows('practice_areas') ): ?>
        <?php while ( have_rows('practice_areas') ): the_row(); ?>  
            <?php 
            $link = get_sub_field('parent_page');
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                $page_id = url_to_postid($link_url); // Get the page ID from the link URL
            ?>
            <a class="pa-box" href="#<?php echo $page_id; ?>">
                <?php the_sub_field('practice_area_name'); ?>
            </a>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?> 
    </div>

    <section class="main-content">
        <div class="container">
            <div class="columns">
                <div class="column-full">
                    <?php if ( have_rows('practice_areas') ): ?>
                    <?php while ( have_rows('practice_areas') ): the_row(); ?>  
                        <div class="column-66">
                            <?php 
                            $image = get_sub_field('practice_area_icon'); 
                            $link = get_sub_field('parent_page');
                            if( $link ): 
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                $page_id = url_to_postid($link_url); // Get the page ID from the link URL
                            ?>
                            <a class="title" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" id="<?php echo $page_id; ?>">
                            <?php endif; ?>
                                <div class="icon"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" /></div><h2><?php the_sub_field('practice_area_name'); ?></h2>
                            </a>
                            <?php the_sub_field('intro_copy'); ?>
                        </div>
                        <div class="column-full block child-pages">
                            <p class="eyebrow">Page Topics</p>
                            <?php
                            if ($page_id) {
                                $child_pages = get_pages(array(
                                    'parent' => $page_id,
                                    'sort_column' => 'post_title',
                                    'sort_order' => 'ASC',
                                ));
                                if ($child_pages) {
                                    echo '<ul>';
                                    foreach ($child_pages as $child_page) {
                                        echo '<li><a href="' . get_permalink($child_page->ID) . '">' . esc_html($child_page->post_title) . '</a></li>';
                                    }
                                    echo '</ul>';
                                }
                            }
                            ?>
                        </div>
                        
                        <div class="column-full block child-pages">
                            <?php
                            if ($page_id) {
                                $parent_categories = get_the_category($page_id);
                                if ($parent_categories) {
                                    $category_ids = wp_list_pluck($parent_categories, 'term_id');
                                    $related_posts = new WP_Query(array(
                                        'category__in' => $category_ids,
                                        'posts_per_page' => 6,
                                        'post_status' => 'publish',
                                        'orderby' => 'date',
                                        'order' => 'DESC',
                                    ));
                                    if ($related_posts->have_posts()) {
                                        echo '<div class="spacer-60"></div>';
                                        echo '<p class="eyebrow">Resources & Blogs</p>';
                                        echo '<ul>';
                                        while ($related_posts->have_posts()) {
                                            $related_posts->the_post();
                                            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                                        }
                                        echo '</ul>';
                                        wp_reset_postdata();
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="spacer-90"></div>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
    </section>
    
    <?php if(get_field('include_awards','options')) : ?>
        <?php get_template_part('block','awards'); ?>
    <?php endif; ?>

</div>

<?php get_footer(); ?>