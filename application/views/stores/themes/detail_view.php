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
        <li> <a href="<?php echo base_url();?>admincp">Trang chủ</a> <i class="icon-angle-right"></i> </li>        
        <li> <a href="<?php echo base_url('stores/themes'); ?>">Thư viện template</a> <i class="icon-angle-right"></i> </li>
        <li> <a href=""><?php echo $titlepage; ?></a>  </li>
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box">
          <div class="box-title">
            <h3> <i class="icon-picture"></i> <?php echo $titlepage; ?></h3>
          </div>
          <?php foreach ($query as $row) {
            ?> 
          <div class="box-content nopadding">     
            <style type="text/css">            
            .img {
              width: 200px !important;
              height: 305px !important;
            }

            </style> 
             
            <div class="highlight-toolbar">
              <div class="pull-left"><div class="btn-toolbar">
                  <div class="btn-group">
                    <?php if($boolsamplethemes == 0) {?>
                    <a href="javascript:void(0)" id="set" relurl="<?php echo base_url('stores/themes/setthemes') ?>" relid="<?php echo $id_store; ?>" relthemes="<?php echo $row->folder; ?>" class="btn btn-danger" rel="tooltip" title="Cài đặt"><i class="icon-cog"></i> Cài đặt</a>                    
                    <script type="text/javascript">
                    $(document).ready(function(){
                      $("#set").click(function(){
                        var a = $(this);
                        $.ajax({
                          url : $(this).attr('relurl'),
                          type : "post",
                          dataType : "json",
                          data: {id_store : $(this).attr('relid') , themes: $(this).attr('relthemes')},
                          success : function(data){
                            if(data.status == 0) {
                             $(location).attr('href', "");
                            }
                          }
                        });
                      });                      
                    });
                    </script>
                    <?php } else { ?>
                    <a href="javascript:void(0)" class="btn btn-inverse" rel="tooltip" title="Đang dùng">Đang dùng</a>
                    <?php
                    }
                    ?>                    
                  </div>
                  <div class="btn-group">
                    <a href="<?php echo base_url('cua-hang')."/".$name_store."/trang-chu"; ?>?rel=<?php echo $id_store;?>" class="btn btn-success" rel="tooltip" title="Xem cửa hàng"><i class="icon-shopping-cart"></i> Xem cửa hàng</a>
                  </div>
                </div>
              </div>
              <div class="pull-right"> <h5>Số cửa hàng đang sử dụng template: <?php echo $num_result; ?></h5>             
              </div>
            </div>   
            <ul class="gallery gallery-dynamic">              
              <li> <a href="#"> <img class="img" width="200" height="305" src="<?php echo ($row->image1 != "") ? $row->image1 : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';; ?>" alt=""> </a>
                <div class="extras" <?php echo ($row->status == 0) ? 'style="display:block;"' : ''; ?>>
                  <div class="extras-inner"> <a href="<?php echo $row->image1; ?>" class='colorbox-image' rel="group-1"><i class="icon-search"></i></a> </div>
                </div>
              </li>
              <li> <a href="#"> <img class="img" width="200" height="305" src="<?php echo ($row->image2 != "") ? $row->image2 : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';; ?>" alt=""> </a>
                <div class="extras" <?php echo ($row->status == 0) ? 'style="display:block;"' : ''; ?>>
                  <div class="extras-inner"> <a href="<?php echo $row->image2; ?>" class='colorbox-image' rel="group-1"><i class="icon-search"></i></a> </div>
                </div>
              </li>
              <li> <a href="#"> <img class="img" width="200" height="305" src="<?php echo ($row->image3 != "") ? $row->image3 : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';; ?>" alt=""> </a>
                <div class="extras" <?php echo ($row->status == 0) ? 'style="display:block;"' : ''; ?>>
                  <div class="extras-inner"> <a href="<?php echo $row->image3; ?>" class='colorbox-image' rel="group-1"><i class="icon-search"></i></a> </div>
                </div>
              </li>
              <li> <a href="#"> <img class="img" width="200" height="305" src="<?php echo ($row->image4 != "") ? $row->image4 : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';; ?>" alt=""> </a>
                <div class="extras" <?php echo ($row->status == 0) ? 'style="display:block;"' : ''; ?>>
                  <div class="extras-inner"> <a href="<?php echo $row->image4; ?>" class='colorbox-image' rel="group-1"><i class="icon-search"></i></a> </div>
                </div>
              </li>              
            </ul>  


            <script type="text/javascript">
            $(document).ready(function(){
              resize();
            });              
            </script>            
          </div>
          <div class="box-content">
            <?php echo $row->detail; ?> 
          </div>
          <?php 
                break;                
              }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
