<div class="weui-tabbar ok_tabbar">
	<?php foreach($navs as $key=>$nav) { ?>
	<?php if($key>3){break;} ?>
	<a href="<?php echo $nav['href']; ?>" class="weui-tabbar__item">
		<i class="weui-tabbar__icon <?php echo $nav['class']; ?>"></i>
        <p class="weui-tabbar__label"><?php echo $nav['title']; ?></p>
	</a>
	<?php } ?>
</div>