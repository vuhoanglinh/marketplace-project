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
        <li> <a href="<?php echo base_url(); ?>admincp/themes">Thư viện template</a> <i class="icon-angle-right"></i> </li>
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
            <?php echo form_open('admincp/themes/updateThemes', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>            
            <div class="control-group">
              <label for="txtName" class="control-label">Tên template</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên template (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', $name); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtFolder" class="control-label">Tên thư mục</label>
                <div class="controls">
                  <input type="text" name="txtFolder" id="txtFolder" placeholder="Tên thư mục (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtFolder', $folder); ?>">                  
                </div>
            </div>             
            <div class="control-group">
              <label for="txtImage1" class="control-label">Hình ảnh 1</label>
              <div class="controls">
                <input type="text" name="txtImage1" id="txtImage1"  class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtImage1', $image1); ?>">
                <button type="button" id="btnImage1" class="btn" >Chọn hình</button>  
                <a id="btnLog" style="display:none" href="#modal-3" role="button" class="btn" data-toggle="modal">Alert</a>
              </div>
            </div>
            <div class="control-group">
              <label for="txtImage2" class="control-label">Hình ảnh 2</label>
              <div class="controls">
                <input type="text" name="txtImage2" id="txtImage2"  class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtImage2', $image2); ?>">
                <button type="button" id="btnImage2" class="btn" >Chọn hình</button>  
              </div>
            </div>
            <div class="control-group">
              <label for="txtImage3" class="control-label">Hình ảnh 3</label>
              <div class="controls">
                <input type="text" name="txtImage3" id="txtImage3"  class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtImage3', $image3); ?>">
                <button type="button" id="btnImage3" class="btn" >Chọn hình</button>  
              </div>
            </div>
            <div class="control-group">
              <label for="txtImage4" class="control-label">Hình ảnh 4</label>
              <div class="controls">
                <input type="text" name="txtImage4" id="txtImage4"  class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtImage4', $image4); ?>">
                <button type="button" id="btnImage4" class="btn" >Chọn hình</button>  
              </div>
            </div>
            <div class="control-group">
              <label for="slStatus" class="control-label">Trạng thái</label>
                <div class="controls">                  
                  <select name="slStatus" id="slStatus" class="input-large">                
                    <option value="1" <?php echo ($status == 1)? 'selected="selected"' : ''; ?>>Hiện</option>
                    <option value="0" <?php echo ($status == 1)? 'selected="selected"' : ''; ?>>Ẩn</option>                    
                  </select>
                </div>
            </div>     
            <div class="control-group">
              <label for="txtDetail" class="control-label">Mô tả</label>
              <div class="controls">
                <textarea name="txtDetail" id="txtDetail" rows="5" class="input-block-level" placeholder="Mô tả"><?php echo set_value('txtDetail',$detail); ?></textarea>
              </div>
            </div>       
            <div class="form-actions">
              <input type="hidden" name="hd_id" id="hd_id" value="<?php echo $id; ?>">
              <button type="submit" id="btnSave" class="btn btn-primary" >Cập nhật</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">            
            $(document).ready(function(){ 
              
              function checkname()
              {
                 //Kiểm tra tên                                             
                var name = $("#txtName").val();
                if(name == "")
                {
                  var msgname = getError('Tên template không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  $("#txtName").focus();
                }
                else {
                  var msgname = getError('Tên template đã tồn tại.','txtName');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/themes/checkname",
                      data: "name="+name+"&id=<?php echo $id; ?>",
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

              function checkfolder()
              {
                 //Kiểm tra tên                                             
                var name = $("#txtFolder").val();
                if(name == "")
                {
                  var msgname = getError('Tên thư mục không được để trống.','txtFolder'); 
                  $("#txtFolder").parent().parent().removeClass("success");
                  $("#txtFolder").parent().parent().addClass("error");
                  $("#txtFolder").parent().append(msgname);
                  $("#txtFolder").focus();
                }
                else {
                  var msgname = getError('Tên thư mục đã tồn tại.','txtFolder');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>admincp/themes/checkfolder",
                      data: "name="+name+"&id=<?php echo $id; ?>",
                      success: function(msg){
                        if(msg == 1) {
                          $("#txtFolder").parent().parent().removeClass("success");
                          $("#txtFolder").parent().parent().addClass("error");
                          $("#txtFolder").parent().append(msgname);
                          $("#txtFolder").focus();
                        }
                        else {
                          $("#txtFolder").parent().parent().removeClass("error");
                          $("#txtFolder").parent().parent().addClass("success");
                          $("#txtFolder").parent().find('span').remove("span");                          
                        }
                      }
                  });
                }
              }
          
              function SetFileField1(fileUrl) {
                    jQuery('#txtImage1').val(fileUrl);
              } 
              $("#btnImage1").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField1;
                    finder.popup();
              });

              function SetFileField2(fileUrl) {
                    jQuery('#txtImage2').val(fileUrl);
              } 
              $("#btnImage2").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField2;
                    finder.popup();
              });

              function SetFileField3(fileUrl) {
                    jQuery('#txtImage3').val(fileUrl);
              } 
              $("#btnImage3").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField3;
                    finder.popup();
              });

              function SetFileField4(fileUrl) {
                    jQuery('#txtImage4').val(fileUrl);
              } 
              $("#btnImage4").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField4;
                    finder.popup();
              });

              CKEDITOR.replace('txtDetail', {height : 400});

              $("form#frmadd").on('submit', function(){
                CKEDITOR.instances['txtDetail'].updateElement(); //Updates CKeditor before get value by ajax
                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");

                $("#txtFolder").parent().parent().removeClass("error success");
                $("#txtFolder").parent().find('span').remove("span");

                checkfolder();
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