$(function(){
    var cart = {
        'update': function(key, quantity) {
            $.ajax({
                url: 'index.php?route=checkout/cart/update',
                type: 'post',
                data: 'key=' + key + '&quantity=' + quantity,
                dataType: 'json',
                beforeSend: function() {
                },
                complete: function() {
                },
                success: function(json) {
                    // Need to set timeout otherwise it wont update the total
                    // setTimeout(function () {
                    //     // $('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
                    // }, 100);
                    location = 'index.php?route=checkout/cart';
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $cart.showPop(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        },
        'remove': function(key) {
            $.ajax({
                url: 'index.php?route=checkout/cart/remove',
                type: 'post',
                data: 'key=' + key,
                dataType: 'json',
                beforeSend: function() {

                },
                complete: function() {

                },
                success: function(json) {
                    // setTimeout(function () {
                    //     // $('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
                    // }, 100); 
                    location = 'index.php?route=checkout/cart';
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $cart.showPop(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    }
    var $cart = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            $('.lazy').picLazyLoad();
            this.deleteCart();
            this.choosePorduct();
            this.optionNum();
            this.alertShow();
        },
        showPop:function(html){
            $('.ok_pop').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},400)
        },
        // 系统提示
        alertShow:function(){
            var flag = $('body').find('.alert').length;
            if(flag>0){
                setTimeout(function(){
                    $('.alert').css('display','none');
                },1000);
            }
        },
        //删除购物车商品
        deleteCart:function(){
            $('.ok_cart_delete').click(function() {
                var $this = $(this),
                    _id = $this.attr('data-id');
                $('.ok_dialog').css('display', 'block');
                $('.weui-dialog__btn_default').click(function(){
                    $('.ok_dialog').hide();
                });
                $('.weui-dialog__btn_primary').click(function(){
                    $('.ok_dialog').hide();
                    cart.remove(_id);
                });
            });
        },
        
        //全选商品
        choosePorduct:function(){
            $('.ok_choose').on('click',function(){
                if($(this).hasClass('ok_all')){
                    $(this).removeClass('ok_all');
                    $('.ok_cart_box').find('.ok_cart_item').removeClass('ok_checked');
                }else{
                    $(this).addClass('ok_all');
                    $('.ok_cart_box').find('.ok_cart_item').addClass('ok_checked');
                }
            });
            $('.ok_cart_check').click(function(){
                if($(this).parent().hasClass('ok_checked')){
                    $(this).parent().removeClass('ok_checked');
                }else{
                    $(this).parent().addClass('ok_checked');
                }

            });
        },
        //调节商品数量
        optionNum:function(){
            $('.ok_num_desc,.ok_num_asc').on('click',function(){
                var _id = $(this).attr('data-id'),
                    _num = $(this).attr('data-quantity'),
                    $num = Number($(this).siblings('.ok_num').val()),
                    _min = Number($(this).siblings('.ok_num').attr('data-min')),
                    _max = Number($(this).siblings('.ok_num').attr('data-max'));
                    
                    if($(this).hasClass('ok_num_desc')){
                        $num -= 1;
                    }
                    if($(this).hasClass('ok_num_asc')){
                        $num += 1;
                    }
                    if($num<_min){ 
                        $cart.showPop('不能小于最小购买数');
                        return false;
                    }else if($num>_max){ 
                        $cart.showPop('超出库存');
                        return false;
                    }else if($num>_min || $num==_min && $num<_max || $num==_max || $num==1 && $num == _min){
                        cart.update(_id,_num); 
                    }
            });

            $('.ok_num').change(function(){
                var $this =  $(this);
                var _id = $(this).siblings('.ok_num_asc').attr('data-id'),
                    $num = Number($(this).val()),
                    _min = Number($(this).attr('data-min')),
                    _max = Number($(this).attr('data-max'));
                    if($num==1 && _min != 1 || $num<_min){ 
                        $cart.showPop('不能小于最小购买数');
                        return false;
                    }else if($num>_max){ 
                        $cart.showPop('超出库存');
                        return false;
                    }else if($num>_min || $num==_min && $num<_max || $num==_max){
                        cart.update(_id,$num); 
                    }
            });
        }
    };
    $cart.init();
});
