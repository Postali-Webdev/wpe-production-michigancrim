<?php global $qode_options_passage; ?>
				
		</div>
	</div>
		<footer>
		<!-- <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,700,800%7COpen+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300%7CSource+Sans+Pro:200,300,400%7CLato%7CYanone+Kaffeesatz:300,400,700,800%7CTeko:400,500,600,700%7CRoboto:300,400%7CFjalla+One%7CTeko:500" rel="stylesheet"> -->
		<!-- <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,700,800%7COpen+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300%7CSource+Sans+Pro:200,300,400%7CLato%7CYanone+Kaffeesatz:300,400,700,800%7CTeko:400,500,600,700%7CFjalla+One%7CTeko:500" rel="stylesheet"> -->
		<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,700,800%7COpen+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300%7CSource+Sans+Pro:200,300,400%7CLato%7CYanone+Kaffeesatz:300,400,700,800%7CFjalla+One%7CTeko:500" rel="stylesheet">
		
			
        <section class="textpanel footer-maps">
            <div class="container_inner">
                <div class="four_columns">
                <?php if(get_field('detroit_address','options')) { ?>
                    <div class="column1">
                        <p><strong>Detroit</strong><br><?php the_field('detroit_address','options'); ?></p>
                        <div class="map">
                            <iframe src="<?php the_field('detroit_map_iframe','options'); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                <?php } ?>

                <?php if(get_field('filnt_address','options')) { ?>
                    <div class="column2">
                        <p><strong>Flint</strong><br><?php the_field('filnt_address','options'); ?></p>
                        <div class="map">
                            <iframe src="<?php the_field('flint_map_iframe','options'); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                <?php } ?>

                <?php if(get_field('port_huron_address','options')) { ?>
                    <div class="column3">
                        <p><strong>Port Huron</strong><br><?php the_field('port_huron_address','options'); ?></p>
                        <div class="map">
                            <iframe src="<?php the_field('port_huron_map_iframe','options'); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                <?php } ?>

                <?php if(get_field('southfield_address','options')) { ?>
                    <div class="column4">
                        <p><strong>Southfield</strong><br><?php the_field('southfield_address','options'); ?></p>
                        <div class="map">
                            <iframe src="<?php the_field('southfield_map_iframe','options'); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </section>
        
        
        
        
        <div class="footer_holder clearfix">
				
					
						<?php	
						$display_footer_widget = false;
						if ($qode_options_passage['footer_widget_area'] == "yes") $display_footer_widget = true;
						if($display_footer_widget): ?> 
						<div class="footer_top_holder">
							<div class="footer_top">
								
								
									<?php
										$header_in_grid = false;
										if ($qode_options_passage['header_in_grid'] == "yes") $header_in_grid = true;

									?>
									

										<div class="container">
											<div class="container_inner clearfix">

									<div class="footer_top_inner">                                                               
										<div class="two_columns_50_50 clearfix">
											<div class="column1">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_1' ); ?>
												</div>
											</div>
                                            
											<div class="column2"> 
                                                                                       
                                            <div class="two_columns_50_50 clearfix">
                                            
											<div class="column1">
												<div class="column_inner">
                                                <!-- <i class="wp-svg-custom-link link link-icon"></i> -->
                                                <i class="link link-icon"></i>
													<?php dynamic_sidebar( 'footer_column_2' ); ?>
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
                                                <i class="wp-svg-custom-hammer2 hammer2"></i>
													<?php dynamic_sidebar( 'footer_column_3' ); ?>
												</div>
											</div></div>
                                            
                                         </div></div>
								</div>

										</div>


							</div>
						</div>
						<?php endif; ?>
						
						<?php
						$display_footer_text = false;
						if (isset($qode_options_passage['footer_text'])) {
							if ($qode_options_passage['footer_text'] == "yes") $display_footer_text = true;
						}
						if($display_footer_text): ?>
						<div class="footer_bottom_holder">
							<div class="footer_bottom" style="height:auto !important;">
                            	<div class="container_inner">
								<?php dynamic_sidebar( 'footer_text' ); ?>
								</div>
                            </div>
						</div>
						<?php endif; ?>
			</div>
            </div>


		</footer>
</div>
<!-- Callrail -->
<script type="text/javascript" src="//cdn.callrail.com/companies/283970016/03591dc1bf8d8b457054/12/swap.js"></script> 
<!-- Intaker Chat -->
<script>(function (w,d,s,v,odl){(w[v]=w[v]||{})['odl']=odl;;
var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async=true;
j.src='https://intaker.azureedge.net/widget/chat.min.js';
f.parentNode.insertBefore(j,f);
})(window, document, 'script','Intaker', 'davislawgroup');
</script>
<?php
global $qode_toolbar;
if(isset($qode_toolbar)) include("toolbar.php")
?>
	<?php wp_footer(); ?>
	
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>	 -->

<script type="text/javascript">
jQuery(document).ready(function () {

	// styles to convert left menus to dropdowns on mobile
if (jQuery(window).width() <= 768) {      
    jQuery(function(){
jQuery('ul.menu').each(function()
{
   var select=jQuery(document.createElement('select')).insertBefore(jQuery(this).hide());
   jQuery('>li a', this).each(function()
   { 
 option=jQuery(document.createElement('option')).appendTo(select).val(this.href).html(jQuery(this).html());
   });
   select.change(function(){
    //alert('url = ' + this.value );
    window.location.href = this.value;
  })
});
})
} 
else {
}

});
</script>

</body>
</html>