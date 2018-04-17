$(function(){
    var W = $(window).width() > 640 ? 640 : $(window).width();
    var H = W / 640 * 265;
    var Li = $('.slider-wrapper').find('li').length;
    $('.slider-wrapper').height(H);
    if(Li > 1){
        var sp = '<div class="dot">';
        for(var i = 0; i <Li; i++){
            sp +='<span></span>';
        }
        sp += '</div>';
        $('.slider-wrapper').append(sp);

        $('.slider-wrapper').swipeSlide({
            continuousScroll:true,
            speed : 3000,
            transitionType : 'cubic-bezier(0.22, 0.69, 0.72, 0.88)',
            firstCallback : function(i,sum,me){
                me.find('.dot').children().first().addClass('cur');
            },
            callback : function(i,sum,me){
                me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
            }
        });
    }
});
