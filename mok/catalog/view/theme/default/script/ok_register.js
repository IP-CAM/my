$(function(){
    var $register = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.getCode();
            this.submitForm();

        },
        showPop:function(html){
            $('.ok_pop_info').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},400)
        },
        //获取验证码
        getCode:function(){
            var $id = $('input[name="telephone"]'),
                $code = $('input[name="telephone_captcha"]'),
                $password = $('input[name="password"]'),
                _time = 60;
                flag = true;
            $('.ok_get_code').click(function(){
                var $this = $(this);
                if(flag){
                    flag = false;
                    if(isNull($id.val())){
                        $register.showPop('手机号码为空');
                        flag = true;
                    }else{
                    //发送短信接口
                        if(/^1[3|4|5|7|8]\d{9}$/.test($id.val())){
                            $.ajax({
                                url:'index.php?route=extension/module/sms_meilian/getValidateMessage',
                                type:'post',
                                data: {telephone:$id.val(),type:'forgotten'},
                                success:function(data){
                                    clearInterval(_timer);
                                    var _timer = setInterval(function(){
                                        if(_time>0){
                                            _time --;
                                            $this.html(_time+'s后重新发送');
                                        }else{
                                            $this.html('重新获取');
                                            clearInterval(_timer);
                                            _time = 60;
                                        }
                                    },1000);
                                    $('#register_submit').click(function(){
                                        if(!isNull($code.val()) && !isNull($password.val())){
                                            $('.ok_form').submit();
                                        }else{
                                            $register.showPop('验证码或密码不可为空');
                                        }
                                    });
                                },
                                error:function(data){
                                    $retrieve.showPop(data);
                                }
                            });
                        }else{
                            $register.showPop('手机号码格式不对');
                            
                        }
                        flag = true;
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
        },
        submitForm:function(){
            $('.ok_register_img').click(function(){
                var _type = $('input[name="password"]').attr('type');
                if(_type == 'password'){
                    $('input[name="password"]').attr('type','text');
                    $(this).attr('src','catalog/view/theme/default/images/login/eye.png');
                }else{
                    $('input[name="password"]').attr('type','password');
                    $(this).attr('src','catalog/view/theme/default/images/login/eye.png')
                }
            });
            if($('.ok_reg').find('.alert')){
                $('.alert ').remove();
            }
            $('.ok_reg').click(function(){
                if($('.ok_reg').find('.alert')){
                    $('.alert ').remove();
                }
            });
            $('#register_submit').click(function(){
                if(!/^1[3|4|5|7|8|9]\d{9}\$/.test($('.ok_input_box .weui-cell').eq(0).find('input').val())){
                    $register.showPop('电话号码格式不对');
                }else if($('.ok_input_box .weui-cell').eq(1).find('input').val() == null || $('.ok_input_box .weui-cell').eq(1).find('input').val() == ''){
                    $register.showPop('验证码不可为空');
                }else if($('.ok_input_box .weui-cell').eq(2).find('input').val() == null || $('.ok_input_box .weui-cell').eq(2).find('input').val() == ''){
                    $register.showPop('密码不可为空');
                }else{
                    $('.ok_form').submit();
                } 
            });
        }
    };
    $register.init();
});
