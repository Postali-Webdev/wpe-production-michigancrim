<?php
/**
 * Template Name: Blog
 * 
 * @package Postali Child
 * @author Postali LLC
 */

$category = get_queried_object();
$get_category = $category->slug;
$cat_name = $category->name;

$_SESSION['current_category'] = $get_category;

$cat_id = get_query_var('cat');

get_header(); ?>

<div class="body-container">

    <section class="banner">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-66 block">
                    <h1><?php the_field('blog_banner_title','options'); ?></h1>
                    <div class="spacer-15"></div>
                    <p><?php the_field('blog_banner_value_proposition','options'); ?></p>
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
                            <?php echo $cat_name; ?> <span class="icon-chevron_down"></span>
                        </div>
                        <div class="accordions_content">
                            <?php
                            $categories = get_categories(array(
                                'orderby' => 'name',
                                'order'   => 'ASC',
                                'hide_empty' => 1,
                                'exclude'    => 5, 
                            ));

                            if ( ! empty($categories) ) {
                                echo '<ul class="all-post-categories">';
                                foreach ($categories as $cat) {
                                    echo '<li><a href="' . esc_url(get_category_link($cat->term_id)) . '">'
                                        . esc_html($cat->name) . '</a></li>';
                                }
                                echo '<li><a href="/blog/">All Posts</a></li>';
                                echo '</ul>';
                            }
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
                <div class="column-full posts">
                    <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                        <article>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">

                            <?php if ( has_post_thumbnail() ) { ?> <!-- If featured image set, use that, if not use options page default -->
                            <?php $featImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
                                <div class="post-image" style="background-image:url('<?php echo $featImg[0]; ?>');"/></div>
                            <?php } else { ?>
                                <div class="post-image" style="background-image:url('<?php the_field('blog_default_image','options'); ?>"/></div>
                            <?php } ?>
                                <div class="meta-content">
                                    <h2><?php the_title(); ?></h2>
                                    <p class="blog-date"><?php the_date(); ?></p>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                    <div class="spacer-60"></div>
                    <?php the_posts_pagination(); ?>
                </div>
            </div>
        </div>
    </section>
    
    <?php if(get_field('include_awards','options')) : ?>
        <?php get_template_part('block','awards'); ?>
    <?php endif; ?>

    <?php get_template_part('block','pre-footer'); ?>

</div>

<?php get_footer(); ?>