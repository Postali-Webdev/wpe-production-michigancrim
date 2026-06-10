<section class="map-block">
    <div class="container">
        <div class="columns">
            <div class="column-50 block">
                <p class="caps yellow small spaced condensed">location</p>
                <h2>Criminal Law Office in <?php echo $GLOBALS['location_name']; ?>, MI</h2>

                <p><?php echo $GLOBALS['location_copy']; ?></p>

                <p class="phone"><a href="tel:<?php echo $GLOBALS['location_phone']; ?>"><?php echo $GLOBALS['location_phone']; ?></a></p>
                <p class="address"><?php echo $GLOBALS['location_address']; ?></p>

            </div>
            <div class="column-50">
                <iframe src="<?php echo $GLOBALS['location_map']; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>