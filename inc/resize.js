// JavaScript Document
/*
*/
var resizehandlersa = new Array();
function register_resize_handlers(){
if ($('#slider_bg').length != 0) {
	resizehandlersa[0]= new ResizeHandler('#slider_bg',{minWidth:'400',minHeight: '400',maxHeight:'450',resizeWidthStyle: 'match',resizeHeightStyle: 'scale'});
	resizehandlersa[1]= new ResizeHandler('#slider_bg_img',{minWidth:'400',minHeight: '400', maxHeight:'450',resizeWidthStyle: 'match',resizeHeightStyle: 'scale'});
} else {
	resizehandlersa[0]= new ResizeHandler('#footerimg',{minWidth:'400',minHeight:'200',maxHeight:'250',resizeWidthStyle: 'match',resizeHeightStyle: 'scale'});
	resizehandlersa[1]= new ResizeHandler('#footerimg_img',{minWidth:'400',minHeight:'200',maxHeight:'250',resizeWidthStyle: 'match',resizeHeightStyle: 'scale'});
	resizehandlersa[2]= new ResizeHandler('#footer_text_container',{minWidth:'400',minHeight:'200',maxHeight:'250',resizeWidthStyle: 'match',resizeHeightStyle: 'scale'});

	if ($('#dartsonmap').length != 0) { 
		resizehandlersa[3]= new ResizeHandler('#whiteheader_bg',{minWidth:'400',minHeight:'323',maxHeight:'350',resizeWidthStyle: 'match',resizeHeightStyle: 'scale'});
		resizehandlersa[4] = new ResizeHandler('#dartsonmap',{minWidth:'253',minHeight:'323',maxWidth:'350',maxHeight:'350',resizeWidthStyle: 'scale',resizeHeightStyle: 'scale'});
		//resizehandlersa[5] = new ResizeHandler('#whiteheader_right',{minWidth:'300',minHeight:'174',maxWidth:'500',maxHeight:'290',resizeHeightStyle: 'scale',resizeWidthStyle: 'scale'});
	}
	
	if ($('#pointingmap').length != 0) {
		resizehandlersa[resizehandlersa.length]= new ResizeHandler('#pointingmap',{minWidth:'400',minHeight:'200',maxHeight:'250',resizeWidthStyle: 'match',resizeHeightStyle: 'scale'});
	}
}


//resizehandlersa[2]= new ResizeHandler('#slider_container',{minWidth:'400',minHeight: '400',maxWidth: '600',maxHeight: '600',resizeWidthStyle: 'scale',resizeHeightStyle: 'scale'});
//resizehandlersa[4]= new ResizeHandler('.slider_wrapper',{minWidth:'400',minHeight: '400',resizeWidthStyle: 'match',resizeHeightStyle: 'scale'});
//resizehandlersa[3]= new ResizeHandler('.main',{minWidth:'400',minHeight: '400',maxWidth: '1024',maxHeight: '1200',resizeWidthStyle: 'scale',resizeHeightStyle: 'none'});
//resizehandlersa[2]= new ResizeHandler('.arrows-slider',{minWidth:'20',minHeight: '20',maxWidth: '29',maxHeight: '43',resizeWidthStyle: 'scale',resizeHeightStyle: 'scale'});
//resizehandlersa[1]= new ResizeHandler('#lightboxBG',{minWidth:'400',minHeight: '400',maxWidth: '2000',maxHeight: '1000',resizeWidthStyle: 'macth',resizeHeightStyle: 'match'});
//resizehandlersa[0]= new ResizeHandler('#lightboxIMG',{minWidth:'50',minHeight: '50',maxWidth: '800',maxHeight: '1000',resizeWidthStyle: 'scale',resizeHeightStyle: 'none'});
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
        if(window.NewWindowTime - window.LastWindowHeightTime < 2)
            return;
        window.percentageChangeh = window.NewWindowHeight / window.LastWindowHeight;
        window.percentageChangew = window.NewWindowWidth / window.LastWindowWidth;        
		window.LastWindowHeight = window.NewWindowHeight;
        window.LastWindowWidth = window.NewWindowWidth;
        window.LastWindowHeightTime  = window.NewWindowTime;
    });
});
/**/

function ResizeHandler(resizeDiv,args) {
this.resizeDiv=resizeDiv;
this.minWidth=args.minWidth;
this.minHeight=args.minHeight;
this.maxWidth=args.maxWidth;
this.maxHeight=args.maxHeight;
this.resizeWidthStyle=args.resizeWidthStyle;
this.resizeHeightStyle=args.resizeHeightStyle;
this.doResize=doResize;
//this.doMatch=doMatch;
}
/**/
function doResize() {
	//height resizing
rhs=this.resizeHeightStyle;
switch (rhs)
{
case 'scale':
	
		this.oldobjheight=$(this.resizeDiv).height();
		this.newobjheight=this.oldobjheight * window.percentageChangeh;
		if(this.newobjheight>window.NewWindowHeight){this.newobjheight=window.NewWindowHeight;}else{this.newobjheight=this.newobjheight;}
		if(this.newobjheight<this.minHeight){
					$(this.resizeDiv).css("height",this.minHeight+"px");
				}else{
					if(this.newobjheight>this.maxHeight){
					$(this.resizeDiv).css("height",this.maxHeight+"px");
						}else{
					$(this.resizeDiv).css("height",this.newobjheight+"px");
					}
				}
	
break;
case 'match':
			if(!window.NewWindowHeight){$(this.resizeDiv).css("height",window.LastWindowHeight+"px");}else{$(this.resizeDiv).css("height",window.NewWindowHeight+"px");}
break;

case 'none':
break;
}

//width resizing
rws=this.resizeWidthStyle;

switch (rws)
{
case 'scale':
	
		this.oldobjwidth=$(this.resizeDiv).width();
		this.newobjwidth=this.oldobjwidth * window.percentageChangew;
		if(this.newobjwidth>window.NewWindowWidth){this.newobjwidth=window.NewWindowWidth;}else{this.newobjwidth=this.newobjwidth;}
		
			if(this.newobjwidth<this.minWidth){
					$(this.resizeDiv).css("width",this.minWidth+"px");
				}else{
					if(this.newobjwidth>this.maxWidth){
					$(this.resizeDiv).css("width",this.maxWidth+"px");
						}else{
					$(this.resizeDiv).css("width",this.newobjwidth+"px");
					}
				}
break;
case 'match':
			if(!window.NewWindowWidth){$(this.resizeDiv).css("width",window.LastWindowWidth+"px");}else{$(this.resizeDiv).css("width",window.NewWindowWidth+"px");}
break;

case 'none':
break;
}
}
/**/
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
call_resize_handlers();
});
/**/
$(window).resize(function() {
call_resize_handlers();
});