<div id="main">
  <div class="container-fluid">
    <div class="page-header">
      <div class="pull-left">
        <h1><?php echo $titlepage; ?></h1>
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
        <li> <a href="<?php echo base_url('stores'); ?>">Trang chủ</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="#">Thiết lập cửa hàng</a> </li>
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box box-color box-bordered">
          <div class="box-title">
            <h3> <i class="icon-th-list"></i> <?php echo $titlepage; ?> </h3>
          </div>
          <div class="box-content nopadding">
            <ul class="tabs tabs-inline tabs-top">
              <li class='active'> <a href="#first11" data-toggle='tab'><i class="icon-home"></i> Cửa hàng</a> </li>
              <li> <a href="#second22" data-toggle='tab'><i class="glyphicon-t-shirt"></i> Giới thiệu</a> </li>
              <li> <a href="#thirds33" data-toggle='tab'><i class="glyphicon-old_man"></i> SEO</a> </li>
              <li> <a href="#thirds3322" data-toggle='tab'><i class="glyphicon-notes"></i> Thương hiệu</a> </li>
            </ul>
            <?php echo form_open('stores/store/editconfig', array('class' => 'form-horizontal form-bordered', 'id' => 'frmedit')) ;?>
            <div class="tab-content tab-content-inline tab-content-bottom">
              <div class="tab-pane active" id="first11">
                <div class="control-group">
                  <label for="txtLogo" class="control-label">Logo cửa hàng</label>
                  <div class="controls">
                    <input type="text" name="txtLogo" id="txtLogo" placeholder="Logo cửa hàng" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtLogo', $logo); ?>">
                    <button type="button" id="btnLogo" class="btn" >Chọn hình</button>
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtWebsite" class="control-label">Liên kết website</label>
                  <div class="controls">
                    <input type="text" name="txtWebsite" id="txtHotline" placeholder="Liên kết website" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtWebsite', $website); ?>">                   
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtHotline" class="control-label">Hotline</label>
                  <div class="controls">
                    <input type="text" name="txtHotline" id="txtHotline" placeholder="Hotline" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtHotline', $hotline); ?>">                   
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtDetail" class="control-label">Thông tin liên hệ</label>
                  <div class="controls">
                    <textarea name="txtDetail" id="txtDetail" rows="5"><?php echo set_value('txtDetail', $detail); ?></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" id="btnSaveHome" class="btn btn-primary" >Lưu thông tin</button>
                </div>
              </div>
              <div class="tab-pane" id="second22">
                <div class="control-group">
                  <label for="txtIntro" class="control-label">Bài viết giới thiệu</label>
                  <div class="controls">
                    <textarea name="txtIntro" id="txtIntro" rows="5"><?php echo set_value('txtIntro, $intro'); ?></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" id="btnSaveProduct" class="btn btn-primary" >Lưu thông tin</button>
                </div>
              </div>              
              <div class="tab-pane" id="thirds33">
                <div class="control-group">
                  <label for="txtKeyword" class="control-label">Meta Keyword</label>
                  <div class="controls">
                    <textarea name="txtKeyword" id="txtKeyword" rows="5" class="input-block-level" placeholder="Meta Keyword" maxlength="255"><?php echo set_value('txtKeyword', $keyword); ?></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label for="txtDescription" class="control-label">Meta Description</label>
                  <div class="controls">
                    <textarea name="txtDescription" id="txtDescription" rows="5" class="input-block-level" placeholder="Meta Description" maxlength="255"><?php echo set_value('txtDescription', $description); ?></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" id="btnSavePartner" class="btn btn-primary" >Lưu thông tin</button>
                  <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a> </div>
              </div>
              <div class="tab-pane" id="thirds3322">    
                <div class="control-group">
                  <label for="txtDescripBrand" class="control-label">Mô tả thương hiệu</label>
                  <div class="controls">
                    <textarea name="txtDescripBrand" id="txtDescripBrand" rows="5" class="input-block-level"><?php echo set_value('txtDescripBrand', $descript_brand); ?></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" id="btnSaveNews" class="btn btn-primary" >Lưu thông tin</button>
                </div>                
              </div>
            </div>
            <input type="hidden" id="hd_id_store" name="hd_id_store" value="<?php echo $id_store; ?>">
            <?php echo form_close(); ?> </div>
          <script type="text/javascript">
								$(document).ready(function() {
									CKEDITOR.replace("txtIntro", {height: '600'});
                  CKEDITOR.replace("txtDescripBrand", {height: '400'});
									CKEDITOR.replace("txtDetail");

                  function SetFileField(fileUrl) {
                    jQuery('#txtLogo').val(fileUrl);
                  } 
                  $("#btnLogo").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField;
                    finder.popup();
                  }); 

									//Form Seo Home
								  	$("form#frmedit").on('submit', function(){
								  	   CKEDITOR.instances['txtIntro'].updateElement(); //Updates CKeditor before get value by ajax
								  	   CKEDITOR.instances['txtDetail'].updateElement(); //Updates CKeditor before get value by ajax
                       CKEDITOR.instances['txtDescripBrand'].updateElement(); //Updates CKeditor before get value by ajax
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
