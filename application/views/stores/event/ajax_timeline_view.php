<?php foreach ($query as $row) {
?>
<li>
	<div class="timeline-content">
		<div class="left">
			<div class="icon">
				<i class="icon-bullhorn"></i>
			</div>
			<div class="date"><?php echo mdate($datestring, strtotime($row->date_added)); ?></div>
		</div>
		<div class="activity">
			<div class="user"><h4><?php echo $row->name; ?></h4><br><span><i><?php echo $row->time; ?></i></span></div>
			<p><?php echo $row->detail; ?></p>
			<div class="text" style="display: none;"><?php echo $row->text ?></div>			
		</div>
	</div>
	<div class="line"></div>
</li>              
<?php }?>
<script type="text/javascript">
$(document).ready(function() {
	resize();
	$('.activity').css({'cursor' : 'pointer'});
	$('.activity').click(function() {		
    	$(this).children('.text').show('fast');
    	$(this).children('.text').removeAttr('style');
    	resize();
  	});
});
</script>
