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
        <li> <a href="more-files.html">Users</a></i> </li>
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box box-color box-bordered">
          <div class="box-title">
            <h3> <i class="icon-table"></i> <?php echo $titlepage; ?></h3>
          </div>
          <script> 
          $(document).ready(function(){ 

           $("#check_all").click(function() 
            { 
             var checked_status = this.checked; 
             $("input[type=checkbox]").each(function() 
             { 
                this.checked = checked_status; 
             }); 
            }); 


           //Search menu
           $('#search').keypress(function(event){
              if(event.which == 13) {
                if($('#search').val() != ""){
                  var url = '<?php echo base_url(); ?>admincp/email/trash?key='+$('#search').val().trim();
                  $(location).attr('href',url);
                }
              }
           });

           $('#btnsearch').click(function(){
              if($('#search').val() != ""){
                var url = '<?php echo base_url(); ?>admincp/email/trash?key='+$('#search').val().trim();
                $(location).attr('href',url);
              }
           });

          }); 
          </script>
          <div class="box-content nopadding"><?php echo form_open("admincp/email/deleteall", array('id' => 'frmtrash', 'name' => 'frmtrash'));?>
            <div class="dataTables_wrapper">
              <div class="dataTables_length">
                <label><span style="margin: 0px;"><a href="javascript:void(0)" id="btnsearch" class="btn btn-primary"><i class="icon-search"></i></a></span>
                  <input type="text" id="search" placeholder="Tìm kiếm...">
                </label>
              </div>
              <div class="dataTables_filter"></div>
              <div style="clear:both;"></div>
              <table class="table table-hover table-nomargin table-bordered">
                <thead>
                  <tr>
                    <th class='with-checkbox'><input type="checkbox" name="check_all" id="check_all"></th> 
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Smtp Server</th>
                    <th>Trạng thái</th>                      
                    <th>Ngày tạo lập</th>
                    <th>Ngày cập nhật</th>
                    <th class="hidden-480">Tùy chỉnh</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($query as $row)
                  {
                        ++$index; 
                  ?>
                  <tr>
                  	<td class="with-checkbox"><input type="checkbox" name="check<?php echo $index; ?>" value="<?php echo $row->id;?>"></td>                	  
                	  <td><?php echo $row->name; 	   	?></td>
                	  <td><?php echo $row->email;   ?></td>
                	  <td><?php echo $row->pass; 	?></td>                	
                	  <td><?php echo $row->smtp_server;  	?></td>               	
                    <td><a href="javascript:void(0)" action="status" dataid="<?php echo $row->id; ?>" data="<?php echo ($row->status == 0?'1':'0'); ?>"><?php echo ($row->status == 0?'<span class="label">Khóa</span>': '<span class="label label-satgreen">Mở</span>'); ?></a></td>
                  	<td><?php echo mdate($datestring, strtotime($row->date_added)); ?></td>                 
                    <td><?php echo mdate($datestring, strtotime($row->last_modified)); ?></td>  
                    <td class="hidden-480">
                      <!--<a href="javascript:void(0)" action="update" dataid="<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Chỉnh sửa"><i class="icon-edit"></i></a> -->
                      <a href="javascript:void(0)" action="del" dataid="<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Xóa"><i class="icon-remove"></i></a>
                    </td>
                  </tr>
                  <?php } //Close query result ?>
                </tbody>
              </table>
              <div class="dataTables_length">                      
                <input type="hidden" id="hd_count" name="hd_count" value="<?php echo $index; ?>">
                <button type="button" id="btn_outtrash" name="btn_outtrash" class="btn btn-green">
                  <i class="icon-reply"></i> Phục hồi
                </button> 
                <button type="submit" id="btn_delselect" name="btn_delselect" class="btn btn-inverse" onClick="return confirm('Bạn có chắc chắn muốn xóa không? \nThao tác này sẽ xóa dữ liệu vĩnh viễn.');">
                  <i class="icon-trash"></i> Xóa chọn
                </button>  
                <a id="btnAlert" style="display:none" href="#modal-4" role="button" class="btn" data-toggle="modal">Alert</a>
                </div>              
                <div class="table-pagination"> <a href="#" class='disabled'>First</a> <a href="#" class='disabled'>Previous</a> <span> <a href="#" class='active'>1</a> <a href="#">2</a> <a href="#">3</a> </span> <a href="#">Next</a> <a href="#">Last</a> </div>
            </div>
            <?php echo form_close() ?>
            <script type="text/javascript">              
              
              $(document).ready(function(){

                $("form#frmtrash a").click(function(){
                  var a = $(this);  
                  //if(a.attr("action") == "update")  
                  //{
                  //  var url = '<?php echo base_url(); ?>admincp/email/update?id='+a.attr('dataid');
                  //  $(location).attr('href',url);
                  //}                
                  if(a.attr("action") == "del")
                  {     
                      if(confirm('Bạn có chắc chắn muốn xóa không? \nThao tác này sẽ xóa dữ liệu vĩnh viễn.') == true) {               
                        $.ajax({
                            url: '<?php echo base_url(); ?>admincp/email/delete',
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
                  }

                  if(a.attr("action") == "status")
                  {
                    $.ajax({
                      url : "<?php echo base_url(); ?>admincp/email/status",
                      type : "POST",
                      dataType : "json",
                      data: {status : a.attr('data'), id : a.attr('dataid')},
                      success : function(data){
                        if(data.info == 1)
                        {
                          if(data.status == 0)
                          {
                            a.children().removeClass('label-satgreen');
                            a.children().html('Khóa');
                            a.attr('data','1');  
                          }
                          else
                          {
                            a.children().addClass('label-satgreen');
                            a.children().html('Mở');
                            a.attr('data','0');
                          }
                        }
                      }
                    });
                  }                  
                });
                
              	$("form#frmtrash").on('submit', function(){
                    $("input[type=checkbox]").each(function() 
                    { 
                      if($(this).attr("id") != "check_all") 
                      {
                        if($(this).is(":checked"))
                        {
                          $(this).parent().parent().hide();
                        } 
                      }                                      
                      
                   }); 
                      
                      var from = $(this);

                      $.ajax({
                          url: from.attr('action'),
                          type: from.attr('method'),
                          data: $(from).serialize(),
                          beforeSend : function (){
                            //$("#modal-4 .modal-body p").html('Đang tải...');
                                //$("#btnAlert").click();
                            },
                          success: function(data) {
                              //$("#modal-4 .modal-body p").html(data);
                          }
                      });    

                  return false;
                });
                $("#btn_outtrash").on('click', function(){
                    $("input[type=checkbox]").each(function() 
                    { 
                      if($(this).attr("id") != "check_all") 
                      {
                        if($(this).is(":checked"))
                        {
                          $(this).parent().parent().hide();
                        } 
                      }                                      
                      
                   }); 
                    var from = $("form#frmtrash");

                      $.ajax({
                          url: "<?php echo base_url(); ?>admincp/email/outtrash",
                          type: "POST",
                          data: $(from).serialize(),
                          beforeSend : function (){
                            $("#modal-4 .modal-body p").html('Đang tải...');
                              $("#btnAlert").click();
                            },
                          success: function(data) {
                              $("#modal-4 .modal-body p").html(data);
                          }
                      });    
                  
                });
                
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>