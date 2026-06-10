<?php
/**
 * Template Name: Front Page
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<div class="body-container">

    <section class="banner" id="hp-banner" style="background-image:url(<?php the_field('banner_bg'); ?>);">
        <div class="container">
            <div class="columns">
                <div class="column-50">
                    <div class="spacer-60"></div>
                    <p class="eyebrow"><?php the_title(); ?></p>
                    <h1><?php the_field('banner_headline'); ?></h1>
                    <div class="spacer-30"></div>
                    <div class="banner-cta-block">
                        <p class="cta-headline"><span>free</span> consultation • available 24/7</p>
                        <div class="banner-cta-block-buttons">
                            <a href="tel:<?php echo $GLOBALS['location_phone']; ?>" class="btn">Call Us Now</a><a href="/contact/" class="btn transparent">Get Started Online</a> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-bg" style="background-image:url(<?php the_field('banner_bg'); ?>);"></div>
        </div>

        <div class="banner-touts">
            <?php if( have_rows('banner_touts') ): ?>
            <?php while( have_rows('banner_touts') ): the_row(); ?>  
                <?php 
                $link = get_sub_field('tout_link');
                if( $link ): ?>
                <a class="tout-block" href="<?php echo esc_url( $link ); ?>">
                <?php endif; ?>

                <?php 
                $image = get_sub_field('tout_icon');
                if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
                    <p class="caps spaced med"><?php the_sub_field('tout_headline'); ?></p>
                    <p><?php the_sub_field('tout_copy'); ?></p>
                </a>
            <?php endwhile; ?>
            <?php endif; ?> 
        </div>
    </section>

    <section class="hp-p1">
        <div class="container">
            <div class="columns">
                <div class="column-50 block">
                    <p class="eyebrow"><?php the_field('p1_eyebrow'); ?></p>
                    <h2><?php the_field('p1_headline'); ?></h2>
                    <p class="med"><?php the_field('p1_subheadline'); ?></p>
                    <?php the_field('p1_copy'); ?>
                    <p class="med caps">call for your free and confidential consultation</p>
                    <a href="tel:<?php echo $GLOBALS['location_phone']; ?>" class="btn">Call Now</a>
                </div>
                <div class="column-50">
                    <div class="sidebar-block">
                    <?php if( have_rows('results_scroller') ): ?>
                    <div class="results-scroller">
                    <?php while( have_rows('results_scroller') ): the_row(); ?>
                        <?php $post_object = get_sub_field('result'); ?>
                        <?php if( $post_object ): ?>
                            <?php // override $post
                            $post = $post_object;
                            setup_postdata( $post );
                            ?>

                            <article>
                                <div class="meta-content">
                                    
                                    <ul class="tags">
                                        <li><a href="/results/">Case Results</a></li>';
                                    </ul>

                                    <h3><?php the_title(); ?></h3>
                                    <div class="spacer-15"></div>
                                    <?php 
                                    $content = get_the_content(); ?>
                                    <p><?php echo wp_trim_words( $content , '30' ); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn transparent">Read More</a>
                                </div>
                            </article>

                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    </div>
                    <?php endif; ?>

                        <div class="slider-bottom">
                            <div class="nav-dots"></div>
                            <div class="nav-arrows"></div>
                        </div>

                    </div>
                    <div class="sidebar-block bottom">
                        <p><a href="/results/">Read More Case Results</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('block','awards'); ?>

    <section class="hp-p2">
        <div class="container">
            <div class="columns" style="background-image:url(<?php the_field('p2_bg'); ?>);">
                <div class="column-full centered center">
                    <p class="eyebrow"><?php the_field('p2_eyebrow'); ?></p>
                    <h2><?php the_field('p2_headline'); ?></h2>
                    <?php 
                    $link = get_field('p2_button');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="hp-p3">
        <div class="container">
            <div class="columns">
                <div class="column-50">
                    <p class="eyebrow"><?php the_field('p3_eyebrow'); ?></p>
                    <h2 class="heading-sm"><?php the_field('p3_headline'); ?></h2>
                    <?php the_field('p3_copy'); ?>
                    <div class="spacer-30"></div>

                    <!-- comment out chart for now
                    <div class="chart">
                        
                        <div class="donut-chart">
                            <div class="statistic">
                                <span id="counter2"><span class="counter-value2 number" data-count="17">0</span><span class="number">%</span></span>
                                <p class="add-text">
                                    <span>less likely to be convicted in court</span>According to a 2002 study by Ohio State Journal of Criminal Law
                                </p>
                            </div>
                            <div class="half-donut-chart">
                                <div class="half-donut-fill"></div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

                <div class="column-50">
                    <?php if( have_rows('p3_numbered_content') ): ?>
                    <?php $n=1; ?>
                    <?php while( have_rows('p3_numbered_content') ): the_row(); ?>  
                        <div class="content-block">
                            <div class="number">
                                <p class="large yellow"><?php echo $n; ?>.</p>
                            </div>
                            <div class="content">
                                <h4><?php the_sub_field('headline'); ?></h4>
                                <p><?php the_sub_field('copy'); ?></p>
                            </div>
                        </div>
                        <?php $n++; ?>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
    </section>

    <section class="hp-p4">
        <div class="container">
            <div class="columns">
                <div class="pa-slider">
                    <div class="main-box">
                        <p class="eyebrow"><?php the_field('p4_eyebrow'); ?></p>
                        <h2 class="heading-sm"><?php the_field('p4_headline'); ?></h2>
                        <a href="/practice-areas/" class="btn">Explore All</a>
                        <div class="pa-slider-arrows"></div>
                    </div>
                    <div class="pa-slides">
                    <?php if( have_rows('practice_areas') ): ?>
                    <?php while( have_rows('practice_areas') ): the_row(); ?>  
                    <?php 
                    $link = get_sub_field('link');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                    
                        <a class="pa-slide" href="<?php echo esc_url( $link_url ); ?>">
                            <?php 
                            $image = get_sub_field('icon');
                            if( !empty( $image ) ): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                            <p class="large"><?php echo esc_html( $link_title ); ?></p>
                            <div class="bg-image" style="background-image:url(<?php the_sub_field('bg_image'); ?>);"></div>
                        </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="meet-maurice reversed">
        <div class="container">
            <div class="columns">
                <div class="column-66">
                    <p class="eyebrow"><?php the_field('p5_eyebrow'); ?></p>
                    <h2><?php the_field('p5_headline'); ?></h2>
                    <p class="med"><?php the_field('p5_copy'); ?></p>
                    <?php 
                    $link = get_field('p5_button');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="column-33">
                    <?php 
                    $image = get_field('p5_attorney_image');
                    if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                </div>
                <!-- commentint out until we have some
                <div class="column-full statistics">
                    <?php if( have_rows('statistics') ): ?>
                    <?php while( have_rows('statistics') ): the_row(); ?>  
                        <div class="stat-block">
                            <p class="number"><?php the_sub_field('stat_number'); ?></p>
                            <p class="description"><?php the_sub_field('stat_description'); ?></p>
                        </div>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                </div>
                -->
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

    <section class="hp-p7">
        <div class="container">
            <div class="columns">

                <div class="column-full">
                    <div class="copy">
                        <p class="eyebrow"><?php the_field('p7_eyebrow'); ?></p>
                        <h2><?php the_field('p7_headline'); ?></h2>
                    </div>
                    <div class="button">
                        <a href="/contact/" class="btn">Schedule a Free Consultation</a>
                    </div>
                </div>

                <div class="tabs-container">
                <?php if( have_rows('p7_charges') ): ?>
                <?php while( have_rows('p7_charges') ): the_row(); ?>  
                    
                    <?php if( have_rows('charges_category') ): ?>
                    <?php $tb = 1; ?>
                    <ul class="main-buttons">
                    <?php while( have_rows('charges_category') ): the_row(); ?>  
                        <li  <?php if($tb == 1) { ?>class="active"<?php } ?>><span id="#tabid<?php echo $tb; ?>" class="tabs-nav"><?php the_sub_field('headline'); ?></span></li>
                        <?php $tb++; ?>
                    <?php endwhile; ?>
                    </ul>
                    <?php endif; ?> 

                    <?php if( have_rows('charges_category') ): ?>
                    <div class="main-content">
                    <?php $tc=1; ?>
                    <?php while( have_rows('charges_category') ): the_row(); ?> 
                    
                        <div class="tab-content"  id="tabid<?php echo $tc; ?>">
                            
                            <div class="main-body">
                                <h3><?php the_sub_field('headline'); ?></h3>
                                <?php the_sub_field('copy'); ?>
                                <p class="large"><?php the_sub_field('cta_headline'); ?></p>
                                <?php 
                                $link = get_sub_field('link');
                                if( $link ): 
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                            </div>

                            <?php if( have_rows('child_page_links') ): ?>
                            <div class="main-children">
                                <div class="spacer-30"></div>
                                <p class="eyebrow">Learn More</p>
                                <ul>
                                <?php while( have_rows('child_page_links') ): the_row(); ?>  

                                    <?php 
                                    $link = get_sub_field('link');
                                    if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></li>
                                    <?php endif; ?>

                                <?php endwhile; ?>
                                </ul>
                            </div>
                            <?php endif; ?> 
                        <?php $tc++; ?>
                        </div>
                        
                    
                    <?php endwhile; ?>
                    </div>
                    <?php endif; ?> 
                <?php endwhile; ?>
                <?php endif; ?> 
                </div>
            </div>
        </div>
    </section>

    <section class="hp-p8">
        <div class="container">
            <div class="columns">
                <div class="column-66 block center centered">
                    <p class="eyebrow"><?php the_field('p8_eyebrow'); ?></p>
                    <h2><?php the_field('p8_headline'); ?></h2>
                    <?php if( have_rows('faqs') ): ?>
                    <?php $i=1; ?>
                    <?php while( have_rows('faqs') ): the_row(); ?>  
                        <div class="accordions">
                            <div class="accordions_title<?php if($i==1) { ?> active<?php } ?>">
                                <h3><?php the_sub_field('question'); ?><span></span></h3>
                            </div>
                            <div class="accordions_content" <?php if($i==1) { ?> style="display:block;"<?php } ?>>
                                <?php the_sub_field('answer'); ?>
                                <?php 
                                $link = get_sub_field('link');
                                if( $link ): 
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                    <?php endif; ?> 

                </div>
            </div>
        </div>
    </section>

    <section class="hp-p9">
        <div class="container">
            <div class="slider-nav-container">
                <div class="slider-nav-arrows">
                    <span class="icon-chevron_right prev-arrow"></span>
                    <span class="icon-chevron_right next-arrow"></span>
                </div>
            
                <div class="slider-nav">
                <?php if( have_rows('locations','options') ): ?>
                <?php while( have_rows('locations','options') ): the_row(); ?>  
                        <p class="caps spaced"><?php the_sub_field('name'); ?></p>
                <?php endwhile; ?>
                <?php endif; ?> 
                </div>
            </div>

            <div class="slider-for">
            <?php if( have_rows('locations','options') ): ?>
            <?php while( have_rows('locations','options') ): the_row(); ?>  
                <div class="columns">
                    <div class="column-50 block">
                        <h2>Criminal Law Office in <?php the_sub_field('name'); ?>, MI</h2>
                        <p><?php the_sub_field('map_block_copy'); ?></p>
                        <p class="icon"><span class="icon-Map-pin"></span><a href="<?php the_sub_field('directions_url'); ?>" target="_blank"><?php the_sub_field('address'); ?></a></p>
                        <p class="icon"><span class="icon-phone"></span><a href="tel:<?php the_sub_field('local_phone_number'); ?>"> <?php the_sub_field('local_phone_number'); ?></a></p>
                    </div>
                    <div class="column-50">
                        <iframe src="<?php the_sub_field('map_embed_url'); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?> 
            </div>
        </div>
    </section>

    <?php get_template_part('block','pre-footer'); ?>

</div><!-- #front-page -->

<script>
    scrollCue.init();
</script>

<?php get_footer();?>