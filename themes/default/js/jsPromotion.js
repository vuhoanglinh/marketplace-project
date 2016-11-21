function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

$(function() {
   // $('#btn_buy_outlet.enabled').payment();
});

function titleClick(obj) {
    $(obj).find(".minus").toggleClass("plus");
    $(obj).next().slideToggle("slow", "", function() { });
};

//$('#promotion_voucher').cycle({
//    fx: 'scrollLeft',
//    randomizeEffects: true,
//    speed: 2000,
//    timeout: 2000,
//    shuffle: { left: -300, top: 30 }
//});
//
//$('#promotion_weeklydeal').cycle({
//    fx: 'scrollRight',
//    speed: 2000,
//    timeout: 2000,
//    shuffle: { left: -300, top: 30 }
//});

$(document).ready(function() {

    $('.result_list li').hover(function() {
        $(this).find('.search_pro_color').stop().animate({ 'opacity': '1' });
        $(this).find('.search_pro_color li').stop().animate({ 'opacity': '1' });
    }, function() {
        $(this).find('.search_pro_color').stop().animate({ 'opacity': '0' });
        $(this).find('.search_pro_color li').stop().animate({ 'opacity': '0' });
    });



});

$(document).ready(function() {

    if (getCookie("search-filter") != undefined && getCookie("search-filter") != null && getCookie("search-filter") != '') {
        $(".search-filter").addClass(getCookie("search-filter"));
        $("#search-filter-explander-button").addClass(getCookie("search-filter-explander"));

    }
    //    $('.search_pro_color li a').hover(function() {
    //        $(this).parents('.search_pro').find('.search_pro_img').attr('src', $(this).attr('rel'));
    //    })

    $('.toggle_title').click(function() {
        $(this).find(".minus").toggleClass("plus");
        $(this).next().slideToggle("slow", "", function() {

        });
        $(this).next().next().slideToggle("slow", "", function() {

        });
    });

    $('.search-checklist').each(function() {

        if ($(this).children('li').size() > 4 && !$(this).hasClass('search_color'))
            $(this).parent().prev().find('.bullist').show();
        else
            $(this).parent().prev().find('.bullist').hide();

        if ($(this).hasClass('search_color')) {
            if ($(this).children('li').size() > 8)
                $(this).parent().prev().find('.bullist').show();
            else
                $(this).parent().prev().find('.bullist').hide();
        }
    });

    var pathname = window.location.pathname;
    var isPageKhuyenMai = false;
    if (endsWith(pathname, "khuyen-mai/") || endsWith(pathname, "khuyen-mai/default.aspx"))
        isPageKhuyenMai = true;
    if (isPageKhuyenMai) {
        $('#filter_con_clear').attr('href', '/khuyen-mai/');
    }

});


function explanderClick() {
    toggle();
}
function toggle() {
    $(".search-filter").toggleClass("search-filter-more");
    $("#search-filter-explander-button").toggleClass("search-filter-explander-button-down");
    setCookie("search-filter", $(".search-filter").attr('class'), 1);
    setCookie("search-filter-explander", $("#search-filter-explander-button").attr('class'), 1);
};
function toggleClick(obj) {
    $('#' + obj).find(".bullist").toggleClass("bullistdown");
    $('#' + obj).next().toggleClass('togglecontent-more');
    $(".search-filter").addClass('search-filter-more');
    $("#search-filter-explander-button").addClass("search-filter-explander-button-down");
};

$(document).ready(function() {
    $("#divMoreCategories").click(function(e) {

        var temp = $(this).offset();
        var x = temp.left; // - this.offsetLeft;
        var y = temp.top; // - this.offsetTop;

        $("#divCategoriesNext").css("left", x + 71);
        $("#divCategoriesNext").css("top", y - 20);
        $("#divCategoriesNext").css("z-index", 101);
        $("#divCategoriesNext").toggle("fast");
    });
   
  

});

function CloseBoxNav(control) {
    document.getElementById(control).style.display = 'none';
}

//Ajax loading page Begin

