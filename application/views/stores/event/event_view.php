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
        <li> <a href="<?php echo base_url('stores/event'); ?>">Timeline sự kiện</a> </li>        
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="box box-color box-bordered">
          <div class="box-title">
            <h3> <i class="icon-picture"></i> <?php echo $titlepage; ?></h3>
          </div>
          <div class="box-content nopadding">
            <div class="highlight-toolbar">
              <div class="pull-left"><span><?php echo $num_result; ?> kết quả</span></div>
              <div class="pull-right">
                <div class="btn-toolbar">
                  <div class="btn-group">
                    <a href="<?php echo base_url('stores/event/table');?>" class="btn btn-danger" rel="tooltip" title="Danh sách sự kiện"><i class="icon-list"></i> Danh sách sự kiện</a>                       
                  </div>
                </div>
              </div>
            </div>
            <?php if($num_result > 0) { ?>
            <ul class="timeline">              
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
  var id = <?php echo $id_store; ?>;
  function loadtimeline(page)
  {
    $.ajax({
      url: "<?php echo base_url('stores/event/paggingtimeline'); ?>",
      type: "post",
      data: "id_store="+id+ "&page="+page,
      success: function(data){
        $('.timeline').append(data).fadeIn(1000);
      }
    });
  }
  var page  = 0;
  loadtimeline(page);
  var total = <?php echo $total_page; ?>;  
  $(window).scroll(function(){
    if($(window).scrollTop() == $(document).height() - $(window).height() )
    {
      if(page < total)
      {
        page++;
        loadtimeline(page);
      }       
    } 
  });
  
});
</script>
