<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- Add jQuery library -->
<script type="text/javascript" src="source/jquery-1.10.1.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="source/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
/* 48px */
.toTop-arrow {
	width: 3rem;
	height: 3rem;
	padding: 0;
	margin: 0;
	border: 0;
	border-radius: 33%;
	opacity: 0.6;
	background: #000;
	cursor: pointer;
	position:fixed;
	right: 1rem;
	bottom: 1rem;
	display: none;
}
.toTop-arrow::before, .toTop-arrow::after {
	width: 25px;
	height: 6px;
	border-radius: 3px;
	background: #f90;
	position: absolute;
	content: "";
}
.toTop-arrow::before {
	transform: rotate(-45deg) translate(0, -50%);
	left: 0.42rem;
}
.toTop-arrow::after {
	transform: rotate(45deg) translate(0, -50%);
	right: 0.42rem;
}
.toTop-arrow:focus {outline: none;}
</style>
<body>
<?php
$Folder_name = $_COOKIE['my_data'];
$FileNum = count(glob("$Folder_name/*.*"));
echo "<div id='img_div'>";
echo '<script type="text/javascript">		$(document).ready(function() {
	$(".fancybox-thumbs").fancybox({
		prevEffect : "none",
		nextEffect : "none",

		closeBtn  : false,
		arrows    : false,
		nextClick : true,

		helpers : {
			thumbs : {
				width  : 50,
				height : 50
			}
		}
	});


});';
echo '</script>';
for($i=0;$i<$FileNum;$i++){
	echo "<a class='fancybox-thumbs' data-fancybox-group='thumb' href='".$Folder_name."/".$i.".png' >";
    echo "<img src='".$Folder_name."/".$i.".png' >";
    echo "</a>";
}
?>
<button type="button" id="BackTop" class="toTop-arrow"></button>
<script>
$(function(){
	$('#BackTop').click(function(){ 
		$('html,body').animate({scrollTop:0}, 333);
	});
	$(window).scroll(function() {
		if ( $(this).scrollTop() > 300 ){
			$('#BackTop').fadeIn(222);
		} else {
			$('#BackTop').stop().fadeOut(222);
		}
	}).scroll();
});
</script>
</body>
</html>