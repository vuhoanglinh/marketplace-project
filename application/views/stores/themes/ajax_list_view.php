			<style type="text/css">
			.btn.btn-primary {
				background: #368ee0 !important;
				color: #fff !important;
				text-shadow: none;
			}
			.btn.btn-primary:hover {
				background: #1e74c5 !important;
			}
			.btn.btn-success {
				background: #40bf40 !important;
				text-shadow: none;
				color: #fff !important;
			}
			.btn.btn-success:hover {
				background: #393 !important;
			}
			.btn.btn-inverse {
				background: #484848 !important;
				text-shadow: none;
				color: #fff !important;
			}
			.btn.btn-inverse:hover {
				background: #111 !important;
			}
			.img {
				width: 200px !important;
				height: 305px !important;
			}
			</style>
			<?php foreach ($query as $row) {
              ?>
              <li><h4 style="width:200px; height: 40px; color: #555; overflow: hidden; text-align: center;"><?php echo $row->name; ?></h4> <a href="#"> <img class="img" width="200" height="305" src="<?php echo ($row->image1 != "") ? $row->image1 : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';; ?>" alt=""> </a>
                <div class="extras" <?php echo ($row->status == 0) ? 'style="display:block;"' : ''; ?>>
                  <div class="extras-inner"> 
                  	<a href="javascript:void(0)" rel="<?php echo base_url('stores/themes/setthemes') ?>" relid="<?php echo $id_store; ?>" relthemes="<?php echo $row->folder; ?>" <?php if($themes != $row->folder) {?>set="enable" class='btn btn-primary' <?php } else {?> set="disable" class='btn btn-inverse' <?php }?>><?php echo ($themes != $row->folder)? 'Cài đặt' : 'Đang dùng';?></a> 
                  	<a href="<?php echo base_url('stores/themes/detail') ?>?id=<?php echo $row->id; ?>" class='btn btn-success'>Chi tiết</a>                   	
                  </div>
                </div>
              </li>            
              <?php }?>
              <script type="text/javascript">
              $(document).ready(function(){
              	resize();
              	$("a[set='enable']").click(function(){
              		var a = $(this);
              		$.ajax({
	              		url : $(this).attr('rel'),
	              		type : "post",
	              		dataType : "json",
	              		data: {id_store : $(this).attr('relid') , themes: $(this).attr('relthemes')},
	              		success : function(data){
	              			if(data.status == 0) {
	              				$(location).attr('href', "");
	              			}
	              		}
	              	});
              	});              	
              });
              </script>