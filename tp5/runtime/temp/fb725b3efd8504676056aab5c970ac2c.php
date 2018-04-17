<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\git\my\tp5\public/../site/member/view/pc/default/passport\index.html";i:1505868537;s:68:"D:\git\my\tp5\public/../site/member/view/pc/default/common\base.html";i:1504744427;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		
    <title><?php echo lang('Login'); ?></title>
    
        
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php if(!(empty($meta_keyword) || (($meta_keyword instanceof \think\Collection || $meta_keyword instanceof \think\Paginator ) && $meta_keyword->isEmpty()))): ?>
        <meta name="keywords" content= "<?php echo $meta_keyword; ?>" />
        <?php endif; if(!(empty($meta_description) || (($meta_description instanceof \think\Collection || $meta_description instanceof \think\Paginator ) && $meta_description->isEmpty()))): ?>
        <meta name="description" content= "<?php echo $meta_description; ?>" />
        <?php endif; ?>
        <link rel="icon" href="__ROOT__/favicon.ico" type="image/x-icon" />
        
		<script type="text/javascript">
			//模板静态js路径
			var root = '__ROOT__';
			var RequireParam={
				BaseScriptPath:(root == '') ? '/' : root,
				BaseScript:['jquery', 'public'],
				UpdateCartUrl:"<?php echo url('crossbbcg/carts/update_num'); ?>"
			};
			Private_Script=null
		</script>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/crossbbcg/<?php echo $path; ?>/css/base.css"/>
		<link rel="stylesheet" type="text/css" href="__STATIC__/layer-v3.0.3/skin/default/layer.css"/>
		<link rel="stylesheet" type="text/css" href="__STATIC__/layer-v3.0.3/skin/blue/style.css"/>
		<link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_337798_uqin8ypiig7rpb9.css"/>

	
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/<?php echo $css_path; ?>/passport.css"/>
    
	</head>
	<body>
    
        <?php echo widget('crossbbcg/common/header'); ?>
  
		
    <!--面包屑-->
    <div class="login-main-box">
        <div class="brand-box" style="background-color:#1989eb">
            <!--TODO 随机广告图片-->
            <div class="wraper">
                <a href=""><img src="__PUBLIC__/<?php echo $img_path; ?>/login_3.png" width="512"/></a>
            </div>
        </div>
        
        <div class="wraper clearfix">
            <div class="form-box">
                <div class="login-switch ewm" onclick="$('.qrcode-login,.pc').toggle();$(this).toggle()"></div>
                <div class="login-switch pc" style="display: none;"
                     onclick="$('.qrcode-login,.ewm').toggle();$(this).toggle()"></div>
                <div class="qrcode-login" style="display: none;">
                    <div class="login-title"><?php echo lang('Safe_Telephone_Login'); ?></div>
                    <div class="qrcode-mod">
                        <div class="qrcode-main">
                            <div class="qrcode-img"><img src="<?php echo qrcode(); ?>" style="width:140px;"></div>
                        </div>
                        <div class="qrcode-desc">
                            <?php echo lang('scan_login'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-header">
                    
                    <h1 class="left"><?php echo lang('member_login'); ?></h1>
                    <span class="go-reg right">
                            <a href="<?php echo url('member/passport/signup'); ?>"><?php echo lang('now_register'); ?>&gt;&gt;</a>
                        </span>
                </div>
                <form class="login-form" id="login_form" onsubmit="return false;">
                    <div class="input-line">
                        <!--ajax验证 测试账号 13599999999 可通过-->
                        <span class="input-label"><?php echo lang('mobile'); ?></span>
                        <input id="username" class="form-text"
                               data-ajax="<?php echo url('member/passport/check_mobile',array('scene'=>'login')); ?>" required
                               data-empty="<?php echo lang('telephone_email_input'); ?>" data-error="<?php echo lang('must_telephone_email'); ?>"
                               data-regex="^1[0-9]{10}|\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" name="username"
                               type="text" autocomplete="off" placeholder="<?php echo lang('telephone_or_email'); ?>">
                        <i class="icon-reset">×</i>
                        <div class="input-error"></div>
                    </div>
                    <div class="input-line">
                         <span class="input-label"><?php echo lang('login_password'); ?></span>
                        <input id="password" required class="form-text" name="password" data-empty="<?php echo lang('password_input'); ?>"
                               data-error="<?php echo lang('password_required'); ?>" data-regex="^.{6,18}$" type="password" autocomplete="off"
                               placeholder="<?php echo lang('input 6~18 string'); ?>">
                        <i class="icon-reset">×</i>
                        <div class="input-error"></div>
                    </div>
                    
                    <!--<div style="margin-bottom: 20px;height:44px;">-->
                    <!--<div id="embed-captcha" data-url="<?php echo url('member/passport/gt_login'); ?>"></div>-->
                    <!--<div id="wait" style="height: 42px;text-align: center;line-height: 54px;border: 1px solid #ccc;border-radius: 2px;background-color: #f3f3f3"><img src="__ROOT__/loading.gif" alt=""></div>-->
                    <!--<p id="notice" style="color: red" class="input-error"><?php echo lang('please_verify'); ?></p>-->
                    <!--</div>-->
                    
                    <div class="form-remember">
                        <span class="left">
                            <!--TODO 永久登录-->
                            <input id="rem" class="hidden" type="checkbox" name="remember_me" value="1" checked="">
                            <label class="check-box" for="rem"><?php echo lang('remeber'); ?></label>
                        </span>
                        <a class="right" href="<?php echo url('member/passport/findpwd'); ?>"><?php echo lang('forget_password'); ?>?</a>
                    </div>
                    
                    <div class="form-submit">
                        <button type="button" id="login-btn" class="submit-btn disabled" data-url="<?php echo url('member/passport/index'); ?>"><?php echo lang('Login'); ?></button>
                    </div>
                
                </form>
                <div class="form-footer">
                    <dl>
                        <dt><?php echo lang('Quick_Login'); ?>:</dt>
                        <dd class="qq">
                            <a title="<?php echo lang('Qq'); ?>" href="#" class="iconfont icon-qq"></a>
                            <a title="<?php echo lang('Sina'); ?>" href="#" class="iconfont icon-zfb"></a>
                            <a title="<?php echo lang('Alipay'); ?>" href="#" class="iconfont icon-xinlang"></a>
                        </dd>
                    </dl>
                
                </div>
            </div>
        </div>
    </div>
    

        <?php echo widget('crossbbcg/common/footer'); ?>
			
        
    <script type="text/javascript">
        // 极验证
        
        
        //需要加载的js文件
        Private_Script = ['passport'];
    </script>
    
        <script type="text/javascript" data-main="__PUBLIC__/crossbbcg/<?php echo $path; ?>/js/main" src="__STATIC__/js/require.js" ></script>
        <div class="js_language">
            <span id="js_cart_least"><?php echo lang('js_cart_least'); ?></span>
            <span id="js_cart_more"><?php echo lang('js_cart_more'); ?></span>
            <span id="js_cart_jian"><?php echo lang('js_cart_jian'); ?></span>
            <span id="js_add_cart_success"><?php echo lang('js_add_cart_success'); ?></span>
            <span id="js_choose_sku"><?php echo lang('js_choose_sku'); ?></span>
            <span id="js_ok"><?php echo lang('js_ok'); ?></span>
            <span id="js_no"><?php echo lang('js_no'); ?></span>
            <span id="js_copy_success"><?php echo lang('js_copy_success'); ?></span>
            <span id="js_copy_error"><?php echo lang('js_copy_error'); ?></span>
            <span id="js_again_code"><?php echo lang('js_again_code'); ?></span>
            <span id="js_code_success"><?php echo lang('js_code_success'); ?></span>
        </div>
	</body>
</html>
