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
<link href="<?php echo base_url('themes'); ?>/francosarto/css/francosarto.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('themes'); ?>/francosarto/css/stylesheet.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('themes'); ?>/default/css/jquery1.8.1.css" type="text/css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url('themes'); ?>/default/css/nivo-slider.css" rel="stylesheet">
<script src="<?php echo base_url('themes'); ?>//francosarto/js/jquery-1.7.2.min.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jquery.nivo.slider.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jquery-ui-1.8.1.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jcarousellite_1.0.1.min.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jquery.cycle.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jquery.pajinate.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/francosarto/js/jquery.easing.1.3.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/francosarto/js/jquery.mousewheel.js" type="application/javascript"></script>
<script>
$(function() {
	$('.nivoSlider').nivoSlider({
		effect: 'fold,sliceDown', // Specify sets like: 'fold,fade,sliceDown'
		directionNav: false, // Next & Prev navigation
		controlNav: false
	});
});
$(document).ready(function() {
    $('.clcode').hover(function() {
        $(this).find('.box-info').stop().animate({
            height: '85px'
        });
    }, function() {
        $(this).find('.box-info').stop().animate({
            height: '50px'
        });
    })
}); 
</script>
</head>

<body>
