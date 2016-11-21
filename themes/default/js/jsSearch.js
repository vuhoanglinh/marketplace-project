/* Hover Load Images 
Author : Gia.Le 
DateCreated : 02/04/2012
Project : Chon.vn

*/
var cacheData = Array();
var GMagicImages = (function() {

    return {
        init: function() {

        },
        MagicLoadData: function() {

            $('.fadeIn').mouseover(function() {

                var fade = $(this);
                var item = $(this).next('.contentimage');
                var key = $(item).attr('rel') + "__" + $(item).attr('color');
                if (cacheData[key] == undefined || cacheData[key] == null) {
                    $.ajax({ url: '/files/themes/default/usercontrols/search/MultiImages.aspx', data: { id: $(item).attr('rel'), color: $(item).attr('color') }
                            , contentType: "application/html; charset=utf-8"
                            , dataType: "html"
                            , success: function(data) {
                                item.toggle('fast');
                                item.html('');


                                item.append($(data).find('.contentimage').html());
                                item.toggle('fast');
                                cacheData[key] = $(data).find('.contentimage').html();
                                GMagicImages.MagicHoverImg();
                            },

                        error: function() {

                        }
                    });

                } else
                    $(fade).fadeOut(500);
            });
            //            $('.contentimage').mouseover(function() {

            $('#ulColors li a').click(function() {

                var item = $(this).parent().parent().parent().parent().parent().find('.contentimage');
                var fadeIn = $(this).parent().parent().parent().parent().parent().find('.fadeIn');
                item.attr('rel', $(this).find('img').attr('parentid')).attr('color', $(this).find('img').attr('color'));

                var key = $(this).find('img').attr('parentid') + "__" + $(this).find('img').attr('color');
                if (cacheData[key] == undefined || cacheData[key] == null) {
                    $.ajax({ url: '/files/themes/default/usercontrols/search/MultiImages.aspx', data: { id: $(this).find('img').attr('parentid'), color: $(this).find('img').attr('color') }
                        , success: function(data) {
                            item.html('');
                            item.append($(data).find('.contentimage').html());
                            fadeIn.html('');
                            fadeIn.append($(data).find('.contentimage').html());
                            cacheData[key] = $(data).find('.contentimage').html();
                            GMagicImages.MagicHoverImg();

                        }
                    });

                } else {
                    item.html('');
                    item.append(cacheData[key]);
                    GMagicImages.MagicHoverImg();
                }



            });


        },

        MagicHoverImg: function() {

            $('.search_pro_img').mouseover(function(e) {

                var count = $(this).attr('count');

                if (count >= 2) {
                    var width = $(this).width();
                    var height = $(this).height();
                    var offset = $(this).offset();
                    var x = e.pageX - offset.left;
                    var y = e.pageY - offset.top;
                    $('#width').val(width);
                    $('#height').val(height);
                    $('#px').val(x);
                    $('#py').val(y);
                    $('#count').val(count);
                    var position = GMagicImages.position(width, height, x, y, count);

                    var rel = $(this).attr('rel' + position);
                    if (rel != null && rel != undefined && rel != '') {

                        $(this).attr('src', rel);
                    }
                    $('#postionMagic').val(position);
                }


            });
            $('.search_pro_img').mousemove(function(e) {

                var count = $(this).attr('count');
                if (count >= 2) {
                    var width = $(this).width();
                    var height = $(this).height();
                    var offset = $(this).offset();
                    var x = e.pageX - offset.left;
                    var y = e.pageY - offset.top;

                    $('#width').val(width);
                    $('#height').val(height);
                    $('#px').val(x);
                    $('#py').val(y);
                    $('#count').val(count);

                    var position = GMagicImages.position(width, height, x, y, count);
                    var rel = $(this).attr('rel' + position);
                    if (rel != null && rel != undefined && rel != '')
                        $(this).attr('src', rel);
                }

            });

            $('.box-color').hover(function() {
              
                $(this).parent().parent().parent().parent().find('.figure2').find('.search_pro_img[rel=' + $(this).attr('rel') + ']').attr('active', '');
                $(this).parent().parent().parent().parent().find('.figure2').find('.search_pro_img').each(function() { $(this).hide(); });
                $(this).parent().parent().parent().parent().find('.figure2').find('.search_pro_img[rel=' + $(this).attr('rel') + ']').show();

              
                $(this).parent().find('.box-color').removeClass('active');
                $(this).addClass('active');

                $(this).parent().parent().parent().find('.figure1').find('.search_pro_img').each(function() { $(this).hide(); });
                $(this).parent().parent().parent().find('.figure1').find('.search_pro_img[rel=' + $(this).attr('rel') + ']').show();
                $(this).parent().find('.box-color').removeClass('active');
                $(this).addClass('active');
            });



        },
        position: function(width, height, x, y, n) {
            var c = n;
            /*for (var stt = 2; stt < 8; stt++) {
            if (stt * stt >= n) {
            c = stt;
            break;
            }
            }
            */


            var d = parseInt(n / c);
            var col, row;
            if (n % c != 0)
                d += 1;
            var mheight = parseInt(height / d);
            var mwidth = parseInt(width / c);
            for (var i = c - 1; i >= 0; i--) {
                if (mwidth * i < x) {
                    col = i + 1;
                    break;
                }
            }
            for (var j = d - 1; j >= 0; j--) {
                if (mheight * j < y) {
                    row = j + 1;
                    break;
                }
            }
            var result = (row - 1) * c + col;

            return result;

        }

    };

})();

