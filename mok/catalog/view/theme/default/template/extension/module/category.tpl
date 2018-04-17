<div class="weui-grids">
  <?php foreach ($categories as $category) { ?>
    <a href="<?php echo $category['href']; ?>" class="weui-grid">
            <div class="weui-grid__icon">
                <img width="100%" src="<?php echo $category['src']; ?>"/>
            </div>
            <p class="weui-grid__label"><?php echo $category['alt']; ?></p>
    </a>
  <?php } ?>
</div>
