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
				height: 220px !important;
			}

			.box-shadow {
					border: 1px solid #ddd;
					margin-bottom: 20px !important;
			}
			</style>
			<?php foreach ($product['view'] as $row) {
            ?>
              <li class="box-shadow"><h5 style="width:190px; padding: 5px 0 0 5px; height: 60px; color: #555; overflow: hidden; text-align: center; text-transform: uppercase;"><?php echo $row->name." - ".$product['store'][$index]; ?></h5> <a href="#"> <img class="img" width="200" height="305" src="<?php echo ($product['image'][$index] != "") ? $product['image'][$index] : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';; ?>" alt=""> </a>
                <div class="extras" <?php echo ($row->status == 0) ? 'style="display:block;"' : ''; ?>>
                  <div class="extras-inner"> 
                  	<a href="javascript:void(0)" rel="" relid="<?php echo $row->id; ?>" set="enable" class='btn btn-primary'>Xác thực</a> 
                  	<a href="<?php echo base_url('cua-hang')."/".$product['store'][$index]."/san-pham/".$row->title."/chi-tiet"; ?>?code=<?php echo $row->id; ?>&rel=<?php echo $row->id_store;?>" class='btn btn-success'>Chi tiết</a>                   	
                  </div>
                </div>
              </li>            
              <?php 
              $index++;
          		}?>
              <script type="text/javascript">
              $(document).ready(function(){
              	resize();
              	$("a[set='enable']").click(function(){
              		var a = $(this);
              		$.ajax({
	              		url : "<?php echo base_url('adminlevel/product/active'); ?>",
	              		type : "post",
	              		dataType : "json",
	              		data: {id : $(this).attr('relid')},
	              		success : function(data){
	              			if(data.status == 0) {
	              				$(location).attr('href', "");
	              			}
	              		}
	              	});
              	});              	
              });
              </script>