//$(function() {
//    var isLoading = false;
//    var loadingAllow = true;
//
//    EndRequestChonUpdate();
//
//    $(window).scroll(function() {
//        if ($(window).scrollTop() >= $(document).height() - $(window).height() - 300) {
//            if (!isLoading && loadingAllow)
//                lastPostFunc();
//        }
//
//    });
//
//
//
//    function lastPostFunc() {
//
//        var ulClass = ".result_list";
//        var pagename = "ViewImagePromotion";
//        var url = document.location.pathname;
//        var Folder = "V3Promotion";
//       
//
//      
//        if (url.indexOf("the-cao") > 0) {
//            Folder = "V3Promotion";
//
//        }
//        if (url.indexOf("khuyen-mai") > 0) {
//            Folder = "V3Promotion";
//            pagename = "ViewImagePromotion";
//           
//            //            if (!$("#view_by_img").hasClass("view_by_active")) {
//            //                pagename = "ViewContentPromotion";
//            //                
//            //            }
//
//        }
//     
//        isLoading = true;
//        var page = $('.search_pro_img:last').attr('page');
//        if (page == '' || page == undefined) page = 1;
//        page++;
//
//        var liPageLoading = '<li id="li_' + (page) + '" class="page" style="margin-left:280px;float:left;width:250px;display:block">'
//                + '<font color="#aaaaaa">Đang tải trang ' + (page) + '   </font>&nbsp;&nbsp;'
//                + '<img width="65px" src="/files/themes/Default/v3/css/images/loading_gif.gif"/></li>';
//
//        if (loadingAllow)
//            $(ulClass).append(liPageLoading);
//        var url = '/Files/Themes/Default/UserControls/' + Folder + '/' + pagename + '.aspx?' + $('#hfSearchUrlQuery').val() + '&pagesize=32&total=' + $(TotalRow).val();
//        url = ReplaceAll(url, '?&', '?');
//
//        $.get(url + '&page=' + (page),
//
//                    function(data) {
//                        if (data.indexOf('Không còn sản phẩm') >= 0) {
//                            loadingAllow = false;
//                            $('#li_' + (page)).html('');
//
//                        }
//                        else {
//                            $('#li_' + (page)).html('<strong>Trang ' + (page) + '</strong>');
//
//                            $(ulClass).append(data);
//                        }
//                        isLoading = false;
//                        EndRequestChonUpdate();
//
//                    });
//    };
//
//});
//Ajax loading page End


function getQuerystring(url, key, default_) {
    if (default_ == null) default_ = "";
    key = key.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + key + "=([^&#]*)");
    var qs = regex.exec(url);
    if (qs == null)
        return default_;
    else
        return qs[1];
}
function ChangeStyleSort() {
    var pathname = window.location.pathname;
    var isPageKhuyenMai = false;
    if (endsWith(pathname, "khuyen-mai/") || endsWith(pathname, "khuyen-mai/default.aspx"))
        isPageKhuyenMai = true;

    if (getQuerystring(window.location.href, "sort", "") != "")
        $('.sorter[rel=' + getQuerystring(window.location.href, "sort", "") + ']').addClass('active');
    else if (isPageKhuyenMai == true)
        $('#favourite').addClass('active');
    else
        $('#promotionhighest').addClass('active');

    $('.sorter').click(function() {
  
        $('.sorter').siblings().removeClass('active');
        $(this).addClass('active');
        setCookie("sort", $(this).attr('rel'), 1);
        var href = window.location.href.replace("#content", "");
       
        if (getQuerystring(href, "sort", "") == "") {
           
            href = (href + (href.indexOf("?") > -1 ? "&sort=" + $(this).attr('rel') : "?sort=" + $(this).attr('rel'))).replace("?&", "?");
        }
        else {
           
            href = (href.replace("sort=" + getQuerystring(href, "sort", ""), "sort=" + $(this).attr('rel'))).replace("?&", "?");
            
        }
//        if (isPageKhuyenMai == true) {
//            href = href.replace("?sort=promotionhighest", "");
//            href = href.replace("&sort=promotionhighest", "");
//            href = href.replace("?cb=1", "");
//            href = href.replace("&cb=1", "");
//        }
     
        window.location.href = href;
    });

}

function EndRequestChonUpdate() {

    ChangeStyleSort();
    $(".buy_btn").each(function() {

        if ($(this).html().indexOf("Hết hàng") > 0) {
            $(this).unbind('click');
        } else {
           // $(this).payment({ autoPaymode: true });
        }
    });


    GMagicImages.MagicHoverImg();
}