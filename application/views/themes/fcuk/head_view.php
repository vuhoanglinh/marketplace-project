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
<link href="<?php echo base_url('themes'); ?>/fcuk/css/fcuk.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('themes'); ?>/fcuk/css/screen.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('themes'); ?>/fcuk/css/stylesheet.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url('themes'); ?>/default/css/jquery1.8.1.css" type="text/css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url('themes'); ?>/default/css/nivo-slider.css" rel="stylesheet">
<script src="<?php echo base_url('themes'); ?>/fcuk/js/jquery-1.7.2.min.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/fcuk/js/jquery.maximage.js" type="text/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jquery.nivo.slider.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jquery-ui-1.8.1.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jcarousellite_1.0.1.min.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/fcuk/js/jquery.mousewheel.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/fcuk/js/jquery.easing.1.3.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/default/js/jquery.cycle.all.js" type="application/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/fcuk/js/jquery.mCustomScrollbar.js" type="text/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/fcuk/js/common2.js" type="text/javascript"></script>
<script src="<?php echo base_url('themes'); ?>/fcuk/js/jCarousel.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
        $(function() {
            // Trigger maximage
            jQuery('#maximage').maximage({
                cycleOptions: {
                    fx: 'fade',
                    speed: 2000
                }
            });
        });

        $(window).load(function() {
            jQuery(".rw-box-ads").nivoSlider({
                effect: "fade",
                slices: 15,
                boxCols: 8,
                boxRows: 4,
                animSpeed: 500,
                pauseTime: 6000,
                startSlide: 0,
                directionNav: false,
                controlNav: false,
                controlNavThumbs: false,
                pauseOnHover: false,
                manualAdvance: false
            });
        });
    </script>
</head>

<body>
