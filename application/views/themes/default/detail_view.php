<!-- Breadcrumb Begin-->

<div class="breadcrumb">
  <ul class="brech">
    <li class="icon_home"> <a href="<?php echo base_url(); ?>" title="Trang chủ" ><span itemprop="title"></span></a></li>
    <?php 
    if($id_parent_category != "") {
    ?>
    <li class="currentPage"> › <a href="" title="<?php echo $name_parent_category?>"> <span itemprop="title"><?php echo $name_parent_category?></span> </a></li>
    <?php }?>
    <li class="currentPage"> › <a href="" title="<?php echo $name_category?>"> <span itemprop="title"><?php echo $name_category?></span> </a></li>
  </ul>
</div>
<!-- Breadcrumb End-->

<section class="container">
<!-- Procduct Content Begin -->
<script src="<?php echo base_url('themes/default'); ?>/js/cloud-zoom.1.0.2.js" type="text/ecmascript"></script>
<link href="<?php echo base_url('themes/francosarto'); ?>/css/cloud-zoom.css" rel="stylesheet" type="text/css"/>
<div class="span-26 fleft"> 
  <!-- Detail-Thumb-Images Begin -->
  <div class="detail-thumbs-images"> 
    <!-- Product Thumb Images Begin -->
    <div class="product_detail_thumbnail"> <a href="javascript:void(0)" class="dprev">&nbsp;</a>
      <div class="sli-thumbnail">
        <ul>
          <?php 
          	foreach ($thumb as $row) {          		
          	?>
          <li class="default"> <a onclick="return false;" href="<?php echo $row->image; ?>" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: '<?php echo $row->image; ?>'"> <img width="60" height="66" src="<?php echo $row->image; ?>" alt="<?php echo $nameproduct; ?>" title="<?php echo $nameproduct; ?>"> </a> </li>
          <?php }?>
        </ul>
      </div>
      <a href="javascript:void(0)" class="dnext">&nbsp; </a> </div>
    <!-- Product Thumb Images End --> 
    <!-- Wrap Product Begin -->
    <div id="wrap" style="top:0px;z-index:9;position:relative;float:left;width:318;height:350"> <a href="" class="cloud-zoom" id="zoom1" rel="tint0pacity:0.5 ,smoothMove:5 , zoomWidth:387, adjustY:-4, adjustX:10" style="position: relative; display: block; "> <img src="<?php echo $image; ?>"  width="318" height="350" alt="<?php echo $nameproduct; ?>" title="<?php echo $nameproduct; ?>" align="left" title="Optional title display" style="display: block; "/> </a> </div>
    
    <!-- Wrap Product End -->
    <div class="product-toolbox" style="display:none;">
      <div class="zoom">
        <p style="display: none;"> <a href="javascript:;" class="zoom-img" onclick="zoomButton_Click();" style="cursor: pointer;"> Xem hình lớn</a> </p>
        <p> <a id="img360" disabled="disabled" class="zoom-360-un">360 độ</a> </p>
        <p> <a id="imgVideo" disabled="disabled" class="zoom-mov-un">Xem video</a> </p>
      </div>
    </div>
    <script>$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();</script>
    <script language="javascript" type="text/javascript">
     $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();     
		//var img360 = '#ctl00_ctl00_ctl00_ctl00_cphContent_cphContent_cphContent_MediaBox1_img360';
		//var imgVideo = '#ctl00_ctl00_ctl00_ctl00_cphContent_cphContent_cphContent_MediaBox1_imgVideo';
		$(document).ready(function() {

			$(".sli-thumbnail").jCarouselLite({
			btnNext: ".dnext",
			btnPrev: ".dprev",
			vertical: true,
			circular: false,
			visible: 4,
			scroll: 1
		});
		/*
		if ($(img360).attr('disabled') != "disabled") {
			$(".zoom-360-un").prettyPhoto({
				theme: 'pp_default',
				showTitle: false,
				animationSpeed: 'fast',
				deeplinking: false
			});
		}
		if ($(imgVideo).attr('disabled') != "disabled") {
			$(".zoom-mov-un").prettyPhoto({
				theme: 'pp_default',
				showTitle: false,
				animationSpeed: 'fast',
				deeplinking: false
				});
			} */
		}); 
		
		</script> 
  </div>
  <!-- Detail-Thumb-Images End --> 
  <!-- Detail Container Begin -->
  <div class="detail-contener">
    <div class="rating-product">
      <div class="headtab">
        <ul class="tabs">
          <li><a href="#tab1" class="active">Thông tin sản phẩm</a></li>
          <li><a href="#tab2">Quy định đổi trả hàng</a></li>
        </ul>
      </div>
      <div id="tab1">
        <div class="detail-content">
          <h1><span id="lblProductTitle" itemprop="name"><?php echo $nameproduct; ?></span></h1>
          <div class="social-share" style="display:none"> </div>
          <div class="aggregateRating"> <a href="#write_review" class="write-rat">Viết đánh giá</a> </div>
        </div>
        <div class="detail-content2">
          <div class="leftt" itemprop="offers" itemscope="" itemtype="http://schema.org/AggregateOffer">
            <ul>
              <li><span class="ManufacterName ts">Thương hiệu </span><a href="<?php echo base_url('cua-hang')."/".$name_store."/trang-chu"; ?>?rel=<?php echo $id_store;?>">: <span class="dbrand"><?php echo $name_store; ?></span></a> </li>
              <li><span class="code-product ts">Mã hàng</span> <span class="sku">: <?php echo $code; ?></span></li>
              <li id="oldprice">
                <?php if($newprice < $oldprice) { ?>
                <span class="ts price-new">Giá cũ </span><span class="plistc">:</span> <span><?php echo number_format($oldprice,"","","."); ?>đ</span>
                <?php } ?>
              </li>
              <li id="price"><span class="ts price-new">Giá bán </span><span class="plistc">:</span><span class="lowPrice"><?php echo number_format($newprice,"","","."); ?>đ</span><sup><u>đ</u></sup></li>
              <li><span class="fltrt green"> <?php echo round((($newprice / $oldprice) - 1)*100); ?>%</span></li>
              <li id="cashback"></li>
              <li id="ProductInfo1_hidprice" style="display:none"></li>
              <li id="merchantlist">
                <div class="de-merchant">
                  <p>Cửa hàng đang bán:</p>
                  <p> <a href="<?php echo base_url('cua-hang')."/".$name_store."/trang-chu"; ?>?rel=<?php echo $id_store;?>"><?php echo $name_store; ?></a> </p>
                </div>
              </li>
              <li><a class="btn_g" id="merchantStore" href="">Bản đồ cửa hàng</a></li>
            </ul>
            <link itemprop="availability" href="http://schema.org/InStock">
          </div>
          <div class="rightt">
            <ul class="topp">
              <li id="liColor">
                <label>Màu sắc: </label>
                <div class="wrap-color">
                  <?php 
				                      foreach ($color as $row) {                       
				                    ?>
                  <a class="activecolor" onclick="" width="20px" height="20px"> <img src="<?php echo $row->image; ?>" width="20px" height="20px"> </a>
                  <?php } ?>
                </div>
              </li>
              <li id="liSize">
                <label> Kích cỡ:</label>
                <?php 
				                    foreach ($size as $row) {                       
				                 ?>
                <a onclick="" class="size"><?php echo $row->name; ?></a>
                <?php } ?>
              </li>
              <li id="liSizeWareHouse">
                <div class="sizechartpop"> <a class="sizechart" id="systemSize1" href="" style="display:none"></a> <a onclick="ClosePopup();" href="#"></a></div>
              </li>
              <li id="liNoWareHouse" style="display:none"> </li>
              <li>
                <label>Số lượng mua: </label>
                <input type="text" value="1" id="txtNoBuy" onblur="" style="width:40px;height:20px">
              </li>
              <li> <span id="error"></span> </li>
              <li id="btn_Buy"> <a onclick="" class="btn_blue" rel="b79b10cc-de65-42f8-9e5d-603561aba255" relid="45f923b1-a6f7-4ea3-acc6-f5edbda4c50a" stock="1" paymode="online" price="799.000đ" quantity="0" href="javascript:void(0)"> <span class="icon_cart">Mua hàng</span> </a> </li>
              <li></li>
            </ul>
            <div class="support_pay"> <span>Hỗ trợ thanh toán:</span>
              <ul class="support_pay1">
                <li class="taicuahang_an" title="Bán tại cửa hàng"> </li>
                <li class="tienmat_an" title="Thanh toán trực tuyến"></li>
                <li class="vanchuyen_an" title="Giao hàng nhận tiền"></li>
              </ul>
            </div>
            <div class="like_thiss" id="liked"> <a style="cursor: pointer;" id="addlike" onclick=""></a>
              <p>(<span id="totalCountLike">1</span>)</p>
            </div>
          </div>
        </div>
        <div class="detail-content3"></div>
      </div>
      <div id="tab2" style="display: none;">
        <div class="return_pd">
          <p>Chon.vn cho phép đổi/trả sản phẩm khi sản phẩm đổi/trả đúng theo những Quy định sau đây:</p>
          <b>Quy định đổi/trả hàng:</b>
          <p> .	Đổi hoặc trả hàng trong vòng 7 ngày kể từ ngày nhận được sản phẩm (theo dấu bưu điện). Chính sách đổi/trả không áp dụng cho sản phẩm khuyến mãi<br>
            .	Hàng còn nguyên tem, mạc, không bị dơ bẩn, hư hỏng, trầy xước, có mùi đã qua sử dụng hoặc đã qua giặt, tẩy.<br>
            .	Bộ phận chăm sóc khách hàng sẽ gọi điện xác nhận với Quý khách trong thời gian 3 ngày kể từ ngày nhận thông báo của Quý khách. <br>
          </p>
          <b>Lý do chấp nhận đổi/ trả hàng:</b>
          <p> .	Cửa hàng giao nhầm màu, nhầm size, nhầm sản phẩm so với yêu cầu của đơn hàng.<br>
            .	Sản phẩm bị hư hỏng do nhà sản xuất, hãng vận chuyển.<br>
            . 	Khi quý khách không hài lòng với sản phẩm và quy định của cửa hàng cho phép khách hàng đổi/trả hàng.<br>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Detail Container End --> 
