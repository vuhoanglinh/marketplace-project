// JavaScript Document

function UserInfo() {
    this.IsAuthenticated = false;
    this.Username = '';
    this.TotalQuantity = 0;
    this.TotalPoints = '0';
    this.TotalFavouriteProducts = '0';
    this.TotalOrders = '0';
    this.AvatarURL = '';
    this.LinkAcc = '';
}

var currentUserInfo = new UserInfo();

//LoginOn
$(document).ready(function(e) {	
	
	if (currentUserInfo.Username != undefined) {
        if (currentUserInfo.Username != null && currentUserInfo.Username != '') {
            $("#lblLoginName").html("<b>" + currentUserInfo.Username + "</b>");
            $("#nonLogin").attr("style", "display:none");
            $("#logon").attr("style", "display:block");
            $("#lblTotalQuantity").html(currentUserInfo.TotalQuantity);
            $("#lblTotalPoints").html(currentUserInfo.TotalPoints);
            $("#lblTotalFavouriteProducts").html(currentUserInfo.TotalFavouriteProducts);
            $("#lblTotalOrders").html(currentUserInfo.TotalOrders);
            $("#avatarUrlsmall").attr('src', 'http://img.chon.vn/thumbnail.ashx?url=' + currentUserInfo.AvatarURL + '&width=22');
            if (currentUserInfo.LinkAcc.toLowerCase() == "facebook")
                $("#linkacc").html("<a title='Liên kết tài khoản này với FaceBook' href='javascript:void(0)' onclick='linkacc(\"FacebookID\")' class='title'>Liên kết FaceBook</a>");
            else $("#linkacc").html("");
            $("#ShowMailBox999").attr("style", "display:block");
        } else {
            $("#lblLoginName").html("");
            $("#nonLogin").attr("style", "display:block");
            $("#logon").attr("style", "display:none");
            $("#lblTotalQuantity").html(currentUserInfo.TotalQuantity);
            $("#ShowMailBox999").attr("style", "display:none");
        }
    }
	
	

});