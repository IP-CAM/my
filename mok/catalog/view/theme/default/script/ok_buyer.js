$(function(){
    var $buyer = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            $('.lazy').picLazyLoad();
            var _H = _W / 640 * 346;
            this.collect();
            this.pricing();
        },
        showPop:function(html,time){
            $('.ok_pop_info').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},time)
        },
        collect:function(){
            $('.ok_rec_add').each(function(index){
                var _status = $(this).attr('data-status');
                if(_status == 1 || _status == 3){
                    $(this).addClass('ok_collected');
                }else{
                    $(this).removeClass('ok_collected');
                }
            }).click(function(){
                var $this = $(this);
                var buyer_id = $(this).attr('data-id');
                $.ajax({
                    url:'http://mok.localweb.com/index.php?route=account/attention_buyer/add',
                    data:{buyer_id:buyer_id},
                    dataType:'json',
                    type:'post',
                    success:function(json){
                        var _pop = '';
                        if(json.status == 1 || json.status == 3){
                                $this.addClass('ok_collected');
                                $('.ok_tag').removeClass('ok_fail_in').addClass('weui-icon-success-circle');
                                if(json.status == 1){
                                    _pop ='关注成功'; $buyer.showPop(_pop,500);
                                }else{
                                    _pop = '关注成功，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                     $buyer.showPop(_pop,2000);
                                }
                        }
                        if(json.status == 2 || json.status == 4){
                            $this.removeClass('ok_collected');
                            $('.ok_tag').removeClass('weui-icon-success-circle').addClass('ok_fail_in');
                            if(json.status == 2){
                                _pop ='取消关注'; $buyer.showPop(_pop,500);
                            }else{
                                _pop = '取消关注，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                 $buyer.showPop(_pop,2000);
                            }
                        }
                    }
                })
            })
        },
        pricing:function(){
            $('.ok_pri_btn').click(function () {
                var price = $(this).prev().val();
                var pricing_id = $("#pricing_id").val();
                $.ajax({
                    type: "POST",
                    url: "index.php?route=weixin/pricing/add",
                    data: {"price":price,"pricing_id":pricing_id},
                    dataType: "json",
                    success: function (msg) {
                        $buyer.showPop(msg.text,1000);
                        if(msg.status == 1){
                            var _html = '<div class="weui-cell"><div class="weui-cell__hd"><img src="';
                                _html += msg.head_image;
                                _html += '"></div><div class="weui-cell__bd"><span class="ok_list_name ok_over">';
                                _html += msg.nickname;
                                _html += '</span><span class="ok_list_price">定价<span class="ok_price_num">￥';
                                _html += $('.ok_pri_val').val()+'.00';
                                _html += '</span></span></div></div>';
                            if($('body').is('.ok_buyer_list')){
                                $('.ok_buyer_list').append(_html);
                            }else{
                                $('<div class="ok_cs_box"><p class="ok_buyer_title">最新定价</p><div class="weui-cells ok_buyer_list">'+_html+'</div></div>').insertAfter('.ok_price_box')
                            }
                        } 
                    },
                    error:function(msg){
                        $buyer.showPop(msg,1000);
                    }
                });
            })
        }
    };
    $buyer.init();
});
