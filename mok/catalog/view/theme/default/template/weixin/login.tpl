<?php echo $header; ?>
<?php echo $content_top; ?>
<form class="ok_form" action="<?php echo $action; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    
        <div class="ok_login_logo">
            <img class="ok_login_img" src="catalog/view/theme/default/images/login/logo.png"/>
            <p class="ok_logo_info"><?php echo $text_register_account; ?></p>
        </div>
  <?php if ($success) { ?>
  <div class="alert alert-success"><?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><?php echo $error_warning; ?></div>
  <?php } ?>
        <div class="weui-cells ok_input_box">
            <div class="weui-cell">
                <div class="weui-cell__hd"><img class="ok_input_img" src="catalog/view/theme/default/images/login/name.png"/></div>
                <div class="weui-cell__bd">
                    <input class="ok_input" id="userName" name="email" type="text" placeholder="<?php echo $entry_email; ?>" value="<?php echo $email; ?>"/>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><img class="ok_input_img" src="catalog/view/theme/default/images/login/password.png"/></div>
                <div class="weui-cell__bd">
                    <input class="ok_input" name="password" id="password" type="password" placeholder="<?php echo $entry_password; ?>" value="<?php echo $password; ?>"/>
                    
                </div>
            </div>
        </div>
		
		
		
        <div class="ok_input_submit">
            <?php echo $button_login; ?>
            <input id="ok_submit" type="submit"/>
        </div>
		<div class="ok_res_forget">
			<a href="<?php echo $register; ?>" class="ok_register"><?php echo $text_register; ?></a>
			<a class="ok_forget" href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
		</div>
		
		<div class="ok_third_box" style="display:none;">
			<p class="ok_third_tip">OR</p>
			<div class="weui-flex">
            <a href="#" class="ok_third_side">
                <img src="catalog/view/theme/default/images/public/qq.png" width="100%"/>
            </a>
            <a href="<?php echo $weixin_login;?>" class="weui-flex__item" />
                <img class="ok_third_center" src="catalog/view/theme/default/images/public/weixin.png" width="100%"/>
            </a>
            <a href="#" class="ok_third_side">
                <img src="catalog/view/theme/default/images/public/weibo.png" width="100%"/>
            </a>
			</div>
		</div> 

	
	<?php if ($redirect) { ?>
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
	<?php } ?>
</form>
<div class="ok_position"> 
    <div class="ok_pop">
    </div>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>