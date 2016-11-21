jQuery(function($) {
    if (!$.browser.msie || parseInt($.browser.version, 10) > 6) {

        $('.s_item').css('display', 'block')
					.hover(
					  function() {
					      $(this).find('.treding_hide').stop().css('display', 'block');
					      $(this).find('.css3button').each(function() {
					          if ($(this).attr('stock') == '1')
					              $(this).stop().css('display', 'block');
					      });
					  },
					  function() {
					      $(this).find('.treding_hide').stop().css('display', 'none');
					      $(this).find('.css3button').stop().css('display', 'none');
					  }
				  );
    }
});


$(document).ready(function() {
    $('.color').hover(function() {

        $(this).parent().parent().parent().parent().find('.figure').find('.search_pro_img[rel=' + $(this).attr('rel') + ']').attr('active', '');
        $(this).parent().parent().parent().parent().find('.figure').find('.search_pro_img').each(function() { $(this).hide(); });
        $(this).parent().parent().parent().parent().find('.figure').find('.search_pro_img[rel=' + $(this).attr('rel') + ']').show();

        $(this).parent().parent().parent().find('.treding_Thumbnail').find('li').each(function() { $(this).hide(); });

        $(this).parent().parent().parent().find('.treding_Thumbnail').find('li[rel=' + $(this).attr('rel') + ']').show();


    });

    $('.thumb').hover(function() {

        var srcImage = $(this).attr('src');
        srcImage = srcImage.replace("&width=38&height=53", "");
        $(this).parent().parent().parent().parent().parent().parent().find('.figure').find('.search_pro_img[rel=' + $(this).attr('rel') + ']').attr('src', srcImage + '&width=230&height=261');
    });
//    $('.treding_hide').click(function() {
//        window.location.href = $(this).attr('rel');

//    });


});
