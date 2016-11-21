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
        <li> <a href="<?php echo base_url(); ?>stores/liststore">Chi nhánh cửa hàng</a><i class="icon-angle-right"></i></li>
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
            <?php echo form_open('stores/liststore/addStore', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtName" class="control-label">Tên cửa hàng chi nhánh</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên cửa hàng chi nhánh" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', ''); ?>">   
                </div>                
            </div> 
            <div class="control-group">
              <label for="txtAddress" class="control-label">Địa chỉ</label>
              <div class="controls">
                <textarea name="txtAddress" id="txtAddress" class="input-block-level" placeholder="Địa chỉ liên lạc" maxlength="255" rows="5"><?php echo set_value('txtAddress', ''); ?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label for="txtPhone" class="control-label">Số điện thoại</label>
                <div class="controls">
                  <input type="text" name="txtPhone" id="txtPhone" placeholder="Số điện thoại" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtPhone', ''); ?>">                 
                </div>                
            </div>
            <div class="control-group">
              <label for="txtFax" class="control-label">Số fax</label>
                <div class="controls">
                  <input type="text" name="txtFax" id="txtFax" placeholder="Số fax" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtFax', ''); ?>">       
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
              <input type="hidden" name="hd_longitude" id="hd_longitude" value="0">
              <input type="hidden" name="hd_latitude" id="hd_latitude" value="0">
              <button type="submit" id="btnSave" class="btn btn-primary" >Thêm mới</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
          </div>
          <script type="text/javascript">            
            $(document).ready(function(){   
              resize();            
              $("#txtAddress").on('blur', function(){
                if($("#txtAddress").val() != "") {
                 $.ajax({
                          url: "http://maps.google.com/maps/api/geocode/json",
                          type: "get",
                          dataType: "json",
                          data: {address : $("#txtAddress").val()},
                          success: function(data) {
                              var lat = data.results[0].geometry.location.lat;
                              var lng = data.results[0].geometry.location.lng;     

                              $("#hd_latitude").val(lat);
                              $("#hd_longitude").val(lng);                        
                          }
                      });
                }
              });

              $("form#frmadd").on('submit', function(){
                $("#txtAddress").blur();
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