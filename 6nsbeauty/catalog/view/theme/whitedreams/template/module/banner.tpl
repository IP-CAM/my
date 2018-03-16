<div id="banner<?php echo $module; ?>" class="owl-carousel" style=" -webkit-box-shadow:none;
    -moz-box-shadow: none;
    -o-box-shadow: none;
     box-shadow: none;">
  <?php foreach ($banners as $banner) { ?>
  <div class="item">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
$('#banner<?php echo $module; ?>').owlCarousel({
	items: 3,
	autoPlay: 4000,
	
	navigation: false,
	pagination: false,
	transitionStyle: 'fade'
});
--></script>
