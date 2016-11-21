<!-- CONTENT: BEGIN -->
<div id="container">
  <ul id="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
    <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>"> <img src="<?php echo base_url('themes'); ?>/francosarto/images/home2.jpg" alt=""></a></li>
    <li>Sự kiện</li>
  </ul>
  <div class="subpage">
    <div class="spacing">&nbsp;</div>
    <div class="fullpage_content">
      <div class="big_left_title">
        <h3 class="customfont white upper">TIN TỨC & SỰ KIỆN</h3>
        <div class="clearfloat"></div>
      </div>
      <div id="content_detail" class="event_content">
        
    </div>
  </div>
</div>
<!-- CONTENT: END --> 
          <script type="text/javascript">
            var url = document.URL;
            $(document).ready(function(){
              function loadingevent(page,group) {
                $.ajax({
                      url: "<?php echo base_url('stores/merchant/paggingevent'); ?>",
                      type: "post",
                      data: "rel=<?php echo $id_store; ?>"+"&page="+page+"&n="+group+"&url="+url,
                      success: function(data){
                        $('#content_detail').html(data);                        
                      }
                });
              }
              var page = <?php echo $page; ?>;
              var grouppage = <?php echo $grouppage; ?>;
              loadingevent(page,grouppage);
            });
            </script>          