$(function(){
    var $brand = {
        init:function(){
            var $width = $(window).width()>750?750:$(window).width();
            $('html').css('fontSize',$width/7.5+'px');
            $('.lazy').picLazyLoad();
            this.showMore();
            this.collectBrand();
        },
        //显示弹窗
        showPop:function(html,time){
            time = time?time:400;
            $('.ok_pop_info').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},time)
        },
        //收藏品牌
        collectBrand:function(){
            $('.ok_logo_right').click(function(){
                var $this = $(this),
                    _url = '';
                var manufacturer_id = $('#manufacturer_id').val();
                //暂时隐藏
                $.ajax({
                   url:'index.php?route=account/attention_manufacturer/add',
                   data:{manufacturer_id:manufacturer_id},
                   dataType:'json',
                   type:'post',
                   success:function(json){
                        var _pop = '';
                        if(json.status == 1 || json.status == 3){
                                $this.addClass('ok_logo_add');
                                $('.ok_tag').removeClass('ok_fail_in').addClass('weui-icon-success-circle');
                                if(json.status == 1){
                                    _pop ='关注成功'; $brand.showPop(_pop,500);
                                }else{
                                    _pop = '关注成功，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                     $brand.showPop(_pop,2000);
                                }
                        }
                        if(json.status == 2 || json.status == 4){
                            $this.removeClass('ok_logo_add');
                            $('.ok_tag').removeClass('weui-icon-success-circle').addClass('ok_fail_in');
                            if(json.status == 2){
                                _pop ='取消关注'; $brand.showPop(_pop,500);
                            }else{
                                _pop = '取消关注，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                 $brand.showPop(_pop,2000);
                            }
                        }
                    },
                    error:function(msg){
                        $brand.showPop(msg,2000);
                    }
                });
            });
        },
        //显示更多内容
        showMore:function(){
            $('.ok_show_up').click(function(){
                var $this = $(this),
                $siblings = $this.siblings('.weui-cells').find('.weui-cell');
                if($this.hasClass('ok_show_down')){
                    for(var i=3,l=$siblings.length;i<l;i++){
                        $siblings.eq(i).addClass('ok_hide');
                    }
                    $this.removeClass('ok_show_down');
                }else{
                  $this.addClass('ok_show_down').siblings('.weui-cells').find('.weui-cell').removeClass('ok_hide');  
                }
            })
        }
    };
    $brand.init();
});
