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
          </ol>
        </div>
        <!-- END: BREADCRUMB --> 
        <!-- BEGIN: PRODUCT --> 
        <form action="" method="post" name="frmcart" id="frmcart">
        <!-- BEGIN: NEW PRODUCT -->
        <div id="ch_containt">
          <div id="Content_colums">
            <div id="ctl00_ctl00_cphContent_LatestMerchantProductList161">
              <div class="right_module">
                <h2> <span>Sản Phẩm Mới</span></h2>
                <ul class="product_list">
                  <?php
                  foreach ($b_product['b_future'] as $row) {                    
                  ?>
                  <li>
                    <div class="title_product">
                      <div class="product_title_details">
                        <h3> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>" title="<?php echo $row->name; ?>"> <?php echo $row->name; ?></a> </h3>
                      </div>
                      <div class="image_wrapper"> <a class="zoom360image" rel="prettyPhoto" style="display: none" href=""> </a>
                        <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>" title="<?php echo $row->name; ?>"> 
                          <img src="<?php echo $b_product['b_fimage'][$b_fcount]; ?>" alt="<?php echo $row->name;?>" title="<?php echo $row->name; ?>" width="133" height="146">                         
                          
                        </a> 
                      </div>
                      <p> <span class="priceNew"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","","."); ?>đ</span> </p>
                      <p <?php echo ($row->s_price > 0)? '' : 'style="display: none;"';?>> <span class="priceOld"> <?php echo number_format($row->price,"","",".") ?>đ</span> </p>
                      <p style="display: none;">&nbsp; </p>
                      <div class="content_product_list">
                        <p class="buttonStore">
                          <input type="button" class="btnAddToCart_Iframe addtocart_button_module" rel="<?php echo $id_store; ?>" relid="<?php echo $row->id; ?>" style="margin:0;padding:0;height:17px;font-weight:normal;" href="javascript:;" value="Mua sản phẩm" title="Còn hàng">
                        </p>
                      </div>
                    </div>
                  </li>
                  <?php 
                    $b_fcount++;
                    if($b_fcount > 5) { break;}
                    } //end loop future product
                  ?>                  
                </ul>
                <div id="pagenav"> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/"; ?>?rel=<?php echo $hr_rel;?>"> Xem tất cả&gt;&gt;&gt;</a> </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: NEW PRODUCT --> 
        <!-- BEGIN: MOST VIEW PRODUCT -->
        <div id="ch_containt">
          <div id="ch_productnew">
            <div id="ctl00_ctl00_cphContent_upMostViewMerchantProductLost16">
              <h2><span>Sản phẩm xem nhiều nhất</span> </h2>
              <ul class="productnew_list">
                <?php
                  foreach ($b_product['b_mostview'] as $row) {                    
                  ?>
                  <li>
                    <div class="title_product">
                      <div class="product_title_details">
                        <h3> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>" title="<?php echo $row->name; ?>"> <?php echo $row->name; ?></a> </h3>
                      </div>
                      <div class="image_wrapper"> <a class="zoom360image" rel="prettyPhoto" style="display: none" href=""> </a>
                        <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>" title="<?php echo $row->name; ?>"> 
                          <img src="<?php echo $b_product['b_mimage'][$b_mcount]; ?>" alt="<?php echo $row->name;?>" title="<?php echo $row->name; ?>" width="133" height="146">                         
                          
                        </a> 
                      </div>
                      <p> <span class="priceNew"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","","."); ?>đ</span> </p>
                      <p <?php echo ($row->s_price > 0)? '' : 'style="display: none;"'?>> <span class="priceOld"> <?php echo number_format($row->price,"","",".") ?>đ</span> </p>
                      <p style="display: none;">&nbsp; </p>
                      <div class="content_product_list">
                        <p class="buttonStore">
                          <input type="button" class="btnAddToCart_Iframe addtocart_button_module" rel="<?php echo $id_store; ?>" relid="<?php echo $row->id; ?>" style="margin:0;padding:0;height:17px;font-weight:normal;" href="javascript:;" value="Mua sản phẩm" title="Còn hàng">
                        </p>
                      </div>
                    </div>
                  </li>
                  <?php 
                    $b_mcount++;
                    if($b_mcount > 5) { break;}
                    } //end loop future product
                  ?>                   
              </ul>
              <div class="cleaner"></div>
              <div id="pagenav"> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/"; ?>?rel=<?php echo $hr_rel;?>&sort=highestviewed"> Xem tất cả&gt;&gt;&gt;</a> </div>
            </div>
          </div>
        </div>
        <!-- END: MOST VIEW PRODUCT --> 
		</form>
        <!-- BEGIN: ADVERTISE -->
        <div id="ch_adventiser">  
          <?php 
          foreach ($b_ad as $row) {          
          ?>
          <a href="<?php echo $row->link; ?>"><img src="<?php echo $row->image; ?>" width="684" height="278"> </a>
          <?php } ?>
        </div>
        <script>
			$(document).ready(function(){
				$("#ch_adventiser").cycle({
					fx: 'scrollLeft,scrollDown,scrollRight,scrollUp',
					randomizeEffects: true,
					speed: 2000,
					timeout: 2000
				});
			});
		</script> 
        <!-- END: ADVERTISE --> 
        <!-- BEGIN: NEWS -->
        <div id="ch_news">
          <h2> Sự kiện</h2>
          <div id="news_container">
            <div id="ctl00_ctl00_cphContent_UpdatePanel1"> <span id="ctl00_ctl00_cphContent_pager2"><a disabled="disabled" class="pageprev"></a>&nbsp;<a disabled="disabled" class="pagenext"></a>&nbsp;</span>
              <div id="news_wrapper">
                <ul id="news_items">
                  <?php 
                  foreach ($b_event as $row) {  
                    $b_index++;
                    if($b_index == $b_countevent) { break;}
                  ?>
                  <li>
                    <div class="nugget">
                      <div class="nugget_content">
                        <div>
                          <h3> <a title="<?php echo $row->name; ?>" href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>&i=<?php echo $row->id; ?>"><?php echo $row->time; ?></a></h3>
                          <h4 title="<?php echo $row->detail; ?>" class="detail_news"> <?php echo $row->detail; ?></h4>
                        </div>
                      </div>
                    </div>
                  </li>                  
                  <?php } ?>
                  <p class="read_more"> <a href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>"> Xem thêm &gt;&gt;&gt;</a></p>                  
                </ul>
              </div>
            </div>
          </div>
          <div id="ch_Contact">
            <h2> Liên hệ</h2>
            <p class="call"> <?php echo $b_hotline; ?> </p>
            <p class="read_more"> <a href="<?php echo base_url('cua-hang')."/".$h_name."/lien-he"; ?>?rel=<?php echo $hr_rel;?>"> Xem thêm &gt;&gt;&gt;</a></p>
          </div>
        </div>
        <!-- END: NEWS --> 
      </div>
    </div>
    <!-- END: BODY --> 
  </div>