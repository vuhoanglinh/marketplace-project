      <?php 
      foreach ($b_event as $row) {      
       $b_count++           
      ?>
       <div class="largetoggle"> <span class="stt"> <?php echo $b_count; ?></span> <span class="largetoggle-title"><?php echo $row->name; ?></span>
          <p class="event_post_date"><?php echo $row->time; ?></p>
          <p class="event_sum"><?php echo $row->detail; ?></p>
        </div>
        <div class="largetogglecontent" style="display: none;">
          <div id="content_detail">    
          <?php echo $row->text; ?>        
          </div>
          <div class="tool">
            <div class="spacing"></div>
            <ul class="detail_share fltlft">
              <li><a onclick="window.open('http://www.facebook.com/share.php?u='+document.location,'_blank');" title="Đăng lên Facebook" style="cursor: pointer;"> <img src="<?php echo base_url('themes') ?>/francosarto/images/fb.png" alt=""> </a></li>
              <li><a title="Đăng lên Twitter" style="cursor: pointer;" onclick="window.open('http://twitter.com/home?status='+document.location,'_blank');"> <img src="<?php echo base_url('themes') ?>/francosarto/images/tw.png" alt=""></a></li>
              <a title="Đăng lên Twitter" style="cursor: pointer;" onclick="window.open('http://twitter.com/home?status='+document.location,'_blank');"> </a>
            </ul>
            <a title="Đăng lên Twitter" style="cursor: pointer;" onclick="window.open('http://twitter.com/home?status='+document.location,'_blank');"> </a><a href="javascript:void(0);" class="close_event btn_blue fltrt">Đóng</a> </div>
          <div class="clearfloat"></div>
        </div>
      <?php 
        }
      ?>
        <div class="search_top_paging">
          <ul class="paging fltrt">
            <span id="lvPager">
              <a <?php echo ($grouppage <= 1) ? 'disabled="disabled"' : 'rel="nex"'; ?> group="<?php echo ($grouppage > 1) ? $grouppage - 1 : 1; ?>">Đầu</a>&nbsp;
              <a <?php echo ($page <= 1) ? 'disabled="disabled"' : ''; ?> href="javascript:void(0)" rel="tab" page="<?php echo ($page > 1) ? $page - 1 : 1; ?>">Trước</a>&nbsp;
              <?php 
                for( ; $index <= $endpage; $index++) {
                  if($page == $index) {
                    echo '<span class="current">'.$index.'</span>&nbsp;';
                  }
                  else {
                    echo '<a href="javascript:void(0)" rel="tab" page="'.$index.'" >'.$index.'</a>&nbsp;';
                  }
                }?>
              <a <?php echo ($page >= $toltalpage) ? 'disabled="disabled"' : ''; ?> href="javascript:void(0)" rel="tab" page="<?php echo ($page < $toltalpage) ? $page + 1 : $toltalpage; ?>" >Sau</a>&nbsp;
              <a <?php echo ($grouppage >= $toltalgroup) ? 'disabled="disabled"' : 'rel="nex"'; ?> href="javascript:void(0)" group="<?php echo ($grouppage < $toltalgroup) ? $grouppage + 1 : $toltalgroup; ?>">Cuối</a>
          </ul>
        </div>
        <script type="text/javascript" language="javascript"> 
        $(document).ready(function(){
          $(".largetogglecontent").hide();
          $('.largetoggle').click(function() {
            $(this).next().slideToggle("slow", "easeOutQuad", function() {
            });
          });

          $(".close_event").click(function() {

            $(this).parent().parent().slideToggle("20000", "easeOutQuad", function() {
            });
          });
        });
        </script>
                <script type="text/javascript">
                  var url = "<?php echo $url; ?>";
                  $(document).ready(function(){
                    var grouppage = <?php echo $grouppage; ?>;

                    function loadingevent(page,group) {
                      $.ajax({
                            url: "<?php echo base_url('stores/merchant/paggingevent'); ?>",
                            type: "post",
                            data: "rel=<?php echo $id_store; ?>"+"&page="+page+"&n="+group+"&url="+url,
                            success: function(data){
                              $('#content_detail').html(data);                        
                            }
                      });
                    }
                    
                    $("a[rel=tab]").click(function(){
                
                      var _page = $(this).attr('page');
                      var stateObject = {};     
                      
                      var newUrl = url+'&page='+_page;
                      history.pushState(stateObject,'',newUrl);
                      loadingevent(_page,grouppage);
                      
                    });

                    $("a[rel=nex]").click(function(){
                      var _page       = 0;
                      var _grouppage  = $(this).attr('group');
                      var stateObject = {};                
                      var newUrl      = url+'&n='+_grouppage;
                      history.pushState(stateObject,'',newUrl);
                      loadingevent(_page,_grouppage);
                    });                            
                  });
                </script>     
                