$(function(){
    var $search = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            $('.lazy').picLazyLoad();
            var _H = _W / 640 * 346;
            this.deleteHistory();
        },
        deleteHistory:function(){
            $('.ok_tabbar_txt').tap(function(){
                $.ajax({
                    url:'',
                    type:'get',
                    dataType:'jsonp',
                    success:function(data){
                        $('.ok_history').parent().remove();
                    }
                })
            })
        }
    };
    $search.init();
});
