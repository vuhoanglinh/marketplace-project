
<div id="left">  
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Quản trị viên</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('admincp/user');?>">Quản lý quản trị viên</a> </li>
      <li> <a href="#">Nhóm quản trị</a> </li>
    </ul>
  </div>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Danh mục sản phẩm</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('admincp/category'); ?>">Quản lý danh mục sản phẩm</a> </li>
      <li> 
        <a href="<?php echo base_url('admincp/filter');?>">Quản lý danh mục bộ lọc</a>         
      </li>
    </ul>
  </div>
  <!--
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Danh mục tin tức</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('admincp/news'); ?>">Quản lý danh mục tin tức</a> </li>
    </ul>
  </div>
  -->
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-right"></i><span>Hệ thống cửa hàng</span></a> </div>
    <ul class="subnav-menu">            
      <li class="dropdown"> 
        <a href="#" data-toggle="dropdown">Cửa hàng</a>
          <ul class="dropdown-menu">
            <li>
              <a href="<?php echo base_url('admincp/store/group'); ?>">Quản lý nhóm cửa hàng</a>
            </li>
              <?php 
                foreach($storegroup as $row)
                {
              ?>
            <li> <a href="<?php echo base_url();?>admincp/store?id=<?php echo $row->id; ?>"><?php echo $row->name; ?></a> </li>
              <?php 
                }
              ?>  
          </ul>
      </li>     
      <li> <a href="<?php echo base_url('admincp/themes'); ?>">Thư viện Template</a> </li>         
    </ul>
  </div>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Đối tác</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('admincp/partner');?>" >Quản trị đối tác</a> </li>
    </ul>
  </div> 
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Danh mục email</span></a> </div>
    <ul class="subnav-menu">
      <li class="dropdown"> 
        <a href="<?php echo base_url('admincp/email/category');?>" data-toggle="dropdown">Quản lý email</a> 
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url('admincp/email/category');?>">Danh mục email</a></li>
          <?php 
            foreach($result as $row)
            {
          ?>
          <li> <a href="<?php echo base_url('admincp/email');?>?id=<?php echo $row->id; ?>"><?php echo $row->name; ?></a> </li>
          <?php 
            }
          ?>
        </ul>
      </li>
    </ul>
  </div> 
</div>

