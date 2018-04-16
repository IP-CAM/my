var current_layer_index = $('.ly-main ').on('click', '#btn_add_address', function() {
	layer.open({
		'skin': 'layer-ext-blue',
		type: 1,
		area: ['800px', '560px'],
		scrollbar: false,
		title: $('#js_add_address').text(),
		maxmin: false,
		anim: 0,
		shade: [0.3, '#333333'],
		content: $('#address_content').html(),
		btn: [$('#js_ok').text(), $('#js_no').text()],
		yes: function(index, item) {
			if(!item.find('.error-triggered').length) {
                $('#address_submit').trigger('click');
			} else {
                parent.layer.msg($('#js_complete_address').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});
			}

			//layer.close(index);
		},
		success: function(item, index) {
			$('.address-form').validateForm(item.find('.layui-layer-btn0'));
            $('#country').trigger('click');
            $('.images-upload').each(function(){
			
			    var _this=$(this);
			    var img_name = _this.data('id');
			    var url=_this.data('url');
			    var max_length=_this.data('maxlength');
			    var uploadid=_this.find('.action-upload');
			    _this.on('click','.action-remove',function(){
			        $(this).parents('.handle').remove();
			        if(_this.find('.handle').length<max_length){
			            uploadid.show();
			        }
			    });
			
			    new AjaxUpload(uploadid, {
			        action: url,
			        name: 'file',
			        data:{} ,
			        autoSubmit: true,
			
			        dataType:'json',
			        responseType:'json',
			        onComplete: function(file, response) {
			            var  data=response;
			            if(!data.code){
			                layer.msg(data.msg);return false;
			            }
			            if(_this.find('.handle').length>=max_length-1){
			                _this.find('.action-upload').hide();
			            }
			            uploadid.before($('<li class="handle img-thumbnail" style="width:220px;height:150px" class="handle img-thumbnail"><i class="icon-close-b action-remove">×</i><input type="hidden" name="'+img_name+'" value="'+data.url+'" /><img src="'+data.url+'" alt=""/></li>'))
			        }
			    });
			});
		}
	});
	return false
});

var current_layer_index = null;
$('body').on('mouseenter', '#show_tips', function() {

	current_layer_index = layer.tips($('.help-pop').html(), '#show_tips', {
		tips: [1, '#78BA32'],
		time: 500000
	});

}).on('mouseout', '#show_tips', function() {
	layer.close(current_layer_index);
});

// 提交订单页面
// 选择收货地址
$(document).on('click','.address-item',function(){
    $(this).siblings().removeClass('current');
    $(this).addClass('current');
    let validate = false;
    let address_id = parseInt($(this).data('id'));
    if(!isNaN(address_id)){
        validate = true;
    }

    let request_data = {
        address_id: address_id
    };

    let url = $(this).data('url');

    if(validate) {
        $.ajax({
            type: 'post',
            url: url,
            data: request_data,
            dataType: 'json',
            success: function (json) {
                if(json === false){
                    // 错误时刷新页面
                    window.location.reload();
                }else{
                    // 更换收货地址,更新运费和订单总额
                    $('#shipping_price').text(json['shipping_price']);
                    $('#total').text(json['total']);

                }
            }
        });
    }else{
        // 错误时刷新页面
        window.location.reload();
    }

});

