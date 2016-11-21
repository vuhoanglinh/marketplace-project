<!-- Breadcrumb Begin-->
<div class="breadcrumb">
  <ul class="brech">
    <li class="icon_home" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"> <a itemprop="url" href="<?php echo base_url() ?>" title="Trang chủ" rel="v:url" property="v:title"><span itemprop="title"></span></a></li>
    <li class="currentPage" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"> › <a itemprop="url" rel="v:url" property="v:title" href="<?php echo base_url('thoi-trang'); ?>" title="Thời trang"> <span itemprop="title">Thời trang</span> </a></li>
  </ul>
  <div id="ctl00_ctl00_cphContent_MainProduct1_BreadCrumb1_divH1" class="Breads">
    <h1 class="Breadscat">Tin thời trang & Bí quyết làm đẹp</h1>
  </div>
</div>
<!-- Breadcrumb End--> 
<section class="container"> 
  <div class="part_1"> 
	<!-- Slider News Begin-->
    <div id="slider_news">
      <ul id="featured" class="frame_view">
      	<?php 
      	foreach ($_featurenews as $row) {
      	
      	?>
        <li><a href="">
          <image src='<?php echo $row->images;?>' alt='<?php echo $row->name; ?>' title='<?php echo $row->name; ?>' />
          <h2> <span class="title-news-banner"><?php echo $row->name; ?></span> <span class="time_create"> | <?php echo mdate($datestring, strtotime($row->date_added)); ?></span> <span class="newsSummary"><?php echo $row->detail; ?></span> </h2>
          <span class="bg_pure"></span></a></li>  
        <?php } ?>
      </ul>
      <script type="text/javascript">
	      $(document).ready(function(){
		          $(".title-news-banner").each(function(){
		              var text = $(this).html();
		              if(text.length > 40){
		                  text = text.substring(0,40);
		                  $(this).html(text+' ...');
		              }
		          });
		          $("span.newsSummary").each(function(){
		              var text = $(this).html();
		              if(text.length > 100){
		                  text = text.substring(0,100);
		                  $(this).html(text+' ...');
		              }
		          });
		   });
		</script>
    </div>
    <!-- Slider End--> 
    <!-- Slider Advertise Begin-->
    <div class="advertise">
      <div class="advertise1" id="slider_adver"> <a href="" target="_blank"> <img alt='banner 1103-07' src='<?php echo base_url('themes/default/upload'); ?>/eed43841-bc38-4890-983b-14181f6ddbbd_001a.jpg' /> </a> </div>
      <div class="advertise2" id="slider_adver1"> <a href='' target="_blank"> <img alt='banner 1103-08' src='<?php echo base_url('themes/default/upload'); ?>/0cc461b4-36eb-40cd-aa56-38469a408ddd_001b.jpg' /> </a> </div>
    </div>
    <!-- Slider Advertise Begin--> 
  </div>
  <!-- Top news End--> 

  <script type="text/javascript">
  $(document).ready(function(){
  	$.ajax({
  		url : "<?php echo base_url('public/ajax/loadxhtt'); ?>",
  		type : 'post',
  		data : "page=1",
  		success: function(data){
  			$('#newsXHTT').html(data);
  		}
  	})
  })
  </script>
  <!-- Fashion Trends Begin-->
  <div class="part_2 Fashion Trends"> 
    <!-- -->
    <div class="newsXHTT">
      <h2><a href=""><span class="icon_trends"></span><?php echo $xhtt; ?></a><a class="more" href="">Xem thêm &gt;&gt;&gt;</a></h2>
  	  <div id="newsXHTT"></div>
  	</div>
  </div>

 <script type="text/javascript">
  $(document).ready(function(){
  	$.ajax({
  		url : "<?php echo base_url('public/ajax/loadxhtt2'); ?>",
  		type : 'post',
  		data : "page=1",
  		success: function(data){
  			$('#newsXHTT1').html(data);
  		}
  	})
  })
  </script>
<!-- News Begin-->
  <div class="part_3">  
	<!-- XU HƯỚNG THỜI TRANG & LÀM ĐẸP Begin -->
    <div id="XHTT" class="part_left"> 
      <!-- Content News Fashion Begin -->
	    <div class="newsBlockXHTT">
	      	<h2><a href=""><span class="icon_trends"></span><?php echo $xhtt; ?></a><a class="more" href="">Xem thêm &gt;&gt;&gt;</a></h2>
	      <div id="newsXHTT1"></div>
	  	</div>
  	</div>


  	<script type="text/javascript">
	  $(document).ready(function(){
	  	$.ajax({
	  		url : "<?php echo base_url('public/ajax/loadttt'); ?>",
	  		type : 'post',
	  		data : "page=1",
	  		success: function(data){
	  			$('#newsTTT').html(data);
	  		}
	  	})
	  })
	</script>
	<!-- Tin tức thời trang & làm đẹp Begin -->
    <div class="part_left"> 
      <!-- Content News Fashion Begin -->
      <div class="newsTTTT">
        <h2> <a href=""><span class="icon_news_fashion"></span><?php echo $ttt; ?></a><a class="more" href="">Xem thêm &gt;&gt;&gt;</a></h2>  	
  		<div id="newsTTT"></div>
  		</div>
  	</div>


  	<script type="text/javascript">
	  $(document).ready(function(){
	  	$.ajax({
	  		url : "<?php echo base_url('public/ajax/loadvideo'); ?>",
	  		type : 'post',
	  		data : "page=1",
	  		success: function(data){
	  			$('#newsVideo').html(data);
	  		}
	  	})
	  })
	</script>
  	<div class="part_right"> 
      <!-- Video Begin -->
      <div class="newsVideo">
        <h2> <a href=""><span class="icon_video_fashion"></span><?php echo $video; ?></a><a class="more" href="">Xem thêm &gt;&gt;&gt;</a></h2>
    </div>
    <div id="newsVideo"></div>
  </div>