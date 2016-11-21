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
        <li> <a href="<?php echo base_url();?>stores">Trang chủ</a> <i class="icon-angle-right"></i> </li>
        <li> <a href="<?php echo base_url();?>stores/product">Sản phẩm</a> <i class="icon-angle-right"></i></li>        
        <li> <a href="<?php echo base_url();?>stores/product?idct=<?php echo $idct; ?>"><?php echo $namect; ?></a> <i class="icon-angle-right"></i> </li>     
        <li> <a href="<?php echo base_url();?>stores/product/images?id=<?php echo $id; ?>"><?php echo $name; ?></a> <i class="icon-angle-right"></i> </li>
        <li> <a href="<?php echo base_url();?>stores/product/addimages?id=<?php echo $id; ?>">Thêm thuộc tính</a></li>
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span6">
        <div id="span6" class="box box-color box-bordered red">
          <div class="box-title">
            <h3>
                <i class="icon-plus-sign"></i>
                <?php echo $titleattr; ?>
            </h3>
          </div>
          <div class="box-content nopadding"> 
            <?php echo form_open('stores/product/addattr', array('id' => 'frm', 'class' => 'form-horizontal form-bordered', 'novalidate' => 'novalidate')); ?>
            <div class="control-group">
              <label for="txtName" class="control-label">Tên thuộc tính</label>
                <div class="controls">
                  <input type="text" name="txtName" id="txtName" placeholder="Tên thuộc tính (*)" class="input-large" maxlength="255" value="<?php echo set_value('txtName', ''); ?>">                  
                </div>                
            </div>    
            <div class="control-group">
              <label for="slType" class="control-label">Kiểu</label>
                <div class="controls">
                  <select name="slType" id="slType" class="input-large">                
                    <option value="0">Size</option>
                    <option value="1">Màu sắc</option>
                  </select>
                </div>
            </div>
            <div class="control-group" style="display:none;">
              <label for="txtImages" class="control-label">Hình ảnh</label>
              <div class="controls">
                <input type="text" name="txtImages" id="txtImages" placeholder="Đường dẫn hình ảnh" class="input-large" maxlength="255" value="<?php echo set_value('txtImages', ''); ?>">                  
                <button type="button" id="btnImages" class="btn" >Chọn hình</button>
              </div>
            </div> 
            <div class="form-actions">
              <input type="hidden"  name="hd_id"  id="hd_id" value="0">
              <input type="hidden" name="hd_id_product" id="hd_id_product" value="<?php echo $id; ?>">
              <button type="submit" id="btnSave" class="btn btn-primary" >Cập nhật</button>
              <button type="reset" id="btnCancel" class="btn" >Hủy bỏ</button>
              <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
            </div>
            <?php echo form_close(); ?>
            <script type="text/javascript">            
            $(document).ready(function(){ 
              
              $("#slType").change(function(){
                var value   =   $("#slType").val();

                if(value == 1)
                {
                  $("#txtImages").parent().parent().removeAttr("style");
                }
                else
                {
                  $("#txtImages").parent().parent().css("display","none");
                }
              });

              $('#btnCancel').click(function(){
                if($('#hd_id').val() != 0) {
                  $(location).attr('href','');
                }
              });

              function SetFileField(fileUrl) {
                    jQuery('#txtImages').val(fileUrl);
              } 
              $("#btnImages").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField;
                    finder.popup();
              }); 

              $('form#frm').on('submit', function(){
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
    <div class="row-fluid">
      <div class="span6">
        <div class="box box-color box-bordered">
          <div class="box-title">
            <h3> <i class="icon-table"></i> <?php echo $titlesize; ?></h3>
          </div>
          <div class="box-content nopadding">
            <div class="dataTables_wrapper">              
              <div style="clear:both;"></div>
              <table class="table table-hover table-nomargin table-bordered">
                <thead>
                  <tr>                   
                    <th>Size</th>
                    <th>Trang thái</th>
                    <th>Ngày tạo lập</th>
                    <th>Ngày cập nhật</th>
                    <th class="hidden-480">Tùy chỉnh</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($size as $row)
                  {
                        ++$index; 
                  ?>
                  <tr>
                    <td><?php echo $row->name;    ?></td>              
                    <td><a class="status" href="javascript:void(0)" action="status" dataid="<?php echo $row->id; ?>" data="<?php echo ($row->status == 0?'1':'0'); ?>"><?php echo ($row->status == 0?'<span class="label">Ẩn</span>': '<span class="label label-satgreen">Hiện</span>'); ?></a></td>
                    <td><?php echo mdate($datestring, strtotime($row->date_added)); ?></td>                 
                    <td><?php echo mdate($datestring, strtotime($row->last_modified)); ?></td>  
                    <td class="hidden-480">
                      <a href="javascript:void(0)" action="updatesize" dataid="<?php echo $row->id; ?>" dataname="<?php echo $row->name; ?>" class="btn" rel="tooltip" title="Chỉnh sửa"><i class="icon-edit"></i></a>
                      <a href="javascript:void(0)" action="del" dataid="<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Xóa"><i class="icon-remove"></i></a>                      
                    </td>
                  </tr>
                  <?php } //Close query result ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="span6">
        <div class="box box-color box-bordered">
          <div class="box-title">
            <h3> <i class="icon-table"></i> <?php echo $titlecolor; ?></h3>
          </div>
          <div class="box-content nopadding">
            <div class="dataTables_wrapper">              
              <div style="clear:both;"></div>
              <table class="table table-hover table-nomargin table-bordered">
                <thead>
                  <tr>      
                    <th>Tên</th>              
                    <th>Màu sắc</th>
                    <th>Trang thái</th>
                    <th>Ngày tạo lập</th>
                    <th>Ngày cập nhật</th>
                    <th class="hidden-480">Tùy chỉnh</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($color as $row)
                  {
                        ++$index; 
                  ?>
                  <tr>
                    <td><?php echo $row->name;    ?></td>
                    <td><img src="<?php echo $row->image; ?>"></td>               
                    <td><a class="status" href="javascript:void(0)" action="status" dataid="<?php echo $row->id; ?>" data="<?php echo ($row->status == 0?'1':'0'); ?>"><?php echo ($row->status == 0?'<span class="label">Ẩn</span>': '<span class="label label-satgreen">Hiện</span>'); ?></a></td>
                    <td><?php echo mdate($datestring, strtotime($row->date_added)); ?></td>                 
                    <td><?php echo mdate($datestring, strtotime($row->last_modified)); ?></td>  
                    <td class="hidden-480">
                      <a href="javascript:void(0)" action="updatecolor" dataid="<?php echo $row->id; ?>" dataname="<?php echo $row->name; ?>" datacolor="<?php echo $row->image; ?>" class="btn" rel="tooltip" title="Chỉnh sửa"><i class="icon-edit"></i></a>
                      <a href="javascript:void(0)" action="del" dataid="<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Xóa"><i class="icon-remove"></i></a>                      
                    </td>
                  </tr>
                  <?php } //Close query result ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function(){
                $("a[action=status]").click(function(){
                  var a = $(this);                    
                    $.ajax({
                      url : "<?php echo base_url(); ?>stores/product/statusattr",
                      type : "POST",
                      dataType : "json",
                      data: {status : a.attr('data'), id : a.attr('dataid')},
                      success : function(data){
                        if(data.info == 1)
                        {
                          if(data.status == 0)
                          {
                            a.children().removeClass('label-satgreen');
                            a.children().html('Ẩn');
                            a.attr('data','1');  
                          }
                          else
                          {
                            a.children().addClass('label-satgreen');
                            a.children().html('Hiện');
                            a.attr('data','0');
                          }
                        }
                      }
                    });                                   
                });
            
            $("a[action=updatesize]").click(function(){
              var a = $(this);

              var id    = a.attr('dataid');
              var size  = a.attr('dataname');
              var type  = 0;
              $('#hd_id').val(id);
              $("#txtName").val(size);
              $("#slType option").each(function(){
                      if ($(this).val() == type) {
                          $(this).attr("selected",true);
                      } else {
                          $(this).removeAttr("selected");
                      }
                $("#slType").change();
              });

                    $('#span6').removeClass('red');
                    $('#span6').addClass('green');
                    var msg   = '<i class="icon-edit"></i><?php echo $titleattr1; ?>';
                    $('#span6 h3').html(msg);
                    $('body,html').animate({
                      scrollTop: 0
                    }, 800);

            });

            $("a[action=updatecolor]").click(function(){
              var a = $(this);

              var id    = a.attr('dataid');
              var size  = a.attr('dataname');
              var image = a.attr('datacolor');
              var type  = 1;
              $('#hd_id').val(id);
              $("#txtName").val(size);
              $('#txtImages').val(image);
              $("#slType option").each(function(){
                      if ($(this).val() == type) {
                          $(this).attr("selected",true);
                      } else {
                          $(this).removeAttr("selected");
                      }
                $("#slType").change();
              });

                    $('#span6').removeClass('red');
                    $('#span6').addClass('green');
                    var msg   = '<i class="icon-edit"></i><?php echo $titleattr2; ?>';
                    $('#span6 h3').html(msg);
                    $('body,html').animate({
                      scrollTop: 0
                    }, 800);

            });

            $("a[action=del]").click(function(){
              var a = $(this);  
                    if(confirm('Bạn có chắc chắn muốn xóa không? \nThao tác này sẽ xóa dữ liệu vĩnh viễn.') == true) {
                      $.ajax({
                          url: '<?php echo base_url(); ?>stores/product/deleteattr',
                          type: "POST",
                          dataType: 'json',
                          data: "id="+a.attr('dataid'),
                          success: function(data) {
                            if(data.status == "1")
                            {
                              a.parent().parent().hide();
                            }
                            
                          }                          
                      });
                    }  
            });
          });
        </script>
    </div>
  </div>
</div>