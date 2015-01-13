/*
 * Tooltip script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
this.tooltip = function(){	
	/* CONFIG */		
		xOffset = -15;
		yOffset = -50;				
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result		
	/* END CONFIG */		
	$("a.tooltip").hover(function(e){											  
		this.t = this.title;
		this.title = "";									  
		$("body").append("<p id='tooltip'>"+ this.t +"</p>");
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");		
    },
	function(){
		this.title = this.t;		
		$("#tooltip").remove();
    });	
	$("a.tooltip").mousemove(function(e){
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};
// starting the script on page load
$(document).ready(function(){
	tooltip();
});




/*THIS IS USE FOR TOOLTIP SOCIABLE IN BLOG SINGLE PAGE*/

$(document).ready(function(){ 
	$(".bubble a img").hover(function() {
	$(this).next("em").stop(true, true).animate({opacity: "show", top: "-30"}, "slow");
	}, function() {
		$(this).next("em").animate({opacity: "hide", top: "-40"}, "fast");
	});
 
});