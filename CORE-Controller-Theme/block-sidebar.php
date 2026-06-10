<?php if(get_field('add_testimonial','options')) { ?>
<div class="sidebar-block">
    <div class="testimonial-block">
        <p class="testimonial"><?php the_field('sidebar_testimonial','options'); ?></p>
        <p><strong><?php the_field('sidebar_testimonial_author','options'); ?></strong></p>
    </div>
    <div class="spacer-15"></div>
    <p class="sidebar-more"><a href="/testimonials/" title="Read more testimonials">Read More Testimonials</a> <span class="icon-tick-down"></span></p>
</div>
<div class="spacer-30"></div>
<?php } ?>

<?php if(get_field('featured_result','options')) { ?>
<div class="sidebar-block">
    <div class="sidebar-header">NOTABLE RESULT</div>
    <div class="result-block">

        <?php
        $featured_post = get_field('featured_result','options');
        if( $featured_post ): ?>
            <p class="large"><?php echo esc_html( $featured_post->post_title ); ?></p>
            <p class="result">
                <?php 
                $content = $featured_post->post_content; ?>
                <?php echo wp_trim_words( $content , '18' ); ?>
            </p>
            <a href="<?php echo get_permalink($featured_post->ID); ?>" class="btn transparent">Read More</a>
        <?php endif; ?>

    </div>
    <div class="spacer-15"></div>
    <p class="sidebar-more"><a href="/results/" title="Read more results">Read More Results</a> <span class="icon-tick-down"></span></p>
</div>
<div class="spacer-30"></div>
<?php } ?>

<div class="sidebar-block">
    <div class="sidebar-header">Our Practice Areas</div>
    <div class="sidebar-menu">

        <?php
        if( get_field('custom_sidebar_menu') ) { ?>

            <ul class="sidebar-nav">
                <?php while( have_rows('sidebar_menu') ): the_row(); 
                $link = get_sub_field('menu_item');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <li><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></li>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>

        
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
</div>