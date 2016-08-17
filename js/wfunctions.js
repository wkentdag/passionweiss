var spinner = null;
function displayWait() {
	id = "loadInto_1";

	var opts = {
	  lines: 9, // The number of lines to draw
	  length: 10, // The length of each line
	  width: 5, // The line thickness
	  radius: 7, // The radius of the inner circle
	  corners: 1, // Corner roundness (0..1)
	  rotate: 0, // The rotation offset
	  direction: 1, // 1: clockwise, -1: counterclockwise
	  color: '#ccc', // #rgb or #rrggbb or array of colors
	  speed: 1, // Rounds per second
	  trail: 100, // Afterglow percentage
	  shadow: false, // Whether to render a shadow
	  hwaccel: false, // Whether to use hardware acceleration
	  className: 'spinner', // The CSS class to assign to the spinner
	  zIndex: 2e9, // The z-index (defaults to 2000000000)
	  top: '50', // Top position relative to parent in px
	  left: 'auto' // Left position relative to parent in px
	};
	var target = document.getElementById(id);
	if (spinner == null) spinner = new Spinner(opts).spin(target);
}

function removeWait() {
	if (spinner != null) spinner.stop();
}

function revealComments() {
	jQuery('#comments_form').fadeIn().animate({ height: '500px'}, 300);
}

function hideComments() {
	jQuery('#comments_form').animate({ height: '500px'}, 300).fadeTo(300, 0);
}

function ppLoad(id) {
	if (id == -1) id = jQuery('.passionPresentsItemCont').get(0).id.substr(jQuery('.passionPresentsItemCont').get(0).id.lastIndexOf("_") + 1);
	var item = jQuery('#passionPresents_' + id);
	if (jQuery(item).length > 0) {
		jQuery('.passionPresentsItemCont').each(function (ind, obj) { jQuery(obj).fadeTo(100, 0); jQuery(obj).css('display', 'none'); });
		jQuery('#passionPresents').animate({ 
			height: (jQuery(item).height() + 40) + "px"
		}, 100, 'swing', function () {	
			//jQuery(item).css('top', '20px');
			jQuery(item).css('display', 'block'); 
			jQuery(item).fadeTo(100, 1);
		});
	}
}

function ppResizeImage(img, w, h) {
	var ctnt = jQuery(img).parent().parent().parent();
	if (jQuery(ctnt).width() / 2 <= w) {
		jQuery(img).width(jQuery(ctnt).width()/2);
		//jQuery(ctnt).height(jQuery(ctnt).width()/2);
		//jQuery(img).css('height', '100%');
	} else {
		jQuery(img).width(w);
		jQuery(img).height(h);
		//jQuery(ctnt).height(h);
	}
	
	
	//jQuery(img).parent().parent().css('left', "20px");
}

var ppInd = 0;
var IND = 0;
function ppNext() {
	var img = false;
	jQuery('.passionPresentsItemCont').each(function (ind, obj) {  jQuery(obj).fadeTo(100, 0); jQuery(obj).css('display', 'none');  });
	
	jQuery('.passionPresentsItemCont').each(function (ind, obj) {
		if (ind == ppInd) {
			img = jQuery(obj).find('img');
			jQuery('#passionPresents').animate({ 
					height: (jQuery(img).parent().parent().parent().height() + 40) + "px"
				}, 100, 'swing', function () {	
					//jQuery(obj).css('top', '20px');
					jQuery(obj).css('display', 'block');
					jQuery(obj).fadeTo(100, 1);
				});
			ppInd++;
			return false;
		}
	});
	//jQuery(".passionPresentsCont").fadeTo(0,1);
}

var ppFlg = 0;
function passionPresentsHandlers() {
	//registering event handlers
	if (jQuery('#passionPresentsContainer').length > 0) {
		//jQuery("#passionPresentsContainer").fadeTo(0,0);
		jQuery('.passionPresentsNavDot').hover(function (evt) {
			jQuery(this).find('img').prop('src', '/wp-content/themes/weiss/images/purpledot.jpg');
			evt.stopPropagation();
		}, function (evt) {
			jQuery(this).find('img').prop('src', '/wp-content/themes/weiss/images/graydot.jpg');
			evt.stopPropagation();
		});
	}
	
	//resize
	var ppImgW = 0;
	var ppImgH = 0;
	jQuery(window).resize(function () {
		if (ppFlg == true) {
			ppFlg = true;
			ppResizeContainer();
			setInterval(200, 'ppFlg=false;');
		}
	});
	ppResizeContainer();
}
var loadedImages = [];

