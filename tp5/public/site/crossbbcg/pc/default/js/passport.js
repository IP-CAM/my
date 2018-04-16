$('#login_form').validateForm($('#login-btn'))
$('#signup_form').validateForm($('#signup-btn'))
$('#email_form').validateForm($('#signup-btn'))
$('#pwd_form').validateForm($('.submit-btn'))
$('.phone-signop-tag,.email-signop-tag').click(function () {
    $('.email-signop-tag').toggle();
    $('.phone-signop-tag').toggle();
    $('#signup_form').toggle().find('.error-triggered').removeClass('.error-triggered');
    $('#email_form').toggle().find('.error-triggered').removeClass('.error-triggered');
})
//点击发送验证码
$('#getcode').click(function () {
    if (!$(this).hasClass('disabled')) {
        var obj = {};
        var username = $(this).parents('.login-form').find('[name=username]');
        //var captcha=$(this).parents('#signup_form').find('[name=captcha]');
        //这个是验证码的name名称
        //为避免短信滥发需要先写验证码
        //captcha.trigger('blur')
        username.trigger('blur')
        if (!username.parents('.error-triggered').length) {
            sendVerify(this, {
                username: username.val()
                //captcha:captcha.val()
            })
        }

    }
})
function sendVerify(el, data) {
    console.log(data)
    var url = $(el).data('url');
    var textCont = $(el);
    $(el).addClass('disabled');
    textCont.html($(el).text() + '(<i class="red">0</i>)');
    var cd = new countdown(textCont.find('i'), {
        start: 60,//等待时间
        secondOnly: false,
        callback: function (e) {
            $(el).removeClass('disabled');
            textCont.html('重发验证码');
        }
    });
    $.post(url, data, function (rs) {
        if (rs.code == 0) {
            cd.stop();
            $(el).removeClass('disabled');
            textCont.html('重发验证码');
        }

    });
}

/* 极验证 star */
var handlerEmbed = function (captchaObj) {
    captchaObj.bindForm('.login_form');
    // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
    captchaObj.appendTo("#embed-captcha");
    captchaObj.onReady(function () {
        $("#wait")[0].className = "hide";
    });
    $("#login-btn").click(function (e) {
        var validate = captchaObj.getValidate();
        if (!validate) {
            $("#notice")[0].className = "show";
            setTimeout(function () {
                $("#notice")[0].className = "hide";
            }, 2000);
            e.preventDefault();
            return false;
        }

        var _lname = $("#username").val();
        var _lpwd = $("#password").val();
        $.post("login", {'name': _lname, 'password': _lpwd}, function (res) {
            if (res.code == 1) {
                //登录成功，跳转到首页
                var _url = $("#url").val();
                window.history.back(-1);
                console.log(res);
                return false;
            } else {
                console.log(res.msg);
                return false;
            }
        });
        return false

    });
    //ajax提交数据
    $("#signup-btn").click(function () {
        var validate = captchaObj.getValidate();
        if (!validate) {
            $("#notice")[0].className = "show";
            setTimeout(function () {
                $("#notice")[0].className = "hide";
            }, 2000);
            e.preventDefault();
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
                } else {
                    layer.msg(res.msg);
                    var _url = $("#dump_url").val();
                    setTimeout(function () {
                        window.location.href = _url;
                    }, 2000);

                }
            }
        });
        return false;
    });
    $(".chang_pwd1").click(function () {
        var validate = captchaObj.getValidate();
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
            url: "findpwd",
            data: {'username': _username},
            dataType: "json",
            success: function (res) {
                if (res.code) {
                    window.location.href = 'findpwdTwo?username=' + _username;
                } else {
                    layer.msg(res.msg);
                }
            }
        });
        return false;
    });
    // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html

};
$.ajax({
    // 获取id，challenge，success（是否启用failback）
    url: "gt_login", // 加随机数防止缓存
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
            lang: data.lang,
            // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
        }, handlerEmbed);
    }
});
/* 极验证 end */

/*----------  找回密码 star------------- */

//findpwdTwo
$(".chang_pwd2").click(function () {
    var username = $(this).parents('.login-form').find('[name=username]').val();
    var captcha = $(this).parents('.login-form').find('[name=smscode]').val();
    $.ajax({
        type: "POST",
        url: 'findpwdTwo',
        data: {'username': username, 'code': captcha},
        dataType: "json",
        success: function (res) {
            if (res.code) {
                window.location.href = 'findpwdThree?username=' + username;
            } else {
                layer.msg(res.msg);
                return false;
            }
            console.log(res);
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
        url: 'findpwdThree',
        data: {'password': password, 'repassword': repassword, 'username': username},
        dataType: "json",
        success: function (res) {
            if (res.code) {
                layer.msg('更换成功，前往登陆', {
                    time: 2000, //2s后自动关闭
                });
                window.location.href = 'index';
            } else {
                layer.msg(res.msg);
                return false;
            }
            console.log(res);
            return false;
        }
    });
    return false;
});
$()

/*----------  找回密码 end------------- */