<?php echo $header; ?>
<!--评论列表-->
<div class="weui-cells">
    <?php
        if($review_products){
            foreach($review_products as $row){
    ?>
    <div class="weui-cell">
        <div class="weui-cell__hd">
            <a href="#">
                <img src="<?php echo $row['product_image'];?>" width="100%">
            </a>
        </div>
        <div class="weui-cell__bd">
            <a href="#">
                <div class="ok_list_left">
                    <p class="ok_goods_info">
                        <span class="ok_name"><?php echo $row['product_name'];?></span>
                        <span class="ok_goods_version"><?php echo $row['version'];?></span>
                    </p>
                    <p class="ok_goods_price"><?php echo $row['price'];?></p>
                </div>
            </a>
            <?php
               if($row['is_review']==0){
           ?>
            <a href="<?php echo $row['review_href'];?>" class="ok_list_right"><?php echo $text_evaluation_view;?></a>
            <?php
               }else if($row['is_review']==1){
           ?>
            <a href="javascript;:" class="ok_list_right ok_has_comment"><?php echo $text_have_evaluation;?></a>
            <?php
            }
            ?>
    </div>
     <?php
        }
            }
     ?>
</div>
<?php echo $footer; ?>