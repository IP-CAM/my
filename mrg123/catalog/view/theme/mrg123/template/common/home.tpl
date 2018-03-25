<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_top; ?>
<?php echo $content_bottom; ?>

<div class="container">
	<div class="bd">
	
	<?php if($informations) { ?>
	<div class="weui_panel weui_panel_access">
	<div class="weui_panel_hd">最新文章</div>
	<div class="weui_panel_bd">
	<?php foreach($informations as $information) { ?>
		<a href="<?php echo $information['href']; ?>" class="weui_media_box weui_media_appmsg">
			<?php if($information['image']) { ?>
			<div class="weui_media_hd">
				<img class="weui_media_appmsg_thumb" src="<?php echo $information['image']; ?>" alt="<?php echo $information['title']; ?>"/>
			</div>
			<?php } ?>
			<div class="weui_media_bd">
				<h4 class="weui_media_title"><?php echo $information['title']; ?></h4>
				<p class="weui_media_desc">
				
				</p>
			</div>
		</a>
	<?php } ?>
	</div>
	<a class="weui_panel_ft" href="">就这样end</a>
	</div>
	<?php } ?>

    
	
	</div>
</div>



<?php echo $footer; ?>