$('#login_form').validateForm($('#login-btn'));
$('#signup_form').validateForm($('#signup-btn'));
$('#email_form').validateForm($('#signup-btn'));
$('#pwd_form').validateForm($('#pwd-btn'));
$('.phone-signop-tag,.email-signop-tag').click(function () {
    $('.email-signop-tag').toggle();
    $('.phone-signop-tag').toggle();
    $('#signup_form').toggle().find('.error-triggered').removeClass('.error-triggered');
    $('#email_form').toggle().find('.error-triggered').removeClass('.error-triggered');
});
$('#pwd-btn').click(function () {
    var error = $('#pwd_form').find('.error-triggered');
    if (error.length != 0) {
        return false;
    } else {
        $(this).removeClass('disabled');
    }
    if ($(this).hasClass('disabled')) {
        return false;
    }
    var _username = $("#username").val();
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        data: {'username': _username},
        dataType: "json",
        success: function (res) {
            if (res.code) {
                $('#pwd_form').submit();
            } else {
                layer.msg(res.msg);
            }
        }
    });
    return false;
})
function sendVerify(el, data) {
    var url = $(el).data('url');
    var textCont = $(el);
    $(el).addClass('disabled');
    textCont.html($(el).text() + '(<i style="font-size: 14px;">0</i>)');
    var cd = new countdown(textCont.find('i'), {
        start: 59,//等待时间
        secondOnly: false,
        callback: function (e) {
            $(el).removeClass('disabled');
            textCont.html($(el).data('lang_tip'));
        }
    });
    $.post(url, data, function (rs) {
        if (rs.code == 0) {
            cd.stop();
            $(el).removeClass('disabled');
            textCont.html($(el).data('lang_tip'));
        }
    });
}
// 登录
$("#login-btn").click(function () {
    var error = $('#login_form').find('.error-triggered');
    if (error.length != 0) {
        return false;
    } else {
        $(this).removeClass('disabled');
    }
    if ($(this).hasClass('disabled')) {
        return false;
    }
    var url = $(this).data('url');
    var _lname = $("#username").val();
    var _lpwd = $("#password").val();
    var request_data = {
        name:_lname,
        password:_lpwd
    };

    $.post(url, request_data, function (res) {
        if (res.code == 1) {
            //登录成功，跳转页面
            if(res.url){
                window.location.href=res.url;
            }
        } else {
            // 登录错误
            layer.msg(res.msg, {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){
                if(res.url){
                    window.location.href=res.url;
                }
            });
        }
    });

});
/* 极验证 star */
var handlerEmbed = function (captchaObj) {
    captchaObj.onSuccess(function () {
        var validate = captchaObj.getValidate();
        $('#sendcode').show();
        //点击发送验证码
        $('#getcode').click(function () {
            if (!$(this).hasClass('disabled')) {
                var obj = {};
                var username = $(this).parents('.login-form').find('[name=username]');
                username.trigger('blur');
                if (!username.parents('.error-triggered').length && validate) {
                    sendVerify(this, {
                        username: username.val()
                    });
                }
            }
        });

        // 注册账号
        $("#signup-btn").click(function () {
            if (!validate) {
                $("#notice")[0].className = "show";
                setTimeout(function () {
                    $("#notice")[0].className = "hide";
                }, 2000);
                e.preventDefault();
                return false;
            }
            var error = $('#signup_form').find('.error-triggered');
            if (error.length != 0) {
                return false;
            } else {
                $(this).removeClass('disabled');
            }
            if ($(this).hasClass('disabled')) {
                return false;
            }
            $.ajax({
                url: 'register',
                data: $('#signup_form').serialize(),
                dataType: 'json',
                type: 'POST',
                success: function (res) {
                    if (!res.code) {
                        layer.msg(res.msg);
                        captchaObj.reset(); // 调用该接口进行重置
                    } else {
                        layer.msg(res.msg);
                        setTimeout(function () {
                            window.location.href = res.url;
                        }, 2000);

                    }
                }
            });
            return false;
        });

        // 找回密码
        $(".chang_pwd1").click(function () {
            if (!validate) {
                $("#notice")[0].className = "show";
                setTimeout(function () {
                    $("#notice")[0].className = "hide";
                }, 800);
                e.preventDefault();
                return false;
            }
            var _username = $("#username").val();
            $.ajax({
                type: "POST",
                url: $(this).data('url'),
                data: {'username': _username},
                dataType: "json",
                success: function (res) {
                    if (res.code) {
                        window.location.href = res.url;
                    } else {
                        layer.msg(res.msg);
                        captchaObj.reset(); // 调用该接口进行重置
                    }
                }
            });
            return false;
        });
    });
    // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
    captchaObj.appendTo("#embed-captcha");
    captchaObj.onReady(function () {
        $("#wait").hide();
    });
};
var gt_url  = $('#embed-captcha').data('url');
if (gt_url) {
    $.ajax({
        // 获取id，challenge，success（是否启用failback）
        url: gt_url, // 加随机数防止缓存
        type: "get",
        data: {'t': (new Date()).getTime()},
        dataType: "json",
        success: function (data) {
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                width: '100%',
                gt: data.gt,
                challenge: data.challenge,
                new_captcha: data.new_captcha,
                product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success, // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                lang: data.lang
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerEmbed);
        }
    });
}

/* 极验证 end */


/*----------  找回密码 star------------- */

//findpwdTwo
$(".chang_pwd2").click(function () {
    var username = $(this).parents('.login-form').find('[name=username]').val();
    var captcha = $(this).parents('.login-form').find('[name=code]').val();
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        data: {'username': username, 'code': captcha},
        dataType: "json",
        success: function (res) {
            if (res.code) {
                $('#pwd_form').submit();
            } else {
                layer.msg(res.msg);
                return false;
            }
            return false;
        }
    });
    return false;
});
$(".chang_pwd3").click(function () {
    var password = $(this).parents('.login-form').find('[name=password]').val();
    var repassword = $(this).parents('.login-form').find('[name=repassword]').val();
    var username = $(this).parents('.login-form').find('[name=username]').val();
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        data: {'password': password, 'repassword': repassword, 'username': username},
        dataType: "json",
        success: function (res) {
            if (res.code) {
                layer.msg(res.msg, {
                    time: 2000, //2s后自动关闭
                });
                window.location.href = res.url;
            } else {
                layer.msg(res.msg);
                return false;
            }
            return false;
        }
    });
    return false;
});

/*----------  找回密码 end------------- */