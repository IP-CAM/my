/**
 * 购物车脚本
 * wanghualong
 */
// 判断店铺的选中状态，改变店铺下面的商品选中状态  cart.js
$('.t .ly-mcElectBundle').click(function(){
    var choose = $(this).is(':checked');
    if(choose == true){
        $(this).parents('.item-box').find('input[name="items[]"]').attr('checked',true);
    }else{
        $(this).parents('.item-box').find('input[name="items[]"]').attr('checked',false);
    }
});

// 全部选中状态  cart.js
$('.all-check').click(function(){
    var choose = $(this).is(':checked');
    if(choose == true){
        $('.cart-main input[type="checkbox"]').attr('checked',true);
    }else{
        $('.cart-main input[type="checkbox"]').attr('checked',false);
    }
});

// 收藏店铺,收藏商品 最后合并到product.js
$('.attention').on('click',function(){
    var url = $(this).attr('data-url');
    $.ajax({
        url: url,
        type:'post',
        dataType:'json',
        success: function(data){
            // 收藏成功
            if (data.code==1) {
                parent.layer.msg(data.msg, {skin:'layer-ext-blue',icon:1, time: 2000 ,shade: 0.3}, function(){});
            }else{
                // 未登陆
                // toolbarParam.showMinLogin(url); 登陆小窗口

                parent.layer.msg(data.msg, {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){
                    if(data.url){
                        parent.location.href=data.url;
                    }
                });
            }

        }
    });
});

// 改变购物车商品的选中状态   cart.js
$(document).on('click','.cart-main input[type="checkbox"]',function(){
    changeSelected();
    changeChecked();
});
// 购物车页面，店铺勾选和全选的状态 cart.js
$(document).ready(function(){
    changeChecked();
});

// 删除购物车的商品 cart.js
$(document).on('click', '.cart-delete', function () {
    var url = $(this).data('url');
    var that = $(this);
    layer.msg($('#js_cart_delete').text(), {
        skin: 'layer-ext-blue', icon: 0,
        time: 0,
        btn: [$('#js_ok').text(), $('#js_no').text()],
        yes: function (index) {
            layer.close(index);
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    // 删除成功
                    if (data['code']) {
                        that.parents('.goods-item').remove();
                        changeSelected();
                    } else {
                        // 删除失败
                        window.location.reload();
                    }
                }
            });
        }
    });
});

// 批量删除购物车中选中的商品 cart.js
$('.cart-delete-more').on('click', function () {
    var url = $(this).data('url');
    var that = $(this);

    var cart_id = [];
    var validate = false;
    $('.cart-main input[name="items[]"]:checked').each(function(){
        cart_id.push($(this).val());
        validate = true;
    });

    if(validate){
        layer.msg($('#js_cart_choose_delete').text(), {
            skin: 'layer-ext-blue', icon: 0,
            time: 0,
            btn: [$('#js_ok').text(), $('#js_no').text()],
            yes: function (index) {
                layer.close(index);
                $.ajax({
                    url: url,
                    //traditional : false, //传递数组
                    type: 'post',
                    data: {'cart_id':cart_id},
                    dataType: 'json',
                    success: function (data) {
                        window.location.reload();
                    }
                });
            }
        });
    }else{
        parent.layer.msg($('#js_cart_please_choose_delete').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){
        });
    }

});

// 更新购物车 总价，总重量，总件数，总税收，选中件数  cart.js
function changeSelected(){
    var items = [];
    $('.cart-main input[name="items[]"]:checked').each(function(){
        items.push($(this).val());
    });
    var url = $('#changeSelected').val();

    $.ajax({
        type: 'post',
        url: url,
        data: {'items':items},
        dataType: 'json',
        success: function (data) {
            // 如果购物车中没有商品了
            if($('.cart-main input[name="items[]"]').length === 0){
                window.location.reload();
            }else{
                $('#all_selected').text(data.all_selected);
                $('#all_weight').text(data.all_weight);
                $('#all_price').text(data.all_price);
                $('#all_tax').text(data.all_tax);
                update_cart_num(data.all_count);
            }
        }
    });
}

// 改变购物车中商品的选中状态 cart.js
function changeChecked(){
    $('.item-box .b').each(function(){
        var input_l = $(this).find('input[name="items[]"]').length;
        var checked_l = $(this).find('input[name="items[]"]:checked').length;
        if(input_l === checked_l){
            $(this).parent('.item-box').children('.t').find('input[type="checkbox"]').attr('checked',true);
        }else{
            $(this).parent('.item-box').children('.t').find('input[type="checkbox"]').attr('checked',false);
        }

    });

    var seller_input = $('.seller-check').length;
    var seller_checked_input = $('.seller-check:checked').length;
    if(seller_input ===  seller_checked_input){
        $('.all-check').attr('checked',true);
    }else{
        $('.all-check').attr('checked',false);
    }
}

// 购物车中，增加，减少单个商品的数量
$('.addcat-item .btn-flat').click(function () {
    changeCartNum($(this));
    changeSelected();
});

$('.action-quantity-input').change(function(){
    var ipt = $(this),
        max = parseInt(ipt.attr('max')),
        min = parseInt(ipt.attr('min')),
        val = parseInt(ipt.val());
    if(!/^\d+$/.test(val)) {
        ipt.val(min);
    } else if(val > max) {
        ipt.val(max);
    } else if(val < min) {
        ipt.val(min);
    }
    changeCartNum($(this));
    changeSelected();
});

function changeCartNum(el) {

    var ipt = el.parent().find('.action-quantity-input'),
        num = parseInt(ipt.val()),
        cart_id = parseInt(ipt.data('cart-id')),
        url = el.parent().find('.action-quantity-input').data('url');
    var max = parseInt(ipt.attr('max')),
        min = parseInt(ipt.attr('min'));

    if(el.hasClass('btn-increase')) num++;
    if(el.hasClass('btn-decrease')) num--;

    if(!/^\d+$/.test(num)) {
        num = min;
    } else if(num > max) {
        num = max;
    } else if(num < min) {
        num = min;
    }

    var request_data = {
        cart_id: cart_id,
        num : num
    };
    // 购物车数不能为0
    if(num) {
        $.ajax({
            type: 'post',
            url: url,
            data: request_data,
            dataType: 'json',
            success: function (json) {

                if (json['redirect']) {
                    window.location.href = json['redirect'];
                }  else if (json['subtotal']) {
                    el.parents('.goods-item').find('.subtotal').text(json['subtotal']);
                }

            }
        });
    }
}





// 购物车页面提交订单  购物车  cart.js
$('#carts_checkout').click(function () {

    // 获取商品选中状态的id
    var items = [];
    var url = $(this).data('url');
    $('input[name="items[]"]:checked').each(function () {
        items.push($(this).val()); //向数组中添加元素
    });

    if(items.length === 0 ){
        parent.layer.msg($('#js_cart_please_choose').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){
        });
    }else{
        // ajax 跳转到订单页面  items 提交购物车中选中的商品id，数组
        window.location.href = url;
    }

});