$(function(){
    var $play = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            $('.lazy').picLazyLoad();
            var _H = _W / 640 * 346;
            this.collect();
        },
        showPop:function(html,time){
            $('.ok_pop_info').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},time)
        },
        collect:function(){
            $('.ok_rec_add').each(function(index){
                var _status = $(this).attr('data-status');
                if(_status == 1){
                    $(this).addClass('ok_rec_success');
                }else{
                    $(this).removeClass('ok_rec_success');
                }
            }).click(function(){
                var $this = $(this);
                var buyer_id = $(this).attr('data-id');
                $.ajax({
                    url:'index.php?route=account/attention_buyer/add',
                    data:{buyer_id:buyer_id},
                    dataType:'json',
                    type:'post',
                    success:function(json){
                        var _pop = '';
                        if(json.status == 1 || json.status == 3){
                                $this.addClass('ok_rec_success');
                                $('.ok_tag').removeClass('ok_fail_in').addClass('weui-icon-success-circle');
                                if(json.status == 1){
                                    _pop ='收藏成功'; $play.showPop(_pop,500);
                                }else{
                                    _pop = '收藏成功，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                     $play.showPop(_pop,2000);
                                }
                        }
                        if(json.status == 2 || json.status == 4){
                            $this.removeClass('ok_rec_success');
                            $('.ok_tag').removeClass('weui-icon-success-circle').addClass('ok_fail_in');
                            if(json.status == 2){
                                _pop ='取消收藏'; $play.showPop(_pop,500);
                            }else{
                                _pop = '取消收藏，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                 $play.showPop(_pop,2000);
                            }
                        }
                    }
                })
            })
        }
    };
    $play.init();
});
