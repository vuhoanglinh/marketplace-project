              <script type="text/javascript">               
                $(document).ready(function() {
                  formatEventList();
                });

                function formatEventList() {
                  $('div.content_detail div.content_event').click(function() {
                    $(this).next().toggle('fast');
                    if ($(this).hasClass("active"))
                      $(this).removeClass("active");
                    else
                      $(this).addClass("active");
                    return false;
                  }).next().hide();


                  $('a.hideContent').click(function() {
                    $(this).parent().parent().prev().click();
                  });


                  $('a.hideAllContents').click(function() {
                    $('div.content_detail div.content_event').removeClass('active');
                    $('div.content_detail div.content_event_content').hide();
                  });
                }
                
              </script>

                <ul class="block_event">
                  <?php 
                  foreach ($b_event as $row) {
                    # code...
                  
                  ?>
                  <li class="leading_event">
                    <div class="block_content">
                      <div class="content_event" style="border:solid 0px;width:100%;margin:0px;padding:0px;" id="event22529" name="event22529">
                        <h3 class="block_title"><a href="#">
                          <p title="<?php echo $row->name; ?>"><?php echo $row->name; ?></p>
                          </a></h3>
                        <span class="create_date"><?php echo $row->time; ?></span>
                        <p title="<?php echo $row->detail; ?>"><?php echo $row->detail; ?></p>
                      </div>
                      <div class="content_event_content" style="width: 95%; display: none;">
                        <?php echo $row->text; ?>
                        <div class="block_share" style="display:none;">
                          <ul>
                            <li class="sharefriend"><a href="#">Chia sẻ trang này</a></li>
                            <li class="sendemail"><a href="#">Gửi mail cho bạn bè</a></li>
                          </ul>
                        </div>
                        <div class="actions" style="margin-top:10px;font-size:12px;"> <a class="hideContent">Thu nhỏ</a> | <a class="hideAllContents">Thu nhỏ tất cả</a></div>
                      </div>
                    </div>
                  </li>
                  <?php } ?>
                </ul>
                <div id="pagenav" style="margin-top:10px;display: block;width:98%;"> 
                  <span id="ctl00_ctl00_cphContent_MerchantEventList_lstEvents_pager2">
                    <div class="pageview" style="float:left;_padding:10px 0 0 10px;margin-right:390px;">
                      Đang hiển thị
                      <?php echo $start ?>
                      -
                      <?php echo $end ?>
                      trong số
                      <?php echo $num_result; ?>
                      sự kiện</div>
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
                  </span>
                </div>
                <script type="text/javascript">
                  var url = window.location;
                  $(document).ready(function(){
                    var grouppage = <?php echo $grouppage; ?>;

                    function loadingevent(page,group) {
                      $.ajax({
                            url: "<?php echo base_url('stores/merchant/paggingevent'); ?>",
                            type: "post",
                            data: "rel=<?php echo $id_store; ?>"+"&page="+page+"&n="+group,
                            success: function(data){
                              $('#content_detail').html(data);                        
                            }
                      });
                    }
                    
                    $("a[rel=tab]").click(function(){
                
                      var _page = $(this).attr('page');
                      var stateObject = {};     
                      
                      var newUrl = url+'&page='+_page;
                      //history.pushState(stateObject,'',newUrl);
                      loadingevent(_page,grouppage);
                      
                    });

                    $("a[rel=nex]").click(function(){
                      var _page       = 0;
                      var _grouppage  = $(this).attr('group');
                      var stateObject = {};                
                      var newUrl      = url+'&n='+_grouppage;
                      //history.pushState(stateObject,'',newUrl);
                      loadingevent(_page,_grouppage);
                    });                            
                  });
                </script>