</div>
<!-- Product Content End --> 

<!-- -->
<div class="span-26">
<div class="span-20">
  <div class="info_detail_product">
    <h2 class="head_h2_one"><span href="#">Thông tin thương hiệu</span></h2>
    <div class="brand_text">
      <div class="brand_pdd"> <span>Thương hiệu:</span> <strong itemprop="name"> <a id="hplManufacturerName" href="<?php echo base_url('cua-hang')."/".$name_store."/trang-chu"; ?>?rel=<?php echo $id_store;?>"><?php echo $name_store; ?></a></strong> </div>
      <div class="descrip_text"> <?php echo $detail_brand; ?> </div>
      <div id="divExpertReview" class="brand_text" style="display:none;">
        <div class="descrip_text">
          <p> Mô tả </p>
        </div>
      </div>
    </div>
    <h2 class="head_h2_one"><span href="#">Thông tin chi tiết</span></h2>
    <div class="brand_text"> <?php echo $detail; ?> </div>
    <div><?php echo $content; ?></div>
    <div class="space30"></div>
    <div class="block banner-ad1" style="margin-bottom: 18px; display: none;">
      <div class="catslider"></div>
      <h2 class="head_h2_three"><span href="#">Đánh giá người dùng</span></h2>
    </div>
  </div>
