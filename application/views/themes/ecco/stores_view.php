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
          <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/he-thong"; ?>?rel=<?php echo $hr_rel;?>">Hệ thống cửa hàng</a></li>
        </ol>
      </div>
      <!-- END: BREADCRUMB --> 
      <!-- BEGIN: COTACT -->
      <div class="box">
        <div id="ch_products">
          <div id="introduction">            
        <script type="text/javascript">
          $(document).ready(function() {
            loadScrollbar();  
          });
          function loadScrollbar() {
            $('#scrollbar3').tinyscrollbar({ scroll: true });
          }
        </script>
            <div class="right_pages">
              <div class="container">
                <div class="content" id="p2" style="display: block;">
                  <h2 class="address"> <span>Danh sách cửa hàng</span> </h2>
                  <div id="map" style="width:100%;">
                    <div class="contact_googlemap">
                      <div id="ctl00_ctl00_cphContent_ContactMerchantForm1_upContactAddress">
                        <div class="col3" style="width:35%;"> 
                          <p>
                            <iframe id="googleMap" scrolling="no" marginwidth="0" width="300" height="300" marginheight="0" frameborder="0" vspace="0" hspace="0" src="<?php echo base_url('themes'); ?>/map.html?longitude=<?php foreach ($b_liststore as $row) { echo ($row->latitude != 0)? $row->latitude.";" : ''; }  ?>&amp;latitude=<?php foreach ($b_liststore as $row) { echo ($row->longitude != 0) ? $row->longitude.";" : '';}  ?>"></iframe>
                          </p>
                        </div>
                        <div class="col4" style="width:57%;">
                          <div id="scrollbar3" style="width:433px;">
                            <div class="scrollbar">
                              <div class="track">
                                <div class="thumb">
                                  <div class="end"> </div>
                                </div>
                              </div>
                            </div>
                            <script>     
                              function Store_Click(x, y) {
                                     $('#googleMap').attr("src", "<?php echo base_url('themes'); ?>/map.html?longitude=" + x.toString().replace(',', '.') + "&latitude=" + y.toString().replace(',', '.'));
                              }                            
                            </script> 
                            <div class="viewport" style="width:415px;height:270px;">
                              <div class="overview"> <span id="ctl00_ctl00_cphContent_ContactMerchantForm1_lbAllMerchantOfCity"></span>
                                <?php 
                                    foreach ($b_liststore as $row) {                                 
                                    ?>
                                <div class="content_1" style="float:left;">
                                  <div style="cursor: pointer;" onclick="javascript:Store_Click('<?php echo $row->latitude; ?>' , '<?php echo $row->longitude; ?>')">
                                    <?php if($row->name != "") { ?><p class="title_merchantname"> <?php echo $row->name; ?> </p><?php } ?>
                                    <?php if($row->address != "") { ?><p class="icon_address"> <?php echo $row->address; ?> </p><?php } ?>
                                    <?php if($row->phone != "") { ?><p class="icon_tele"> Điện thoại: <?php echo $row->phone; ?> </p><?php } ?>
                                    <?php if($row->fax != "") { ?><p class="icon_fax"> Fax: <?php echo $row->fax; ?></p> <?php } ?>
                                  </div>
                                </div>
                                <?php }?>
                              </div>
                            </div>                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="p4" style="visibility:hidden;position:absolute;"> </div>
              </div>
            </div>
            <br clear="all">
          </div>
        </div>
      </div>
    </div>
    <!-- END: CONTACT --> 
  </div>
  <!-- END: BODY --> 
</div>
