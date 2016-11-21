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
        <li> <a href="<?php echo base_url(); ?>admincp/partner">Đối tác</a> <i class="icon-angle-right"></i> </li>
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
            <?php echo form_open('admincp/partner/updatePartner', array('id' => 'frmupdate', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtCode" class="control-label">Code</label>
                <div class="controls">
                  <input type="text" name="txtCode" id="txtCode" placeholder="Mã code (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtCode',$code); ?>">                  
                </div>
            </div>           
            <div class="control-group">
              <label for="txtName" class="control-label">Tên</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Nhập tên (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', $name); ?>">                  
                </div>                
            </div>  
            <div class="control-group">
              <label for="txtEmail" class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="txtEmail" id="txtEmail" placeholder="Nhập email (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtEmail', $email); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtPhone" class="control-label">Số điện thoại</label>
                <div class="controls">
                  <input type="text" name="txtPhone" id="txtPhone" placeholder="Nhập số điện thoại (*)(Nhập số)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtPhone', $phone); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtLink" class="control-label">Liên kết</label>
                <div class="controls">
                  <input type="text" name="txtLink" id="txtLink" placeholder="Liên kết " class="input-xlarge" maxlength="255" value="<?php echo set_value('txtLink', $link); ?>">                  
                </div>                
            </div> 
            <div class="control-group">
              <label for="txtImages" class="control-label">Logo</label>
                <div class="controls">
                  <input type="text" name="txtImages" id="txtImages"  class="input-xlarge" placeholder="Logo" maxlength="255" value="<?php echo set_value('txtImages', $logo); ?>">
                  <button type="button" id="btnImages" class="btn" >Chọn hình</button>  
                  <a id="btnLog" style="display:none" href="#modal-3" role="button" class="btn" data-toggle="modal">Alert</a>
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
              var id   =  $('#hd_id').val();
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
                      url: "<?php echo base_url(); ?>admincp/partner/checkanothercode",
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
                      url: "<?php echo base_url(); ?>admincp/partner/checkanothername",
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
                      //$("#txtEmail").parent().append(msg);
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

              function checkphone()
              {
                var phone = $('#txtPhone').val();

                if(phone == "")
                {
                  var msgname = getError('Điện thoại không được để trống.','txtPhone'); 
                      $("#txtPhone").parent().parent().removeClass("success");
                      $("#txtPhone").parent().parent().addClass("error");
                      $("#txtPhone").parent().append(msgname);
                      $("#txtPhone").focus();
                }
                else
                {
                      $("#txtPhone").parent().parent().removeClass("error");
                      $("#txtPhone").parent().find('span').remove("span");                      
                      $("#txtPhone").parent().parent().addClass("success");
                }
              }

              $("#txtPhone").keypress(function(e){
                return keypress(e);
              });

              $("form#frmupdate").on('submit', function(){

                //Cấu hình form mặc đinh
                $("#txtCode").parent().parent().removeClass("error success");
                $("#txtCode").parent().find('span').remove("span");
                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");
                $("#txtEmail").parent().parent().removeClass("error success");
                $("#txtEmail").parent().find('span').remove("span");
                $("#txtPhone").parent().parent().removeClass("error success");
                $("#txtPhone").parent().find('span').remove("span");
                checkphone();
                checkemail();
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
                                  $(location).attr('href','<?php echo base_url(); ?>/admincp/partner');
                                }
                              });
                          }
                      });
                
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