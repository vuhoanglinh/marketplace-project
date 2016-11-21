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
        <li> <a href="<?php echo base_url();?>adminlevel">Trang chủ</a> <i class="icon-angle-right"></i> </li>        
        <li> <a href="<?php echo base_url('adminlevel/product'); ?>">Sản phẩm chưa xác thực</a> </li>        
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box">
          <div class="box-title">
            <h3> <i class="icon-picture"></i> <?php echo $titlepage; ?></h3>
          </div>
          <script> 
          $(document).ready(function(){ 
           
           $('#search').keypress(function(event){
              if(event.which == 13) {
                if($('#search').val() != ""){
                  //var key = replaceKeySearch($('#search').val().trim());
                  var key = $('#search').val().trim();
                  var url = '<?php echo base_url(); ?>adminlevel/product?key='+key;
                  $(location).attr('href',url);
                }
              }
           });

           $('#btnsearch').click(function(){
              if($('#search').val() != ""){
                //var key = replaceKeySearch($('#search').val().trim());
                var key = $('#search').val().trim();
                var url = '<?php echo base_url(); ?>adminlevel/product?key='+key;
                $(location).attr('href',url);
              }
           });

          }); 
          </script> 
          <div class="box-content nopadding">
            <div class="dataTables_wrapper">     
              <div class="dataTables_length">
                <label><span style="margin: 0px;"><a href="javascript:void(0)" id="btnsearch" class="btn btn-primary"><i class="icon-search"></i></a></span>
                  <input type="text" id="search" placeholder="Tìm kiếm...">
                </label>
              </div>         
              <div class="dataTables_filter"> <?php echo $num_result; ?> kết quả</div>
              <div style="clear:both;"></div>
            </div>
            <?php if($num_result > 0) { ?>
            <ul class="gallery">              
            </ul>      
            <?php } ?>      
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  resize();
  function loadthemes(page)
  {
    $.ajax({
      url: "<?php echo base_url('adminlevel/product/paggingnotative'); ?>",
      type: "post",
      data: "page="+page+"<?php echo ($key != "")? '&key='.$key : ''; ?>",
      success: function(data){
        $('.gallery').append(data).fadeIn(1000);
      }
    });
  }
  var page  = 0;
  loadthemes(page);
  var total = <?php echo $total_page; ?>;  
  $(window).scroll(function(){
    if($(window).scrollTop() == $(document).height() - $(window).height() )
    {
      if(page < total)
      {
        page++;
        loadthemes(page);
      }       
    } 
  });
  
});
</script>