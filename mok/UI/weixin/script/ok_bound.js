$(function(){
    var $bound = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.getCode();
        },
        //获取验证码
        getCode:function(){
            var $id = $('input[name="account"]'),
                $code = $('input[name="code"]');
            $('.ok_bound_code').tap(function(){
                if(isNull($id.val())){
                    $id.attr('placeholder','账号不可为空');
                }else{
                    //发送短信接口
                    if(/^1[3|4|5|7|8]\d{9}$/.test($id.val())){
                        $.ajax({
                            url:'../page/home.html',
                            type:'get',
                            dataType:'jsonp',
                            success:function(data){
                                //请求成功
                                $('#ok_bound').tap(function(){
                                    //发送修改验证码
                                    $.ajax({
                                        url:'',
                                        type:'get',
                                        dataType:'jsonp',
                                        success:function(data){
                                            window.loacation.href='修改成功提示';
                                        }
                                    });
                                });

                            }
                        });


                    }else{
                        $id.val('').attr('placeholder','电话号码格式不对');
                    }
                }
            });
            function isNull(val){
                if(val == null || val == ''){
                    return true;
                }else{
                    return false;
                }
            }
        }
    };
    $bound.init();
});
