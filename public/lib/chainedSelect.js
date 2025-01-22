$(document).ready(function () {
	$('.chainedSelect').each(function () {
		let $parent = $(this).data('parent');
		let $target = $(this).data('target');
		let $dtUrl = $(this).data('url');
		let $url = baseClass + '/getOption_' + target;
		if ($parent) {

		} else {
			if ($target) {
				$(this).load($url, function () {
					$(this).trigger('change');
				});

			}


		}

	})
});