﻿function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

$(document).ready(function() {
    $("a[rel^='prettyPhoto']").prettyPhoto({
        theme: 'pp_default',
        showTitle: false,
        deeplinking: false,
        animationSpeed: 'fast' /* fast/slow/normal */

    });


});

$(document).ready(function() {
   
        $('.result_list li').hover(function() {
            $(this).find('.search_pro_color').stop().animate({ 'opacity': '1' });
            $(this).find('.search_pro_color li').stop().animate({ 'opacity': '1' });
        }, function() {
            $(this).find('.search_pro_color').stop().animate({ 'opacity': '0' });
            $(this).find('.search_pro_color li').stop().animate({ 'opacity': '0' });
        });

      
   
});
/* search-filter-explander-button V3 SearchResultManager */
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
/* xem them V3LeftCat */
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
    /* xem them V3LeftManu */
    $("#divMoreManufacturers").click(function(e) {

        var temp = $(this).offset();
        var x = temp.left; // - this.offsetLeft;
        var y = temp.top; // - this.offsetTop;

        $("#divManufacturersNext").css("left", x + 71); //425   342
        $("#divManufacturersNext").css("top", y - 65); //1469.83 1539
        $("#divManufacturersNext").css("z-index", 101);

        $("#divManufacturersNext").toggle("fast");
    });

});

function CloseBoxNav(control) {
    document.getElementById(control).style.display = 'none';
}

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

function locdau(str) {
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");

    str = str.replace(/-+-/g, "-");
    str = str.replace(/^\-+|\-+$/g, "");

    return str;
}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    return vars;
}

function ReplaceAll(Source, stringToFind, stringToReplace) {

    var temp = Source;

    var index = temp.indexOf(stringToFind);

    while (index != -1) {

        temp = temp.replace(stringToFind, stringToReplace);

        index = temp.indexOf(stringToFind);

    }

    return temp;

}


function setCookie(c_name, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}
function getCookie(c_name) {
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {
            return unescape(y);
        }
    }
}

function GetSortExpress(sort) {
    window.location.href = "/tim-kiem.aspx?sort=" + sort;

}
/* autocompleted */
$(document).ready(function() {
    $(txtQueryLeft).keypress(function(e) {
        if (e.keyCode == 13) {
            doSearch2();
        }
    });
});

