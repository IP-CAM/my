<?php echo $header; ?>
<?php echo $content_top; ?>
<?php
    $pricing_id = $pricing_info['pricing_id'];
?>
<div class="ok_cs_box">
    <img class="lazy" src="<?php echo $show_image;?>" width="100%"/>
    <p class="ok_head_title ok_over"><?php echo $pricing_info['name']?></p>
    <div class="ok_head_info"><?php echo html_entity_decode($pricing_info['description'], ENT_QUOTES, 'UTF-8');
     ?></div>
</div>
<div class="ok_cs_box">
    <p class="ok_price_title"><?php echo $text_product_info;?></p>
    <div class="ok_price_info">
        <a href="<?php echo $product_href;?>">
            <div class="ok_price_left">
                <img src="<?php echo $product_image?>" width="100%">
            </div>
            <p class="ok_price_right">
                <?php echo $product_info['name']?>
            </p>
        </a>
    </div>
    <div class="ok_cs_box">
        <img src="<?php echo 'image/'.$pricing_info['product_image_description']?>" width="100%"/>
    </div>
</div>
<div class="ok_price_box">
    <span class="ok_pri_text"><?php echo $text_join_pricing;?></span>
    <input type="text" class="ok_pri_val" placeholder="<?php echo $text_placeholder;?>"/>
    <a href="javascript:;" class="ok_pri_btn"><?php echo $text_pricing;?></a>
</div>
<?php
    if($pricing_join){
?>
<div class="ok_cs_box">
    <p class="ok_buyer_title"><?php echo $text_latest_price;?></p>
    <div class="weui-cells ok_buyer_list">
        <?php
            foreach($pricing_join as $v){
        ?>
        <div class="weui-cell">
            <div class="weui-cell__hd">

                    <img src="<?php echo $v['head_image'];?>"/>

            </div>
            <div class="weui-cell__bd">

                    <span class="ok_list_name ok_over"><?php echo $v['nickname'];?></span>
                    <span class="ok_list_price"><?php echo $text_pricing;?><span class="ok_price_num">￥<?php echo $v['price'];?></span></span>

            </div>
        </div>
        <?php
            }
        ?>

    </div>
</div>
<?php
}
?>
<input type="hidden" value="<?php echo $pricing_info['pricing_id']?>" id="pricing_id"/>
<div class="ok_position">
    <div class="ok_pop">
        <span class="ok_pop_info"></span>
    </div>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>