$(function(){
    var _login = {
        init:function(){
            this.bindEvent();
            $('.ok_code').hide();
        },
        bindEvent:function(){
            $('.ok_login_input').on('click',function(){
                $('#ok_tip').hide();
                $(this).addClass('ok_input_focus').parent().siblings().find('.ok_login_input').removeClass('ok_input_focus');
            });
            $('#ok_change_checkImg').on('click',function(){
                $('#vimg').attr('src','http://canvas.okhqb.com/captcha/captchaImage.html?s='+Math.random());
            });
            $('#ok_login_submit').on('click',function(){
                sentAjax();
            });
            $(window).on('keyup',function(e){
                if(e.keyCode === 13){
                    $('#ok_login_submit').trigger('click');
                }
            });
            function sentAjax(){
                if(checkAccount($('#userName'),'请输入您的昵称/邮箱/手机号') && checkAccount($('#password'),'请输入您的密码')){
                    var $data = $('form[name="loginform"]').serializeArray(),
                        $url = 'http://m.okhqb.com/member/login.json?forward=http%3A%2F%2Fm.okhqb.com%2Fmy%2Fmember.html';
                    $('#ok_tip').show().html('<p>正在登录，请稍后<i class="weui-loading"></i></p>');
                    $.ajax({
                        type:'POST',
                        url:$url,
                        dataType:"jsonp",
                        success:function(data){
                            if(data.code == 500){
                                $('#ok_tip').show().html('<p>'+data.msg+'！</p>');
                            }else if(data.code == 500 && $url.indexOf('forward=')>0){
                                window.location.href = 'home.html';
                            }
                        },
                        error:function(status){

                        }
                    });
                }
            }
            function checkAccount(obj,html){
                if(isNull(obj.val())){
                    $('#ok_tip').show().html('<p>'+html+'！</p>');
                    return false;
                }else{
                    return true;
                }
            }
            function isNull(len){
                if(len==null || len.length==0){
                    return true;
                }else{
                    return false;
                }
            }
            function setCookies(name){

            }
        }
    };

    _login.init();
});