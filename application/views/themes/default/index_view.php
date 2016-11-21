<section class="container"> 
  
  <!-- Slider Begin--> 
  <script src="<?php echo base_url('themes/default'); ?>/js/jquery.nivo.slider.js" type="text/javascript"></script>
  <section class="block-slideshow">
    <div id="slide-panel">
      <div id="slider"> 
      	<?php 
      	foreach ($slideshow as $row) {
      	?>
      	<a href="<?php echo $row->link; ?>">
      		<img src="<?php echo $row->image; ?>"/>
      	</a> 
      	<?php }?>
      </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url('themes/default'); ?>/js/config_slider.js"></script> 
  </section>
  <!-- Slider End-->
  <!-- Under_Banner Begin-->
  <div class="under_banner">
    <ul>
      <li><a class="s" href="/ve-chung-toi/"><i class="ispider"></i>Miễn phí <span>vận chuyển</span></a></li>
      <li><a class="s" href="/ve-chung-toi/"><i class="ispider2"></i>Đổi trả hàng <span>trong
        vòng 7 ngày</span></a></li>
      <li><a class="s" href="/ve-chung-toi/"><i class="ispider3"></i>Bảo mật <span>thanh toán</span></a></li>
      <li class="Email_letter">
        <p>Nhập email để nhận bản tin</p>
        <form action="" method="post" name="frmEmail" id="frmEmail">
        <div class="letter">
          <p class="iconemail">
            <input type="text" name="email" onblur="" id="txtEmail" value="" maxlength="100" placeholder="Nhập email">
          </p>
          <a id="lbtMailBox" value="" class="iconbtmail" name="submit_search"></a> 
      	</div>
      </form>
      </li>
    </ul>
    <script type="text/javascript">
    $(document).ready(function(){
      $('a.lbtMailBox').click(function(){
        
      });
    });
    </script>
  </div>
  <!-- Under_Banner End-->
  <div class="clear"></div>
  <!-- Best-Seller and Banner Begin-->
  <section class="rows">
    <artice class="best_seller">
      <div class="clearfloat"> </div>
      <h2 class="best_seller_title"> <a href="" class="myriadpro"> <em class="title_dot fleft"></em> Sản phẩm bán chạy nhất <img src="<?php echo base_url('themes/default'); ?>/images/spBanChay.png"> <em class="title_dot fright"></em> </a> </h2>
      <ul class="result_list best_seller_list">  
      <?php 
      foreach ($product['view'] as $rowproduct) {
        # code...
      
      ?>      
        <li <?php echo ($countproduct % 3 == 0) ? 'class="three"' : ''; ?>>
          <div class="search_pro">
            <span class="baget <?php echo ($rowproduct->type > 1) ? 'baget_hot' : (($rowproduct->type == 1) ? 'baget_new' : ''); ?>  ">&nbsp;</span>
            <span class="baget_sale" style="display:<?php echo ($rowproduct->s_price < $rowproduct->price) ? 'block' : 'none'; ?>"> <?php echo round((($rowproduct->s_price / $rowproduct->price) - 1)*100); ?>%</span>
            <a rel="product-results" alt="" title="" href="<?php echo base_url('san-pham').'/'.$rowproduct->title.'/chi-tiet?id='.$rowproduct->id; ?>">
              <img alt="" class="search_pro_img" src="<?php echo $product['image'][$countproduct]; ?>" width="170" height="187">
            </a>
            <div class="featured_products_list_info">
              <a href=""><?php echo $product['namestore'][$countproduct]; ?></a><br>
              <div class="clearfloat"></div>
              <span class="old_price fltlft" style="display:<?php echo ($rowproduct->s_price < $rowproduct->price)? 'block':'none';?>"><?php echo number_format($rowproduct->price,"","","."); ?></span><span class="price fltlft" title="Giá bán khuyến mãi"><?php echo ($rowproduct->s_price > 0)? number_format($rowproduct->s_price,"","",".") : number_format($rowproduct->price,"","",".");?> đ</span>  
            <span class=""></span></div>
        </li>
       <?php 
        $countproduct++;
       }
       ?> 
      </ul>
    </artice>

    <script src="<?php echo base_url('themes/default'); ?>/js/jquery.cycle.js" type="text/javascript"></script> 
    <script type="text/javascript">
            $().ready(function() {
                $('#banner1').cycle({
                    fx: 'scrollLeft'
                });
                $('#banner2').cycle({
                    fx: 'scrollLeft'
                });
                $('#banner3').cycle({
                    fx: 'scrollDown,scrollLeft,scrollRight,scrollUp'
                });
            })
        </script>
    <div class="right_banner">
      <div id="banner1"> <a href=""><img alt="banner 0306-02" title="banner 0306-02" src="<?php echo base_url('themes/default/upload'); ?>/161093bc-4a2b-4140-8978-c1faffe79a90_RIght 2.jpg" target="_blank" /></a> </div>
      <div id="banner2"> <a href=""><img alt="banner 0306-01" title="banner 0306-01" src="<?php echo base_url('themes/default/upload'); ?>/03f096d4-dc3c-4db0-bc20-1267a25e5181_RIght 1.jpg" target="_blank" /></a> </div>
      <div id="banner3"> 
       
        <a href=""> <img src="<?php echo base_url('themes/default/upload'); ?>/a8c9fd05-78d9-449c-8063-2d4d361b35ef_Right banner 3.1.jpg" alt="banner 0209-01" target="_blank"></a> 
        <a href=""> <img src="<?php echo base_url('themes/default/upload'); ?>/25693f2a-dd22-49e9-acc4-280ad974e43b_Right banner 3.0.jpg" alt="banner 2912" target="_blank"></a>
      
      </div>
    </div>
  </section>
  <!-- Best-Seller and Banner Begin--> 

  <!-- Brand Begin--> 
  <!-- a#IsFeatured Click load ajax Cửa hàng nổi bật, a#Diamond click ajax load cửa hàng kim cương-->
  <section class="span-15" id="five_avatar" style="margin-top:20px">
    <div id="main">
      <ul class="tabs anchors">
        <li><span class="icon-store">&nbsp;</span> <a id="IsFeatured" href="#t1" class="active">CỬA HÀNG NỔI BẬT </a> <span class="icon-luxury">&nbsp;</span></li>
        <li><a id="Diamond" class="V3merchant_type" href="#t2">CỬA HÀNG KIM CƯƠNG </a><span class="icon-premium">&nbsp;</span></li>
        <li style="display:none"><a id="All" class="V3merchant_type" href="#t3">TẤT CẢ CỬA HÀNG </a></li>
      </ul>
      <div id="t1" class="tabContent">
        <div class="product-home">
          <ul>
            <?php 
            foreach ($storefooter as $row) {
              # code...
            ?>
            <li>
              <div class="boxgrid caption"> <a href="<?php echo base_url('cua-hang')."/".$row->name."/trang-chu"; ?>?rel=<?php echo $row->id;?>"> <img class="lazyload" src="<?php echo base_url('public').'/'.$row->avatar; ?>" original="<?php echo base_url('public').'/'.$row->avatar; ?>" height="300" width="200" alt="<?php echo $row->name; ?>" title="<?php echo $row->name; ?>" style="display: block;"></a>
                <div class="cover boxcaption" style="overflow: hidden; height: 60px;">
                  <div class="rice" style="opacity: 0;"> <span class="nameproduct"><?php echo $row->name; ?> </span>
                    <!--
                    <div class="aggregateRating"> <a href="/cua-hang/Ninewest.aspx?ref=home-merchant" rel="nofollow"> <span class="rating filledRating" style="float:left;">&nbsp;</span><span class="rating filledRating" style="float:left;">&nbsp;</span><span class="rating filledRating" style="float:left;">&nbsp;</span><span class="rating filledRating" style="float:left;">&nbsp;</span><span class="rating filledRating" style="float:left;">&nbsp;</span> </a> </div>
                    <div class="offers"> <span title="1.100.000đ"> 1.100.000đ </span><span class="arrow"></span><span title="7.800.000đ"> 7.800.000đ </span> </div>
                    -->
                  </div>
                  <div class="brand"><a href="<?php echo base_url('cua-hang')."/".$row->name."/trang-chu"; ?>?rel=<?php echo $row->id;?>"> <img src="<?php echo base_url('public').'/'.$row->logohome; ?>" height="40" alt="<?php echo $row->name; ?>" title="<?php echo $row->name; ?>"></a></div>
                </div>
              </div>
            </li>  
            <?php }
            ?>
          </ul>
        </div>
      </div>
      <div id="t2" count="0" class="tabContent" style="display: none;"> </div>
      <div id="t3" count="0" class="tabContent" style="display: none;"> </div>
    </div>
  </section>
  <script src="<?php echo base_url('themes/default'); ?>/js/jquery.lazyload.js" type="text/javascript"></script> 
  <script type="text/javascript">
        $(document).ready(function() {
            $("img.lazyload").lazyload({ effect: "fadeIn", placeholder: "<?php echo base_url('themes/default'); ?>/images/grey.gif" });
      
      $('.boxgrid.caption').live('mouseover mouseout', function(event) {
        if (event.type == 'mouseover') {
          $(this).find('.rice').stop(true).fadeTo("normal", 1);
          $(".cover", this).stop().animate({ height: "90px" }, { queue: false, duration: 160 });
        }
        else {
          $(this).find('.rice').fadeTo("normal", 0);
          $(".cover", this).stop().animate({ height: "60px" }, { queue: false, duration: 160 });
        }
      });
        });
    </script> 
  <!-- Brand End-->

  <!-- Footer Ads Begin -->
  <div class="span-26 c_ads">
    <div class="span-17" style="width:578px">
      <div class="ads1" style="width:578px;height: 61px;">
        <h1 style="margin-top:18px"> <img src="<?php echo base_url('themes/default'); ?>/images/logo-small-chon.png" />
          <p style="width:436px"> - trung tâm <a href="/" title="thời trang">thời trang </a>chính hãng uy tín hàng
            đầu việt nam</p>
        </h1>
      </div>
    </div>
    <div style="float: right;" class="fb-like" data-href="http://www.facebook.com/www.chon.vn" data-send="false" data-width="390" data-show-faces="true"></div>
    <div style="clear:both"></div>
  </div>
  <!-- Footer Ads End -->



