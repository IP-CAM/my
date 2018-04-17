$(function(){
    var $conCollect = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.collect();
        },
        //收藏
        collect:function(){
            $('.ok_collect').tap(function(){
                var $this = $(this),
                    _id = $this.attr('data-id'),
                    _url = 'http://my.okhqb.com/my/getRotaryRewardNew.json?rotaryType=CGJ';
                $.ajax({
                    url: _url,
                    type:'post',
                    dataType:'jsonp',
                    data:{id:_id},
                    success:function(data){
                        data = {status:2};
                        if(data.status == 1){
                            if($(this).hasClass('ok_focus_icon')){
                                $this.addClass('weui-icon-success-no-circle');
                            }else{
                                $this.addClass('ok_collected');
                            }
                        }else if(data.status == 2){
                            if($(this).hasClass('ok_focus_icon')){
                                $this.removeClass('weui-icon-success-no-circle');
                            }else{
                                $this.removeClass('ok_collected');
                            }
                        }
                    }
                });
            })
        }
    };
    $conCollect.init();
});
