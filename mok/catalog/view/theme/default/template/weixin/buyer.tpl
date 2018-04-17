<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="ok_cs_box">
    <div class="ok_play_ban">
        <div class="ok_ban_content">
            <img class="lazy" src="<?php echo $buyer_info['show_image'];?>" width="100%"/>
        </div>
        <div class="ok_reco_title weui-flex">
            <div class="ok_rec_tag">
                <img src="<?php echo $buyer_info['head_image'];?>"/>
            </div>
            <div class="weui-flex__item">
                <span class="ok_play_name"><?php echo $buyer_info['nickname'];?></span>
                <p class="ok_focus_goods"><span class="ok_goods"><?php echo $product_total.$entry_product;?></span><span class="ok_focus"><?php echo $attention_total.$entry_attention;?></span></p>
            </div>
            <div class="ok_rec_add" data-status="<?php echo $is_attention;?>" data-id="<?php echo $buyer_info['buyer_id'];?>"></div>
        </div>
        <p class="ok_ban_title"><?php echo $buyer_info['introduce'];?></p>
        <div class="ok_store">
            <img class="ok_store_img" src="catalog/view/theme/default/images/my/store.png"/>
        </div>
    </div>
</div>
<div class="ok_cs_box">

    <?php
        if($blogs){
            foreach($blogs as $row){
    ?>
    <div class="ok_recommend">
        <div class="ok_reco_content">
            <a href="<?php echo $row['href'];?>">
                <div class="ok_reco_img">
                    <img class="lazy" src="<?php echo $row['thumb'];?>" data-original="<?php echo $row['thumb'];?>" width="100%"/>
                </div>
                <div class="ok_reco_info">
                    <p class="ok_reco_name ok_over"><?php echo $row['title'];?></p>
                    <p class="ok_reco_date"><?php echo $row['published_time'];?></p>
                </div>
            </a>
        </div>
    </div>
    <?php
            }
       }
    ?>

</div>
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