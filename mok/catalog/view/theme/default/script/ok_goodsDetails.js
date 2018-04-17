$(function(){
    var $detail = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            $('.lazy').each(function(index){
                var _src = $(this).attr('data-original');
                $(this).attr('src',_src);
            })
            this.sliderImg();
            this.addCollect();
            this.checkBox();
            this.optionNum();
            this.optionCart();
            this.loadMore();
        },
        checkBox:function(){
            $('.ok_checkBox').click(function(){
                if($(this).hasClass('ok_checkBox_selected')){
                    $(this).removeClass('ok_checkBox_selected');
                    $(this).find('input').attr('checked',false);
                }else{
                    $(this).addClass('ok_checkBox_selected').siblings().removeClass('ok_checkBox_selected');
                    $(this).find('input').attr('checked',true);
                    $(this).siblings().find('input').attr('checked',false);
                }
            });
        },
        sliderImg:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width(),
                _H = _W / 640 * 620;
            var $slider = $('.ok_slider');
            var _Li = $slider.find('li').length;
            $slider.height(_H);
            if(_Li > 1){
                var $dot = '<div class="dot">';
                for(var i = 0; i <_Li; i++){
                    $dot +='<span></span>';
                }
                $dot += '</div>';
                $slider.append($dot);
                $slider.swipeSlide({
                    continuousScroll:true,
                    speed : 1500,
                    transitionType : 'cubic-bezier(0.22, 0.69, 0.72, 0.88)',
                    firstCallback : function(i,sum,me){
                        me.find('.dot').children().first().addClass('cur');
                    },
                    callback : function(i,sum,me){
                        me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
                    }
                });
            }
        },
        flyToCart:function(x,y){
            if(!$('.ok_flyimg').is()){
            var offset = $('.ok_cart').offset(),
                imgSrc = $('.ok_slider').find('li').eq(0).find('img').attr('src'),
                flyImg = $('<img class="ok_flyimg" src="'+imgSrc+'"/>');
            flyImg.fly({
                start: {
                    left: x,
                    top: y
                },
                end: {
                    left: offset.left,
                    top: offset.top-$(window).scrollTop()-10,
                    width: 0,
                    height: 0
                },
                onEnd: function(){
                    $('.ok_num').html(Number($('.ok_num').text())+1);
                    flyImg.remove();
                }
            });
            }
        },
        addCart:function($this){
            var product_id = $('#product input[name="product_id"]').val();
                    var quantity = $('#product input[name="quantity"]').val();
                    var _href = $this.attr('data-href')?$this.attr('data-href'):'';
                    $.ajax({
                        url: 'index.php?route=checkout/cart/add',
                        type: 'post',
                        // data: 'product_id='+product_id+'&quantity='+quantity,
                        /* 下面数据需要jquery2.1.1否则报错,下面需要提交选项的值*/
                        data: $('#product input[type="text"], #product input[type="hidden"], #product input[type="radio"]:checked, #product input[type="checkbox"]:checked, #product select, #product textarea'), 
                        dataType: 'json',
                        beforeSend: function() {
                        },
                        complete: function() {
                        },
                        success: function(json) {
                            /* 有错误时,选项必填时, 需要弹窗提示,并页面滑动到相应位置*/
                            // $('.alert, .text-danger').remove();
                            // $('.form-group').removeClass('has-error');
                            
                            if (json['error']) {
                                if (json['error']['option']) {
                                    for (i in json['error']['option']) {
                                        var element = $('#input-option' + i.replace('_', '-'));
                                        if (element.parent().hasClass('input-group')) {
                                            $detail.showPop(json['error']['option'][i]);
                                        } else {
                                            $detail.showPop(json['error']['option'][i]);
                                        }
                                    }
                                }
                                /* 分期付款错误判断 */
                                if (json['error']['recurring']) {
                                    $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                                }
                            }
                            if (json['success'] && _href) {
                                window.location.href = _href;
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $detail.showPop(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
            
        },
        optionNum:function(){
          $('#ok_option_add').click(function(){
            $('.ok_goods_num').html(Number($('.ok_goods_num').text())+1);
            $('#input-quantity').val($('.ok_goods_num').html());
        });
          $('#ok_option_desc').click(function(){
            $('.ok_goods_num').html(Number($('.ok_goods_num').text()>1?Number($('.ok_goods_num').text()):2)-1);
            $('#input-quantity').val($('.ok_goods_num').html());
        });
        },
        showPop:function(html,time){
            time = time?time:400;
            $('.ok_pop_info').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},time)
        },
        addCollect:function(){
            $('.ok_detail_collect').click(function(){
                var product_id = $('#product input[name="product_id"]').val(),
                    $this = $(this);
                $.ajax({
                    url: 'index.php?route=account/wishlist/add',
                    type: 'post',
                    data: 'product_id=' + product_id,
                    dataType: 'json',
                    success: function(json) {
                        if (json['redirect']) {
                            location = json['redirect'];
                        }
                        if (json['success']){
                            if(json.status == 1 || json.status == 3){
                                var _pop = '';
                                $this.attr('src','catalog/view/theme/default/images/goods_detalil/collected.png').attr('data-collect','true'); 
                                $('.ok_tag').removeClass('ok_fail_in').addClass('weui-icon-success-circle');
                                if(json.status == 1){
                                    _pop ='已收藏'; $detail.showPop(_pop);
                                }else{
                                    _pop = '已收藏，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                     $detail.showPop(_pop,2000);
                                }
                            }
                            if(json.status == 2 || json.status == 4){
                                $('.ok_tag').removeClass('weui-icon-success-circle').addClass('ok_fail_in');
                                $this.attr('src','catalog/view/theme/default/images/goods_detalil/collect.png').attr('data-collect','false');
                                if(json.status == 2){
                                    _pop ='已取消收藏'; $detail.showPop(_pop);
                                }else{
                                    _pop = '取消收藏，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                     $detail.showPop(_pop,2000);
                                }
                            }
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $detail.showPop(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            });
        },
        optionCart:function(){
            var arrInp = [],_temp = [],_num = 0,len = $('.ok_detail_info').length-1;
            $('#button-cart').click(function(e){
                if ($('#button-car').hasClass('inactive')) {
                    return false;
                }
                var $this = $(this),
                _x = e.clientX,
                _y = e.clientY;
                $('.ok_detail_post').each(function(index){
                    var _index = index;
                    var $checkArr = $(this).find('.ok_checkBox input[type="radio"]').length>0?$(this).find('.ok_checkBox input[type="radio"]'):$(this).find('.otp-option li');
                    console.log($checkArr);
                    $checkArr.each(function(index){
                        var _checked =$(this).hasClass('selected')?$(this).hasClass('selected'):$(this).attr('checked');
                        console.log(_checked);
                        if(_checked){
                            _temp.push(_index);
                            _num++;
                        }
                    });
                    if(_temp.length == 0){
                        arrInp.push(0);
                        _temp = [];
                    }else{
                        arrInp.push(1);
                        _temp = [];
                    }
                });    
                if(len ==_num){
                    $detail.addCart($this);
                    $detail.flyToCart(_x,_y);
                    arrInp = [];_num = 0;
                }else{
                    for(var i=0,l=len;i<l;i++){
                        if(arrInp[i] == 0){
                            $detail.showPop($('.ok_detail_info').eq(Number(i)).html());
                            arrInp = [];_num = 0;
                            return false;
                        }
                    }    
                }
                
            });
            $('#button-buy').on('click', function() {
                $detail.addCart($(this));
            });
        },
        // 加载
        loadMore:function(){
            var flag = true,
                _id = $('.ok_add_cart').attr('data-id');
            $(window).scroll(function(){
                var docHeight = $(document).height()-50,
                scrollHeight = $(window).height()+$(window).scrollTop();
                if(docHeight<scrollHeight && flag == true){
                    setTimeout(function(){
                        $.ajax({
                            url: 'index.php?route=product/product/down&product_id='+_id,
                            dataType: 'json',
                            beforeSend: function() {},
                            complete: function() {},
                            success: function(json) {
                                $('.ok_img').html(json);
                                $('.ok_detail_comment').show();
                                pushLoad();
                                flag = false;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $detail.showPop(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                        /* 请求评论 */
                        $('#review').load('index.php?route=product/product/review&product_id='+$('#review').attr('data-id'));
                        /* 显示猜你喜欢 */
                        $('#layout').show();
                    },100);  
                    flag = false;
                }
            });
            function pushLoad(){
                var _top = $('.ok_img_text').offset().top;
                $('html,body').animate({scrollTop:_top},200);
                $(window).scroll(function(){
                    if($(window).scrollTop()>_top-$('.ok_tab').height()*1.7){
                        $('.ok_tab').addClass('ok_fix');
                    }else{
                        $('.ok_tab').removeClass('ok_fix');
                    }
                });
                $('.ok_push_load').hide();
                $('.ok_over_tips').show();
                $('.ok_detail_tab').click(function(){
                    $('.ok_tab').addClass('ok_fix');
                    var _index = $(this).index(),
                        _text = $('.ok_img_text').offset().top,
                        _comment = $('.ok_comment').offset().top-$('.ok_tab').height();
                    $(this).addClass('ok_tab_selected').siblings().removeClass('ok_tab_selected');
                    if(_index>0){
                        $('html,body').scrollTop(_comment);
                    }else{
                        $('html,body').scrollTop(_text);
                    }
                });
            }
        }
    };
    document.attachEvent ? document.attachEvent('onreadystatechange') : document.onreadystatechange = function(){
        if(document.readyState == 'complete'){
            $('#load').css('display','none');
        }
    }
    $detail.init();
});