// 修改收货地址
$(document).on('click', '.address-item .modify', function () {

    let validate = false;
    let address_id = $(this).parents('.address-item').data('id');
    if (!isNaN(address_id)) {
        validate = true;
    }

    let request_data = {
        address_id: address_id
    };

    let url = $(this).parents('.address-item').data('modify');

    if (validate) {
        $.ajax({
            type: 'post',
            url: url,
            data: request_data,
            dataType: 'json',
            success: function (json) {
                if (json.code) {
                    // 更换地址
                    if (json.data) {
                        $('input[name="consignee2"]').val(json.data.consignee);
                        $('input[name="address2"]').val(json.data.address);
                        $('input[name="mobile2"]').val(json.data.mobile);
                        $('input[name="identity2"]').val(json.data.identity);
                        let upload = $('#upload').data('upload') + '/';
                        let front = '<img src="' + upload + json.data.front_img + '" width="220" height="150"/>';
                        $('#front2').html(front);
                        let reverse = '<img src="' + upload + json.data.verso_img + '" width="220" height="150"/>';
                        $('#reverse2').html(reverse);
                        if (json.data.is_default) {
                            $('input[name="is_default2"]').attr("checked", true);
                        } else {
                            $('input[name="is_default2"]').attr("checked", false);
                        }
                        if (json.data.country) {
                            $('select[name="country2"]').val(json.data.country);
                            let province_url = $('#country2').data('province');
                            let city_url = $('#country2').data('city');
                            let district_url = $('#country2').data('district');

                            if (json.data.province) {
                                $.post(province_url, {'country': json.data.country}, function (rs) {
                                    if (rs.code == 1) {
                                        if ($("#province2").length > 0) {
                                            $("#province2").html(add_province2(rs.data, json.data.province));
                                        } else {
                                            $("#select_td2").append(add_province2(rs.data, json.data.province));
                                        }
                                    }
                                });

                                if (json.data.city) {
                                    $.post(city_url, {'province': json.data.province}, function (rs) {
                                        if (rs.code == 1) {
                                            if ($("#city2").length > 0) {
                                                $("#city2").html(add_city2(rs.data, json.data.city));
                                            } else {
                                                $("#select_td2").append(add_city2(rs.data, json.data.city));
                                            }
                                        }
                                    });

                                    if (json.data.district) {
                                        $.post(district_url, {'district': json.data.city}, function (rs) {
                                            if (rs.code == 1) {
                                                if ($("#district2").length > 0) {
                                                    $("#district2").html(add_district2(rs.data, json.data.district));
                                                } else {
                                                    $("#select_td2").append(add_district2(rs.data, json.data.district));
                                                }

                                                return true;
                                            }
                                        });
                                    }

                                }


                            } else {
                                $.post(province_url, {'country': json.data.country}, function (rs) {
                                    $("#select_td2").append(add_province2(rs.data, 0))
                                });
                            }
                        }
                    }
                } else {
                    // 错误时刷新页面
                    window.location.reload();
                }
            }
        });
    } else {
        // 错误时刷新页面
        window.location.reload();
    }

    modify_div();

    return false; // 防止冒泡事件

});

