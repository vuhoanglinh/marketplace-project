<div id="main">
  <div class="container-fluid">
    <div class="page-header">
      <div class="pull-left">
        <h1><?php echo $titlepage; ?></h1>
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
        <li> <a href="<?php echo base_url('stores'); ?>">Trang chủ</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="#">Thông tin cửa hàng</a> </li>
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box box-color box-bordered">
          <div class="box-title">
            <h3> <i class="icon-th-list"></i> <?php echo $titlepage; ?> </h3>
          </div>
          <div class="box-content nopadding">
            <ul class="tabs tabs-inline tabs-top">
              <li class='active'> <a href="#first11" data-toggle='tab'><i class="icon-home"></i> Thông tin cửa hàng</a> </li>
              <li> <a href="#second22" data-toggle='tab'><i class="glyphicon-old_man"></i> Thay đổi mật khẩu</a> </li>
            </ul>            
            <div class="tab-content tab-content-inline tab-content-bottom">              
              <div class="tab-pane active" id="first11">
                <?php echo form_open('stores/store/editstore', array('class' => 'form-horizontal form-bordered', 'id' => 'frmedit')) ;?>
                <div class="control-group">
                  <label for="txtName" class="control-label">Tên cửa hàng</label>
                  <div class="controls">
                    <input type="text" name="txtName" id="txtName" placeholder="Tên cửa hàng (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', $name); ?>">                    
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtNameContact" class="control-label">Tên đơn vị quản lý</label>
                  <div class="controls">
                    <input type="text" name="txtNameContact" id="txtNameContact" placeholder="Tên đơn vị quản lý (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtNameContact', $name_contact); ?>">                   
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtEmail" class="control-label">Email</label>
                  <div class="controls">
                    <input type="text" name="txtEmail" id="txtEmail" placeholder="Email liên hệ (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtEmail', $email); ?>">                   
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtPhone" class="control-label">Điện thoại</label>
                  <div class="controls">
                    <input type="text" name="txtPhone" id="txtPhone" placeholder="Điện thoại liên hệ" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtPhone', $phone); ?>">                   
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtAddress" class="control-label">Địa chỉ liên hệ</label>
                  <div class="controls">
                    <textarea name="txtAddress" id="txtAddress" rows="5" class="input-block-level" placeholder="Địa chỉ liên lạc" maxlength="255"><?php echo set_value('txtAddress', $address); ?></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <input type="hidden" id="hd_id_store1" name="hd_id_store1" value="<?php echo $id_store; ?>">
                  <button type="submit" id="btnSaveHome" class="btn btn-primary" >Lưu thông tin</button>
                </div>                
                <?php echo form_close(); ?>
              </div>                 
              <div class="tab-pane" id="second22">
                <?php echo form_open('stores/store/edituser', array('class' => 'form-horizontal form-bordered', 'id' => 'frmedituser')) ;?>
                <div class="control-group">
                  <label for="txtOldPass" class="control-label">Mật khẩu cũ</label>
                  <div class="controls">
                    <input type="password" name="txtOldPass" id="txtOldPass" placeholder="Mật khẩu cũ" class="input-xxlarge" maxlength="255" value="">                    
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtNewPass" class="control-label">Mật khẩu mới</label>
                  <div class="controls">
                    <input type="password" name="txtNewPass" id="txtNewPass" placeholder="Mật khẩu mới" class="input-xxlarge" maxlength="255" value="">                    
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtRePass" class="control-label">Nhập lại mật khẩu mới</label>
                  <div class="controls">
                    <input type="password" name="txtRePass" id="txtRePass" placeholder="Nhập lại mật khẩu mới" class="input-xxlarge" maxlength="255" value="">                    
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtID" class="control-label">Mã bảo vệ</label>
                  <div class="controls">
                    <input type="text" name="txtID" id="txtID" placeholder="Mã bảo vệ" class="input-xxlarge" maxlength="255" value="">                    
                  </div>
                </div>
                <div class="form-actions">                  
                  <input type="hidden" id="hd_id_store2" name="hd_id_store2" value="<?php echo $id_store; ?>">
                  <button type="submit" id="btnSaveProduct" class="btn btn-primary" >Lưu thông tin</button>
                   <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a> 
                 </div>
                <?php echo form_close(); ?>
                </div>
              </div>   
            </div>
          </div>
          <script type="text/javascript">
            $(document).ready(function() {
              var id = $('#hd_id_store1').val();
              function checkname()
              {
                  //Kiểm tra tên                                             
                var name = $("#txtName").val();
                if(name == "")
                {
                  var msgname = getError('Tên cửa hàng không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  $("#txtName").focus();
                }
                else {
                  var msgname = getError('Tên cửa hàng đã tồn tại.','txtName');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/store/checkanothername",
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
              
              function checkemail()
              {
                $("#txtEmail").parent().parent().removeClass("error success");
                $("#txtEmail").parent().find('span').remove("span");


                var email = $('#txtEmail').val().trim();
                if(email != "")
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
                      $("#txtEmail").parent().parent().removeClass("error");
                      $("#txtEmail").parent().find('span').remove("span");
                      var msg = getError('Email hợp lệ.','txtRePassword'); 
                      $("#txtEmail").parent().parent().addClass("success");
                      $("#txtEmail").parent().append(msg);
                  }
                }
                else
                {
                    var msgname = getError('Email không được để trống.','txtEmail'); 
                      $("#txtEmail").parent().parent().removeClass("success");
                      $("#txtEmail").parent().parent().addClass("error");
                      $("#txtEmail").parent().append(msgname);
                      $("#txtEmail").focus();
                }

              }

              function checknamecontact()
              {
                var namecontact = $('#txtNameContact').val();
                if(namecontact == "")
                {
                  var msgname = getError('Tên quản lý không được để trống.','txtNameSub'); 
                  $("#txtNameContact").parent().parent().removeClass("success");
                  $("#txtNameContact").parent().parent().addClass("error");
                  $("#txtNameContact").parent().append(msgname);
                  $("#txtNameContact").focus();
                }
                else {                  
                  $("#txtNameContact").parent().parent().removeClass("error");
                  $("#txtNameContact").parent().parent().addClass("success");
                  $("#txtNameContact").parent().find('span').remove("span"); 
                }
              }

              function checkpassword()
              {
                $("#txtOldPass").parent().parent().removeClass("error success");
                $("#txtOldPass").parent().find('span').remove("span"); 
                //Kiểm tra tên                                             
                var pass = $("#txtOldPass").val();
                if($("#txtOldPass").val() != "") {
                  if(pass.length < 6 || pass.length > 20)
                  {
                    var msgname = getError('Mật khẩu phải từ 6 - 20 ký tự.','txtOldPass'); 
                    $("#txtOldPass").parent().parent().removeClass("success");
                    $("#txtOldPass").parent().parent().addClass("error");
                    $("#txtOldPass").parent().append(msgname);
                    $("#txtOldPass").focus();
                  }
                  else
                  {
                      $("#txtOldPass").parent().parent().removeClass("error");
                      $("#txtOldPass").parent().find('span').remove("span");                      
                  }
                }
              }

              function checknpassword()
              {
                $("#txtNewPass").parent().parent().removeClass("error success");
                $("#txtNewPass").parent().find('span').remove("span"); 
                //Kiểm tra tên                                             
                var passn = $("#txtNewPass").val();
                if($("#txtNewPass").val() != "") {
                  if(passn.length < 6 || passn.length > 20)
                  {
                    var msgname = getError('Mật khẩu phải từ 6 - 20 ký tự.','txtNewPass'); 
                    $("#txtNewPass").parent().parent().removeClass("success");
                    $("#txtNewPass").parent().parent().addClass("error");
                    $("#txtNewPass").parent().append(msgname);
                    $("#txtNewPass").focus();
                  }
                  else
                  {
                      $("#txtNewPass").parent().parent().removeClass("error");
                      $("#txtNewPass").parent().find('span').remove("span");                    
                  }
                }
              }

              function checkrepass()
              {
                $("#txtRePass").parent().parent().removeClass("error success");
                $("#txtRePass").parent().find('span').remove("span"); 

                var pass1    =   $("#txtNewPass").val();
                var repass1  =   $("#txtRePass").val();
                if(pass1.length >= 6 && pass1.length <= 20)               
                {
                  if(repass1 != pass1)
                  {
                    var msgname = getError('Mật khẩu lặp lại chưa trùng khớp.','txtRePass'); 
                    $("#txtRePass").parent().parent().removeClass("success");
                    $("#txtRePass").parent().parent().addClass("error");
                    $("#txtRePass").parent().append(msgname);
                    $("#txtRePass").focus();
                  }
                  else
                  {
                    $("#txtRePass").parent().parent().removeClass("error");
                    $("#txtRePass").parent().find('span').remove("span");
                  }
                }

              }
                  //Form Edit Contact
              $("form#frmedit").on('submit', function(){    
                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");

                $("#txtEmail").parent().parent().removeClass("error success");
                $("#txtEmail").parent().find('span').remove("span");

                $("#txtNameContact").parent().parent().removeClass("error success");
                $("#txtNameContact").parent().find('span').remove("span");

                    checkemail();
                    checknamecontact();
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
                              if(data.status == 0)
                              {                               
                                $(location).attr('href','');
                              }
                          }
                      });

                      return false;

                });


                $('form#frmedituser').on('submit', function() {
                  $("#txtOldPass").parent().parent().removeClass("error success");
                  $("#txtOldPass").parent().find('span').remove("span");

                  $("#txtNewPass").parent().parent().removeClass("error success");
                  $("#txtNewPass").parent().find('span').remove("span");

                  $("#txtRePass").parent().parent().removeClass("error success");
                  $("#txtRePass").parent().find('span').remove("span");

                      checkrepass();
                      checknpassword();
                      checkpassword();
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
