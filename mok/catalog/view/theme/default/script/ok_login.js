$(function(){
    var $login = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.checkName();
            this.alertShow();
        },
        showPop:function(html){
            $('.ok_pop').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},600)
        },
        // 系统提示
        alertShow:function(){
            var flag = $('body').find('.alert').length;
            if(flag>0){
                setTimeout(function(){
                    $('.alert').css('display','none');
                },1000);
            }
        },
        checkName:function(){
        	$('#userName').focus(function(){
        		$(this).blur(function(){
        			var _val = $(this).val(),
        				_regexEmail =  /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/,
        				_regexPhone = /^1[3|4|5|7|8]\d{9}$/;
        			if(!_regexEmail.test(_val)){
        				if(!_regexPhone.test(_val)){
        					$login.showPop('手机号码或者邮箱格式不对！');
        				}
        			}
        		}); 
        	});
        }
    };
    $login.init();
});
