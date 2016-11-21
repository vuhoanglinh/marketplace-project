<!-- CONTENT: BEGIN -->
<div id="container">
  <ul id="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
    <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>"> <img src="<?php echo base_url('themes') ?>/francosarto/images/home2.jpg" alt=""></a></li>
    <?php if($b_idct != "") {?> <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $b_idct; ?>"><?php echo $b_namect; ?></a></li> <?php } ?>
    <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>">Tìm kiếm sản phẩm</a></li>
  </ul>
  <div class="subpage">
    <div class="col_left">
      <div class="col_left_block">
        <div class="left_title">
          <h3 class="upper customfont white"> Tìm kiếm</h3>
        </div>
        <div class="left_block_content" id="left_search_block">
          <form action="" method="post" id="frmsearch1" name="frmsearch1">
            <input name="txtKeyword" type="text" id="txtKeyword" class="fltrt" placeholder="Từ khóa">
            <a id="btnFindKeyword" class="btn_black upper fltlft" href="javascript:void(0)">Tìm</a>
          </form> 
        </div>  
        <script type="text/javascript">
        $(document).ready(function() {          
          $('#btnFindKeyword').click(function(){     
            var q   = $('#txtKeyword').val();
            //q       = q.replace(/!|@|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "");
            var url = "<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&q="+q;       
            $(location).attr('href',url);
          });
          $('#txtKeyword').keypress(function(e){
              if(e.which == 13) {
                var q   = $('#txtKeyword').val();
                //q       = q.replace(/!|@|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "");
                var url = "<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&q="+q;
                $(location).attr('href',url);
              }
           });

          $('#frmsearch1').submit(function(){
            return false;
          });
        });
        </script>      
      </div>
      <div class="col_left_block">
        <div class="left_title">
          <h3 class="upper customfont white"> Danh mục sản phẩm</h3>
        </div>
        <div class="left_block_content" id="left_cat">
          <ul>
            <?php
            foreach($b_category['parent'] as $row)
            {
            ?>
                <li><a class="sub" href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $row->id; ?>" tablink="#tab<?php echo $row->id; ?>"><?php echo $row->name; ?> (<?php echo $b_category['numpparent'][$b_count2]; ?>)</a>
                  <ul>
                    <?php 
                      foreach ($b_category['child'][$b_count2] as $value) { 
                    ?>
                      <li ><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $value->id; ?>"><?php echo $value->name;?> (<?php echo $b_category['numpchild'][$b_count3]; ?>)</a></li> 
                    <?php 
                      $b_count3++;
                      } // end foreach loop 2
                    ?>
                  </ul>
                </li>
            <?php 
                $b_count2++;
                } 
            ?>            
          </ul>
          <div class="clearfloat"> </div>
        </div>
      </div>
    </div>
    <div id="loadingproduct" class="col_content">
      
    <!--loading ajax -->
    </div>
    <script type="text/javascript">
            $(document).ready(function(){
              var url = document.URL;
              function loadingproduct(page,group) {
                $.ajax({
                      url: "<?php echo base_url('stores/merchant/paggingproduct'); ?>",
                      type: "post",
                      data: "rel=<?php echo $id_store; ?>"+"<?php echo '&c='.$b_idct; ?>"+"<?php echo '&sort='.$b_orderby; ?>"+"&page="+page+"&n="+group+"<?php echo '&q='.$b_key; ?>"+"&url="+url,
                      success: function(data){
                        $('#loadingproduct').html(data);                        
                      }
                });
              }
              var page = <?php echo $page; ?>;
              var grouppage = <?php echo $grouppage; ?>;
              loadingproduct(page,grouppage);
            });
    </script>
  </div>
</div>
<!-- CONTENT: END --> 