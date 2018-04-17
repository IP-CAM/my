<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="weui-flex ok_collect_head">
    <a href="<?php echo $manufacturer_href;?>" class="weui-flex__item">品牌</a>
    <a href="<?php echo $buyer_href;?>" class="weui-flex__item ok_on">买手</a>
</div>
<!--关注列表-->


    <?php
    if($buyers){
    ?>
<div class="weui-cells">
    <?php
        foreach($buyers as $row){
    ?>
    <div class="weui-cell">
        <div class="weui-cell__hd">
            <a href="<?php echo $row['href'];?>">
                <img src="<?php echo $row['thumb'];?>" width="100%">
            </a>
        </div>
        <div class="weui-cell__bd">
            
                <p class="ok_list_name">
                    <a href="<?php echo $row['href'];?>">
                    <?php echo $row['nickname'];?>
                     </a>
                    <a href="<?php echo $row['remove'];?>"><i class="ok_focus_icon weui-icon-success-no-circle" data-id="<?php echo $row['buyer_id'];?>"></i></a>
                </p>
            
        </div>
    </div>

    <?php
          }
    ?>
</div>
    <?php
        }else{
    ?>
    <div class="ok_empty">
        <div class="ok_empty_info">
            <img class="ok_info_img" src="catalog/view/theme/default/images/public/info.png"/>
        </div>
        <div class="ok_empty_box">
            <img class="ok_box_img" src="catalog/view/theme/default/images/public/box_focus.png"/>
        </div>
        <p class="ok_empty_tip"><?php echo $text_empty;?></p>
    </div>
    <?php
         }
    ?>


<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>