
<div id="navigation">
  <div class="container-fluid"> <a href="#" id="brand">Admin</a> <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
    <ul class='main-nav'>
      <li> <a href="<?php echo base_url('stores'); ?>"> <span>Bảng điều khiển</span> </a> </li>  
      <li> <a href="" data-toggle="dropdown" class='dropdown-toggle'> <span>Thống kê</span> </a> 
        <ul class="dropdown-menu">
          <li> <a href="">Doanh thu sản phẩm</a> </li>
          <li> <a href="#">Đơn đặt hàng</a> </li>
          <li> <a href="">Thống kê lượng truy cập</a> </li>
        </ul>
      </li>  

    </ul>  
    <div class="user">
      <!--
      <ul class="icon-nav">
        <li class='dropdown'> <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope"></i><span class="label label-lightred">4</span></a>
          <ul class="dropdown-menu pull-right message-ul">
            <li> <a href="#"> <img src="<?php echo base_url(); ?>public/img/demo/user-1.jpg" alt="">
              <div class="details">
                <div class="name">Administrator</div>
                <div class="message"> Lorem ipsum Commodo quis nisi ... </div>
              </div>
              </a> </li>
            <li> <a href="#"> <img src="<?php echo base_url(); ?>public/img/demo/user-2.jpg" alt="">
              <div class="details">
                <div class="name">John Doedoe</div>
                <div class="message"> Ut ad laboris est anim ut ... </div>
              </div>
              <div class="count"> <i class="icon-comment"></i> <span>3</span> </div>
              </a> </li>
            <li> <a href="#"> <img src="<?php echo base_url(); ?>public/img/demo/user-3.jpg" alt="">
              <div class="details">
                <div class="name">Bob Doe</div>
                <div class="message"> Excepteur Duis magna dolor! </div>
              </div>
              </a> </li>
            <li> <a href="components-messages.html" class='more-messages'>Go to Message center <i class="icon-arrow-right"></i></a> </li>
          </ul>
        </li>
        <li class="dropdown sett"> <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-cog"></i></a>
          <ul class="dropdown-menu pull-right theme-settings">
            <li> <span>Layout-width</span>
              <div class="version-toggle"> <a href="#" class='set-fixed'>Fixed</a> <a href="#" class="active set-fluid">Fluid</a> </div>
            </li>
            <li> <span>Topbar</span>
              <div class="topbar-toggle"> <a href="#" class='set-topbar-fixed'>Fixed</a> <a href="#" class="active set-topbar-default">Default</a> </div>
            </li>
            <li> <span>Sidebar</span>
              <div class="sidebar-toggle"> <a href="#" class='set-sidebar-fixed'>Fixed</a> <a href="#" class="active set-sidebar-default">Default</a> </div>
            </li>
          </ul>
        </li>
      </ul>
      -->
      <div class="dropdown"> <a href="#" style="padding: 10px 15px;" class='dropdown-toggle' data-toggle="dropdown"><?php echo $name; ?> <img src="<?php echo base_url(); ?>public/<?php echo $avatar; ?>" alt="" width="60" ></a>
        <ul class="dropdown-menu pull-right">
          <li> <a href="<?php echo base_url('stores/store'); ?>">Thông tin cửa hàng</a> </li>
          <li> <a href="<?php echo base_url('stores/store/config'); ?>">Thiết lập cửa hàng</a> </li>
          <li> <a href="<?php echo base_url('stores/themes'); ?>">Template</a> </li>
          <li> <a href="<?php echo base_url(); ?>stores/index/logout">Đăng xuất</a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" id="content">