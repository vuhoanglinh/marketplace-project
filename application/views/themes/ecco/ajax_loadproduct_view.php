<!-- BEGIN: PRODUCT HEADER -->
            <div id="products_head_wrapper">
              <h2> <span id="ctl00_ctl00_cphContent_MerchantProductListByCategory1_lblCategoryName">Thư mục '<?php echo ($b_namect != '') ? $b_namect : $namestore;  ?>'</span></h2>
              <div class="pageview" style="display: block; margin-right:54px">
                <form action="" method="post" id="frmfilter" name="frmfilter">
                  <select name="slSort"  id="slSort" style="height:22px;width:200px;">
                    <option <?php echo ($orderby == $b_new) ? 'selected="selected"' : ''; ?> value="<?php echo $b_new; ?>">Mới nhất</option>
                    <option <?php echo ($orderby == $b_old) ? 'selected="selected"' : ''; ?> value="<?php echo $b_old; ?>">Cũ nhất</option>
                    <option <?php echo ($orderby == $b_highprice) ? 'selected="selected"' : ''; ?> value="<?php echo $b_highprice; ?>">Giá cao nhất</option>
                    <option <?php echo ($orderby == $b_lowprice) ? 'selected="selected"' : ''; ?> value="<?php echo $b_lowprice; ?>">Giá thấp nhất</option>
                    <option <?php echo ($orderby == $b_mostview) ? 'selected="selected"' : ''; ?> value="<?php echo $b_mostview; ?>">Xem nhiều nhất</option>
                    <option <?php echo ($orderby == $b_litteview) ? 'selected="selected"' : ''; ?> value="<?php echo $b_litteview; ?>">Xem ít nhất</option>
                  </select>
                </form>
              </div>
              <div <?php echo ($num_result > 0) ? 'style="display:none"' : ''; ?>> <br>
                <br>
                <br>
                <br>
                Không tìm thấy sản phẩm</div>
            </div>
            <!-- END: PRODUCT HEADER --> 
            <!-- BEGIN: COLUMN PRODUCT -->
            <div id="Content_colums" style="">
              <div class="right_module">
                <form action="" method="post" name="frmcart" id="frmcart">
                  <ul class="product_list">
                    <?php
                  foreach ($b_product['b_view'] as $row) {                    
                  ?>
                  <li>
                    <div class="title_product">
                      <div class="product_title_details">
                        <h3> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>" title="<?php echo $row->name; ?>"> <?php echo $row->name; ?></a> </h3>
                      </div>
                      <div class="image_wrapper"> <a class="zoom360image" rel="prettyPhoto" style="display: none" href=""> </a>
                        <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>"> 
                          <img src="<?php echo $b_product['b_image'][$b_count]; ?>" alt="<?php echo $row->name;?>" title="<?php echo $row->name; ?>" width="133" height="146">                         
                          
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
                    $b_count++;                    
                    } //end loop future product
                  ?> 
                  </ul>
                </form>
              </div>
              <div class="cleaner"></div>
            </div>
            <!-- END: PRODUCT --> 
          </div>
        </div>
        <!-- END: COLUMN PRODUCT --> 
        <!-- BEGIN: PAGGING -->
        <div id="pagenav" style="display: block;width:98%;"> <span id="ctl00_ctl00_cphContent_MerchantProductListByCategory1_DataPager1">
          <div class="pageview" style="float: left; margin-right:300px;"> Đang hiển thị
            <?php echo $start ?>
            -
            <?php echo $end ?>
            trong số
            <?php echo $num_result; ?>
            sản phẩm</div>
          <a <?php echo ($grouppage <= 1) ? 'disabled="disabled"' : 'rel="nex"'; ?> class="button_nav2" group="<?php echo ($grouppage > 1) ? $grouppage - 1 : 1; ?>"></a>&nbsp;
          <a class="nav" <?php echo ($page <= 1) ? 'disabled="disabled"' : ''; ?> href="javascript:void(0)" rel="tab" page="<?php echo ($page > 1) ? $page - 1 : 1; ?>"></a>&nbsp;
            <?php 
            for( ; $index <= $endpage; $index++) {
              if($page == $index) {
                echo '<span class="current">'.$index.'</span>&nbsp;';
              }
              else {
                echo '<a href="javascript:void(0)" rel="tab" page="'.$index.'" >'.$index.'</a>&nbsp;';
              }
            }?>
            <a class="next" <?php echo ($page >= $toltalpage) ? 'disabled="disabled"' : ''; ?> href="javascript:void(0)" rel="tab" page="<?php echo ($page < $toltalpage) ? $page + 1 : $toltalpage; ?>" ></a>&nbsp;
          <a <?php echo ($grouppage >= $toltalgroup) ? 'disabled="disabled"' : 'rel="nex"'; ?> class="button_nav3" href="javascript:void(0)" group="<?php echo ($grouppage < $toltalgroup) ? $grouppage + 1 : $toltalgroup; ?>"></a>
          
        </div>
        <!-- END: PAGGING --> 

        <script type="text/javascript">
            var url = "<?php echo $url; ?>";
            $(document).ready(function(){
              var grouppage = <?php echo $grouppage; ?>;

              function loadingproduct(page,group,order) {
                $.ajax({
                      url: "<?php echo base_url('stores/merchant/paggingproduct'); ?>",
                      type: "post",
                      data: "rel=<?php echo $id_store; ?>"+"<?php echo '&c='.$b_idct; ?>"+"&sort="+order+"&page="+page+"&n="+group+"<?php echo '&q='.$b_key; ?>"+"&url="+url,
                      success: function(data){
                        $('#loadingproduct').html(data);                        
                      }
                });
              }
              
              $("a[rel=tab]").click(function(){
                var order = $("#slSort").val();
                var _page = $(this).attr('page');
                var stateObject = {};     
                
                var newUrl = url+'&page='+_page;
                history.pushState(stateObject,'',newUrl);
                loadingproduct(_page,grouppage,order);
                
              });

              $("a[rel=nex]").click(function(){
                var order       = $("#slSort").val();
                var _page       = 0;
                var _grouppage  = $(this).attr('group');
                var stateObject = {};                
                var newUrl      = url+'&n='+_grouppage;
                history.pushState(stateObject,'',newUrl);
                loadingproduct(_page,_grouppage,order);


              });

              $("#slSort").change(function(){
                var order = $("#slSort").val();
                loadingproduct(1,grouppage,order);
              });              
            });
            </script>   