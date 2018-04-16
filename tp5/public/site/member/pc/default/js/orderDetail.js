var current_layer_index = $('.ly-main ').on('click', '#show-wuliu', function() {
	layer.open({
		'skin': 'layer-ext-blue',
		type: 1,
		area: ['800px', '500px'],
		scrollbar: false,
		title: $('#js_return_address').text(),
		shade: 0.6,
		maxmin: false,
		anim: 0,
		shade: [0.3, '#333333'],
		content: $('#wuliu_content').html()
		
		
	});
	return false
});

// 倒计时
timer(intDiff);
