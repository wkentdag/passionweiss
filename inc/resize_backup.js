// JavaScript Document
/*
var rH = new ResizeHandler(div, { arg: 'val', arg2: 'val2' });
[10:27:37 PM] Nathan Binford: then
[10:27:49 PM] Nathan Binford: this.arg = args.arg1;
[10:27:49 PM] Nathan Binford: etc
[10:28:06 PM] Nathan Binford: the {arg1: '', arg2: ''}
[10:28:24 PM] Nathan Binford: is a shorthand way to create a multi-dimensional array
[10:28:30 PM] Nathan Binford: which in javascript is essentially an objet
[10:28:33 PM] Nathan Binford: object

var rH = new ResizeHandler(div, { minwidth: '300', minheight: '300' });
function ResizeHandler(resizeDiv,args) {}
this.minWidth=args.minWidth;

and you are only computing for differences -- WTH
if (NewWindowHeight > OldWindowHeight) { window.resizeLarger = true; } else { window.resizeLarger = false; }
*/
var resizehandlersa = new Array();
function register_resize_handlers(){
//resizeDiv,minWidth,minHeight,maxWidth,maxHeight,resizeWidthStyle(scale,match,none),resizeHeightStyle(scale,match,none)
resizehandlersa[0]= new ResizeHandler('#heading','800','70','1600','100','scale','scale');
resizehandlersa[1]= new ResizeHandler('#footer','800','70','1600','100','scale','scale');
resizehandlersa[2]= new ResizeHandler('#logo img','300','300','500','500','scale','scale');
}

/*window sizes variables*/
$(function () {

	window.LastWindowHeight = $(window).height();
    window.LastWindowHeightTime = new Date();
    window.LastWindowWidth = $(window).width();
    window.LastWindowWidthTime = new Date();
    $(window).resize(function (e) {
        window.NewWindowTime = new Date();
        window.NewWindowHeight = $(window).height();
        window.NewWindowWidth = $(window).width();
        if(NewWindowTime - LastWindowHeightTime < 100)
            return;
			
        window.percentageChangeh = NewWindowHeight / LastWindowHeight;
        window.percentageChangew = NewWindowWidth / LastWindowWidth;
        window.LastWindowHeight = window.NewWindowHeight;
        window.LastWindowWidth = window.NewWindowWidth;
        window.LastWindowHeightTime  = window.NewWindowTime;
    });
});
/**/

function ResizeHandler(resizeDiv,minWidth,minHeight,maxWidth,maxHeight,resizeWidthStyle,resizeHeightStyle) {
this.resizeDiv=resizeDiv;
this.minWidth=minWidth;
this.minHeight=minHeight;
this.maxWidth=maxWidth;
this.maxHeight=maxHeight;
this.resizeWidthStyle=resizeWidthStyle;
this.resizeHeightStyle=resizeHeightStyle;
this.doResize=doResize;
}
/**/
function doResize() {
	//height resizing
rhs=this.resizeHeightStyle;
switch (rhs)
{
case 'scale':
	
		var oldobjheight=$(this.resizeDiv).height();
		var newobjheight=oldobjheight * window.percentageChangeh;
			if(newobjheight<this.minHeight){
			$(this.resizeDiv).css("height",this.minHeight+"px");
				}else{
					if(newobjheight>this.maxHeight){
					$(this.resizeDiv).css("height",this.maxHeight+"px");
						}else{
					$(this.resizeDiv).css("height",newobjheight+"px");
					}
				}
	
break;
case 'match':
			$(this.resizeDiv).css("height",window.NewWindowHeight+"px");
break;

case 'none':
break;
}
//width resizing
rws=this.resizeWidthStyle;

switch (rws)
{
case 'scale':
	
		var oldobjwidth=$(this.resizeDiv).width();
		var newobjwidth=oldobjwidth * window.percentageChangew;
			if(newobjwidth<this.minWidth){
			$(this.resizeDiv).css("width",this.minWidth+"px");
				}else{
					if(newobjwidth>this.maxWidth){
					$(this.resizeDiv).css("width",this.maxWidth+"px");
						}else{
					$(this.resizeDiv).css("width",newobjwidth+"px");
					}
				}
break;
case 'match':
			$(this.resizeDiv).css("width",window.NewWindowWidth+"px");
break;

case 'none':
break;
}
}
/**/
/*resize each item in the array*/
function call_resize_handlers(){
register_resize_handlers();
for(i=0; i<resizehandlersa.length; i++) {
	resizehandlersa[i].doResize();
}
}
/**/
$(document).ready(function(){
});
/**/
$(window).resize(function() {
call_resize_handlers();
});


