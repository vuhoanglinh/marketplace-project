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
            <?php echo form_open('admincp/store/updateStore', array('id' => 'frmupdate', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>          
            <div class="control-group">
              <label for="txtName" class="control-label">Tên cửa hàng</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên cửa hàng (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', $name); ?>">                  
                </div>                
            </div>   
            <div class="control-group">
              <label for="txtNameContact" class="control-label">Tên quản lý</label>
                <div class="controls">
                  <input type="text" name="txtNameContact" id="txtNameContact" placeholder="Tên quản lý (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtNameContact', $name_contact); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtUsername" class="control-label">Tài khoản cửa hàng</label>
                <div class="controls">
                  <input type="text" name="txtUsername" id="txtUsername" placeholder="Tài khoản cửa hàng (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtUsername', $username); ?>">                  
                </div>                
            </div>
            <!--
            <div class="control-group">
              <label for="txtPassword" class="control-label">Mật khẩu</label>
                <div class="controls">
                  <input type="password" name="txtPassword" id="txtPassword" placeholder="Mật khẩu (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtPassword', ''); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtRePassword" class="control-label">Nhập lại mật khẩu</label>
                <div class="controls">
                  <input type="password" name="txtRePassword" id="txtRePassword" placeholder="Nhập lại mật khẩu (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtRePassword', ''); ?>">                  
                </div>                
            </div>
            -->
            <div class="control-group">
              <label for="txtEmail" class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="txtEmail" id="txtEmail" placeholder="Nhập email (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtEmail', $email); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtPhone" class="control-label">Số điện thoại</label>
                <div class="controls">
                  <input type="text" name="txtPhone" id="txtPhone" placeholder="Nhập số điện thoại" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtPhone', $phone); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtAddress" class="control-label">Địa chỉ</label>
              <div class="controls">
                <textarea name="txtAddress" id="txtAddress" rows="5" class="input-block-level" placeholder="Địa chỉ liên lạc" maxlength="255"><?php echo set_value('txtAddress', $address); ?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label for="txtWebsite" class="control-label">Liên kết website</label>
                <div class="controls">
                  <input type="text" name="txtWebsite" id="txtWebsite" placeholder="Liên kết website" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtWebsite', $website); ?>">                  
                </div>                
            </div>  
            <div class="control-group">
              <label for="slGroup" class="control-label">Nhóm cửa hàng</label>
                <div class="controls">                  
                  <select name="slGroup" id="slGroup" class="input-large">    
                  <?php 
                        foreach ($storegroup as $row) 
                        {                    
                  ?>            
                    <option value="<?php echo $row->id; ?>" <?php echo ($id_group == $row->id) ? 'selected="selected"' : ''; ?>><?php echo $row->name; ?></option>
                  <?php 
                        } //Close result                  
                  ?>                    
                  </select>
                </div>
            </div> 
            <div class="control-group">
              <label for="slStatus" class="control-label">Trạng thái</label>
                <div class="controls">                  
                  <select name="slStatus" id="slStatus" class="input-large">                
                    <option value="1" <?php echo ($status == 1) ? 'selected="selected"' : ''; ?>>Hiện</option>
                    <option value="0" <?php echo ($status == 0) ? 'selected="selected"' : ''; ?>>Ẩn</option>                    
                  </select>
                </div>
            </div> 
            <div class="control-group">
              <label for="txtLogo" class="control-label">Logo</label>
                <div class="controls">
                  <input type="text" name="txtLogo" id="txtLogo"  class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtLogo', $logo); ?>">
                  <button type="button" id="btnLogo" class="btn" >Chọn hình</button>  
                  <a id="btnLog" style="display:none" href="#modal-3" role="button" class="btn" data-toggle="modal">Alert</a>
                </div>
              </div>    
            <div class="control-group">
              <label for="txtImages" class="control-label">Ảnh đại diện</label>
                <div class="controls">
                  <input type="text" name="txtImages" id="txtImages"  class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtImages', $avatar); ?>">
                  <button type="button" id="btnImages" class="btn" >Chọn hình</button>  
                  <a id="btnLog1" style="display:none" href="#modal-2" role="button" class="btn" data-toggle="modal">Alert</a>
                </div>
            </div> 
            <div class="form-actions">
              <input type="hidden" id="hd_id" name="hd_id" value="<?php echo $id; ?>">
              <input type="hidden" name="hd_longitude" id="hd_longitude" value="<?php echo $longitude; ?>">
              <input type="hidden" name="hd_latitude" id="hd_latitude" value="<?php echo $latitude; ?>">
              <button type="submit" id="btnSave" class="btn btn-primary" >Cập nhật</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">
            $(document).ready(function(){    
              var id = $('#hd_id').val();
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
              
              function checknamecontact()
              {
                var namecontact = $('#txtNameContact').val();
                if(namecontact == "")
                {
                  var msgname = getError('Tên không dấu không được để trống.','txtNameSub'); 
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

              function checkusername()
              {
                var username = $('#txtUsername').val();
                if(username == "")
                {
                  var msgname = getError('Tài khoản không được để trống.','txtUsername'); 
                  $("#txtUsername").parent().parent().removeClass("success");
                  $("#txtUsername").parent().parent().addClass("error");
                  $("#txtUsername").parent().append(msgname);
                  $("#txtUsername").focus();
                }
                else 
                {
                  var msgname = getError('Tài khoản đã tồn tại.','txtUsername');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/store/checkanotherusername",
                      data: "username="+username+"&id="+id,
                      success: function(msg){
                        if(msg == 1) {
                          $("#txtUsername").parent().parent().removeClass("success");
                          $("#txtUsername").parent().parent().addClass("error");
                          $("#txtUsername").parent().append(msgname);
                          $("#txtUsername").focus();
                        }
                        else {
                          $("#txtUsername").parent().parent().removeClass("error");
                          $("#txtUsername").parent().parent().addClass("success");
                          $("#txtUsername").parent().find('span').remove("span");                          
                        }
                      }
                  });
                }
              }

              function checkpassword()
              {
                $("#txtPassword").parent().parent().removeClass("error success");
                $("#txtPassword").parent().find('span').remove("span"); 
                //Kiểm tra tên                                             
                var pass = $("#txtPassword").val().trim();
               
                  if(pass.length < 6 || pass.length > 20)
                  {
                    var msgname = getError('Mật khẩu phải từ 6 - 20 ký tự.','txtPassword'); 
                    $("#txtPassword").parent().parent().removeClass("success");
                    $("#txtPassword").parent().parent().addClass("error");
                    $("#txtPassword").parent().append(msgname);
                    //$("#txtPassword").focus();
                  }
                  else
                  {
                      $("#txtPassword").parent().parent().removeClass("error");
                      $("#txtPassword").parent().find('span').remove("span");
                      var msg = getError('Mật khẩu hợp lệ.','txtPassword'); 
                      $("#txtPassword").parent().parent().addClass("success");
                      $("#txtPassword").parent().append(msg);
                    
                  }
                
              }

              function checkrepass()
              {
                $("#txtRePassword").parent().parent().removeClass("error success");
                $("#txtRePassword").parent().find('span').remove("span"); 

                var pass    =   $("#txtPassword").val().trim();
                var repass  =   $("#txtRePassword").val().trim();
                if(pass.length >= 6 && pass.length <= 20)               
                {
                  if(repass != pass)
                  {
                    var msgname = getError('Mật khẩu lặp lại chưa trùng khớp.','txtRePassword'); 
                    $("#txtRePassword").parent().parent().removeClass("success");
                    $("#txtRePassword").parent().parent().addClass("error");
                    $("#txtRePassword").parent().append(msgname);
                    //$("#txtRePassword").focus();
                  }
                  else
                  {
                    $("#txtRePassword").parent().parent().removeClass("error");
                    $("#txtRePassword").parent().find('span').remove("span");
                    var msg = getError('Mật khẩu trùng khớp.','txtRePassword'); 
                    $("#txtRePassword").parent().parent().addClass("success");
                    $("#txtRePassword").parent().append(msg);
                  }
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
                      //$("#txtEmail").focus();
                  }
                  else
                  {
                      $("#txtEmail").parent().parent().removeClass("error");
                      $("#txtEmail").parent().find('span').remove("span");
                      var msg = getError('Email hợp lệ.','txtRePassword'); 
                      $("#txtEmail").parent().parent().addClass("success");
                      //$("#txtEmail").parent().append(msg);
                  }
                }
                else
                {
                    var msgname = getError('Email không được để trống.','txtEmail'); 
                      $("#txtEmail").parent().parent().removeClass("success");
                      $("#txtEmail").parent().parent().addClass("error");
                      $("#txtEmail").parent().append(msgname);
                      //$("#txtEmail").focus();
                }

              }

              $("#txtAddress").on('blur', function(){
                if($("#txtAddress").val() != "") {
                 $.ajax({
                          url: "http://maps.google.com/maps/api/geocode/json",
                          type: "get",
                          dataType: "json",
                          data: "address="  + $("#txtAddress").val(),
                          success: function(data) {
                            if(data.status == "OK") {
                              var lat = data.results[0].geometry.location.lat;
                              var lng = data.results[0].geometry.location.lng;     

                              $("#hd_latitude").val(lat);
                              $("#hd_longitude").val(lng);  
                            }                      
                          }
                      });
                }
              });

              $("form#frmupdate").on('submit', function(){
                $("#txtAddress").blur();
                //Cấu hình form mặc đinh        

                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");

                $("#txtNameContact").parent().parent().removeClass("error success");
                $("#txtNameContact").parent().find('span').remove("span");

                $("#txtUsername").parent().parent().removeClass("error success");
                $("#txtUsername").parent().find('span').remove("span");

                $("#txtPassword").parent().parent().removeClass("error success");
                $("#txtPassword").parent().find('span').remove("span");

                $("#txtRePassword").parent().parent().removeClass("error success");
                $("#txtRePassword").parent().find('span').remove("span");

                $("#txtEmail").parent().parent().removeClass("error success");
                $("#txtEmail").parent().find('span').remove("span");

                checkemail();
                //checkrepass();
                //checkpassword();
                checkusername();
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
              
              $('#btnLogo').click(function(){
                    $("#btnLog").click();
                      var l = $('#modal-3 .modal-body').elfinder({
                          url : '<?php echo base_url(); ?>public/js/plugins/elfinder/php/connector.php',
                          //height: 500,
                          //docked: false,
                      //dialog: { width: 400, modal: true },
                      //closeOnEditorCallback: true,
                      getFileCallback: function(file) {
                             $('#txtLogo').val(replaceurl(file.path));
                             $("#modal-3 button.btn").click();
                          }

                    });

                  }); 

              $('#btnImages').click(function(){
                    $("#btnLog1").click();
                      var l = $('#modal-2 .modal-body').elfinder({
                          url : '<?php echo base_url(); ?>public/js/plugins/elfinder/php/connector.php',
                          //height: 500,
                          //docked: false,
                      //dialog: { width: 400, modal: true },
                      //closeOnEditorCallback: true,
                      getFileCallback: function(file) {
                             $('#txtImages').val(replaceurl(file.path));
                             $("#modal-2 button.btn").click();
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