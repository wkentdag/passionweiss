// JavaScript Document
//reset
function resetgallery(){
	//resize navigation
	$("#gal_display").css("width",$(".content").width()-20+"px");
	var galwidth=$("#gal_display").width();
	var eachwidth=((galwidth+4)/4)-15;
	$("#nav_gal_display").css("width",(galwidth+10)+"px");
	$(".singleimg").css("width",eachwidth+"px");

	}
function centernav(){
		$(".singleimg img").each(function() {
		var imgwidth = $(this).width();
		var imgheight = $(this).height();
			if(imgwidth>imgheight){
		$(this).css({ width: "auto", height: $(".singleimg").height()+"px" });
		var neww=($(this).width()-$(".singleimg").width())/2 + "px";
		$(this).css({ left: neww });
			}else{
		$(this).css({ width: $(".singleimg").width()+"px", height: "auto" });
		var newh=($(this).height()-$(".singleimg").height())/2 + "px";
		$(this).css({ top: newh });
			}
		});

}
function setfirst(){
	$(".singleimg img").first().addClass("galfirst"); 
	var imgs = $(".galfirst").attr("src");
	$('<img/>', { id: "mc", style: " width: "+$('#gal_display').width()+"px; height: auto; display: none;", src: imgs }).appendTo($('#gal_display'));

	$("#mc").show('slow'); 

}

/**/
$(document).ready(function(){
resetgallery();
centernav();
setfirst();

	$(".singleimg img").click(function() { 
		$("#mc").fadeOut('slow');
		$('#mc').remove();
		$(".galfirst").removeClass("galfirst"); 
		$(this).addClass("galfirst"); 
		var imgs = $(this).attr("src");
		$('<img/>', { id: "mc", style: " width: "+$('#gal_display').width()+"px; height: auto; display: none;", src: imgs }).appendTo($('#gal_display'));
	$("#mc").fadeIn('slow'); 

	});


});
/**/
$(window).resize(function() {
resetgallery();
});