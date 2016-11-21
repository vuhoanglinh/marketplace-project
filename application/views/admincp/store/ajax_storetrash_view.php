                  <?php foreach($query as $row)
                  {
                        ++$index; 
                  ?>
                  <tr>
                  	<td class="with-checkbox"><input type="checkbox" name="check<?php echo $index; ?>" value="<?php echo $row->id;?>"></td>                	  
                	  <td><?php echo $row->code;       ?></td>
                    <td><?php echo $row->name; 	   	?></td> 
                    <td><?php echo $row->username;      ?></td> 
                    <td style="background: #eee;"><img src="<?php echo base_url("public/".$row->logohome); ?>" title="" alt="" width="100"></td>
                    <td><a href="javascript:void(0)" action="status" dataid="<?php echo $row->id; ?>" data="<?php echo ($row->status == 0?'1':'0'); ?>"><?php echo ($row->status == 0?'<span class="label">Ẩn</span>': '<span class="label label-satgreen">Hiện</span>'); ?></a></td>
                    <td><?php echo mdate($datestring, strtotime($row->date_added)); ?></td>
                    <td><?php echo mdate($datestring, strtotime($row->last_modified)); ?></td>  	
                    <td class="hidden-480">
                      <!--<a href="javascript:void(0)" action="update" dataid="<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Chỉnh sửa"><i class="icon-edit"></i></a> -->
                      <a href="javascript:void(0)" action="del" dataid="<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Xóa"><i class="icon-remove"></i></a>
                    </td>
                  </tr>
                  <?php } //Close query result ?>
                  <script type="text/javascript">
                  $(document).ready(function(){
                    $("form#frmtrash a").click(function(){
                      var a = $(this);  
                      /*
                      if(a.attr("action") == "update")  
                      {
                        var url = '<?php echo base_url(); ?>admincp/store/update?id='+a.attr('dataid');
                        $(location).attr('href',url);
                      }       
                      */         
                      if(a.attr("action") == "del")
                      {  
                        if(confirm('Bạn có chắc chắn muốn xóa không? \nThao tác này sẽ xóa dữ liệu vĩnh viễn.') == true) {                
                          $.ajax({
                              url: '<?php echo base_url(); ?>admincp/store/delete',
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
                          url : "<?php echo base_url(); ?>admincp/store/status",
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
                      }                  
                    });
                  });
                  </script>