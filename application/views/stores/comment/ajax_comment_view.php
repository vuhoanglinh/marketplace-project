<?php foreach ($query as $row) {
?>
<li>
	<div class="timeline-content">
		<div class="left">
			<div class="icon <?php echo ($row->active == 0)? 'red' : ''; ?>">
				<i class="icon-comment"></i>
			</div>
			<div class="date"><?php echo mdate($datestring, strtotime($row->date_added)); ?></div>
		</div>
		<div class="activity" relid="<?php echo $row->id; ?>">
			<div class="user"><a href="#"><?php echo $row->name; ?>.</a> <span>Công ty: <?php echo $row->company; ?></span></div>
			<p>Điện thoại: <?php echo $row->phone; ?>. Email: <?php echo $row->email; ?></p>
			<div class="text" style="display: none;"><?php echo $row->comments; ?></div>			
		</div>
	</div>
	<div class="line"></div>
</li>              
<?php }?>
<script type="text/javascript">
$(document).ready(function() {
	var id_store = <?php echo $id_store; ?>;
	$('.activity').css({'cursor' : 'pointer'});
	$('.activity').click(function() {		
		var id = $(this).attr('relid');
    	$(this).children('.text').show('fast');
    	$(this).children('.text').removeAttr('style');
    	$.ajax({
    		url: "<?php echo base_url('stores/comment/active'); ?>",
    		type: "post",
    		data: "id="+id,
    		success: function(data) {
    			if(data == 1) {
    				$('.activity').siblings('.left').children('.icon').removeClass('red');
    			}
    		}
    	});
    	resize();
  	});
});
</script>