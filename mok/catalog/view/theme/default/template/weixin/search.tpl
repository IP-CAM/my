<?php echo $header; ?>
<?php echo $content_top; ?>

<!--头部-->
<div class="weui-search-bar">
    <div class="weui-search-bar__form">
        <div class="weui-search-bar__box">
            <i class="weui-icon-search"></i>
            <input type="search" name="search" class="weui-search-bar__input" placeholder="<?php echo $entry_description; ?>" id="input-search" value="<?php echo $search; ?>">
        </div>
    </div>
    <a href="javascript:void(0);" class="weui-search-bar__cancel-btn" id="button-search" data-page='<?php echo $page; ?>' data-search='<?php echo $search; ?>'><?php echo $entry_search; ?></a>
</div>
<?php if (!$products) { ?>
<!--标签-->
<?php if ($search_tags) { ?>
<div class="ok_content_tag">
	<?php foreach($search_tags as $tag) { ?>
		<?php if($search == $tag['alt']){ ?>
			<a href="<?php echo $search_url; ?>&search=<?php echo $tag['alt']; ?>" class="ok_tag ok_tag_on"><?php echo $tag['alt']; ?></a>
		<?php }else{ ?>
			<a href="<?php echo $search_url; ?>&search=<?php echo $tag['alt']; ?>" class="ok_tag"><?php echo $tag['alt']; ?></a>
		<?php } ?>
    <?php } ?>
</div>
<?php } ?>
<!--浏览历史-->

<div class="ok_cs_box">
    <div class="ok_his_title"><?php echo $text_search_history; ?></div>
	<?php if(isset($search_history)){ ?>
    <div class="ok_history weui-cells">
		<?php foreach($search_history as $search){ ?>
        <div class="weui-cell">
            <div class="weui-cell__hd">
			<a href="<?php echo $search['search_url']; ?>">
			<?php echo $search['word']; ?>
			</a>
			</div>
        </div>
		<?php } ?>
    </div>
	<?php } ?>
</div>

<!--底部-->
<div class="ok_tabbar" id="clear-history">
    <img class="ok_tabbar_img" src="catalog/view/theme/default/images/home/search_delete.png" width="100%"/>
    <span class="ok_tabbar_txt"><?php echo $text_empty_search_history; ?></span>
</div>
<?php }else{ ?>
<div class="weui-cells ok_search_result">
<?php foreach ($products as $product) { ?>

    <div class="weui-cell">
        <div class="weui-cell__hd">
            <a href="<?php echo $product['href']; ?>">
                <img src="<?php echo $product['thumb']; ?>" width="100%">
            </a>
        </div>
        <div class="weui-cell__bd">
            <a href="<?php echo $product['href']; ?>">
                <p class="ok_order_name"><?php echo $product['name']; ?></p>
				 <?php if ($product['price']) { ?>
				 <p class="ok_order_price">	
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
    </div>

<?php } ?>
</div>
<?php } ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<div class="ok_position"> 
    <div class="ok_pop"></div>
</div>
<?php echo $footer; ?>
