<!-- BANNER: BEGIN -->

<div id="maximage" class="mc-cycle">
  <?php 
        if(count($b_banner) > 0) {
          foreach ($b_banner as $row) {          
          ?>
  <a href='<?php echo $row->link; ?>' target="_blank"> <img alt='' src='<?php echo $row->image; ?>'  /> </a>
  <?php 
          } 
        } 
    ?>
</div>
<!-- BANNER: END --> 

<!--HEADER:BEGIN -->
<div class="fullWidth rwleft">
  <div class="rw-header rwdefault">
    <div class="rw-inner rwleft">
      <ul class="rw-menu fontfamily4">
        <li class="iconHome"><a href="<?php echo base_url(); ?>" data-hover="Chon.vn"></a></li>
        <li class=""> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Sản phẩm"><span>Sản phẩm</span></a> </li>
        <li class=""> <a href="<?php echo base_url('cua-hang')."/".$h_name."/gioi-thieu"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Giới thiệu"><span>Giới thiệu</span></a> </li>
        <li class=""> <a href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Sự kiện"><span>Sự kiện</span></a></li>
        <li class=""><a href="<?php echo base_url('cua-hang')."/".$h_name."/danh-gia"; ?>" data-hover="Đánh giá"><span>Đánh giá</span></a></li>
        <li class=""><a href="<?php echo base_url('cua-hang')."/".$h_name."/lien-he"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Liên hệ"><span>Liên hệ</span></a></li>
        <li class=""><a href="<?php echo base_url('cua-hang')."/".$h_name."/he-thong"; ?>?rel=<?php echo $hr_rel;?>" data-hover="Hệ thống cửa hàng"><span>Hệ thống cửa hàng</span></a></li>
        <?php if($hr_website != "") { ?>
        <li class="last-child"><a href="<?php echo $hr_website; ?>" target="_blank" data-hover="facebook"><span>website</span></a></li>
        <?php } ?>
      </ul>
      <div id="header_top">
        <ul id="header_top_menu">
          <li id="nonLogin1"> <a rel="noindex, nofollow" href=""> Quên mật khẩu </a> </li>
          <li id="nonLogin2"> <a rel="noindex, nofollow" href=""> Đăng ký </a> </li>
          <li id="nonLogin3"> <a rel="noindex, nofollow" class="none_bor" href=""> Đăng nhập </a> </li>
          <li id="lblLoginName1" style="display: none"> <a rel="noindex, nofollow" id="lblLoginName" style="cursor: pointer"></a> </li>
          <li id="lblLoginName2" style="display: none"> <a rel="noindex, nofollow" href=""> Thoát </a> </li>
          <li id="shopCart"> <a rel="noindex, nofollow" href="" id="header_cart"> Giỏ hàng<span class="black"> (<strong><span id="lblTotalQuantity"></span></strong>)</span></a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="rw-box rwleft">
  <div class="rw-search rwdefault">
    <div class="rw-inner-search rwleft">
    <div class="rw-logo"> 
      <a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>">
        <?php if($hr_logo != ""){ ?>
        <img src="<?php echo $hr_logo ?>" alt="<?php $h_name; ?>">
        <?php } ?>
      </a>
    </div>
    <div class="rw-search-form">
     <form action="" method="post" id="frmsearch" name="frmsearch">
        <div class="input">
            <input type="text" name="search" id="txtQueryClient" placeholder="Tìm kiếm..." maxlength="80" alt="Search" >
        </div>
        <a href="javascript:void(0);" id="btnQueryClient">Search</a>
     </form>
      <script type="text/javascript">
        $(document).ready(function() {          
          $('#btnQueryClient').click(function(){     
            var q   = $('#txtQueryClient').val();
            //q       = q.replace(/!|@|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "");
            var url = "<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&q="+q;       
            $(location).attr('href',url);
          });
          $('#txtQueryClient').keypress(function(e){
              if(e.which == 13) {
                var q   = $('#txtQueryClient').val();
                //q       = q.replace(/!|@|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "");
                var url = "<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&q="+q;
                $(location).attr('href',url);
              }
           });

          $('#frmsearch').submit(function(){
            return false;
          });
        });
        </script> 
      </div>
    </div>
  </div>
</div>
<!-- HEADER:END --> 

<!-- CATEGORY: BEGIN -->
<div class="rw-tabs-cat">
  <div class="rw-cat rwleft">
    <div class="rw-cat-box rwdefault">
      <div class="rw-inner-cat rwleft">
        <ul class="rw-cat-parent fontfamily1">
          <?php
            foreach($b_category['parent'] as $row)
            {
          ?>
          <li lang="<?php echo $row->id; ?>" <?php echo ($b_count2 == 0) ? 'class="active"': '';?>><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $row->id; ?>" rel="#<?php echo $row->id; ?>"> <?php echo $row->name; ?></a></li>
          <?php 
            $b_count2++;
          } ?>
        </ul>
        <div id="sCrolling" class="rw-slide-brand sCrolling">
          <?php
            foreach($b_category['parent'] as $row)
            {
          ?>
          <div class="rw-inner-child rwleft tab-content" id="<?php echo $row->id; ?>">
            <ul class="rw-sub-child fontfamily2">
              <?php 
                foreach ($b_category['child'][$b_count] as $value) { 
              ?>
                <li lang="<?php echo $row->id; ?>" class=""><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $value->id; ?>"><?php echo $value->name;?></a></li> 
              <?php 
                $b_count3++;
                } // end foreach loop 2
              ?>
            </ul>
          </div>
          <?php 
            $b_count++;
            }  // end foreach loop 1
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- CATEGORY: END --> 