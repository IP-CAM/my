$(function(){
    var $order = {
        //入口
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            // this.chooseAddress();
            this.chooseCoup();
        },
        //选择优惠券
        chooseCoup:function(){
            var _arr = $order.defaultCoup();
            sureCoup(_arr[1],_arr[0]);
            $('.ok_coup_item').click(function(){
                var $this = $(this),
                    _ind = $this.index(),
                    _num = $this.find('.ok_left_num').text();
                sureCoup(_ind,_num);
            });
            $('.ok_default_coup').click(function(){
                var $coup = $('.ok_coup');
                if($coup.hasClass('ok_hide')){
                    $coup.removeClass('ok_hide');
                }else{
                    $coup.addClass('ok_hide');
                }

            });
            function sureCoup(ind,num){
                $('.ok_coup').find('.ok_coup_item').eq(ind).addClass('ok_coup_use').siblings().removeClass('ok_coup_use');
                $('.ok_default_coup span').text(num);
            }
        },
        //默认优惠券
        defaultCoup:function(){
            var _maxCoup = 0,
                _ind = 0,
                arr = [];
            $('.ok_left_num').each(function(ind){
                var _num = Number($(this).html());
                if(_num>_maxCoup){
                    _maxCoup = _num;
                    _ind = ind;
                }
            });
            arr.push(_maxCoup,_ind);
            return arr;
        }
    };
    $order.init();
});
