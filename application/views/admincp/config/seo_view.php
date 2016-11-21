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
							<a href="#">SEO</a>
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
									Cấu hình SEO
								</h3>
							</div>
							<div class="box-content nopadding">
								<ul class="tabs tabs-inline tabs-top">
									<li class='active'>
										<a href="#first11" data-toggle='tab'><i class="icon-home"></i> SEO Trang Chủ</a>
									</li>
									<li>
										<a href="#second22" data-toggle='tab'><i class="glyphicon-t-shirt"></i> SEO Module Sản Phẩm</a>
									</li>
									<li>
										<a href="#thirds3322" data-toggle='tab'><i class="glyphicon-notes"></i> SEO Module Tin Tức</a>
									</li>
									<li>
										<a href="#thirds33" data-toggle='tab'><i class="glyphicon-old_man"></i> SEO Module Đối Tác</a>
									</li>
								</ul>
								<div class="tab-content tab-content-inline tab-content-bottom">
									<div class="tab-pane active" id="first11">
										<?php echo form_open('admincp/config/editseohome', array('class' => 'form-horizontal form-bordered', 'id' => 'frmseo')) ;?>
										<div class="control-group">
											<label for="txtTitlePageHome" class="control-label">Tiêu đề trang</label>
											<div class="controls">
												<input type="text" name="txtTitlePageHome" id="txtTitlePageHome" placeholder="Tiêu đề trang" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtTitlePageHome', $titlehome); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="txtKeywordHome" class="control-label">Meta Keyword</label>
											<div class="controls">
												<textarea name="txtKeywordHome" id="txtKeywordHome" rows="5" class="input-block-level" placeholder="Meta Keyword" maxlength="255"><?php echo set_value('txtKeywordHome', $keywordhome); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="txtDescriptionHome" class="control-label">Meta Description</label>
											<div class="controls">
												<textarea name="txtDescriptionHome" id="txtDescriptionHome" rows="5" class="input-block-level" placeholder="Meta Description" maxlength="255"><?php echo set_value('txtDescriptionHome', $descriptionhome); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="txtExtentionHome" class="control-label">Meta Extention</label>
											<div class="controls">
												<textarea name="txtExtentionHome" id="txtExtentionHome" rows="5" class="input-block-level" placeholder="Meta Extention"><?php echo set_value('txtExtentionHome', $extentionhome); ?></textarea>
											</div>
										</div>
										<div class="form-actions">
											<button type="submit" id="btnSaveHome" class="btn btn-primary" >Lưu thông tin</button>
												<a id="btnAlertHome" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
										</div>
										<?php echo form_close(); ?>

									</div>
									<div class="tab-pane" id="second22">
										<?php echo form_open('admincp/config/editseoproduct', array('class' => 'form-horizontal form-bordered', 'id' => 'frmseoProduct')) ;?>
										<div class="control-group">
											<label for="txtTitlePageProduct" class="control-label">Tiêu đề trang</label>
											<div class="controls">
												<input type="text" name="txtTitlePageProduct" id="txtTitlePageProduct" placeholder="Tiêu đề trang" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtTitlePageProduct', $titleproduct); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="txtKeywordProduct" class="control-label">Meta Keyword</label>
											<div class="controls">
												<textarea name="txtKeywordProduct" id="txtKeywordProduct" rows="5" class="input-block-level" placeholder="Meta Keyword" maxlength="255"><?php echo set_value('txtKeywordProduct', $keywordproduct); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="txtDescriptionProduct" class="control-label">Meta Description</label>
											<div class="controls">
												<textarea name="txtDescriptionProduct" id="txtDescriptionProduct" rows="5" class="input-block-level" placeholder="Meta Description" maxlength="255"><?php echo set_value('txtDescriptionProduct', $descriptionproduct); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="txtExtentionProduct" class="control-label">Meta Extention</label>
											<div class="controls">
												<textarea name="txtExtentionProduct" id="txtExtentionProduct" rows="5" class="input-block-level" placeholder="Meta Extention"><?php echo set_value('txtExtentionProduct', $extentionproduct); ?></textarea>
											</div>
										</div>
										<div class="form-actions">
											<button type="submit" id="btnSaveProduct" class="btn btn-primary" >Lưu thông tin</button>
												<a id="btnAlertProduct" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
										</div>
										<?php echo form_close(); ?>									
									</div>
									<div class="tab-pane" id="thirds3322">
										<?php echo form_open('admincp/config/editseonews', array('class' => 'form-horizontal form-bordered', 'id' => 'frmseoNews')) ;?>
										<div class="control-group">
											<label for="txtTitlePageNews" class="control-label">Tiêu đề trang</label>
											<div class="controls">
												<input type="text" name="txtTitlePageNews" id="txtTitlePageNews" placeholder="Tiêu đề trang" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtTitlePageNews', $titlenews); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="txtKeywordNews" class="control-label">Meta Keyword</label>
											<div class="controls">
												<textarea name="txtKeywordNews" id="txtKeywordNews" rows="5" class="input-block-level" placeholder="Meta Keyword" maxlength="255"><?php echo set_value('txtKeywordNews', $keywordnews); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="txtDescriptionNews" class="control-label">Meta Description</label>
											<div class="controls">
												<textarea name="txtDescriptionNews" id="txtDescriptionNews" rows="5" class="input-block-level" placeholder="Meta Description" maxlength="255"><?php echo set_value('txtDescriptionNews', $descriptionnews); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="txtExtentionNews" class="control-label">Meta Extention</label>
											<div class="controls">
												<textarea name="txtExtentionNews" id="txtExtentionNews" rows="5" class="input-block-level" placeholder="Meta Extention"><?php echo set_value('txtExtentionNews', $extentionnews); ?></textarea>
											</div>
										</div>
										<div class="form-actions">
											<button type="submit" id="btnSaveNews" class="btn btn-primary" >Lưu thông tin</button>
												<a id="btnAlertNews" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
										</div>
										<?php echo form_close(); ?>									
									</div>
									<div class="tab-pane" id="thirds33">
										<?php echo form_open('admincp/config/editseopartner', array('class' => 'form-horizontal form-bordered', 'id' => 'frmseoPartner')) ;?>
										<div class="control-group">
											<label for="txtTitlePagePartner" class="control-label">Tiêu đề trang</label>
											<div class="controls">
												<input type="text" name="txtTitlePagePartner" id="txtTitlePagePartner" placeholder="Tiêu đề trang" class="input-xxlarge" maxlength="255" value="<?php echo set_value('txtTitlePagePartner', $titlepartner); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="txtKeywordPartner" class="control-label">Meta Keyword</label>
											<div class="controls">
												<textarea name="txtKeywordPartner" id="txtKeywordPartner" rows="5" class="input-block-level" placeholder="Meta Keyword" maxlength="255"><?php echo set_value('txtKeywordPartner', $keywordpartner); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="txtDescriptionPartner" class="control-label">Meta Description</label>
											<div class="controls">
												<textarea name="txtDescriptionPartner" id="txtDescriptionPartner" rows="5" class="input-block-level" placeholder="Meta Description" maxlength="255"><?php echo set_value('txtDescriptionPartner', $descriptionpartner); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="txtExtentionNews" class="control-label">Meta Extention</label>
											<div class="controls">
												<textarea name="txtExtentionPartner" id="txtExtentionPartner" rows="5" class="input-block-level" placeholder="Meta Extention"><?php echo set_value('txtExtentionPartner', $extentionpartner); ?></textarea>
											</div>
										</div>
										<div class="form-actions">
											<button type="submit" id="btnSavePartner" class="btn btn-primary" >Lưu thông tin</button>
												<a id="btnAlertPartner" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
										</div>
										<?php echo form_close(); ?>									
									</div>
								</div>
							</div>
							<script type="text/javascript">
								$(document).ready(function() {
									
									//Form Seo Home
								  	$("form#frmseo").on('submit', function(){
								  	   
									   var from = $(this);

									    $.ajax({
									        url: from.attr('action'),
									        type: from.attr('method'),
									        data: $(from).serialize(),
									        beforeSend : function (){
									        	$("#modal-4 .modal-body p").html('Đang tải...');
								                $("#btnAlertHome").click();
								            },
									        success: function(data) {
									            $("#modal-4 .modal-body p").html(data);
									        }
									    });

									    return false;

								  	});

								  	//Form Seo Product
								  	$("form#frmseoProduct").on('submit', function(){

									   var from = $(this);

									    $.ajax({
									        url: from.attr('action'),
									        type: from.attr('method'),
									        data: $(from).serialize(),
									        beforeSend : function (){
									        	$("#modal-4 .modal-body p").html('Đang tải...');
								                $("#btnAlertProduct").click();
								            },
									        success: function(data) {
									            $("#modal-4 .modal-body p").html(data);									            
									        }
									    });

									    return false;

								  	});

								  	//Form Seo News
								  	$("form#frmseoNews").on('submit', function(){

									   var from = $(this);

									    $.ajax({
									        url: from.attr('action'),
									        type: from.attr('method'),
									        data: $(from).serialize(),
									        beforeSend : function (){
									        	$("#modal-4 .modal-body p").html('Đang tải...');
								                $("#btnAlertNews").click();
								            },
									        success: function(data) {
									            $("#modal-4 .modal-body p").html(data);
									        }
									    });

									    return false;

								  	});

								  	//Form Seo Partner
								  	$("form#frmseoPartner").on('submit', function(){

									   var from = $(this);

									    $.ajax({
									        url: from.attr('action'),
									        type: from.attr('method'),
									        data: $(from).serialize(),
									        beforeSend : function (){
									        	$("#modal-4 .modal-body p").html('Đang tải...');
								                $("#btnAlertPartner").click();
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