    <style>
      .total
      {
          background: none repeat scroll 0 0 #FFFFFF;
          display: inline-block;
          float: left;
          margin: 0 5px 0 -5px;
          padding-right: 20px;
      }
      .muahang,.hethang
      {
        background: url("<?php echo base_url('themes') ?>/francosarto/images/btn_Buy_Item1.png") no-repeat scroll left top transparent;
          bottom: 4px;
          color: #FFFFFF;
          float: left;
          font-size: 12px;
          height: 27px;   
          margin-left: 5px;
          position: absolute;
          text-align: center;
          line-height: 26px;
          width: 160px;
          text-transform: uppercase;
      }
      .muahang:hover, .hethang:hover{background: url("<?php echo base_url('themes') ?>/francosarto/images/btn_Buy_Item2.png") no-repeat scroll left top transparent; color: #FFF;}
        
    </style>
    <div id="view_con">
    <div id="view_quan" class="fltlft"><p></p></div>
        <div id="view_sort" class="fltlft">
          <p> Sắp xếp kết quả theo:</p>
          <div class="sort_list"> 
            <a class="sortex <?php echo ($orderby == $b_new) ? 'active' : ''; ?>" href="javascript:void(0)" rel="<?php echo $b_new; ?>" id="sort_new">&nbsp;</a> 
            <a class="sortex <?php echo ($orderby == $b_highprice) ? 'active' : ''; ?>" href="javascript:void(0)" rel="<?php echo $b_highprice; ?>" id="sort_price_up">&nbsp;</a> 
            <a class="sortex <?php echo ($orderby == $b_lowprice) ? 'active' : ''; ?>" href="javascript:void(0)" rel="<?php echo $b_lowprice; ?>" id="sort_price_down"> &nbsp;</a> 
            <a class="sortex <?php echo ($orderby == $b_sale) ? 'active' : ''; ?>" href="javascript:void(0)" rel="<?php echo $b_sale; ?>" id="sort_sale"> &nbsp;</a> 
          </div>
        </div>
      </div>
      <div class="clearfloat"></div>
      <h2 class="resultSearch"></h2>
      <div class="search_top_paging">
        <h3 class="title_search_result upper red1"> Kết quả tìm kiếm &nbsp</h3>
        <ul class="paging fltrt">
          <span>
          <div class="total"> Tìm thấy <?php echo $num_result; ?> sản phẩm </div>
          <a class="command" <?php echo ($grouppage <= 1) ? 'disabled="disabled"' : 'rel="nex"'; ?> group="<?php echo ($grouppage > 1) ? $grouppage - 1 : 1; ?>">Đầu</a>
          <a class="command" <?php echo ($page <= 1) ? 'disabled="disabled"' : ''; ?> href="javascript:void(0)" rel="tab" page="<?php echo ($page > 1) ? $page - 1 : 1; ?>">Trước</a>
            <?php 
            for( ; $index <= $endpage; $index++) {
              if($page == $index) {
                echo '<span class="current">'.$index.'</span>';
              }
              else {
                echo '<a class="command" href="javascript:void(0)" rel="tab" page="'.$index.'" >'.$index.'</a>';
              }
            }?>
            <a class="command" <?php echo ($page >= $toltalpage) ? 'disabled="disabled"' : ''; ?> href="javascript:void(0)" rel="tab" page="<?php echo ($page < $toltalpage) ? $page + 1 : $toltalpage; ?>" >Sau</a>&nbsp;
          <a class="command" <?php echo ($grouppage >= $toltalgroup) ? 'disabled="disabled"' : 'rel="nex"'; ?> href="javascript:void(0)" group="<?php echo ($grouppage < $toltalgroup) ? $grouppage + 1 : $toltalgroup; ?>">Cuối</a>
          </span>
        </ul>
      </div>
      <div id="search_result">
        <ul class="result_list">
          <?php
            foreach ($b_product['b_view'] as $row) {                    
          ?>

          <li <?php echo ($b_count % 4 == 0) ? 'style="clear:both;"' : ''; ?>>
            <div class="search_pro"> <span class="baget <?php echo ($row->type > 1) ? 'baget_hot' : (($row->type == 1) ? 'baget_new' : ''); ?>  ">&nbsp;</span> 
              <a class="figure2" href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>"> 
              <img title="<?php echo $row->name; ?>" alt="<?php echo $row->name; ?>" width="178" height="195" class="imgSearch" alt="<?php echo $row->name; ?>" src="<?php echo $b_product['b_image'][$b_count]; ?>"> 
              <span class="big-sale" style="display:<?php echo ($row->s_price > 0)? 'block' : 'none'; ?>"> <?php echo round((($row->s_price / $row->price) - 1)*100); ?>% </span> </a>
              <div class="featured_products_list_info showMeHow"> <a title="<?php echo $row->name; ?>" alt="<?php echo $row->name; ?>" href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>" class="search_pro_name black fltlft"><strong> <?php echo $row->name;?> </strong></a><br>
                <div class="clearfloat"> </div>
                <span class="price fltlft" title="Giá bán khuyến mãi"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","",".");?> đ</span>  <span class="old_price fltlft" style="display:<?php echo ($row->s_price > 0)? 'block':'none';?>"><?php echo number_format($row->price,"","","."); ?></span>
                <a class="muahang btn_black" href="javascript:void(0)"><span> Mua hàng </span> </a> 
              </div>
            </div>
          </li>
          <?php 
            $b_count++;                    
            } //end loop future product
          ?> 
          
        </ul>
        <div class="clearfloat"> </div>
      </div>
      <div class="clearfloat"> </div>
      <div class="search_top_paging">
        <h3 class="title_search_result upper red1"> Kết quả tìm kiếm &nbsp</h3>
        <ul class="paging fltrt">
          <span>
          <div class="total"> Tìm thấy <?php echo $num_result; ?> sản phẩm </div>
          <a class="command" <?php echo ($grouppage <= 1) ? 'disabled="disabled"' : 'rel="nex"'; ?> group="<?php echo ($grouppage > 1) ? $grouppage - 1 : 1; ?>">Đầu</a>
          <a class="command" <?php echo ($page <= 1) ? 'disabled="disabled"' : ''; ?> href="javascript:void(0)" rel="tab" page="<?php echo ($page > 1) ? $page - 1 : 1; ?>">Trước</a>
            <?php 
            for( ; $index2 <= $endpage; $index2++) {
              if($page == $index2) {
                echo '<span class="current">'.$index2.'</span>';
              }
              else {
                echo '<a class="command" href="javascript:void(0)" rel="tab" page="'.$index2.'" >'.$index2.'</a>';
              }
            }?>
            <a class="command" <?php echo ($page >= $toltalpage) ? 'disabled="disabled"' : ''; ?> href="javascript:void(0)" rel="tab" page="<?php echo ($page < $toltalpage) ? $page + 1 : $toltalpage; ?>" >Sau</a>&nbsp;
          <a class="command" <?php echo ($grouppage >= $toltalgroup) ? 'disabled="disabled"' : 'rel="nex"'; ?> href="javascript:void(0)" group="<?php echo ($grouppage < $toltalgroup) ? $grouppage + 1 : $toltalgroup; ?>">Cuối</a>
          </span>
        </ul>
      </div> 

      <form action="" method="post" id="frmfilter" name="frmfilter">
        <input type="hidden" id="hd_filter" value="<?php echo $b_orderby; ?>">
      </form>

        <script type="text/javascript">
            var url = "<?php echo $url ?>";
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
                var order = $("#hd_filter").val();
                var _page = $(this).attr('page');
                var stateObject = {};     
                
                var newUrl = url+'&page='+_page;
                history.pushState(stateObject,'',newUrl);
                loadingproduct(_page,grouppage,order);
                
              });

              $("a[rel=nex]").click(function(){
                var order       = $("#hd_filter").val();
                var _page       = 0;
                var _grouppage  = $(this).attr('group');
                var stateObject = {};                
                var newUrl      = url+'&n='+_grouppage;
                history.pushState(stateObject,'',newUrl);
                loadingproduct(_page,_grouppage,order);

              });

              $("a.sortex").click(function(){
                $("#hd_filter").val($(this).attr('rel'));
                var order = $("#hd_filter").val();
                var _sort = order;
                var stateObject = {};     
                
                var newUrl = url+'&sort='+_sort;
                history.pushState(stateObject,'',newUrl);
                loadingproduct(1,grouppage,order);
              });              
            });
            </script>   