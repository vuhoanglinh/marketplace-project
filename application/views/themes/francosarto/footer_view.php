<!-- FOOTER: BEGIN -->
<div class="footer full">
  <div class="width-960">
    <div class="ft-menu">
      <ul>
            <li><a href="<?php echo base_url(); ?>">Chọn.vn</a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>">Sản phẩm</a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/gioi-thieu"; ?>?rel=<?php echo $hr_rel;?>">Giới thiệu</a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/su-kien"; ?>?rel=<?php echo $hr_rel;?>">Sự kiện</a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/danh-gia"; ?>?rel=<?php echo $hr_rel;?>">Đánh giá</a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/lien-he"; ?>?rel=<?php echo $hr_rel;?>">Liên hệ</a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/he-thong"; ?>?rel=<?php echo $hr_rel;?>">Cửa hàng</a></li>
            <?php if($hr_website != "") { ?><li class="end"><a href="<?php echo $hr_website; ?>" id="ctl00_ctl00_BottomNavigator1_lnkWebsite" rel="nofollow" target="_blank">Website</a></li><?php } ?>
      </ul>
    </div>
    <div class="copyright">
      <p>Template Franco Sarto. GVHD: Dương Trọng Đính</p>
    </div>
  </div>
</div>
<!-- FOOTER: END -->
</body>
</html>