              <?php foreach ($product['view'] as $row) {
              ?>
              <li <?php echo ($index % 4 == 0) ? 'class="fourth"' : ''; ?>>
                <div class="search_pro"> 
                  <a alt="<?php echo $row->name; ?>" title="<?php echo $row->name; ?>" class="figure2" title="<?php echo $row->name; ?>" href="<?php echo base_url('san-pham').'/'.$row->title.'/chi-tiet?id='.$row->id; ?>"> 
                    <span class="baget_sale" style="display:<?php echo ($row->s_price < $row->price)? 'block' : 'none'; ?>"> <?php echo round((($row->s_price / $row->price) - 1)*100); ?>% </span> 
                    <span class="baget <?php echo ($row->type > 1) ? 'baget_hot' : (($row->type == 1) ? 'baget_new' : ''); ?>  ">&nbsp;</span>  
                    <img width="163" height="179" src="<?php echo $product['image'][$index]; ?>" class="search_pro_img"> 
                  </a>
                  <div class="featured_products_list_info"> <a href="<?php echo base_url('cua-hang')."/".$product['name_store'][$index]."/trang-chu"; ?>?rel=<?php echo $product['id_store'][$index]; ?>" class="search_pro_brand fltlft" title="<?php echo $product['name_store'][$index] ?>"> <?php echo $product['name_store'][$index] ?> </a><br>
                    <div class="search_pro_color"> <span class="color_title">Màu sắc:</span>
                      <ul>
                        <?php
                          foreach ($product['color'][$index] as $row1) {                            
                        ?>
                        <li class="box-color active"><a style="cursor: pointer;"><img src="<?php echo $row1->image; ?>" width="13px" height="13px"></a></li>
                        <?php } ?>
                      </ul>
                      <div class="clearfloat"></div>
                      <span class="color_title">Kích cỡ:</span>
                      <ul>
                        <?php
                          foreach ($product['size'][$index] as $row2) {                            
                        ?>
                        <li><span class="ssr"><?php echo $row2->name; ?></span></li>
                        <?php } ?>                      
                      </ul>
                    </div>
                    <div class="clearfloat"></div>
                    <span class="price fltlft" title="Giá bán khuyến mãi"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","",".");?> đ</span>  
                    <span class="old_price fltlft" style="display:<?php echo ($row->s_price > 0)? 'block':'none';?>"><?php echo number_format($row->price,"","","."); ?></span> 
                  </div>                   
                  <div class="buy_info" title="<?php echo $row->name; ?>" > <a href="javascript:void(0)" title="<?php echo $row->name; ?>" class="buy_btn"> <span> Mua hàng </span> </a> </div>
                </div>
              </li>        
              <?php 
              $index++;
              }
              ?>      
              <script type="text/javascript">
              $(document).ready(function() {
                  $('.result_list li').hover(function() {
                      $(this).find('.search_pro_color').stop().animate({ 'opacity': '1' });
                      $(this).find('.search_pro_color li').stop().animate({ 'opacity': '1' });
                  }, function() {
                      $(this).find('.search_pro_color').stop().animate({ 'opacity': '0' });
                      $(this).find('.search_pro_color li').stop().animate({ 'opacity': '0' });
                  });



              });
              </script>