function doSearch2() {
    var searchUrl = window.location.toString();  //location.pathname + "?";
    
    var queryText = $(txtQueryLeft).val();
    var queyTextSign = queryText;
    if (queryText.indexOf("'") > 0) {
        queyTextSign = queryTextNotVN;
    }
    var param = "";
    var strReturn = "";
    var arrReturn = "";
    var queryTextNotVN = locdau(queryText);
    $.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: "/Services/BiddingService.asmx/GetBrandOrCategoryByID",
        dataType: "json",
        data: "{QueryText:'" + queryTextNotVN + "',QueryTextSign:'" + queyTextSign + "'}",
        async: false,
        success: function(msg) {
            strReturn = msg.d;
            arrReturn = strReturn.split("$");
            for (var i = 0; i < arrReturn.length - 1; i++) {
                if (arrReturn[0] == "1")
                    param =  "brand=" + encodeURIComponent(queryText);
                if (arrReturn[0] == "0")
                    param =  "catid=" + encodeURIComponent(arrReturn[1]);
                if (arrReturn[0] == "2")
                    param =  "q=" + encodeURIComponent(queryText);
                //break;
            }
        },
        error: function(xmlHttpRequest, status, err) {
        }

    });
    if (searchUrl.indexOf('&')>0)
        param = "&" + param;
    else
        param = "?" + param;
    window.location.href = searchUrl + param;
    return false;


}
var QuerySearch = "";
var prefixText = "";
$(function() {
    $(txtQueryLeft).autocomplete({
        source: function(request, response) {

            var querytextNotVN = locdau(request.term);
            if (request.term.indexOf("'") > 0)
                prefixText = trim(querytextNotVN);
            else
                prefixText = trim(request.term);
            $.ajax({
                url: "/Services/AutoCompleteV2.asmx/GetCompletionList",
                data: "{ 'prefixText': '" + prefixText + "','CategoryID':'0','prefixTextNoSign':'" + querytextNotVN + "'}",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                dataFilter: function(data) { return data; },
                success: function(data) {
                    response($.map(data.d, function(item) {
                        return {
                            label: item.Price ? "<div style='font-size:12px;cursor:pointer'>"
                                                 + item.SearchText
                                                    + "<span style='font-size:10px;color:red;font-style:italic'> trong </span>" + item.Title
                                                    + " &nbsp;&nbsp;<span style='float:right;font-size:11px;color:red'> Giá: <span style='font-weight:bold;color:#488BDA;font-size:11px'>" + item.Price + "</span></span>"
                                                + "</div>"
                                                :
                                                item.Flag == 5 ? "<div style='font-size:12px;cursor:pointer'>"
                                                    + item.SearchText
                                                    + "<span style='font-size:10px;color:red;font-style:italic'> trong </span>" + "Thương hiệu " + item.Title
                                                + "</div>"
                                                : "<div style='font-size:12px;cursor:pointer'>"
                                                    + item.SearchText
                                                    + "<span style='font-size:10px;color:red;font-style:italic'> trong </span>" + item.Title
                                                + "</div>",
                            value: item.Flag == 5 ? "Thương hiệu " + item.Title : item.Title,
                            url: item.Flag == 1 ? "/tim-kiem.aspx?catid=" + item.AutoID : item.Flag == 2 ? "/tim-kiem.aspx?catid=" + item.AutoID + "&brand=" + item.ManufacturerName
                                            : item.Flag == 0 ? "/tim-kiem.aspx?q=" + encodeURIComponent(item.Title) : item.Flag == 3 ? "/tim-kiem.aspx?q=" + encodeURIComponent(item.Title) + "&catid=" + categoryAutoID
                                            : item.Flag == 4 || 5 ? "/tim-kiem.aspx?brand=" + item.Title
                                            : ""
                        }
                    }))
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                }
            });
        },
        select: function(event, ui) {
            window.location.href = ui.item.url;
            QuerySearch = ui.item.url;
        },
        minLength: 2
    })
       .keypress(function(e) {
           if (e.keyCode == 13) {
               if (QuerySearch != "") {
                   window.location.href = QuerySearch;
               }
           }
       })
});
/* addFavourite */
function ChangeStyleSort() {
    var pathname = window.location.pathname;
    var isPageKhuyenMai = false;
    if (endsWith(pathname, "khuyen-mai/") || endsWith(pathname, "khuyen-mai/default.aspx"))
        isPageKhuyenMai = true;
    
    if (getQuerystring(window.location.href, "sort", "") != "")
        $('.sorter[rel=' + getQuerystring(window.location.href, "sort", "") + ']').addClass('active');
    else if (isPageKhuyenMai == true)
        $('#promotionhighest').addClass('active');
    else
        $('#sortnew').addClass('active');

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
        if (isPageKhuyenMai == true) {
            href = href.replace("?sort=promotionhighest", "");
            href = href.replace("&sort=promotionhighest", "");
            href = href.replace("?cb=1", "");
            href = href.replace("&cb=1", "");
        }
        window.location.href = href;
    });

}

