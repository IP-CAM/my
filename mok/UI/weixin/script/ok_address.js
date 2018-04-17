$(function(){
    var $address = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.deleteAddress();
        },
        deleteAddress:function(){
            $('.ok_delete_address').tap(function(){
                $(this).parent().remove();
            });
        }
    };
    $address.init();
});
