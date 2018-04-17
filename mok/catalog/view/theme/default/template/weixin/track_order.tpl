<?php echo $header; ?>
<!--头部-->
<div class="weui-cells ok_head">
    <div class="weui-cell">
        <div class="weui-cell__hd">
            <a href="<?php echo $product_href;?>">
                <img src="<?php echo $image;?>" width="100%">
            </a>
        </div>
        <div class="weui-cell__bd">
            <a href="<?php echo $product_href;?>">
                <p class="ok_order_info"><?php echo $express_company;?></p>
                <p class="ok_order_info">运单号: <?php echo $content['nu'];?></p>
            </a>
        </div>
    </div>
</div>
<!--物流信息-->
<div class="ok_track">
    <p class="ok_track_title">物流详情</p>
    <?php
        foreach($content['data'] as $row){
    ?>
    <div class="ok_track_item">
        <p class="ok_item_info ok_on"><?php echo $row['context'];?></p>
        <p class="ok_item_date"><?php echo $row['time'];?></p>
    </div>
    <?php
        }
    ?>
</div>
<?php echo $footer; ?>