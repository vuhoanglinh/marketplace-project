<!-- CONTENT: BEGIN -->

<div id="container">
  <ul id="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
    <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>"> <img src="<?php echo base_url('themes') ?>/francosarto/images/home2.jpg" alt=""></a></li>
    <li>Hệ thống</li>
  </ul>
  <script src="<?php echo base_url('themes') ?>/merchant1/js/jquery.mCustomScrollbar.js" type="application/javascript"></script>
  <div class="subpage">
    <div class="spacing">&nbsp;</div>
    <div class="fullpage_content">
      <div class="big_left_title">
        <h3 class="customfont white upper">Hệ thống cửa hàng</h3>
        <div class="clearfloat"></div>
      </div>
      <div class="event_content">
        <div id="ContactAddress">
          <h1 class="about_title customfont upper gray fltlft" style="width: 800px"> </h1>
          <div class="spacing"> </div>
          <div class="about_content">
            <div id="map" class="fltlft">
              <iframe id="frameGoogleMap" src="<?php echo base_url('themes') ?>/map2.html?longitude=<?php foreach ($b_liststore as $row) { echo ($row->latitude != 0)? $row->latitude.";" : ''; }  ?>&amp;latitude=<?php foreach ($b_liststore as $row) { echo ($row->longitude != 0) ? $row->longitude.";" : '';}  ?>"" width="556" height="377" frameborder="0"></iframe>
            </div>
            <div class="store_system fltlft">
              <div class="small" id="address">
                <div class="scustomScrollBox">
                  <div class="scontainer">
                    <div class="scontent">
                      <h2 class="customfont red1"> Danh sách cửa hàng</h2>
                      <div id="liststore"> <span id="AllMerchantOfCity"></span>
                        <?php 
                          foreach ($b_liststore as $row) {      
                          $b_index++;                          
                        ?>
                        <div class="content_1" style="cursor: pointer;" onclick="javascript:Store_Click('<?php echo $row->latitude; ?>' , '<?php echo $row->longitude; ?>')">
                          <?php if($row->name != "") { ?>
                          <p class="title_merchantname gray"><span class="store_id"><?php echo $b_index; ?></span><strong><?php echo $row->name; ?></strong></p>
                          <?php } ?>
                          <?php if($row->address != "") { ?>
                          <p class="icon_address"> <strong>Địa chỉ:</strong> <?php echo $row->address; ?> </p>
                          <?php } ?>
                          <?php if($row->phone != "") { ?>
                          <p class="icon_tele"> Điện thoại: <?php echo $row->phone; ?> </p>
                          <?php } ?>
                          <?php if($row->fax != "") { ?>
                          <p class="icon_fax"> Fax: <?php echo $row->fax; ?></p>
                          <?php } ?>
                          </div>
                        <?php }?>
                      </div>
                    </div>
                  </div>
                  <div class="dragger_container">
                    <div class="dragger"> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>  

   
       function Store_Click(x, y) {
           $('#frameGoogleMap').attr("src", "<?php echo base_url('themes') ?>/map2.html?longitude=" + x.toString().replace(',', '.') + "&latitude=" + y.toString().replace(',', '.'));
       }       
      //store
       $("#address").mCustomScrollbar("vertical", 10, "easeOutQuad", 1.05, "fixed", "yes", "yes", 10);

       //end store
       

    $(document).ready(function() {
      //store
       $("#address").mCustomScrollbar("vertical", 10, "easeOutQuad", 1.05, "fixed", "yes", "yes", 10);

       //end store
  });
</script> 
<!-- CONTENT: END --> 
