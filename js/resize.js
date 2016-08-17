var preloads = new Array(0);

jQuery(document).ready(function () {
	if (jQuery('.passionfeaturesImage').length != 0) {
		jQuery('.passionfeaturesImage img').each(function (ind, obj) { 
			preloads[preloads.length] = jQuery(obj).prop('src');
		});
	}
	preload_images();

	if (jQuery('#albumofthemonth_wrapper').length != 0)
		jQuery('#albumofthemonth_wrapper').height(jQuery('#main_cell').outerHeight(true) - jQuery('#passionfeaturesContainer').outerHeight(true));
});

function preload_images() {
	if (preloads.length == 0) return;
	jQuery('<div></div>').attr('id', 'preload_images').css({ position: 'absolute', width: '1px', height: '1px', overflow: 'hidden', display: 'none' }).appendTo(jQuery('body'));
	
	for (var i = 0; i < preloads.length; i++) {
		jQuery('#preload_images').append(jQuery('<img/>').attr('id', 'preloaded_' + i));
		
		jQuery('#preloaded_' + i).on('load', function (evt) { 
			if (jQuery(this).attr('src') == preloads[preloads.length - 1]) {
				afterLoadingImages();
			}
		});
		
		jQuery('#preloaded_' + i).attr('src', preloads[i]);
	}
}

function afterLoadingImages() {
	jQuery('.passionfeaturesImage img').each(function (ind, obj) { 
		jQuery(obj).css({ position: 'absolute', left: ((jQuery(obj).parent().parent().width() - jQuery(obj).width())/2) + 'px' });
	});
}