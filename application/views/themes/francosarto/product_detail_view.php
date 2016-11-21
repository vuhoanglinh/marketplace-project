<script>
$(document).ready(function() {
    

    $('.clcode').hover(function() {
        $(this).find('.box-info').stop().animate({
            height: '85px'
        });
    }, function() {
        $(this).find('.box-info').stop().animate({
            height: '50px'
        });
    })

    $('.cols-right .pd-imagery-small').each(function(e) {
        if ((e + 1) % 2 == 0) {
            $(this).addClass('margin-none');
        }
    })
    $('.selling-pd .pd-imagery-small').each(function(e) {
        if ((e + 1) % 4 == 0) {
            $(this).addClass('margin-none');
        }
    });
    $(".product_detail_thumbnail .jCarouselLite").jCarouselLite({
        btnNext: ".product_detail_thumbnail .next",
        btnPrev: ".product_detail_thumbnail .prev",
        vertical: true,
        visible: 4,

        circular: false

    });



    $(".same_products_list").jCarouselLite({
        btnNext: "#same_products .next",
        btnPrev: "#same_products .prev",
        mouseWheel: true,
        visible: 5,
        vertical: true

    });

    $(".tab_content").hide();
    $("ul.tab li a:first").addClass("tab_active").show();
    $(".tab_content:first").show();


    $("ul.tab li").click(function() {
        $("ul.tab li a").removeClass("tab_active");
        $(this).find("a").addClass("tab_active");
        $(".tab_content").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });
}); 
</script>
<!-- CONTENT: BEGIN -->
<div id="container">
  <ul id="breadcrumb">          
    <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>"><img src="<?php echo base_url('themes'); ?>/francosarto/images/home2.jpg" alt=""></a></li>
    <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>">Sản phẩm</a></li>
    <li><a itemprop="url" href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $b_idct; ?>"><span itemprop="title"><?php echo $b_namect; ?></span></a></li>
    <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$b_title."/chi-tiet"; ?>?code=<?php echo $id_product; ?>&rel=<?php echo $hr_rel;?>"><?php echo $b_name; ?></a></li>
    <li>Chi tiết sản phẩm</li>
  </ul>
  <div class="subpage">
      <div class="spacing">&nbsp;</div>
      <div class="col_right">
        <div class="col_right_block">
          <div class="right_title">
            <h3 class="upper customfont white">Sản phẩm tương tự</h3>
          </div>
          <div class="right_block_content">
            <div id="same_products"> <a class="prev" href="javascript:void(0);">&nbsp;</a> <a class="next" href="javascript:void(0);">&nbsp;</a>
              <div class="same_products_list">
                <ul>
                  <?php foreach ($b_likeproduct['b_lview'] as $row) {                  
                  ?>
                  <li> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>"> 
                    <img src="<?php echo $b_likeproduct['b_limage'][$b_lcount]; ?>" width="150" height="165" alt="<?php echo $row->name; ?>" title="<?php echo $row->name; ?>" /> <span class="big-sale" style="display:<?php echo ($row->s_price > 0)? 'block' : 'none'; ?>"> <?php echo round((($row->s_price / $row->price) - 1)*100); ?>% </span> </a></a>
                    <div class="same_products_list_info"> <a title="" href="" class="black fltlft"> <strong> <?php echo $row->name; ?> </strong></a><br />
                      <span class="price fltlft" title="Giá bán khuyến mãi"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","",".");?> đ</span>  <span class="old_price fltlft" style="display:<?php echo ($row->s_price > 0)? 'block':'none';?>"><?php echo number_format($row->price,"","","."); ?></span>
                  </li>
                  <?php 
                    $b_lcount++;
                    }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript" src="<?php echo base_url('themes'); ?>/francosarto/js/cloud-zoom.1.0.2.js"></script> 
      <link href="<?php echo base_url('themes'); ?>/francosarto/css/cloud-zoom.css" rel="stylesheet" type="text/css"/> 
      <div class="col_content">
        <div class="big_left_title">
          <h3 class="customfont white"><?php echo $b_name; ?></h3>
          <span class="disable">&nbsp; Mã sản phẩm: <?php echo $b_code; ?></span>
          <ul class="detail_share fltrt">
            <li><a onclick="window.open('http://www.facebook.com/share.php?u='+document.location,'_blank');" title="Đăng lên Facebook" style="cursor: pointer;"> <img src="<?php echo base_url('themes'); ?>/francosarto//images/fb.png" width="16" height="16" alt=""/> </a></li>
            <li><a title="Đăng lên Twitter" style="cursor: pointer;" onclick="window.open('http://twitter.com/home?status='+document.location,'_blank');"> <img src="<?php echo base_url('themes'); ?>/francosarto//images/tw.png" width="16" height="16" alt=""/></a></li>
          </ul>
        </div>
        <div id="product">
          <div class="wpd">
            <div class="product_detail_thumbnail"> <a href="javascript:void(0);" class="prev">&nbsp;</a>
              <div class="jCarouselLite">
                <ul>
                  <?php foreach ($b_product as $row) {
                  ?>
                  <li class="default">
                    <a onclick="return false;" href="<?php echo $row->image; ?>" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: '<?php echo $row->image; ?>'">             
                    <img width="60px" height="66px" src="<?php echo $row->image; ?>" alt="<?php echo $b_name; ?>" title="<?php echo $b_name; ?>" /> 
                  </a>
                  </li>
                  <?php }?>
                </ul>
              </div>
              <a href="javascript:void(0);" class="next">&nbsp</a>
              <div class="clear"></div>
            </div>
            <div id="wrap" style="top:10px;z-index:9;position:relative;left:80px;height:405px;width:350px"> 
              <a href="<?php echo $b_image; ?>" class="cloud-zoom" id="zoom1" rel="adjustX: 0, adjustY:-4" style="position: relative; display: block; "> 
                <img src="<?php echo $b_image; ?>" alt="<?php echo $b_name; ?>" width="350" height="385" align="left" title="<?php echo $b_name; ?>" style="display: block;"> 
              </a>
              <div class="mousetrap" style="background-image:url(&quot;.&quot;);z-index:999;position:absolute;width:350px;height:384px;left:4px;top:0px;"></div>
            </div>
          </div>
        <script>$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();</script> 
          <div id="product_info">
            <h4 class="dotted_title">Đánh giá sản phẩm</h4>
            <div class="dotted_content">              
              <div class="clearfloat"></div>
              <p class="rating-links"> <a id="newestRating" href="#commentlist" >Xem đánh giá mới nhất</a> <span class="separator" >|</span> <a href="#write1_comment">Viết đánh giá</a> <span class="separator" style=''>|</span> <a href="/mua-sam/phu-kien-nu/giay-dep/giay-nu-franco-sarto-mau-nau-cuoio-b8790l1200.aspx" style=''>Xem tất cả đánh giá</a> <span class="separator" >|</span> <a href="">Sản phẩm liên kết</a> </p>
            </div>
            <h4 class="dotted_title">Giá</h4>
            <div class="dotted_content">
              <p>Giá sản phẩm: <span class="disable old_price fltrt"><?php echo number_format($b_oldprice,"","","."); ?>đ </span></p>
              <p>Giá bán khuyến mãi: <span class="price fltrt red"><strong> <?php echo ($b_newprice > 0)? number_format($b_newprice,"","",".") : number_format($b_oldprice,"","","."); ?>đ</strong></span></p>
              <p>Giảm giá: <span class="fltrt green"> <?php echo round((($b_newprice / $b_oldprice) - 1)*100); ?>%</span></p>
            </div>
            <h4 class="dotted_title"></h4>
            <div class="dotted_content">
              <div>
                <div class="boxMaterial"> <span class="fltlft">Kích cỡ:&nbsp;&nbsp;</span>
                  <div>
                    <ul class="size" rel="default">
                      <?php 
                      foreach ($b_size as $row) {                       
                      ?>
                      <li><a class="itemsize"><?php echo $row->name; ?></a></li>
                      <?php }?>
                    </ul>
                  </div>
                </div>
                <div id="sizeSytem" class="boxMaterial1"> <a id='systemSizeImage' class='fltrt red' href='http://img.chon.vn/thumbnail.ashx?url=/Files/Upload/Images/MerchantProduct/2014/04/02/0_Giay-bup-be_sizechart_FrancoSarto.jpg'>Hệ thống size</a> </div>
                <div class="clearfloat"></div>
                <div class="boxMaterial"> <span class="fltlft">Màu sắc:&nbsp;</span>
                  <ul class="pro_details_color">
                    <?php 
                      foreach ($b_color as $row) {                       
                      ?>
                    <li class="activecolor">
                      <a title="<?php echo $b_name; ?>" style='cursor: pointer;'>
                      <img src="<?php echo $row->image; ?>" height='20px' />
                      </a>
                    </li>
                    <?php }?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="btn_buyItem"> <a id='btn_big_buy' href='javascript:void(0)'></a> </div>
          </div>
        </div>
        <div class="big_left_title bg" style='display:block'>
          <h3 class="customfont white upper">Thông tin chi tiết</h3>
        </div>
        <div class="product_detail" style='display:block'>
          <?php echo $b_detail; ?>
          <?php echo $b_content; ?>
          <div class="tab_ttct" style="display:none">
            <table summary="Info Detail" class="hor-table" width="100%">
              <tbody>
                <tr>
                  <th scope="col" colspan="2"> Thông tin chi tiết </th>
                </tr>
                <tr>
                  <td style="width: 25%; position: relative; "> Danh mục sản phẩm </td>
                  <td style="width: 75%; position: relative; "><a href=""><span itemprop="category"> </span></a></td>
                </tr>
                <tr style="background-color:#e5e5e5;">
                  <td style="width: 25%; position: relative; "> Mũi giày </td>
                  <td style="width: 75%; position: relative; "><a href=""> bít mũi</a> <span id="ctl00_ctl00_ctl00_cphBody_cphContent_ProductDetails1_rptGroupFilter_ctl01_rptFilter_ctl00_lblFilter"></span></td>
                </tr>
                <tr >
                  <td style="width:25%;"> Kiểu giày dép </td>
                  <td style="width:75%;"><a href=""> búp bê</a> <span id="ctl00_ctl00_ctl00_cphBody_cphContent_ProductDetails1_rptGroupFilter_ctl02_rptFilter_ctl00_lblFilter"></span></td>
                </tr>
                <tr style="background-color:#e5e5e5;">
                  <td style="width: 25%; position: relative; "> Mục đích sử dụng </td>
                  <td style="width: 75%; position: relative; "><a href=""> dạo phố</a> <span id="ctl00_ctl00_ctl00_cphBody_cphContent_ProductDetails1_rptGroupFilter_ctl03_rptFilter_ctl00_lblFilter"></span></td>
                </tr>
                <tr >
                  <td style="width:25%;"> Gót/Đế giày </td>
                  <td style="width:75%;"><a href=""> đế thấp</a> <span id="ctl00_ctl00_ctl00_cphBody_cphContent_ProductDetails1_rptGroupFilter_ctl04_rptFilter_ctl00_lblFilter"></span></td>
                </tr>
                <tr style="background-color:#e5e5e5;">
                  <td style="width: 25%; position: relative; "> Màu sắc </td>
                  <td style="width: 75%; position: relative; "><a href=""> nâu</a> <span id="ctl00_ctl00_ctl00_cphBody_cphContent_ProductDetails1_rptGroupFilter_ctl05_rptFilter_ctl00_lblFilter"></span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="big_left_title bg">
          <h3 class="customfont white upper">Thông tin thương hiệu</h3>
        </div>
        <div class="product_detail"> <?php echo $h_descriptionbrand; ?> </div>
        <div class="big_left_title bg">
          <h3 class="customfont white upper">Đánh giá</h3>
        </div>
        <div class="block-comment">
          <div id="commentlist"> 
            <ul class="comments">
            </ul>
            <div class="show-comments"> </div>
            <div id="frmReview">
              <div id="write1_comment" class="comment">
                <h3 class="blue customfont">Gửi bình luận</h3>
                <div class="comment-rating">
                  <p><span id="lblProductTitle"><?php echo $b_name; ?></span></p>
                </div>
                <div class="comment-input">
                  <ul>
                    <li class="name" style="padding-left:40px"><span id="login"> Vui lòng <a rel="noindex, nofollow" href="" style="text-decoration:none;color:Red;cursor:pointer" > đăng nhập </a> trước khi đánh giá</span></li>
                    <li class="name">
                      <label>Tiêu đề:*</label>
                      <input name="txtAuthor" type="text" id="txtAuthor" />
                      <span id="msgAuthor" style="color:Red;font-weight:bold;visibility:hidden;">*</span> </li>
                    <li class="message">
                      <label>Đánh giá:*</label>
                      <textarea name="txtMessage" rows="5" cols="40" id="txtMessage"></textarea>
                      <span id="msgMessage" style="color:Red;font-weight:bold;visibility:hidden;">*</span> </li>
                    <li class="name"> <span id="lblMessage" style="color:Red;"></span> </li>
                    <li class="submit"> <a href="javascript:void(0)" id="btnlogin1" class="btn_blue fltrt" style="cursor:pointer">Đăng nhập</a> <a class="btn_black fltrt" href="javascript:void(0)">Nhập lại</a> </li>
                  </ul>
                </div>
              </div>
            </div>            
          </div>          
        </div>
      </div>       
    </div>
  </div>
</div>
<!-- CONTENT: END -->
 