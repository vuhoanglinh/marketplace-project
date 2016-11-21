
<div id="left">
  <!--
  <form action="search-results.html" method="GET" class='search-form'>    
    <div class="search-pane">
      <input type="text" name="search" placeholder="Tìm kiếm...">
      <button type="submit"><i class="icon-search"></i></button>
    </div>    
  </form>
  --> 
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Quản lý sản phẩm</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('adminlevel/product'); ?>">Sản phẩm chưa xác thực <?php echo ($numpro_not_active > 0)? "(".$numpro_not_active.")" : "";?></a> </li>
      <li> <a href="<?php echo base_url('adminlevel/product/productactive'); ?>">Sản phẩm đã xác thực</a> </li>
      <li> <a href="<?php echo base_url('adminlevel/product/productactive?home=true'); ?>">Sản phẩm được đánh dấu</a> </li>
    </ul>
  </div> 
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Đơn hàng</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="">Đơn hàng trong ngày</a> </li>
      <li> <a href="">Đơn hàng chưa xác thực</a> </li>
      <li> <a href="">Đơn hàng đã thanh toán</a> </li>
    </ul>
  </div>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Tin tức</span></a> </div>
    <ul class="subnav-menu">
      <?php foreach ($news_category as $row) {
        ?>
      <li> <a href="<?php echo base_url('adminlevel/news'); ?>?cat=<?php echo $row->id; ?>&code=<?php echo $row->code; ?>"><?php echo $row->name; ?></a> </li>
      <?php # code...
      } ?>
    </ul>
  </div>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Xu hướng thời trang</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="">Quản lý xu hướng</a> </li>
    </ul>
  </div>    
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Slideshow</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('adminlevel/slideshow'); ?>">Quản lý slideshow</a> </li>
    </ul>
  </div>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Hỏi đáp</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="">Hỏi đáp từ người dùng</a> </li>
    </ul>
  </div>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Quảng cáo</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="#">Vị trí quảng cáo</a> </li>
      <li> <a href="#">Đối tác quảng cáo</a> </li>
    </ul>
  </div>
</div>