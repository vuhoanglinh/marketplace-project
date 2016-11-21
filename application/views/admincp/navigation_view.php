
<div id="navigation">
  <div class="container-fluid"> <a href="#" id="brand">Admin</a> <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
    <ul class='main-nav'>
      <li> <a href="<?php echo base_url('admincp'); ?>"> <span>Bảng điều khiển</span> </a> </li>
      <li> <a href="#" data-toggle="dropdown" class='dropdown-toggle'> <span>Thông tin hệ thống</span> <span class="caret"></span> </a>
        <ul class="dropdown-menu">
          <li> <a href="<?php echo base_url(); ?>admincp/config/systems">Cấu hình hệ thống</a> </li>
          <li> <a href="#">Thư viện Mail</a> </li>
          <li> <a href="<?php echo base_url(); ?>admincp/config/seo">Tối ưu công cụ tìm kiếm SEO</a> </li>
        </ul>
      </li>
      <li> <a href="#" data-toggle="dropdown" class='dropdown-toggle'> <span>Chức năng hệ thống</span> <span class="caret"></span> </a>
        <ul class="dropdown-menu">
          <li> <a href="<?php echo base_url(); ?>admincp/menu">Quản lý menu</a> </li>
          <li> <a href="#">Quản lý quốc gia</a> </li>
          <li> <a href="#">Quản lý tỉnh thành</a> </li>
          <li> <a href="#">Quản lý quận huyện</a> </li>
          <li> <a href="<?php echo base_url(); ?>admincp/config/file">Quản lý tập tin</a> </li>
          <li> <a href="#">Thống kê truy cập</a> </li>
        </ul>
      </li>
    </ul>
    <div class="user">      
      <div class="dropdown"> <a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $name; ?> <img src="<?php echo base_url(); ?>public/<?php echo $avatar; ?>" alt="" width="27" height="27"></a>
        <ul class="dropdown-menu pull-right">
          <li> <a href="">Thông tin cá nhân</a> </li>
          <li> <a href="#">Thiết lập tài khoản</a> </li>
          <li> <a href="<?php echo base_url(); ?>admincp/index/logout">Đăng xuất</a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" id="content">