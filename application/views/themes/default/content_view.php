<!-- Column Content Begin-->
      <section class="col_content">
        <header class="block banner-ad">
          <div class="catslider"> </div>
        </header>        
        <section id="result" style="float:none"> 
          <!-- Search Begin-->
          <div id="view_con" style="display:none;">
            <h3 class="title_search_result upper">Kết quả tìm kiếm</h3>
            <div class="fltlft"><span>Tìm thấy <span id="lblTotalProduct">1482</span> sản phẩm: &nbsp;</span></div>
            <div class="fltrt view_info"> <span style="display:none">Hiển thị:</span> <a href="javascript:void(0)" onclick="SelectDivImg(this)" id="view_by_img" class="view_by view_by_active">Xem theo hình ảnh</a> <a href="javascript:void(0)" onclick="SelectDivContent(this)" id="view_by_content" class="view_by">Xem theo nội dung</a> </div>
          </div>
          <!-- Search End--> 
          
          <!-- Search Result Begin-->
          <div id="search_result"> 
            <!-- View sort Begin-->
            <div id="view_sort" class="fltlft" style="width:100%">
              <div class="search_sort_icon">
                <ul>
                  <li><a class="sorter" id="highestprice" rel="highestprice" href="javascript:void(0)">giá cao nhất</a></li>
                  <li style="margin-left:50px"><a class="sorter" id="lowestprice" rel="lowestprice" href="javascript:void(0)">giá thấp nhất</a></li>
                  <li style="margin-left:50px"><a class="sorter" id="promotionhighest" rel="promotionhighest" href="javascript:void(0)">khuyến mãi lớn nhất</a></li>
                  <li style="margin-left:50px"><a class="sorter active" id="favourite" rel="favourite" href="javascript:void(0)">yêu thích nhất</a></li>
                </ul>
              </div>
            </div>
            <!-- View sort End--> 
            <script type="text/javascript">
            $(document).ready(function(){
              function loadtproduct(page)
              {
                $.ajax({
                  url: "<?php echo base_url('public/index/paggingproduct'); ?>",
                  type: "post",
                  data: "page="+page,
                  success: function(data){
                    $('#list_product').append(data).fadeIn(1000);
                  }
                });
              }
              var page  = 0;
              loadtproduct(page);
              var total = <?php echo $total_page; ?>;  
              $(window).scroll(function(){
                if($(window).scrollTop() == $(document).height() - $(window).height() )
                {
                  if(page < total)
                  {
                    page++;
                    loadtproduct(page);
                  }       
                } 
              });
            });
            </script>
            <!-- Result List Begin-->
            <ul class="result_list" id="list_product">
              
            </ul>
            <!-- Result List End-->             
          </div>
          <!-- Search Result End--> 
        </section>
      </section>
      <!-- Column Content End--> 
    </section>
    <!-- Main content End --> 
  </article>
  <!-- Column Main Full --> 