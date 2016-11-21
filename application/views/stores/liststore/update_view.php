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
            <?php echo form_open('stores/liststore/updateStore', array('id' => 'frmupdate', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtName" class="control-label">Tên cửa hàng chi nhánh</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên cửa hàng chi nhánh" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtName', $name); ?>">   
                </div>                
            </div> 
            <div class="control-group">
              <label for="txtAddress" class="control-label">Địa chỉ</label>
              <div class="controls">
                <textarea name="txtAddress" id="txtAddress" class="input-block-level" placeholder="Địa chỉ liên lạc" rows="5"><?php echo set_value('txtAddress', $address); ?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label for="txtPhone" class="control-label">Số điện thoại</label>
                <div class="controls">
                  <input type="text" name="txtPhone" id="txtPhone" placeholder="Số điện thoại" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtPhone', $phone); ?>">                 
                </div>                
            </div>
            <div class="control-group">
              <label for="txtFax" class="control-label">Số fax</label>
                <div class="controls">
                  <input type="text" name="txtFax" id="txtFax" placeholder="Số fax" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtFax', $fax); ?>">       
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
              <input type="hidden" name="hd_id" id="hd_id" value="<?php echo $id; ?>">
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
              $("form#frmupdate").on('submit', function(){                
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