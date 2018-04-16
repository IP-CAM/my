var current_layer_index = $('.ly-main ').on('click', '#show-logistics', function() {
    var after_sn = $(this).data('after_sn');
    var address = $(this).data('address');
    $('#logistics_content').find('.address').html(address);

	layer.open({
		'skin': 'layer-ext-blue',
		type: 1,
		area: ['600px', '310px'],
		scrollbar: false,
		title: $(this).data('title'),
		maxmin: false,
		anim: 0,
		shade: [0.3, '#333333'],
		content: $('#logistics_content').html(),
		btn: [$(this).data('button_yes'), $(this).data('button_no')],
		yes: function(index, item) {

			if(!item.find('.error-triggered').length) {
                var company = $('.layui-layer #companys').val();
                var number = $('.layui-layer #tracking_number').val();
                var request_data = {
                    company: company,
                    number : number,
                    after_sn : after_sn
                };
                var url = $('#logistics_content').data('url');

                $.ajax({
                    type: 'post',
                    url: url,
                    data: request_data,
                    dataType: 'json',
                    success: function (data) {
                        layer.close();
                        if(data.code){
                            layer.msg(data.msg, {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){
                                window.location.reload();
                            });
                        }
                    }
                });
			}


		},
		success: function(item, index) {
			$('.common-form').validateForm(item.find('.layui-layer-btn0'));
		}
	});
	return false
}

);
