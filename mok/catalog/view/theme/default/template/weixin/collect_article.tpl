<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="weui-flex ok_collect_head">
    <a href="<?php echo $goods_href;?>" class="weui-flex__item"><?php echo $text_goods;?></a>
    <a href="<?php echo $article_href;?>" class="weui-flex__item ok_on"><?php echo $text_article;?></a>
</div>

    <?php
        if($articles){
    ?>
<div class="ok_cs_box">
    <?php
            foreach($articles as $row){
    ?>
            <div class="ok_collect_item">
                <a href="<?php echo $row['href'];?>">
                    <img class="lazy" src="<?php echo $row['thumb']?>" width="100%"/>
                </a>
                <div class="ok_item_info">
                    <a href="<?php echo $row['href'];?>" class="ok_info ok_over"><?php echo $row['title'];?></a>
                    <a href="<?php echo $row['remove'];?>">
                        <i class="ok_collect ok_collected"></i>
                     </a>
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
            <img class="ok_box_img" src="catalog/view/theme/default/images/public/box_collect.png"/>
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