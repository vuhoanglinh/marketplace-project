<?php foreach($query as $row)
{
    ++$index; 
?>
<tr>
  <td class="with-checkbox"><input type="checkbox" name="check<?php echo $index; ?>" value="<?php echo $row->id;?>"></td>
  <td><?php echo $row->name;    ?></td>
  <td><?php echo $row->title;       ?></td> 
  <td><a href="javascript:void(0)" action="status" dataid="<?php echo $row->id; ?>" data="<?php echo ($row->status == 0?'1':'0'); ?>"><?php echo ($row->status == 0?'<span class="label">Ẩn</span>': '<span class="label label-satgreen">Hiện</span>'); ?></a></td>
  <td><?php echo mdate($datestring, strtotime($row->date_added)); ?></td>                 
  <td><?php echo mdate($datestring, strtotime($row->last_modified)); ?></td>  
  <td class="hidden-480">
    <a href="javascript:void(0)" action="update" dataid="<?php echo $row->id; ?>" dataname="<?php echo $row->name; ?>" datatitle="<?php echo $row->title; ?>" class="btn" rel="tooltip"> <i class="icon-edit"></i></a>
    <a href="javascript:void(0)" action="del" dataid="<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Xóa"><i class="icon-remove"></i></a>
    <a href="<?php echo base_url('admincp/filter/meta'); ?>?id=<?php echo $row->id;?>" class="btn" rel="tooltip" title="Meta filter"><i class="icon-list-alt"></i></a>
  </td>
</tr>
<?php } //Close query result ?>
<script type="text/javascript">
$(document).ready(function(){
  $("form#frmtrash a").click(function(){
                  var a = $(this);  
                  if(a.attr("action") == "update")  
                  {

                    $("#txtName").parent().parent().removeClass("error success");
                    $("#txtName").parent().find('span').remove("span");
                    var id    = a.attr('dataid');
                    var name  = a.attr('dataname');
                    var title = a.attr('datatitle');

                    $('#hd_id').val(id);
                    $('#txtName').val(name);
                    $('#txtNameSub').val(title);

                    $('#span6').removeClass('red');
                    $('#span6').addClass('green');
                    var msg   = '<i class="icon-edit"></i><?php echo $titleupdate; ?>';
                    $('#span6 h3').html(msg);
                    $('body,html').animate({
                      scrollTop: 0
                    }, 800);
                  }           

                  if(a.attr("action") == "del")
                  {        
                    if(confirm('Bạn có chắc chắn muốn xóa không? \nThao tác này sẽ xóa dữ liệu vĩnh viễn.') == true) {             
                      $.ajax({
                          url: '<?php echo base_url(); ?>admincp/filter/delete',
                          type: "POST",
                          dataType: 'json',
                          data: "id="+a.attr('dataid'),
                          success: function(data) {
                            if(data.status == "1")
                            {
                              a.parent().parent().hide();
                              $(location).attr('href','');
                            }
                            
                          }                          
                      });  
                    }            
                  }

                  if(a.attr("action") == "status")
                  {
                    $.ajax({
                      url : "<?php echo base_url(); ?>admincp/filter/status",
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