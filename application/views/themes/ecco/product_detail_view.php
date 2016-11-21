<!-- BEGIN: SLIDER -->

<div id="ch_wrapper">
<div id="ch_features">
  <div id="features_panes_container">
    <div id="slider" class="nivoSlider">
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
  </div>
  <div class="liner"></div>
</div>
<!--END: SLIDER --> 
<!-- BEGIN: BODY -->
<div id="ch_body">
<div id="ch_wrapper">
  <div id="ch_mainbody">
    <div id="ch_submenu">
      <div class="sub_left">
        <div class="sub_left_c">
          <h2> SẢN PHẨM</h2>
          <!-- BEGIN: CATEGORY -->
          <ul class="tabs" id="products_selection">
            <?php
                foreach($b_category['parent'] as $row)
                {
                ?>
            <li <?php echo ($b_count2 == 0) ? 'class="active"': '';?>><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $row->id; ?>" tablink="#tab<?php echo $row->id; ?>"> <em> <?php echo $row->name; ?><span class="txt_red">(<?php echo $b_category['numpparent'][$b_count2]; ?>)</span></em> </a></li>
            <?php 
                  $b_count2++;
                } ?>
          </ul>
          <!-- END: CATEGORY --> 
        </div>
        <!-- BEGIN: CATEGORY CHILDREN -->
        <div id="product_list_container">
          <div class="tab_container">
            <?php
                foreach($b_category['parent'] as $row)
                {
                ?>
            <div class="tab_content" id="tab<?php echo $row->id; ?>" style="display: <?php echo ($b_count == 0)? 'block' : ''; ?>;">
              <div class="sub_right">
                <div class="sub_right_r">
                  <div style="display: block" class="hnav" id="panel">
                    <ul class="Nav_sub_slide">
                      <?php 
                            foreach ($b_category['child'][$b_count] as $value) { 
                          ?>
                      <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $value->id; ?>"> <?php echo $value->name;?> <span class="txt_red">(<?php echo $b_category['numpchild'][$b_count3] ?>)</span></a></li>
                      <?php 
                            $b_count3++;
                            } // end foreach loop 2
                          ?>
                    </ul>
                  </div>
                  <p class="slide"> <a class="btn-slide active" href="javascript:void(0)">&nbsp;</a></p>
                </div>
              </div>
            </div>
            <?php 
                    $b_count++;
                }  // end foreach loop 1
                ?>
          </div>
        </div>
        <!-- END: CATEGORY CHILDREN --> 
      </div>
    </div>
    <!-- BEGIN :BREADCRUMB -->
    <div id="ch_breadcrumbs" class="cleaner">
      <ol class="breadcrumbs">
        <li class="first-child"><a href="/" class="home" name="content"></a></li>
        <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>">Trang chủ</a></li>
        <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $b_idct; ?>"><?php echo $b_namect; ?></a></li>
        <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$b_title."/chi-tiet"; ?>?code=<?php echo $id_product; ?>&rel=<?php echo $hr_rel;?>"><?php echo $b_name; ?></a></li>
      </ol>
    </div>
    <!-- END: BREADCRUMB --> 
    <!-- BEGIN: PRODUCT -->
    <div id="ch_containt">
      <div id="product_detail"> 
        <!-- BEGIN: PRODUCT SHOW -->
        <div id="product_detail_show">
          <div class="product_detail_images">
            <div class="product_detail_full">
              <div> <a onclick="zoomButton_OnClicḳ̣̣̣()" href="javascript:;"> <img id="imgProduct" class="img" height="440" width="400" src="<?php echo $b_image; ?>" alt="<?php echo $b_name; ?>" title="<?php echo $b_name; ?>"> </a> </div>
              <div class="image-big-control" style="display:none;">
                <div id="ctl00_ctl00_cphContent_ProductDetails1_divout">
                  <div class="zoom-out current"> <a href="javascript:;" id="imgout" onclick="zoomButton_OnClicḳ̣̣̣()">Hình lớn</a> </div>
                </div>
                <div id="ctl00_ctl00_cphContent_ProductDetails1_div360">
                  <div class="zoom360"> <a id="ctl00_ctl00_cphContent_ProductDetails1_img360" class="unactive">360 độ</a> </div>
                </div>
                <div id="ctl00_ctl00_cphContent_ProductDetails1_divVideo">
                  <div class="zoom-video"> <a id="ctl00_ctl00_cphContent_ProductDetails1_imgVideo" class="unactive">Video</a> </div>
                </div>
                &nbsp; </div>
            </div>
            <div class="product_detail_thumbnail">
              <div class="detail_thumbnail">
                <ul>
                  <?php foreach ($b_product as $row) {
                  ?>
                  <li> 
                    <a title="<?php echo $b_name; ?>" class="firstzoom" href="<?php echo $row->image; ?>" alt="<?php echo $b_name; ?>" title="<?php echo $b_name; ?>"> 
                      <img onmousemove="changeThumbnail(this)" height="63" width="58" src="<?php echo $row->image; ?>" alt="<?php echo $b_name; ?>">
                    </a> 
                  </li>
                  <?php }?>
                </ul>
              </div>
              <div class="thumbnail-ctrl"> <a class="btn_up" href="#">&nbsp;</a> <a class="btn_down" href="#">&nbsp;</a> </div>
            </div>
          </div>
        </div>
        <!-- END: PRODUCT SHOW --> 
        <!-- BEGIN: DESCRIPTION -->
        <div id="product_detail_description">
          <div class="product_detail_title">
            <h2> <?php echo $b_name; ?></h2>
          </div>
          <div class="block_detail">
            <div class="block_detail_left">
              <div id="ctl00_ctl00_cphContent_ProductDetails1_update1">
                <p class="p_code">
                  <label>Mã sản phẩm:</label>
                  <span><?php echo $b_code; ?></span> </p>
                <p class="p_award_after">
                  <label>Giá sản phẩm:</label>
                  <span> <?php echo ($b_newprice > 0)? number_format($b_newprice,"","",".") : number_format($b_oldprice,"","","."); ?>đ</span> </p>
                <div class="content_product_list">
                  <p class="addtocart">
                    <input type="button" class="btnAddToCart_Iframe" href="javascript:void(0)" rel="17aa7ce4-e9b4-4b62-9813-a37132ef6f4c" relid="56b9716e-da41-4338-976f-42c38d2d51cc" stock="1" quantity="0" style="cursor:pointer;font-size:11px;background:none;border:none; width:100%;text-align:left;" value="Mua sản phẩm" paymode="Online" price="1895000,0000" title="Còn hàng">
                  </p>
                </div>
              </div>
              <div id="content_product_c3">
                <div id="Select" style="margin:0px;" class="content_product_list">
                  <div class="black_button3"> </div>
                </div>
              </div>
            </div>
            <div class="block_detail_right">
              <p class="addcomment" style="display: ;"> <a href="/mua-sam/phu-kien-nam/giay-dep/giay-nam-ecco-mau-den-mo-androw-53252402001-viet-danh-gia.aspx?ref=merchant&amp;iframe=true&amp;width=610&amp;height=265" rel="prettyPhoto[iframes]"> <span onclick="redirectreview()" style="background:transparent;margin-top:-7px;">Viết đánh giá</span></a> </p>
              <p class="addcomment"> <a href="/mua-sam/phu-kien-nam/giay-dep/giay-nam-ecco-mau-den-mo-androw-53252402001.aspx" style="display: ;">Sản phẩm liên kết</a> </p>
            </div>

            <div class="block_detail_pay"> 
              <!-- Hinh thuc mua hang -->
              <!--
              <p>Hình thức thanh toán:</p>
              <p class="bantaicuahang_hien"><a href="#">Bán tại cửa hàng</a></p>
              <p class="giaohangnhantien_an"><a href="#">Giao hàng nhận tiền</a></p>
              <p class="thanhtoantructuyen_hien"><a href="#">Thanh toán trực tuyến</a></p>
              -->
              <!-- End Hinh thuc mua hang --> 
              
            </div>
          </div>
          <div id="ch_products" style="float:left;width:100%;">
            <div id="products_head_tab" style="z-index:998!important">
              <ul id="products_selection2" class="tabs">
                <!--class="tabs"-->
                <li class=""><a href="#tab1"><em>Thông tin chi tiết</em></a></li>
                <li class=""><a href="#tab2"><em> Thông số kỹ thuật</em></a></li>
              </ul>
            </div>
            <div class="product_list_container">
              <div class="tab_container" style="_margin-top:-9px;"> 
                <!--<div class="tab_t"></div>-->
                <div class="tab_c">
                  <div id="tab1" class="tab_content2" style="word-wrap: break-word; text-align: justify; display: block;"> <br>
                    <br>
                    <p> Thương hiệu: <b style="color:red;"><?php echo $h_name; ?></b><br>
                    <?php echo $h_descriptionbrand; ?>
                    <?php echo $b_detail; ?>
                    <p style="font-weight:bold;margin-top:10px;text-align:left;display:none;">® Thông số kích cỡ sản phẩm: </p>
                  </div>
                  <div id="tab2" class="tab_content2"> 

                  </div>
                </div>
                <!--<div class="tab_b"></div>--> 
              </div>
            </div>
          </div>
        </div>
        <!-- END: DESCRIPTION --> 
        
        <!--BEGIN: LIKE PRODUCT -->
        <div class="like_product">
          <h2><span>&nbsp;</span> </h2>
          <div id="product_list_container"> 
            <a href="#" style="display:block">
            <button class="prev"></button>
            </a>
            <div id="scroll_slide">
              <ul>
                <?php foreach ($b_likeproduct['b_lview'] as $row) {                  
                ?>
                <li> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>"> <img src="<?php echo $b_likeproduct['b_limage'][$b_lcount]; ?>" alt="<?php echo $row->name; ?>" title="<?php echo $row->name; ?>" width="138" height="152"> </a> </li>
                <?php 
                  $b_lcount++;
                  }
                ?>
              </ul>
            </div>
            <a href="#" style="display:block">
            <button class="next"></button>
            </a> 
            <script type="text/javascript">
           $(function() {
            var visible = ($('#scroll_slide>ul>li').size() < 6) ? $('#scroll_slide>ul>li').size() : 6;
            $("#scroll_slide").jCarouselLite({
              btnNext: ".next",
              btnPrev: ".prev",
              scroll: 1,
              visible: visible
            });
          });

