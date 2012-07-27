<?php @session_start();?>
<?php 
require_once('includes/init.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>fancyBox - Fancy jQuery Lightbox Alternative | Demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Add jQuery library -->
	<script type="text/javascript" src="public/js/jquery.js"></script>

	
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="public/js/jquery.fancybox.js?v=2.0.6"></script>
	<link rel="stylesheet" type="text/css" href="public/css/jquery.fancybox.css?v=2.0.6" media="screen" />

	

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="public/css/jquery.fancybox-thumbs.css?v=1.0.2" />
	<script type="text/javascript" src="public/js/jquery.fancybox-thumbs.js?v=1.0.2"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="../source/helpers/jquery.fancybox-media.js?v=1.0.0"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			
			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 10,
						height : 10
					}
				}
			});


			$("#fancybox-manual-c").click(function() {
												   
				$.fancybox.open([
								 
					{
						href : 'public/img/gallery/slide1.jpg',
						title : 'My title'
					}, {
						href : 'public/img/gallery/slide2.jpg',
						title : '2nd title'
					}, {
						href : 'public/img/gallery/slide3.jpg'
					},
				], {
					helpers : {
						overlay: {
						opacity: 0.7, 
						css: {'background-color': '#000'} 
					    }, 
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
			
		}
	</style>
</head>
<body>

		<a id="fancybox-manual-c" href="javascript:;">Open gallery</a>
	
<br>
<a class="fancybox-thumbs" data-fancybox-group="thumb" href="4_b.jpg"><img src="4_s.jpg" alt="" /></a>

		<a class="fancybox-thumbs" data-fancybox-group="thumb" href="public/img/gallery/slide1.jpg"><img src="public/img/gallery/slide1.jpg" alt="" /></a>

		<a class="fancybox-thumbs" data-fancybox-group="thumb" href="2_b.jpg"><img src="2_s.jpg" alt="" /></a>

		<a class="fancybox-thumbs" data-fancybox-group="thumb" href="1_b.jpg"><img src="1_s.jpg" alt="" /></a>
	
</body>
</html>