function addFavourite(productid) {
  
    if ($('#liked' + productid).hasClass('dislike '+productid)) {
        return;
    } else {
        var mode = 'addfavourite';
        var rs = $.ajax({
            type: "POST",
            url: "/nguoi-dung/Nguoi-dung-thich-san-pham.aspx",
            data: "mode=" + mode + "&productid=" + productid,
            async: false,
            beforeSend: function() {
            },
            success: function(html) {
            $("#liked" + productid).removeClass("like " + productid);

            $("#liked" + productid).addClass("dislike " + productid);
               
            }, error: function(html) { }
        }).responseText;

        if (rs != '' & rs != 'undefined' & rs != null & rs != NaN & rs != 'NaN') {
            var arr = rs.split("|");
            if (arr[0].replace(/\s/g, "") == "True") {
                var gestcount = $('#contentLike' + productid).html();
                var gestcountnew = parseInt(gestcount) + 1;
                if (gestcountnew != 'NaN') {
                    $('#contentLike' + productid).html(gestcountnew);
                }

            }
        }
      

    }
}
/* search result */

var cacheData = Array();

$(function() {
    $(ddProductItem).change(function() {
       // ChangeView($(this).val())
    });
    CheckResult();

});

function CheckResult() {

    if ($(lblTotalProduct).html() == "0") {
        $("#view_sort").attr('style', 'display:none');
        $("#view_con").attr('style', 'display:none');
    }
}
$(function() {
    var isLoading = false;
    var loadingAllow = true;

    EndRequestChonUpdate();

    $(window).scroll(function() {
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - 300) {
            if (!isLoading && loadingAllow)
                lastPostFunc();
        }

    });



    function lastPostFunc() {

        var ulClass = ".result_list";
        var pagename = "ViewByImage";
        var url = document.location.pathname;
        var Folder = "V3Search";
        if (!$("#view_by_img").hasClass("view_by_active")) {
            ulClass = ".result_list_content";
            pagename = "ViewByContent";

        }

        var Folder = "V3Search";
        if (url.indexOf("the-cao") > 0) {
            Folder = "V3Promotion";

        }
//        if (url.indexOf("khuyen-mai") > 0) {
//            Folder = "V3Promotion";
//            pagename = "ViewImagePromotion";
           
//            if (!$("#view_by_img").hasClass("view_by_active")) {
//                pagename = "ViewContentPromotion";
//                
//            }

//        }
//        if (url.indexOf("san-pham-lua-chon") > 0) {
//            Folder = "V3Search";
//            pagename = "V3ViewChooseProductbyImage";
//            if (!$("#view_by_img").hasClass("view_by_active")) {
//                pagename = "V3ViewChooseProductByContent";
//            }
//        }
        isLoading = true;
        var page = $('.search_pro_img:last').attr('page');
        if (page == '' || page == undefined) page = 1;
        page++;

        var liPageLoading = '<li id="li_' + (page) + '" class="page" style="margin-left:280px;float:left;width:250px;display:block">'
                + '<font color="#aaaaaa">Đang tải trang ' + (page) + '   </font>&nbsp;&nbsp;'
                + '<img width="65px" src="/files/themes/Default/v3/css/images/loading_gif.gif"/></li>';

        if (loadingAllow)
            $(ulClass).append(liPageLoading);
        var url = '/Files/Themes/Default/UserControls/' + Folder + '/' + pagename + '.aspx?' + $('#hfSearchUrlQuery').val() + '&pagesize=32&total=' + $(TotalRow).val();
        url = ReplaceAll(url, '?&', '?');

        $.get(url + '&page=' + (page),

                    function(data) {
                        if (data.indexOf('Không còn sản phẩm') >= 0) {
                            loadingAllow = false;
                            $('#li_' + (page)).html('');

                        }
                        else {
                            $('#li_' + (page)).html('<strong>Trang ' + (page) + '</strong>');

                            $(ulClass).append(data);
                        }
                        isLoading = false;
                        EndRequestChonUpdate();

                    });
    };

});

