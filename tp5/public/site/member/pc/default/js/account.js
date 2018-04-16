/**
 * Created by admin on 2017/7/10.
 * To do.
 * Description : 本文件作用
 * @author Fancs
 */

/*地区三级联动 star*/
$(document).ready(function(e) {
    function FillProvince()
    {
        //方法的功能
        var _country = $("#country").val();
        $.post($('#country').data('province_url'),{'country':_country},function(res) {
            if(res.code){
                $("#province").remove();
                $("#city").remove();
                $("#district").remove();
                $("#select_box").append(add_province(res.data));
                $("#city").change(function(){  //这里就是改变区的
                    FillQu();
                    return false;
                });
            }
        });
    }
    function FillShi()
    {
        //方法的功能
        var _province = $("#province").val();
        $.post($('#country').data('city_url'),{'province':_province},function(res) {
            if(res.code){
                $("#city").remove();
                $("#district").remove();
                $("#select_box").append(add_city(res.data));
                $("#city").change(function(){  //这里就是改变区的
                    FillQu();
                    return false;
                });
            }
        });
    }
    //填充区的方法
    function FillQu()
    {
        //方法的功能
        var _city = $("#city").val();
        $.post($('#country').data('area_url'),{'district':_city},function(res) {
            if(res.code){
                $("#district").remove();
                $("#select_box").append(add_district(res.data));
            }
        });
    }


    $("#country").change(function(){  //改变省，下面的市和区显示
        FillProvince();
    });
    $(document).on('change','#province',function () {
        FillShi();
    });
    $(document).on('change','#city',function () {
        FillQu();
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
});
/*地区三级联动 end*/
$('.address-form').validateForm($('#address_submit'));
    $("#address_submit").click(function(){
        var data = $(".address-form").serialize();
        $.ajax({
            type: 'post',
            url: 'address_edit',
            data: data,
            success: function(res) {
                layer.msg(res.msg,{icon:1, time: 2000 ,shade: 0.3},function () {
                    parent.location.reload();
                });
            }
        });
        return false;
    });
var current_layer_index = null;
$('body').on('mouseenter', '#show_tips', function () {

    current_layer_index = layer.tips($('.help-pop').html(), '#show_tips', {
        tips: [1, '#78BA32'],
        time: 500000
    });

}).on('mouseout', '#show_tips', function () {
    layer.close(current_layer_index);
})

