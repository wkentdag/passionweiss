<? 
/*g_slider_on();
global $slider_on;

if($slider_on=='true'){
slider_animation();
}else{}*/

if (is_front_page()) {
?>
<script>
var stopSlider = false;
var pauseLen = 6000;
var sliderCnt = 1;

$(document).ready(function() {
	//begin with all layers hidden
	$('.slider_slide').each(function (ind, obj) {
		$(obj).fadeTo(0,0);
	});
	
	animateSlider();
});
function animateSlider() {
	//start animation
	
	$('#slider_slide_' + sliderCnt).fadeTo(1000,1, function() {
		$('#slider_slide_' + sliderCnt).delay(pauseLen).fadeTo(1000, 0, function () {
			sliderCnt = sliderCnt < $('.slider_slide').length ? sliderCnt + 1 : 1;
			animateSlider();
		});
	});
	
}


</script>
<div id="slider_bg">
	<img src="/images/greenheaderbg.jpg" id="slider_bg_img">
	
	<div style="width: 100%; height: 400px; margin: auto; position: absolute; top: 70px; z-index: 2;">
		<div id="slider_frame">
			<div id="slider_container">
			
				<!-- slides start here -->
				<div class="slider_slide" id="slider_slide_1" style="margin-top: 0px; margin-left: 50px;">
					<span class="largetext">LET YOUR<br>DATA<br>
					OUT OF<br>
					<span class="hugetext">THE BOX</span></span>
				</div>
				<div class="slider_slide" id="slider_slide_2" style="margin-top: 40px; margin-left: 60px;">
					<span style="font-size: 45pt;">COLOCATE</span><br><span style="font-size: 26pt;">CLOSE TO YOUR USERS</span>
				</div>
				<div class="slider_slide" id="slider_slide_3" style="margin-top: 30px; margin-left: 60px;">
					<span class="hugetext">EXPAND</span><br><span class="largetext">WHENEVER<br>YOU NEED</span>
				</div>
				<div class="slider_slide" id="slider_slide_4" style="margin-top: 40px; margin-left: 70px;">
					<span style="font-size: 25pt;">MAXIMIZE YOUR</span><br><span class="hugetext">ROI</span><br><span style="font-size: 25pt;">IN TECHNOLOGY</span>
				</div>
				<!-- slides end here -->
				
			</div>
			<div id="slider_fixed_right">
				<div id="dartpoints_dart"><img src="/images/dartlogo.png"></div>
				<div id="learnmore"><a href="/how-it-works"><img src="/images/learnmore.png" border="0"></a></div>
			</div>
		</div><!-- /slider_frame -->
	</div>
</div>

<?php } else { 

if (strstr($_SERVER['REQUEST_URI'], "/how-it-works")) { ?>

<div id="whiteheader_bg" style="margin-top: 65px;">
	<img src="/images/dartsonmap.jpg" id="dartsonmap">
	<div style="width: 100%; position: absolute; z-index: 3; top: 20px;"><img src="/images/whiteheader_right.png" id="whiteheader_right" alt="DartPoints Distributed Data Centers"></div>
</div>
<?php } else if (strstr($_SERVER["REQUEST_URI"], '/company-profile')) { ?>
	<div style="position: relative; width: 100%; height: 290px; background-image: url(/images/throwingdart.jpg); background-position: bottom right; background-repeat: no-repeat;"><div style="position: relative; width: 100%; height: 290px;"><div id="left_dart_text_cont" style="width: 940px; margin: auto; padding-top: 100px;"><img src="/images/left_dart_text.png" style="float: left;" alt="DartPoints Distributed Data Centers"></div></div>
	<script>
		$(document).ready(function () { 
			$(window).resize(function () { if ($(window).width() <= TABLET_WIDTH) { $('#left_dart_text_cont').css('width', '100%'); } else { $('#left_dart_text_cont').css('width', '940px'); } });
		});
	</script>
<?php } else if (strstr($_SERVER["REQUEST_URI"], '/get-started')) { ?>
	<div style="position: relative; width: 100%; height: 290px; margin-top: 50px; background-image: url(/images/dartatcomputer.jpg); background-position: bottom right; background-repeat: no-repeat;"><div style="position: relative; width: 100%; height: 290px;"><div id="left_dart_text_cont" style="width: 940px; margin: auto; padding-top: 100px;"><img src="/images/getstartedtext.png" style="float: left;" alt="DartPoints Distributed Data Centers"></div></div>
	<script>
		$(document).ready(function () { 
			$(window).resize(function () { if ($(window).width() <= TABLET_WIDTH) { $('#left_dart_text_cont').css('width', '100%'); } else { $('#left_dart_text_cont').css('width', '940px'); } });
		});
	</script>
<?php } else if (strstr($_SERVER['REQUEST_URI'], '/contact-us')) { ?>
	<div style="position: relative; width: 100%; height: 290px; margin-top: 50px; background-image: url(/images/dartatcomputer.jpg); background-position: bottom right; background-repeat: no-repeat;"><div style="position: relative; width: 100%; height: 290px;"><div id="left_dart_text_cont" style="width: 940px; margin: auto; padding-top: 100px;"><img src="/images/contactustext.png" style="float: left;" alt="DartPoints Distributed Data Centers"></div></div>
	<script>
		$(document).ready(function () { 
			$(window).resize(function () { if ($(window).width() <= TABLET_WIDTH) { $('#left_dart_text_cont').css('width', '100%'); } else { $('#left_dart_text_cont').css('width', '940px'); } });
		});
	</script>
<?php } else if (strstr($_SERVER['REQUEST_URI'], '/login')) { ?>
		<div style="position: relative; width: 100%; height: 290px; margin-top: 50px; background-image: url(/images/dartatcomputer.jpg); background-position: bottom right; background-repeat: no-repeat;"><div style="position: relative; width: 100%; height: 290px;"><div id="left_dart_text_cont" style="width: 940px; margin: auto; padding-top: 100px;"><img src="/images/welcometodartpoints.jpg" style="float: left;" alt="DartPoints Distributed Data Centers"></div></div>
	<script>
		$(document).ready(function () { 
			$(window).resize(function () { if ($(window).width() <= TABLET_WIDTH) { $('#left_dart_text_cont').css('width', '100%'); } else { $('#left_dart_text_cont').css('width', '940px'); } });
		});
	</script>
<?php } else { ?>
<div style="width: 100%; height: 200px; margin-top: 0px;">
	<div style="position: relative; width: 100%; height: 200px;">
		<div style="background-image: url(/images/blog_right_header.jpg); background-position: top left; background-repeat: no-repeat; float: left; width: 33%; height: 200px;"></div>
		<div style="width: 34%; height: 200px; float: left;"><div id="learnabout" style="width: 100%; margin-top: 70px;"><img src="/images/learnaboutdatacenters.jpg" style="float: left; width: 100%;" alt="Learn About Data Centers" align="center"></div></div>
		<div style="background-image: url(/images/blog_right_header.jpg); background-position: top right; background-repeat: no-repeat; float: right; width: 33%; height: 200px;"></div>
	</div>
	<script>
		$(document).ready(function () { 
			$(window).resize(function () { if ($(window).width() <= TABLET_WIDTH) { $('#left_dart_text_cont').css('width', '100%'); } else { $('#left_dart_text_cont').css('width', '940px'); } });
		});
	</script>
<?php } } ?>