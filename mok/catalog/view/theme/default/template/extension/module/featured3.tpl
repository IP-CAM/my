<!-- 猜你喜欢 -->
<div class="ok_cs_box">
	<?php if($title && $title_href){ ?>
    <div class="ok_ban_title">
        <p class="ok_title_first"><?php echo $title; ?></p>
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