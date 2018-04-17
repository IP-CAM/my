<?php echo $header; ?>
<?php echo $content_top; ?>

<div class="ok_spec_head">
    <img src="<?php echo $image; ?>" width="100%"/>
    <div class="ok_info_box">
        <p class="ok_head_title"><?php echo $title; ?></p>
       
		<?php echo $description; ?>
	
    </div>
</div>
<?php if(isset($products)) { ?>
	<div class="ok_list">
		<?php foreach($products as $product) { ?>
        <div class="ok_list_item">
            <a href="<?php echo $product['href']; ?>">
                <img class="lazy" data-original="<?php echo $product['thumb']; ?>" src="catalog/view/theme/default/images/public/lazy.png" width="100%"/>
                <p class="ok_cs_info"><?php echo $product['name']; ?></p>
				
		<?php if ($product['price']) { ?>
        <p class="ok_cs_price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
          <?php } ?>
        </p>
        <?php } ?>
            </a>
        </div>
		<?php } ?>
    </div>
<?php } ?>
	
<div class="ok_share">
    <a href="#" class="ok_share_btn">分享有礼</a>
    <p class="ok_share_info">每个专题每天首次分享即可参加抽奖</p>
    <p class="ok_share_info">可获得补光灯一个</p>
    <img class="ok_share_img" src="catalog/view/theme/default/images/public/speical.jpg"/>
</div>

<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>
<script>
    $(function(){
        var _W = $(window).width() > 750 ? 750 : $(window).width();
        $('html').css('fontSize',_W/7.5+'px');
        $('.lazy').picLazyLoad();
    });
</script>