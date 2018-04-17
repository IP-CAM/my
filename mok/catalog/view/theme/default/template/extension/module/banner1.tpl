<div class="ok_play_ban">
    <div class="ok_ban_title">
    <p class="ok_title_first"><?php echo $title; ?></p>
    <p class="ok_title_sec"><?php echo $title2; ?></p>
    </div>
	<?php foreach ($banners as $banner) { ?>
    <div class="ok_ban_content">
    <a href="<?php echo $banner['link']; ?>">
    <img class="lazy" src="<?php echo $banner['image']; ?>" width="100%"/>
    <p class="ok_ban_info ok_over"><?php echo $banner['title']; ?></p>
    </a>
    </div>
	<?php } ?>
</div>