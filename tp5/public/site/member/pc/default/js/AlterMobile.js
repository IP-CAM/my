//$('#pwd_form').validateForm($('.submit-btn'));
//点击发送验证码
$('#getcode').click(function(){
    if(!$(this).hasClass('disabled')){
        var obj={};
        var username=$(this).parents('.login-form').find('[name=username]');
        //var captcha=$(this).parents('#signup_form').find('[name=captcha]');
        //这个是验证码的name名称
        //为避免短信滥发需要先写验证码
        //captcha.trigger('blur')
        username.trigger('blur')
        if(!username.parents('.error-triggered').length){
            sendVerify(this,{
                username:username.val()
            });
        }

    }
})
function sendVerify(el, data) {
    var url = $(el).data('url');
    var textCont = $(el);
    var lang = $(el).data('lang-send');
    $(el).addClass('disabled');
    textCont.html($(el).text() + '(<i style="font-size: 14px">0</i>)');
    var cd = new countdown(textCont.find('i'), {
        start: 59,//等待时间
        secondOnly: false,
        callback: function (e) {
            $(el).removeClass('disabled');
            textCont.html(lang);
        }
    });
    $.post(url, data, function (rs) {
        if (rs.code==0) {
            cd.stop();
            $(el).removeClass('disabled');
            textCont.html(lang);
        }

    });
}
/*--    修改密码ajax star    --*/
$("#pwd-btn").click(function() {
    $.ajax({
         type: "POST",
         url: $(this).data('url'),
         data: $(".login-form").serialize(),
         dataType: "json",
         success: function(res){
             if(res.code){
                 layer.msg(res.msg,{
                     skin:'layer-ext-blue',
                     icon:0,
                     time:2000,
                 });
                 location.reload();
             }else {
                 layer.msg(res.msg,{
                     skin:'layer-ext-blue',
                     icon:0,
                     time:2000,
                 });
             }
            return false;
         }
     });
    return false;
});
/*--    修改密码ajax end    --*/

/*--    修改手机ajax star    --*/
$("#mobile-btn").click(function() {
    var username=$(this).parents('.login-form').find('[name=username]').val();
    var url = $(this).data('url');
    $.ajax({
         type: "POST",
         url: url,
         data: $(this).parents('.login-form').serialize(),
         dataType: "json",
         success: function(res){
             if(res.code){
                window.location.href= 'AlterMobileTwo';
             } else {
                 layer.msg(res.msg,{
                     skin:'layer-ext-blue',
                     icon:0,
                     time:2000,
                 });
             }
         }
     });
   return false;
});
$("#mobile-btn-two").click(function() {
    var username=$(this).parents('.login-form').find('[name=username]').val();
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        data: $(this).parents('.login-form').serialize(),
        dataType: "json",
        success: function(res){
            if(res.code){
                window.location.href= 'AlterMobileSuccess';
            }else {
                layer.msg(res.msg,{
                    skin:'layer-ext-blue',
                    icon:0,
                    time:2000,
                });
            }
        }
    });
    return false;
});

/*--    修改手机ajax end    --*/

/*--    绑定手机ajax star    --*/
$("#verify-mobile-one").click(function() {
    var password=$(this).parents('.login-form').find('[name=password]').val();
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        data: $(this).parents('.login-form').serialize(),
        dataType: "json",
        success: function(res){
            if(res.code){
                window.location.href= 'verifyMobile?t=one';
            }else {
                layer.msg(res.msg,{
                    skin:'layer-ext-blue',
                    icon:0,
                    time:2000,
                });
            }
        }
    });
    return false;
});
$("#verify-mobile-two").click(function() {
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        data: $(this).parents('.login-form').serialize(),
        dataType: "json",
        success: function(res){
            if(res.code){
                window.location.href= 'AlterMobileSuccess';
            }else {
                layer.msg(res.msg,{
                    skin:'layer-ext-blue',
                    icon:0,
                    time:2000,
                });
            }
        }
    });
    return false;
});

/*--    绑定手机ajax end     --*/

/*--    绑定邮箱ajax star    --*/
$("#email-btn-one").click(function() {
    var password=$(this).parents('.login-form').find('[name=password]').val();
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        data: $(this).parents('.login-form').serialize(),
        dataType: "json",
        success: function(res){
            if(res.code){
                window.location.href= 'verifyEmail?t=one';
            }else {
                layer.msg(res.msg,{
                    skin:'layer-ext-blue',
                    icon:0,
                    time:2000,
                });
            }
        }
    });
    return false;
});
$("#email-btn-two").click(function() {
    $.ajax({
        type: "POST",
        url:$(this).data('url'),
        data: $(this).parents('.login-form').serialize(),
        dataType: "json",
        success: function(res){console.log(res.code);
            if(res.code){
                window.location.href= 'AlterMobileSuccess';
            }else {
                layer.msg(res.msg,{
                    skin:'layer-ext-blue',
                    icon:0,
                    time:2000,
                });
            }
        }
    });
    return false;
});
/*--    绑定邮箱ajax end     --*/

/*--    修改邮箱ajax star     --*/

$("#alter-email-btn-one").click(function() {
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        data: $(this).parents('.login-form').serialize(),
        dataType: "json",
        success: function(res){
            if(res.code){
                window.location.href= 'AlterEmailTwo?t=one';
            }else {
                layer.msg(res.msg,{
                    skin:'layer-ext-blue',
                    icon:0,
                    time:2000,
                });
            }
        }
    });
    return false;
});
$("#alter-email-btn-two").click(function() {
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        data: $(this).parents('.login-form').serialize(),
        dataType: "json",
        success: function(res){
            if(res.code){
                window.location.href= 'AlterMobileSuccess';
            }else {
                layer.msg(res.msg,{
                    skin:'layer-ext-blue',
                    icon:0,
                    time:2000,
                });
            }
        }
    });
    return false;
});
/*--    修改邮箱ajax end      --*/