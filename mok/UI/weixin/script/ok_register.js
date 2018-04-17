$(function(){
    var $pay = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.checkPhone();
        },
        checkPhone:function(){
            var $num = $('input[name="cellNumber"]'),
                $code = $('input[name="code"]'),
                $password = $('input[name="password"]');
            $('.ok_register').tap(function(){
                if(isNull($num.val())){
                    $num.attr('placeholder','电话号码为空');
                }else if(isNull($code.val())){
                    $code.attr('placeholder','验证码为空');
                }else if(isNull($password.val())){
                    $password.attr('placeholder','密码为空');
                }else{
                    $('.ok_form').submit();
                }
            });
            $('.ok_get_code').tap(function(){
                var _num = $num.val();
                if(isNull(_num)){
                    $num.attr('placeholder','电话号码为空');
                }else{
                    if(/^1[3|4|5|7|8]\d{9}$/.test(_num)){
                        $.ajax()//获取验证码
                    }else{
                        $num.val('').attr('placeholder','电话号码格式不对');
                    }
                }
            });
            $('.ok_register_img').tap(function(){
                var $input = $(this).parent().parent().find('input[name="password"]'),
                    _type = $input.attr('type');
                if(_type == 'password'){
                    $input.attr('type','text');
                }else{
                    $input.attr('type','password');
                }
            });
            $code.click(function(){
                if(isNull($num.val())){
                    $num.attr('placeholder','电话号码为空');
                }
            });
            function isNull(val){
                if(val == null || val.length == 0){
                    return true;
                }else{
                    return false;
                }
            }
        }
    };
    $pay.init();
});
