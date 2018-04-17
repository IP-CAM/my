<?php echo $header; ?>
<body>
<div class="ok_position">
    <div class="ok_pop"></div>
</div>
<form action="<?php echo $action;?>" autocomplete="off" method="post" id="ok_evaluate">

    <div class="ok_eval_box">
        <p class="ok_eval_text">我有话要说：</p>
        <textarea name="text" maxlength="300" id="ok_eval_val" class="ok_eval_val"  cols="30" rows="10"></textarea>
    </div>

    <div class="ok_tabbar" id="ok_load_submit">提交</div>
</form>

<?php echo $footer; ?>