$(function(){
    var $address = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.chooseOrder();
            this.optionOrder();
        },
        //切换订单类型
        chooseOrder:function(){
            $('.ok_order_header div').tap(function(){
                var _order = $(this).attr('data-order'),
                    $cells = $('.weui-cells');
                $(this).addClass('ok_on').siblings().removeClass('ok_on');
                if(_order == 'all'){
                    $cells.removeClass('ok_hide');
                }else{
                    $cells.each(function(ind){
                        var $this = $(this),
                            _option = $(this).attr('data-option');
                        if(_option != _order){
                            $this.addClass('ok_hide');
                        }else{
                            $this.removeClass('ok_hide');
                        }
                    });
                }
            });
        },
       //订单操作
        optionOrder:function(){
            $('.ok_order_option').tap(function(){
                var $this = $(this),
                    $option = $this.attr('data-option');
                if($option == 'deleteOrder'){
                    deleteOrder($this);
                }else if($option == 'evaluate'){
                    evaluate(1)
                }else if($option == 'cancelOrder'){
                    cancelOrder()
                }else if($option == 'payOrder'){
                    payOrder()
                }else if($option == 'trackOrder'){
                    trackOrder()
                }else if($option == 'sureGoods'){
                    sureGoods()
                }
            });
            function deleteOrder(obj){
                //var $parent = obj.parents('.weui-cells');
                //$parent.remove();
                //发送请求改变内存状态，请求成功则修改删除
                //$.ajax()
                alert('deleteOrder');
            }
            function evaluate(id){
                //携带id或者携带识别码跳转到指定位置
                //window.location.href = '../page/evaluate.html?='+id;
                alert('evaluate');
            }
            function cancelOrder(){alert('cancelOrder');}
            function payOrder(){alert('payOrder');}
            function trackOrder(){alert('trackOrder');}
            function sureGoods(){alert('sureGoods');}
        }
    };
    $address.init();
});
