<div class="ok_cs_box">
        <div class="ok_cs_title">
            <a href="#">
                <span class="ok_cs__text"><?php echo $heading_title; ?></span>
                <img class="weui-icon-next" src="catalog/view/theme/default/images/home/arrows.png"/>
            </a>
        </div>
        <div class="ok_list">
		<?php foreach ($products as $product) { ?>
            <div class="ok_list_item">
                <a href="<?php echo $product['href']; ?>">
                    <img src="<?php echo $product['thumb']; ?>" width="100%"/>
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
    </div>