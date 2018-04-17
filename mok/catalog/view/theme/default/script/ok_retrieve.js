$(function(){
    var _document = document.getElementsByTagName('body')[0],
        _load = document.querySelector("#load");
        document.attachEvent ? document.attachEvent('onreadystatechange',CtrlLoad) : document.onreadystatechange = function(){
            if(document.readyState == 'complete'){
                _load.style.display = 'none';
                 console.log(document.readyState)
            }
        }
    var $retrieve = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.getCode();
        },
        showPop:function(html){
            $('.ok_pop_info').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},400)
        },
        //获取验证码
        getCode:function(){
            var $id = $('input[name="telephone"]'),
                $password = $('input[name="password"]'),
                $confirm = $('input[name="confirm"]'),
                _time = 60;
                flag = true;
            $('.ok_get_code').click(function(){
                var $this = $(this);
                if(flag){
                    flag = false;
                    if(isNull($id.val())){
                        $retrieve.showPop('手机号码为空');
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
                                            $this.html('重新获取验证码');
                                            clearInterval(_timer);
                                            _time = 60;
                                        }
                                    },1000);
                                    $('#ok_second').click(function(){
                                        if($confirm.val() == $password.val()){
                                            $('.ok_form').submit();
                                        }else{
                                            $retrieve.showPop('前后两次密码不一致');
                                        }
                                    });
                                },
                                error:function(data){
                                     $retrieve.showPop(data);
                                }
                            });
                        }else{
                            $retrieve.showPop('手机号码格式不对');
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
        }
    };
    $retrieve.init();
});
