<div id="ch_header">
  <div id="ch_wrapper"> 
    <!-- BEGIN: HEADER -->
    <div class="top">
      <div class="logo"> <a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>"> <?php if($hr_logo != ""){ ?><img height="59" src="<?php echo $hr_logo ?>" alt="<?php $h_name; ?>"> <?php } ?> </a> </div>
      <div class="top_right"> 
        <!-- HEADER: SEARCH-->
        <div class="last">
          <div class="search">
            <form action="" method="post" id="frmsearch" name="frmsearch">
              <div class="input">
                <input type="text" name="search" id="txtQueryClient" placeholder="Nhập từ khóa tìm kiếm" maxlength="80" alt="Search" >
              </div>
              <button class="button" id="btnQueryClient" type="button" ></button>
            </form>
          </div>
        </div>

        <script type="text/javascript">
        $(document).ready(function() {          
          $('#btnQueryClient').click(function(){     
            var q   = $('#txtQueryClient').val();
            q       = q.replace(/!|@|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "");
            var url = "<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&q="+q;       
            $(location).attr('href',url);
          });
          $('#txtQueryClient').keypress(function(e){
              if(e.which == 13) {
                var q   = $('#txtQueryClient').val();
                q       = q.replace(/!|@|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "");
                var url = "<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&q="+q;
                $(location).attr('href',url);
              }
           });

          $('#frmsearch').submit(function(){
            return false;
          });
        });
        </script>
        <div class="share"></div>
        <!-- HEADER USER: BEGIN -->
        <div class="user_block"> 
          <script type="text/javascript">
        //alert(location.pathname);
        /*
        $(document).ready(function() {
            if (currentUserInfo.Username != undefined) {
                if (currentUserInfo.Username != null && currentUserInfo.Username != '') {
                    $("#lblLoginName").html("<b>" + currentUserInfo.Username + "</b>");
                    $("#nonLogin").attr("style", "display:none");
                    $("#logon").attr("style", "display:block;float:right;");
                    $("#lblTotalQuantity").html(currentUserInfo.TotalQuantity);
                } else {
                    $("#lblLoginName").html("");
                    $("#nonLogin").attr("style", "display:block");
                    $("#logon").attr("style", "display:none");
                    $("#lblCartItemCount2").html(currentUserInfo.TotalQuantity);
                }
            }
    
    
        });
        */
    </script>
          <div id="nonLogin" style="display:block">
            <p class="lostpass"> <a rel="noindex, nofollow" href="">Quên mật khẩu</a></p>
            <p class="register"> <a rel="noindex, nofollow" href="">Đăng ký</a> </p>
            <p class="login_name"> <a rel="noindex, nofollow" href="">Đăng nhập</a> </p>
            <p class="l_cart"> <a rel="noindex, nofollow" href="">Giỏ hàng (<span id="lblCartItemCount2" style="font-size:x-small;">0</span>)</a> </p>
          </div>
          <div id="logon" style="display:none">
            <div style="display: none;"> Chào
              <label id="lblLoginName"></label>
            </div>
            <p class="l_cart"> <a rel="noindex, nofollow" href="">Giỏ hàng (<span id="lblTotalQuantity" style="font-size:x-small;"></span>)</a> </p>
            <p class="l_signout"> <a rel="noindex, nofollow" href="">Thoát</a> </p>
          </div>
        </div>
        <!-- HEADER USER: END --> 
      </div>
    </div>
    <!-- END: HEADER --> 
  </div>
  <!-- BEGIN: MAIN NAVIGATION -->
  <nav class="topMenu">
    <div id="ch_mainmenu">
      <div class="menunav">
        <div class="chonlink"><a href="<?php echo base_url(); ?>">Chon.vn</a></div>
        <div class="menunav_back">
          <ul class="lavaLamp_menu" id="lava">
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>" title="san-pham"><span>Sản phẩm</span></a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/gioi-thieu"; ?>?rel=<?php echo $hr_rel;?>" title="gioi-thieu"><span>Giới thiệu</span></a></li>
            <li id="licollection" style="display:none;"><a href="#" title="bo-suu-tap">Bộ sưu tập</a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>" title="su-kien"><span>Sự kiện</span></a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/danh-gia"; ?>?rel=<?php echo $hr_rel;?>" title="danh-gia"><span>Đánh giá</span></a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/lien-he"; ?>?rel=<?php echo $hr_rel;?>" title="lien-he"><span>Liên hệ</span></a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/he-thong"; ?>?rel=<?php echo $hr_rel;?>" title="he-thong"><span>Hệ thống cửa hàng</span></a></li>
            <?php if($hr_website != "") { ?><li id="ctl00_ctl00_TopNavigator1_liHome"> <a rel="nofollow" target="_blank" href="<?php echo $hr_website; ?>">Website</a> </li> <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- END: MAIN NAVIGATION --> 
</div>