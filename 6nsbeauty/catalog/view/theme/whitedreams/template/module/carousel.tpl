<div id="carousel<?php echo $module; ?>" class="owl-carousel" style=" -webkit-box-shadow:none;
    -moz-box-shadow: none;
    -o-box-shadow: none;
     box-shadow: none;">
  <?php foreach ($banners as $banner) { ?>
  <div class="item text-center">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
$('#carousel<?php echo $module; ?>').owlCarousel({
	items: 6,
	autoPlay: 3000,
	navigation: true,
	navigationText: ['<i class="fa fa-arrow-circle-left fa-5x"></i>', '<i class="fa fa-arrow-circle-right fa-5x"></i>'],
	pagination: true
});
--></script>