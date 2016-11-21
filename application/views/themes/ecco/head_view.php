<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html;" />
<meta id="<?php echo $h_name; ?>_metaDescription" name="Description" content="<?php echo $h_description; ?>" />
<meta id="<?php echo $h_name; ?>_metaKeywords" name="Keywords" content="<?php echo $h_keyword; ?>" />
<?php echo $h_extentsion; ?>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8; IE=EmulateIE9" />
<title><?php echo $h_titlepage; ?></title>
<link rel="shortcut icon" href="<?php echo base_url('public')."/".$m_fav; ?>">
<link href="<?php echo base_url('themes'); ?>/ice/css/ch_layout.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('themes'); ?>/ecco/css/color/ecco.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('themes'); ?>/ecco/css/main.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('themes'); ?>/ecco/css/menu.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('themes'); ?>/ecco/css/product.css" type="text/css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url('themes'); ?>/default/css/nivo-slider.css" rel="stylesheet">
<script src="<?php echo base_url('themes'); ?>/default/js/jquery.min.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jquery.nivo.slider.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/merchant1/js/jquery.cookie.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jcarousellite_1.0.1.min.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jquery.cycle.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/merchant1/js/jquery.tinyscrollbar.min.js" type="application/javascript"></script>
<script type="text/javascript">
function closeSearchChonFrame() {
	$.cookie('hideSearchChonFrame', '1');
	var hideFrame = $.cookie("hideSearchChonFrame");
	if (hideFrame == '1') {
		$('#wrapperhead').hide();
	}	
} 
$(document).ready(function() {
	var hideFrame = $.cookie("hideSearchChonFrame");
	if (hideFrame == '1') {
		$('#wrapperhead').hide();
	}
}); 
</script>
<script>
$(function() {
$('.nivoSlider').nivoSlider({
	effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
	directionNav: false, // Next & Prev navigation
	controlNav: false
});
});
$(window).load(function() {
	$('.btn-slide').click(function() {
	$(this).parent().parent().find('#panel').toggleClass('autonav');
	$(this).toggleClass("active");
	});
}); 


$(document).ready(function(){
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content 
	
	$("ul.tabs li").mouseover(function() {
	$("ul.tabs li").removeClass("active"); //Remove any "active" class
	$(this).addClass("active"); //Add "active" class to selected tab
	$(".tab_content").hide(); //Hide all tab content
	var activeTab = $(this).find("a").attr("tablink"); //Find the rel attribute value to identify the active tab + content
	//$(activeTab).fadeIn(); //Fade in the active content
	$(activeTab).show();
	return false;
	}); 

});
</script>
</head>

<body>