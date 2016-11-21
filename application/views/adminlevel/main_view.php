<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Bảng điều khiển</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">							
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo base_url(); ?>/adminlevel">Trang chủ</a>
							<i class="icon-angle-right"></i>
						</li>				
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<ul class="tiles">
							<li class="red high long"> <a href="<?php echo base_url()?>"><span><i class="icon-globe"></i></span><span class="name">Trang chủ</span></a> </li>							
							<li class="blue">
								<a href="<?php echo base_url('adminlevel/news'); ?>"><span><i class="icon-bullhorn"></i></span><span class="name">Tin tức</span></a>
							</li>							
							<li class="green long">
								<a href="#"><span><i class="icon-picture"></i></span><span class="name">Quảng cáo</span></a>
							</li>
							<li class="orange"> <a href="<?php echo base_url('adminlevel/slideshow'); ?>"><span><i class="icon-film"></i></span><span class="name">Slideshow</span></a> </li>
							<li class="red long"> <a href="<?php echo base_url('adminlevel/product'); ?>"><span class="count"><i class="icon-gift"></i> <?php echo $numpro_not_active; ?></span><span class="name">Sản phẩm chưa xác thực</span></a> </li>
							<li class="teal long"> <a href="<?php echo base_url('adminlevel/product/productactive'); ?>"><span><i class="icon-gift"></i></span><span class="name">Sản phẩm đã xác thực</span></a> </li>
							<li class="blue long"> <a href="<?php echo base_url('adminlevel/product/productactive'); ?>?home=true"><span><i class="icon-gift"></i></span><span class="name">Sản phẩm được đánh dấu</span></a> </li>
							<li class="green long"> <a href=""><span class="count"><i class="icon-shopping-cart"></i> 1</span><span class="name">Đơn hàng trong ngày</span></a> </li>
							<li class="pink long"> <a href=""><span><i class="icon-shopping-cart"></i></span><span class="name">Đơn hàng đã thanh toán</span></a> </li>
							<li class="magenta long"> <a href=""><span><i class="icon-shopping-cart"></i></span><span class="name">Đơn hàng chưa thanh toán</span></a> </li>
							<li class="red long"> <a href=""><span><i class="icon-question-sign"></i></span><span class="name">Hỏi đáp từ người dùng</span></a> </li>
							<li class="teal long"> <a href=""><span><i class="icon-asterisk"></i></span><span class="name">Xu hướng sản phẩm</span></a> </li>
							<li class="blue">
								<a href="<?php echo base_url('adminlevel/index/logout'); ?>"><span><i class="icon-signout"></i></span><span class="name">Đăng xuất</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>