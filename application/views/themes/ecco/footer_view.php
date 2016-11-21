<!-- BEGIN: FOOTER -->
  <div id="ch_footer">
    <div id="ch_footer_wapper">
      <div class="sub_foot">
        <div class="lt_foot">
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
        <div class="rt_foot"> <span>Template Ecco. GVHD: Dương Trọng Đính</span>
          <div class="facebook"><a title="Đăng lên Facebook" onclick="window.open('http://www.facebook.com/share.php?u='+document.location,'_blank');" style="cursor: pointer;"></a></div>
          <div class="twitter"><a title="Đăng lên Twitter" onclick="window.open('http://twitter.com/home?status='+document.location,'_blank');" style="cursor: pointer;"></a></div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>