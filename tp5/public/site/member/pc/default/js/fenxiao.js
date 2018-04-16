$('#getcode').click(function() {
	if(!$(this).hasClass('disabled')) {
		var obj = {};
		var username = $(this).parents('#pwd_form').find('[name=username]');
		var captcha = $(this).parents('#pwd_form').find('[name=captcha]');
		captcha.trigger('blur')
		username.trigger('blur')
		if(!captcha.parents('.error-triggered').length && !username.parents('.error-triggered').length) {
			sendVerify(this, {
				username: username.val(),
				captcha: captcha.val()
			})
		}

	}
})
$('#pwd_form').validateForm($('.submit-btn'))
function sendVerify(el, data) {
	var url = $(el).data('url');
	var textCont = $(el);
	$(el).addClass('disabled');
	textCont.html($(el).text() + '(<i style="font-size: 14px;">0</i>)');
	var cd = new countdown(textCont.find('i'), {
		start: 59, //等待时间
		secondOnly: false,
		callback: function(e) {
			$(el).removeClass('disabled');
			textCont.html($('#js_again_code').text());
		}
	});
	$.post(url, data, function(rs) {
		layer.msg($('#js_code_success').text());
		if(rs.code == 0) {
			cd.stop();
			$(el).removeClass('disabled');
			textCont.html($('#js_again_code').text());
		}

	});
}