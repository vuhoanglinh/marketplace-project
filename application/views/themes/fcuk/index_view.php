<script type="text/javascript">
$(document).ready(function(){
    $(".dv-info-new h3").each(function(){
        var text = $(this).html();
        if(text.length > 10){
            text = text.substring(0,10);
            $(this).html(text+' ...');
        }
    });
})
</script>
<!--NEW PRODUCT: BEGIN-->
<div class="rw-hot rwleft">
  <div class="rw-hot-box rwdefault">
    <!-- Sản phẩm mới nhất -->
      <div class="rw-new">
        <div class="rw-new-box">          
          <ul class="rw-img-pdNew">
            <?php
                  foreach ($b_product['b_future'] as $row) {                    
            ?>
            <li>
              <div class="dv-img-new">
                <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>">
                    <img src="<?php echo $b_product['b_fimage'][$b_fcount]; ?>" title="<?php echo $row->name;?>" alt="<?php echo $row->name;?>" width="201" height="221"> 
                    <span class="baget-new"><i><?php echo ($row->s_price > 0)? round((($row->s_price / $row->price) - 1)*100) : '0'; ?>%</i></span>
                </a>
              </div>
              <div class="dv-info-new fontfamily2">
                  <h3><?php echo $h_name; ?></h3>
                  <span class="rw-price-new"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","",".");?> đ</span>
                  <span class="rw-price-old"><?php echo number_format($row->price,"","",".");?> đ</span>
              </div>
            </li>
            <?php 
                    
                  $b_fcount++; 
                  if($b_fcount > 7) { break;}
              } //end loop future product
            ?>  
          </ul>
        </div>
        <div class="viewMore1">
          <a class="viewAll" href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/"; ?>?rel=<?php echo $hr_rel;?>">Xem tất cả &gt;&gt;</a>
        </div>
      </div>
  </div>
</div>
<!--NEW PRODUCT: END-->

<!--BEST: BEGIN-->
<div class="rw-best rwleft">
  <div class="rw-best-box rwdefault">
    <!-- Sản phẩm xem nhiều -->
    <div class="rw-new">
        <div class="rw-new-box">          
          <ul class="rw-img-pdNew2">
            <?php
              foreach ($b_product['b_mostview'] as $row) {                    
            ?>
            <li>
              <div class="dv-img-new">
                <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>">
                  <img src="<?php echo $b_product['b_mimage'][$b_mcount]; ?>" title="<?php echo $row->name;?>" alt="<?php echo $row->name;?>" width="201" height="221"> 
                  <span class="baget-best"></span>
                </a>
              </div>
              <div class="dv-info-new fontfamily2">
                  <h3><?php echo $h_name; ?></h3>
                  <span class="rw-price-new"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","",".");?> đ</span>
                  <span class="rw-price-old"><?php echo number_format($row->price,"","",".");?> đ</span>
              </div>
            </li>
            <?php 
                $b_mcount++;
                if($b_mcount > 1) { break;}
              } //end loop most product
            ?>  
          </ul>
        </div>
        <div class="viewMore1">
          <a class="viewAll" href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/"; ?>?rel=<?php echo $hr_rel;?>&sort=highestviewed">Xem tất cả &gt;&gt;</a>
        </div>
    </div>
    <div class="rw-ads">                
      <!-- Sản phẩm nổi bật -->
      <div class="rw-wr-hot">
        <div class="rw-inner-hot rwleft sCrolling1">          
          <ul class="rw-img-pd rw-sroll-Hot">
            <?php
                  foreach ($b_product['b_hostview'] as $row) {                    
                ?>
                <li>
                  <div class="dv-img">
                    <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>">
                      <img src="<?php echo $b_product['b_himage'][$b_hcount]; ?>" title="<?php echo $row->name;?>" alt="<?php echo $row->name;?>" width="455" height="500"> 
                      <span class="baget-hot"></span>
                    </a>
                  </div>
                  <div class="dv-info">
                      <h3><?php echo $h_name; ?></h3>
                      <span class="rw-price-new"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","",".");?> đ</span>
                      <span class="rw-price-old"><?php echo number_format($row->price,"","",".");?> đ</span>
                  </div>
                </li>
                <?php 
                    $b_hcount++;
                    if($b_hcount > 5) { break;}
                  } //end loop most product
                ?>  
          </ul>
        </div>
      </div>
    </div>
    <div class="rw-news">
      <?php 
      foreach ($b_event as $row) {  
        $b_index++;
        if($b_index == $b_countevent) { break;}
      ?>
      <div class="rw-box-news">
        <div class="rw-news-info">
          <h3>
            <a title="<?php echo $row->name; ?>" href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>&i=<?php echo $row->id; ?>">
              <?php echo $row->name; ?>
            </a>
          </h3>
          <p title="<?php echo $row->detail; ?>">
            <span style="font-weight: bold; color: Red;"><?php echo $row->time; ?></span>
            <?php echo $row->detail; ?>
          </p>
          <a href="" class="readmore transitionCss">Xem Thêm...</a>
        </div>
      </div>  
      <?php } ?>                
    </div>
    <div class="viewMore2">
      <a id="lnkViewAllEvent" enableviewstate="false" class="viewAll" href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>">
        Xem tất cả &gt;&gt;</a>
    </div>
  </div>
</div> 

<!--BEST: END-->

<div class="rw-colection rwleft">
  <div class="rw-colection-box rwdefault">
    <div class="rw-inner-colection">
      <!-- ---------- -->
      <?php 
        foreach ($b_ad as $row) {          
      ?>
        <a style="width:960px;" href="<?php echo $row->link; ?>">
          <img src="<?php echo $row->image; ?>" width="960" alt="<?php echo $h_name; ?>" title="<?php echo $h_name; ?>"> 
          <span><?php echo $h_name; ?></span>
        </a>
      <?php } ?> 
      <!-- ---------- -->
    </div>
    <script>
      $(document).ready(function(){
        $(".rw-inner-colection").cycle({
          fx:              'scrollLeft,scrollDown,scrollRight,scrollUp', 
          randomizeEffects: false, 
          easing:          'easeInBack' // easing supported via the easing plugin
        });
      });
    </script> 
  </div>
</div>