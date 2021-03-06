<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"D:\git\my\tp5\public/../site/admin/view/passport\login.html";i:1505876663;}*/ ?>
<!DOCTYPE html>
<html class="h100">
	<head>
		<meta charset="UTF-8" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<title><?php echo (isset($meta_title) && ($meta_title !== '')?$meta_title:''); ?> | <?php echo lang('cmfname'); ?></title>
		<link href="__ROOT__/favicon.ico" type="image/x-icon" rel="shortcut icon">
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/style.css" />
		<!-- jquery files -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
		<![endif]-->
        <!--[if gte IE 9]><!-->
		<script type="text/javascript" src="__JS__/jquery-2.1.4.min.js"></script>
		<!--<![endif]-->
		<script type="text/javascript" src="__JS__/jquery-ui.min.js"></script>
		<!-- tooltip files -->
		<script type="text/javascript" src="__JS__/jquery.tipTip.min.js"></script>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/tipTip.css" />
		<!-- site js main files -->
		<script type="text/javascript">/*<![CDATA[*/var cookiePath = "__ROOT__/"; /*]]>*/</script>
		<script type="text/javascript" src="__PUBLIC__/admin/js/main.js"></script>
        <script type="text/javascript" src="__STATIC__/layer-v3.0.3/layer.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    </head>

	<body class="h100" style="background: url(__PUBLIC__/admin/images/bg.jpg) center no-repeat; background-size:cover; overflow: hidden; ">
		<div class="signup-contant">
		

		<div id="content" class="login" >

            <h1></h1>
            <div class="alert alert-info" style="font-size: 16px; padding-left: 20px;">
                <?php echo lang('Admin_tip'); ?>
            </div>
            <form name="Login" id="Login" method="post" style="margin-top:0px;" onsubmit="return false;">
                <div class="fl" style="width: 350px; min-height: 200px;">
                    <img src="http://192.168.1.101/cmallcity/public/app/desktop/statics/images/login.png" <?php if($verify == '1'): ?> height="256px;" <?php endif; ?> />
                </div>
                
                <div class="fl">
                    <div class="row">
                        <i class="icon-login-user"></i>
                        <input placeholder="<?php echo lang('Username'); ?>" maxlength="32" autocomplete="off" type="text" name="username"  />
                    </div>
                    
                    <div class="row">
                        <i class="icon-login-pwd"></i>
                        <input placeholder="<?php echo lang('Password'); ?>" maxLength="20" type="password" name="password" />
                    </div>
                    
                    <div class="row verifycode" style="border: 0;padding: 0;<?php if($verify == '0'): ?>display: none;<?php endif; ?>">
                        <div id="embed-captcha" data-url="<?php echo url('/admin/passport/gt'); ?>"></div>
                        <div id="wait" style="height: 42px;text-align: center;line-height: 54px;border: 1px solid #ccc;border-radius: 2px;background-color: #f3f3f3"><img src="__ROOT__/loading.gif" alt="" style="width: 60px;height: 23px;margin: 0;float: inherit"></div>
                    </div>
                    
                    <div class="checkboxes-wrapper" style="width:auto;">
                        <input type="checkbox" value="1" name="remember" id="remember" />
                        <label for="remember"><?php echo lang('Remember_me'); ?></label>
                    </div>
                    
                    <div class="buttons-wrapper bw-bottom" style="margin: 0;float: inherit;text-align: center;width: 100%">
                        <input value="<?php echo lang('Login'); ?>" type="submit" name="submit"  style="padding:5px 30px; margin-top: 15px;" />
                    </div>
                
                </div>
            
            </form>
            <div class="clear"></div>
		</div>
		<div class="cmf">
			<a href="javascript:void(addFavorite());"><i class="fa fa-heart"></i> <?php echo lang('Add love collection'); ?></a>
            <a href="javascript:void(createShortcut());"><i class="fa fa-share-square"></i> <?php echo lang('Create shortcuts'); ?></a>
		</div>
		</div>
	</body>
    <script type="text/javascript" src="__STATIC__/js/gt.js"></script>
    <script>
	$(function(){
		$("#Login").on("focus", "input", function(){
            $(this).closest('.row').addClass('focus');
        }).on("blur","input",function(){
            $(this).closest('.row').removeClass('focus');
        });
        
        var handlerEmbed = function (captchaObj) {
            $('input[name="submit"]').click(function () {
                if ($('input[name="username"]').val() == ''){
                    layer.msg("<?php echo lang('pleace input username'); ?>");
                    return false;
                }
                if ($('input[name="password"]').val() == '') {
                    layer.msg("<?php echo lang('pleace input password'); ?>");
                    return false;
                }
                <?php if($verify == '1'): ?>
                var validate = captchaObj.getValidate();
                if (!validate) {
                    layer.msg("<?php echo lang('please_verify'); ?>");
                    e.preventDefault();
                    return false;
                }
                <?php endif; ?>
                var data = $('#Login').serialize();
                $.ajax({
                    url: "<?php echo url('/admin/passport/login'); ?>",
                    type:'post',
                    data: data,
                    beforeSend: function(){
                        $(this).val('<?php echo lang("Logining"); ?>');
                    },
                    success: function (res) {
                        if (res.code == 1){
                            window.location.href=res.url;
                        } else {
                            captchaObj.reset();
                            layer.msg(res.msg,{icon:2,time:2000},function () {
                                /*if (res.verify){
                                
                                }*/
                                window.location.reload();
                            });
                            return false;
                        }
                    },
                    dataType: 'json'
                });
            })
            captchaObj.onSuccess(function () {
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
                    initGeetest({
                        width: '100%',
                        gt: data.gt,
                        challenge: data.challenge,
                        new_captcha: data.new_captcha,
                        product: "float",
                        offline: !data.success,
                        lang: data.lang
                    }, handlerEmbed);
                }
            });
        }

        void function(){
            var sURL = location.href;
            var sTitle = document.title;
            addFavorite = function(){
                try
                {
                    window.external.addFavorite(sURL, sTitle);
                }
                catch (e)
                {
                    try
                    {
                        window.sidebar.addPanel(sTitle, sURL, "");
                    }
                    catch (e)
                    {
                        var c = "ctrl";
                        if(navigator.platform.match(/mac/i)){
                            c = "command"
                        }
                        alert("<?php echo lang('Create collection'); ?>");
                    }
                }
                return false;
            }
            createShortcut = function(){

                var sname  =  document.title.replace(/\s/ig,'');
                var surl   =   location.href;
                document.createshortcuts.furl.value = surl;
                document.createshortcuts.fname.value = sname;
                document.createshortcuts.submit();
            }
        }();

    })
	</script>
    <form action="<?php echo url('passport/shortcuts'); ?>" name="createshortcuts" target="_blank" method="post">
        <input type="hidden" name="furl" value=""/>
        <input type="hidden" name="fname" value=""/>
    </form>
</html>