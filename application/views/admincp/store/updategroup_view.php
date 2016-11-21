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
        <li> <a href="<?php echo base_url(); ?>admincp/store/group">Nhóm cửa hàng</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="#">Chỉnh sửa</a></li>
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box box-color box-bordered green">
          <div class="box-title">
            <h3>
                <i class="icon-edit"></i>
                <?php echo $titlepage; ?>
            </h3>
          </div>
          <div class="box-content nopadding"> 
            <?php echo form_open('admincp/store/updateStoreg', array('id' => 'frmupdate', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtCode" class="control-label">Code</label>
                <div class="controls">
                  <input type="text" name="txtCode" id="txtCode" placeholder="Mã code (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtCode', $code); ?>">                  
                </div>
            </div>           
            <div class="control-group">
              <label for="txtName" class="control-label">Tên</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên nhóm cửa hàng (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', $name); ?>">                  
                </div>                
            </div>     
            <div class="control-group">
              <label for="txtDescription" class="control-label">Mô tả</label>
                <div class="controls">
                  <textarea name="txtDescription" id="txtDescription" rows="5" class="input-block-level" placeholder="Mô tả"><?php echo set_value('txtDescription', $detail); ?></textarea>                
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
              <input type="hidden" name="hd_id" id="hd_id" value="<?php echo set_value('hd_id', $id); ?>">
              <button type="submit" id="btnSave" class="btn btn-satgreen" >Cập nhật</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">
            $(document).ready(function(){                               
              var id = $('#hd_id').val();
              function checkcode()
              {
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
                      url: "<?php echo base_url(); ?>admincp/store/checkanothercodeg",
                      data: "code="+code+"&id="+id,
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
              }

              function checkname()
              {
                  //Kiểm tra tên                                             
                var name = $("#txtName").val();
                if(name == "")
                {
                  var msgname = getError('Tên nhóm không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  $("#txtName").focus();
                }
                else {
                  var msgname = getError('Tên nhóm đã tồn tại.','txtName');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/store/checkanothernameg",
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

              $("form#frmupdate").on('submit', function(){

                //Cấu hình form mặc đinh
                $("#txtCode").parent().parent().removeClass("error success");
                $("#txtCode").parent().find('span').remove("span");

                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");

                checkname();
                checkcode();
                                                
                 
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
                                  $(location).attr('href','<?php echo base_url(); ?>/admincp/store/group');
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