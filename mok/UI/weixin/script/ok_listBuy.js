$(function(){
    var $width = $(window).width()>750?750:$(window).width();
    $('html').css('fontSize',$width/7.5+'px');
    var $slider = $('.ok_list_nav');
    $slider.swipeSlide({
        autoSwipe: false,
        continuousScroll:false,
        speed : 3000,
        transitionType : 'cubic-bezier(0.22, 0.69, 0.72, 0.88)',
        callback : function(i,sum,me){
        	var _li = me.find('li').eq(i);
            _li.children().addClass('ok_nav_on');
            _li.siblings().children().removeClass('ok_nav_on');
        }
    });
});