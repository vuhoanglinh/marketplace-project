<div id="left">  
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Danh mục</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('stores/category'); ?>">Quản lý danh mục</a> </li>
    </ul>
  </div> 
  <?php if($num_ct > 0) {
  ?>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Quản lý sản phẩm</span></a> </div>
    <ul class="subnav-menu">
      <?php
      foreach($result['parent'] as $row)
      {
      ?>    
      <li <?php echo (count($result['child'][$count]) > 0)? 'class="dropdown"': ''; ?>> <a href="<?php echo base_url('stores/product'); ?>?idct=<?php echo $row->id; ?>" <?php echo (count($result['child'][$count]) > 0)? 'data-toggle="dropdown"': ''; ?>><?php echo $row->name; ?></a>  
      <?php 
        //if(count($result['child'][$count]) > 0) {
          echo '<ul class="dropdown-menu">';
          foreach ($result['child'][$count] as $value) {      
      ?>
      <li> <a href="<?php echo base_url('stores/product'); ?>?idct=<?php echo $value->id; ?>"><?php echo $value->name; ?></a></li>
    <?php                               
          } // end foreach loop 2
          $count++;
          echo "</ul>"; 
        //}                           
      } //end foreach loop 1
    ?>
      </li>
    </ul>
  </div>
  <?php 
        }
  ?>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Thư viện ảnh</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('stores/images'); ?>">Thư viện slideshow</a> </li>
      <li> <a href="<?php echo base_url('stores/images/ad'); ?>">Ảnh quảng cáo</a> </li>
    </ul>
  </div>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Sự kiện</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('stores/event'); ?>">Timeline</a> </li>
      <li> <a href="<?php echo base_url('stores/event/table'); ?>">Danh sách sự kiện</a> </li>
    </ul>
  </div>  
  <div class="subnav">
    <div class="subnav-title"> <a href="" class='toggle-subnav'><i class="icon-angle-down"></i><span>Chi nhánh</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="<?php echo base_url('stores/liststore'); ?>">Quản lý chi nhánh</a> </li>
    </ul>
  </div>
  <div class="subnav">
    <div class="subnav-title"> <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Đánh giá</span></a> </div>
    <ul class="subnav-menu">
      <li> <a href="">Đánh giá từ người dùng</a> </li>
      <li> <a href="<?php echo base_url('stores/comment'); ?>">Liên hệ <?php echo ($num_contact > 0) ? "(".$num_contact.")" : ''; ?></a> </li>
    </ul>
  </div>
</div>