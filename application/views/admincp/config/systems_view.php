
<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1><?php echo $titlepage; ?></h1>
					</div>
					<div class="pull-right">
						<ul class="stats">							
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo base_url(); ?>admincp">Trang chủ</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Hệ thống</a>
						</li>				
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-th-list"></i>
									Cấu hình hệ thống website
								</h3>
							</div>
							<div class="box-content nopadding">		
									<?php echo form_open('admincp/config/editweb', array('class' => 'form-horizontal form-bordered', 'id' => 'frmweb')) ;?>
									<div class="control-group">
										<label for="txtCharset" class="control-label">Charset</label>
										<div class="controls">
											<input type="text" name="txtCharset" id="txtCharset" placeholder="Charset" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtCharset', $charset); ?>">
										</div>
									</div>
									<div class="control-group">
										<label for="txtFavicon" class="control-label">Favicon</label>
										<div class="controls">
											<input type="text" name="txtFavicon" id="txtFavicon"  class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtFavicon', $favicon); ?>">
											<button type="button" id="btnFavicon" class="btn" >Chọn hình</button>	
											<a id="btnFav" style="display:none" href="#modal-2" role="button" class="btn" data-toggle="modal">Alert</a>
										</div>
									</div>
									<div class="control-group">
										<label for="txtLogo" class="control-label">Logo</label>
										<div class="controls">
											<input type="text" name="txtLogo" id="txtLogo"  class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtLogo', $logo); ?>">
											<button type="button" id="btnLogo" class="btn" >Chọn hình</button>	
											<a id="btnLog" style="display:none" href="#modal-3" role="button" class="btn" data-toggle="modal">Alert</a>
										</div>
									</div>
									<div class="control-group">
										<label for="txtItem" class="control-label">Số sản phẩm / trang</label>
										<div class="controls">
											<input type="text" name="txtItem" id="txtItem"  class="input-large" maxlength="255" value="<?php echo set_value('txtItem', $item); ?>">
										</div>
									</div>
									<div class="control-group">
										<label for="txtHotline" class="control-label">Hotline</label>
										<div class="controls">
											<input type="text" name="txtHotline" id="txtHotline"  class="input-large" maxlength="45" value="<?php echo set_value('txtHotline', $hotline); ?>">
										</div>
									</div>
									<div class="control-group">
										<label for="txtEmail" class="control-label">Email liên lạc</label>
										<div class="controls">
											<input type="text" name="txtEmail" id="txtEmail"  class="input-xlarge" maxlength="255" value="<?php echo set_value('txtEmail', $email); ?>">
										</div>
									</div>									
									<div class="control-group">
										<label for="txtSlogan" class="control-label">Slogan</label>
										<div class="controls">
											<textarea name="txtSlogan" id="txtSlogan" rows="5" class="input-block-level" placeholder="Slogan" maxlength="255"><?php echo set_value('txtSlogan', $slogan); ?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="txtFooter" class="control-label">Copyright</label>
										<div class="controls">
											<textarea name="txtFooter" id="txtFooter" rows="5"><?php echo set_value('txtFooter', $footer); ?></textarea>	
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" id="btnSave" class="btn btn-primary" >Lưu thông tin</button>
											<a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
									</div>
									<?php echo form_close(); ?>

																
								
							</div>
							<script type="text/javascript">

								CKEDITOR.replace("txtFooter");

								$(document).ready(function() {	
																
									$('#btnFavicon').click(function(){
										$('#btnFav').click();

									    var f = $('#modal-2 .modal-body').elfinder({
									        url : '<?php echo base_url(); ?>public/js/plugins/elfinder/php/connector.php?',
									        //height: 500,
									        //docked: false,
											//dialog: { width: 400, modal: true },
											//closeOnEditorCallback: true,
											getFileCallback: function(file) {
									           $('#txtFavicon').val(replaceurl(file.path));
									           $("#modal-2 button.btn").click();
									        }
									  	});
									});

									$('#btnLogo').click(function(){
										$("#btnLog").click();
									    var l = $('#modal-3 .modal-body').elfinder({
									        url : '<?php echo base_url(); ?>public/js/plugins/elfinder/php/connector.php',
									        //height: 500,
									        //docked: false,
											//dialog: { width: 400, modal: true },
											//closeOnEditorCallback: true,
											getFileCallback: function(file) {
									           $('#txtLogo').val(replaceurl(file.path));
									           $("#modal-3 button.btn").click();
									        }

									  });

									});

									//Form Seo Home
								  	$("form#frmweb").on('submit', function(){
								  		CKEDITOR.instances['txtFooter'].updateElement(); //Updates CKeditor before get value by ajax

									   var from = $(this);

									    $.ajax({
									        url: from.attr('action'),
									        type: from.attr('method'),
									        data: $(from).serialize(),
									        beforeSend : function (){
									        	$("#modal-4 .modal-body p").html('Đang tải...');
								                $("#btnAlert").click();
								            },
									        success: function(data) {
									            $("#modal-4 .modal-body p").html(data);
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

			