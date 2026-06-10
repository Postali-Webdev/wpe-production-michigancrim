<?php
/**
 * Template Name: Practice Areas Landing
 * @package Postali Child
 * @author Postali LLC
**/

get_header(); ?>

<div class="body-container">

    <?php get_template_part('block','banner'); ?>

    <section class="main-content">
        <div class="container">
            <div class="columns">
                <div class="column-full">
                <?php 
                    // determine parent of current page
                    if ($post->post_parent) {
                        $ancestors = get_post_ancestors($post->ID);
                        $parent = $ancestors[count($ancestors) - 1];
                    } else {
                        $parent = $post->ID;
                    }

                    $children = wp_list_pages("title_li=&child_of=" . $parent . "&echo=0");

                    if ($children) {
                    ?>
                        <ul class="landing-box">
                            <?php  echo $children;  ?>
                        </ul>
                    <?php 
                    } else {
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                        $args = array (
                            'post_type' => 'page',
                            'paged' => $paged,
                            'posts_per_page' => '-1',
                            'post_status' => 'publish',
                            'post_parent'   => 0,
                            'order' => 'DESC',
                            'meta_query' => [
                                [
                                    'key'   => '_wp_page_template',
                                    'value' => 'page-practice-parent.php'
                                ]
                            ]
                        );
                        $the_query = new WP_Query($args);
                        
                        if( $the_query->have_posts() ) : ?>
                        <ul class="landing-box">
                            <?php while( $the_query->have_posts() ) : $the_query->the_post(); 
                                $parent = get_the_ID();
                                $children = wp_list_pages("title_li=&child_of=" . $parent . "&echo=0"); ?>
                            
                                <li class="page-item<?php echo $children ? ' page_item_has_children' : ''; ?>">
                                <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                <a class="link-cover" href="<?php echo get_the_permalink(); ?>"></a>
                                <?php if( $children ) : ?>
                                    <div class="all-pages"><span></span></div>
                                    <ul class="children">
                                        <?php  echo $children;  ?>
                                    </ul>
                                <?php endif; ?>
                                </li>

                            <?php endwhile; ?>
                        </ul>
                        <?php endif;
                        
                    }
                ?>
                </div>
            </div>
        </div>
    </section>
    
    <?php if(get_field('include_awards','options')) : ?>
        <?php get_template_part('block','awards'); ?>
    <?php endif; ?>

</div>

<?php get_footer(); ?>