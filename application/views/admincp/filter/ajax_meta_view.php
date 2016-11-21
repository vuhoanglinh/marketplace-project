<?php foreach($query as $row)
{
    ++$index; 
?>
<tr>
  <td class="with-checkbox"><input type="checkbox" name="check<?php echo $index; ?>" value="<?php $row->id;?>"></td>
  <td><?php echo $row->name;    ?></td>
  <td><?php echo $row->meta_value;       ?></td> 
  <td><a href="javascript:void(0)" action="status" dataid="<?php echo $row->id; ?>" data="<?php echo ($row->status == 0?'1':'0'); ?>"><?php echo ($row->status == 0?'<span class="label">Ẩn</span>': '<span class="label label-satgreen">Hiện</span>'); ?></a></td>                    
  <td class="hidden-480">
    <a href="javascript:void(0)" action="update" dataid="<?php echo $row->id; ?>" dataname="<?php echo $row->name; ?>" datavalue="<?php echo $row->meta_value; ?>" dataimg="<?php echo $row->image; ?>" datatype="<?php echo $row->type;?>" class="btn" rel="tooltip" title="Chỉnh sửa"><i class="icon-edit"></i></a>
    <a href="javascript:void(0)" action="del" dataid="<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Xóa"><i class="icon-remove"></i></a>                      
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
                    var value = a.attr('datavalue');
                    var image = a.attr('dataimg');
                    var type  = a.attr('datatype');

                    $('#hd_id').val(id);
                    $('#txtName').val(name);
                    $('#txtNameSub').val(value);
                    $('#txtLogo').val(image);
                    $("#slType option").each(function(){
                      if ($(this).val() == type) {
                          $(this).attr("selected",true);
                      } else {
                          $(this).removeAttr("selected");
                      }
                  });

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
                      $.ajax({
                          url: '<?php echo base_url(); ?>admincp/filter/deletemt',
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

                  if(a.attr("action") == "status")
                  {
                    $.ajax({
                      url : "<?php echo base_url(); ?>admincp/filter/statusmt",
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