</script> 
          </div>
        </div>
        <!--END: LIKE PRODUCT --> 
      </div>
      <script type="text/javascript">
        
        function changeThumbnail(objImg) {
          $('#imgProduct').attr('src', objImg.src);
        }

        var count = $(".detail_thumbnail a img").size();
        if (count <= 5) {
          $(".btn_up").hide();
          $(".btn_down").hide();
        }
      </script> 
      <script type="text/javascript">
        $(document).ready(function() {
        
          //Default Action tab jquery
          $(".tab_content2").hide(); //Hide all content
          $("ul#products_selection2 li:first").addClass("active").show(); //Activate first tab
          $(".tab_content2:first").show(); //Show first tab content
          
          //On Click Event
          $("ul#products_selection2 li").click(function() {
            $("ul#products_selection2 li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(".tab_content2").hide(); //Hide all tab content
            var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
            $(activeTab).fadeIn(); //Fade in the active content
            return false;
          });
        
        });
      </script> 
      <script type="text/javascript">
      // Tuan - gioi han so luong thumb hien thi = 4.
        $(document).ready(function() {
          $(".detail_thumbnail ul li").each(function(index) {

            if (index > 3)
              $(this).attr('style', 'display:none');
          });
          
          $(".btn_up").hide();
          $(".btn_down").hide();        
        });    
      </script>
      <div class="cleaner"></div>
      </div>
    </div>
    <!-- END: PRODUCT --> 
  </div>
  <!-- END: BODY --> 
</div>
