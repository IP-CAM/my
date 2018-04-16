/*---------------   实名认证 star  ----------------*/
$("#real-auth").click(function() {
	var that = $(this);
	var url = that.attr('data-url');
	$.ajax({
		type: "POST",
		url: url,
		data: $(this).parents('.login-form').serialize(),
		dataType: "json",
		success: function(res) {
			if(res.code == 1) {
				layer.msg(res.msg, {
					icon: 1,
					time: 2000,
					shade: 0.3
				}, function() {
					if(res.url) {
						parent.location.href = res.url;
					} else {
						parent.location.reload();
					}
				});
			} else {
				layer.msg(res.msg, {
					icon: 2,
					time: 2000,
					shade: 0.3
				}, function() {
					if(res.url) {
						parent.location.href = res.url;
					}
				});
			}
		}
	});
	return false;
});
/*---------------   实名认证 end  ---------------- */

/*---------------   ajax上传文件  ---------------- */
$('.upload-ui').each(function() {

	var _this = $(this);
	var url = _this.data('url');
	var max_length = _this.data('maxlength');
	var uploadid = _this.find('.action-upload');
	_this.on('click', '.action-remove', function() {
		$(this).parents('.handle').remove();
		if(_this.find('.handle').length < max_length) {
			uploadid.show();
		}
	});

	new AjaxUpload(uploadid, {
		action: url,
		name: 'file',
		data: {},
		autoSubmit: true,

		dataType: 'json',
		responseType: 'json',
		onComplete: function(file, response) {
			var data = response;
			if(!data.code) {
				layer.msg(data.msg);
				return false;
			}
			if(_this.find('.handle').length >= max_length - 1) {
				_this.find('.action-upload').hide();
			}
			uploadid.before($('<li class="handle img-thumbnail"><i class="icon-close-b action-remove">×</i><input type="hidden" name="img[]" value="' + data.url + '" /><img src="' + data.url + '" alt=""/></li>'))
		}
	});
});
/*---------------   ajax上传文件  ---------------- */

/* 取消订单 */
$('.cancel-order').on('click', function() {
	var order_id = $(this).data('order_id');
	open_cancel(order_id);
});
/* 确认收货订单 */
$('.finish-order').on('click', function() {
	var order_id = $(this).data('order_id');
	finish_order(order_id);
});
/* 申请售后 */
$('.submit-blue').on('click', function() {
	apply_return();
});
/* 删除订单 */
$('.delete-order').on('click', function() {
    var order_id = $(this).data('order_id');
    var display = $(this).data('display');
    delete_order(order_id,display);
});

/* 上传退货图片 */
$('.return-upload').each(function() {
	var _this = $(this);
	var url = _this.data('url');
	var max_length = _this.data('maxlength');
	var uploadid = _this.parent().find('.action-upload');
	_this.parent().on('click', '.action-remove', function() {
		$(this).parent().remove();
		if(_this.parent().find('.handle').length < max_length) {
			uploadid.show();
		}
	});
	new AjaxUpload(uploadid, {
		action: url,
		name: 'file',
		data: {},
		autoSubmit: true,
		dataType: 'json',
		responseType: 'json',
		onComplete: function(file, response) {

			var data = response;
			if(!data.code) {
				layer.msg(data.msg);
				return false;
			}
			if(_this.parent().find('.handle').length >= max_length - 1) {
				_this.parent().find('.action-upload').hide();
			}
			var _html = '<li class="handle img-thumbnail"><i class="icon-close-b action-remove" >×</i><img src="' + data.url + '"><input type="hidden" name="return_img[]" value="' + data.url + '"></li>';
			_this.before(_html);
		}
	});
});
$('#more_sx').on('click', function() {
	$('#more_from').toggle()
});

$('#recently_order').change('click',function () {
    window.location.href = $(this).val();
});

// laydate 日期
laydate({
	elem: '#start_riqi',
	event: 'click',
	choose: function(datas) {
		$('#start_riqi').html(datas);
		$('input[name="start"]').val(datas);
	}

});
laydate({
	elem: '#end_riqi',
	event: 'click',
	choose: function(datas) {
		$('#end_riqi').html(datas);
        $('input[name="end"]').val(datas);
	}

});
// 日期清空事件
$(document).on('click','#laydate_clear',function(){
    $('input[name="start"]').val('');
    $('input[name="end"]').val('');
    $('#start_riqi').html('');
    $('#end_riqi').html('');
});