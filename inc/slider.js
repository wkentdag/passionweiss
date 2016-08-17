// JavaScript Document
//set up initial settings
function reset_positions(){
$(".slide_container").css({left: '2000px'});
$(".slide_container").removeClass("next");
$(".slide_container").removeClass("current");
$(".slide_container").removeClass("prev");

$(".slide_container").first().addClass("current"); 
$(".current").css({left: '0px'});	
$('.current').next('.slide_container').addClass("next");
}

function vertically_center(){
var sheight = $(".slide_container").height();
var swidth = $(".slide_container").width();
$.each($('.slide_container img'), function (index, obj) { 
		var imgheight = $(obj).height();
		var imgwidth = $(obj).width();
		if (imgheight>sheight){var newtop=(imgheight-sheight)/2;
		$(obj).css({top: '-'+newtop+'px'});}else{$(obj).css({top: '0px'});}
		if (imgwidth>swidth){var newleft=(imgwidth-swidth)/2;
		$(obj).css({left: '-'+newleft+'px'});}else{$(obj).css({left: '0px'});}
		});
}

function next(){
var swidth = $(".slide_container").width();
$(".slide_container").animate({left: swidth +'px'},0);
$(".current").animate({left: '0px'},0);

if (!$(".slide_container").hasClass('next')) 
 { $(".slide_container").first().addClass("next"); }else{}
if (!$(".slide_container").hasClass('prev')) 
 { $(".slide_container").last().addClass("prev"); }else{}
$(".current").animate({left:'-='+ swidth +'px'},800,'swing');
$('.next').animate({left:'0px'},800,'swing');
$(".prev").removeClass("prev");
$(".current").removeClass("current").addClass("prev");
$(".next").removeClass("next").addClass("current");
$('.current').next('.slide_container').addClass("next");

}

function prev(){
var swidth = $(".slide_container").width();
$(".slide_container").animate({left: "-"+swidth +'px'},0);
$(".current").animate({left: '0px'},0);
if (!$(".slide_container").hasClass('prev')) 
 { $(".slide_container").last().addClass("prev"); }else{}
$(".current").animate({left:'+='+ swidth +'px'},800,'swing');
$('.prev').animate({left:'0px'},800,'swing');
$(".current").animate({left: "-"+swidth +'px'},0);
//$(".next").animate({left: "-"+swidth +'px'},0);
$(".next").removeClass("next");
$(".current").removeClass("current").addClass("next");
$(".prev").removeClass("prev").addClass("current");
$('.current').prev('.slide_container').addClass("prev");

}

$(document).ready(function(){
reset_positions();
//slide = setInterval( "next()", 5000 );

$(".rclick").click(function () {
next();
clearInterval(slide);
slide = setInterval( "next()", 5000 );
	});
$(".lclick").click(function () {
prev();
clearInterval(slide);
slide = setInterval( "next()", 5000 );
	});
//
});
$(window).resize(function() {
clearInterval(slide);
reset_positions();
slide = setInterval( "next()", 5000 );
});
