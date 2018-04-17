<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
		<div class="ok_comment_item">
            <div class="ok_item_top weui-flex">
                <div class="weui-flex__item">
                    <img class="ok_item_portrait" src="<?php echo $review['head_image'];?>"/>
                    <span class="ok_item_name"><?php echo $review['author']; ?></span>
                </div>
                <div class="ok_item_date">
                    <span><?php echo $review['date_added']; ?></span>
                </div>
            </div>
            <div class="ok_item_bottom">
                <p class="ok_item_content">
                    <?php echo $review['text']; ?>
                </p>
            </div>
        </div>
<?php } ?>
<div class="text-right"><?php echo $pagination; ?></div>
<?php } else { ?>
<?php echo $text_no_reviews; ?>
<?php } ?>