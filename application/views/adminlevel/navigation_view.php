
<div id="navigation">
  <div class="container-fluid"> <a href="#" id="brand">Admin</a> <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
    <ul class='main-nav'>
      <li> <a href="<?php echo base_url('adminlevel'); ?>"> <span>Bảng điều khiển</span> </a> </li>  
      <li> <a href="" data-toggle="dropdown" class='dropdown-toggle'> <span>Thống kê</span> </a> 
        <ul class="dropdown-menu">
          <li> <a href="">Doanh thu sản phẩm</a> </li>
          <li> <a href="#">Đơn đặt hàng</a> </li>
          <li> <a href="">Thống kê lượng truy cập</a> </li>
        </ul>
      </li>  

    </ul>  
    <div class="user">
      <div class="dropdown"> <a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $name; ?> <img src="<?php echo base_url(); ?>public/<?php echo $avatar; ?>" alt="" width="27" height="27"></a>
        <ul class="dropdown-menu pull-right">
          <li> <a href="#">Thông tin cá nhân</a> </li>
          <li> <a href="#">Thiết lập cửa hàng</a> </li>
          <li> <a href="<?php echo base_url(); ?>adminlevel/index/logout">Đăng xuất</a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" id="content">