<script type="text/javascript">
      $(document).ready(function(){
          $(".namePd a").each(function(){
              var text = $(this).html();
              if(text.length > 25){
                  text = text.substring(0,25);
                  $(this).html(text+' ...');
              }
          });
      })
</script>
<!-- CONTENT: BEGIN -->
<div id="">
  <div class="pd-new full">
    <div class="width-960">
      <div class="full">
        <div class="head-title">
          <h3> Sản phẩm mới </h3>
          <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/"; ?>?rel=<?php echo $hr_rel;?>" class="viewAll">Xem tất cả</a> </div>
        <div class="box-pd">
          <div class="cols-left">
            <?php
                  foreach ($b_product['b_future'] as $row) {                    
            ?>
            <div class="pd-imagery clcode"> <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>" class="box-img-pd"> <img src="<?php echo $b_product['b_fimage'][0]; ?>" title="<?php echo $row->name;?>" alt="<?php echo $row->name;?>" border="0" width="520"> <span class="sale" style="display:<?php echo ($row->s_price > 0) ? 'inline' : 'none'; ?>"> <em>-<?php echo round((($row->s_price / $row->price) - 1)*100); ?>%</em> </span> </a>
              <div class="box-info" style="overflow: hidden; height: 50px;">
                <h3 class="namePd"><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>"> <?php echo $row->name;?></a></h3>
                <div class="price"> <span class="priceNew"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","",".");?> đ</span> <?php echo ($row->s_price > 0)? '- <span class="priceOld" style="display:inline"> '.number_format($row->price,"","",".").'</span>' : '';?> </div>
                <a href="javascript:void(0);" class="buypd muahang"> <span> MUA HÀNG </span> </a> </div>
            </div>
            <?php
                break;
                } //end loop future product
            ?> 
          </div>
          <div class="cols-right">
            <?php
                  foreach ($b_product['b_future'] as $row) {     
                    if($b_fcount > 0) {            
            ?>
            <div class="pd-imagery pd-imagery-small <?php echo ($b_fcount % 2 == 0)? 'margin-none': ''; ?> clcode"> 
              <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>" class="box-img-pd"> 
                <img src="<?php echo $b_product['b_fimage'][$b_fcount]; ?>" title="<?php echo $row->name;?>" alt="<?php echo $row->name;?>" border="0" width="230"> <span class="sale" style="display:<?php echo ($row->s_price > 0) ? 'inline' : 'none'; ?>"> <em>-<?php echo round((($row->s_price / $row->price) - 1)*100); ?>%</em> </span> 
              </a>
              <div class="box-info">
                <h3 class="namePd"><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>"> <?php echo $row->name;?></a></h3>
                <div class="price"> <span class="priceNew"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","",".");?> đ</span> <?php echo ($row->s_price > 0)? '- <span class="priceOld" style="display:inline"> '.number_format($row->price,"","",".").'</span>' : '';?> </div>
                <a href="javascript:void(0);" class="buypd muahang"> <span> MUA HÀNG </span> </a> 
              </div>
            </div>
            <?php 
                    }
                    $b_fcount++; 
                    if($b_fcount > 4) { break;}
              } //end loop future product
            ?>  
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pd-selling full">
    <div class="width-960">
      <div class="full">
        <div class="head-title">
          <h3> Sản xem nhiều nhất </h3>
          <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/"; ?>?rel=<?php echo $hr_rel;?>&sort=highestviewed" class="viewAll">Xem tất cả</a> </div>
        <div class="selling-pd">
          <?php
            foreach ($b_product['b_mostview'] as $row) {                    
          ?>
          <div class="pd-imagery pd-imagery-small <?php echo ($b_mcount > 2)? 'margin-none': ''; ?> clcode"> 
              <a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>" class="box-img-pd"> 
                <img src="<?php echo $b_product['b_mimage'][$b_mcount]; ?>" title="<?php echo $row->name;?>" alt="<?php echo $row->name;?>" border="0" width="230"> <span class="sale" style="display:<?php echo ($row->s_price > 0) ? 'inline' : 'none'; ?>"> <em>-<?php echo round((($row->s_price / $row->price) - 1)*100); ?>%</em> </span> 
              </a>
              <div class="box-info">
                <h3 class="namePd"><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $hr_rel;?>"> <?php echo $row->name;?></a></h3>
                <div class="price"> <span class="priceNew"><?php echo ($row->s_price > 0)? number_format($row->s_price,"","",".") : number_format($row->price,"","",".");?> đ</span> <?php echo ($row->s_price > 0)? '- <span class="priceOld" style="display:inline"> '.number_format($row->price,"","",".").'</span>' : '';?> </div>
                <a href="javascript:void(0);" class="buypd muahang"> <span> MUA HÀNG </span> </a> 
              </div>
            </div>
          <?php 
            $b_mcount++;
            if($b_mcount > 3) { break;}
            } //end loop future product
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="pd-aside full">
    <div class="width-960">
      <div class="content2">
        <div class="sideLeft col1">
          <div class="box-event-home">
            <div class="head-title2">
              <h3> Sự kiện </h3>
            </div>
            <div class="list-event-home">
              <ul>
				        <?php 
                  foreach ($b_event as $row) {  
                    $b_index++;
                    if($b_index == $b_countevent) { break;}
                  ?>
                <li>
                  <h3> <a title="<?php echo $row->name; ?>" href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>&i=<?php echo $row->id; ?>"> <?php echo $row->name; ?> </a> </h3>
                  <span class="date"> <?php echo $row->time; ?></span> <a href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>" class="viewMore">Xem thêm »</a> </li>
				        <?php } ?>	
              </ul>
            </div>
          </div>
          <div class="box-contact-home">
            <div class="head-title2">
              <h3> Liên hệ </h3>
            </div>
            <div class="list-contact-home">
              <ul>
                <li> <strong>HotLine: <?php echo $b_hotline; ?></strong> </li>
                <li> <strong>Email: <?php echo $b_email; ?></strong> </li>
                <li> <strong>Add:</strong> <span> <?php echo $b_company; ?><br>
                  <?php echo $b_address; ?> </span></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="sideRight col2"> <!-- Banner quảng cáo --> 
          <?php 
          foreach ($b_ad as $row) {          
          ?>
          <a href="<?php echo $row->link; ?>"><img src="<?php echo $row->image; ?>" width="716"> </a>
          <?php } ?> 
		    </div>
      </div>
	  <script>
			$(document).ready(function(){
				$(".sideRight.col2").cycle({
					fx: 'curtainX,curtainY',
					randomizeEffects: true,
					speed: 2000,
					timeout: 2000
				});
			});
		</script> 
    </div>
  </div>
</div>

<!-- CONTENT: END -->