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
        <li> <a href="<?php echo base_url(); ?>admincp">Trang chủ</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="<?php echo base_url(); ?>admincp/news">Danh mục tin tức</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="#">Thêm mới</a></li>
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
            <?php echo form_open('admincp/news/addNews', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtCode" class="control-label">Mã danh mục</label>
                <div class="controls">
                  <input type="text" name="txtCode" id="txtCode" placeholder="Mã danh mục (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtCode', ''); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtName" class="control-label">Tên</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên danh mục (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', ''); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtNameSub" class="control-label">Tên không dấu</label>
                <div class="controls">
                  <input type="text" name="txtNameSub" id="txtNameSub" placeholder="Tên không dấu (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtNameSub', ''); ?>">                  
                </div>            
            </div> 
            <div class="control-group">
              <label for="txtClass" class="control-label">Class icon</label>
                <div class="controls">
                  <input type="text" name="txtClass" id="txtClass" placeholder="Class icon" class="input-large" maxlength="255" value="<?php echo set_value('txtClass', ''); ?>">
                </div>
            </div>            
            <div class="control-group">
              <label for="txtKeyword" class="control-label">Keyword</label>
              <div class="controls">
                <textarea name="txtKeyword" id="txtKeyword" rows="5" class="input-block-level" placeholder="Mô tả"><?php echo set_value('txtKeyword',''); ?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label for="txtDescription" class="control-label">Description</label>
              <div class="controls">
                <textarea name="txtDescription" id="txtDescription" rows="5" class="input-block-level" placeholder="Mô tả"><?php echo set_value('txtDescription',''); ?></textarea>
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
              <button type="submit" id="btnSave" class="btn btn-primary" >Thêm mới</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">            
            $(document).ready(function(){ 
              function checkcode()
              {
                 //Kiểm tra tên                                             
                var code = $("#txtCode").val();
                if(code == "")
                {
                  var msgname = getError('Mã danh mục không được để trống.','txtCode'); 
                  $("#txtCode").parent().parent().removeClass("success");
                  $("#txtCode").parent().parent().addClass("error");
                  $("#txtCode").parent().append(msgname);
                  $("#txtCode").focus();
                }
                else {
                  var msgname = getError('Mã danh mục đã tồn tại.','txtCode');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/news/checkcode",
                      data: "id=0&code="+code,
                      success: function(msg){
                        if(msg == 1) {
                          $("#txtCode").parent().parent().removeClass("success");
                          $("#txtCode").parent().parent().addClass("error");
                          $("#txtCode").parent().append(msgname);
                          $("#txtCode").focus();
                        }
                        else {
                          $("#txtCode").parent().parent().removeClass("error");
                          $("#txtCode").parent().parent().addClass("success");
                          $("#txtCode").parent().find('span').remove("span");                          
                        }
                      }
                  });
                }
              }

              function checkname()
              {
                 //Kiểm tra tên                                             
                var name = $("#txtName").val();
                if(name == "")
                {
                  var msgname = getError('Tên danh mục không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  $("#txtName").focus();
                }
                else {
                  var msgname = getError('Tên danh mục đã tồn tại.','txtName');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/news/checkname",
                      data: "id=0&name="+name,
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
              function checkTitle()
              {
                var title = $('#txtNameSub').val();
                if(title == "")
                {
                  var msgname = getError('Tên không dấu không được để trống.','txtNameSub'); 
                  $("#txtNameSub").parent().parent().removeClass("success");
                  $("#txtNameSub").parent().parent().addClass("error");
                  $("#txtNameSub").parent().append(msgname);
                  $("#txtNameSub").focus();
                }
                else {
                  var msgname = getError('Tên không dấu đã tồn tại.','txtNameSub');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/news/checktitle",
                      data: "id=0&title="+title,
                      success: function(msg){
                        if(msg == 1) {
                          $("#txtNameSub").parent().parent().removeClass("success");
                          $("#txtNameSub").parent().parent().addClass("error");
                          $("#txtNameSub").parent().append(msgname);
                          $("#txtNameSub").focus();
                        }
                        else {
                          $("#txtNameSub").parent().parent().removeClass("error");
                          $("#txtNameSub").parent().parent().addClass("success");
                          $("#txtNameSub").parent().find('span').remove("span");                          
                        }
                      }
                  });
                }
              }

              $("#txtName").on('keyup keypress blur', function(){
                var title = changetitle($("#txtName").val());
                $("#txtNameSub").val(title);
              });

              $("form#frmadd").on('submit', function(){

                //Cấu hình form mặc đinh
                $("#txtNameSub").parent().parent().removeClass("error success");
                $("#txtNameSub").parent().find('span').remove("span");

                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");

                var title = changetitle($('#txtNameSub').val());
                $('#txtNameSub').val(title);
                checkTitle();
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