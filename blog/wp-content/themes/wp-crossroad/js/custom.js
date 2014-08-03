
jQuery.noConflict()(function($){
	$(document).ready(function() {

	$('a[data-rel]').each(function() {
	    $(this).attr('rel', $(this).data('rel'));
	});		

		$("a[rel^='prettyPhoto']").prettyPhoto({
			animationSpeed: 'normal', /* fast/slow/normal */
			opacity: 0.80, /* Value between 0 and 1 */
			showTitle: true, /* true/false */
			theme:'light_square'
		});
		
		
	});
});

jQuery.noConflict()(function($){
	$(document).ready(function() {
		
			// Create the dropdown bases
			$("<select />").appendTo(".navigation");
				
			// Create default option "Go to..."
			$("<option />", {
			   "selected": "selected",
			   "value"   : "",
			   "text"    : "Go to..."
			}).appendTo(".navigation select");
				
				
			// Populate dropdowns with the first menu items
			$(".navigation li a").each(function() {
			 	var el = $(this);
			 	$("<option />", {
			     	"value"   : el.attr("href"),
			    	"text"    : el.text()
			 	}).appendTo(".navigation select");
			});
			
			//make responsive dropdown menu actually work			
	      	$(".navigation select").change(function() {
	        	window.location = $(this).find("option:selected").val();
	      	});
	      	
		});
		});


		
/***************************************************
			SuperFish Menu
***************************************************/	
// initialise plugins
	jQuery.noConflict()(function(){
		jQuery('ul.sf-menu').superfish({
			delay:400,
//			pathClass:  'current-menu-item',
//			speed: 'fast',
	        autoArrows:  true,                           // disable generation of arrow mark-up 
            dropShadows: false  			
//			animation:   {opacity:'show'}			
			
		});
		
	});


jQuery.noConflict()(function($){
	$(window).load(function() {
	
	var $window = $(window)
	// make code pretty
    window.prettyPrint && prettyPrint()
	
	});
});