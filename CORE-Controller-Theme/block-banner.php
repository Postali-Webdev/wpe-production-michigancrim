<section class="banner">
    <div class="container">
    
    <?php if (is_singular('attorneys')) { ?>
        <p id="breadcrumbs"><span><span><a href="/">Homepage</a> <span class="separator"> / </span> <a href="/about/">About</a> <span class="separator"> / </span> <span class="breadcrumb_last" aria-current="page"><?php the_title(); ?></span></span></span></p>
    <?php } elseif(is_post_type_archive('attorneys'))  { ?>  
        <p id="breadcrumbs"><span><span><a href="/">Homepage</a> <span class="separator"> / </span> <span class="breadcrumb_last" aria-current="page">About</span></span></span></p>
    <?php } elseif(is_singular('case_studies'))  { ?> 
        <p id="breadcrumbs"><span><span><a href="/">Homepage</a> <span class="separator"> / </span> <a href="/case-studies/">Results</a> <span class="separator"> / </span> <span class="breadcrumb_last" aria-current="page"><?php the_title(); ?></span></span></span></p>
    <?php } elseif(is_single())  { ?>
        <p id="breadcrumbs"><span><span><a href="/">Homepage</a> <span class="separator"> / </span> <a href="/blog/">Blog</a> <span class="separator"> / </span> <span class="breadcrumb_last" aria-current="page"><?php the_title(); ?></span></span></span></p>
    <?php } elseif (is_home()) { ?>
        <p id="breadcrumbs"><span><span><a href="/">Homepage</a> <span class="separator"> / </span> <span class="breadcrumb_last" aria-current="page">Blog</span></span></span></p>
    <?php } else { ?>
        <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <?php } ?>
        <div class="columns">
            <?php if(is_post_type_archive('reviews')) { ?> <!-- for testimonials -->
                <div class="column-50">
                    <h1><?php the_field('testimonials_header_banner_title','options'); ?></h1>
                    <p><?php the_field('testimonials_header_banner_subheadline','options'); ?></p>
                    <p class="cta"><?php the_field('call_to_action_text','options'); ?> </p>
                    <div class="main-contact">
                        <div class="contact-block-left">
                            <a href="tel:<?php the_field('phone_number','options'); ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
                        </div>
                        <div class="contact-block-right">
                            <p><a href="/contact/" title="Online form">Online Form</a></p>
                        </div>
                    </div>
                </div>

                <?php if(get_field('featured_review_content','options')) { ?>
                <div class="column-50 featured">
                    <p class="notable">NOTABLE REVIEW</p>
                    <p><?php the_field('featured_review_content','options'); ?></p>
                    <p class="reviewer"><?php the_field('featured_review_author','options'); ?></p>
                    <?php 
                    $logo = get_field('featured_review_source','options');
                    if( !empty( $logo ) ): ?>
                        <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                    <?php endif; ?>
                </div>
                <?php } ?>

            <?php } elseif(is_post_type_archive('case_studies')) { ?> <!-- for results -->

                <div class="column-66">
                    <h1><?php the_field('results_header_banner_title','options'); ?></h1>
                    <p><?php the_field('results_header_banner_subheadline','options'); ?></p>
                    <p class="cta"><?php the_field('call_to_action_text','options'); ?> </p>
                    <div class="main-contact">
                        <div class="contact-block-left">
                            <a href="tel:<?php the_field('phone_number','options'); ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
                        </div>
                        <div class="contact-block-right">
                            <p><a href="/contact/" title="Online form">Online Form</a></p>
                        </div>
                    </div>
                </div>

                <?php if(get_field('featured_result_headline','options')) { ?>
                <div class="column-50 result">
                    <div class="result-main">
                        <p class="notable">NOTABLE RESULT</p>
                        <h3><?php the_field('featured_result_headline','options'); ?></h3>
                    </div>
                    <div class="accordions">
                        <div class="accordions_title"><p>View Details <span></span></p></div>
                        <div class="accordions_content"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et tincidunt purus, et iaculis sem. Nullam a ante justo. Aliquam facilisis, elit in accumsan semper.</p></div>
                    </div>
                </div>
                <?php } ?>

            <?php } elseif(is_post_type_archive('attorneys')) { ?> <!-- for results -->

                <div class="column-66">
                    <h1><?php the_field('attorneys_header_banner_title','options'); ?></h1>
                    <div class="spacer-30"></div>
                    <p><?php the_field('attorneys_header_banner_subheadline','options'); ?></p>
                    <div class="main-contact">
                        <div class="contact-block-left">
                            <a href="tel:<?php the_field('phone_number','options'); ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
                        </div>
                        <div class="contact-block-right">
                            <p><a href="/contact/" title="Online form">Online Form</a></p>
                        </div>
                    </div>
                </div>

            <?php } elseif(is_singular('attorneys')) { ?> <!-- for blog posts -->
                <div class="column-66">
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_field('banner_value_proposition'); ?></p>
                    <p class="cta"><?php the_field('call_to_action_text','options'); ?> </p>
                    <div class="main-contact">
                        <div class="contact-block-left">
                            <a href="tel:<?php the_field('phone_number','options'); ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
                        </div>
                        <?php if (!is_page_template('page-contact.php')) { ?>
                        <div class="contact-block-right">
                            <p><a href="/contact/" title="Online form">Online Form</a></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
            <?php } elseif(is_home()) { ?> <!-- for blog posts -->
                <div class="column-66">
                    <h1><?php the_field('blog_header_banner_title','options'); ?></h1>
                    <div class="spacer-30"></div>
                    <p><?php the_field('blog_header_banner_subheadline','options'); ?></p>
                    <p class="cta"><?php the_field('call_to_action_text','options'); ?> </p>
                    <div class="main-contact">
                        <div class="contact-block-left">
                            <a href="tel:<?php the_field('phone_number','options'); ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
                        </div>
                        <div class="contact-block-right">
                            <p><a href="/contact/" title="Online form">Online Form</a></p>
                        </div>
                    </div>
                </div>

            <?php } elseif(is_404()) { ?> <!-- for 404 error posts -->
                <div class="column-66">
                    <h1><?php the_field('404_header_banner_title','options'); ?></h1>
                    <p><?php the_field('404_header_banner_subheadline','options'); ?></p>
                </div>

            <?php } elseif(is_single()) { ?> <!-- for blog posts -->
                <div class="column-75">
                    <p class="header-callout">WRITTEN BY MAURICE DAVIS</p>
                    <h1><?php the_title(); ?></h1>
                </div>

            <?php } else { ?>

            <div class="column-66 block">
                <?php if(is_singular('attorneys')) { ?>

                <?php } elseif(is_singular('case_studies')) { ?>
                    <p class="header-callout">CASE STUDY</p>
                <?php } ?>
                <?php if (is_home()) { ?>
                    <h1><?php the_field('blog_header_banner_title','options'); ?></h1>
                <?php } elseif (is_search()) { ?>
                    <h1 class="post-title"><?php printf( esc_html__( 'Search results for "%s"', 'postali' ), get_search_query() ); ?></h1>
                <?php } elseif (is_page_template('page-practice-parent.php') || is_page_template('page-interior.php')) { ?>
                    <h1><?php the_title(); ?></h1>
                <?php } elseif (is_page_template('page-landing.php')) { ?>
                    <h1><?php the_title(); ?></h1>
                <?php } else { ?>
                    <h1><?php the_title(); ?></h1>
                <?php } ?>
                <?php if(!is_singular('case_studies')) { ?>
                    <div class="spacer-15"></div>
                <?php } ?>
                <?php if (is_home()) { ?>
                    <p><?php the_field('blog_header_banner_subheadline','options'); ?></p>   
                <?php } elseif (is_page_template('page-landing.php')) { ?>
                    <p class="value-prop"><?php the_field('practice_areas_value_prop','options'); ?></p>                 
                <?php } else { ?>
                    <p><?php the_field('banner_value_proposition'); ?></p>
                <?php } ?>

                <?php if(is_singular('attorneys') || is_singular('case_studies') || is_single()) { ?>

                <?php } ?>
                <?php if(!is_single()) { ?>
                    <p class="cta"><?php the_field('call_to_action_text','options'); ?> </p>
                    
                    <div class="banner-cta-block">
                        <p class="cta-headline"><span>free</span> consultation • available 24/7</p>
                        <div class="banner-cta-block-buttons">
                            <a href="tel:<?php echo get_location_phone(); ?>" class="btn">Call Us Now</a><a href="/contact/" class="btn alt">Get Started Online</a> 
                        </div>
                    </div>

                <?php } ?>
                </div>
            <?php } ?>

        </div>
    </div>

    <?php if(is_post_type_archive('attorneys')) { 
    $bg_image = get_field('attorneys_header_default_image','options');
    } elseif(is_home()) { 
        $bg_image = get_field('blog_header_default_image','options');
    } elseif (!empty(get_field('banner_background_image'))) { 
        $bg_image = get_field('banner_background_image');
    } else { 
        $bg_image = get_field('default_background_image','options');
    } ?>

    <div class="banner-bg">
    <?php 
    if( !empty( $bg_image ) ): ?>
        <img src="<?php echo esc_url($bg_image['url']); ?>" alt="<?php echo esc_attr($bg_image['alt']); ?>" />
    <?php endif; ?>
    </div>
    
    <?php if(get_field('include_gradient_overlay','options')) { ?>
        <div class="banner-gradient"></div>
    <?php } ?>
</section>