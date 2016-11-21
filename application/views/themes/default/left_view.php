<!-- Sort By product Begin -->
      <nav class="col_left"> 
        
        <!-- Row catagory Begin-->
        <div class="col_left_block" id="cats">
          <h2 class="upper left_title"> <img src="<?php echo base_url('themes/default') ?>/css/images/filter.png">Lọc kết quả theo:</h2>
          <h2 class="upper toggle_title"> Danh mục sản phẩm<span class="minus">&nbsp;</span></h2>
          <div class="left_block_content left_cat">
            <ul>
              <li><a href="/khuyen-mai/"> <img src="<?php echo base_url('themes/default') ?>/css/images/xemtatca.png">Tất cả</a></li>
              <?php 
                foreach ($category['parent'] as $row) {             
              ?>
              <li><a href=""> <img src="<?php echo base_url('public').'/'.$row->images; ?>" alt="<?php echo $row->name; ?>" title="<?php echo $row->name; ?>" width="30" height="30"> <?php echo $row->name; ?></a>
                <ul>
                  <?php 
                  foreach ($category['children'][$categorycount] as $row1) { 
                  ?>
                  <li><a href=""> <img src="<?php echo base_url('public').'/'.$row1->images; ?>" alt="<?php echo $row1->name; ?>" title="<?php echo $row1->name; ?>" width="30" height="30">  <?php echo $row1->name; ?> (<?php echo $category['countproduct'][$countproduct] ?>) </a></li>                  
                  <?php 
                    $countproduct++;
                    if($countproduct % 4 == 0) { break;}
                    }
                  ?>
                </ul>
              </li>		
              <?php
                $categorycount++;
                if($categorycount == $limitcategory) { break;}
                }
              ?>	 
            </ul>
            <div class="clearfloat"> </div>
          </div>
          <div id="divMoreCategories" style="display: block; float: right"> <a class="category_more">Thêm nữa &gt;</a> </div>
          <div class="clearfix"> </div>
          <div id="divCategoriesNext">
            <div class="left_block_content left_cat">
              <ul>
                <a href="javascript:void(0)" id="closemore" onclick="CloseBoxNav('divCategoriesNext')"> <img src="<?php echo base_url('themes/default'); ?>/css/images/close.png"> </a>                
                <?php 
                  foreach ($category['parent'] as $row) {      
                    if($category2count >= $categorycount) {    
                ?>
                <li><a href=""> <img src="<?php echo base_url('public').'/'.$row->images; ?>" alt="<?php echo $row->name; ?>" title="<?php echo $row->name; ?>" width="30" height="30"> <?php echo $row->name; ?></a>
                  <ul>
                    <?php 
                    foreach ($category['children'][$category2count] as $row1) { 
                    ?>
                    <li><a href=""> <img src="<?php echo base_url('public').'/'.$row1->images; ?>" alt="<?php echo $row1->name; ?>" title="<?php echo $row1->name; ?>" width="30" height="30">  <?php echo $row1->name; ?> (<?php echo $category['countproduct'][$countproduct] ?>) </a></li>                  
                    <?php 
                      $countproduct2++;
                      if($countproduct2 % 4 == 0) { break;}
                      }
                    ?>
                  </ul>
                </li>   
                <?php
                      }
                  $category2count++;                  
                  }
                ?> 		
              </ul>
            </div>
          </div>
        </div>
        <!-- Row catagory Begin--> 
        
        <!-- Row 2 Begin-->
        <div class="col_left_block">
          <h2 class="upper toggle_title" onclick="titleClick(this)"> Giá bán <span class="minus">&nbsp;</span></h2>
          <div class="left_block_content" id="left_search_price_block">
            <ul class="price_choice">
              <li><a href="/khuyen-mai/?pmax=300000">Dưới 300.000đ</a></li>
              <li><a href="/khuyen-mai/?pmin=300000&amp;pmax=500000">300.000đ - 500.000đ</a></li>
              <li><a href="/khuyen-mai/?pmin=500000&amp;pmax=1000000">500.000đ - 1.000.000đ</a></li>
              <li><a href="/khuyen-mai/?pmin=1000000&amp;pmax=2000000">1.000.000đ - 2.000.000đ</a></li>
              <li><a href="/khuyen-mai/?pmin=2000000&amp;pmax=5000000">2.000.000đ - 5.000.000đ</a></li>
              <li><a href="/khuyen-mai/?pmin=5000000">Trên 5.000.000đ</a></li>
            </ul>
            <div class="clearfloat"> </div>
            <div class="content">
              <div>
              <form action="" id="frmPrice" name="frmPrice" method="post">
                <label for="price_from"> Giá từ:</label>
                <input name="txtPriceFrom" type="text" id="txtPriceFrom" defaulttext="« thấp nhất »">      
                <label for="price_to"> đển:</label>
                <input name="txtPriceTo" type="text" id="txtPriceTo" defaulttext="« cao nhất »">                
              </form>
              </div>
            </div>
            <div class="clearfloat"> </div>
          </div>
        </div>
        <!-- Row 2 End--> 
        <!-- Row 3 Begin-->
        <div class="col_left_block">
          <h2 class="upper toggle_title" onclick="titleClick(this)"> Khuyến mãi <span class="minus">&nbsp;</span></h2>
          <div class="left_block_content" id="left_search_price_block" style="display: block;">
            <ul>
              <li><a href="/khuyen-mai/?promin=1&amp;promax=10">Dưới 10%</a></li>
              <li><a href="/khuyen-mai/?promin=10&amp;promax=20">10%-20%</a></li>
              <li><a href="/khuyen-mai/?promin=20&amp;promax=30">20%-30%</a></li>
              <li><a href="/khuyen-mai/?promin=30&amp;promax=50">30%-50%</a></li>
              <li><a href="/khuyen-mai/?promin=50&amp;promax=100">Trên 50%</a></li>
            </ul>
          </div>
        </div>
        <!-- Row 4 End--> 
        
        <!-- Row 5 Begin-->
        <div class="col_left_block">
          <div class="toggle_image">
            <ul>
              <li> <a href="http://www.chon.vn/cua-hang/quoctephunu2014.aspx?utm_source=timkiem_left&amp;utm_medium=banner&amp;utm_campaign=quoctephunu2014&amp;utm_nooverride=1"> <img src="http://img.chon.vn/thumbnail.ashx?width=210&amp;url=/Files/upload/Images/Banner/ea0e33cd-9736-4aa6-9268-dee8e53c8229_right-banner-210x300.jpg" width="210" alt="banner 2801-09" target="_blank"></a> </li>
            </ul>
          </div>
        </div>
        <!-- Row 5 End--> 
      </nav>
      <!-- Sort By product End -->