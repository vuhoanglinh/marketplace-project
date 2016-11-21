    <script type="text/javascript">
        $(document).ready(function(){
              $(".trend_title h4 a").each(function(){
                  var text = $(this).html();
                  if(text.length > 20){
                      text = text.substring(0,20);
                      $(this).html(text+' ...');
                  }
              });
              $(".description_trends p").each(function(){
                  var text = $(this).html();
                  if(text.length > 100){
                      text = text.substring(0,100);
                      $(this).html(text+' ...');
                  }
              });
       });
    </script>
      <!-- Trend News Begin -->
      <div class="news_trends">
        <ul>
          <?php 
          foreach ($trendnews as $row) {          
          ?>
          <li>
            <div class="trendsBox"> <a href=""> <img src="<?php echo $row->images; ?>" width="320" height="222"></a>
              <div class="description" style="height: 50px;">
                <div class="trend_title">
                  <h4> <a href=""><?php echo $row->name; ?></a></h4>
                  <h6 class="time_create"> <?php echo mdate($datestring, strtotime($row->date_added)); ?></h6>
                </div>
                <div style="display: none;" class="description_trends">
                  <p> <?php echo $row->detail; ?></p>
                </div>
              </div>
            </div>
          </li>          
          <?php } ?>
        </ul>
      </div>
      <!-- Trend News End --> 
      <!-- Pagging Begin -->
      <div class="pagging ">
        <ul class="pagging_nav">
          <li> <a class="pre_nav" href="javascript:void(0)" rel="tab" page="<?php echo ($page > 1) ? $page - 1 : 1; ?>">pre</a></li>
          <?php 
            for( ; $index <= $endpage; $index++) {
          ?>
          <li <?php echo ($page == $index) ? 'class="active"' : ''; ?>> <a href="javascript:void(0)" rel="tab" page="<?php echo $index; ?>"><?php echo $index; ?></a></li>
          <?php }?>
          <li> <a class="next_nav" href="javascript:void(0)" rel="tab" page="<?php echo ($page < $toltalpage) ? $page + 1 : $toltalpage; ?>">next</a> </li>
        </ul>
      </div>
      <!-- Pagging End --> 
      <script type="text/javascript">
      $(document).ready(function(){

        function loadingnews(page) {
          $.ajax({
            url: "<?php echo base_url('public/ajax/loadxhtt'); ?>",
            type: "post",
            data: "page="+page,
            success: function(data){
              $('#newsXHTT').html(data);                        
            }
          });
        }

        $("a[rel=tab]").click(function(){
         var _page = $(this).attr('page');
         loadingnews(_page);                
        });
      });
      </script>