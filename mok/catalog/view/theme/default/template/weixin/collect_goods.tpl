<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="weui-flex ok_collect_head">
    <a href="<?php echo $goods_href;?>" class="weui-flex__item ok_on"><?php echo $text_goods;?></a>
    <a href="<?php echo $article_href;?>" class="weui-flex__item"><?php echo $text_article;?></a>
</div>

    <?php
      if($products){
      ?>
        <div class="weui-cells">
    <?php
       foreach ($products as $product) {
    ?>

    <div class="weui-cell">
        <div class="weui-cell__hd">
            <a href="<?php echo $product['href']; ?>">
                <img src="<?php echo $product['thumb']; ?>" width="100%">
            </a>
        </div>
        <div class="weui-cell__bd">
            <a href="<?php echo $product['href']; ?>" class="ok_order_name"><?php echo $product['name']?></a>
            <p class="ok_order_price"><a href="<?php echo $product['href']; ?>"><?php echo $product['price']?></a><a href="<?php echo $product['remove']; ?>"><i class="ok_collect" data-id="1111"></i></a></p>
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