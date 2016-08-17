jQuery(document).ready(function($) {
    $('#weiss_load_uploader').click(function() {
        tb_show('Upload a photo', 'media-upload.php?referer=wptuts-settings&type=image&TB_iframe=true&post_id=0', false);
        return false;
    });
	
	window.send_to_editor = function(html) {
		var image_url = jQuery(html).attr('src');
		jQuery('#weiss_user_photo').prop("src", image_url);
		jQuery('#user_photo').val(image_url);
		tb_remove();
	}
});

function remove_photo() {
	jQuery('#user_remove_photo').val('true');
	jQuery('#weiss_user_photo').attr('src', '');
}