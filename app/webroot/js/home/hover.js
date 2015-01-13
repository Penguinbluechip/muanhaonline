$(document).ready(function(){			 
	//Set opacity on each span to 0%
	$(".rollover").css({'opacity':'0'});
	$(".rollover-video").css({'opacity':'0'});
	$(".pover").css({'opacity':'0'});
	$(".vover").css({'opacity':'0'});
 
	$('ul a').hover(
		function() {
			$(this).find('.rollover').stop().fadeTo(500, 0.5);
		},
		function() {
			$(this).find('.rollover').stop().fadeTo(500, 0);
		}
	)
	
	$('ul a').hover(
		function() {
			$(this).find('.rollover-video').stop().fadeTo(500, 0.5);
		},
		function() {
			$(this).find('.rollover-video').stop().fadeTo(500, 0);
		}
	)
	
	$('ul a').hover(
		function() {
			$(this).find('.pover').stop().fadeTo(500, 0.5);
		},
		function() {
			$(this).find('.pover').stop().fadeTo(500, 0);
		}
	)
	
	$('ul a').hover(
		function() {
			$(this).find('.vover').stop().fadeTo(500, 0.5);
		},
		function() {
			$(this).find('.vover').stop().fadeTo(500, 0);
		}
	)
 
});		