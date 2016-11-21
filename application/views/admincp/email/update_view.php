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
        <li> <a href="<?php echo base_url(); ?>admincp/email/category">Danh mục email</a> <i class="icon-angle-right"></i> </li>
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
            <?php echo form_open('admincp/email/updateEmail', array('id' => 'frmaupdate', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>       
            <div class="control-group">
              <label for="txtName" class="control-label">Tên</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Nhập tên (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtName', $name); ?>">                  
                </div>                
            </div>    
            <div class="control-group">
              <label for="txtEmail" class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="txtEmail" id="txtEmail" placeholder="Nhập email (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtEmail', $email); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtPassword" class="control-label">Mật khẩu</label>
                <div class="controls">
                  <input type="text" name="txtPassword" id="txtPassword" placeholder="Nhập mật khẩu (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtPassword', $pass); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtSMTP" class="control-label">SMTP Server</label>
                <div class="controls">
                  <input type="text" name="txtSMTP" id="txtSMTP" placeholder="Nhập smtp server (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtSMTP', $smtp); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtSSL" class="control-label">SMTP SSL</label>
                <div class="controls">
                  <input type="text" name="txtSSL" id="txtSSL" placeholder="Nhập smtp ssl" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtSSL', $ssl); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtPort" class="control-label">SMTP Port</label>
                <div class="controls">
                  <input type="text" name="txtPort" id="txtPort" placeholder="Nhập smtp port (nhập số)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtPort', $port); ?>">                  
                </div>
            </div>  
            <div class="control-group">
              <label for="slCategory" class="control-label">Danh mục</label>
                <div class="controls">                  
                  <select name="slCategory" id="slCategory" class="input-large"> 
                    <?php foreach($result as $row) { ?>               
                    <option value="<?php echo $row->id; ?>" <?php echo ($id_parent == $row->id)? 'selected="selected"' : ''; ?> ><?php echo $row->name; ?></option>      
                    <?php } //Close result?>        
                  </select>
                </div>
            </div>       
            <div class="control-group">
              <label for="slStatus" class="control-label">Trạng thái</label>
                <div class="controls">                  
                  <select name="slStatus" id="slStatus" class="input-large">                
                    <option value="1" <?php echo ($status == 1)? 'selected="selected"' : ''; ?>>Hiện</option>
                    <option value="0" <?php echo ($status == 0)? 'selected="selected"' : ''; ?>>Ẩn</option>                    
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
              var id   = $("#hd_id").val();
              function checksmtpserver()
              {
                var smpt = $('#txtSMTP').val();                
                if(smpt == "")
                {
                  var msg = getError('SMTP Server không được để trống.','txtSMTP'); 
                  $("#txtSMTP").parent().parent().removeClass("success");
                  $("#txtSMTP").parent().parent().addClass("error");
                  $("#txtSMTP").parent().append(msg);
                  $("#txtSMTP").focus();
                }
                else
                {
                  $("#txtSMTP").parent().parent().removeClass("error");
                  $("#txtSMTP").parent().parent().addClass("success");
                  $("#txtSMTP").parent().find('span').remove("span");
                }
              }

              function checkpassword()
              {
                var pass = $('#txtPassword').val();                
                if(pass == "")
                {
                  var msg = getError('Password không được để trống.','txtSMTP'); 
                  $("#txtPassword").parent().parent().removeClass("success");
                  $("#txtPassword").parent().parent().addClass("error");
                  $("#txtPassword").parent().append(msg);
                  $("#txtPassword").focus();
                }
                else
                {
                  $("#txtPassword").parent().parent().removeClass("error");
                  $("#txtPassword").parent().parent().addClass("success");
                  $("#txtPassword").parent().find('span').remove("span");
                }
              }

              function checkemail()
              {
                //Kiểm tra email                              
                var email = $("#txtEmail").val();
                if(email == "")
                {
                  var msgcode = getError('Email không được để trống.','txtEmail'); 
                  $("#txtEmail").parent().parent().removeClass("success");
                  $("#txtEmail").parent().parent().addClass("error");
                  $("#txtEmail").parent().append(msgcode);
                  $("#txtEmail").focus();
                }
                else 
                { 
                  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                 
                  if(!regex.test(email))
                  {
                      var msgname = getError('Email không hợp lệ.','txtEmail'); 
                      $("#txtEmail").parent().parent().removeClass("success");
                      $("#txtEmail").parent().parent().addClass("error");
                      $("#txtEmail").parent().append(msgname);
                      $("#txtEmail").focus();
                  }
                  else
                  {
                    var msgcode = getError('Email đã tồn tại.','txtCode');         
                    $.ajax({
                        url: "<?php echo base_url(); ?>admincp/email/checkanotheremail",
                        type: "POST",                        
                        data: "email="+email+"&id="+id,
                        success: function(msg){
                          if(msg == 1) {
                            $("#txtEmail").parent().parent().removeClass("success");
                            $("#txtEmail").parent().parent().addClass("error");
                            $("#txtEmail").parent().append(msgcode);
                            $("#txtEmail").focus();
                          }
                          else {
                            $("#txtEmail").parent().parent().removeClass("error");
                            $("#txtEmail").parent().parent().addClass("success");
                            $("#txtEmail").parent().find('span').remove("span");
                          }
                        }
                    });
                  }
                }
              }

              function checkname()
              {
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
                      url: "<?php echo base_url(); ?>admincp/email/checkanothername",
                      type: "POST",                      
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

              $("#txtPort").keypress(function(e){
                return keypress(e);
              });

              $("form#frmaupdate").on('submit', function(){

                //Cấu hình form mặc đinh
                $("#txtEmail").parent().parent().removeClass("error success");
                $("#txtEmail").parent().find('span').remove("span");

                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");

                $("#txtSMTP").parent().parent().removeClass("error success");
                $("#txtSMTP").parent().find('span').remove("span");

                $("#txtPassword").parent().parent().removeClass("error success");
                $("#txtPassword").parent().find('span').remove("span");

                checksmtpserver();
                checkpassword();
                checkemail();
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
                                  $(location).attr('href','<?php echo $_SERVER["HTTP_REFERER"]; ?>');
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