// 提交订单按钮
$('#confirm_order').on('click',function () {
    var that = $(this);
    // 判断是否有选择收货地址
    var has_address = $('.address-list').find('.current').length;
    if (has_address == 0){
        parent.layer.msg($(this).data('error'), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});
    }else{
        var url = $(this).data('url');
        var error_msg = $(this).data('msg');

        var validate = true;

        // 订单留言，发票抬头，纳税号
        var invoice_type = $('input[name="invoice_type"]:checked').val();
        var invoice_title = $.trim($('input[name="invoice_title"]').val());
        var invoice_title_msg = $.trim($('input[name="invoice_title"]').data('msg'));
        var invoice_number = $('input[name="invoice_number"]').val();
        var invoice_number_msg = $('input[name="invoice_number"]').data('msg');

        if(invoice_type == 2 && invoice_title == ''){
            validate = false;
            layer.msg(invoice_title_msg, {skin: 'layer-ext-blue', icon: 0, time: 2000, shade: 0.3}, function () {});
            return false;
        }
        if(invoice_type == 1){
            if(invoice_title == ''){
                validate = false;
                layer.msg(invoice_title_msg, {skin: 'layer-ext-blue', icon: 0, time: 2000, shade: 0.3}, function () {});
                return false;
            }
            if(invoice_number == ''){
                validate = false;
                layer.msg(invoice_number_msg, {skin: 'layer-ext-blue', icon: 0, time: 2000, shade: 0.3}, function () {});
                return false;
            }
        }
        var order_message = $('textarea[name="order_message"]').val();


        if($("#agree").length>0){
            var agree_msg = $("#agree").data('msg') + $("#agree-title").text();
            if($("#agree").is(':checked') == false){
                validate = false;
                layer.msg(agree_msg, {skin: 'layer-ext-blue', icon: 0, time: 2000, shade: 0.3}, function () {});
                return false;
            }
        }


        var request_data = {
            invoice_type:invoice_type,
            invoice_title:invoice_title,
            invoice_number:invoice_number,
            order_message:order_message
        };
        // 提交订单
        if(validate) {
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: request_data,
                before: function () {
                    that.attr("disabled","true");
                    validate = false;
                    layer.msg(error_msg);
                },
                success: function (data) {
                    that.attr("disabled","true");
                    that.css("background-color","#d2d2d2");
                    if (data.code == 1) {
                        if (data.url) {
                            window.location.href=data.url;
                        }
                    } else {
                        layer.msg(data.msg, {skin: 'layer-ext-blue', icon: 0, time: 2000, shade: 0.3}, function () {
                            if (data.url) {
                                window.location.href=data.url;
                            }
                        });
                    }
                }
            });
        }
    }
});
$(document).on('click', '#address_submit', function () {
    var error = $(this).data('error');
    var url = $(this).data('url');
    var consignee = $('input[name="consignee"]').val();
    var country = $('select[name="country"]').find('option:selected').val();
    var province = $('select[name="province"]').find('option:selected').val();
    var city = $('select[name="city"]').find('option:selected').val();
    var district = $('select[name="district"]').find('option:selected').val();
    var address = $('input[name="address"]').val();
    var mobile = $('input[name="mobile"]').val();
    var zipcode = $('input[name="zipcode"]').val();
    var email = $('input[name="email"]').val();
    var identity = $('input[name="identity"]').val();
    var is_default = $('input[name="is_default"]').is(':checked');
    if(is_default){
        is_default = 1;
    }else{
        is_default = 0;
    }
    // 省/市/区选择判断
    if(province == 0){
        parent.layer.msg($('select[name="province"]').find('option[value=0]').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }else if(city == 0){
        parent.layer.msg($('select[name="city"]').find('option[value=0]').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }else if(district == 0){
        parent.layer.msg($('select[name="district"]').find('option[value=0]').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }

    // 身份证正反面
    var id_front = $('input[name="front"]').val();
    var id_reverse = $('input[name="reverse"]').val();
    if(typeof(id_front) === 'undefined') {
        parent.layer.msg($('#js_id_front').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }
    if(typeof(id_reverse) === 'undefined') {
        parent.layer.msg($('#js_id_reverse').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }
    id_front = id_front.replace('/uploads/','');
    id_reverse = id_reverse.replace('/uploads/','');

    if (!$('.address-form').find('.error-triggered').length) {
        $.post(url,
            {
                'consignee': consignee,
                'country': country,
                'province': province,
                'city': city,
                'district': district,
                'address': address,
                'zipcode': zipcode,
                'mobile': mobile,
                'email': email,
                'identity': identity,
                'front_img': id_front,
                'verso_img': id_reverse,
                'is_default':is_default
            },
            function (res) {
                if (res.code == 1) {
                    layer.close(current_layer_index);
                    window.location.reload();
                } else {
                    layer.msg(res.msg);
                    return false;
                }
            }
        );
        return false;
    } else {
        layer.alert(error, {
            icon: 2,
            'skin': 'layer-ext-blue'
        });
    }
});

// 获取国家省市区
$(document).on('change', '#province2', function () {

    let city_url = $('#country2').data('city');
    let district_url = $('#country2').data('district');
    var c = $(this).val();
    $("#city2").remove();
    $("#district2").remove();
    $.post(city_url, {'province': c}, function (rs) {
        if (rs.code == 1) {
            if ($("#city2").length>0) {
                $("#city2").html(add_city2(rs.data,0));
            } else {
                $("#select_td2").append(add_city2(rs.data,0));
            }
            $("#city2").change(function () {
                $("#district2").remove();
                var c = $(this).val();

                $.post(district_url, {'district': c}, function (rs) {
                    if (rs.code == 1) {
                        if ($("#district2").length>0) {
                            $("#district2").html(add_district2(rs.data,0));
                        } else {
                            $("#select_td2").append(add_district2(rs.data,0));
                        }

                        return true;
                    } else {
                        console.log(rs);
                        return false;
                    }
                });
                return false;
            });
            return true;
        } else {
            console.log(rs);
            return false;
        }
    });
    return false;
});
$(document).on('change', '#city2', function () {
    let district_url = $('#country2').data('district');
    var c = $(this).val();
    $("#district2").remove();
    $.post(district_url, {'district': c}, function (rs) {
        if (rs.code == 1) {
            if ($("#district2").length>0) {
                $("#district2").html(add_district2(rs.data,0));
            } else {
                $("#select_td2").append(add_district2(rs.data,0));
            }

            return true;
        } else {
            console.log(rs);
            return false;
        }
    });
    return false;
});
$(document).on('click', '#country2', function () {
    $("#province2").remove();
    $("#city2").remove();
    $("#district2").remove();

    let c = $('#country2').val();
    let province_url = $('#country2').data('province');
    let city_url = $('#country2').data('city');
    let district_url = $('#country2').data('district');

    $.post(province_url, {'country': c}, function (rs) {
        if (rs.code == 1) {
            if ($("#province2").length>0) {
                $("#province2").html(add_province2(rs.data,0));
            } else {
                $("#select_td2").append(add_province2(rs.data,0));
            }
            $("#province2").change(function () {
                $("#city2").remove();
                $("#district2").remove();
                var c = $(this).val();

                $.post(city_url, {'province': c}, function (rs) {
                    if (rs.code == 1) {
                        if ($("#city2").length>0) {
                            $("#city2").html(add_city2(rs.data,0));
                        } else {
                            $("#select_td2").append(add_city2(rs.data,0));
                        }
                        $("#city2").change(function () {
                            $("#district2").remove();
                            var c = $(this).val();

                            $.post(district_url, {'district': c}, function (rs) {
                                if (rs.code == 1) {
                                    if ($("#district2").length>0) {
                                        $("#district2").html(add_district2(rs.data,0));
                                    } else {
                                        $("#select_td2").append(add_district2(rs.data,0));
                                    }

                                    return true;
                                } else {
                                    console.log(rs);
                                    return false;
                                }
                            });
                            return false;
                        });
                        return true;
                    } else {
                        console.log(rs);
                        return false;
                    }
                });
                return false;
            });
            return true;
        } else {
            console.log(rs);
            return false;
        }
    });
    return false;
});


function add_province2(item,selected_id) {
    var _html = '';
    _html += ' <select name="province2" id="province2" required>';
    _html += '<option value="0">'+$('#js_choose_province').text()+'</option>';
    for (var i = 0; i < item.length; i++) {
        if(selected_id == item[i].id){
            _html += '<option selected="selected" value="' + item[i].id + '">' + item[i].name + '</option>';
        }else{
            _html += '<option value="' + item[i].id + '">' + item[i].name + '</option>';
        }
    }
    _html += '</select>';
    return _html;
}
function add_city2(item,selected_id) {
    var _html = '';
    _html += ' <select  name="city2" id="city2">';
    _html += '<option value="0">'+$('#js_choose_city').text()+'</option>';
    for (var i = 0; i < item.length; i++) {
        if(selected_id == item[i].id){
            _html += '<option selected="selected" value="' + item[i].id + '">' + item[i].name + '</option>';
        }else{
            _html += '<option value="' + item[i].id + '">' + item[i].name + '</option>';
        }
    }
    _html += '</select>';
    return _html;
}
function add_district2(item,selected_id) {
    var _html = '';
    _html += ' <select name="district2"  id="district2">';
    _html += '<option value="0">'+$('#js_choose_district').text()+'</option>';
    for (var i = 0; i < item.length; i++) {
        if(selected_id == item[i].id){
            _html += '<option selected="selected" value="' + item[i].id + '">' + item[i].name + '</option>';
        }else{
            _html += '<option value="' + item[i].id + '">' + item[i].name + '</option>';
        }
    }
    _html += '</select>';
    return _html;
}

// 显示修改收货地址
function modify_div() {
    let top = ($(window).height() - 560)/2;
    let left = ($(window).width() - 800)/2;
    $('#modify_address').css({
        'top':top,
        'left':left,
        'position':'absolute'
    });
    $('#modify_address').show();
}
$('.hide_modify').click(function(){
    $('#modify_address').hide();
});
$('#save_modify').click(function(){
    let country2 = $('select[name="country2"]').find('option:selected').val();
    let province2 = $('select[name="province2"]').find('option:selected').val();
    let city2 = $('select[name="city2"]').find('option:selected').val();
    let district2 = $('select[name="district2"]').find('option:selected').val();
    let address2 = $('input[name="address2"]').val();
    let mobile2 = $('input[name="mobile2"]').val();
    let is_default2 = $('input[name="is_default2"]').is(':checked');
    if(is_default2){
        is_default2 = 1;
    }else{
        is_default2 = 0;
    }
    let province_error = $(this).data('province_error');
    let address_error = $(this).data('address_error');
    let mobile_error = $(this).data('mobile_error');
    let url = $(this).data('url');
    // 省/市/区选择判断
    if(province2 == 0){
        parent.layer.msg(province_error, {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }else if(city2 == 0){
        parent.layer.msg($('select[name="city2"]').find('option[value=0]').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }else if(district2 == 0){
        parent.layer.msg($('select[name="district2"]').find('option[value=0]').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }
    if($.trim(address2)==''){
        parent.layer.msg(address_error, {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }

    let res = /^1[34578]\d{9}$/;
    if (!res.test(mobile2)) {
        parent.layer.msg(mobile_error, {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){});  return false;
    }
    let address_id2 = $('.address-list').find('.current').data('id');

        $.post(url,
        {
            'address_id':address_id2,
            'country': country2,
            'province': province2,
            'city': city2,
            'district': district2,
            'address': address2,
            'mobile': mobile2,
            'is_default':is_default2
        },
        function (res) {
            if (res.code == 1) {
                window.location.reload();
            } else {
                layer.msg(res.msg);
                return false;
            }
        }
    );
    return false;

});

// 获取三级地区
$(document).on('click', '#country', function () {
    $("#province").remove();
    $("#city").remove();
    $("#district").remove();
    var c = $(this).val();
    var province_url = $(this).data('province');
    var city_url = $(this).data('city');
    var district_url = $(this).data('district');


    $.post(province_url, {'country': c}, function (rs) {
        if (rs.code == 1) {
            if ($("#province").html()) {
                $("#province").html(add_province(rs.data));
            } else {
                $("#select_td").append(add_province(rs.data));
            }
            $("#province").change(function () {
                $("#city").remove();
                $("#district").remove();
                var c = $(this).val();

                $.post(city_url, {'province': c}, function (rs) {
                    if (rs.code == 1) {
                        if ($("#city").html()) {
                            $("#city").html(add_city(rs.data));
                        } else {
                            $("#select_td").append(add_city(rs.data));
                        }
                        $("#city").change(function () {
                            $("#district").remove();
                            var c = $(this).val();

                            $.post(district_url, {'district': c}, function (rs) {
                                if (rs.code == 1) {
                                    if ($("#district").html()) {
                                        $("#district").html(add_district(rs.data));
                                    } else {
                                        $("#select_td").append(add_district(rs.data));
                                    }

                                    return true;
                                } else {
                                    console.log(rs);
                                    return false;
                                }
                            });
                            return false;
                        });
                        return true;
                    } else {
                        console.log(rs);
                        return false;
                    }
                });
                return false;
            });
            return true;
        } else {
            console.log(rs);
            return false;
        }
    });
    return false;
});
function add_province(item) {
    var _html = '';
    _html += ' <select  name="province" id="province" required>';
    _html += '<option value="0">'+$('#js_choose_province').text()+'</option>';
    for (var i = 0; i < item.length; i++) {
        _html += '<option   value="' + item[i].id + '">' + item[i].name + '</option>';
    }
    _html += '</select>';
    return _html;
}
function add_city(item) {
    var _html = '';
    _html += ' <select  name="city" id="city">';
    _html += '<option value="0">'+$('#js_choose_city').text()+'</option>';
    for (var i = 0; i < item.length; i++) {
        _html += '<option   value="' + item[i].id + '">' + item[i].name + '</option>';
    }
    _html += '</select>';
    return _html;
}
function add_district(item) {
    var _html = '';
    _html += ' <select name="district"  id="district">';
    _html += '<option value="0">'+$('#js_choose_district').text()+'</option>';
    for (var i = 0; i < item.length; i++) {
        _html += '<option   value="' + item[i].id + '">' + item[i].name + '</option>';
    }
    _html += '</select>';
    return _html;
}

/* 上传身份证图片 */
//$('body').on('click','.return-upload',
//  function () {
//      var _this=$(this);
//      var url=_this.data('url');
//      var img_name = _this.data('id');
//      var max_length=_this.data('maxlength');
//      var uploadid=_this.parent().find('.action-upload');
//
//      _this.parent().on('click','.action-remove',function(){
//          $(this).parent().remove();
//          if(_this.parent().find('.handle').length<max_length){
//              uploadid.show();
//          }
//      });
//
//
//      new AjaxUpload(uploadid, {
//          action: url,
//          name: 'file',
//          data:{} ,
//          autoSubmit: true,
//          dataType:'json',
//          responseType:'json',
//          onComplete: function(file, response) {
//
//              var data=response;
//              if(!data.code){
//                  layer.msg(data.msg);return false;
//              }
//              if(_this.parent().find('.handle').length>=max_length-1){
//                  _this.parent().find('.action-upload').hide();
//              }
//              var _html = '<li class="handle img-thumbnail" style="width:220px;height:150px"><i class="icon-close-b action-remove" >×</i><img src="'+data.url+'"><input type="hidden" name="'+img_name+'" value="'+data.url+'"></li>';
//              _this.before(_html);
//          }
//      });
//  }
//);
