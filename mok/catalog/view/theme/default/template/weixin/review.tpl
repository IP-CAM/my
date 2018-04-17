<?php echo $header; ?>
<form action="<?php echo $action;?>" method="post" autocomplete="off" id="ok_evaluate">
    <div class="ok_star_box">
        <span class="ok_star_text"><?php echo $text_evaluation_star;?></span>
        <i class="ok_star ok_star_on"></i>
        <i class="ok_star"></i>
        <i class="ok_star"></i>
        <i class="ok_star"></i>
        <i class="ok_star"></i>
        <input type="hidden" name="rating" id="ok_star_val"/>
    </div>
    <div class="ok_eval_box">
        <p class="ok_eval_text"><?php echo $text_evaluation_word;?></p>
        <input type="hidden" name="product_id" value="<?php echo $product_id;?>" />
        <input type="hidden" name="order_product_id" value="<?php echo $order_product_id;?>" />
        <textarea name="text" maxlength="300" id="ok_eval_val" class="ok_eval_val"  cols="30" rows="10"></textarea>
    </div>
    <div class="ok_eval_img">
        <p class="ok_eval_text"><?php echo $text_evaluation_image;?></p>
        <div class="ok_input_box">
            <ul class="ok_img_list">

            </ul>
            <div class="ok_input_wrap ok_take_wrap">
                <input class="ok_take_photo" id="ok_take_photo" type="file"/>
            </div>
            <div class="ok_input_wrap ok_load_wrap">
                <input class="ok_upload_img" id="ok_load_img" type="file"/>
            </div>
        </div>
    </div>
    <div class="ok_tabbar" id="ok_load_submit"><?php echo $text_submit;?></div>
</form>

<div class="ok_position">
    <div class="ok_pop"></div>
</div>

<?php echo $footer; ?>