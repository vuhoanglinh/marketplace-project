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
        <li> <a href="<?php echo base_url();?>stores/product/images?id=<?php echo $id; ?>"><?php echo $name; ?></a> </li>         
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box">
          <div class="box-title">
            <h3> <i class="icon-picture"></i> <?php echo $titlepage; ?></h3>
          </div>
          <div class="box-content nopadding">
            <div class="highlight-toolbar">
              <div class="pull-left"><span><?php echo $num_result; ?> kết quả</span></div>
              <div class="pull-right">
                <div class="btn-toolbar">
                  <div class="btn-group">
                    <a href="<?php echo base_url('stores/product/addimage');?>?id=<?php echo $id; ?>" class="btn btn-danger" rel="tooltip" title="Upload hình ảnh"><i class="icon-cloud-upload"></i> Upload hình ảnh</a>                 
                  </div>
                </div>
              </div>
            </div>
            <?php if($num_result > 0) { ?>
            <ul class="gallery gallery-dynamic">
              <?php foreach ($query as $row) {
              ?>
              <li> <a href="#"> <img src="<?php echo ($row->image != "") ? $row->image : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';; ?>" alt="" width="200"> </a>
                <div class="extras" <?php echo ($row->status == 0) ? 'style="display:block;"' : ''; ?>>
                  <div class="extras-inner"> <a href="<?php echo $row->image; ?>" class='colorbox-image' rel="group-1"><i class="icon-search"></i></a> <a href="<?php echo base_url('stores/product/updateimage'); ?>?id=<?php echo $row->id; ?>"><i class="icon-pencil"></i></a> <a href="javascript:void(0)" dataid="<?php echo $row->id; ?>" data="<?php echo ($row->status == 0?'1':'0'); ?>" class='update-gallery-pic'><i class="<?php echo ($row->status == 1) ?  'icon-eye-open' : 'icon-eye-close'; ?>"></i></a> <a href="#" class='del-gallery-pic' dataid="<?php echo $row->id; ?>"><i class="icon-trash"></i></a> </div>
                </div>
              </li>
              <?php }?>
            </ul>
            <script type="text/javascript">
              $(document).ready(function(){
                resize();
                $("a.update-gallery-pic").click(function(e){ 
                  e.preventDefault();
                  var a = $(this);
                  $.ajax({
                      url : "<?php echo base_url(); ?>stores/product/statusim",
                      type : "POST",
                      dataType : "json",
                      data: {status : a.attr('data'), id : a.attr('dataid')},
                      success : function(data){
                        if(data.info == 1)
                        {
                          if(data.status == 0)
                          {
                            a.parent().parent().css({'display' : 'block'});                              
                            a.children().removeClass('icon-eye-open');
                            a.children().addClass('icon-eye-close');   
                            a.attr('data','1');  
                          }
                          else
                          {                                    
                            a.parent().parent().removeAttr('style');                           
                            a.children().addClass('icon-eye-open');
                            a.children().removeClass('icon-eye-close');                
                            a.attr('data','0');
                          }
                        }
                      }
                    });
                });

                $("a.del-gallery-pic").click(function(e){
                  if(confirm('Bạn có chắc chắn muốn xóa không? \nThao tác này sẽ xóa dữ liệu vĩnh viễn.') == true) {
                    e.preventDefault();
                    var a = $(this);
                    $.ajax({
                        url : "<?php echo base_url(); ?>stores/product/deleteim",
                        type : "POST",
                        dataType : "json",
                        data: {id : a.attr('dataid')},
                        success : function(data){
                          if(data.info == 1)
                          {
                              a.parents("li").fadeOut(400, function(){
                                a.parents("li").remove();
                              });                                                    
                          }
                        }
                      }); 
                  }                   
                });
              });
            </script>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>