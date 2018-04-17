$(function(){
    var $address = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.deleteAddress();
        },
        showPop:function(html,time){
            $('.ok_pop').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},time)
        },
        deleteAddress:function(){
            $('.ok_delete_icon a').tap(function(e){
                var $sblings = $(this).parent().parent().siblings(),
                _href = $(this).attr('data-href');
                if($sblings.find('.ok_user_default').length>0){
                    console.log($sblings.find('.ok_user_default').length,$sblings);
                    $address.showPop('默认地址不可删除',700);
                   return false;
                }else{
                    window.location.href = _href;
                }
            });
        }
    };
    $address.init();
});
