<!-- 爆款推荐 -->
<div class="ok_cs_box">
	<?php if($title && $title_href){ ?>
    <div class="ok_cs_title">
            <a href="<?php echo $title_href; ?>">
                <span class="ok_cs__text"><?php echo $title; ?></span>
                <img class="weui-icon-next" src="catalog/view/theme/default/images/home/arrows.png" width="100%"/>
            </a>
    </div>
	<?php } ?>
    <div class="ok_list">
		<?php foreach ($products as $product) { ?>
			<div class="ok_list_item">
                <a href="<?php echo $product['href']; ?>">
                    <img class="lazy" data-original="<?php echo $product['thumb']; ?>" src="catalog/view/theme/default/images/public/lazy.png" width="100%"/>
                    <p class="ok_cs_info"><?php echo $product['name']; ?></p>
                    <p class="ok_cs_price"><?php echo $product['price']; ?></p>
                </a>
            </div>
		<?php } ?>
    </div>
</div>