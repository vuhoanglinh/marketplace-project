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
        <li> <a href="<?php echo base_url(); ?>stores">Trang chủ</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="<?php echo base_url(); ?>stores/product">Sản phẩm</a> <i class="icon-angle-right"></i> </li>
        <?php if(isset($namect)) { ?>
        <li> <a href="<?php echo base_url();?>stores/product?idct=<?php echo $idct; ?>"><?php echo $namect; ?></a> <i class="icon-angle-right"></i> </li>   
        <?php } ?>
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
            <?php echo form_open('stores/product/addProduct', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtName" class="control-label">Tên</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên sản phẩm (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', ''); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtNameSub" class="control-label">Tên không dấu</label>
                <div class="controls">
                  <input type="text" name="txtNameSub" id="txtNameSub" placeholder="Tên không dấu (*)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtNameSub', ''); ?>">                  
                </div>
            </div>
			      <div class="control-group">
              <label for="slMain" class="control-label">Danh mục</label>
                <div class="controls">
                  <select name="slMain" id="slMain" class="input-large">  
                  <?php
                    foreach($result['parent'] as $row)
                    {
                   ?>            
                    <option value="<?php echo $row->id; ?>" <?php echo (count($result['child'][$index]) > 0)? 'disabled': ''; ?><?php if(isset($idct) && $idct == $row->id) echo ' selected="selected"'; ?>><?php echo $row->name; ?></option>
                    <?php 
                      foreach ($result['child'][$index] as $value) {      
                    ?>
                    <option value="<?php echo $value->id; ?>" <?php if(isset($idct) && $idct == $value->id) echo 'selected="selected"'; ?>>&nbsp&nbsp&nbsp&nbsp<?php echo $value->name; ?></option>
                  <?php                               
                      } // end foreach loop 2
                      $index++;           
                    } //end foreach loop 1
                  ?>
                  </select>
                </div>
            </div>
            <div class="control-group">
              <label for="txtAmount" class="control-label">Số lượng</label>
                <div class="controls">
                  <input type="text" name="txtAmount" id="txtAmount" placeholder="Số lượng sản phẩm (Nhập số)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtAmount', ''); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtPrice" class="control-label">Giá</label>
                <div class="controls">
                  <input type="text" name="txtPrice" id="txtPrice" placeholder="Giá sản phẩm (Nhập số)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtPrice', ''); ?>">                  
                </div>                
            </div>
            <div class="control-group">
              <label for="txtNewPrice" class="control-label">Giá khuyến mãi</label>
                <div class="controls">
                  <input type="text" name="txtNewPrice" id="txtNewPrice" placeholder="Giá khuyến mãi (Nhập số)" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtNewPrice', ''); ?>">                  
                </div>
            </div>
            <div class="control-group">
              <label for="txtType" class="control-label">Nhãn</label>
                <div class="controls">
                  <label class="radio">
                        <input type="radio" name="rdType" checked="checked" value="0"> Không có nhãn
                  </label> 
                  <label class="radio">
                        <input type="radio" name="rdType" value="1"> Nhãn mới
                  </label> 
                  <label class="radio">
                        <input type="radio" name="rdType" value="2"> Nhãn hot
                  </label>                
                </div>
            </div>
            <div class="control-group">
              <label for="txtKeyword" class="control-label">Keyword</label>
                <div class="controls">
                  <textarea name="txtKeyword" id="txtKeyword" rows="5" class="input-block-level" placeholder="Từ khóa" maxlength="255"></textarea>                
                </div>
            </div>  
            <div class="control-group">
              <label for="txtDescription" class="control-label">Description</label>
                <div class="controls">
                  <textarea name="txtDescription" id="txtDescription" rows="5" class="input-block-level" placeholder="Mô tả" maxlength="255"></textarea>                
                </div>
            </div>                 
            <div class="control-group">
              <label for="txtDetail" class="control-label">Mô tả</label>
                <div class="controls">
                  <textarea name="txtDetail" id="txtDetail" rows="5" class="input-block-level" placeholder="Mô tả ngắn" maxlength="255"></textarea>                
                </div>
            </div>
            <div class="control-group">
              <label for="txtContent" class="control-label">Bài viết</label>
                <div class="controls">
                  <textarea name="txtContent" id="txtContent" rows="5" class="input-block-level"></textarea>                
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
              <input type="hidden" name="hd_store" id="hd_store" value="<?php echo $id_store; ?>">
              <input type="hidden" name="hd_id" id="hd_id" value="0">
              <button type="submit" id="btnSave" class="btn btn-primary" >Thêm mới</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">            
            $(document).ready(function(){ 
              CKEDITOR.replace("txtDetail");
              CKEDITOR.replace("txtContent",{height: '600'});
              function checkname()
              {
                 //Kiểm tra tên                                             
                var name = $("#txtName").val();
                if(name == "")
                {
                  var msgname = getError('Tên sản phẩm không được để trống.','txtName'); 
                  $("#txtName").parent().parent().removeClass("success");
                  $("#txtName").parent().parent().addClass("error");
                  $("#txtName").parent().append(msgname);
                  $("#txtName").focus();
                }
                else {
                  var msgname = getError('Tên sản phẩm đã tồn tại.','txtName');         
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>stores/product/checkname",
                      data: "name="+name+"&id=0",
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
                      url: "<?php echo base_url(); ?>stores/product/checktitle",
                      data: "title="+title+"&id=0",
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

              $("#txtPrice").keypress(function(e){
                return keypress(e);
              });

              $("#txtNewPrice").keypress(function(e){
                return keypress(e);
              });

              $("#txtName").on('keyup keypress blur', function(){
                var title = changetitle($("#txtName").val());
                $("#txtNameSub").val(title);
              });

              $("#txtPrice").on('keyup keypress blur', function(){
                if($("#txtNewPrice").val() == "" || $("#txtNewPrice").val() == 0) {
                  $("#txtNewPrice").val($("#txtPrice").val());
                }
              });

              $('#btnCancel').click(function(){
                //Cấu hình form mặc đinh
                $("#txtNameSub").parent().parent().removeClass("error success");
                $("#txtNameSub").parent().find('span').remove("span");

                $("#txtName").parent().parent().removeClass("error success");
                $("#txtName").parent().find('span').remove("span");
                $("html, body").animate({ 
                    scrollTop: 0 
                }, 600);
              });
              $("form#frmadd").on('submit', function(){
                CKEDITOR.instances['txtDetail'].updateElement(); 
                CKEDITOR.instances['txtContent'].updateElement(); 

                if($("#txtAmount").val() == "") {
                  $("#txtAmount").val(0);
                }
                if($("#txtPrice").val() == "") {
                  $("#txtPrice").val(0);
                }
                if($("#txtNewPrice").val() == "") {
                  $("#txtNewPrice").val(0);
                }
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