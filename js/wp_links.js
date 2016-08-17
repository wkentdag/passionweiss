var start = 22;

function rebuildInnerSanctum() {
	if (wpVars.lPosts) {
		jQuery('#innersanctumRight').html('');
		
		var out = "";
		var orig = start;
		for (var i = start; i < wpVars.lPosts.length && i < orig + 22; i++) {
			out += "<a href=\"" + wpVars.lPosts[i]['website'] + "\">" + wpVars.lPosts[i]['title'] + "</a>";
		}
		jQuery('#innersanctumRight').html(out);
	}
}

function previousInnerSanctum() {
	if (start + 22 < wpVars.lPosts.length) {
		start = start + 22;
		rebuildInnerSanctum();
	}
}

function nextInnerSanctum() {
	if (start - 22 < wpVars.lPosts.length) {
		start = start - 22;
		if (start < 0) start = 0;
		rebuildInnerSanctum();
	}
}

var isPage = 1;
var isPerPage = 22;
function innersanctum_next() {
	if (lPosts.length > isPage*isPerPage) isPage += 1;
	jQuery('#innersanctumRight').html('');
	for (var i = (isPage*isPerPage)-isPerPage; i < lPosts.length && i < isPerPage*isPage; i++) {
		jQuery('#innersanctumRight').html(jQuery('#innersanctumRight').html() + "<a href=\"" + lPosts[i]['website'] + "\">" + lPosts[i]['title'] + "</a><br>");
	}
}

function innersanctum_previous() {
	if (isPage > 1) {
		jQuery('#innersanctumRight').html('');
		var start = ((isPage*isPerPage) - isPerPage) - isPerPage;
		if (start < 0) start = 0;
		for (var i = start; i < ((isPage*isPerPage) - isPerPage); i++) {
			jQuery('#innersanctumRight').html(jQuery('#innersanctumRight').html() + "<a href=\"" + lPosts[i]['website'] + "\">" + lPosts[i]['title'] + "</a><br>");
		}
		isPage = isPage - 1 > 0 ? isPage - 1 : 1;
	}
}