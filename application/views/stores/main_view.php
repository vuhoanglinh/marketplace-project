<div id="main">
  <div class="container-fluid">
    <div class="page-header">
      <div class="pull-left">
        <h1>Bảng điều khiển</h1>
      </div>
      <div class="pull-right">
        <ul class="stats">
          <li class='lightred'> <i class="icon-calendar"></i>
            <div class="details"> <span class="big">February 22, 2013</span> <span>Wednesday, 13:56</span> </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="breadcrumbs">
      <ul>
        <li> <a href="<?php echo base_url(); ?>/store">Trang chủ</a> <i class="icon-angle-right"></i> </li>
      </ul>
      <div class="close-bread"> <a href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <ul class="tiles">
          <li class="red high long"> <a href="<?php echo base_url('cua-hang')."/".$name_store."/trang-chu"; ?>?rel=<?php echo $id_store;?>"><span><i class="icon-globe"></i></span><span class="name">Xem cửa hàng</span></a> </li>
          <li class="blue"> <a href="<?php echo base_url('stores/category'); ?>"><span><i class="icon-list-alt"></i></span><span class="name">Danh mục sản phẩm</span></a> </li>
          <li class="red"> <a href="<?php echo base_url('stores/product'); ?>"><span><i class="icon-gift"></i></span><span class="name">Quản lý sản phẩm</span></a> </li>
          <li class="green"> <a href="<?php echo base_url('stores/images/ad'); ?>"><span><i class="icon-picture"></i></span><span class="name">Ảnh quảng cáo</span></a> </li>
          <li class="pink"> <a href="<?php echo base_url('stores/event'); ?>"><span><i class="icon-certificate"></i></span><span class="name">Sự kiện cửa hàng</span></a> </li>
          <li class="teal"> <a href="javascript:void(0)" id="finder"><span><i class="icon-cloud-upload"></i></span><span class="name">File uploads</span></a> </li>
          <li class="blue"> <a href="<?php echo base_url('stores/themes'); ?>"><span><i class="icon-magic"></i></span><span class="name">Template</span></a> </li>          
          <li class="teal"> <a href="<?php echo base_url('stores/liststore'); ?>"><span><i class="icon-sitemap"></i></span><span class="name">Quản lý chi nhánh</span></a> </li>
          <li class="orange"> <a href="<?php echo base_url('stores/images'); ?>"><span><i class="icon-film"></i></span><span class="name">Slideshow</span></a> </li>
          <li class="lime"><a href="#"><span class="count"><i class="icon-comment"></i> 1</span><span class="name">Đánh giá</span></a></li>
          <li class="red"> <a href="<?php echo base_url('stores/comment'); ?>"><span class="count"><i class="icon-envelope"></i> <?php echo ($num_contact > 0) ? $num_contact : ''; ?></span><span class="name">Liên hệ</span></a> </li>
          <li class="blue"> <a href="#"><span><i class="icon-bar-chart"></i></span><span class="name">Thống kê</span></a> </li>
          <li class="orange"> <a href="<?php echo base_url('stores/index/logout'); ?>"><span><i class="icon-signout"></i></span><span class="name">Đăng xuất</span></a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  resize();
  $("#finder").click(function() {
    var finder = new CKFinder();
    finder.popup();
  });
});
</script>
