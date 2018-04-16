var current_layer_index = $('.ly-main ').on('click', '.address-table .del', function () {
    var that = $(this);
    layer.confirm(that.attr('data-layer'),
        {
        icon: 3,
        'skin': 'layer-ext-blue',
        title: that.attr('data-title'),
        },
        function (index) {
            $.get(that.attr('href'), function (res) {
                if (res.code) {
                    window.location.reload();
                }
            });
    });
    return false;
}).on('click', '#address_submit', function () {
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
    var front_img = $('input[name="front_img"]').val();
    var verso_img = $('input[name="verso_img"]').val();
    if (!$('.address-form').find('.error-triggered').length) {
        $.post(
            "address_add",
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
                'front_img':front_img,
                'verso_img':verso_img
            },
            function (res) {
                if (res.code == 1) {
                    window.location.reload();
                    return true;
                } else {
                    layer.msg(res.msg);
                    return false;
                }
            }
        );
        return false;
    } else {
        layer.alert($(this).data('error'), {
            icon: 2,
            'skin': 'layer-ext-blue',
            title: $(this).data('title')
        });
    }
})
$('.address-form').validateForm($('#address_submit'));
var current_layer_index = null;
$('body').on('mouseenter', '#show_tips', function () {

    current_layer_index = layer.tips($('.help-pop').html(), '#show_tips', {
        tips: [1, '#78BA32'],
        time: 500000
    });

}).on('mouseout', '#show_tips', function () {
    layer.close(current_layer_index);
})
$("#country").change(function () {
    $("#province").remove();
    $("#city").remove();
    $("#district").remove();
    var c = $(this).val();
    $.post("ajax_get_province", {'country': c}, function (rs) {
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

                $.post("ajax_get_city", {'province': c}, function (rs) {
                    if (rs.code == 1) {
                        if ($("#city").html()) {
                            $("#city").html(add_city(rs.data));
                        } else {
                            $("#select_td").append(add_city(rs.data));
                        }
                        $("#city").change(function () {
                            $("#district").remove();
                            var c = $(this).val();
                            $.post("ajax_get_district", {'district': c}, function (rs) {
                                if (rs.code == 1) {
                                    if ($("#district").html()) {
                                        $("#district").html(add_district(rs.data));
                                    } else {
                                        $("#select_td").append(add_district(rs.data));
                                    }
                                    return true;
                                } else {
                                    return false;
                                }
                            });
                            return false;
                        });
                        return true;
                    } else {
                        return false;
                    }
                });
                return false;
            });
            return true;
        } else {
            return false;
        }
    });
    return false;
});
function add_province(item) {
    var lang = $('#country').data('province');
    var _html = '';
    _html += ' <select  name="province" id="province" required>';
    _html += '<option value="0">'+lang+'</option>';
    for (var i = 0; i < item.length; i++) {
        _html += '<option   value="' + item[i].id + '">' + item[i].name + '</option>';
    }
    _html += '</select>';
    return _html;
}
function add_city(item) {
    var lang = $('#country').data('city');
    var _html = '';
    _html += ' <select  name="city" id="city">';
    _html += '<option value="0">'+lang+'</option>';
    for (var i = 0; i < item.length; i++) {
        _html += '<option   value="' + item[i].id + '">' + item[i].name + '</option>';
    }
    _html += '</select>';
    return _html;
}
function add_district(item) {
    var lang = $('#country').data('area');
    var _html = '';
    _html += ' <select name="district"  id="district">';
    _html += '<option value="0">'+lang+'</option>';
    for (var i = 0; i < item.length; i++) {
        _html += '<option   value="' + item[i].id + '">' + item[i].name + '</option>';
    }
    _html += '</select>';
    return _html;
}

/*修改地址弹窗*/
    $('.edit').click(function () {
        var that = $(this);
        var url  = that.data('url');
        var title = that.data('title');
        layer.open({
            type: 2,
            skin:'layui-layer-molv',
            title:title,
            area: ['710px', '534px'],
            content: url
            , btnAlign: 'c' //按钮居中
        });

    });

$('.upload-ui').each(function(){
    var _this=$(this);
    var url=_this.data('url');
    var name = _this.attr('name');
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
            uploadid.before($('<li class="handle img-thumbnail"><i class="icon-close-b action-remove">×</i><input type="hidden" name="'+name+'" value="'+data.url+'" /><img src="'+data.url+'" alt=""/></li>'));
        }
    });
});