function ppResizeContainer() {
	var ctnt = jQuery('.content');
	var ppC = jQuery('#passionPresentsContainer');
	
	jQuery(document).on('load', function () { ppNext(); });
	
	jQuery(ppC).width(jQuery(ctnt).width());
	jQuery('.passionPresentsItemCont').each(function (ind, obj) {
		//determine the size of the presents item image
		var img = jQuery(obj).find('img');
		if (jQuery(img).width() == 'NaN' || jQuery(img).width() == 0 || jQuery(img).height() == 0) {
			//if no width is set, load the image invisibly to retrieve the dimensions
			var newImg = new Image();
			newImg.onload = function () {
				loadedImages[loadedImages.length] = jQuery(img).prop('src');
				p = jQuery(img).ready(function(){
					var imgSize = {width: newImg.width, height: newImg.height};
					ppResizeImage(jQuery(img), imgSize['width'], imgSize['height']);
					if (loadedImages.length == jQuery('.passionPresentsItemCont').length) ppNext();
				   });
			}
			newImg.src = jQuery(img).prop('src');
		} else {
			ppResizeImage(jQuery(img), jQuery(img).width(), jQuery(img).height());
			ppNext();
		}
		
	});
}

var currStep = 0;
var top5Width = 600;
var top5Timeout = null;
function top5_cycle(steps) {
	var fadeFlag = false;
	
	if (top5Timeout != null) {
		clearTimeout(top5Timeout);
		top5Timeout = null;
	}
	
	if (steps == null) {
		if (currStep + 1 >= jQuery('.top5_inner .top5_item').length) {
			currStep = 0;
			jQuery('.top5_inner').fadeTo(150,0);
			fadeFlag = true;
		} else currStep++;
	} else {
		if (steps + currStep > 0 && steps + currStep < jQuery('.top5_inner .top5_item').length)
			currStep = currStep + steps;
		else if (steps + currStep > 0)
			currStep = jQuery('.top5_inner .top5_item').length - 1;
		else currStep = 0;
	}
	
	var left = (-1 * (top5Width * currStep)) + "px";
	jQuery('.top5_inner').animate({left: left}, 300, function () { top5Timeout = setTimeout("top5_cycle();", 5000); });
	if (fadeFlag) jQuery('.top5_inner').fadeTo(150,1);
}

var lazyLoadPage = "home";
var lazyLoadParts = 1;

jQuery(document).ready(function() {
	//search bar
	jQuery('.navigationItem a[href=#search]').click(function () {
		if (jQuery('#searchbar').css('display') == 'none') jQuery('#searchbar').css('display', 'block');
		else jQuery('#searchbar').css('display', 'none'); 
	});
	jQuery('#searchfrm button').hover(function () {
		jQuery(this).fadeTo(0,.7);
	}, function () {
		jQuery(this).fadeTo(0,1);
	});
	
	jQuery('#topSocial img').hover(function () {
		jQuery(this).fadeTo(0,.7);
	}, function () {
		jQuery(this).fadeTo(0,1);
	});

	//lazy loading
	var lazyFlg = true;	
	jQuery(window).scroll(function () {
		if (jQuery('#loadInto_1').length) {
			if (jQuery(window).scrollTop() + jQuery(window).height() >= jQuery('#loadInto_1').offset().top && lazyFlg) {
				lazyFlg = false;
				for (var i = 1; i <= lazyLoadParts; i++) {
					jQuery.ajax({
					  url: "/wp-admin/admin-ajax.php?action=lazyload&page=" + lazyLoadPage + "&part=" + i,
					  dataType: 'text',
					  beforeSend: function( xhr ) {
						displayWait();
					  }
					}).done(function (data) {
						var pos = 0;
						if ((pos = data.indexOf('<!-- part:')) > -1) {
							var loadInto = data.substr(pos, data.indexOf('-->', pos) + 3);
							var into = parseInt(loadInto.substr(loadInto.indexOf(':') + 1, loadInto.indexOf('-->') -1));
							if (into > 0) {
								removeWait(); 
								jQuery('#loadInto_' + into).html(data);
							}
						}
					});
				}
			}
		}
	});
	
	jQuery('.top5_left').click(function (evt) { top5_cycle(-1); evt.stopPropagation(); });
	jQuery('.top5_right').click(function (evt) { top5_cycle(1); evt.stopPropagation(); });
	jQuery('.top5_inner').hover(function () {
		clearTimeout(top5Timeout);
		top5Timeout = null;
	}, function () { 
		top5Timeout = setTimeout('top5_cycle();', 5000);
	});
	top5Timeout = setTimeout('top5_cycle();', 5000);
	
	do_preload_images(['/wp-content/themes/weiss/images/purpledot.jpg', '/wp-content/themes/weiss/images/graydot.jpg']);
});

function do_preload_images(preload_images) {
	//preloading images	
	for (var i = 0; i < preload_images.length; i++) {
		var newImg = new Image();
		newImg.src = preload_images[i];
	}
}