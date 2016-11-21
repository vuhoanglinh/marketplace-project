(function($){
	$(window).load(function(){
	$("#sCrolling").mCustomScrollbar1({
			scrollInertia:700,
			horizontalScroll:true,
			mouseWheelPixels:100,
			scrollButtons:{
				enable:true,
				scrollType:"pixels",
				scrollAmount:100
			}
		});	
	});
})(jQuery);

/*scroll*/

jQuery(document).ready(function() {
    function mycarousel_initCallback(carousel) {
        // Disable autoscrolling if the user clicks the prev or next button.
        carousel.buttonNext.bind('click', function() {
            carousel.startAuto(0);
        });

        carousel.buttonPrev.bind('click', function() {
            carousel.startAuto(0);
        });

        // Pause autoscrolling if the user moves with the cursor over the clip.
        carousel.clip.hover(function() {
            carousel.stopAuto();
        }, function() {
            carousel.startAuto();
        });
    };
    
  	if($('.rw-sroll-Hot').size() > 0) {
      jQuery('.rw-sroll-Hot').jcarousel({
    		//wrap: 'circular',
    		auto: 4,
    		wrap: 'circular',
    		scroll: 1,
    		//itemLoadCallback: itemLoadCallbackFunction
    		//initCallback: mycarousel_initCallback
    	});	
    }
    
});

$(document).ready(function() {
	tabs.init();
	$("ul.rw-img-pdNew li:nth-child(4n)").addClass("nonMargin");
	$("ul.rw-img-pdNew2 li:nth-child(even)").addClass("nonMargin");
});

/*hover tabs sub menu*/

tabs = {
  init : function(){
   $('.rw-tabs-cat').each(function(){

    var th=$(this),
     tContent=$('.tab-content',th),
     navA=$('.rw-cat-parent a',th)

    tContent.not(tContent.eq(0)).hide()

    navA.hover(function(){
     	var th=$(this),
      	tmp=th.attr('rel')
     	tContent.not($(tmp.slice(tmp.indexOf('#'))).fadeIn(500)).hide()
	 	$(th).parent().addClass('active').siblings().removeClass('active').find('span').stop().animate({opacity:'0'},600);	 	
    	return false;
    });
   });

  }
 }
