      <script type="text/javascript">
        $(document).ready(function(){
              
              $(".short_desc").each(function(){
                  var text = $(this).html();
                  if(text.length > 100){
                      text = text.substring(0,100);
                      $(this).html(text+' ...');
                  }
              });
       });
      </script>
        <?php 
        foreach ($news as $row) {        
        ?>
        <div class="post">
          <div class="news_box"> <a class="title_post" href=""> <img src="<?php echo $row->images; ?>" width="140" height="98" title="<?php echo $row->name; ?>" alt="<?php echo $row->name; ?>"> </a>
            <div class="news_description"><a class="title_post" href="">
              <h4> <?php echo $row->name; ?></h4>
              <p> <span class="time_post"> <?php echo mdate($datestring, strtotime($row->date_added)); ?>
                - <em class="author_post"> <?php echo $namecategory; ?></em></span></p>
              <p class="short_desc"> <?php echo $row->detail; ?></p>
              </a> </div>
          </div>
        </div>
        <?php } ?>
        
        <!-- Content News Fashion End --> 
        <!-- Pagging Begin -->
        <div class="pagging pagging-1">
          <ul class="pagging_nav">
            <li> <a class="pre_nav" href="javascript:void(0)" rel="tab1" page="<?php echo ($page > 1) ? $page - 1 : 1; ?>">pre</a></li>
            <?php 
              for( ; $index <= $endpage; $index++) {
            ?>
            <li <?php echo ($page == $index) ? 'class="active"' : ''; ?>> <a href="javascript:void(0)" rel="tab1" page="<?php echo $index; ?>"><?php echo $index; ?></a></li>
            <?php }?>
            <li> <a class="next_nav" href="javascript:void(0)" rel="tab1" page="<?php echo ($page < $toltalpage) ? $page + 1 : $toltalpage; ?>">next</a> </li>
          </ul>
        </div>

        <script type="text/javascript">
        $(document).ready(function(){

          function loadingnews(page) {
            $.ajax({
              url: "<?php echo base_url('public/ajax/loadttt'); ?>",
              type: "post",
              data: "page="+page,
              success: function(data){
                $('#newsTTT').html(data);                        
              }
            });
          }

          $("a[rel=tab1]").click(function(){
           var _page = $(this).attr('page');
           loadingnews(_page);                
          });
        });
        </script>