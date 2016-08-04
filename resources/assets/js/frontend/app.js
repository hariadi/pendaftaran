$(function(){

	function fixSearch() {
		var win = $(this);
		var searchWidth = $('#term').outerWidth();

		if (win.width() > 768) {
			$('#term').focus(function () {
				$(this).animate({
					width: searchWidth + 100 + 'px'
				}, 100);
			}).focusout(function () {
				$(this).animate({
					width: searchWidth + 'px'
				}, 100);
			});
		} else {
			$('#term').css('width', '100%');
		}

	}

	fixSearch();

	$(window).on('resize', fixSearch());
});
