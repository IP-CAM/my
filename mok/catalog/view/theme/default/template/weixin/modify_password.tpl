<?php echo $header; ?>
<?php echo $content_top; ?>
<!--地址-->
<form class="ok_form" action="<?php echo $action;?>" autocomplete="off" method="post">
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd">原密码</div>
            <div class="weui-cell__bd">
                <input class="ok_input" id="ok_oriPassword" type="text"/>
                <input name="oriPassword" id="ok_ori" type="hidden"/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">新密码</div>
            <div class="weui-cell__bd">
                <input class="ok_input" id="ok_newPassword" type="text"/>
                <input name="password" id="ok_new" type="hidden"/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">确认新密码</div>
            <div class="weui-cell__bd">
                <input id="ok_surePassword" class="ok_input" type="text"/>
                <input name="confirm" id="ok_sure" type="hidden"/>
            </div>
        </div>
    </div>
    <div class="ok_register">
        确认
    </div>
</form>
<div class="ok_position">
    <div class="ok_pop">
    </div>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>
