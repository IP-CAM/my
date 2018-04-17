<div id="wx_slideshow<?php echo $module; ?>" class="owl-carousel" style="opacity: 1;">
  <?php foreach ($banners as $banner) { ?>
  <div class="item">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" width="100%"/>
    <?php } ?>
  </div>
  <?php } ?>
</div>

<?php if($banners0 && $banners1 && $banners2){ ?>
<div class="ok_slider">
        <ul>
	<?php foreach ($banners0 as $banner) { ?>
	<li><a href="<?php echo $banner['link']; ?>"><img width="100%" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>"/></a></li>
	<?php } ?>
        </ul>
    </div>
<div class="weui-flex">
            <div class="weui-flex__item">
	<?php foreach ($banners1 as $banner) { ?>
	<a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" width="100%"/></a>
	<?php } ?>
            </div>
			 <div class="weui-flex__item">
	<?php foreach ($banners2 as $banner) { ?>
	<a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" width="100%"/></a>
	<?php } ?>
            </div>
</div>
<?php } ?>