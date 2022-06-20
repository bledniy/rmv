$(document).ready(function (e) {
	var url = window.location.href;
	if (url.indexOf("#") > 0) {
		var activeTab = url.substring(url.indexOf("#") + 1);
		$('.nav[role="tablist"] a[href="#' + activeTab + '"]').tab('show');
	}
	//
	$fancybox = $('a.fancybox');
	if ($fancybox.length) $fancybox.fancybox({
		buttons: ['share', 'close'],
	});
	$(function() {
		$lazyload = $("img.lazyload");
		if ($lazyload.length){
			$lazyload.lazyload({threshold : 300});
		}
	});
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});