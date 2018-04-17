$(function(){
	$('input[name=\'search\']').parent().find('.weui-icon-search').on('click', function() {
		var url = $('base').attr('href') + 'index.php?route=product/search';

		var value = $('input[name=\'search\']').val();

		if (value) {
			url += '&search=' + encodeURIComponent(value);
		}

		location = url;
	});

	$('input[name=\'search\']').on('keydown', function(e) {
		if (e.keyCode == 13) {
			$('input[name=\'search\']').parent().find('.weui-icon-search').trigger('click');
		}
	});
});