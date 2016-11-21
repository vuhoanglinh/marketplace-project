<!-- Responsive Menu Footer Begin -->
<div class="gridContainer clearfix" style="padding-top: 10px;">
  <div class="row" id="main_menu">
    <ul class="accordion">
      <li> <a href="javascript:void(0)"><?php echo $f_muasam; ?></a>
        <ul id="cate_muasam" style="display: none;">
          <div id="ext-comp-1001" class=" x-panel">
            <div class="x-panel-bwrap" id="ext-gen4">
              <div class="x-panel-body x-panel-body-noheader" id="ext-gen5">
                <div id="ext-comp-1002">
                  <?php foreach ($category['parent'] as $row1) { ?>
                  <li onclick=""> <a href=""><?php echo $row1->name; ?></a> </li>
                  <?php }?>
                </div>
              </div>
            </div>
          </div>
        </ul>
      </li>
      <li> <a href="javascript:void(0)"><?php echo $f_khuyenmai; ?></a>
        <ul style="display: none;">
          <li> <a href=""><?php echo $f_outlet; ?></a> </li>
          <li> <a href=""><?php echo $f_deal; ?></a> </li>
        </ul>
      </li>
      <li class="non_sub"> <a href=""><?php echo $f_tinthoitrang; ?></a> </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="row"> <a id="account_btn" class="black_btn fltlft" onclick="" href="javascript:void(0)">Tài khoản</a> </div>
</div>
<!-- Responsive Menu Footer End --> 

<!-- Footer Begin -->
<footer class="footer">
  <div class="fcontent">
    <?php echo $f_copyright; ?>
  </div>
</footer>
<!-- Footer End --> 
<a href="#logon" title="Lên đầu trang" class="hr" style="display: none;"><span>Lên Đầu Trang</span></a> 
<script type="text/javascript">
$(document).ready(function(){

	// hide #back-top first
	$("a.hr").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('a.hr').fadeIn();
			} else {
				$('a.hr').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('a.hr').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>
</body>
</html>
