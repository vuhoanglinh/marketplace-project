<div id="main">
  <div class="container-fluid">
    <div class="page-header">
      <div class="pull-left">
        <h1><?php echo (isset($titlepage) ? $titlepage : "");?></h1> </div>
      <div class="pull-right">
        <ul class="stats">
          <li class='lightred'> <i class="icon-calendar"></i>
            <div class="details"> <span class="big">February 22, 2013</span> <span>Wednesday, 13:56</span> </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="breadcrumbs">
      <ul>
        <li> <a href="<?php echo base_url(); ?>stores">Trang chủ</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="<?php echo base_url(); ?>stores/liststore">Danh sách sự kiện</a></li>
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box box-color box-bordered">
          <div class="box-title">
            <h3> <i class="icon-table"></i> <?php echo $titlepage; ?> </h3>
          </div> 
          <script> 
          $(document).ready(function(){ 
            resize();
           $("#check_all").click(function() 
            { 
             var checked_status = this.checked; 
             $("input[type=checkbox]").each(function() 
             { 
                this.checked = checked_status; 
             }); 
            }); 


           //Search menu
           $('#search').keypress(function(event){
              if(event.which == 13) {
                if($('#search').val() != ""){
                  var url = '<?php echo base_url(); ?>stores/event/table?key='+$('#search').val().trim();
                  $(location).attr('href',url);
                }
              }
           });

           $('#btnsearch').click(function(){
              if($('#search').val() != ""){
                var url = '<?php echo base_url(); ?>stores/event/table?key='+$('#search').val().trim();
                $(location).attr('href',url);
              }
           });

          }); 
          </script> 
          <div class="box-content nopadding"> <?php echo form_open("stores/event/movetrash", array('id' => 'frmtrash', 'name' => 'frmtrash'));?>
            <div class="dataTables_wrapper">     
              <div class="dataTables_length">
                <label><span style="margin: 0px;"><a href="javascript:void(0)" id="btnsearch" class="btn btn-primary"><i class="icon-search"></i></a></span>
                  <input type="text" id="search" placeholder="Tìm kiếm...">
                </label>
              </div>         
              <div class="dataTables_filter"><?php echo $num_result; ?> kết quả</div>
              <div style="clear:both;"></div>
                <table class="table table-hover table-nomargin table-bordered">
                  <thead>
                    <tr>
                      <th class='with-checkbox'><input type="checkbox" name="check_all" id="check_all"></th>
                      <th class="hidden-480">Tiêu đề</th>
                      <th class="hidden-480">Tóm tắt ngắn</th>
                      <th>Trạng thái</th>
                      <th>Ngày tạo lập</th>
                      <th>Ngày cập nhật</th>
                      <th class="hidden-480">Tùy chỉnh</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>    
                 
              <div class="dataTables_length">
                <input type="hidden" id="hd_id_store" name="hd_id_store" value="<?php echo $id_store; ?>">
                <button type="submit" id="btn_delselect" class="btn" ><i class="icon-remove"></i> Xóa chọn</button>
                <a href="<?php echo base_url(); ?>stores/event/add" action="add" class="btn btn-primary">
                  <i class="icon-plus"></i> Thêm mới</a>
                <a href="<?php echo base_url(); ?>stores/event/trash" class="btn btn-inverse"><i class="icon-trash"></i> Đã xóa</a>
                <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
              </div>        
              <div class="ch_arr"><a href="javascript:void(0)" onclick="PrevPagging(0);">Trước</a> <a href="javascript:void(0)" onclick="NextPagging(<?php echo $total_page * 30; ?>);">Sau</a></a></div>          
              <div class="pagination"> 
                <div> 
                  <span>
                    <a href="javascript:void(0)" num="0" class='active'>1</a>
                  <?php for ($Index = 1; $Index < $total_page; $Index++) {  
                  ?>
                    <a href="javascript:void(0)" num="<?php echo $Index; ?>"><?php echo $Index + 1; ?></a>
                  <?php
                   }?>
                  </span>  
                </div>
              </div>              
            </div>
            <?php echo form_close() ?>
            <script type="text/javascript">              
              var id = $('#hd_id_store').val();
              $(document).ready(function(){  

                function loadevent(page) {
                  $.ajax({
                      url: "<?php echo base_url('stores/event/pagging_list'); ?>",
                      type: "post",
                      data: "id="+id+"&page="+page+"&key=<?php echo $key; ?>",
                      success: function(data){
                        $('.box-content table tbody').html(data);
                      }
                    });
                }
                loadevent(0);
                $('.pagination a').removeClass('active');
                $('.pagination a:first').addClass('active');
                $('.pagination a').each(function(){
                $(this).click(function(){
                    $('.pagination a').removeClass('active');
                    $(this).addClass('active');
                    loadevent($(this).attr('num')); 
                    resize();                     
                  });
                });
                $('form#frmtrash').on('submit', function(){
                  return false;
                });
                $("#btn_delselect").on('click', function(){
                    $("input[type=checkbox]").each(function(){ 
                      if($(this).attr("id") != "check_all") 
                      {
                        if($(this).is(":checked"))
                        {
                          var from = $('form#frmtrash');
                          $.ajax({
                              url: from.attr('action'),
                              type: from.attr('method'),
                              dataType: "json",
                              data: 'id=' + $(this).val(),
                              success: function(data) {         
                                if(data.status == "1") {                                  
                                  $(this).parent().parent().hide();
                                  $(location).attr('href', '');
                                }                          
                              }
                          });
                        } 
                      }  
                   });                           
                });
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>