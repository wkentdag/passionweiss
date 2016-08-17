// JavaScript Document


function lightbox(img,imgwidth,imgheight) {	
	$('<div></div>', { id: 'lightboxBG'} ).appendTo($('body')); 
	$('#lightboxBG').css({ width: $(window).width(), height: $(window).height(), backgroundColor: '#000000', position: 'fixed', zIndex: '98', top: '0px', left: '0px' });
	$('#lightboxBG').fadeTo(0,.5);
	
	$('<div></div>', { id: 'lightboxWRAPPER' } ).appendTo($('body'));
	$('#lightboxWRAPPER').css({ height: $(window).height(), width: $(window).width(), position: 'fixed', zIndex: '98', top: '0px', left: '0px' });
	
	$('<div></div>', { 'id': 'lightbox' }).appendTo($('#lightboxWRAPPER'));
	
	$('<img/>', { id: 'lightboxIMG', style: "border: 4px solid #000; max-width: " + ($(window).width()-400) + "px; max-height: " + ($(window).height()-200) + "px; width:" + imgwidth + "px; height: auto", src: img }).appendTo($('#lightbox'));
	
	$('#lightbox').css({ width: $('#lightboxIMG').width(), height: imgheight, position: 'absolute' });
	$('#lightbox').css({ top: ($(window).height()-$('#lightbox').height())/2+'px', left: ($(window).width()-$('#lightbox').width())/2+'px' });
	
	$(window).click(function() { 
		if ($('#lightboxBG') && $('#lightboxWRAPPER')) {
			$('#lightboxBG').remove();
			$('#lightboxWRAPPER').remove();
		}
	});
}