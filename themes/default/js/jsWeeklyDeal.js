$(document).ready(function() {
    //$('.medium_green_black.enabled').payment();
    $(".outlets li").hover(function() {
        $(this).find('.outlet_date_info').stop().animate({ 'bottom': '90px' });
    }, function() {
        $(this).find('.outlet_date_info').stop().animate({ 'bottom': '44px' });
    }) 
 });

$(document).ready(function() {
   $("#slide-cat").cycle({
        fx: 'scrollHorz',
            speed: 1000,
            pause: 1,
            delay: 3000
            
    }); 
});