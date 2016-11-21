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
        <li> <a href="<?php echo base_url(); ?>stores">Trang chủ</a> <i class="icon-angle-right"></i> </li>        
        <li> <a href="<?php echo base_url('stores/event/table'); ?>">Danh sách sự kiện</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="">Thêm mới</a> </li>        
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box box-color box-bordered red">
          <div class="box-title">
            <h3>
                <i class="icon-plus-sign"></i>
                <?php echo $titlepage; ?>
            </h3>
          </div>
          <div class="box-content nopadding"> 
            <?php echo form_open('stores/event/addEvent', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtName" class="control-label">Tiêu đề</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tiêu đề sự kiện (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', ''); ?>">                
                </div>                
            </div> 
            <div class="control-group">
              <label for="txtTime" class="control-label">Mốc thời gian</label>
                <div class="controls">
                  <input type="text" name="txtTime" id="txtTime" placeholder="Mốc thời gian" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtTime', ''); ?>">                  
                </div>                
            </div> 
            <div class="control-group">
              <label for="txtDetail" class="control-label">Mô tả tóm tắt</label>
                <div class="controls">
                  <textarea name="txtDetail" id="txtDetail" placeholder="Mô tả tóm tắt sự kiện" class="input-block-level" rows="5" maxlength="255"><?php echo set_value('txtDetail', ''); ?></textarea>                 
                </div>                
            </div>       
            <div class="control-group">
              <label for="txtText" class="control-label">Mô tả chi tiết</label>
              <div class="controls">
                <textarea name="txtText" id="txtText" rows="5" class="input-block-level" placeholder="Mô tả chi tiết" maxlength="255"><?php echo set_value('txtText', ''); ?></textarea>
              </div>
            </div> 
            <div class="control-group">
              <label for="slStatus" class="control-label">Trạng thái</label>
                <div class="controls">                  
                  <select name="slStatus" id="slStatus" class="input-large">                
                    <option value="1">Hiện</option>
                    <option value="0">Ẩn</option>                    
                  </select>
                </div>
            </div>            
            <div class="form-actions">
              <input type="hidden" name="hd_store" id="hd_store" value="<?php echo $id_store; ?>">
              <button type="submit" id="btnSave" class="btn btn-primary" >Thêm mới</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">            
            $(document).ready(function(){ 
              CKEDITOR.replace("txtText", {height: '400'});
              
              var id = $('#hd_store').val();
              function checkname()
              {
                //Kiểm tra tên                                             
                var name = $("#txtName").val();
                if(name == "")
                {
                  var msgname = getError('Tiêu đề không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  $("#txtName").focus();
                }
                else {
                  var msgname = getError('Tiêu đề đã tồn tại.','txtName');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>stores/event/checkname",
                      data: "name="+name+"&id="+id,
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

              $("form#frmadd").on('submit', function(){
                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");

                CKEDITOR.instances['txtText'].updateElement();
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