</div>
<!-- --> 

<!-- -->
<div class="span-21">
  <div class="watch-product-related">
    <h2 class="head_h2_five"> <span href="#">Sản phẩm cùng thương hiệu</span></h2>
    <div class="watch-product-roll"> <span href="#" class="opprev1">&nbsp;</span>
      <div class="scroll_pro1">
        <ul class="quick_buy">
        <?php 
        foreach ($likebrand['view'] as $row) {         
        ?>
          <li class="first">
            <div class="qbuy"> 
              <span class="baget_sale" style="display:<?php echo ($row->s_price < $row->price)? 'block' : 'none'; ?>"> <?php echo round((($row->s_price / $row->price) - 1)*100); ?>% </span>  
              <a rel="product-results" class="product" href="<?php echo base_url('san-pham').'/'.$row->title.'/chi-tiet?id='.$row->id; ?>"> 
                <img src="<?php echo $likebrand['image'][$_likecount]; ?>" width="145" height="155"> 
              </a>
              <a href="javascript:void(0)" style="bottom: -30px;"> &nbsp;Mua nhanh </a> </div>
            <a>
              <h3> <?php echo $likebrand['name_store'][$_likecount] ?></h3>
              <span class="price price_new"> <?php echo number_format($row->s_price,"","","."); ?>đ </span> <span class="price price_old"> <?php echo number_format($row->price,"","","."); ?>đđ</span>
            </a>
          </li>  
        <?php 
           $_likecount++;
        } ?>
        </ul>
      </div>
      <span href="#" class="opnext1">&nbsp;</span> </div>
  </div>

  <div class="same-price-products">
    <h2 class="head_h2_six"> <span href="#">Sản phẩm cùng giá</span></h2>
    <div class="same-price-roll">
      <span class="opprev2">&nbsp;</span>
      <div class="scroll_pro2">
        <ul class="quick_buy">
        <?php 
        foreach ($likeprice['view'] as $row) {         
        ?>
          <li class="first">
            <div class="qbuy"> 
              <span class="baget_sale" style="display:<?php echo ($row->s_price < $row->price)? 'block' : 'none'; ?>"> <?php echo round((($row->s_price / $row->price) - 1)*100); ?>% </span>  
              <a rel="product-results" class="product" href="<?php echo base_url('san-pham').'/'.$row->title.'/chi-tiet?id='.$row->id; ?>"> 
                <img src="<?php echo $likeprice['image'][$_likecount2]; ?>" width="145" height="155"> 
              </a>
              <a href="javascript:void(0)" style="bottom: -30px;"> &nbsp;Mua nhanh </a> </div>
            <a>
              <h3> <?php echo $likeprice['name_store'][$_likecount2] ?></h3>
              <span class="price price_new"> <?php echo number_format($row->s_price,"","","."); ?>đ </span> <span class="price price_old"> <?php echo number_format($row->price,"","","."); ?>đđ</span>
            </a>
          </li>  
        <?php 
           $_likecount2++;
        } ?>
        </ul>
        </div>
    </div>
  </div>
