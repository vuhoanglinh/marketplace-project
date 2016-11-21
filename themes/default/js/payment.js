// JavaScript Document
(function($) {
    $.payment = { version: '1.0.1' };
    $.fn.payment = function(settings) {
        settings = jQuery.extend({
            state: '.changeitem',
            iframe: '#iframecard',
            width: 820,
            height: 460,
            zindex: 998,
            opacity: 0.5,
            maxwidth: 850,
            maxheight: 540,
            background: 'black',
            modal: true,
            resizable: false,
            autoResize: false,
            autoOpen: true,
            autoPaymode: false,
            version: 1
        }, settings);

        var shoppingCardDialog;
        $.payment.addcard = function(quantity, paymode, stock, price, merchantId, id, title, outlet) {
            var flag = false;

            //            if (settings.autoPaymode && paymode == "Offline") {
            //                flag = true;
            //            }
            if (merchantId == gifID.toLowerCase() && (currentUserInfo.Username == null || currentUserInfo.Username == '' || currentUserInfo.Username ==undefined)) {
                alert("Sản phẩm của cửa hàng này chỉ bán cho thành viên của chon.vn!");
                return;
             }
            if (outlet == "0") {
                alert("Sản phẩm này chỉ được bán trong một ngày nhất định. Quý khách vui lòng vào mục \"Outlet Everyday\" để biết thêm chi tiết!");
                return;
            }
            if (paymode == "Offline") {
                flag = true;
            }
            if (merchantId == undefined || merchantId == "") {
                alert("Sản phẩm chưa bán tại cửa hàng.");
                return;
            }
            if (price == undefined)
                price = "0";

            price = price.replace(',', '.');

            //alert(price+" - "+ stock+" - "+ flag);

            var src = '';
            var titleCard = 'Chi tiết sản phẩm ' + title;

            if (flag || price <= 0 || stock == 0) {
                titleCard = 'Sản phẩm ' + title + ' hiện không bán trực tuyến';
                if (stock == 0 && price > 0)
                    titleCard = "Sản phẩm hiện đã hết hàng, quý khách vui lòng chọn sản phẩm khác!";
                _width = 640;
                src = '/Cua-hang/MerchantAddress.aspx?id=' + id + '&merchantid=' + merchantId;


                shoppingCardDialog = $('<iframe id="editDialogAddCard" frameborder="0" src="' + src + '" />').dialog({
                    autoOpen: settings.autoOpen,
                    width: settings.maxwidth,
                    height: settings.maxheight,
                    zIndex: settings.zindex,
                    //                    buttons: {
                    //                        "?óng l?i": function() { $(this).dialog("close"); }
                    //                    },
                    modal: settings.modal,
                    resizable: settings.resizable,
                    autoResize: settings.autoResize,
                    overlay: {
                        opacity: settings.opacity,
                        background: settings.background
                    },
                    close: function() {
                        try {
                            shoppingCardDialog.remove();
                            //endLoading(); 
                        } catch (err) { }

                    }
                }).width(settings.width).height(settings.height);
            }
            else {
                src = '/Cua-hang/AddCard.aspx?id=' + id + '&merchantid=' + merchantId;
                if (settings.version == 2)
                    src = '/Cua-hang/AddCartVersion2.aspx?id=' + id + '&merchantid=' + merchantId;
                shoppingCardDialog = $('<iframe id="editDialogAddCard" frameborder="0" src="' + src + '" />').dialog({
                    autoOpen: settings.autoOpen,
                    width: settings.maxwidth,
                    height: settings.maxheight,
                    position: "center",
                    zIndex: settings.zindex,
                    //                    buttons: {
                    //                        "?óng l?i": function() { $(this).dialog("close");LoadCartItem(); }
                    //                    },
                    modal: settings.modal,
                    resizable: settings.resizable,
                    autoResize: settings.autoResize,
                    overlay: {
                        opacity: settings.opacity,
                        background: settings.background
                    },
                    close: function() {
                        try {
                            shoppingCardDialog.remove();
                            LoadCartItem();
                            //endLoading(); 
                        } catch (err) { }

                    }
                }).width(settings.width).height(settings.height);

                return false;
            }



        };
 	$(this).each(function() {
            $(this).unbind('click');
            $(this).bind('click', function() {
                var quantity = $(this).attr('quantity');
                var paymode = $(this).attr('paymode');
                var stock = $(this).attr('stock');
                var price = $(this).attr('price');
                var merchantId = $(this).attr('rel');
                var id = $(this).attr('relid');
                var title = $(this).attr('title');
                var outlet = $(this).attr('outlet');
                $.payment.addcard(0, paymode, stock, price, merchantId, id, title, outlet);

            });

        });

    };
})(jQuery);