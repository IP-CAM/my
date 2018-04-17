<?php if ($comments) { ?>
<?php foreach ($comments as $comment) { ?>
<div class="ok_comment_item">
            <div class="ok_item_top weui-flex">
                <div class="weui-flex__item">
                    <img class="ok_item_portrait" src="<?php echo $comment['image']; ?>">
                    <span class="ok_item_name"><?php echo $comment['author']; ?></span>
                </div>
                <div class="ok_item_date">
                    <span><?php echo $comment['date_added']; ?></span>
                </div>
            </div>
            <div class="ok_item_bottom">
                <p class="ok_item_content">
                    <?php echo $comment['text']; ?>
                </p>
            </div>
        </div>
<?php } ?>

<?php } else { ?>
<p><?php echo $text_no_comments; ?></p>
<?php } ?>