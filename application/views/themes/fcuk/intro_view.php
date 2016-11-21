<!-- CONTENT: BEGIN -->
<div id="container">
  <ul id="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
    <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>"> <img src="<?php echo base_url('themes'); ?>/francosarto/images/home2.jpg" alt=""></a></li>
    <li>Giới thiệu</li>
  </ul>
  <div class="subpage">
    <div class="spacing">&nbsp;</div>
    <div class="fullpage_content">
      <div class="big_left_title">
        <h3 class="customfont white upper">Giới thiệu</h3>
        <div class="clearfloat"></div>
      </div>
      <div class="event_content">
        <div id="tab1" class="tab_content">
          <div id="ViewMerchantAbout">
            <h1 class="about_title customfont upper gray fltlft"> </h1>
            <ul class="detail_share fltlft" style="">
              <li><a onclick="window.open('http://www.facebook.com/share.php?u='+document.location,'_blank');" title="Đăng lên Facebook" style="cursor: pointer;"> <img src="<?php echo base_url('themes') ?>/francosarto/images/fb.png" width="16" height="16" alt=""> </a></li>
              <li><a title="Đăng lên Twitter" style="cursor: pointer;" onclick="window.open('http://twitter.com/home?status='+document.location,'_blank');"> <img src="<?php echo base_url('themes') ?>/francosarto/images/tw.png" width="16" height="16" alt=""></a></li>
            </ul>
            <div class="about_content">
             <?php echo $b_intro; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- CONTENT: END -->