</div>


<script language="javascript" type="text/javascript">
    /*$(function() {
        $(".btn_hover").each(function() {


            if ($(this).attr("stock") == 0) {
                $(this).unbind('click');
            } else {
                $(this).payment({ autoPaymode: true });
            }
        }); 
    });*/

  
</script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
  //$(".scroll_pro1").jCarouselLite({
    //btnNext: ".opprev1",
    //btnPrev: ".opnext1",
    //mouseWheel: true,
    //visible: 2,
    //vertical: true,
    //circular: false
  
  //});
});
$(document).ready(function() {
  //$(".scroll_pro2").jCarouselLite({
  //btnNext: "jcarousel-prev.opprev2",
  //btnPrev: ".opnext2",
  //mouseWheel: true,
  //visible: 2,
  //vertical: true,
  //circular: false
  //});
});

$(document).ready(function() {
  var lis = $('ul.quick_buy li');
  for (var i = 0; i < lis.length; i += 2) {
    lis.slice(i, i + 2).wrapAll("<li class='li_group'><ul></ul></li>");
  }
  $('.quick_buy').jcarousel({
    //wrap: 'circular',
    vertical: true,
    scroll: 1,
    itemLoadCallback: itemLoadCallbackFunction
  });
  function itemLoadCallbackFunction(carousel, state) {
    for (var i = carousel.first; i <= carousel.last; i++) {
    // Check if the item already exists
      if (!carousel.has(i)) {
        // Add the item
        carousel.add(i, "I'm item #" + i);
      }
    }
  }
});
</script> 