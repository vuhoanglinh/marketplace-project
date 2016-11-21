<!--HEADER:BEGIN -->
<div class="header full">
  <div class="header-outside width-960">
    <div class="header-inside full">
      <div class="control-logon">
        <ul class="list-logon">
          <li id="nonLogin1" class="forgot-pass" style="display:block"> <a rel="noindex, nofollow" href=""> Quên mật khẩu </a> </li>
          <li id="nonLogin2" class="register" style="display:block"> <a rel="noindex, nofollow" href=""> Đăng ký </a> </li>
          <li id="nonLogin3" class="login" style="display:block"> <a rel="noindex, nofollow" class="none_bor" href=""> Đăng nhập </a> </li>
          <li id="lblLoginName1" class="username" style="display: none"> <a rel="noindex, nofollow" id="lblLoginName" style="cursor: pointer" ></a> </li>
          <li id="lblLoginName2" class="logout" style="display: none"> <a rel="noindex, nofollow" href=""> Thoát </a> </li>
          <li id="shopCart" class="cart"> <a rel="noindex, nofollow" href="/nguoi-dung/gio-hang.aspx" id="header_cart"> Giỏ hàng<span class="black"> (<strong><span id="lblTotalQuantity">0</span></strong>)</span></a> </li>
        </ul>
        <div id="search_box"> 
        </div>
      </div>
      <div class="search">
        <form action="" method="post" id="frmsearch" name="frmsearch">
          <div class="input">
            <input type="text" name="search" id="txtQueryClient" placeholder="Tìm kiếm..." maxlength="80" alt="Search" >
          </div>
          <a href="javascript:void(0);" id="btnQueryClient" class="btn-search" ></a> 
        </form>
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
      <div class="logo"> <a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>"> <?php if($hr_logo != ""){ ?><img height="59" src="<?php echo $hr_logo ?>" alt="<?php $h_name; ?>"> <?php } ?> </a>  </div>
      <div class="navigation">
        <ul class="list-nav">
          <li><a href="<?php echo base_url(); ?>" data-hover="Chon.vn"><span>Chon.vn</span></a></li>
          <li class=""> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Sản phẩm"><span>Sản phẩm</span></a> </li>
          <li class=""> <a href="<?php echo base_url('cua-hang')."/".$h_name."/gioi-thieu"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Giới thiệu"><span>Giới thiệu</span></a> </li>
          <li class=""> <a href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Sự kiện"><span>Sự kiện</span></a></li>
          <li class=""><a href="<?php echo base_url('cua-hang')."/".$h_name."/danh-gia"; ?>" data-hover="Đánh giá"><span>Đánh giá</span></a></li>
          <li class=""><a href="<?php echo base_url('cua-hang')."/".$h_name."/lien-he"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Liên hệ"><span>Liên hệ</span></a></li>
          <li class=""><a href="<?php echo base_url('cua-hang')."/".$h_name."/he-thong"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Hệ thống cửa hàng"><span>Hệ thống cửa hàng</span></a></li>
           <?php if($hr_website != "") { ?><li class="last-child"><a href="<?php echo $hr_website; ?>" target="_blank" data-hover="facebook"><span>website</span></a></li><?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- HEADER:END --> 
<!-- BANNER: BEGIN -->
<div class="banner full">
  <div class="banner-outside width-960">
    <div id="slider" class="nivoSlider"> 
	<?php 
        if(count($b_banner) > 0) {
          foreach ($b_banner as $row) {          
          ?>
          <a href='<?php echo $row->link; ?>' target="_blank"> <img alt='' src='<?php echo $row->image; ?>'  /> </a> 
          <?php 
          } 
        } 
    ?> </div>
  </div>
</div>

<!-- BANNER: END --> 

<!-- CATEGORY: BEGIN -->
<div class="category full">
  <div class="category-outside width-960">
    <div class="category-inside full">
      <ul class="category-list">
        <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/"; ?>?rel=<?php echo $hr_rel;?>" tablink="#tab">Hàng mới</a></li>
        <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/"; ?>?rel=<?php echo $hr_rel;?>&sort=highestpromotion" tablink="#tab">Khuyến mãi</a></li>
        <?php
            foreach($b_category['parent'] as $row)
            {
        ?>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $row->id; ?>" tablink="#tab<?php echo $row->id; ?>"><?php echo $row->name; ?> (<?php echo $b_category['numpparent'][$b_count2]; ?>)</a></li>
        <?php 
            $b_count2++;
            } 
		    ?>
      </ul>
    </div>
  </div>
</div>
<!-- CATEGORY: END --> 