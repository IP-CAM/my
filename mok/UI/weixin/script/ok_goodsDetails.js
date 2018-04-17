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
            this.addCart();
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
        flyToCart:function(){
            var offset = $('.ok_cart').offset(),
                imgSrc = $('.ok_slider').find('li').eq(0).find('img').attr('src'),
                flyImg = $('<img class="ok_flyimg" src="'+imgSrc+'"/>');
            flyImg.fly({
                start: {
                    left: event.pageX,
                    top: event.pageY
                },
                end: {
                    left: offset.left+10,
                    top: offset.top+10,
                    width: 0,
                    height: 0
                },
                onEnd: function(){
                    $('.ok_num').html(Number($('.ok_num').text())+1);
                    flyImg.remove();
                }
            })
        },
        addCart:function(){
            var arrInp = [],_temp = [],_num = 0,len = $('.ok_detail_info').length-1;
            $('.ok_add_cart').click(function(){  
                $('.ok_detail_post').each(function(index){
                    var _index = index;
                    $(this).find('.ok_checkBox input[type="radio"]').each(function(index){
                        if($(this).attr('checked')){
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
                    $detail.flyToCart();
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
        },
        optionNum:function(){
          $('#ok_option_add').click(function(){$('.ok_goods_num').html(Number($('.ok_goods_num').text())+1);$('#input-quantity').val($('.ok_goods_num').html());});
          $('#ok_option_desc').click(function(){$('.ok_goods_num').html(Number($('.ok_goods_num').text()>1?Number($('.ok_goods_num').text()):2)-1);$('#input-quantity').val($('.ok_goods_num').html());});
        },
        showPop:function(html){
            $('.ok_pop').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},400)
        },
        addCollect:function(){
            $('.ok_detail_collect').click(function(){
               var _charge = $(this).attr('data-collect');
                if(_charge == 'true'){
                    $(this).attr('src','catalog/view/theme/default/images/goods_detalil/collect.jpg').attr('data-collect','false');
                    $detail.showPop('已取消收藏');
                }else{
                    $(this).attr('src','catalog/view/theme/default/images/goods_detalil/collected.png').attr('data-collect','true');
                    $detail.showPop('已收藏');
                }
                var product_id = $('#product input[name="product_id"]').val();
                $.ajax({
                    url: 'index.php?route=account/wishlist/add',
                    type: 'post',
                    data: 'product_id=' + product_id,
                    dataType: 'json',
                    success: function(json) {
                        $('.alert').remove();
                        if (json['redirect']) {
                            location = json['redirect'];
                        }
                        if (json['success']) {
                            $('.ok_push_load').before('<div class="alert alert-success"> ' + json['success'] + ' </div>');
                            /* 下面这句JS无效需要调整 */
                            $('.wish_add').removeClass('wish_add').addClass('wish_delete');
                        }
                        console.log(json);

                        //$('html, body').animate({ scrollTop: 0 }, 'slow');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            });
        },
        optionCart:function(){
        // 用户未登录时:
        // 弹窗提示登录
        // 布局上要放到A标签外面
        // 用户已登录:
        // 1 防止多次恶意点击,连续点击6次,js 弹窗提示操作频繁,cookie周期一个小时
        // 2 成功收藏提示
        // 3 成功取消提示
            // $('#button-cart').on('click', function() {
            //     var product_id = $('#product input[name="product_id"]').val();
            //     var quantity = $('#product input[name="quantity"]').val();
            //     $.ajax({
            //         url: 'index.php?route=checkout/cart/add',
            //         type: 'post',
            //         // data: 'product_id='+product_id+'&quantity='+quantity,
            //         /* 下面数据需要jquery2.1.1否则报错,下面需要提交选项的值*/
            //         data: $('#product input[type="text"], #product input[type="hidden"], #product input[type="radio"]:checked, #product input[type="checkbox"]:checked, #product select, #product textarea'), 
            //         dataType: 'json',
            //         beforeSend: function() {
            //             //$('#button-cart').button('loading');
            //             // console.log(product_id,quantity);
            //         },
            //         complete: function() {
            //             //$('#button-cart').button('reset');
            //         },
            //         success: function(json) {
            //             /* 成功加入购物车需要弹窗提示,选项必填时需要弹窗提示,并页面滑动到相应位置*/
            //             $('.alert, .text-danger').remove();
            //             $('.form-group').removeClass('has-error');
            //             if (json['error']) {
            //                 if (json['error']['option']) {
            //                     for (i in json['error']['option']) {
            //                         var element = $('#input-option' + i.replace('_', '-'));
            //                         if (element.parent().hasClass('input-group')) {
            //                             element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
            //                         } else {
            //                             element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
            //                         }
            //                     }
            //                 }
            //                 /* 分期付款错误判断 */
            //                 if (json['error']['recurring']) {
            //                     $('select[name="recurring_id"]').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
            //                 }

            //                 // Highlight any found errors
            //                 $('.text-danger').parent().addClass('has-error');
            //             }

            //             if (json['success']) {
            //                 $('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

            //                 $('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

            //                 $('html, body').animate({ scrollTop: 0 }, 'slow');

            //                 $('#cart > ul').load('index.php?route=common/cart/info ul li');
            //             }
                        
            //         },
            //         error: function(xhr, ajaxOptions, thrownError) {
            //             alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            //         }
            //     });
            // });
            $('#button-buy').on('click', function() {
                    var product_id = $('#product input[name="product_id"]').val();
                    var quantity = $('#product input[name="quantity"]').val();
                    $.ajax({
                        url: 'index.php?route=checkout/cart/add',
                        type: 'post',
                        // data: 'product_id='+product_id+'&quantity='+quantity,
                        /* 下面数据需要jquery2.1.1否则报错,下面需要提交选项的值*/
                        data: $('#product input[type="text"], #product input[type="hidden"], #product input[type="radio"]:checked, #product input[type="checkbox"]:checked, #product select, #product textarea'), 
                        dataType: 'json',
                        beforeSend: function() {
                            //$('#button-cart').button('loading');
                            //console.log(product_id,quantity);
                        },
                        complete: function() {
                            //$('#button-cart').button('reset');
                        },
                        success: function(json) {
                            /* 有错误时,选项必填时, 需要弹窗提示,并页面滑动到相应位置*/
                            $('.alert, .text-danger').remove();
                            $('.form-group').removeClass('has-error');

                            if (json['error']) {
                                if (json['error']['option']) {
                                    for (i in json['error']['option']) {
                                        var element = $('#input-option' + i.replace('_', '-'));
                                        if (element.parent().hasClass('input-group')) {
                                            element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                        } else {
                                            element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                        }
                                    }
                                }
                                /* 分期付款错误判断 */
                                if (json['error']['recurring']) {
                                    $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                                }

                                // Highlight any found errors
                                $('.text-danger').parent().addClass('has-error');
                            }
                            
                            if (json['success']) {
                                //location = '<?php echo $shopping_cart; ?>';
                            } 
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
            });
        },
        loadMore:function(){
            var flag = true;
            $(window).scroll(function(){
                var docHeight = $(document).height()-50,
                scrollHeight = $(window).height()+$(window).scrollTop();
                if(docHeight<scrollHeight && flag == true){
                    setTimeout(function(){
                        $.ajax({
                    url: 'index.php?route=product/product/down&product_id=<?php echo $product_id; ?>',
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
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                        /* 请求评论 */
                        $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');
                        /* 显示猜你喜欢 */
                        $('#layout').show();
                    },100);  
                    flag = false;
                }
            });
            function pushLoad(){
                var _top = $('.ok_detail_comment').offset().top;
                $('html,body').animate({scrollTop:_top},200);
                $(window).scroll(function(){
                    if($(window).scrollTop()>_top){
                        $('.ok_tab').addClass('ok_fix');
                    }else{
                        $('.ok_tab').removeClass('ok_fix');
                    }
                });
                $('.ok_detail_tab').click(function(){
                    $('.ok_tab').addClass('ok_fix');
                    var _index = $(this).index(),
                        _text = $('.ok_img_text').offset().top,
                        _comment = $('.ok_comment').offset().top-$('.ok_tab').height()*1.7;
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
    $detail.init();
});
