<?php echo $header; ?>
<?php echo $content_top; ?>
<form class="ok_form form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" autocomplete="off" id="register">
    <div class="ok_reg">
        <div class="ok_reg_logo">
            <img class="ok_reg_img" src="catalog/view/theme/default/images/login/logo.png"/>
            <p class="ok_logo_info"><?php echo $text_description; ?></p>
        </div>
  
  <div class="alert alert-danger">
  <?php if ($error_warning) { ?>
  <?php echo $error_warning; ?>
  <?php } ?>
  </div>
        <div class="weui-cells ok_input_box">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <input class="ok_input" name="telephone" type="text" placeholder="<?php echo $entry_telephone; ?>" required="required" value="<?php echo $telephone; ?>"/>
                </div>
                <div class="weui-cell__bd">
                    <a href="javascript:;" class="ok_get_code"><?php echo $entry_telephone_captcha; ?></a>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <input class="ok_input" name="telephone_captcha" type="text" placeholder="<?php echo $entry_captcha; ?>" required="required" value="<?php echo $telephone_captcha; ?>"/>
                </div>

            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <input class="ok_input" name="password" type="password" placeholder="<?php echo $entry_password; ?>" required="required" value="<?php echo $password; ?>"/>
                </div>
                <div class="weui-cell__bd">
                    <img class="ok_register_img" src="catalog/view/theme/default/images/login/eye.png"/>
                </div>
            </div>
        </div>
        <div class="ok_register" id="register_submit">
            <?php echo $text_quick_register; ?>
        </div>
    </div>
</form>
<div class="ok_position"> 
    <div class="ok_pop">
        <span class="ok_tag"></span>
        <span class="ok_pop_info"></span>
    </div>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>
