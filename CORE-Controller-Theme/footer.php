<?php
/**
 * Theme footer
 *
 * @package Postali Child
 * @author Postali LLC
**/
?>
<footer>

    <section class="footer">
        <div class="container">
            <div class="columns">
                <div class="column-50">
                    <?php the_custom_logo(); ?>
                    <div class="spacer-30"></div>
                    <iframe src="<?php echo $GLOBALS['location_map']; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="column-25 block menu">
                    <p class="caps yellow small spaced condensed">About the Firm</p>
                    <nav role="navigation">
                    <?php
                        $args = array(
                            'container' => false,
                            'theme_location' => 'footer-nav'
                        );
                        wp_nav_menu( $args );
                    ?>	
                    </nav>
                </div>
                <div class="column-25 block menu">
                    <p class="caps yellow small spaced condensed">Practice Areas</p>
                    <nav role="navigation">
                    <?php
                        $args = array(
                            'container' => false,
                            'theme_location' => 'footer-practice-areas'
                        );
                        wp_nav_menu( $args );
                    ?>	
                    </nav>
                </div>

                <div class="footer-spacer"></div>

                <div class="column-33 block contact-info">
                    <div class="phone">
                        <p><span class="icon-phone"></span> <a href="tel:<?php echo get_location_phone(); ?>"><?php echo get_location_phone(); ?></a></p>
                    </div>
                    <div class="email">
                        <p><span class="icon-email"></span> <a href="mailto:<?php the_field('email_address','options'); ?>"><?php the_field('email_address','options'); ?></a></p>
                    </div>
                    <div class="spacer-30"></div>
                    <div class="socials">
                        <ul>
                            <?php if ( get_field('social_facebook','options') ) { ?>
                            <li><a href="<?php the_field('social_facebook','options'); ?>" target="_blank"><span class="icon-facebook"></span></a></li>
                            <?php } ?>
                            <?php if ( get_field('social_instagram','options') ) { ?>
                            <li><a href="<?php the_field('social_instagram','options'); ?>" target="_blank"><span class="icon-instagram"></span></a></li>
                            <?php } ?>
                            <?php if ( get_field('social_linkedin','options') ) { ?>
                            <li><a href="<?php the_field('social_linkedin','options'); ?>" target="_blank"><span class="icon-linkedin"></span></a></li>
                            <?php } ?>
                            <?php if ( get_field('social_twitter','options') ) { ?>
                            <li><a href="<?php the_field('social_twitter','options'); ?>" target="_blank"><span class="icon-twitter"></span></a></li>
                            <?php } ?>
                            <?php if ( get_field('social_youtube','options') ) { ?>
                            <li><a href="<?php the_field('social_youtube','options'); ?>" target="_blank"><span class="icon-youtube"></span></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="column-66 addresses">
                    <?php if( have_rows('locations','options') ): ?>
                    <?php while( have_rows('locations','options') ): the_row(); ?>  
                        <div class="column-25 address-block">

                            <?php $location_page = get_sub_field('location_page');
                            if( $location_page ): 
                                $permalink = get_permalink( $location_page->ID );
                            ?>
                            <p class="yellow caps spaced"><a href="<?php echo esc_url( $permalink ); ?>"><?php the_sub_field('name'); ?></a></p>
                            <?php endif; ?>
                            <p><a href="tel:<?php the_sub_field('local_phone_number'); ?>"><?php the_sub_field('local_phone_number'); ?></a></p>
                            <p><a href="<?php the_sub_field('directions_url'); ?>" target="_blank"><?php the_sub_field('address'); ?></a></p>
                        </div>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                </div>

                <div class="footer-spacer"></div>

                <div class="column-full">
                    <p class="disclaimer"><?php the_field('disclaimer','options'); ?></p>
                </div>
                <div class="footer-utility">
                    <div class="left">
                        <p>©<?php echo date('Y'); ?> Davis Law Group, All Rights Reserved.</p>
                        <?php if( have_rows('utility_links','options') ): ?>
                        <ul>
                        <?php while( have_rows('utility_links','options') ): the_row(); ?>  
                            <?php 
                            $link = get_sub_field('link');
                            if( $link ): 
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <li><a href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_title ); ?></a></li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                        </ul>
                        <?php endif; ?> 
                    </div>
                    <div class="right">
                        <a href="https://www.postali.com/">
                            <img src="https://www.postali.com/wp-content/themes/postali-site/img/postali-tag-reversed.png" alt="Postali | Results Driven Marketing">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</footer>

<script type="text/javascript" src="//cdn.callrail.com/companies/286722638/cf7b5e5bce46313a4dca/12/swap.js"></script> 

<?php wp_footer(); ?>

</body>
</html>


