<?php echo $header; ?>
<?php echo $content_top; ?>
<!--
<?php if ($categories) { ?>
	<?php foreach ($categories as $category) { ?>
<div class="ok_content_tag">
	<?php if($category['blog_category_id'] == $child_id){ ?>
    <a href="<?php echo $category['href']; ?>" class="ok_tag ok_tag_on"><?php echo $category['name']; ?></a>
	<?php }else{ ?>
	<a href="<?php echo $category['href']; ?>" class="ok_tag"><?php echo $category['name']; ?></a>
	<?php } ?>
</div>
	<?php } ?>
<?php } ?>
-->

<div class="ok_cs_box" id="ok_content" data-child="<?php echo $child_id; ?>">
	<?php if ($blogs) { ?>
    <?php foreach($blogs as $blog) { ?>
    <div class="ok_article_item">
        <a href="<?php echo $blog['link'];?>">
			<?php if($blog['thumb']){ ?>
            <div class="ok_article_img">
                <img class="lazy" src="catalog/view/theme/default/images/public/lazy.png" data-original="<?php echo $blog['thumb']; ?>" width="100%"/>
            </div>
			<?php } ?>
            <div class="ok_articel_info">
                <p class="ok_articel_title"><?php echo $blog['title'];?></p>
                <p class="ok_articel_date"><?php echo $blog['created']; ?></p>
            </div>
        </a>
    </div>
	<?php } ?>
	
	<?php } else { ?>
    <p><?php echo $text_empty; ?></p>
    <div class="buttons">
       <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
    </div>
    <?php } ?>
</div>


<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>