function EndRequestChonUpdate() {

    ChangeStyleSort();
    $(".buy_btn").each(function() {

        if ($(this).html().indexOf("Hết hàng") > 0) {
            $(this).unbind('click');
        } else {
            $(this).payment({ autoPaymode: true });
        }
    });


    GMagicImages.MagicHoverImg();
}
function LoadProduct() {
    var page = $('.search_pro_img:last').attr('page');
    if ($("#view_by_img").hasClass("view_by_active")) {
       
        $("#list_product:first").removeClass("result_list_content");
        $("#list_product:first").addClass("result_list");
        $("#list_product:first li").each(function() {
            if ($(this).hasClass("viewcontent"))
                $(this).attr('style', 'display:none')
            if ($(this).hasClass(" viewimage"))
                $(this).attr('style', 'display:block');
        });
        $("#ViewByContentForm1").remove();
        for (var a = 0; a <= page; a++) {
            $("#li_" + a).remove();
        }
    }

    else {
        $("#list_product:first").removeClass("result_list");
        $("#list_product:first").addClass("result_list_content");
        $("#list_product:first li").each(function() {
        if ($(this).hasClass("viewcontent"))
            $(this).attr('style', 'display:block')
        if ($(this).hasClass(" viewimage"))
            $(this).attr('style', 'display:none');

        });
        $("#ViewByImageForm1").remove();
        for (var a = 0; a <= page; a++) {
            $("#li_" + a).remove();
        }
    }
}
function pageLoad(sender, eventArgs) {
    var display = getCookie("display");

    if (display == '2') {
        $('#view_by_img').removeClass('view_by_active');
        $('#view_by_content').addClass('view_by_active');
    }
    else {
        $('#view_by_content').removeClass('view_by_active');
        $('#view_by_img').addClass('view_by_active');
    }
    LoadProduct();

}

function SelectDivImg(e) {

    $('#view_by_content').removeClass('view_by_active');
    $(e).addClass('view_by_active');
    LoadProduct();
    setCookie("display", '1', 1);

}

function SelectDivContent(e) {

    $('#view_by_img').removeClass('view_by_active');
    $(e).addClass('view_by_active');

    LoadProduct();
    setCookie("display", '2', 1);

}

function ChangeView(pagesize) {
    var ulClass = "result_list";
    var pagename = "ViewByImage";

    if (!$("#view_by_img").hasClass("view_by_active")) {
        ulClass = "result_list_content";
        pagename = "ViewByContent";
    }
    var url = document.location.pathname;
      var Folder = "V3Search";
       if (url.indexOf("the-cao") > 0)
            Folder = "V3Promotion";


        $("#list_product").attr('class', ulClass);
        var url = '/Files/Themes/Default/UserControls/' + Folder + '/' + pagename + '.aspx?' + $('#hfSearchUrlQuery').val();

    url = ReplaceAll(url, '?&', '?');
    $.get(url + '&pagesize=' + pagesize,

                    function(data) {

                        $("#list_product").html("");
                        $("#list_product").append(data);

                        EndRequestChonUpdate();
                    });

                }


﻿

function CustomizeDataPager(id) {   
    if ($(id).children("li").length == 0) {

        $(id).find('a').each(function(index, value) {
            var newNode;
            if ($(this).text() == "<<") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="pre_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="pre_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }

                $(this).replaceWith(newNode);

            }
            else if ($(this).text() == ">>") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="next_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="next_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else {
                newNode = '<li> <a href="' + value + '">' + $(this).text() + '</a></li>'
                $(this).replaceWith(newNode);
            }
        });
        var el = $(id).find('span');
        var curNode = '<li class="active"> <a href="#">' + $(el).text() + '</a></li>';
        $(el).replaceWith(curNode);
    }
}
function CustomizeDataPager2(id) {
    if ($(id).children("li").length == 0) {
        $(id).find('a').each(function(index, value) {
            var newNode;
            if ($(this).text() == "<<") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="pre_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="pre_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else if ($(this).text() == ">>") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="next_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="next_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else {
                newNode = '<li> <a href="' + value + '">' + $(this).text() + '</a></li>'
                $(this).replaceWith(newNode);
            }
        });
        var el = $(id).find('span');
        var curNode = '<li class="active"> <a href="#">' + $(el).text() + '</a></li>';
        $(el).replaceWith(curNode);
    }
}
function CustomizeDataPager3(id) {
    if ($(id).children("li").length == 0) {
        $(id).find('a').each(function(index, value) {
            var newNode;
            if ($(this).text() == "<<") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="pre_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="pre_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else if ($(this).text() == ">>") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="next_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="next_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else {
                newNode = '<li> <a href="' + value + '">' + $(this).text() + '</a></li>'
                $(this).replaceWith(newNode);
            }
        });
        var el = $(id).find('span');
        var curNode = '<li class="active"> <a href="#">' + $(el).text() + '</a></li>';
        $(el).replaceWith(curNode);
    }
}

