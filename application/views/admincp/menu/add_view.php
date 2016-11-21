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
        <li> <a href="<?php echo base_url(); ?>admincp/menu">Menu</a> <i class="icon-angle-right"></i> </li>
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
            <?php echo form_open('admincp/menu/addMenu', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtCode" class="control-label">Code</label>
                <div class="controls">
                  <input type="text" name="txtCode" id="txtCode" placeholder="Mã code (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtCode', ''); ?>">                  
                </div>
            </div>
            <!--
            <div class="control-group">
              <label for="slHaveChildren" class="control-label">Menu con</label>
                <div class="controls">
                  <select name="slHaveChildren" id="slHaveChildren" class="input-large">                
                    <option value="0">Không</option>
                    <option value="1">Có</option>
                  </select>
                </div>
            </div>
            -->
            <div class="control-group">
              <label for="slParent" class="control-label">Menu cha</label>
                <div class="controls">
                  <select name="slParent" id="slParent" class="input-large">  
                    <option value="0">--</option>  
                  <?php
                    foreach($query as $row)
                    {
                   ?>            
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                  <?php                    
                      
                    }
                  ?>
                  </select>
                </div>
            </div>
            <div class="control-group">
              <label for="txtName" class="control-label">Tên</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên menu (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', ''); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtNameSub" class="control-label">Tên không dấu</label>
                <div class="controls">
                  <input type="text" name="txtNameSub" id="txtNameSub" placeholder="Tên không dấu" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtNameSub', ''); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtLink" class="control-label">Link</label>
                <div class="controls">
                  <input type="text" name="txtLink" id="txtLink" placeholder="Link" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtLink', ''); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtSort" class="control-label">Sắp xếp</label>
                <div class="controls">
                  <input type="text" name="txtSort" id="txtSort" placeholder="Sort (nhập số)" class="input-large" maxlength="255" value="<?php echo set_value('txtSort', ''); ?>">                  
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
            <div class="control-group">
              <label for="txtKeyword" class="control-label">Từ khóa</label>
                <div class="controls">
                  <textarea name="txtKeyword" id="txtKeyword" rows="5" class="input-block-level" placeholder="Từ khóa" maxlength="255"><?php echo set_value('txtKeyword', ''); ?></textarea>                
                </div>
            </div>
            <div class="control-group">
              <label for="txtDescription" class="control-label">Mô tả</label>
                <div class="controls">
                  <textarea name="txtDescription" id="txtDescription" rows="5" class="input-block-level" placeholder="Mô tả" maxlength="255"><?php echo set_value('txtDescription', ''); ?></textarea>                
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
              //$("#slHaveChildren").change(function(){
                //var value   =   $("#slHaveChildren").val();

                //if(value == 1)
                //{
                  //$("#slParent").parent().parent().removeAttr("style");
                //}
                //else
                //{
                  //$("#slParent").parent().parent().css("display","none");
                //}
              //});

              //Set Method check code menu by ajax         
              
              $("#txtName").on('keyup keypress blur', function(){
                var title = changetitle($("#txtName").val());
                $("#txtNameSub").val(title);
              });

              $("#txtSort").keypress(function(e){
                return keypress(e);
              });

              //Validate input submit form                 

              $("form#frmadd").on('submit', function(){

                //Cấu hình form mặc đinh
                $("#txtCode").parent().parent().removeClass("error success");
                $("#txtCode").parent().find('span').remove("span");

                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");

                
                //Kiểm tra tên                                             
                var name = $("#txtName").val();
                if(name == "")
                {
                  var msgname = getError('Tên menu không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  $("#txtName").focus();
                }
                else {
                  var msgname = getError('Tên menu đã tồn tại.','txtName');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/menu/checkname",
                      data: "name="+name,
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

                //Kiểm tra code                              
                var code = $("#txtCode").val();
                if(code == "")
                {
                  var msgcode = getError('Mã code không được để trống.','txtCode'); 
                  $("#txtCode").parent().parent().removeClass("success");
                  $("#txtCode").parent().parent().addClass("error");
                  $("#txtCode").parent().append(msgcode);
                  $("#txtCode").focus();
                }
                else 
                { 
                  var msgcode = getError('Mã code đã tồn tại.','txtCode');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/menu/checkcode",
                      data: "code="+code,
                      success: function(msg){
                        if(msg == 1) {
                          $("#txtCode").parent().parent().removeClass("success");
                          $("#txtCode").parent().parent().addClass("error");
                          $("#txtCode").parent().append(msgcode);
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

                if($("#txtSort").val() == "") {
                  $("#txtSort").val('0')
                }

                
                 
                
                 
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