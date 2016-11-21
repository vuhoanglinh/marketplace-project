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
        <?php if(!isset($_GET['ad'])) {?>
        <li> <a href="<?php echo base_url('stores/images'); ?>">Thư viện slideshow</a> <i class="icon-angle-right"></i> </li>
        <?php } else {?>
        <li> <a href="<?php echo base_url('stores/images/ad'); ?>">Ảnh quảng cáo</a> <i class="icon-angle-right"></i> </li>
        <?php } ?>
        <li> <a href="#">Upload hình</a></li>
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
            <?php echo form_open('stores/images/updateImages', array('id' => 'frmupdate', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtImages" class="control-label">Hình ảnh</label>
                <div class="controls">
                  <input type="text" name="txtImages" id="txtImages" placeholder="Đường dẫn hình ảnh" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtImages', $image); ?>">                  
                  <button type="button" id="btnImages" class="btn" >Chọn hình</button>
                </div>                
            </div> 
            <div class="control-group">
              <label for="txtThumb" class="control-label">Thumb</label>
                <div class="controls">
                  <input type="text" name="txtThumb" id="txtThumb" placeholder="Đường dẫn hình ảnh" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtThumb', $thumb); ?>">                  
                  <button type="button" id="btnThumb" class="btn" >Chọn hình</button>
                </div>                
            </div>
            <div class="control-group">
              <label for="txtLink" class="control-label">Liên kết hình ảnh</label>
                <div class="controls">
                  <input type="text" name="txtLink" id="txtLink" placeholder="Đường dẫn liên kết" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtLink', $link); ?>">       
                </div>                
            </div>
            <div class="control-group">
              <label for="slType" class="control-label">Loại hình</label>
                <div class="controls">                  
                  <select name="slType" id="slType" class="input-large">                
                    <option value="0">Hình ảnh slideshow</option>
                    <option value="1" <?php echo isset($_GET['ad'])? 'selected="selected"': ''; ?>>Hình ảnh quảng cáo</option>                    
                  </select>
                </div>
            </div>          
            <div class="control-group">
              <label for="slStatus" class="control-label">Trạng thái</label>
                <div class="controls">                  
                  <select name="slStatus" id="slStatus" class="input-large">                
                    <option value="1" <?php echo ($status == 1)? 'selected="selected"': '';?>>Hiện</option>
                    <option value="0" <?php echo ($status == 0) ?'selected="selected"': '';?>>Ẩn</option>                    
                  </select>
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
              resize();
              function SetFileField(fileUrl) {
                    jQuery('#txtImages').val(fileUrl);
              } 
              $("#btnImages").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField;
                    finder.popup();
              }); 

              function SetFileField1(fileUrl) {
                    jQuery('#txtThumb').val(fileUrl);
              } 
              $("#btnThumb").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField1;
                    finder.popup();
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