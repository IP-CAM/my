<?php echo $header; ?>
<?php echo $content_top; ?>

	<?php if ($categories) { ?>
	<div class="ok_list_nav">
        <ul>			
        <?php foreach ($categories as $category) { ?>
			<?php if($category['category_id'] == $child_id){ ?>
			<li><a href="<?php echo $category['href']; ?>" class="ok_nav_text ok_nav_on"><?php echo $category['name']; ?></a></li>
			<?php }else{ ?>
			<li><a href="<?php echo $category['href']; ?>" class="ok_nav_text"><?php echo $category['name']; ?></a></li>
			<?php } ?>
        <?php } ?>
		</ul>
    </div>
    <?php } ?>
	<input type="hidden" value="<?php echo $child_id; ?>" id="ok_id"/>
	<input type="hidden" value="2" id="ok_page"/>
	<?php if ($thumb) { ?>
	<div class="ok_list_ban">
        <img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" width="100%"/>
    </div>
    <?php } ?>
	
	<div class="ok_cs_box">
		<?php if ($description) { ?>
		<h3 class="ok_list_title ok_over"><?php echo $description; ?></h3>
        <?php } ?>
		
		<?php if ($products) { ?>
        <div class="ok_list">
			<?php foreach ($products as $product) { ?>
            <div class="ok_list_item">
                <a href="<?php echo $product['href']; ?>">
					<?php if($product['thumb']) { ?>
                    <img src="<?php echo $product['thumb']; ?>" width="100%"/>
					<?php } ?>
                    <p class="ok_cs_info"><?php echo $product['name']; ?></p>
					
					<?php if ($product['price']) { ?>
					<p class="ok_cs_price">
					<?php if (!$product['special']) { ?>
					<?php echo $product['price']; ?>
					<?php } else { ?>
					<span class="price-new"><?php echo $product['special']; ?></span> 
					<span class="price-old"><?php echo $product['price']; ?></span>
					<?php } ?>
					</p>
					<?php } ?>
                </a>
            </div>
			<?php } ?>
        </div>

		<?php } ?>
    </div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>



