<script src="<?php echo base_url('themes/default'); ?>/js/jsNews.js" type="text/ecmascript"></script>

	 <div class="video">
        <a class="title_video" href="#">
            </a>
        <div class="video_box">
            <div id="view_video" class="view_video">
            </div>
            <ul class="video_relate">
                <?php 
		        foreach ($news as $row) {        
		        ?>
               <li><a rel="" href='<?php echo $row->video; ?>'><i class="iconvideorelate"></i>
               	<span class="titleVideo" title='<?php echo $row->name; ?>'> <?php echo $row->name; ?> </span></a>
               </li>
               <?php } ?>     
            </ul>
        </div>
    </div>

		<!-- Pagging Begin -->
        <div class="pagging pagging-video">
          <ul class="pagging_nav">
            <li> <a class="pre_nav" href="javascript:void(0)" rel="tab2" page="<?php echo ($page > 1) ? $page - 1 : 1; ?>">pre</a></li>
            <?php 
              for( ; $index <= $endpage; $index++) {
            ?>
            <li <?php echo ($page == $index) ? 'class="active"' : ''; ?>> <a href="javascript:void(0)" rel="tab2" page="<?php echo $index; ?>"><?php echo $index; ?></a></li>
            <?php }?>
            <li> <a class="next_nav" href="javascript:void(0)" rel="tab2" page="<?php echo ($page < $toltalpage) ? $page + 1 : $toltalpage; ?>">next</a> </li>
          </ul>
        </div>
 	<script language="javascript" type="text/javascript">
		//-video-
		$(document).ready(function() {
			var title = $(".titleVideo").first().attr('title');
			$(".title_video").html(title);
			$(".titleVideo").click(function() {
				var title = $(this).attr('title');
				$(".title_video").html(title);
			});
		});
		$(function() {
			$("ul.video_relate").ytplaylist({
				addThumbs: false,
				autoPlay: false,
				holderId: 'view_video',
				playerHeight: '285',
				allowFullScreen: true,
				playerWidth: '470'
			});
		});
	</script>
	<script type="text/javascript">
        $(document).ready(function(){

          function loadingnews(page) {
            $.ajax({
              url: "<?php echo base_url('public/ajax/loadvideo'); ?>",
              type: "post",
              data: "page="+page,
              success: function(data){
                $('#newsVideo').html(data);                        
              }
            });
          }

          $("a[rel=tab2]").click(function(){
           var _page = $(this).attr('page');
           loadingnews(_page);                
          });
        });
        </script>