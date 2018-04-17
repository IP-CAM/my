<?php echo $header; ?>
<div class="ok_ret_second " >
    <form class="ok_form" action="<?php echo $action;?>" autocomplete="off" method="post">
        <div class="ok_cell_code">
            <p class="ok_ret_title">请输入需要找回密码的账号</p>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <input class="ok_input" name="telephone" type="text" placeholder="请输入手机号" required/>
                    </div>
                </div>
            </div>
            <div class="ok_code">
                <input class="ok_cell_input" type="text" placeholder="请输入短信验证码" name="validate_code"/>
                <span class="ok_get_code">获取验证码</span>
            </div>

        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <input class="ok_input" name="password" type="password" placeholder="新密码" required/>
                </div>
            </div>

            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <input class="ok_input" name="confirm" type="password" placeholder="确认密码" required/>
                </div>
            </div>
        </div>

        <div class="ok_ret_next" id="ok_second">确认</div>
    </form>
</div>
<div class="ok_position"> 
    <div class="ok_pop">
        <span class="ok_tag"></span>
        <span class="ok_pop_info"></span>
    </div>
</div>
<?php echo $footer; ?>