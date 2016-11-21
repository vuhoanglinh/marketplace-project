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
        <li> <a href="<?php echo base_url(); ?>adminlevel">Trang chủ</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="<?php echo base_url(); ?>adminlevel/news">Tin tức</a> <i class="icon-angle-right"></i> </li>

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
            <?php echo form_open('adminlevel/news/addNews', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>            
            <div class="control-group">
              <label for="txtName" class="control-label">Tiêu đề</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tiêu đề(*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', ''); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtNameSub" class="control-label">Tên không dấu</label>
                <div class="controls">
                  <input type="text" name="txtNameSub" id="txtNameSub" placeholder="Tên không dấu (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtNameSub', ''); ?>">                  
                </div>
            </div>       
            <div class="control-group">
              <label for="slParent" class="control-label">Danh mục</label>
                <div class="controls">
                  <select name="slParent" id="slParent" class="input-large">
                  <?php
                    foreach($category as $row)
                    {
                   ?>            
                    <option value="<?php echo $row->id; ?>" <?php if(isset($_GET['cat']) && $_GET['cat'] == $row->id) echo 'selected="selected"'; ?>><?php echo $row->name; ?></option>
                  <?php                    
                    }
                  ?>
                  </select>
                </div>
            </div> 
            <div id="video" class="control-group" style="display:none;">
              <label for="txtVideo" class="control-label">Video</label>
                <div class="controls">
                  <input type="text" name="txtVideo" id="txtVideo" placeholder="Đường dẫn video" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtVideo', ''); ?>">               
                </div>                
            </div>
            <div id="extent">
            <div class="control-group">
              <label for="txtLink" class="control-label">Hình ảnh</label>
                <div class="controls">
                  <input type="text" name="txtLink" id="txtLink" placeholder="Đường dẫn hình ảnh" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtLink', ''); ?>">                  
                  <button type="button" id="btnImages" class="btn" >Chọn hình</button>
                </div>                
            </div>  
            <div class="control-group">
              <label for="txtKeyword" class="control-label">Từ khóa</label>
              <div class="controls">
                <textarea name="txtKeyword" id="txtKeyword" rows="5" class="input-block-level" placeholder="Từ khóa"><?php echo set_value('txtKeyword',''); ?></textarea>
              </div>
            </div>             
            <div class="control-group">
              <label for="txtDescription" class="control-label">Mô tả từ khóa</label>
              <div class="controls">
                <textarea name="txtDescription" id="txtDescription" rows="5" class="input-block-level" placeholder="Mô tả từ khóa"><?php echo set_value('txtDescription',''); ?></textarea>
              </div>
            </div> 
            <div class="control-group">
              <label for="txtDetail" class="control-label">Mô tả bài viết</label>
              <div class="controls">
                <textarea name="txtDetail" id="txtDetail" rows="5" class="input-block-level" placeholder="Mô tả bài viết"><?php echo set_value('txtDetail',''); ?></textarea>
              </div>
            </div> 
            <div class="control-group">
              <label for="txtContent" class="control-label">Nội dung bài viết</label>
              <div class="controls">
                <textarea name="txtContent" id="txtContent" rows="5" class="input-block-level" placeholder="Nội dung bài biết"><?php echo set_value('txtContent',''); ?></textarea>
              </div>
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
              <input type="hidden" name="hd_id" id="hd_id" value="0">
              <button type="submit" id="btnSave" class="btn btn-primary" >Thêm mới</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">            
            $(document).ready(function(){ 
              CKEDITOR.replace("txtContent",{height: '600'});
              var parent =  $('#slParent').val();  
              function showvideo()
              {
                if(parent == 3) {
                  $("#video").show();
                  $("#extent").hide();
                }
                else {
                  $("#video").hide();
                  $("#extent").show();
                }
              }
              showvideo();
              $('#slParent').change(function(){
                parent =  $('#slParent').val(); 
                showvideo();
              });
              function checkname()
              {
                 //Kiểm tra tên                                             
                var name = $("#txtName").val();
                if(name == "")
                {
                  var msgname = getError('Tiêu đề bài viết không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  $("#txtName").focus();
                }
                else {
                  var msgname = getError('Tiêu đề bài viết đã tồn tại.','txtName');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>adminlevel/news/checkname",
                      data: "name="+name+"&id_parent="+parent+"&id=0",
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
                      url: "<?php echo base_url(); ?>adminlevel/news/checktitle",
                      data: "title="+title+"&id_parent="+parent+"&id=0",
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

              function SetFileField(fileUrl) {
                    jQuery('#txtLink').val(fileUrl);
              } 
              $("#btnImages").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField;
                    finder.popup();
              });            

              $("#txtName").on('keyup keypress blur', function(){
                var title = changetitle($("#txtName").val());
                $("#txtNameSub").val(title);
              });

              $("form#frmadd").on('submit', function(){
                CKEDITOR.instances['txtContent'].updateElement(); //Updates CKeditor before get value by ajax
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