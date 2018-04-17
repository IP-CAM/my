<?php echo $header; ?>
<?php echo $content_top; ?>
<body>
<form action="<?php echo $action; ?>" method="post" autocomplete="off" enctype="multipart/form-data" id="ok_evaluate">
    <div class="ok_eval_box">
        <p class="ok_eval_text"><?php echo $entry_enquiry;?></p>
        <textarea name="content" maxlength="500" id="ok_eval_val" class="ok_eval_val"  cols="30" rows="10"></textarea>
    </div>
    <div class="ok_eval_box">
        <input type="text" class="ok_input" id="email" placeholder="<?php echo $entry_email;?>" name="email"/>
    </div>
    <div class="ok_tabbar" id="ok_load_submit"><?php echo $button_submit;?></div>
</form>
<div class="ok_position">
    <div class="ok_pop"></div>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>