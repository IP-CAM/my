<?php echo $header; ?>

<!--头部-->
<header class="ok_order_header weui-flex">
    <div class="ok_all ok_on" data-order="all"><?php echo $text_all;?></div>
    <div class="weui-flex__item ok_pay" data-order="pay"><?php echo $text_not_payment;?></div>
    <div class="weui-flex__item ok_goods " data-order="goods"><?php echo $text_not_receiving;?></div>
    <div class="ok_evaluate" data-order="evaluate"><?php echo $text_no_evaluation;?></div>
</header>
<div class="ok_cs_box">
    <?php
    if($orders){
        foreach($orders as $row){
    ?>
    <div data-option="<?php if($row['status_id']== 0 || $row['status_id']== 1){ echo 'pay'; }else if($row['status_id']== 15){ echo 'goods';}else if($row['status_id']== 5 && $row['is_review'] == 1){ echo 'evaluate' ;};?>" class="weui-cells">
        <!--标题-->
        <div class="weui-cell ok_title">
            <div class="weui-cell__hd">
                <p class="ok_order_date"><?php echo $row['date_added'];?></p>
            </div>
            <div class="weui-cell__bd">
                <p class="ok_order_kind"><?php echo $row['status'];?></p>
            </div>
        </div>
        <!--内容----商品循环输出-->
            <?php
                foreach($row['goods'] as $v){
            ?>
        <div class="weui-cell ok_content">
            <div class="weui-cell__hd">
                <a href="<?php echo $v['goods_href'];?>">
                    <img src="<?php echo $v['thumb'];?>" width="100%"/>
                </a>
            </div>
            <div class="weui-cell__bd">
                <a href="<?php echo $v['goods_href'];?>">
                    <p class="ok_order_name"><?php echo $v['name'];?></p>
                    <p class="ok_order_price"><?php echo $v['price'];?><span class="ok_gift_num"><i>x</i><?php echo $v['quantity'];?></span> </p>
                </a>
            </div>
        </div>
            <?php
                }
            ?>
        <!--底部----商品循环输出结束--->
        <div class="weui-cell ok_bottom">
            <div class="weui-cell__hd">
                <p class="ok_order_total"><?php echo $column_total;?>: <span><?php echo $row['total'];?></span></p>
            </div>
            <?php
                if($row['status_id'] == 0 || $row['status_id'] == 1){
            ?>
                <div class="weui-cell__bd">
                    <span data-option="cancelOrder" class="ok_order_option"><?php echo $text_cancel;?></span>
                    <span data-option="payOrder" class="ok_order_option ok_option_on">付款</span>
                </div>
            <?php
               }else if($row['status_id'] ==5){
            ?>
                <div class="weui-cell__bd">
                    <a class="ok_order_option" href="<?php echo $row['delete'];?>"/><?php echo $text_delete_the_order;?></a>
                    <?php
                        if($row['is_review'] == 1){
                   ?>
                    <a href="<?php echo $row['review_href'];?>" class="ok_order_option ok_option_on"><?php echo $text_to_evaluate;?></a>
                    <?php
                        }
                   ?>
                </div>
             <?php
                }else if($row['status_id'] ==15){
            ?>
            <div class="weui-cell__bd">
                <a href="<?php echo $row['express_href'];?>" class="ok_order_option"><?php echo $text_track_the_logistics;?></a>
                <span data-option="payOrder" class="ok_order_option ok_option_on"><?php echo $text_confirm_the_goods;?></span>
            </div>
            <?php
            }else{
            ?>
            <div class="weui-cell__bd">
                <span data-option="payOrder" class="ok_order_option ok_option_on"><?php echo $text_delete_the_order;?></span>
            </div>
            <?php
                }
            ?>

        </div>
    </div>
    <?php
            }
        }
    ?>

<?php echo $footer; ?>