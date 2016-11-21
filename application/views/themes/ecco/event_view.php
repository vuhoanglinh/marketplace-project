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
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>">Sự kiện</a></li>
          </ol>
        </div>
        <!-- END: BREADCRUMB -->  
        <!-- BEGIN: PRODUCT -->
          <div id="ch_containt">
          <div class="event">
            <h2><span>Sự kiện</span></h2>            
            <div id="ctl00_ctl00_cphContent_MerchantEventList_ctl00">              
              <div class="content_detail" id="content_detail" style="float:left;width:100%;">
                <!-- loading ajax -->
              </div>              
            </div>
          </div>
          <script type="text/javascript">
            $(document).ready(function(){
              function loadingevent(page,group) {
                $.ajax({
                      url: "<?php echo base_url('stores/merchant/paggingevent'); ?>",
                      type: "post",
                      data: "rel=<?php echo $id_store; ?>"+"&page="+page+"&n="+group,
                      success: function(data){
                        $('#content_detail').html(data);                        
                      }
                });
              }
              var page = <?php echo $page; ?>;
              var grouppage = <?php echo $grouppage; ?>;
              loadingevent(page,grouppage);
            });
            </script> 
          <div class="cleaner"></div>
        </div>       
      </div>
      <!-- END: PRODUCT --> 
    </div>
    <!-- END: BODY --> 
  </div>