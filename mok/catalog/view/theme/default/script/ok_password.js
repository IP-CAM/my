$(function(){
    var $resume = {
        init: function () {
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize', _W / 7.5 + 'px');
            this.surePassword();
        },
        // 弹窗
        showPop:function(html,time){
            time = time?time:400;
            $('.ok_pop').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},time)
        },
        //输入密码
        surePassword:function () {
            $('.ok_input').on('input propertychange',function(){
                var $this = $(this),
                    $siblings = $this.siblings(),
                    _new = '',
                    _old = $(this).val(),
                    _val = '';
                    _siblings = '',
                    _last = _old.toString().charAt(_old.toString().length-1);
                    _val = $siblings.val();
                    console.log(_last);
                    if(_last == "*" || _last == ''|| _old == "*"){
                        _last = '';
                        $siblings.val($siblings.val().substr(0,$siblings.val().toString().length-1));
                    }else{
                        if(_old.length == 1 && _last == "*"){
                            $siblings.val('');
                        }else{
                            $siblings.val(_val+_old.toString().charAt(_old.toString().length-1));
                        }  
                    }
                    for(var i=0,l=$siblings.val().length;i<l;i++){
                        _new += "*";
                    }
                    $this.val(_new);
            });
            $('#ok_newPassword,#ok_surePassword').on('click',function(e){
               var $this = $(this),
                   _ori = $("#ok_ori").val();
                   if(_ori.toString().length < 6 || _ori == '' || _ori == null){
                        $resume.showPop('原密码格式不对');
                        return false;
                   }else{
                        $.ajax({
                            url:'index.php?route=account/password/validatePassword',
                            type: 'post',
                            dataType:"json",
                            data:{'oriPassword':_ori},
                            success:function(data){
                                if(!data){
                                    $resume.showPop('原密码有误');
                                } 
                            }
                        });
                   }
            });
            $(".ok_register").click(function () {
                 var _len1 = $("#ok_new").val(),
                    _ori = $('#ok_ori').val(),
                    _len2 = $("#ok_sure").val();
                if(_ori.length == 0 || _ori == ''){$resume.showPop('原密码不能为空');return false;}
                if(_len1.length == 0 || _len1 == ''){$resume.showPop('新密码不能为空');return false;}
                if(_len2.length == 0 || _len2 == ''){$resume.showPop('确认密码不能为空');return false;}
                if(_len1 != _len2){$resume.showPop('新密码与确认密码不一致');}else{
                    $(".ok_form").submit();
                }
            });
        }
    };
    $resume.init();
});
