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
            <p id="breadcrumbs"><span><span><a href="/">Homepage</a> <span class="separator"> / </span> <a href="/blog/">Legal Blog</a> <span class="separator"> / </span> <span class="breadcrumb_last" aria-current="page"><?php the_title(); ?></span></span></span></p>
            <div class="columns">
            <!-- for blog posts -->
                <div class="column-50">
                    <h1><?php the_title(); ?></h1>
                    <div class="spacer-60"></div>
                    <?php
                    $post_id = get_the_ID(); // Gets the ID of the current post being displayed
                    $categories = get_the_category( $post_id );

                    if ( ! empty( $categories ) ) {
                        echo '<ul class="tags">';
                        foreach ( $categories as $category ) {
                            echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>

                    <div class="meta-block">
                        <div class="published">
                            <p>LAST UPDATED<br>
                            <span><?php echo get_the_date( 'F j, Y' ); ?></span></p>
                        </div>
                        <div class="author">
                            <p>AUTHOR<br>
                            <span><a href="/maurice-davis/">Maurice Davis</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-bg">
            <?php if ( has_post_thumbnail() ) { ?>
                <?php echo get_the_post_thumbnail(); ?>
            <?php } else { ?>
            <?php 
            $image = get_field('results_default_image','options');
            if( !empty( $image ) ): ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
            <?php } ?>
        </div>
    </section>

    <section class="main-content white">
        <div class="container">
            <div class="column-social mobile">
                <p>SHARE</p>
                <div class="social-share">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=&amp;source=Davis Law Group" target="_new" rel="noopener noreferrer">
                        <div class="icon"><span class="icon-facebook"></span></div>
                    </a> 
                    <a href="https://www.linkedin.com/shareArticle/?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=&amp;source=Davis Law Group" target="_new" rel="noopener noreferrer">
                        <div class="icon"><span class="icon-linkedin"></span></div>
                    </a> 
                    <a title="Click to share this post on Twitter" href="http://x.com/intent/tweet?text=Currently reading <?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                        <div class="icon"><span class="icon-twitter"></span></div>
                    </a>
                </div>
            </div>
            <div class="columns">
                <div class="column-social desktop">
                    <p>SHARE</p>
                    <div class="social-share">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=&amp;source=Davis Law Group" target="_new" rel="noopener noreferrer">
                            <div class="icon"><span class="icon-facebook"></span></div>
                        </a> 
                        <a href="https://www.linkedin.com/shareArticle/?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=&amp;source=Davis Law Group" target="_new" rel="noopener noreferrer">
                            <div class="icon"><span class="icon-linkedin"></span></div>
                        </a> 
                        <a title="Click to share this post on Twitter" href="http://twitter.com/intent/tweet?text=Currently reading <?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                            <div class="icon"><span class="icon-twitter"></span></div>
                        </a>
                    </div>

                    <div class="spacer-60"></div>

                    <div class="sidebar-cta">
                        <p class="small caps">Charged with a crime?</p>
                        <p class="large">Davis Law Group Can Help.</p>
                        <div class="spacer-15"></div>
                        <a class="btn" href="tel:<?php echo $GLOBALS['phone'] ?>">Call Us Now</a>
                        <a class="btn transparent" href="/contact/">Get Started Online</a>
                    </div>
                </div>
                <div class="column-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="related-posts">
        <div class="container">
            <div class="columns">

                <div class="column-full">
                    <h3>Related Reading</h3>
                    <a href="/blog/" class="btn">Explore All</a>
                </div>

                <?php
                $current_post_id = get_the_ID();
                $current_categories = get_the_category($current_post_id);
                $category_ids = wp_list_pluck($current_categories, 'term_id');

                $args = array (
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'post__not_in' => array($current_post_id),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'term_id',
                            'terms'    => $category_ids,
                        ),
                    ),
                );
                $the_query = new WP_Query($args);
                ?>

                <div class="posts">

                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
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

                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer();?>