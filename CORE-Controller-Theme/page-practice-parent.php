<?php
/**
 * Template Name: Practice Parent
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<?php if (has_post_thumbnail( $post->ID ) ): ?> 
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>  

<link rel="preload" as="image" href="<?php echo $image[0]; ?>.webp">
<link rel="preload" as="image" href="<?php echo $image[0]; ?>">

<?php endif; ?>

<div class="body-container">

    <section class="banner">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-66 block">
                    <h1><?php the_field('page_title_h1'); ?></h1>
                    <div class="spacer-15"></div>
                    <p><?php the_field('value_proposition'); ?></p>
                    <div class="banner-cta-block">
                        <p class="cta-headline"><span>free</span> consultation • available 24/7</p>
                        <div class="banner-cta-block-buttons">
                            <a href="tel:<?php echo $GLOBALS['location_phone']; ?>" class="btn">Call Us Now</a><a href="/contact/" class="btn alt">Get Started Online</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (has_post_thumbnail( $post->ID ) ): ?> 
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>        
        <div id="banner-bg">
            <?php 
            if ( has_post_thumbnail() ) {
                $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                $alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                $image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $alt_text ) . '" class="custom-featured-img" />';
            }
            ?>
        </div>
        <?php endif; ?>

    </section>

    <?php if(get_field('include_awards','options')) : ?>
        <?php get_template_part('block','awards'); ?>
    <?php endif; ?>

    <section class="main-content panel-1">
        <div class="container">
            <div class="columns">
                <div class="column-66 block">
                    <?php the_field('top_copy_block'); ?>
                </div>
                <div class="column-33 sidebar-block block">

                    <div class="sidebar-header">Related Practice Areas</div>
                    <div class="sidebar-menu">
                        
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
                </div>
            </div>
        </div>
    </section>
    
    <section class="main-content white bottom-content">
        <div class="container">
            <div class="columns">
                <div class="column-66 center block">
                    <?php the_field('section_2_copy_block'); ?>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonial">
        <div class="container">
            <div class="columns">
                <div class="column-66 centered center">
                    <div class="quote-icon"><img src="/wp-content/uploads/2025/12/quote-icon.svg" alt=""></div>
                    <div class="spacer-30"></div>
                    <p class="testimonial-quote"><?php the_field('testimonial_quote','options'); ?></p>
                    <p class="testimonial-author"><?php the_field('testimonial_author','options'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <?php if( have_rows('faqs') ): ?>

    <section class="main-content">
        <div class="container">
            <div class="columns">
                <div class="column-66 center block">
                    <p class="yellow small caps">Resources</p>
                    <?php the_field('section_3_copy_block'); ?>
                    <div class="spacer-30"></div>
                    <?php while( have_rows('faqs') ): the_row(); ?>  
                        <div class="accordions">
                            <div class="accordions_title">
                                <h3><?php the_sub_field('question'); ?> <span></span></h3>
                            </div>
                            <div class="accordions_content">
                                <?php the_sub_field('answer'); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?> 

    <?php get_template_part('block','footer-map'); ?>

    <?php get_template_part('block','pre-footer'); ?>

</div>

<?php get_footer();?>