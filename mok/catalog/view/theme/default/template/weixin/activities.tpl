<?php echo $header; ?>
<!--评论列表-->
<div class="weui-cells">
     <?php
        if($activities){
            foreach($activities as $row){
    ?>
    <div class="weui-cell">
        <div class="ok_tag"><?php echo $text_my_pricing;?></div>
        <div class="weui-cell__hd">
            <a href="<?php echo $row['pricing_href'];?>">
                <img src="<?php echo 'image/'.$row['show_image'];?>" width="100%">
            </a>
        </div>
        <div class="weui-cell__bd">
            <a href="#">
                <div class="ok_list_left">
                    <p class="ok_goods_info"><?php echo $row['name'];?></p>
                    <p class="ok_goods_price"><?php echo $text_my_pricing;?>:<span class="ok_price">￥<?php echo $row['price'];?></span></p>
                </div>
            </a>
            <a href="#" class="ok_list_right"><?php echo $text_pricing_start;?></a>
        </div>
    </div>
    <?php
            }
      }else{
            echo $text_no_activities;
      }
    ?>
</div>

<?php echo $footer; ?>