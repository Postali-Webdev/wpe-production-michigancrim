// Caroufredsel code
	jQuery(document).ready(function() {

	// Using default configuration as backup
	jQuery("#foo1").carouFredSel();
	
	// Using custom configuration
	jQuery("#practice_areas_carousel").carouFredSel({
		items : {
			visible: 4,
			height: 'variable'
		},
		width				: "100%",
		height				: "variable",
		responsive			: true,
		circular 			: true,
		infinite			: true, 
		scroll : {
			items			: 4,
			easing			: "swing",
			duration		: 800,							
			pauseOnHover	: true,
					height				: "variable"
		},
		prev : {
      		button : "#practice_areas_prev",
      		key : "left"
  		 },

  		next : { 
     		button : "#practice_areas_next",
      		key : "right"
  		 }		
	});	
	
});