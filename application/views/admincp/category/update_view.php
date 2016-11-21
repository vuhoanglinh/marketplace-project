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
        <li> <a href="<?php echo base_url(); ?>admincp/category">Danh mục sản phẩm</a> <i class="icon-angle-right"></i> </li>
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
            <?php echo form_open('admincp/category/updateCategory', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtName" class="control-label">Tên</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên danh mục (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', $name); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtNameSub" class="control-label">Tên không dấu</label>
                <div class="controls">
                  <input type="text" name="txtNameSub" id="txtNameSub" placeholder="Tên không dấu (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtNameSub', $title); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="slParent" class="control-label">Danh mục cha</label>
                <div class="controls">
                  <select name="slParent" id="slParent" class="input-large">  
                    <option value="0">--</option>  
                  <?php
                    foreach($query as $row)
                    {
                   ?>            
                    <option value="<?php echo $row->id; ?>" <?php echo ($id_parent == $row->id)?'selected="selected"':''; ?>><?php echo $row->name; ?></option>
                  <?php                    
                    }
                  ?>
                  </select>
                </div>
            </div> 
            <div class="control-group">
              <label for="txtLogo" class="control-label">Hình ảnh</label>
              <div class="controls">
                <input type="text" name="txtLogo" id="txtLogo"  class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtLogo', $images); ?>">
                <button type="button" id="btnLogo" class="btn" >Chọn hình</button>  
                <a id="btnLog" style="display:none" href="#modal-3" role="button" class="btn" data-toggle="modal">Alert</a>
              </div>
            </div>
            <div class="control-group">
              <label for="txtLink" class="control-label">Liên kết hình ảnh</label>
              <div class="controls">
                <input type="text" name="txtLink" id="txtLink" placeholder="Mặc định" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtLink', ''); ?>">               
              </div>
            </div>
            <div class="control-group">
              <label for="slStatus" class="control-label">Trạng thái</label>
                <div class="controls">                  
                  <select name="slStatus" id="slStatus" class="input-large">                
                    <option value="1" <?php echo ($status == 1)?'selected="selected"':''; ?>>Hiện</option>
                    <option value="0" <?php echo ($status == 0)?'selected="selected"':''; ?>>Ẩn</option>                    
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
              <input type="hidden" id="hd_id" name="hd_id" value="<?php echo set_value('hd_id', $id);  ?>">
              <button type="submit" id="btnSave" class="btn btn-primary" >Cập nhật</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">            
            $(document).ready(function(){ 
              CKEDITOR.replace("txtDetail");
              var parent =  $('#slParent').val();  
              $('#slParent').change(function(){
                parent =  $('#slParent').val(); 
              });
              var id = $('#hd_id').val();
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
                      url: "<?php echo base_url(); ?>admincp/category/checkanothername",
                      data: "id="+id+"&name="+name+"&id_parent="+parent,
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
                      url: "<?php echo base_url(); ?>admincp/category/checkanothertitle",
                      data: "id="+id+"&title="+title+"&id_parent="+parent,
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

              $('#btnLogo').click(function(){
                  $("#btnLog").click();
                    var l = $('#modal-3 .modal-body').elfinder({
                      url : '<?php echo base_url(); ?>public/js/plugins/elfinder/php/connector.php',
                      getFileCallback: function(file) {
                        $('#txtLogo').val(replaceurl(file.path));
                        $("#modal-3 button.btn").click();
                      }
                    });
              });             

              $("#txtName").on('keyup keypress blur', function(){
                var title = changetitle($("#txtName").val());
                $("#txtNameSub").val(title);
              });

              $("form#frmadd").on('submit', function(){
                CKEDITOR.instances['txtDetail'].updateElement(); //Updates CKeditor before get value by ajax
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