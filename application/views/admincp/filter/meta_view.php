<div id="main">
  <div class="container-fluid">
    <div class="page-header">
      <div class="pull-left">
        <h1><?php echo (isset($titlepage) ? $titlepage : "");?></h1>
      </div>
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
        <li> <a href="<?php echo base_url();?>admincp">Trang chủ</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="<?php echo base_url('admincp/filter');?>">Danh mục bộ lọc</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="<?php echo base_url('admincp/filter/meta');?>?id=<?php echo $id ?>"><?php echo $name_filter; ?></a> </li>
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span6">
        <div class="box box-color box-bordered">
          <div class="box-title">
            <h3> <i class="icon-table"></i> <?php echo $titlepage; ?></h3>
          </div>
          <script> 
          $(document).ready(function(){ 

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
                  var url = '<?php echo base_url(); ?>admincp/filter/meta?id=<?php echo $id; ?>&key='+$('#search').val().trim();
                  $(location).attr('href',url);
                }
              }
           });

           $('#btnsearch').click(function(){
              if($('#search').val() != ""){
                var url = '<?php echo base_url(); ?>admincp/filter/meta?id=<?php echo $id; ?>&key='+$('#search').val().trim();
                $(location).attr('href',url);
              }
           });

          }); 
          </script>
          <div class="box-content nopadding">
            <?php echo form_open("admincp/filter/movetrashmt", array('id' => 'frmtrash', 'name' => 'frmtrash'));?>
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
                    <th>Meta key</th>
                    <th>Meta value</th>  
                    <th>Trang thái</th>
                    <th class="hidden-480">Tùy chỉnh</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
              <div class="dataTables_length">  
                <input type="hidden" id="hd_count" name="hd_count" value="<?php echo $index; ?>">                
                <button type="submit" id="btn_delselect" class="btn" ><i class="icon-remove"></i> Xóa chọn</button>
              </div>            
              <div class="ch_arr"><a href="javascript:void(0)" onclick="PrevPagging(0);">Trước</a> <a href="javascript:void(0)" onclick="NextPagging(<?php echo $total_page * 30; ?>);">Sau</a></a></div>          
              <div class="pagination"> 
                <div> 
                  <span>
                    <a href="javascript:void(0)" num="0" class='active'>1</a>
                  <?php for ($Index=1; $Index < $total_page; $Index++) {  
                  ?>
                    <a href="javascript:void(0)" num="<?php echo $Index; ?>"><?php echo $Index + 1; ?></a>
                  <?php
                   }?>
                  </span>  
                </div>
              </div>
            </div>
            <?php echo form_close(); ?>
            <script type="text/javascript">              
              
              $(document).ready(function(){

                function loadfilter(page) {
                  $.ajax({
                      url: "<?php echo base_url('admincp/filter/pagging_meta'); ?>",
                      type: "post",
                      data: "page="+page+"&key=<?php echo $key; ?>"+"&id=<?php echo $id; ?>",
                      success: function(data){
                        $('.box-content table tbody').html(data);                        
                      }
                    });
                }
                loadfilter(0);
                $('.pagination a').each(function(){
                  $(this).click(function(){
                    $('.pagination a').removeClass('active');
                    $('.pagination a').removeClass('active');
                    $(this).addClass('active');
                    loadfilter($(this).attr('num'));
                      
                  });
                });

                $("#txtName").on('keyup keypress blur', function(){
                  var title = changetitle($("#txtName").val());
                  $("#txtNameSub").val(title);
                });
                
            });
          </script>
          </div>
        </div> 
      </div>
      <div class="span6">
        <div id="span6" class="box box-color box-bordered red">
          <div class="box-title">
            <h3>
                <i class="icon-plus-sign"></i>
                <?php echo $titleadd; ?>
            </h3>
          </div>
          <div class="box-content nopadding"> 
            <?php echo form_open('admincp/filter/actionmt', array('id' => 'frm', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtName" class="control-label">Tên</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Meta key (*)" class="input-large" maxlength="255" value="<?php echo set_value('txtName', ''); ?>">                  
                </div>                
            </div>  
            <div class="control-group">
              <label for="txtNameSub" class="control-label">Meta value</label>
                <div class="controls">
                  <input type="text" name="txtNameSub" id="txtNameSub" placeholder="Meta value" class="input-large" maxlength="255" value="<?php echo set_value('txtNameSub', ''); ?>">                  
                </div>                
            </div>        
            <div class="control-group">
              <label for="txtLogo" class="control-label">Hình ảnh</label>
              <div class="controls">
                <input type="text" name="txtLogo" id="txtLogo"  class="input-large" maxlength="255" value="<?php echo set_value('txtLogo', ''); ?>">
                <button type="button" id="btnLogo" class="btn" >Chọn hình</button>  
                <a id="btnLog" style="display:none" href="#modal-3" role="button" class="btn" data-toggle="modal">Alert</a>
              </div>
            </div>   
            <div class="control-group">
              <label for="slType" class="control-label">Loại hiển thị</label>
                <div class="controls">                  
                  <select name="slType" id="slType" class="input-large">                
                    <option value="0">Không hiện tên</option>
                    <option value="1">Hiện tên</option> 
                    <option value="2">Hiện hình ảnh</option>                    
                  </select>
                </div>
            </div>
            <div class="form-actions">
              <input type="hidden"  name="hd_id"  id="hd_id" value="0">
              <input type="hidden"  name="hd_id_filter"  id="hd_id_filter" value="<?php echo $id; ?>">
              <button type="submit" id="btnSave" class="btn btn-primary" >Cập nhật</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
            <script type="text/javascript">            
            $(document).ready(function(){ 
              function checkname()
              {
                 //Kiểm tra tên                                             
                var name      = $("#txtName").val();
                var id        = $("#hd_id").val();
                var id_filter = $('#hd_id_filter').val();
                if(name == "")
                {
                  var msgname = getError('Tên bộ lọc không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  $("#txtName").focus();
                }
                else {
                  var msgname = getError('Tên bộ lọc đã tồn tại.','txtName');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url('admincp/filter/checknamemt'); ?>",
                      data: "name="+name+"&id="+id+"&id_filter="+id_filter,
                      success: function(msg){
                        if(msg == 1) {
                          $("#txtName").parent().parent().removeClass("success");
                          $("#txtName").parent().parent().addClass("error");
                          $("#txtName").parent().append(msgname);
                          $("#txtName").focus();
                        }
                        else {
                          $("#txtName").parent().parent().removeClass("error");
                          $("#txtName").parent().parent().addClass("success");
                          $("#txtName").parent().find('span').remove("span");                          
                        }
                      }
                  });
                }
              }

              $('#btnCancel').click(function(){
                if($('#hd_id').val() != 0) {
                  $(location).attr('href','');
                }
              });

              $('#btnLogo').click(function(){
                  $("#btnLog").click();
                    var l = $('#modal-3 .modal-body').elfinder({
                      url : '<?php echo base_url(); ?>public/js/plugins/elfinder/php/connector.php',
                      getFileCallback: function(file) {
                        $('#txtLogo').val(replaceurl(file.path));
                        $("#modal-3 button.btn").click();
                      }
                    });
              });

              $('form#frm').on('submit', function(){
                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");
                checkname();
                var from = $(this);
                      $.ajax({
                          url: from.attr('action'),
                          type: from.attr('method'),
                          dataType: "json",
                          data: $(from).serialize(),
                          beforeSend : function (){
                              $("#modal-4 .modal-body p").html('Đang tải...');
                              $("#btnAlert").click();
                          },
                          success: function(data) {
                              $("#modal-4 .modal-body p").html(data.msg);
                              $("#modal-4 button.btn").click(function(){
                                if(data.status == 0)
                                {
                                  $(location).attr('href','');
                                }
                              });
                          }
                      });
                
                return false;
              });
            });
            </script>
          </div>          
        </div>    
      </div>   
    </div>    
  </div>
</div>