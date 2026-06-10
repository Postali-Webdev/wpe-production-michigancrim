<?php
/**
 * Template Name: Blog
 * 
 * @package Postali Child
 * @author Postali LLC
 */


get_header(); ?>

<div class="body-container">

    <section class="banner">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-66 block">
                    <h1><?php the_field('results_banner_title','options'); ?></h1>
                    <div class="spacer-15"></div>
                    <p><?php the_field('results_banner_value_proposition','options'); ?></p>
                </div>
                <div class="column-33 centered">
                    <div class="banner-cta-block">
                        <p class="cta-headline"><span>free</span> consultation • available 24/7</p>
                        <div class="banner-cta-block-buttons">
                            <a href="tel:<?php echo $GLOBALS['location_phone']; ?>" class="btn">Call Us Now</a><a href="#" class="btn alt">Get Started Online</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <div class="columns">
                <div class="column-33">
                    <p class="caps small">FILTER BY TOPIC</p>
                    <div class="accordions">
                        <div class="accordions_title">
                            All <span class="icon-chevron_down"></span>
                        </div>
                        <div class="accordions_content">
                            <?php
                            $args = array(
                                        'taxonomy' => 'result_category',
                                        'orderby' => 'name',
                                        'order'   => 'ASC',
                                    );

                            $cats = get_categories($args);

                            echo '<ul class="all-post-categories">';

                            foreach($cats as $cat) {
                            ?>
                                <li><a href="/results/result_category/<?php echo $cat->slug; ?>/">
                                    <?php echo $cat->name; ?>
                                </a></li>
                            <?php
                            }
                            echo '<li><a href="/results/">All</a></li>';
                            echo '</ul>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="columns">

            <?php 
            $recent_args = array(
                'post_type'      => 'results',
                'posts_per_page' => 1,
                'post_status'    => 'publish',
                'order'          => 'DESC',
                'orderby'        => 'date',
            );
            $recent_query = new WP_Query($recent_args);

            // Get the post ID to exclude from the second query
            $exclude_id = null;
            if ($recent_query->have_posts()) {
                $recent_query->the_post();
                $exclude_id = get_the_ID();
            ?>

                <div class="column-full featured-post">

                    <div class="featured-post">
                        <article>
                            <div class="featured-image">
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

                            <div class="meta-content">
                                
                                <?php
                                // Get terms for the current post ID and specific taxonomy
                                $terms = get_the_terms( get_the_ID(), 'result_category' ); // Replace with your taxonomy slug

                                if ( $terms && ! is_wp_error( $terms ) ) : 
                                    echo '<ul class="tags">';
                                    foreach ( $terms as $term ) :
                                        // Get the term link
                                        $term_link = get_term_link( $term );
                                        
                                        // Display term name as a link
                                        echo '<li><a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a></li>';
                                    endforeach;
                                    echo '</ul>';
                                endif;
                                ?>  

                                <h2><?php the_title(); ?></h2>
                                <?php 
                                $content = get_the_content(); ?>
                                <p><?php echo wp_trim_words( $content , '40' ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn transparent">Read More</a>
                            </div>
                        </article>
                    </div>
                    <div class="spacer-60"></div>
                </div>

                <?php wp_reset_postdata(); } ?>

                <div class="column-full posts">

                <?php 
                $rest_args = array(
                    'post_type'      => 'results',
                    'posts_per_page' => 9, // Get all remaining posts
                    'post_status'    => 'publish',
                    'order'          => 'DESC',
                    'orderby'        => 'date',
                    'paged'          => $paged
                );

                // Exclude the recent post if it exists
                if ($exclude_id) {
                    $rest_args['post__not_in'] = array($exclude_id);
                }

                $rest_query = new WP_Query($rest_args);

                // Now you can loop through $rest_query
                if ($rest_query->have_posts()) {
                    while ($rest_query->have_posts()) {
                        $rest_query->the_post();
                ?>
           
                    <article>
                        <div class="meta-content">
                            
                            <?php
                            // Get terms for the current post ID and specific taxonomy
                            $terms = get_the_terms( get_the_ID(), 'result_category' ); // Replace with your taxonomy slug

                            if ( $terms && ! is_wp_error( $terms ) ) : 
                                echo '<ul class="tags">';
                                foreach ( $terms as $term ) :
                                    // Get the term link
                                    $term_link = get_term_link( $term );
                                    
                                    // Display term name as a link
                                    echo '<li><a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a></li>';
                                endforeach;
                                echo '</ul>';
                            endif;
                            ?>  

                            <h2><?php the_title(); ?></h2>
                            <div class="spacer-15"></div>
                            <?php 
                            $content = get_the_content(); ?>
                            <p><?php echo wp_trim_words( $content , '40' ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn transparent">Read More</a>
                        </div>
                    </article>

                    <?php } wp_reset_postdata(); }  ?>

                </div>
                <div class="spacer-30"></div>
                <p class="btm-disclaimer"><em>The outcome of an individual case depends on a variety of factors unique to that case. Case results do not guarantee or predict a similar result in any similar or future case.</em></p>
                <div class="spacer-30"></div>
                <?php the_posts_pagination(); ?>
            </div>
        </div>
    </section>
    
    <?php if(get_field('include_awards','options')) : ?>
        <?php get_template_part('block','awards'); ?>
    <?php endif; ?>

    <?php get_template_part('block','pre-footer'); ?>

</div>

<?php get_footer(); ?>