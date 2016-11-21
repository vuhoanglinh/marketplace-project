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
            <?php echo form_open_multipart('admincp/user/addUser', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtName" class="control-label">Tên</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Nhập tên (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', ''); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtUsername" class="control-label">Tài khoản</label>
                <div class="controls">
                  <input type="text" name="txtUsername" id="txtUsername" placeholder="Nhập tài khoản (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtUsername', ''); ?>">                  
                </div>
            </div>            
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
            <div class="control-group">
              <label for="txtEmail" class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="txtEmail" id="txtEmail" placeholder="Nhập email (*)" class="input-xlarge" maxlength="255" value="<?php echo set_value('txtEmail', ''); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtPhone" class="control-label">Số điện thoại</label>
                <div class="controls">
                  <input type="text" name="txtPhone" id="txtPhone" placeholder="Nhập số điện thoại" class="input-large" maxlength="255" value="<?php echo set_value('txtPhone', ''); ?>">                  
                </div>
            </div> 
            <div class="control-group">
              <label for="rLevel" class="control-label">Chức vụ</label>
                <div class="controls">                  
                  <label class="radio">
                    <input type="radio" name="rlevel" value="0" checked="checked"> Quản lý sản phẩm, bài viết...
                  </label>
                  <label class="radio">
                    <input type="radio" name="rlevel" value="1"> Quản trị hệ thống
                  </label>
                </div>
            </div>            
            <div class="control-group">
              <label for="txtAddress" class="control-label">Địa chỉ</label>
                <div class="controls">
                  <textarea name="txtAddress" id="txtAddress" rows="5" class="input-block-level" placeholder="Nhập địa chỉ" maxlength="255"><?php echo set_value('txtAddress', ''); ?></textarea>                
                </div>
            </div>      
            <div class="control-group">
              <label for="txtImages" class="control-label">Hình đại diện</label>
                <div class="controls">
                  <input type="text" name="txtImages" id="txtImages"  class="input-xlarge" placeholder="Hình đại diện" maxlength="255" value="<?php echo set_value('txtImages', ''); ?>">
                  <button type="button" id="btnImages" class="btn" >Chọn hình</button>  
                  <a id="btnLog" style="display:none" href="#modal-3" role="button" class="btn" data-toggle="modal">Alert</a>
                </div>
            </div>
            <!--  Control Image not use    
            <div class="control-group">
              <label for="imagefile" class="control-label">Hình đại diện</label>
                <div class="controls">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                    <div>
                      <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ufile" id="ufile" size="25" /></span>
                      <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                  </div>
                </div>
            </div>   
            -->      
            <div class="form-actions">
              <button type="submit" id="btnSave" class="btn btn-primary" >Thêm mới</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">
            $(document).ready(function(){
              function checkusername()
              {
                
                $("#txtUsername").parent().parent().removeClass("error success");
                $("#txtUsername").parent().find('span').remove("span");

                //Kiểm tra username                          
                var user = $("#txtUsername").val().trim();
                if(user == "")
                {
                  var msgcode = getError('Tài khoản không được để trống.','txtUsername'); 
                  $("#txtUsername").parent().parent().removeClass("success");
                  $("#txtUsername").parent().parent().addClass("error");
                  $("#txtUsername").parent().append(msgcode);
                  //$("#txtUsername").focus();
                }
                else 
                { 
                  var msgcode = getError('Tài khoản đã tồn tại.','txtUsername');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/user/checkusername",
                      data: "user="+user,
                      success: function(msg){
                        if(msg == 1) {
                          $("#txtUsername").parent().parent().removeClass("success");
                          $("#txtUsername").parent().parent().addClass("error");
                          $("#txtUsername").parent().append(msgcode);
                          //$("#txtUsername").focus();
                        }
                        else {                          
                          $("#txtUsername").parent().parent().removeClass("error");
                          $("#txtUsername").parent().find('span').remove("span");
                          var msgcode = getError('Tài khoản hợp lệ.','txtUsername');   
                          $("#txtUsername").parent().append(msgcode);
                          $("#txtUsername").parent().parent().addClass("success");
                          
                        }
                      }
                    });
                }
              }

              function checkname()
              {
                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span"); 
                //Kiểm tra tên                                             
                var name = $("#txtName").val().trim();
                if(name == "")
                {
                  var msgname = getError('Tên không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  //$("#txtName").focus();
                }
                else
                {
                  $("#txtName").parent().parent().removeClass("error");
                  $("#txtName").parent().parent().addClass("success");
                  $("#txtName").parent().find('span').remove("span");
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

              $("#txtName").on('blur', function(){
                checkname();
              });
              $("#txtUsername").on('blur', function(){
                checkusername();
              });
              $("#txtPassword").on('blur', function(){
                checkpassword();
              });
              $("#txtRePassword").on('blur', function(){                
                checkrepass();                
              });
              $("#txtEmail").on('blur', function(){                
                checkemail();                
              });

              $("#txtPhone").keypress(function(e){
                return keypress(e);
              });

              //Validate input submit form                 

              $("form#frmadd").on('submit', function(){

                //Cấu hình form mặc đinh
                $("#txtUsername").parent().parent().removeClass("error success");
                $("#txtUsername").parent().find('span').remove("span");

                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");    

                checkemail();
                checkrepass(); 
                checkpassword();
                checkname();
                checkusername();

                if($("#txtPhone").val() == "") {
                  $("#txtPhone").val('0')
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
                  
                /*
                 //upload file by ajax
                 $.ajaxFileUpload({
                    url: from.attr('action'),
                    type: from.attr('method'),
                    secureuri: false,
                    fileElementId: 'ufile',
                    dataType: 'json',
                    data: $(from).serialize(),
                    beforeSend : function (){
                              $("#modal-4 .modal-body p").html('Đang tải...');
                              $("#btnAlert").click();
                          },
                          success: function(data) {
                              $("#modal-4 .modal-body p").html(data.msg);
                          }
                 });
                 */
                 return false;
               
              });
               
              $('#btnImages').click(function(){
                    $("#btnLog").click();
                      var l = $('#modal-3 .modal-body').elfinder({
                          url : '<?php echo base_url(); ?>public/js/plugins/elfinder/php/connector.php',
                          //height: 500,
                          //docked: false,
                      //dialog: { width: 400, modal: true },
                      //closeOnEditorCallback: true,
                      getFileCallback: function(file) {
                             $('#txtImages').val(replaceurl(file.path));
                             $("#modal-3 button.btn").click();
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