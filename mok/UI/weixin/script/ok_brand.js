$(function(){
    var $brand = {
        init:function(){
            var $width = $(window).width()>750?750:$(window).width();
            $('html').css('fontSize',$width/7.5+'px');
            $('.lazy').picLazyLoad();
            this.showMore();
            this.collectBrand();
        },
        //收藏品牌
        collectBrand:function(){
            $('.ok_logo_right').tap(function(){
                var $this = $(this),
                    _url = '';
                if(!$this.hasClass('ok_logo_add')){
                    $this.addClass('ok_logo_add');
                    _url = 'collect';//收藏的接口
                }else{
                    $this.removeClass('ok_logo_add');
                    _url = 'cancel';//取消的接口
                }
                //暂时隐藏
                //$.ajax({
                //    url:_url,
                //    dataType:'',
                //    type:'get',
                //    success:function(){
                //
                //    }
                //});
            });
        },
        //显示更多内容
        showMore:function(){
            $('.ok_show_up').tap(function(){
                var $this = $(this);
                $this.addClass('ok_shoe_down').siblings('.weui-cells').find('.weui-cell').removeClass('ok_hide');
            })
        }
    };
    $brand.init();
});
