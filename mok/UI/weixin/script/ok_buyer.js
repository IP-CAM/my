$(function(){
    var $buyer = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            $('.lazy').picLazyLoad();
            var _H = _W / 640 * 346;
            this.collect();
        },
        //收藏
        collect:function(){
            $('.ok_rec_add').tap(function(){
                var $this = $(this),
                    _id = $this.attr('data-id'),
                    _url = 'http://my.okhqb.com/my/getRotaryRewardNew.json?rotaryType=CGJ';
                $.ajax({
                    url: _url,
                    type:'post',
                    dataType:'jsonp',
                    data:{id:_id},
                    success:function(data){
                        data = {status:1};
                        if(data.status == 1){
                            $this.addClass('ok_collected');
                        }else if(data.status == 2){
                            $this.removeClass('ok_collected');
                        }
                    }
                });
            })
        }
    };
    $buyer.init();
});
