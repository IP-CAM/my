$(function(){
    var $resize = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            var _H = _W / 640 * 346;
        }
    };
    $resize.init();
});
