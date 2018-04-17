<?php echo $header; ?>
<?php echo $content_top; ?>
<!--第一部分-->
<div class="ok_ret_first ok_bound">
    <form class="ok_form" action="" autocomplete="off" method="post">
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <input class="ok_input" name="account" type="text" placeholder="请输入账号" required/>
                </div>
                <div class="weui-cell__bd">
                    <p class="ok_bound_code">获取验证码</p>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <input class="ok_input" name="code" type="text" placeholder="验证码" required/>
                </div>
            </div>
        </div>
        <div class="ok_ret_next" id="ok_bound">立即绑定</div>
    </form>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>