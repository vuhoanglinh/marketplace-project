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
        <li> <a href="<?php echo base_url('adminlevel/slideshow'); ?>">Thư viện slideshow</a> <i class="icon-angle-right"></i> </li>        
        <li> <a href="#">Upload hình</a></li>
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
            <?php echo form_open('adminlevel/slideshow/addImages', array('id' => 'frmadd', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtImages" class="control-label">Hình ảnh</label>
                <div class="controls">
                  <input type="text" name="txtImages" id="txtImages" placeholder="Đường dẫn hình ảnh" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtImages', ''); ?>">                  
                  <button type="button" id="btnImages" class="btn" >Chọn hình</button>
                </div>                
            </div> 
            <div class="control-group">
              <label for="txtLink" class="control-label">Liên kết hình ảnh</label>
                <div class="controls">
                  <input type="text" name="txtLink" id="txtLink" placeholder="Đường dẫn liên kết" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtLink', ''); ?>">       
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
              <button type="submit" id="btnSave" class="btn btn-primary" >Thêm mới</button>
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

              $("form#frmadd").on('submit', function(){
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