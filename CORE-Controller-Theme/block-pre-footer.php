    <?php 
         $bg_image = get_field('pf_bg_img','options');
    ?>
    
    <section id="pre-footer" style="background-image:url(<?php echo $bg_image; ?>);">
        <div class="container">
            <div class="columns">
                <div class="column-50 block footer-content">
                    <h2><?php the_field('pf_headline','options'); ?></h2>
                    <p><?php the_field('pf_copy','options'); ?></p>
                    <div class="spacer-15"></div>
                    <a href="tel:<?php echo $GLOBALS['phone']; ?>" class="btn" title="Call today">Call <?php echo $GLOBALS['phone']; ?> today</a>
                </div>
                <div class="column-33">
                    <?php echo do_shortcode( get_field('pf_form_shortcode','options') ); ?>
                </div>
            </div>
        </div>
    </section>